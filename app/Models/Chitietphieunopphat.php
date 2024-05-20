<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietphieunopphat extends Model
{
    use HasFactory;

    protected $table = 'chitietphieunopphat';

    protected $fillable = [
        'maphat',
        'IDSach',
        'sotienphat',
        'lydo',
        'trangthaithanhtoan',
    ];

    // ------------------------------------------- //
    public function dausach() {
        return $this->belongsTo(Dausach::class, 'IDSach');
    }
}

