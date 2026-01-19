<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventService
{
    /**
     * Create a new event with categories and slots.
     *
     * @param array $data
     * @return Event
     * @throws \Exception
     */
    public function createEvent(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Create Event
            $eventId = DB::table('ms_event')->insertGetId([
                'NamaEvent' => $data['name'],
                'DeskripsiEvent' => $data['description'],
                'StatusEvent' => $data['status'] ?? 'Buka', // Buka, Tutup, Sedang Berlangsung
                'GambarEvent' => $data['image_path'] ?? null,
                // 'TanggalMulai' => $data['start_date'], // If schema supports it directly
                // 'Lokasi' => $data['location'], // If schema supports it directly
            ]);

            // 2. Create Categories & Slots
            if (isset($data['categories']) && is_array($data['categories'])) {
                foreach ($data['categories'] as $cat) {
                    $catId = DB::table('ms_kategorilomba')->insertGetId([
                        'EventID' => $eventId,
                        'NamaKategori' => $cat['name'],
                        'Jarak' => $cat['distance'], // e.g., "10K"
                        'BatasUsiaMin' => $cat['min_age'] ?? 12,
                        'BatasUsiaMax' => $cat['max_age'] ?? 80,
                        'Harga' => $cat['price'] ?? 0,
                    ]);

                    // Create Slot (Assuming 1 slot per category for now, or multiple)
                    DB::table('ms_slotkategori')->insert([
                        'KategoriID' => $catId,
                        'KuotaTotal' => $cat['quota'],
                        'KuotaTersisa' => $cat['quota'],
                        'StatusEvent' => 'Aktif',
                        'TanggalMulai' => $cat['start_date'] ?? now()->addMonth(), // Default 1 month from now
                        'LokasiEvent' => $data['location'] ?? 'To Be Announced'
                    ]);
                }
            }

            return $eventId;
        });
    }

    /**
     * Verify a registration payment.
     *
     * @param int $registrationId
     * @param string $status 'Terverifikasi' or 'Pendaftaran Ditolak'
     * @param string|null $notes
     * @return bool
     */
    public function verifyRegistration($registrationId, $status, $notes = null)
    {
        try {
            DB::transaction(function () use ($registrationId, $status, $notes) {
                // Update Registration Status
                DB::table('tr_pendaftaran')
                    ->where('PendaftaranID', $registrationId)
                    ->update(['StatusPendaftaran' => $status]);

                // Update Payment Status if it exists
                if ($status == 'Terverifikasi') {
                    DB::table('tr_pembayaran')
                        ->where('PendaftaranID', $registrationId)
                        ->update(['StatusPembayaran' => 'Lunas']);
                    
                    // Here you would trigger email notification (e.g., Mail::to($user)->send(...))
                } elseif ($status == 'Pendaftaran Ditolak') {
                    DB::table('tr_pembayaran')
                        ->where('PendaftaranID', $registrationId)
                        ->update(['StatusPembayaran' => 'Gagal']);
                }
            });
            return true;
        } catch (\Exception $e) {
            Log::error("Verification failed: " . $e->getMessage());
            return false;
        }
    }
}
