<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DaftarTask_Model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_task';
    protected $primaryKey = 'id_task';
    protected $fillable = ['start_time_task', 'descb_task', 'progress_actual_task','progress_current_task','id_ws', 'id_project', 'id_monitoring'];


    public function worksheet()
    {
        return $this->belongsTo(DaftarWS_Model::class, 'id_ws');
    }

    public function project()
    {
        return $this->belongsTo(Projects_Model::class, 'id_project');
    }


    // public function category()
    // {
    //     return $this->belongsTo(Monitoring_Model::class, 'id_project');
    // }


    public function monitor()
    {
        return $this->belongsTo(Monitoring_Model::class, 'id_monitoring', 'id_monitoring');
    }





}
