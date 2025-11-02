<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Support\Facades\Hash;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $staff = User::firstOrCreate(
            ['email' => 'staff@edu.com'],
            ['name' => 'Admin Staff', 'password' => Hash::make('password'), 'role' => 'staff']
        );
        $vendor = User::firstOrCreate(
            ['email' => 'vendor@edu.com'],
            ['name' => 'Vendor A', 'password' => Hash::make('password'), 'role' => 'vendor']
        );
        $kepsek = User::firstOrCreate(
            ['email' => 'kepsek@edu.com'],
            ['name' => 'Kepala Sekolah', 'password' => Hash::make('password'), 'role' => 'kepala_sekolah']
        );

        Barang::firstOrCreate([
            'user_id' => $vendor->id,
            'kode_barang' => 'LAB-001'
        ], [
            'nama_barang' => 'Mikroskop Siswa',
            'harga' => 2500000,
            'nama_rekening' => 'PT Vendor A',
            'no_rekening' => '1234567890'
        ]);
        Barang::firstOrCreate([
            'user_id' => $vendor->id,
            'kode_barang' => 'LAB-002'
        ], [
            'nama_barang' => 'Bunsen Burner',
            'harga' => 650000,
            'nama_rekening' => 'PT Vendor A',
            'no_rekening' => '1234567890'
        ]);
        Barang::firstOrCreate([
            'user_id' => $vendor->id,
            'kode_barang' => 'LAB-003'
        ], [
            'nama_barang' => 'Pipet Set',
            'harga' => 300000,
            'nama_rekening' => 'PT Vendor A',
            'no_rekening' => '1234567890'
        ]);
    }
}
