<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phieutra extends Model
{
    use HasFactory;

    protected $table = 'phieutrasach';

    protected $primaryKey = 'matra';

    protected $fillable = [
        'maphieu',
        'manv',
        'madocgia',
        'ngaytra',
        'trangthai',
    ];

    /* ------------------------- */
    public function details() {
        return $this->hasMany(Chitietphieutra::class, 'matra');
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

    //
    public function phieumuon() {
        return $this->belongsTo(Phieumuonsach::class, 'maphieu');
    }
}
