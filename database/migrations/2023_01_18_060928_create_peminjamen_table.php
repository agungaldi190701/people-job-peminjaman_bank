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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('nasabahs_id')->nullable()->constrained('nasabahs')->nullOnDelete();
            $table->integer('jumlah_pinjaman');
            $table->integer('jumlah_angsuran');
            $table->integer('lama_pinjam');
            $table->integer('bunga');
            $table->integer('total_pinjaman');
            $table->string('tujuan_pinjaman');
            $table->string('status');
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
        Schema::dropIfExists('peminjaman');
    }
};
