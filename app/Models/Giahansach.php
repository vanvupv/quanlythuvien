<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giahansach extends Model
{
    use HasFactory;

    protected $table = 'giahansach';

    protected $primaryKey = 'id';

    protected $fillable = [
        'maphieu',
        'IDSach',
        'ngaygiahan',
        'ngayhethan',
        'trangthai',
    ];

    //
    public function dausach() {
        return $this->belongsTo(Dausach::class, 'IDSach');
    }
}


