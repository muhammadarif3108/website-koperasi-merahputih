<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Equipment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Koperasi',
            'email' => 'admin@koperasi.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Koperasi No. 1',
        ]);

        // Create Member Demo
        User::create([
            'name' => 'Muhammad Arif',
            'email' => 'arif@koperasi.com',
            'password' => Hash::make('arif123'),
            'role' => 'member',
            'phone' => '081333583159',
            'address' => 'Ds. Rejotengah, Dsn. Kebontengah, Kec. Deket, Kab. Lamongan',
            'saldo_simpanan' => 500000,
        ]);

        User::create([
            'name' => 'Syamsa Al Hadi',
            'email' => 'syamsa@koperasi.com',
            'password' => Hash::make('syamsa123'),
            'role' => 'member',
            'phone' => '081234567890',
            'address' => 'Jl. Anggota No. 2',
            'saldo_simpanan' => 750000,
        ]);

        // Create Sample Products
        Product::create([
            'name' => 'Beras Premium 5kg',
            'description' => 'Beras berkualitas tinggi pilihan dari petani lokal',
            'price' => 75000,
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Minyak Goreng 2L',
            'description' => 'Minyak goreng kemasan 2 liter',
            'price' => 35000,
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Gula Pasir 1kg',
            'description' => 'Gula pasir putih berkualitas',
            'price' => 15000,
            'stock' => 80,
        ]);

        Product::create([
            'name' => 'Telur Ayam 1kg',
            'description' => 'Telur ayam segar isi 15 butir',
            'price' => 28000,
            'stock' => 60,
        ]);

        Product::create([
            'name' => 'Tepung Terigu 1kg',
            'description' => 'Tepung terigu protein sedang',
            'price' => 12000,
            'stock' => 70,
        ]);

        // Create Sample Equipment
        Equipment::create([
            'name' => 'Traktor Kubota L3408',
            'description' => 'Traktor pertanian 4WD dengan tenaga 34 HP',
            'price_per_day' => 250000,
            'stock' => 2,
            'category' => 'traktor',
        ]);

        Equipment::create([
            'name' => 'Mesin Panen Padi Quick G600',
            'description' => 'Mesin combine harvester untuk panen padi',
            'price_per_day' => 500000,
            'stock' => 1,
            'category' => 'mesin_panen',
        ]);

        Equipment::create([
            'name' => 'Pompa Air Diesel 3 Inch',
            'description' => 'Pompa air untuk irigasi sawah',
            'price_per_day' => 100000,
            'stock' => 3,
            'category' => 'pompa_air',
        ]);

        Equipment::create([
            'name' => 'Sprayer Knapsack 16L',
            'description' => 'Alat semprot pestisida portable',
            'price_per_day' => 25000,
            'stock' => 5,
            'category' => 'sprayer',
        ]);
    }
}
