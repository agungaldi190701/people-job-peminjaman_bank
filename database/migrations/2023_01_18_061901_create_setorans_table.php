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
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabahs_id')->nullable()->constrained('nasabahs')->nullOnDelete();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('peminjaman_id')->nullable()->constrained('peminjaman')->nullOnDelete();
            $table->integer('jumlah_setoran');
            $table->date('tanggal_setoran');
            $table->integer('selisih_total_pinjaman');
            $table->integer('total_pinjaman');
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
        Schema::dropIfExists('setorans');
    }
};
