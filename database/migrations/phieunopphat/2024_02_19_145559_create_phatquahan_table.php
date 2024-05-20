<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhatquahanTable extends Migration
{
    public function up()
    {
        Schema::create('phat_quahan', function (Blueprint $table) {
            $table->id();
            $table->string('trangthai')->unique(); // Trạng thái thời gian (Đúng hạn, Quá hạn)
            $table->decimal('sotien', 8, 2); // Số tiền phạt tương ứng với thời gian quá hạn
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phat_quahan');
    }
};

