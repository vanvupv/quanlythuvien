<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietphieumuon extends Model
{
    use HasFactory;

    protected $table = 'chitietphieumuon'; // Tên Bảng

//    protected $primaryKey = ['maphieu', 'IDSach'];

    protected $fillable = [
        'maphieu',
        'IDSach',
        'ngaymuon',
        'ngaytra',
        'trangthai',
    ];

    // --------------------------------------- //
    //
    public function giaHanSachs()
    {
        return $this->hasMany(Giahansach::class, 'maphieu', 'maphieu')->where('IDSach', $this->IDSach);
    }

    //
    public function dausach()
    {
            return $this->belongsTo(Dausach::class, 'IDSach', 'id');
    }

    //
    public function phieumuon()
    {
        return $this->belongsTo(Phieumuonsach::class, 'maphieu');
    }
}




