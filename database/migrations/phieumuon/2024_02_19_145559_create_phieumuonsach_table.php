<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieumuonsachTable extends Migration
{
    public function up()
    {
        Schema::create('phieumuonsach', function (Blueprint $table) {
            $table->id('maphieu');
            $table->unsignedBigInteger('manv');
            $table->unsignedBigInteger('madocgia');
            $table->date('ngaydat');
            $table->date('ngaytra');
            $table->string('trangthaimuon');
            $table->date('ngaytrathucte')->nullable();
            $table->string('trangthaitra')->nullable();
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('manv')->references('id')->on('users');
            $table->foreign('madocgia')->references('madocgia')->on('docgia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('phieumuonsach');
    }
};

