<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'pesertas'; // Nama tabel dalam database

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_hp',
    ];
}
