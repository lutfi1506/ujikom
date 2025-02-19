<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Produk::factory(10)->create();
        User::factory()->create([
            'nama_lengkap' => 'Test User',
            'email' => 'test@example.com',
            'level' => 'admin'
        ]);
        Pelanggan::factory()->create([
            'nama' => 'umum',
            'alamat' => 'umum',
            'no_telp' => '088877776666'
        ]);
    }
}
