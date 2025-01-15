<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'kode',
        'tanggal',
        'tahun_id',
        'bulan_id',
        'nominal',
        'kwitansi',
        'jenis_pengeluaran_id',
        'deskripsi',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tanggal' => 'date',
        'bulan_id' => 'integer',
        'tahun_id' => 'integer',
        'jenis_pengeluaran_id' => 'integer',
    ];

    public function tahun(): BelongsTo
    {
        return $this->belongsTo(Tahun::class);
    }

    public function bulan(): BelongsTo
    {
        return $this->belongsTo(Bulan::class);
    }

    public function jenisPengeluaran(): BelongsTo
    {
        return $this->belongsTo(JenisPengeluaran::class);
    }
}
