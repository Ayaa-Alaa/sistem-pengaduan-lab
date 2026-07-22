<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $fillable = [
        'user_id', 'judul', 'deskripsi', 'kategori',
        'prioritas', 'status', 'foto', 'catatan_admin',
        'handled_by', 'resolved_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending'   => 'warning',
            'diproses'  => 'info',
            'selesai'   => 'success',
            'ditolak'   => 'danger',
        };
    }
}