<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'diterima_tanggal',
        'diterima_dikelas',
        'kelas_tahun_id',
        'status',
        'foto',
        'alamat',
        'nama_ibu',
        'nama_ayah',
        'telepon',
        'kelas_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'diterima_tanggal' => 'date',
        'diterima_dikelas' => 'integer',
        'kelas_tahun_id' => 'array',
        'kelas_id' => 'integer',
    ];

    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function kelasTahun(): BelongsTo
    {
        return $this->belongsTo(KelasTahun::class);
    }

    public function diterimaDikelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
}
