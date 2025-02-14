<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model {
    use HasFactory;
    protected $table = 'izin';
    protected $fillable = ['pengguna_id', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'status'];

    public function pengguna() {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
}
