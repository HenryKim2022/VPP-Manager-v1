<?php

namespace Database\Seeders;

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

        // $this->call(tb_SettingsSeeder::class);
        $this->call(tb_KaryawanSeeder::class);
        $this->call(tb_EngTeam::class);
        $this->call(tb_ClientSeeder::class);
        $this->call(tb_Projects::class);
        $this->call(tb_JabatanSeeder::class);
        $this->call(tb_DaftarLoginSeeder::class);
    }
}
