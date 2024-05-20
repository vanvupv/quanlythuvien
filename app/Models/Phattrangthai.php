<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phattrangthai extends Model
{
    use HasFactory;

    protected $table = 'phat_trangthaisach';

    protected $primaryKey = 'id';

    protected $fillable = [
        'trangthai',
        'sotien',
    ];
}
