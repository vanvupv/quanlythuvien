<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietphieumuonTable extends Migration
{
    public function up()
    {
        Schema::create('chitietphieumuon', function (Blueprint $table) {
            $table->unsignedBigInteger('maphieu');
            $table->unsignedBigInteger('IDSach');
            $table->date('ngaymuon');
            $table->date('ngaytra');
            $table->integer('trangthai');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('maphieu')->references('maphieu')->on('phieumuonsach');
            $table->foreign('IDSach')->references('id')->on('dausach');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chitietphieumuon');
    }
};

