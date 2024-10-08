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
        'id_project', 'na_project' , 'progress_project', 'id_client', 'id_team'
    ];

    protected $dates = ['deleted_at']; // Specify the column for soft deletes


    public function team()
    {
        return $this->belongsTo(Team_Model::class, 'id_team');
    }
}

