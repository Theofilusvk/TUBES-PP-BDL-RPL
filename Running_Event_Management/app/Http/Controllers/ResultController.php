<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // 1. Fetch all finished races for the user
        // Joining: tr_pendaftaran -> tr_hasillomba -> ms_kategorilomba -> ms_event
        // We need: EventName, Date, Distance, OfficialTime, NetTime (assumed same), Pace (calculated), Rank
        $query = DB::table('tr_pendaftaran as p')
            ->join('tr_hasillomba as h', 'p.PendaftaranID', '=', 'h.PendaftaranID')
            ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
            ->leftJoin('ms_event as e', 'k.EventID', '=', 'e.EventID') // Left join as EventID might be null in legacy category data?
             // Or maybe tr_pendaftaran links to event indirectly? Schema says ms_kategorilomba has EventID
            ->where('p.PenggunaID', $user->PenggunaID)
            ->select(
                'e.NamaEvent', 
                'e.GambarEvent',
                'p.TanggalPendaftaran', // approximate date if event date missing
                'ms_slotkategori.TanggalMulai as EventDate', // Better date source via ms_slotkategori (linked by KategoriID)
                'k.NamaKategori',
                'k.Jarak',
                'k.JarakKM',
                'h.WaktuFinish',
                'h.PeringkatUmum',
                'h.PendaftaranID'
            )
            // Need to join ms_slotkategori for date?
            ->leftJoin('ms_slotkategori', 'k.KategoriID', '=', 'ms_slotkategori.KategoriID')
            ->orderBy('ms_slotkategori.TanggalMulai', 'desc');

        // Apply filters
        if ($request->has('year') && $request->year != 'All') {
             $query->whereYear('ms_slotkategori.TanggalMulai', $request->year);
        }
        if ($request->has('distance') && $request->distance != 'All') {
            $query->where('k.Jarak', $request->distance);
        }

        $results = $query->paginate(10);
        
        // Calculate dynamic stats
        $totalRaces = $query->count();
        
        // Personal Best (Fastest Pace)
        // Pace = Time (minutes) / Distance (KM)
        // We need to fetch all rows to calculate min pace in code, or do fancy SQL
        // Let's do a separate query for PB
        $allResults = DB::table('tr_pendaftaran as p')
            ->join('tr_hasillomba as h', 'p.PendaftaranID', '=', 'h.PendaftaranID')
            ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
            ->leftJoin('ms_event as e', 'k.EventID', '=', 'e.EventID')
            ->where('p.PenggunaID', $user->PenggunaID)
            ->whereNotNull('k.JarakKM')
            ->where('k.JarakKM', '>', 0)
            ->select('h.WaktuFinish', 'k.JarakKM', 'e.NamaEvent', 'k.NamaKategori')
            ->get();

        $personalBest = null;
        $bestPace = 999999;
        $totalPace = 0;
        $paceCount = 0;

        foreach ($allResults as $res) {
            // Convert WaktuFinish (H:i:s) to minutes
            $timeParts = explode(':', $res->WaktuFinish);
            $seconds = ($timeParts[0] * 3600) + ($timeParts[1] * 60) + $timeParts[2];
            $minutes = $seconds / 60;
            
            $pace = $minutes / $res->JarakKM; // min/km
            
            if ($pace < $bestPace) {
                $bestPace = $pace;
                $personalBest = $res;
                $personalBest->BestPace = $pace;
                $personalBest->TimeDisplay = $res->WaktuFinish;
            }
            
            $totalPace += $pace;
            $paceCount++;
        }

        $avgPace = $paceCount > 0 ? gmdate("i's\"", ($totalPace / $paceCount) * 60) : "0'00\"";

        // Format PB Pace
        $pbPaceFormatted = $personalBest ? gmdate("i's\"", $personalBest->BestPace * 60) : "--";

        return view('dashboard.results.index', compact('results', 'totalRaces', 'personalBest', 'avgPace', 'pbPaceFormatted'));
    }
}
