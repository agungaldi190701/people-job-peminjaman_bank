<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syarat_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabahs_id')->nullable()->constrained('nasabahs')->nullOnDelete();
            $table->string('surat_keterangan')->nullable();
            $table->string('identitas')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syarat_pinjaman');
    }
};
