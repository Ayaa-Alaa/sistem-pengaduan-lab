<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('kategori', ['hardware','software','jaringan','fasilitas','lainnya']);
            $table->enum('prioritas', ['rendah','sedang','tinggi'])->default('sedang');
            $table->enum('status', ['pending','diproses','selesai','ditolak'])->default('pending');
            $table->string('foto')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluhans');
    }
};