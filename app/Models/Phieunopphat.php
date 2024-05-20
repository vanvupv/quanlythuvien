<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phieunopphat extends Model
{
    use HasFactory;

    protected $table = 'phieunopphat';

    protected $primaryKey = 'maphat';

    protected $fillable = [
        'matra',
        'ngaylapphieu',
        'ngayhoanthanh',
        'trangthaitra',
        'sotienphat',
    ];

    public function details() {
        return $this->hasMany(Chitietphieunopphat::class, 'maphat');
    }
}
