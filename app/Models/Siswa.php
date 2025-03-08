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
        'nisn',
        'nik',
        'diterima_tanggal',
        'mutasi_tanggal',
        'do_tanggal',
        'lulus_tanggal',
        'kelas_id',
        'status',
        'foto',
        'alamat',
        'nama_ibu',
        'nama_ayah',
        'jenis_kelamin',
        'telepon',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'diterima_tanggal' => 'date',
        'mutasi_tanggal' => 'date',
        'do_tanggal' => 'date',
        'lulus_tanggal' => 'date',
        'kelas_id' => 'integer',
    ];

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }


    public function jurusan()
    {
        return $this->hasOneThrough(Jurusan::class, Kelas::class, 'id', 'id', 'kelas_id', 'jurusan_id');
    }

    public function jenisPembayaran()
    {
        return $this->hasManyThrough(
            JenisPembayaran::class,
            Jurusan::class,
            'id',
            'jurusan_id',
            'jurusan_id',
            'id'
        );
    }
}
