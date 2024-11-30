<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    protected $table = 'students';


    protected $fillable = [
        'nama',
        'email',
        'class_id',
        'nomor_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nisn',
    ];

    // Relasi: Setiap siswa berada di satu kelas (one to many inverse)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
}
