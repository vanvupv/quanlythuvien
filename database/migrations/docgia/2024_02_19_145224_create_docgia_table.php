<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocgiaTable extends Migration
{
    public function up()
    {
        Schema::create('docgia', function (Blueprint $table) {
            $table->id('madocgia');
            $table->string('tendocgia')->nullable();
            $table->string('sodienthoai', 10)->nullable();
            $table->boolean('trangthaihoatdong')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('docgia');
    }
};
