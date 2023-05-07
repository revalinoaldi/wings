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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->char('kode_transaksi',10)->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('no_telp');
            $table->string('alamat');
            $table->dateTime('tanggal_transaksi');
            $table->double('total_transaksi');
            $table->integer('total_qty');
            $table->enum('status_transaksi',[0,1])->default(0);
            $table->unsignedBigInteger('user_approve');
            $table->dateTime('tanggal_approve');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_approve')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('transaksi');
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['user_id','user_approve']);
        });
    }
};
