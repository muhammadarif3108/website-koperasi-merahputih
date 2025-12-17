<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Koperasi',
            'email' => 'admin@koperasi.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Koperasi No. 1',
        ]);

        // Create Member Demo
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@member.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone' => '081234567891',
            'address' => 'Jl. Anggota No. 1',
            'saldo_simpanan' => 500000,
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@member.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone' => '081234567892',
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
    }
}
