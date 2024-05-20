<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietphieunopphatTable extends Migration
{
    public function up()
    {
        Schema::create('chitietphieunopphat', function (Blueprint $table) {
            $table->unsignedBigInteger('maphat');
            $table->unsignedBigInteger('IDSach');
            $table->integer('sotienphat');
            $table->string('lydo');
            $table->boolean('trangthaithanhtoan')->default(false);
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('maphat')->references('maphat')->on('phieunopphat');
            $table->foreign('IDSach')->references('id')->on('dausach');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chitietphieunopphat');
    }
};

