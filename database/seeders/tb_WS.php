<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DaftarWS_Model;
use Carbon\Carbon;

class tb_WS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // working_date_ws,             arrival_time_ws,                finish_time_ws,  status_ws,  id_karyawan,   id_project,    id_monitoring
        $wsList = [
            [Carbon::now()->subDay(),   Carbon::now()->setTime(5, 0),   null,            'OPEN',     1,             'PRJ-24-0001', 1],
            [Carbon::now()->subDay(),   Carbon::now()->setTime(5, 0),   null,            'OPEN',     1,             'PRJ-24-0001', 1],
            [Carbon::now()->subDay(),   Carbon::now()->setTime(5, 0),   null,            'OPEN',     1,             'PRJ-24-0001', 1],
            [Carbon::now(),             Carbon::now()->setTime(5, 0),   null,            'OPEN',     1,             'PRJ-24-0001', 1],
            [Carbon::now(),             Carbon::now()->setTime(5, 0),   null,            'OPEN',     1,             'PRJ-24-0001', 1],
            [Carbon::now()->addDay(),   Carbon::now()->setTime(5, 0),   null,            'OPEN',     1,             'PRJ-24-0001', 1],
        ];
        foreach ($wsList as $ws) {
            $model = new DaftarWS_Model();
            $model->working_date_ws = $ws[0];
            $model->arrival_time_ws = $ws[1];
            $model->finish_time_ws = $ws[2];
            $model->status_ws = $ws[3];
            $model->id_karyawan = $ws[4];
            $model->id_project = $ws[5];
            $model->id_monitoring = $ws[6];
            $model->save();
        }
    }
}
