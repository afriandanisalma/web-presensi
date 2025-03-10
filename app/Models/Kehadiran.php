<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran'; 
    protected $fillable = [
        'user_id', 'tanggal', 'waktu_masuk', 'waktu_keluar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

