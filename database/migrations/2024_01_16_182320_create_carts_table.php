<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aset_id');
            $table->unsignedBigInteger('pinjam_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('status',['Baru','Dicek','Siap Diambil','Batalkan'])->default('Baru');
            $table->integer('quantity');
            $table->foreign('aset_id')->references('id')->on('asets')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('userss')->onDelete('CASCADE');
            $table->foreign('pinjam_id')->references('id')->on('pinjams')->onDelete('SET NULL');
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
        Schema::dropIfExists('carts');
    }
}
