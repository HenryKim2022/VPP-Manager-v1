<?php

namespace Database\Seeders;

use App\Models\Kustomer_Model;
use Illuminate\Database\Seeder;

class tb_ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientList = [
            [
                'na_client' => 'PT. INOAC',
                'alamat_client' => 'JL. Jend Sudirman',
                'notelp_client' => '+621111111',
                'foto_client' => null
            ],
        ]; // Example client values

        foreach ($clientList as $client) {
            Kustomer_Model::create($client);
        }
    }
}