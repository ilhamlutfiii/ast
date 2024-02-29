<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->string('pinjam_number')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('aset_id')->nullable();
            $table->float('sub_total');
            $table->integer('quantity');
            $table->enum('status',['Baru','Diproses','Siap Diambil','Dibatalkan'])->default('Baru');
            $table->foreign('user_id')->references('id')->on('userss')->onDelete('SET NULL');
            $table->foreign('aset_id')->references('id')->on('asets')->onDelete('SET NULL');
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
        Schema::dropIfExists('pinjams');
    }
}
