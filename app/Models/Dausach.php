<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dausach extends Model
{
    use HasFactory;
    /* ------------ Thuộc Tính --------- */
    //
    protected $table = 'dausach'; // Tên Bảng

    protected $primaryKey = 'id';

    protected $fillable = [
        'masach',
        'tensach',
        'matl',
        'matg',
        'manxb',
        'mavitri',
        'trangthai',
        'gioithieusach',
        'soluongsach',
        'image',
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
        $lastBook = static::orderByRaw('CAST(masach AS UNSIGNED) DESC')->first();
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
        while (static::where('masach', $bookCode)->exists()) {
            $prefix += 1;
            $bookCode = $prefix . $yearSuffix;
        }
        //
        return $bookCode;
    }

    //
    public static function bookNameExists($bookName)
    {
        return self::where('tensach', $bookName)->exists();
    }
    //
    public function tacgia()
    {
        return $this->belongsTo(Tacgia::class, 'matg');
    }

    public function nhaxuatban()
    {
        return $this->belongsTo(Nhaxuatban::class, 'manxb');
    }

    public function theloai()
    {
        return $this->belongsTo(Theloai::class, 'matl');
    }

    public function vitri()
    {
        return $this->belongsTo(Vitri::class, 'mavitri');
    }

}
