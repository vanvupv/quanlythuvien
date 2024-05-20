<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitiethoadon extends Model
{
    use HasFactory;

    protected $table = 'chitiethoadon';

    protected $primaryKey = 'id';

    protected $fillable = [
        'MaHD',
        'IDSach',
        'Thanhtien',
        'Ghichu',
    ];


}
