<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Services\EventService;

class DummyDataSeeder extends Seeder
{
    protected $eventService;

    public function __construct() {
        $this->eventService = new EventService();
    }

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
        $cities = [
            'budi_runner' => 'Jakarta',
            'sarah_swift' => 'Jakarta',
            'andi_explore' => 'Bandung',
            'joko_speed' => 'Bandung',
            'siti_lari' => 'Surabaya',
        ];

        foreach ($users as $user) {
            $exists = DB::table('tr_pengguna')->where('Email', $user['Email'])->first();
            
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

        // 2. Events & Categories using EventService
        // Clear existing events to avoid duplicates during seeding dev cycle (Optional)
        // DB::table('ms_event')->truncate(); 
        // DB::table('ms_kategorilomba')->truncate();
        // DB::table('ms_slotkategori')->truncate();
        
        // Only insert if empty to be safe, or check existence by name
        
        $eventsData = [
            // --- UPCOMING ---
            [
                'name' => 'Jakarta Marathon 2026',
                'description' => 'The biggest marathon in Indonesia, traversing iconic landmarks.',
                'status' => 'Buka',
                'image_path' => 'images/events/jakarta_marathon_2026.png',
                'location' => 'Monas, Jakarta',
                'categories' => [
                    ['name' => '5K Fun Run', 'distance' => '5K', 'min_age' => 12, 'max_age' => 70, 'quota' => 500, 'price' => 150000, 'start_date' => '2026-01-19 06:00:00'],
                    ['name' => '10K Race', 'distance' => '10K', 'min_age' => 15, 'max_age' => 65, 'quota' => 300, 'price' => 250000, 'start_date' => '2026-01-19 05:30:00'],
                    ['name' => 'Full Marathon', 'distance' => '42K', 'min_age' => 18, 'max_age' => 60, 'quota' => 100, 'price' => 500000, 'start_date' => '2026-01-19 04:30:00'],
                ]
            ],
            [
                'name' => 'Bali Ultra 2026',
                'description' => 'Extreme trail running across the beautiful landscape of Bali.',
                'status' => 'Buka',
                'image_path' => 'images/events/bali_ultra_2026.png',
                'location' => 'Kintamani, Bali',
                'categories' => [
                    ['name' => 'Trail 25K', 'distance' => '25K', 'min_age' => 17, 'max_age' => 65, 'quota' => 100, 'price' => 350000, 'start_date' => '2026-01-19 05:00:00'],
                    ['name' => 'Ultra 50K', 'distance' => '50K', 'min_age' => 20, 'max_age' => 55, 'quota' => 50, 'price' => 750000, 'start_date' => '2026-01-19 04:00:00'],
                    ['name' => 'Summit 80K', 'distance' => '80K', 'min_age' => 21, 'max_age' => 50, 'quota' => 20, 'price' => 1000000, 'start_date' => '2026-01-19 03:00:00'],
                ]
            ],
             [
                'name' => 'Bandung Marathon 2026',
                'description' => 'Event lari tahunan terbesar di Kota Kembang Bandung.',
                'status' => 'Buka',
                'image_path' => null, // Intentionally null or placeholder if needed
                'location' => 'Gedung Sate, Bandung',
                'categories' => [
                    ['name' => '5K Fun Run', 'distance' => '5K', 'min_age' => 12, 'max_age' => 70, 'quota' => 500, 'price' => 150000, 'start_date' => '2026-01-19 06:00:00'],
                    ['name' => '10K Race', 'distance' => '10K', 'min_age' => 15, 'max_age' => 65, 'quota' => 300, 'price' => 250000, 'start_date' => '2026-01-19 05:30:00'],
                ]
            ],
            [
                'name' => 'Borobudur 10K 2026',
                'description' => 'Run around the magnificent Borobudur Temple.',
                'status' => 'Buka',
                'image_path' => 'images/events/borobudur_10k_2026.png',
                'location' => 'Magelang, Jawa Tengah',
                'categories' => [
                    ['name' => '10K Temple Run', 'distance' => '10K', 'min_age' => 13, 'max_age' => 70, 'quota' => 200, 'price' => 200000, 'start_date' => '2026-01-19 06:00:00'],
                ]
            ],
            [
                'name' => 'Surabaya City Run 2026',
                'description' => 'Urban running experience in the heart of Surabaya.',
                'status' => 'Buka',
                'image_path' => 'images/events/surabaya_city_run_2026.png',
                'location' => 'Balai Kota Surabaya',
                'categories' => [
                    ['name' => '5K City', 'distance' => '5K', 'min_age' => 10, 'max_age' => 80, 'quota' => 300, 'price' => 100000, 'start_date' => '2026-01-19 06:00:00'],
                    ['name' => 'Half Marathon', 'distance' => '21K', 'min_age' => 17, 'max_age' => 60, 'quota' => 150, 'price' => 300000, 'start_date' => '2026-01-19 05:00:00'],
                ]
            ],

            // --- PAST (History) ---
            [
                'name' => 'Bandung Night Run 2025',
                'description' => 'Lari malam menikmati kota Bandung yang sejuk.',
                'status' => 'Tutup',
                'image_path' => 'images/events/bandung_night_run_2025.png',
                'location' => 'Jl. Braga, Bandung',
                'categories' => [
                    ['name' => '10K Night', 'distance' => '10K', 'min_age' => 15, 'max_age' => 60, 'quota' => 200, 'price' => 200000, 'start_date' => '2025-11-15 19:00:00'],
                ]
            ],
        ];

        // Drop broken trigger constraint if it exists (legacy issue)
        DB::unprepared("DROP TRIGGER IF EXISTS trg_validasi_pendaftaran_umur");

        $eventIds = [];
        $categoryIds = [];

        foreach ($eventsData as $data) {
            $evt = DB::table('ms_event')->where('NamaEvent', $data['name'])->first();
            if (!$evt) {
                // Use Service to Create
                $eid = $this->eventService->createEvent($data);
            } else {
                $eid = $evt->EventID;
                // Update Image if changed
                DB::table('ms_event')->where('EventID', $eid)->update([
                    'GambarEvent' => $data['image_path'] ?? null
                ]);
            }
            $eventIds[$data['name']] = $eid;
            
            // Re-fetch categories to map IDs (since createEvent insert them)
            $cats = DB::table('ms_kategorilomba')->where('EventID', $eid)->get();
            foreach($cats as $cat) {
                $key = $data['name'] . '-' . $cat->NamaKategori;
                $categoryIds[$key] = $cat->KategoriID;
            }
        }
        
        // 3. Registrations & Payments
        // ... (Keep existing registration logic, mapping names to IDs)
         $register = function($username, $eventName, $catName, $status, $paid = false) use ($userIds, $categoryIds) {
            if (!isset($userIds[$username])) return;
            $catKey = $eventName . '-' . $catName;
            
            // Debug if missing
            if (!isset($categoryIds[$catKey])) {
                // echo "Warning: Category $catKey not found for registration seeding.\n";
                return;
            }

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
        $pid2 = $register('budi_runner', 'Bali Ultra 2026', 'Trail 25K', 'Menunggu Pembayaran', false);
        $pid3 = $register('siti_lari', 'Jakarta Marathon 2026', '10K Race', 'Terverifikasi', true);
        $pid4 = $register('joko_speed', 'Bandung Night Run 2025', '10K Night', 'Selesai', true);
        $pid5 = $register('budi_runner', 'Bandung Night Run 2025', '10K Night', 'Selesai', true);
        $pidSarah1 = $register('sarah_swift', 'Jakarta Marathon 2026', '10K Race', 'Selesai', true);
        $pidSarah2 = $register('sarah_swift', 'Bandung Night Run 2025', '10K Night', 'Selesai', true);
        $pidAndi1 = $register('andi_explore', 'Bali Ultra 2026', 'Ultra 50K', 'Selesai', true);

         // 5. Results (tr_hasillomba)
        $addResult = function($pid, $time, $rank) {
            if (!$pid) return;
            DB::table('tr_hasillomba')->updateOrInsert(
                ['PendaftaranID' => $pid],
                ['WaktuFinish' => $time, 'PeringkatUmum' => $rank, 'StatusHasil' => 'Finish']
            );
        };

        $addResult($pid1, '00:25:00', 45);
        $addResult($pid5, '00:55:00', 120);
        $addResult($pid4, '00:40:00', 15);
        $addResult($pidSarah1, '00:48:00', 10);
        $addResult($pidSarah2, '00:50:00', 35);
        $addResult($pidAndi1, '04:15:00', 3);

        // 4. Populate total_distances
        $distances = [
            'budi_runner' => 30.0, 
            'siti_lari' => 10.0, 
            'joko_speed' => 10.0, 
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
