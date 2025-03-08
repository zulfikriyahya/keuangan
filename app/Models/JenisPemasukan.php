<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPemasukan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'akun_id',
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
        'akun_id' => 'integer',
    ];

    public function pemasukan(): HasMany
    {
        return $this->hasMany(Pemasukan::class);
    }

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class);
    }
}
