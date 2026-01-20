<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminNotificationController extends Controller
{
    public function index()
    {
        // Fetch Notification History
        $history = DB::table('ms_notifikasi')
            ->join('tr_pengguna', 'ms_notifikasi.AdminID', '=', 'tr_pengguna.PenggunaID')
            ->leftJoin('ms_event', 'ms_notifikasi.EventID', '=', 'ms_event.EventID') // Join Event
            ->select(
                'ms_notifikasi.*',
                'tr_pengguna.NamaLengkap as SenderName',
                'ms_event.NamaEvent'
            )
            ->orderBy('ms_notifikasi.NotifikasiID', 'desc')
            ->paginate(10);

        // Count recipients
        foreach ($history as $notif) {
            $notif->RecipientCount = DB::table('tr_pengirimannotifikasi')
                ->where('NotifikasiID', $notif->NotifikasiID)
                ->count();
            
            $notif->SentTime = DB::table('tr_pengirimannotifikasi')
                ->where('NotifikasiID', $notif->NotifikasiID)
                ->value('WaktuKirim');
        }

        // Fetch Active Events for Dropdown
        $events = DB::table('ms_event')
            ->where('StatusEvent', '!=', 'Selesai') // Assuming 'Selesai' or similar status
            ->select('EventID', 'NamaEvent')
            ->get();

        return view('admin.notifications.index', compact('history', 'events'));
    }

    public function broadcast(Request $request)
    {
        $request->validate([
            'JudulNotifikasi' => 'required|string|max:150',
            'IsiNotifikasi' => 'required|string',
            'TipeNotifikasi' => 'required|in:Email,Web,System',
            'EventID' => 'nullable|integer|exists:ms_event,EventID',
        ]);

        $adminId = Auth::id() ?? 1;

        DB::beginTransaction();
        try {
            // 1. Create Master Notification
            $notifId = DB::table('ms_notifikasi')->insertGetId([
                'AdminID' => $adminId,
                'TipeNotifikasi' => $request->TipeNotifikasi,
                'JudulNotifikasi' => $request->JudulNotifikasi,
                'IsiNotifikasi' => $request->IsiNotifikasi,
                'EventID' => $request->EventID // Store EventID
            ]);

            // 2. Fetch All Participants (PeranID = 4) AND the current Admin
            $participants = DB::table('tr_pengguna')
                ->where('PeranID', 4)
                ->pluck('PenggunaID')
                ->toArray();
            
            // Add current admin to recipients so they can see it in valid UI
            if (!in_array($adminId, $participants)) {
                $participants[] = $adminId;
            }

            // 3. Bulk Insert
            $now = Carbon::now();
            $insertData = [];
            foreach ($participants as $uid) {
                $insertData[] = [
                    'NotifikasiID' => $notifId,
                    'PenggunaTargetID' => $uid,
                    'WaktuKirim' => $now,
                    'StatusKirim' => 'Sent'
                ];
            }

            if (!empty($insertData)) {
                DB::table('tr_pengirimannotifikasi')->insert($insertData);
            }

            // 4. Log the activity
             DB::table('tr_logaktivitassistem')->insert([
                'PenggunaID' => $adminId,
                'TipeAktivitas' => 'BROADCAST_NOTIF',
                'DetailAktivitas' => "Broadcasting: {$request->JudulNotifikasi}" . ($request->EventID ? " (Linked Event ID: {$request->EventID})" : "") . " to " . count($insertData) . " users.",
                'WaktuLog' => $now
            ]);

            DB::commit();
            return back()->with('success', 'Notification broadcasted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to broadcast notification: ' . $e->getMessage());
        }
    }
}
