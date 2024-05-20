<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phieumuonsach extends Model
{
    use HasFactory;

    /*-------------- Thuộc Tính ------------*/
    protected $table = 'phieumuonsach'; // Tên Bảng
    protected $primaryKey = 'maphieu'; // Khóa chính

    protected $fillable = [
        'manv',
        'madocgia',
        'ngaylap',
        'ngaytra',
        'trangthai',
        'ghichu',
    ];

    /*-------------- Phương Thức ------------*/
    public static function getNextMaphieu() {
        $lastPhieu = Phieumuonsach::orderBy('maphieu', 'desc')->first();
        $nextMaphieu = $lastPhieu ? $lastPhieu->maphieu + 1 : 1;
        return $nextMaphieu;
    }

    //
    public function details() {
        return $this->hasMany(Chitietphieumuon::class, 'maphieu');
    }

    //
    public function chiTietPhieuMuons()
    {
        return $this->hasMany(Chitietphieumuon::class, 'maphieu', 'maphieu');
    }

    //
    public function nhanvien()
    {
        return $this->belongsTo(User::class, 'manv');
    }

    //
    public function docgia()
    {
        return $this->belongsTo(Docgia::class, 'madocgia');
    }
}


