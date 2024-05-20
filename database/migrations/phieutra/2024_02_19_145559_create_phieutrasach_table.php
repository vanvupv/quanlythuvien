<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieutrasachTable extends Migration
{
    public function up()
    {
        Schema::create('phieutrasach', function (Blueprint $table) {
            $table->id('matra');
            $table->unsignedBigInteger('maphieu'); // Liên kết với phiếu mượn sách
            $table->unsignedBigInteger('manv');
            $table->date('ngaytra');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('maphieu')->references('maphieu')->on('phieumuonsach');
            $table->foreign('manv')->references('id')->on('users'); // Giả sử nhân viên trả cũng lưu trong bảng users
        });
    }

    public function down()
    {
        Schema::dropIfExists('phieutrasach');
    }
};

