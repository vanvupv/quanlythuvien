<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docgia extends Model
{
    use HasFactory;

    protected $table = 'docgia';

    protected $primaryKey = 'madocgia';

    protected $fillable = [
        'madg',
        'tendocgia',
        'sodienthoai',
        'trangthaihoatdong',
    ];

    /* ------------ Phương Thức --------- */
    //
    /**
     * Sinh mã sách duy nhất với tiền tố mới.
     *
     * @return string Mã sách mới và duy nhất.
     */
    public static function generateUniqueBookCode(): string
    {
        $lastBook = static::orderByRaw('CAST(madg AS UNSIGNED) DESC')->first();
        $prefix = '';
        if ($lastBook) {
            $prefix = substr($lastBook->masach, 0, -2);
            // Tăng tiền tố lên 1
            $prefix = (int)$prefix + 1;
        } else {
            $prefix = 1;
        }
        $currentYear = Carbon::now()->year;
        $yearSuffix = substr($currentYear, -2);
        $bookCode = $prefix . $yearSuffix;
        while (static::where('madg', $bookCode)->exists()) {
            $prefix += 1;
            $bookCode = $prefix . $yearSuffix;
        }
        //
        return $bookCode;
    }

    //
    public static function phoneExists($phone)
    {
        return self::where('sodienthoai', $phone)->exists();
    }
}
