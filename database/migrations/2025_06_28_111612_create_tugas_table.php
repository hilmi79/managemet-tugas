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
    Schema::create('tugas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi')->nullable();
        $table->timestamp('deadline')->nullable();
        $table->string('file_tugas')->nullable();
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        $table->foreignId('matakuliah_id')->nullable()->constrained('matakuliah')->onDelete('set null');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
