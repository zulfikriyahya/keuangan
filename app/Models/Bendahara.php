<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bendahara extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'foto',
        'nip',
        'periode_awal',
        'periode_akhir',
        'status',
        'tte',
        'telepon',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'periode_awal' => 'date',
        'periode_akhir' => 'date',
    ];

    public function instansi(): HasMany
    {
        return $this->hasMany(Instansi::class);
    }
}
