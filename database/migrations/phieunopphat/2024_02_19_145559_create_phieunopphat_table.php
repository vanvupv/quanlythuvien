<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieunopphatTable extends Migration
{
    public function up()
    {
        Schema::create('phieunopphat', function (Blueprint $table) {
            $table->id('maphat');
            $table->unsignedBigInteger('matra');
            $table->date('ngaylapphieu');
            $table->date('ngayhoanthanh');
            $table->boolean('trangthaitra')->default(false);
            $table->integer('sotienphat');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('matra')->references('matra')->on('phieutrasach');
        });

    }

    public function down()
    {
        Schema::dropIfExists('phieunopphat');
    }
};

