<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Monitoring_Model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_monitoring';
    protected $primaryKey = 'id_monitoring';
    protected $fillable = ['task','start_date','end_date','achieve_date','qty','id_karyawan','id_project'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan_Model::class, 'id_karyawan', 'id_karyawan');
    }

    public function project()
    {
        return $this->belongsTo(Projects_Model::class, 'id_project', 'id_project');
    }

    // public function dailyws()
    // {
    //     return $this->belongsTo(DaftarDWS_Model::class, 'id_project', 'id_project');
    // }

    public function dailyws()
    {
        return $this->hasMany(DaftarDWS_Model::class, 'id_monitoring');
    }

}
