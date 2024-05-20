<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitri extends Model
{
    use HasFactory;

    protected $table = 'vitri';

    protected $primaryKey = 'id';

    protected $fillable = [
        'vitri_name',
        'vitri_title'
    ];

    public $timestamps = false;

    //
    public static function vitriExists($vitri)
    {
        return self::where('vitri_name', $vitri)->exists();
    }
}
