<?php

namespace App\Models;

use App\Traits\BelongsToCompany;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use BelongsToCompany; // Aktifkan satpam multi-tenancy otomatis

    protected $fillable = [
        'perusahaan_id',
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'latitude_masuk',
        'longtitude_keluar',
        'status'
    ];
}
