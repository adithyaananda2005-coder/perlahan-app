<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('lahan_id')->index();
            $table->string('nama_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->date('tanggal_pengajuan');
            $table->string('status_pengajuan')->default('diajukan');
            $table->text('alasan_penolakan')->nullable();
            $table->string('dokumen_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
