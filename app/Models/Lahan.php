<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lahan extends Model
{
    use HasFactory;

    protected $table = 'lahans';

    protected $fillable = [
        'kode_lahan',
        'nama_lahan',
        'alamat',
        'kota',
        'luas',
        'latitude',
        'longitude',
        'status',
        'deskripsi',
    ];

    public function pengajuans(): HasMany
    {
        return $this->hasMany(Pengajuan::class);
    }
}
