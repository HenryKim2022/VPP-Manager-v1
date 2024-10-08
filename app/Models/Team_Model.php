<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Team_Model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_eng_team'; // Replace with the actual table name
    protected $primaryKey = 'id_team';

    protected $fillable = [
        'id_team', 'na_team', 'id_karyawan'
    ];

    protected $dates = ['deleted_at']; // Specify the column for soft deletes


    public function karyawan()
    {
        return $this->belongsTo(Karyawan_Model::class, 'id_karyawan');
    }

}
