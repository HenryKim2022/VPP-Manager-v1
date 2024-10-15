<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarDWS_Model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_daily_ws'; // Replace with the actual table name
    protected $primaryKey = 'id_dws';

    protected $fillable = [
        'descb_dws' , 'arrival_time_dws', 'finish_time_dws', 'progress_actual_dws', 'progress_current_dws', 'id_project', 'id_monitoring'
    ];

    protected $dates = ['deleted_at']; // Specify the column for soft deletes


    public function project()
    {
        return $this->belongsTo(Projects_Model::class, 'id_project');
    }

    public function monitoring()
    {
        return $this->belongsTo(Monitoring_Model::class, 'id_monitoring');
    }
}
