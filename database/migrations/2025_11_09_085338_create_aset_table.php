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
        Schema::create('aset', function (Blueprint $table) {
            $table->id('aset_id');
            $table->foreignId('kategori_id')->constrained('kategori', 'kategori_id')->onDelete('cascade');
            $table->string('kode_aset', 50)->unique();
            $table->string('nama_aset', 255);
            $table->date('tgl_perolehan');
            $table->decimal('nilai_perolehan', 15, 2);
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat']);
            $table->string('foto_aset')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};