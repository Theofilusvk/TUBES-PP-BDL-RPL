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
                'categories' => [
                    ['name' => 'Trail 25K', 'dist' => '25K', 'min' => 17, 'max' => 65, 'quota' => 50],
                    ['name' => 'Ultra 50K', 'dist' => '50K', 'min' => 20, 'max' => 50, 'quota' => 30],
                ]
            ],
            [
                'name' => 'Bandung Night Run 2025',
                'desc' => 'Lari malam menikmati kota Bandung.',
                'status' => 'Tutup', // Past Event
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
                    'StatusEvent' => $evtData['status']
                ]);
            } else {
                $eid = $evt->EventID;
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
        };

        // Budi: Registered and Paid for Jakarta Marathon 5K
        $register('budi_runner', 'Jakarta Marathon 2026', '5K Fun Run', 'Terverifikasi', true);
        
        // Budi: Register for Bali Ultra (Pending)
        $register('budi_runner', 'Bali Ultra 2026', 'Trail 25K', 'Menunggu Pembayaran', false);

        // Siti: Registered for Jakarta 10K (Paid)
        $register('siti_lari', 'Jakarta Marathon 2026', '10K Race', 'Terverifikasi', true);

        // Joko: Registered for Past Event (Bandung)
        $register('joko_speed', 'Bandung Night Run 2025', '10K Night', 'Selesai', true);
    }
}
