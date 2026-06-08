<?php

namespace App\Traits;

use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToCompany
{
    /**
     * Boot fungsi trait untuk mengotomatisasi query scope dan pengisian data.
     */
    protected static function bootBelongsToCompany(): void
    {
        // 1. Otomatis menyaring data berdasarkan perusahaan_id saat mengambil data (Isolasi SaaS)
        static::addGlobalScope('perusahaan_scope', function (Builder $builder) {
            if (auth()->check() && auth()->user()->perusahaan_id) {
                $builder->where('perusahaan_id', auth()->user()->perusahaan_id);
            }
        });

        // 2. Otomatis mengisi perusahaan_id saat membuat data baru
        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->perusahaan_id) {
                $model->perusahaan_id = auth()->user()->perusahaan_id;
            }
        });
    }

    /**
     * Relasi ke model Perusahaan.
     */
    public function perusahaan()
    {
        return $this->belongsTo(perusahaan::class, 'perusahaan_id');
    }
}
