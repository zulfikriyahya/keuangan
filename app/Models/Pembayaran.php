<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal',
        'jenis_pembayaran_id',
        'deskripsi',
        'periode_id',
        'nominal',
        'kwitansi',
        'status',
        'siswa_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tanggal' => 'date',
        'jenis_pembayaran_id' => 'integer',
        'periode_id' => 'integer',
        'siswa_id' => 'integer',
    ];

    public function kas(): HasMany
    {
        return $this->hasMany(Kas::class);
    }

    public function jenisPembayaran(): BelongsTo
    {
        return $this->belongsTo(JenisPembayaran::class);
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
