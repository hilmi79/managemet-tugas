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
   Schema::create('pengumpulan_tugas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tugas_id')->constrained('tugas')->onDelete('cascade');
    $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
    $table->string('file_jawaban');
    $table->string('file_original')->nullable();
    $table->integer('nilai')->nullable();
    $table->text('komentar')->nullable();
    $table->timestamps();
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
