<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTacgiaTable extends Migration
{
    public function up()
    {
        Schema::create('tacgia', function (Blueprint $table) {
            $table->id();
            $table->string('hotentg');
            $table->string('gioithieu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tacgia');
    }
};
