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
        $query = DB::table('tr_pendaftaran as p')
            ->join('tr_hasillomba as h', 'p.PendaftaranID', '=', 'h.PendaftaranID')
            ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
            ->leftJoin('ms_event as e', 'k.EventID', '=', 'e.EventID')
            ->where('p.PenggunaID', $user->PenggunaID)
            ->select(
                'e.NamaEvent', 
                'e.GambarEvent',
                'p.TanggalPendaftaran',
                'ms_slotkategori.TanggalMulai as EventDate',
                'k.NamaKategori',
                'k.Jarak',
                'k.JarakKM',
                'h.WaktuFinish',
                'h.Pace',
                'h.PeringkatUmum',
                'h.PendaftaranID'
            )
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
        
        // Personal Best (Fastest Pace) - Now using database-stored Pace
        $allResults = DB::table('tr_pendaftaran as p')
            ->join('tr_hasillomba as h', 'p.PendaftaranID', '=', 'h.PendaftaranID')
            ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
            ->leftJoin('ms_event as e', 'k.EventID', '=', 'e.EventID')
            ->where('p.PenggunaID', $user->PenggunaID)
            ->whereNotNull('h.Pace') // Only include results with calculated pace
            ->select('h.WaktuFinish', 'h.Pace', 'e.NamaEvent', 'k.NamaKategori')
            ->get();

        $personalBest = null;
        $bestPaceSeconds = 999999; // Store pace in seconds for comparison
        $totalPaceSeconds = 0;
        $paceCount = 0;

        foreach ($allResults as $res) {
            // Parse pace from format "X'YY\" /km" to seconds
            if (preg_match("/(\d+)'(\d+)\"/", $res->Pace, $matches)) {
                $paceSeconds = ($matches[1] * 60) + $matches[2]; // Convert to total seconds
                
                if ($paceSeconds < $bestPaceSeconds) {
                    $bestPaceSeconds = $paceSeconds;
                    $personalBest = $res;
                    $personalBest->TimeDisplay = $res->WaktuFinish;
                    $personalBest->BestPaceFormatted = $res->Pace;
                }
                
                $totalPaceSeconds += $paceSeconds;
                $paceCount++;
            }
        }

        // Calculate average pace
        if ($paceCount > 0) {
            $avgPaceSeconds = $totalPaceSeconds / $paceCount;
            $avgMin = floor($avgPaceSeconds / 60);
            $avgSec = round($avgPaceSeconds % 60);
            $avgPace = sprintf("%d'%02d\"", $avgMin, $avgSec);
        } else {
            $avgPace = "0'00\"";
        }

        // Format PB Pace (already formatted from database)
        $pbPaceFormatted = $personalBest ? str_replace(' /km', '', $personalBest->Pace) : "--";

        return view('dashboard.results.index', compact('results', 'totalRaces', 'personalBest', 'avgPace', 'pbPaceFormatted'));
    }
}
