<?php

namespace Database\Seeders;

use App\Models\Monitoring_Model;
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


        // category, achieve_date,   qty,    id_ws,  id_task,    id_karyawan,    id_project
        // category, achieve_date,   qty,    id_task,    id_karyawan,    id_project
        $MonitoringList = [
            ['Category A',null, 50, 1,'PRJ-24-0001'],
            ['Category B',null, 30, 1,'PRJ-24-0001'],
            ['Category C',null, 20, 1,'PRJ-24-0001']
        ];
        foreach ($MonitoringList as $monitor) {
            $model = new Monitoring_Model();
            $model->category = $monitor[0];
            $model->achieve_date = $monitor[1];
            $model->qty = $monitor[2];
            // $model->id_ws = $monitor[3];
            // $model->id_task = $monitor[4];
            $model->id_karyawan = $monitor[3];
            $model->id_project = $monitor[4];
            $model->save();
        }

    }


}
