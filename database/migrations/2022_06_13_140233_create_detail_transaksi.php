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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('qty');
            $table->double('subtotal');
            $table->double('total');
            $table->string('currency',5)->default('IDR');
            $table->enum('satuan',['Pcs','Set','Unit','Lot'])->default('Pcs');
            $table->timestamps();

            $table->foreign('transaksi_id')
                ->references('id')
                ->on('transaksi')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('produk_id')
                ->references('id')
                ->on('produk')
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
        Schema::dropIfExists('detail_transaksi');
        Schema::table('transaksi_pembayaran', function (Blueprint $table) {
            $table->dropForeign(['transaksi_id','produk_id']);
        });
    }
};
