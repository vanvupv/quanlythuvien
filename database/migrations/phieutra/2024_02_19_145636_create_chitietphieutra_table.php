<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietphieutraTable extends Migration
{
    public function up()
    {
        Schema::create('chitietphieutra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matra');
            $table->unsignedBigInteger('IDSach');
            $table->unsignedBigInteger('phat_trangthaisach_id')->nullable(); // Khóa ngoại tham chiếu đến bảng phạt theo trạng thái sách
            $table->unsignedBigInteger('phat_quahan_id')->nullable(); // Khóa ngoại tham chiếu đến bảng phạt theo thời gian quá hạn
            $table->string('trangthai')->nullable();
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('matra')->references('matra')->on('phieutrasach');
            $table->foreign('IDSach')->references('id')->on('dausach');
            $table->foreign('phat_trangthaisach_id')->references('id')->on('phat_trangthaisach');
            $table->foreign('phat_quahan_id')->references('id')->on('phat_quahan');
        });

    }

    public function down()
    {
        Schema::dropIfExists('chitietphieutra');
    }
};

