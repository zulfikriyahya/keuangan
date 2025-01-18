<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akun extends Model
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
        'deskripsi',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function jenisPembayaran(): HasMany
    {
        return $this->hasMany(JenisPembayaran::class);
    }

    public function jenisPemasukan(): HasMany
    {
        return $this->hasMany(JenisPemasukan::class);
    }

    public function jenisPengeluaran(): HasMany
    {
        return $this->hasMany(JenisPengeluaran::class);
    }
}
