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
        Schema::create('configapp', function (Blueprint $table) {
            $table->id();
            $table->string('titleapp');
            $table->string('tagline')->nullable();
            $table->string('email')->unique();
            $table->string('keyword');
            $table->string('description')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->json('rekening');
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
        Schema::dropIfExists('configapp');
    }
};
