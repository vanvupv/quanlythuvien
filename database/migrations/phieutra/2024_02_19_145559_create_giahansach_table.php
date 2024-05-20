<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiahansachTable extends Migration
{
    public function up()
    {
        Schema::create('giahansach', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maphieu'); // Liên kết với phiếu mượn sách
            $table->unsignedBigInteger('IDSach');
            $table->date('ngaygiahan');
            $table->date('ngayhethan');
            $table->integer('solan')->default(0);
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('maphieu')->references('maphieu')->on('phieumuonsach');
            $table->foreign('IDSach')->references('id')->on('dausach');
        });
    }

    public function down()
    {
        Schema::dropIfExists('giahansach');
    }
};

