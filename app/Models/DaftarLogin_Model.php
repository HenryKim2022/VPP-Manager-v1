<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;


class DaftarLogin_Model extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_daftar_login';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username',
        'email',
        'password',
        'type',
        'id_karyawan',
    ];
    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
        'type' => 'integer', // Cast the 'type' attribute to integer
    ];


    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["Guest", "Super Admin", "Admin", "Karyawan"][$value],
        );
    }

    public function convertUserTypeBack($type2Convert)
    {
        $typeValueList = ['Guest', 'Super Admin', 'Admin', 'Karyawan'];
        $typeIndex = array_search($type2Convert, $typeValueList);
        $convertedUserType = $typeIndex !== false ? $typeIndex : null;
        return $convertedUserType;
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan_Model::class, 'id_karyawan');
    }

}
