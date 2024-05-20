<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhattrangthaiTable extends Migration
{
    public function up()
    {
        Schema::create('phat_trangthaisach', function (Blueprint $table) {
            $table->id();
            $table->string('trangthai')->unique(); // Trạng thái sách (Nguyên vẹn, Hỏng, Mất)
            $table->decimal('sotien', 8, 2); // Số tiền phạt tương ứng với trạng thái sách
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phat_trangthaisach');
    }
};

