<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DaftarWS_Model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_worksheet';
    protected $primaryKey = 'id_ws';
    protected $fillable = ['working_date_ws','arrival_time_ws','finish_time_ws','status_ws','id_karyawan', 'id_project', 'id_monitoring'];


    public function karyawan()
    {
        return $this->belongsTo(Karyawan_Model::class, 'id_karyawan');
    }

    public function project()
    {
        return $this->belongsTo(Projects_Model::class, 'id_project', 'id_project');
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

    public function task()
    {
        return $this->hasMany(DaftarTask_Model::class, 'id_ws', 'id_ws');
    }


    public function monitoring()
    {
        return $this->belongsTo(Monitoring_Model::class, 'id_monitoring', 'id_monitoring');
    }


    // public function monitoring()
    // {
    //     return $this->hasMany(Monitoring_Model::class, 'id_project', 'id_project');
    // }




    public function executedby()
    {
        return $this->belongsTo(Karyawan_Model::class, 'id_karyawan');
    }



}
