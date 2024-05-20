<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNxbTable extends Migration
{
    public function up()
    {
        Schema::create('nxb', function (Blueprint $table) {
            $table->id();
            $table->string('tennxb');
            $table->string('gioithieunxb');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nxb');
    }
};
