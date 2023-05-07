<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::unprepared('CREATE TRIGGER stok_decrease_after_checkout AFTER INSERT ON `detail_transaksi` FOR EACH ROW
                BEGIN
                   UPDATE produk SET stok = stok-NEW.qty WHERE id = NEW.produk_id;
                END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `stok_decrease_after_checkout`');
    }
};
