<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects_Model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_projects'; // Replace with the actual table name
    protected $primaryKey = 'id_project';
    public $incrementing = false;   // Manually input id_project tr input field

    protected $fillable = [
        'id_project', 'na_project' , 'id_client', 'id_team'
    ];

    protected $dates = ['deleted_at']; // Specify the column for soft deletes




    public function client()
    {
        return $this->belongsTo(Kustomer_Model::class, 'id_client');
    }
    public function team()
    {
        return $this->belongsTo(Team_Model::class, 'id_team');
    }

    public function monitor()
    {
        return $this->belongsTo(Monitoring_Model::class, 'id_project');
    }

    public function dailyws()
    {
        return $this->belongsTo(DaftarDWS_Model::class, 'id_project', 'id_project');
    }
}

