<?php

namespace Database\Seeders;

use App\Models\Projects_Model;
use Illuminate\Database\Seeder;

class tb_Projects extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  id_project,	    na_project,                 progress_project,   id_client	id_team
        $ProjectList = [
            ['PRJ-24-0001', 'Our First Project Test',   0,                  1,          1],
            ['PRJ-24-0002', 'Our Second Project Test',  0,                  1,          1],
            ['PRJ-24-0003', 'Our Third Project Test',   0,                  1,          1]
        ];
        foreach ($ProjectList as $project) {
            $model = new Projects_Model();
            $model->id_project = $project[0];
            $model->na_project = $project[1];
            $model->progress_project = $project[2];
            $model->id_client = $project[3];
            $model->id_team = $project[4];
            $model->save();
        }
    }
}
