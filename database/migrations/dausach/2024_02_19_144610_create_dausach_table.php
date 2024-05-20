<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDausachTable extends Migration
{
    public function up()
    {
        Schema::create('dausach', function (Blueprint $table) {
            $table->id();
            $table->string('masach');
            $table->string('tensach')->unique();
            $table->unsignedBigInteger('matl')->nullable();
            $table->unsignedBigInteger('matg')->nullable();
            $table->unsignedBigInteger('manxb')->nullable();
            $table->boolean('trangthai')->default(true);
            $table->string('gioithieusach')->nullable();
            $table->integer('soluongsach');
            $table->date('ngaynhap');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('matl')->references('id')->on('theloai');
            $table->foreign('matg')->references('id')->on('tacgia');
            $table->foreign('manxb')->references('id')->on('nxb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dausach');
    }
};

