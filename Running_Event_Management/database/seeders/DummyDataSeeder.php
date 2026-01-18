<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Users
        $users = [
            [
                'Username' => 'budi_runner',
                'Email' => 'budi@example.com',
                'NamaLengkap' => 'Budi Santoso',
                'Password' => Hash::make('password'),
                'PeranID' => 4, // Peserta
            ],
            [
                'Username' => 'siti_lari',
                'Email' => 'siti@example.com',
                'NamaLengkap' => 'Siti Aminah',
                'Password' => Hash::make('password'),
                'PeranID' => 4,
            ],
            [
                'Username' => 'joko_speed',
                'Email' => 'joko@example.com',
                'NamaLengkap' => 'Joko Anwar',
                'Password' => Hash::make('password'),
                'PeranID' => 4,
            ],
        ];

        $userIds = [];
        foreach ($users as $user) {
            $exists = DB::table('tr_pengguna')->where('Email', $user['Email'])->first();
            if (!$exists) {
                $userIds[$user['Username']] = DB::table('tr_pengguna')->insertGetId($user);
            } else {
                $userIds[$user['Username']] = $exists->PenggunaID;
            }
        }

        // 2. Events & Categories
        $events = [
            [
                'name' => 'Jakarta Marathon 2026',
                'desc' => 'Lari keliling Jakarta.',
                'status' => 'Buka',
                'status' => 'Buka',
                'image' => 'https://images.unsplash.com/photo-1533560906634-887cd79210f5?w=600&h=400&fit=crop',
                'categories' => [
                    ['name' => '5K Fun Run', 'dist' => '5K', 'min' => 12, 'max' => 70, 'quota' => 100],
                    ['name' => '10K Race', 'dist' => '10K', 'min' => 15, 'max' => 60, 'quota' => 100],
                    ['name' => 'Full Marathon', 'dist' => '42K', 'min' => 18, 'max' => 55, 'quota' => 50],
                ]
            ],
            [
                'name' => 'Bali Ultra 2026',
                'desc' => 'Lari lintas alam di Bali.',
                'status' => 'Buka',
                'status' => 'Buka',
                'image' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?w=600&h=400&fit=crop',
                'categories' => [
                    ['name' => 'Trail 25K', 'dist' => '25K', 'min' => 17, 'max' => 65, 'quota' => 50],
                    ['name' => 'Ultra 50K', 'dist' => '50K', 'min' => 20, 'max' => 50, 'quota' => 30],
                ]
            ],
            [
                'name' => 'Bandung Night Run 2025',
                'desc' => 'Lari malam menikmati kota Bandung.',
                'status' => 'Tutup', // Past Event
                'status' => 'Tutup', // Past Event
                'image' => 'https://images.unsplash.com/photo-1516738901171-8eb4fc13bd20?w=600&h=400&fit=crop',
                'categories' => [
                    ['name' => '10K Night', 'dist' => '10K', 'min' => 15, 'max' => 60, 'quota' => 200],
                ]
            ]
        ];

        // Drop broken trigger constraint if it exists (legacy issue)
        DB::unprepared("DROP TRIGGER IF EXISTS trg_validasi_pendaftaran_umur");

        $eventIds = [];
        $categoryIds = [];

        foreach ($events as $evtData) {
            $evt = DB::table('ms_event')->where('NamaEvent', $evtData['name'])->first();
            if (!$evt) {
                $eid = DB::table('ms_event')->insertGetId([
                    'NamaEvent' => $evtData['name'],
                    'DeskripsiEvent' => $evtData['desc'],
                    'StatusEvent' => $evtData['status'],
                    'GambarEvent' => $evtData['image'] ?? null
                ]);
            } else {
                $eid = $evt->EventID;
                DB::table('ms_event')->where('EventID', $eid)->update([
                    'GambarEvent' => $evtData['image'] ?? null
                ]);
            }
            $eventIds[$evtData['name']] = $eid;

            foreach ($evtData['categories'] as $catData) {
                $catKey = $evtData['name'] . '-' . $catData['name'];
                $cat = DB::table('ms_kategorilomba')
                    ->where('EventID', $eid)
                    ->where('NamaKategori', $catData['name'])
                    ->first();
                
                if (!$cat) {
                    $cid = DB::table('ms_kategorilomba')->insertGetId([
                        'EventID' => $eid,
                        'NamaKategori' => $catData['name'],
                        'Jarak' => $catData['dist'],
                        'BatasUsiaMin' => $catData['min'],
                        'BatasUsiaMax' => $catData['max']
                    ]);
                    
                    // Add Slots
                    DB::table('ms_slotkategori')->insert([
                        'KategoriID' => $cid,
                        'KuotaTotal' => $catData['quota'],
                        'KuotaTersisa' => $catData['quota'], 
                        'StatusEvent' => 'Aktif'
                    ]);
                } else {
                    $cid = $cat->KategoriID;
                }
                $categoryIds[$catKey] = $cid;
            }
        }

        // 3. Registrations & Payments
        // Helper to register
        $register = function($username, $eventName, $catName, $status, $paid = false) use ($userIds, $categoryIds) {
            if (!isset($userIds[$username])) return;
            $catKey = $eventName . '-' . $catName;
            if (!isset($categoryIds[$catKey])) return;

            $uid = $userIds[$username];
            $cid = $categoryIds[$catKey];

            // Check existing
            $exists = DB::table('tr_pendaftaran')
                ->where('PenggunaID', $uid)
                ->where('KategoriID', $cid)
                ->first();

            if (!$exists) {
                $pid = DB::table('tr_pendaftaran')->insertGetId([
                    'PenggunaID' => $uid,
                    'KategoriID' => $cid,
                    'StatusPendaftaran' => $status,
                    'TanggalPendaftaran' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            } else {
                $pid = $exists->PendaftaranID;
            }

            // Payment
            if ($paid) {
                $payExists = DB::table('tr_pembayaran')->where('PendaftaranID', $pid)->exists();
                if (!$payExists) {
                    DB::table('tr_pembayaran')->insert([
                        'PendaftaranID' => $pid,
                        'TanggalBayar' => Carbon::now()->subDays(rand(0, 5)),
                        'NominalBayar' => 150000, 
                        'MetodeID' => 1, // BCA
                        'StatusPembayaran' => 'Lunas'
                    ]);
                }
            }
            // Return PendaftaranID for result usage
            return $pid;
        };

        // Budi: Registered and Paid for Jakarta Marathon 5K
        $pid1 = $register('budi_runner', 'Jakarta Marathon 2026', '5K Fun Run', 'Selesai', true);
        
        // Budi: Register for Bali Ultra (Pending)
        $pid2 = $register('budi_runner', 'Bali Ultra 2026', 'Trail 25K', 'Menunggu Pembayaran', false);

        // Siti: Registered for Jakarta 10K (Paid)
        $pid3 = $register('siti_lari', 'Jakarta Marathon 2026', '10K Race', 'Terverifikasi', true);

        // Joko: Registered for Past Event (Bandung)
        $pid4 = $register('joko_speed', 'Bandung Night Run 2025', '10K Night', 'Selesai', true);
        
        // Budi: Past Events (Seeded for History)
        $pid5 = $register('budi_runner', 'Bandung Night Run 2025', '10K Night', 'Selesai', true);

        // 5. Results (tr_hasillomba)
        // Add results for Budi and Joko
        $addResult = function($pid, $time, $rank) {
            if (!$pid) return;
            DB::table('tr_hasillomba')->updateOrInsert(
                ['PendaftaranID' => $pid],
                ['WaktuFinish' => $time, 'PeringkatUmum' => $rank, 'StatusHasil' => 'Finish']
            );
        };

        // Budi finished 5K in 25 mins
        $addResult($pid1, '00:25:00', 45);
        // Budi finished 10K in 55 mins
        $addResult($pid5, '00:55:00', 120);
        // Joko finished 10K in 40 mins
        $addResult($pid4, '00:40:00', 15);

        // 4. Populate total_distances based on registered events (Dummy Logic)
        // In a real scenario, this would sum tr_hasillomba, but we don't have results seeded yet.
        // So we'll just assign random distances based on what they registered for.
        
        $distances = [
            'budi_runner' => 5.0 + 25.0, // 5K + 25K
            'siti_lari' => 10.0, // 10K
            'joko_speed' => 10.0, // 10K
        ];

        foreach ($distances as $username => $dist) {
            if (isset($userIds[$username])) {
                DB::table('total_distances')->updateOrInsert(
                    ['PenggunaID' => $userIds[$username]],
                    ['TotalDistance' => $dist, 'LastUpdated' => Carbon::now()]
                );
            }
        }
    }
}
