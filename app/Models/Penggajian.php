<?php

namespace App\Models;

use App\Traits\BelongsToCompany;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use BelongsToCompany;

    protected $table = 'penggajian';

    protected $fillable = [
        'perusahaan_id',
        'user_id',
        'bulan_tahun',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'gaji_bersih',
        'status_pembayaran',
    ];
}
