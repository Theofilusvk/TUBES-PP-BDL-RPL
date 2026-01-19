<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserLeaderboardSeeder extends Seeder
{
    public function run()
    {
        $userId = 1; // Assuming User ID 1 is the main test user
        
        // 1. Get a completed event (Start Date in past)
        $event = DB::table('ms_event')->where('StatusEvent', 'Tutup')->first();
        if (!$event) {
             // Fallback if no closed event, make one "past"
             $eventId = DB::table('ms_event')->insertGetId([
                 'NamaEvent' => 'Past Test Marathon',
                 'DeskripsiEvent' => 'A test event for leaderboard data.',
                 'TanggalMulai' => Carbon::now()->subMonths(1),
                 'TanggalSelesai' => Carbon::now()->subMonths(1)->addHours(5),
                 'LokasiEvent' => 'Jakarta',
                 'StatusEvent' => 'Tutup',
                 'GambarEvent' => 'storage/events/default.jpg' 
             ]);
             $categoryId = DB::table('ms_kategorilomba')->insertGetId([
                 'EventID' => $eventId,
                 'NamaKategori' => '10K Race',
                 'Jarak' => '10K',
                 'JarakKM' => 10,
                 'Harga' => 150000,
                 'Deskripsi' => '10K Run',
                 'StokSlot' => 100
             ]);
        } else {
            $eventId = $event->EventID;
            $categoryId = DB::table('ms_kategorilomba')->where('EventID', $eventId)->value('KategoriID');
        }

        // 2. Create Registration for User if not exists
        $regId = DB::table('tr_pendaftaran')->insertGetId([
            'PenggunaID' => $userId,
            'KategoriID' => $categoryId,
            'TanggalPendaftaran' => Carbon::now()->subMonths(1)->subDays(10),
            'StatusPendaftaran' => 'Selesai', // Completed
            'NomorBIB' => 'USER-001'
        ]);

        // 3. Create Result
        DB::table('tr_hasillomba')->insert([
            'PendaftaranID' => $regId,
            'WaktuFinish' => '00:55:30', // Good time for 10k
            'StatusHasil' => 'Finish',
            'PeringkatUmum' => 5
        ]);
        
        // Add another one to boost Total Distance
         $regId2 = DB::table('tr_pendaftaran')->insertGetId([
            'PenggunaID' => $userId,
            'KategoriID' => $categoryId, // Re-use or finding another doesn't matter much for global aggregation
            'TanggalPendaftaran' => Carbon::now()->subMonths(2),
            'StatusPendaftaran' => 'Selesai', 
            'NomorBIB' => 'USER-002'
        ]);

        DB::table('tr_hasillomba')->insert([
            'PendaftaranID' => $regId2,
            'WaktuFinish' => '00:58:00',
            'StatusHasil' => 'Finish',
            'PeringkatUmum' => 10
        ]);

        $this->command->info('User results seeded! User ID: ' . $userId);
    }
}
