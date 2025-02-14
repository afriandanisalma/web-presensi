<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi'; // Nama tabel baru
    protected $fillable = ['siswa_id', 'date', 'status'];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class , 'siswa_id','id');
    }
}
