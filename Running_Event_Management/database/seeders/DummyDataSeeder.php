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
            // New Users from Mockup
            [
                'Username' => 'sarah_swift',
                'Email' => 'sarah@example.com',
                'NamaLengkap' => 'Sarah Wijaya',
                'Password' => Hash::make('password'),
                'PeranID' => 4,
            ],
            [
                'Username' => 'andi_explore',
                'Email' => 'andi@example.com',
                'NamaLengkap' => 'Andi Pratama',
                'Password' => Hash::make('password'),
                'PeranID' => 4,
            ],
        ];

        $userIds = [];
        // City Assignments (Domicile)
        $cities = [
            'budi_runner' => 'Jakarta',
            'sarah_swift' => 'Jakarta',
            'andi_explore' => 'Bandung',
            'joko_speed' => 'Bandung',
            'siti_lari' => 'Surabaya',
        ];

        foreach ($users as $user) {
            $exists = DB::table('tr_pengguna')->where('Email', $user['Email'])->first();
            
            // Add Kota to array before inserting
            $userWithCity = $user;
            if(isset($cities[$user['Username']])) {
                $userWithCity['Kota'] = $cities[$user['Username']];
            }

            if (!$exists) {
                $userIds[$user['Username']] = DB::table('tr_pengguna')->insertGetId($userWithCity);
            } else {
                $userIds[$user['Username']] = $exists->PenggunaID;
                if(isset($cities[$user['Username']])) {
                    DB::table('tr_pengguna')->where('PenggunaID', $exists->PenggunaID)->update(['Kota' => $cities[$user['Username']]]);
                }
            }
        }

        // 2. Events & Categories
        $events = [
            // --- UPCOMING ---
            [
                'name' => 'Jakarta Marathon 2026',
                'desc' => 'The biggest marathon in Indonesia, traversing iconic landmarks.',
                'status' => 'Buka',
                'image' => 'images/events/jakarta_marathon_2026.png',
                'categories' => [
                    ['name' => '5K Fun Run', 'dist' => '5K', 'min' => 12, 'max' => 70, 'quota' => 500],
                    ['name' => '10K Race', 'dist' => '10K', 'min' => 15, 'max' => 65, 'quota' => 300],
                    ['name' => 'Full Marathon', 'dist' => '42K', 'min' => 18, 'max' => 60, 'quota' => 100],
                ]
            ],
            [
                'name' => 'Bali Ultra 2026',
                'desc' => 'Extreme trail running across the beautiful landscape of Bali.',
                'status' => 'Buka',
                'image' => 'images/events/bali_ultra_2026.png',
                'categories' => [
                    ['name' => 'Trail 25K', 'dist' => '25K', 'min' => 17, 'max' => 65, 'quota' => 100],
                    ['name' => 'Ultra 50K', 'dist' => '50K', 'min' => 20, 'max' => 55, 'quota' => 50],
                    ['name' => 'Summit 80K', 'dist' => '80K', 'min' => 21, 'max' => 50, 'quota' => 20],
                ]
            ],
            [
                'name' => 'Borobudur 10K 2026',
                'desc' => 'Run around the magnificent Borobudur Temple.',
                'status' => 'Buka',
                'image' => 'images/events/borobudur_10k_2026.png',
                'categories' => [
                    ['name' => '10K Temple Run', 'dist' => '10K', 'min' => 13, 'max' => 70, 'quota' => 200],
                ]
            ],
            [
                'name' => 'Surabaya City Run 2026',
                'desc' => 'Urban running experience in the heart of Surabaya.',
                'status' => 'Buka',
                'image' => 'images/events/surabaya_city_run_2026.png',
                'categories' => [
                    ['name' => '5K City', 'dist' => '5K', 'min' => 10, 'max' => 80, 'quota' => 300],
                    ['name' => 'Half Marathon', 'dist' => '21K', 'min' => 17, 'max' => 60, 'quota' => 150],
                ]
            ],

            // --- PAST (History) ---
            [
                'name' => 'Bandung Night Run 2025',
                'desc' => 'Lari malam menikmati kota Bandung yang sejuk.',
                'status' => 'Tutup',
                'image' => 'images/events/bandung_night_run_2025.png',
                'categories' => [
                    ['name' => '10K Night', 'dist' => '10K', 'min' => 15, 'max' => 60, 'quota' => 200],
                ]
            ],
            [
                'name' => 'Lombok Triathlon 2025',
                'desc' => 'Run, Swim, and Bike in Mandalika.',
                'status' => 'Tutup',
                'image' => 'images/events/lombok_triathlon_2025.png',
                'categories' => [
                    ['name' => 'Olympic Distance', 'dist' => '51K', 'min' => 18, 'max' => 55, 'quota' => 50],
                ]
            ],
            [
                'name' => 'Jogja Heritage Run 2024',
                'desc' => 'Running through the historic streets of Yogyakarta.',
                'status' => 'Tutup',
                'image' => 'images/events/jogja_heritage_run_2024.png',
                'categories' => [
                    ['name' => '5K Fun', 'dist' => '5K', 'min' => 10, 'max' => 75, 'quota' => 300],
                ]
            ],
            [
                'name' => 'Color Run Jakarta 2024',
                'desc' => 'The happiest 5K on the planet.',
                'status' => 'Tutup',
                'image' => 'images/events/color_run_jakarta_2024.png',
                'categories' => [
                    ['name' => '5K Color', 'dist' => '5K', 'min' => 5, 'max' => 90, 'quota' => 1000],
                ]
            ],
            [
                'name' => 'Mount Rinjani Trek 2023',
                'desc' => 'Hardcore trekking and trail running.',
                'status' => 'Tutup',
                'image' => 'images/events/mount_rinjani_trek_2023.png',
                'categories' => [
                    ['name' => '100K Ultra', 'dist' => '100K', 'min' => 21, 'max' => 50, 'quota' => 10],
                ]
            ],
            [
                'name' => 'Semarang 10K 2023',
                'desc' => 'Flat course perfect for PB.',
                'status' => 'Tutup',
                'image' => 'images/events/semarang_10k_2023.png',
                'categories' => [
                    ['name' => '10K Race', 'dist' => '10K', 'min' => 15, 'max' => 65, 'quota' => 200],
                ]
            ],
            [
                'name' => 'Makassar Half 2023',
                'desc' => 'Running along Losari Beach.',
                'status' => 'Tutup',
                'image' => 'images/events/makassar_half_2023.png',
                'categories' => [
                    ['name' => '21K Half', 'dist' => '21K', 'min' => 17, 'max' => 60, 'quota' => 150],
                ]
            ],
            [
                'name' => 'Merapi Lava Run 2022',
                'desc' => 'Adrenaline rush near the volcano.',
                'status' => 'Tutup',
                'image' => 'images/events/merapi_lava_run_2022.png',
                'categories' => [
                    ['name' => '10K Lava', 'dist' => '10K', 'min' => 18, 'max' => 55, 'quota' => 50],
                ]
            ],
            [
                'name' => 'Independence Day Run 2022',
                'desc' => 'Celebrating national independence.',
                'status' => 'Tutup',
                'image' => 'images/events/independence_day_run_2022.png',
                'categories' => [
                    ['name' => '8K Merdeka', 'dist' => '8K', 'min' => 10, 'max' => 80, 'quota' => 500],
                ]
            ],
            [
                'name' => 'Medan Heritage 2021',
                'desc' => 'Virtual run due to restrictions.',
                'status' => 'Tutup',
                'image' => 'images/events/medan_heritage_2021.png',
                'categories' => [
                    ['name' => '5K Virtual', 'dist' => '5K', 'min' => 10, 'max' => 90, 'quota' => 1000],
                ]
            ],
            [
                'name' => 'Papua PON Run 2021',
                'desc' => 'Supporting the National Sports Week.',
                'status' => 'Tutup',
                'image' => 'images/events/papua_pon_run_2021.png',
                'categories' => [
                    ['name' => '10K PON', 'dist' => '10K', 'min' => 15, 'max' => 45, 'quota' => 100],
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
                    'NomorBIB' => 'BIB-' . rand(1000, 9999), // Dummy BIB
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

        // Sarah: Registered for Jakarta 10K & Bandung 10K
        $pidSarah1 = $register('sarah_swift', 'Jakarta Marathon 2026', '10K Race', 'Selesai', true);
        $pidSarah2 = $register('sarah_swift', 'Bandung Night Run 2025', '10K Night', 'Selesai', true);

        // Andi: Registered for Bali Ultra 50K
        $pidAndi1 = $register('andi_explore', 'Bali Ultra 2026', 'Ultra 50K', 'Selesai', true); // Pretend it's finished for leaderboard stats


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

        // Sarah Results
        $addResult($pidSarah1, '00:48:00', 10); // 10K
        $addResult($pidSarah2, '00:50:00', 35); // 10K

        // Andi Results
        $addResult($pidAndi1, '04:15:00', 3); // 50K Ultra!

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
