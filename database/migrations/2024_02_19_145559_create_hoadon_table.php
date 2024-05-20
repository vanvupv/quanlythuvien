<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoaDonTable extends Migration
{
    public function up()
    {
        Schema::create('Hoadon', function (Blueprint $table) {
            $table->id('MaHD');
            $table->string('SoHoaDon', 15);
            $table->unsignedBigInteger('Maphat');
            $table->unsignedBigInteger('Manhanvien');
            $table->unsignedBigInteger('Madocgia');
            $table->integer('TongTien');
            $table->string('GhiChu', 250)->nullable();
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('Manhanvien')->references('id')->on('users');
            $table->foreign('Madocgia')->references('madocgia')->on('docgia');
            $table->foreign('Maphat')->references('maphat')->on('phieunopphat');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Hoadon');
    }
}
