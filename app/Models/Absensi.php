<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absen';
    protected $fillable = [
        'user_id', 'tanggal', 'jam_masuk', 'jam_keluar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

