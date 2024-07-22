<?php

namespace Database\Seeders;

use App\Models\Karyawan_Model;
use Illuminate\Database\Seeder;

class tb_KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawanList = [
            [
                'na_karyawan' => 'Hendri',
                'tlah_karyawan' => 'Toboali',
                'tglah_karyawan' => '1998-10-26',
                'agama_karyawan' => 'Buddha',
                'alamat_karyawan' => 'JL. Jend Sudirman',
                'notelp_karyawan' => '+6282281190072',
                'foto_karyawan' => null
            ],
            [
                'na_karyawan' => 'Jane Smith',
                'tlah_karyawan' => 'Town',
                'tglah_karyawan' => '1992-05-10',
                'agama_karyawan' => 'Kristen',
                'alamat_karyawan' => '456 Elm St',
                'notelp_karyawan' => '987654321',
                'foto_karyawan' => null
            ],
        ]; // Example karyawan values

        foreach ($karyawanList as $karyawan) {
            Karyawan_Model::create($karyawan);
        }
    }
}
