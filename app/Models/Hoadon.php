<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadon extends Model
{
    use HasFactory;

    protected $table = 'hoadon';

    protected $primaryKey = 'MaHD';

    protected $fillable = [
        'SoHoaDon',
        'Maphat',
        'Manhanvien',
        'Madocgia',
        'TongTien',
        'GhiChu',
    ];

    // -------------------------------------- //
    //
    public function details() {
        return $this->hasMany(Chitiethoadon::class, 'MaHD');
    }

    //


}
