<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_statuses';

    protected $fillable = [
        'pengajuan_id',
        'user_id',
        'status',
        'catatan',
        'tanggal_status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_status' => 'datetime',
        ];
    }

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
