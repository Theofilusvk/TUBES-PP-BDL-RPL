<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB; // Fix for DB class not found
use Illuminate\Support\Facades\Schema; // Fix for Schema class not found
use App\Models\Role; // Assuming Role model exists from 'ms_peran'

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter
        if ($request->has('filter')) {
            $filter = $request->filter;
            if ($filter == 'admin') {
                $query->where('PeranID', 1);
            } elseif ($filter == 'participant') {
                $query->where('PeranID', 4);
            }
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('NamaLengkap', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('Username', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10)->withQueryString();
        
        $totalParticipants = User::where('PeranID', 4)->count();
        $totalAdmins = User::where('PeranID', 1)->count();
        $totalAccounts = User::count();

        return view('admin.users', compact('users', 'totalParticipants', 'totalAdmins', 'totalAccounts'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        // Fetch Race History (Events done + Results)
        // Join: tr_pendaftaran -> ms_kategorilomba -> ms_event
        // Join: tr_hasillomba (Left Join in case they DNF or no result yet, but requirement says "events has been done")
        $raceHistory = DB::table('tr_pendaftaran')
            ->join('ms_kategorilomba', 'tr_pendaftaran.KategoriID', '=', 'ms_kategorilomba.KategoriID')
            ->join('ms_event', 'ms_kategorilomba.EventID', '=', 'ms_event.EventID')
            ->join('ms_slotkategori', 'ms_kategorilomba.KategoriID', '=', 'ms_slotkategori.KategoriID') // Join for Date
            ->leftJoin('tr_hasillomba', 'tr_pendaftaran.PendaftaranID', '=', 'tr_hasillomba.PendaftaranID')
            ->where('tr_pendaftaran.PenggunaID', $id)
            ->select(
                'ms_event.NamaEvent',
                'ms_slotkategori.TanggalMulai',
                'ms_kategorilomba.NamaKategori',
                'ms_kategorilomba.Jarak',
                'tr_hasillomba.WaktuFinish',
                'tr_hasillomba.PeringkatUmum',
                'tr_pendaftaran.StatusPendaftaran'
            )
            ->orderBy('ms_slotkategori.TanggalMulai', 'desc')
            ->get();

        // Calculate Stats (Pace)
        foreach ($raceHistory as $race) {
            $race->Pace = $this->calculatePace($race->WaktuFinish, $race->Jarak);
        }

        return view('admin.users.show', compact('user', 'raceHistory'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'Email' => 'required|email|unique:tr_pengguna,Email,'.$id.',PenggunaID',
            'Username' => 'required|string|unique:tr_pengguna,Username,'.$id.',PenggunaID',
        ]);

        $user->update($request->only(['NamaLengkap', 'Email', 'Username']));

        return back()->with('success', 'User profile updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        try {
            DB::transaction(function () use ($user, $id) {
                $adminId = auth()->id() ?? 1; // Fallback to 1 if not logged in (CLI test)

                // 1. Get all registrations for this user
                $registrationIds = DB::table('tr_pendaftaran')
                    ->where('PenggunaID', $id)
                    ->pluck('PendaftaranID');

                if ($registrationIds->isNotEmpty()) {
                    // Registration Dependencies (Group 1: Payments)
                    $paymentIds = DB::table('tr_pembayaran')
                        ->whereIn('PendaftaranID', $registrationIds)
                        ->pluck('PembayaranID');
                    
                    if ($paymentIds->isNotEmpty()) {
                        DB::table('tr_verifikasipembayaran')->whereIn('PembayaranID', $paymentIds)->delete();
                        DB::table('tr_pembayaran')->whereIn('PendaftaranID', $registrationIds)->delete();
                    }

                    // Registration Dependencies (Group 2: Details & Race Pk)
                    DB::table('tr_detailpilihanpeserta')->whereIn('PendaftaranID', $registrationIds)->delete();
                    DB::table('tr_sertifikat')->whereIn('PendaftaranID', $registrationIds)->delete();
                    DB::table('tr_racepackdetailpeserta')->whereIn('PendaftaranID', $registrationIds)->delete();
                    // NEW: Race Pack Distribusi associated with Registration
                    DB::table('tr_racepackdistribusi')->whereIn('PendaftaranID', $registrationIds)->delete();
                    // NEW: Supporting Docs
                    DB::table('ms_dokumenpendukung')->whereIn('PendaftaranID', $registrationIds)->delete();

                    // Registration Dependencies (Group 3: Results & Leaderboards)
                    $resultIds = DB::table('tr_hasillomba')
                        ->whereIn('PendaftaranID', $registrationIds)
                        ->pluck('HasilID');
                    
                    if ($resultIds->isNotEmpty()) {
                        DB::table('tr_peringkatkelompokusia')->whereIn('HasilID', $resultIds)->delete();
                    }
                    DB::table('tr_hasillomba')->whereIn('PendaftaranID', $registrationIds)->delete();
                    
                    // Registration Dependencies (Group 4: Participant Profile)
                    DB::table('tr_peserta')->whereIn('PendaftaranID', $registrationIds)->delete();

                    // Delete the Registrations
                    DB::table('tr_pendaftaran')->where('PenggunaID', $id)->delete();
                }
                
                // 2. User Direct Dependencies
                DB::table('total_distances')->where('PenggunaID', $id)->delete();
                DB::table('tr_aktivitaslogin')->where('PenggunaID', $id)->delete();
                // tr_pesankontak uses EmailPengirim, not PenggunaID
                DB::table('tr_pesankontak')->where('EmailPengirim', $user->Email)->delete();
                DB::table('ms_resetpasswordtoken')->where('PenggunaID', $id)->delete(); // NEW
                DB::table('tr_logaktivitassistem')->where('PenggunaID', $id)->delete(); // NEW: User's own logs

                // Notifications: Sent TO this user
                DB::table('tr_pengirimannotifikasi')->where('PenggunaTargetID', $id)->delete();
                
                // Admin Actions: If user was admin/staff, clear their ID from records (or delete if necessary)
                // We'll try to set NULL or delete if column exists. For now, strict delete via transaction.
                if (Schema::hasColumn('tr_racepackdistribusi', 'PetugasID')) {
                    DB::table('tr_racepackdistribusi')->where('PetugasID', $id)->delete();
                }
                if (Schema::hasColumn('tr_verifikasipembayaran', 'PanitiaID')) {
                    DB::table('tr_verifikasipembayaran')->where('PanitiaID', $id)->delete();
                }
                if (Schema::hasColumn('ms_notifikasi', 'AdminID')) {
                    DB::table('ms_notifikasi')->where('AdminID', $id)->delete();
                }
                if (Schema::hasColumn('ms_backuplog', 'AdminID')) {
                    DB::table('ms_backuplog')->where('AdminID', $id)->delete();
                }

                // 3. Log the deletion action
                DB::table('tr_logaktivitassistem')->insert([
                    'PenggunaID' => $adminId,
                    'TipeAktivitas' => 'DELETE_USER',
                    'DetailAktivitas' => "Deleted user: {$user->Email} (ID: $id)",
                    'WaktuLog' => now()
                ]);

                // 4. Finally, Delete the User
                $user->delete();
            });

            return redirect()->route('admin.users')->with('success', 'User deleted and logged successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }

    // Helper to calculate Pace (min/km)
    private function calculatePace($time, $distanceStr)
    {
        if (!$time || !$distanceStr) return '-';

        // Parse Distance
        $distance = 0;
        if (str_contains(strtoupper($distanceStr), 'K')) {
            $distance = (float)filter_var($distanceStr, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        } elseif (strtoupper($distanceStr) === 'HM' || strtoupper($distanceStr) === 'HALF MARATHON') {
            $distance = 21.0975;
        } elseif (strtoupper($distanceStr) === 'FM' || strtoupper($distanceStr) === 'FULL MARATHON' || strtoupper($distanceStr) === 'MARATHON') {
            $distance = 42.195;
        }

        if ($distance <= 0) return '-';

        // Parse Time (HH:MM:SS)
        $parts = explode(':', $time);
        if (count($parts) !== 3) return $time; // Return raw if format unknown

        $totalMinutes = ($parts[0] * 60) + $parts[1] + ($parts[2] / 60);
        $paceDecimal = $totalMinutes / $distance;

        $paceMin = floor($paceDecimal);
        $paceSec = round(($paceDecimal - $paceMin) * 60);

        return sprintf('%d\'%02d" /km', $paceMin, $paceSec);
    }
}
