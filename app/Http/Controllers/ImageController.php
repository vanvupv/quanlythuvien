<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Anh;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public ?UploadedFile $imageName;
    public string $imageNameReturn;

    //
    public function create($image)
    {
        $this->imageName = $image;

        $this->imageNameReturn = $this->setName($this->imageName);

        return $this->imageNameReturn;
    }

    //
    public function setName($image): string
    {
        $dateInt = $this->getCurrentDateTimeAsInt();
        $pathInfo = pathinfo($image->getClientOriginalName());
        $imageNameWithoutExtension = $pathInfo['filename'];
        $imageType = $pathInfo['extension'];
        $nameCurrent = $imageNameWithoutExtension . "_" . $dateInt;
        $imageNameNew = $this->saveImage($nameCurrent, $imageType);

        return $imageNameNew;
    }

    //
    public function getCurrentDateTimeAsInt(): string
    {
        $currentDateTime = Carbon::now();
        $currentDateTimeInt = $currentDateTime->format('YmdHis');

        return $currentDateTimeInt;
    }

    //
    public function saveImage($nameCurrent, $typeImage)
    {
        $destinationPath = public_path('assets/img');
        $filename = $nameCurrent . '.' . $typeImage;
        $index = 1;
        while (file_exists($destinationPath . '/' . $filename)) {
            $filename = $nameCurrent . '(' . $index . ')' . '.' . $typeImage;
            $index++;
        }
        $this->imageName->move($destinationPath, $filename);

        return $filename;
    }

    //
    public static function deleteImage($filename)
    {
        //
        $destinationPath = public_path('assets/img');

        $pathDelete = $destinationPath."/".$filename;
        $a = '';
        if (file_exists($pathDelete)) {
            $a = unlink($pathDelete);
        }
        return $a;
    }
}
