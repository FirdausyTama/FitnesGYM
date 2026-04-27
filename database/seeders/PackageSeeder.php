<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::truncate();

        // Membership
        Package::create([
            'name' => '1 Bulan',
            'category' => 'membership',
            'price' => 150000,
            'description' => "Akses Gym 24/7\nQR Member Digital\nLoker & Kamar Mandi\nBelum Termasuk Registrasi",
            'is_best_deal' => false,
        ]);

        Package::create([
            'name' => '3 Bulan',
            'category' => 'membership',
            'price' => 400000,
            'description' => "Akses Gym 24/7\nQR Member Digital\nLoker & Kamar Mandi\nTermasuk Biaya Registrasi",
            'is_best_deal' => true,
            'badge_text' => 'Best Deal',
        ]);

        Package::create([
            'name' => '6 Bulan',
            'category' => 'membership',
            'price' => 750000,
            'description' => "Akses Gym 24/7\nQR Member Digital\nLoker & Kamar Mandi\nTermasuk Biaya Registrasi",
            'is_best_deal' => false,
        ]);

        // Personal Trainer
        Package::create([
            'name' => '5x Pertemuan',
            'category' => 'pt',
            'price' => 1000000,
            'description' => "Privat Coaching Ahli\nSudah Termasuk Member\nSudah Termasuk Registrasi\nRencana Latihan Custom",
            'is_best_deal' => false,
        ]);

        Package::create([
            'name' => '7x Pertemuan',
            'category' => 'pt',
            'price' => 1500000,
            'description' => "Privat Coaching Ahli\nSudah Termasuk Member\nSudah Termasuk Registrasi\nRencana Latihan Custom",
            'is_best_deal' => false,
        ]);

        Package::create([
            'name' => '13x Pertemuan',
            'category' => 'pt',
            'price' => 2000000,
            'description' => "Privat Coaching Ahli\nSudah Termasuk Member\nSudah Termasuk Registrasi\nRencana Latihan Custom",
            'is_best_deal' => false,
        ]);
    }
}
