<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure admin role exists (assuming Role ID 1 is Admin, or match your Role Seeder)
        // For now, we'll try to find or create the Role if needed, but assuming standard implementation:
        
        $adminEmail = 'KalcerAdmin123@gmail.com';
        
        // Remove existing user if exists to prevent duplication error on re-seed
        User::where('Email', $adminEmail)->delete();

        User::create([
            'NamaLengkap' => 'Admin Kalcer',
            'Username' => 'admin_kalcer',
            'Email' => $adminEmail,
            'Password' => Hash::make('adminkk123'),
            'PeranID' => 1, // Assumes 1 is Admin Role. Adjust if your Role table is different.
        ]);
        
        $this->command->info("Admin user created: {$adminEmail}");
    }
}
