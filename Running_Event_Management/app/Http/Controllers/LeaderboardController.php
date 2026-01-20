<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter Parameters
        $category = $request->input('category', 'All'); // 'All', '5K', '10K', '42K' etc.
        $location = $request->input('location', 'All');
        $search = $request->input('search');
        $sort = $request->input('sort', 'rank'); // 'rank', 'name_asc', 'name_desc', 'city_asc'

        // Logic branching:
        // 1. All Categories -> Rank by Total Distance
        // 2. Specific Category (e.g. 42K) -> Rank by Fastest Time (Best Pace logic)

        $topRunners = [];
        $rankings = [];
        $userRank = null;
        $isSpeedRank = ($category !== 'All');

        if ($isSpeedRank) {
            // Rank by Fastest Time for specific Distance
            // Join: tr_hasillomba -> tr_pendaftaran -> ms_kategorilomba
            // Rank by Fastest Time for specific Distance
            // Join: tr_hasillomba -> tr_pendaftaran -> ms_kategorilomba
            $query = DB::table('tr_hasillomba as h')
                ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                ->join('tr_pengguna as u', 'p.PenggunaID', '=', 'u.PenggunaID')
                ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
                ->where('k.Jarak', 'LIKE', "%$category%") // Simple text match for now, e.g. '42K' matches 'Full Marathon 42K'
                ->where('h.StatusHasil', 'Finish')
                ->where('u.PeranID', '!=', 1) // Exclude Admin
                ->select(
                    'u.NamaLengkap',
                    'u.Gambar',
                    'u.Username',
                    'u.Kota', // Replaced Komunitas with Kota
                    'h.WaktuFinish',
                    'h.Pace',
                    'h.PendaftaranID',
                    'k.NamaKategori',
                    'k.Jarak',
                    'p.NomorBIB' // Added BIB
                );

             if ($search) {
                 $query->where(function($q) use ($search) {
                     $q->where('u.NamaLengkap', 'LIKE', "%$search%")
                       ->orWhere('u.Kota', 'LIKE', "%$search%")
                       ->orWhere('p.NomorBIB', 'LIKE', "%$search%");
                 });
             }

             // Apply Sorting
             switch ($sort) {
                 case 'name_asc':
                     $query->orderBy('u.NamaLengkap', 'asc');
                     break;
                 case 'name_desc':
                     $query->orderBy('u.NamaLengkap', 'desc');
                     break;
                 case 'city_asc':
                     $query->orderBy('u.Kota', 'asc');
                     break;
                 case 'rank':
                 default:
                     $query->orderBy('h.WaktuFinish', 'asc');
                     break;
             }

             $rankings = $query->paginate(20);

        } else {
            // Rank by Total Distance (Global Leaderboard)
            // We can use the 'total_distances' table we seeded, but let's query raw for accuracy if 'total_distances' is just a cache
            // For now, let's use the raw sum from ms_kategorilomba JarakKM
            
            $query = DB::table('tr_hasillomba as h')
                ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                ->join('tr_pengguna as u', 'p.PenggunaID', '=', 'u.PenggunaID')
                ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
                ->where('h.StatusHasil', 'Finish')
                ->where('u.PeranID', '!=', 1) // Exclude Admin
                ->select(
                    'u.PenggunaID',
                    'u.NamaLengkap',
                    'u.Gambar',
                    'u.Username',
                    'u.Kota', // Replaced Komunitas with Kota
                    DB::raw('SUM(k.JarakKM) as TotalDist'),
                    DB::raw('COUNT(h.PendaftaranID) as TotalRace')
                )
                ->groupBy('u.PenggunaID', 'u.NamaLengkap', 'u.Gambar', 'u.Username', 'u.Kota'); // Group by City
                
            if ($search) {
                 $query->where(function($q) use ($search) {
                     $q->where('u.NamaLengkap', 'LIKE', "%$search%")
                       ->orWhere('u.Kota', 'LIKE', "%$search%");
                       // BIB is 1-to-many here (aggregated), so simpler to not search BIB in global aggregation or need subquery.
                       // For global (Total Distance), user represents multiple BIBs. Searching by BIB might not make sense here unless we check if ANY of their registration has that BIB.
                       // Let's stick to Name/City for Global, and BIB for specific category/speed rank.
                 });
             }

             // Apply Sorting
             switch ($sort) {
                 case 'name_asc':
                     $query->orderBy('u.NamaLengkap', 'asc');
                     break;
                 case 'name_desc':
                     $query->orderBy('u.NamaLengkap', 'desc');
                     break;
                 case 'city_asc':
                     $query->orderBy('u.Kota', 'asc');
                     break;
                 case 'rank':
                 default:
                     $query->orderByDesc('TotalDist');
                     break;
             }
                
            $rankings = $query->paginate(20);
        }

        // Extract Top 3 for Showcase
        // Note: Pagination preserves internal order, so taking first 3 of page 1 works for top 3
        if ($rankings->currentPage() == 1) {
            $topRunners = $rankings->take(3);
        }

        // Find Auth User Rank and Stats
        $userStats = null;
        $user = Auth::user();

        if ($user) {
            if ($isSpeedRank) {
                // Get User's Best Time for this Category
                $userBest = DB::table('tr_hasillomba as h')
                    ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                    ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
                    ->where('p.PenggunaID', $user->PenggunaID)
                    ->where('k.Jarak', 'LIKE', "%$category%")
                    ->where('h.StatusHasil', 'Finish')
                    ->orderBy('h.WaktuFinish', 'asc')
                    ->select('h.WaktuFinish', 'k.Jarak') // Select Jarak to match view expectation
                    ->first();

                if ($userBest) {
                    // Count how many people are faster
                    $fasterCount = DB::table('tr_hasillomba as h')
                        ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                        ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
                        ->where('k.Jarak', 'LIKE', "%$category%")
                        ->where('h.StatusHasil', 'Finish')
                        ->where('h.WaktuFinish', '<', $userBest->WaktuFinish)
                        ->count();

                    // Count total participants in this category
                    $totalParticipants = DB::table('tr_hasillomba as h')
                        ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                        ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
                        ->where('k.Jarak', 'LIKE', "%$category%")
                        ->where('h.StatusHasil', 'Finish')
                        ->count();

                    $rank = $fasterCount + 1;
                    $percentile = $totalParticipants > 1 ? round((($totalParticipants - $rank) / $totalParticipants) * 100) : 100;

                    $userStats = (object) [
                        'rank' => $rank,
                        'value' => $userBest->WaktuFinish,
                        'label' => 'Best Time',
                        'percentile' => $percentile,
                        'total_events' => DB::table('tr_hasillomba as h')
                                        ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                                        ->where('p.PenggunaID', $user->PenggunaID)
                                        ->where('h.StatusHasil', 'Finish')
                                        ->count(),
                        // Add display helper
                        'display_value' => $userBest->WaktuFinish
                    ];
                }

            } else {
                // Global Rank by Distance
                 $userTotal = DB::table('tr_hasillomba as h')
                    ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                    ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
                    ->where('p.PenggunaID', $user->PenggunaID)
                    ->where('h.StatusHasil', 'Finish')
                    ->sum('k.JarakKM');

                 if ($userTotal > 0) {
                     // Count how many have more distance
                     // Subquery for aggregation
                     $betterRunners = DB::table('tr_hasillomba as h')
                        ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                        ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
                        ->where('h.StatusHasil', 'Finish')
                        ->select('p.PenggunaID', DB::raw('SUM(k.JarakKM) as TotalDist'))
                        ->groupBy('p.PenggunaID')
                        ->having('TotalDist', '>', $userTotal)
                        ->get() // count() on having doesn't work directly in some drivers accurately without get() count
                        ->count();

                     $totalRunners = DB::table('tr_hasillomba as h')
                        ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                        ->where('h.StatusHasil', 'Finish')
                        ->distinct('p.PenggunaID')
                        ->count('p.PenggunaID');

                     $rank = $betterRunners + 1;
                     $percentile = $totalRunners > 1 ? round((($totalRunners - $rank) / $totalRunners) * 100) : 100;

                     $userStats = (object) [
                        'rank' => $rank,
                        'value' => $userTotal,
                        'label' => 'Total Distance',
                        'percentile' => $percentile,
                        'total_events' => DB::table('tr_hasillomba as h')
                                        ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
                                        ->where('p.PenggunaID', $user->PenggunaID)
                                        ->where('h.StatusHasil', 'Finish')
                                        ->count(),
                        'display_value' => number_format($userTotal, 1) . ' KM'
                     ];
                 }
            }
        }
        
        return view('dashboard.leaderboards.index', compact('rankings', 'topRunners', 'category', 'isSpeedRank', 'sort', 'search', 'userStats'));
    }
}
