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
        'working_time_dws', 'descb_dws' , 'arrival_time_dws', 'finish_time_dws', 'progress_actual_dws', 'progress_current_dws', 'id_karyawan', 'id_project', 'id_monitoring'
    ];

    protected $dates = ['deleted_at']; // Specify the column for soft deletes


    public function project()
    {
        return $this->belongsTo(Projects_Model::class, 'id_project');
    }


    public function getClientData()
    {
        // Check if the project relationship is loaded
        if ($this->relationLoaded('project')) {
            $client = $this->project->client;
            return $client;
        }
        return null;
    }

    public function monitoring()
    {
        return $this->belongsTo(Monitoring_Model::class, 'id_monitoring');
    }



    public function executedby()
    {
        return $this->belongsTo(Karyawan_Model::class, 'id_karyawan');
    }



}
