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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('status_transaksi',2)->default(0)->change();
            $table->unsignedBigInteger('user_approve')->nullable()->change();
            $table->dateTime('tanggal_approve')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->enum('status_transaksi',[0,1])->default(0)->change();
            $table->unsignedBigInteger('user_approve')->nullable(false)->change();
            $table->dateTime('tanggal_approve')->nullable(false)->change();
        });
    }
};
