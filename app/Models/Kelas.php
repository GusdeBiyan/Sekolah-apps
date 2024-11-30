<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = [
        'nama_kelas',
        'kode_kelas',
        'jumlah_murid',
        'kapasitas',
    ];


    public function teacher()
    {
        return $this->hasMany(Teacher::class, 'class_id');
    }


    public function student()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
