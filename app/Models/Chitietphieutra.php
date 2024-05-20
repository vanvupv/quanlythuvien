<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietphieutra extends Model
{
    use HasFactory;

    protected $table = 'chitietphieutra'; // Tên Bảng

    protected $primaryKey = 'id';

    protected $fillable = [
        'matra',
        'IDSach',
        'phat_trangthaisach_id',
        'phat_quahan_id',
        'trangthai',
    ];

    // ------------------------------------------ //
    //
    //


    //
    public function dausach() {
        return $this->belongsTo(Dausach::class, 'IDSach');
    }

    //
    public function trangthaitra() {
        return $this->belongsTo(Phattrangthai::class, 'phat_trangthaisach_id');
    }

    //
    public function quahan() {
        return $this->belongsTo(Phatquahan::class, 'phat_quahan_id');
    }
}
