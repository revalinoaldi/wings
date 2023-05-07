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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->unsignedBigInteger('ketegori_id');
            $table->char('kode_produk',10);
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->integer('stok')->default(0);
            $table->string('currency',5)->default('IDR');
            $table->integer('discount')->default(0);
            $table->double('harga');
            $table->double('berat');
            $table->string('gambar');
            $table->timestamps();

            $table->foreign('ketegori_id')
                ->references('id')
                ->on('kategori')
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
        Schema::dropIfExists('produk');
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign('ketegori_id');
        });
    }
};
