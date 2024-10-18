<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DaftarTask_Model;

class tb_TASK extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // start_time_task, descb_task, progress_actual_task, progress_current_task, id_ws, id_projects, id_monitoring
        $taskList = [
            [now()->subDay(),        "AAA",             null,            null,     1,  'PRJ-24-0001', 1],
            [now()->subDay(),        "BBB",             null,            null,     1,  'PRJ-24-0001', 2],
            [now()->subDay(),        "CCC",             null,            null,     1,  'PRJ-24-0001', 3],
            [now(),                  "DDD",             null,            null,     4,  'PRJ-24-0001', 2],
            [now(),                  "EEE",             null,            null,     4,  'PRJ-24-0001', 2],
            [now()->addDay(),        "GGG",             null,            null,     6,  'PRJ-24-0001', 3],
        ];
        foreach ($taskList as $task) {
            $model = new DaftarTask_Model();
            $model->start_time_task = $task[0];
            $model->descb_task = $task[1];
            $model->progress_actual_task = $task[2];
            $model->progress_current_task = $task[3];
            $model->id_ws = $task[4];
            $model->id_project = $task[5];
            $model->id_monitoring = $task[6];
            $model->save();
        }
    }
}
