<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';

    protected $fillable = [
        'nama',
        'slug',
        'alamat',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'perusahaan_id');
    }
}
