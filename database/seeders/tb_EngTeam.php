<?php

namespace Database\Seeders;

use App\Models\Team_Model;
use Illuminate\Database\Seeder;

class tb_EngTeam extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamList = [
            ['Team A', 1],
            ['Team B', 2],
            ['Team C', null]
        ];
        foreach ($teamList as $team) {
            $model = new Team_Model();
            $model->na_team = $team[0];
            $model->id_karyawan = $team[1];
            $model->save();
        }
    }
}