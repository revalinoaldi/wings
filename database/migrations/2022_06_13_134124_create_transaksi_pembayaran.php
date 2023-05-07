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
        Schema::create('transaksi_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->double('jumlah_pembayaran');
            $table->string('rekening_pembayaran');
            $table->string('bukti_pembayaran');
            $table->dateTime('tanggal_pembayaran');
            $table->timestamps();

            $table->foreign('transaksi_id')
                ->references('id')
                ->on('transaksi')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pembayaran');
        Schema::table('transaksi_pembayaran', function (Blueprint $table) {
            $table->dropForeign('transaksi_id');
        });
    }
};
