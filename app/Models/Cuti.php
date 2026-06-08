<?php

namespace App\Models;

use App\Traits\BelongsToCompany;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use BelongsToCompany;

    protected $table = 'cuti';

    protected $fillable = [
        'perusahaan_id',
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status',
    ];
}
