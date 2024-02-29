<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('userss', function (Blueprint $table) {
            $table->id();
            $table->string('user_nid');
            $table->string('user_nama');
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->unsignedBigInteger('bidang_id')->nullable();
            $table->unsignedBigInteger('fungsi_id')->nullable();
            $table->string('password')->nullable();
            $table->string('photo')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('jabatan_id')->references('jabatan_id')->on('jabatans')->onDelete('set null');
            $table->foreign('bidang_id')->references('bidang_id')->on('bidangs')->onDelete('set null');
            $table->foreign('fungsi_id')->references('fungsi_id')->on('fungsis')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userss', function (Blueprint $table) {
            $table->dropForeign(['jabatan_id']);
            $table->dropForeign(['bidang_id']);
            $table->dropForeign(['fungsi_id']);
        });

        Schema::dropIfExists('userss');
    }
};