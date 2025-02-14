<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinPeserta extends Model {
    use HasFactory;
    protected $table = 'izin_peserta';
    protected $fillable = ['user_id', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'status'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
