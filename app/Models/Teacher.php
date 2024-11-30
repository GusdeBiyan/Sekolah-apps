<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $table = 'teachers';


    protected $fillable = [
        'nama',
        'email',
        'class_id',
        'mata_pelajaran',
        'nomor_telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'status',
        'nip',
    ];

    // Relasi: Setiap siswa berada di satu kelas (one to many inverse)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
}
