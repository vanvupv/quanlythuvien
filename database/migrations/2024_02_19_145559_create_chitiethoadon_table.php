<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitiethoadonTable extends Migration
{
    public function up()
    {
        Schema::create('Chitiethoadon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MaHD');
            $table->unsignedBigInteger('IDSach');
            $table->integer('Thanhtien');
            $table->string('Ghichu', 200)->nullable();
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('MaHD')->references('MaHD')->on('Hoadon');
            $table->foreign('IDSach')->references('id')->on('dausach');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Chitiethoadon');
    }
}
