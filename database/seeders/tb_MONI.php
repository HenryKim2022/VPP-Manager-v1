<?php

namespace Database\Seeders;

use App\Models\Monitoring_Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tb_MONI extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  NOTE:
        //      'update_progress %'  -> milik dws, ini cuma view ditabel moni, main di query / program
        //      'total_progress %'   -> hasil dari progress QTY * UPDT / 100%, jadi main di query / program
        //      'id_karyawan'        -> sbg PK/ SPV


        //  'task',                                     'start_date', 'end_date',  'achieve_date',  'qty %',  'id_karyawan',  'id_project'
        $MonitoringList = [
            ['Finishing pekerjaan pengelasan',          '2024-01-01', '2024-01-04', null,           50,       2,                1],
            ['Menambahkan module PLC pd ruang server',  '2024-01-05', '2024-01-07', null,           30,       2,                1],
            ['Memindahkan ruang dan waktu',             '2024-01-08', '2024-01-10', null,           20,       2,                1]
        ];
        foreach ($MonitoringList as $monitor) {
            $model = new Monitoring_Model();
            $model->task = $monitor[0];
            $model->start_date = $monitor[1];
            $model->end_date = $monitor[2];
            $model->achieve_date = $monitor[3];
            $model->qty = $monitor[4];
            $model->id_karyawan = $monitor[5];
            $model->id_project = $monitor[6];
            $model->save();
        }

    }


}