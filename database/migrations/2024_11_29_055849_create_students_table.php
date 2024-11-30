<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('class', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas')->unique();
            $table->string('kode_kelas')->unique();
            $table->integer('jumlah_murid')->nullable();
            $table->integer('jumlah_guru')->nullable();
            $table->timestamps();
        });

        // Membuat tabel students
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->foreignId('class_id')->nullable()->constrained('class')->onDelete('restrict');
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('nisn')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
