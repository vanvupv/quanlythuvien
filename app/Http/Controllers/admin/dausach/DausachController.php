<?php

namespace App\Http\Controllers\admin\dausach;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Chitiethoadon;
use App\Models\Chitietphieumuon;
use App\Models\Chitietphieunopphat;
use App\Models\Chitietphieutra;
use App\Models\Dausach;
use App\Models\Giahansach;
use App\Models\Nhaxuatban;
use App\Models\Tacgia;
use App\Models\Vitri;
use Illuminate\Http\Request;
use App\Models\Theloai;
use PHPUnit\Exception;

class DausachController extends Controller
{
    //
    public function list() {
        //
        $dausachs = Dausach::all();
        //
        return view('admin.dausach.listBook', [
            'dausachs' => $dausachs,
        ]);
    }

    //
    public function add() {
        $maLoaiSanPhamList = Theloai::pluck('tentl','id');
        $tacgia = Tacgia::pluck('hotentg','id');
        $nxb = Nhaxuatban::pluck('tennxb','id');
        $vitri = Vitri::pluck('vitri_name','id');
        //
        $bookCode = DauSach::generateUniqueBookCode();
        //
        return view('admin.dausach.addBook',[
            'title'=>'Thêm mới dau sach',
            'maloais' =>  $maLoaiSanPhamList,
            'tacgias' =>  $tacgia,
            'nhaxuatbans' => $nxb,
            'vitris' => $vitri,
            'bookCode' => $bookCode,
        ]);
    }

    //
    public function store(Request $request) {
        $masach = $request->input('masach');
        $tensach = $request->input('tensach');
        $theloai = $request->input('theloai');
        $tacgia = $request->input('tacgia');
        $nhaxuatban = $request->input('nhaxuatban');
        $vitri = $request->input('vitri');
        $trangthai = $request->input('trangthai');
        $soluongsach = $request->input('soluong');
        $mota = $request->input('mota');
        //
        $image = $request->file('image');
        $imageObj = new ImageController();
        $imageNew = $imageObj->create($image);

        //
        if (Dausach::bookNameExists($tensach)) {
            return redirect()->back()->with('message', 'Tên Sách Đã Tồn Tại');
        }

        try {
            Dausach::create([
                'masach' => $masach,
                'tensach' => $tensach,
                'matl' => $theloai,
                'matg' => $tacgia,
                'manxb' => $nhaxuatban,
                'mavitri' => $vitri,
                'trangthai' => $trangthai,
                'soluongsach' => $soluongsach,
                'image' => $imageNew,
                'gioithieusach' => $mota,
            ]);
            Session()->flash('message','Thêm Mới Đầu Sách Thành Công');
            return redirect()->back();
        }
        catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return false;
        }
    }

    //
    public function detail($id) {
        try {
            $detailBook = Dausach::with(['tacgia', 'nhaxuatban', 'theloai', 'vitri'])
                ->where('id', $id)
                ->first();

            return view('admin.dausach.detailBook', [
                'title' => 'Sửa đầu sách',
                'detailBook' => $detailBook,
            ]);
        } catch (Exception $e) {

        }
    }

    //
    public function edit($id) {
        $detailBook = Dausach::where('id',$id)->first();
        $maLoai = Theloai::pluck('tentl','id');
        $tacgia = Tacgia::pluck('hotentg','id');
        $nxb = Nhaxuatban::pluck('tennxb','id');
        $vitri = Vitri::pluck('vitri_name','id');

        return view('admin.dausach.editBook', [
            'title' => 'Sửa đầu sách',
            'detailBook' => $detailBook,
            'maloais' =>  $maLoai,
            'tacgias' =>  $tacgia,
            'nhaxuatbans' =>  $nxb,
            'vitris' => $vitri,
        ]);
    }

    //
    public function postedit($id, Request $request) {
        try {
            $dausach = Dausach::findOrFail($id);
            $dausach->masach = $request->input('masach');
            $dausach->tensach = $request->input('tensach');
            $dausach->matl = $request->input('theloai');
            $dausach->matg= $request->input('tacgia');
            $dausach->manxb = $request->input('nhaxuatban');
            $dausach->mavitri = $request->input('vitri');
            $dausach->trangthai = $request->input('trangthai');
            $dausach->soluongsach = $request->input('soluong');
            $dausach->gioithieusach = $request->input('mota');

            //
            $imageCurrent = $dausach->image;

            if($request->hasFile('image')) {
                $imageObj = new ImageController();
                $imageNew = $imageObj->create($request->file('image'));
                $dausach->image = $imageNew;
            }

            if ($dausach->isDirty()) {
                $changedAttributes = $dausach->getDirty();

                if(isset($changedAttributes['tensach'])) {
                    if (Dausach::bookNameExists($changedAttributes['tensach'])) {
                        return redirect()->back()->with('message', 'Tên Sách Đã Tồn Tại');
                    }
                }

                $dausach->update($changedAttributes);

//                if($imageCurrent) {
////                    ImageController::deleteImage($imageCurrent);
//                }

                return redirect()->back()->with('message', 'Cập nhật thông tin đầu sách thành công');
            }

            return redirect()->back()->with('message', 'Không có thông tin thay đổi');
        }
        catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return false;
        }
    }

    //
    public function active($id) {
        $dausach = Dausach::find($id);

        if ($dausach->trangthai === 0) {
            $dausach->trangthai = 1;
            $dausach->save();
            //
            return redirect()->back()->with('message', 'Kích Hoạt Đầu Sách Thành Công');
        }
    }

    public function inactive($id) {
        $dausach = Dausach::find($id);

        if ($dausach->trangthai === 1) {
            $dausach->trangthai = 0;
            $dausach->save();
        }

        return redirect()->back()->with('message', 'Khóa Đầu Sách Thành Công');
    }

    public function delete($id, Request $request) {
        $masach = $id;

        $checkPhieumuon = Chitietphieumuon::where('IDSach', $masach)->exists();
        $checkPhieutra = Chitietphieutra::where('IDSach', $masach)->exists();
        $checkGiahan = Giahansach::where('IDSach', $masach)->exists();
        $checkPhieuphat = Chitietphieunopphat::where('IDSach', $masach)->exists();
        $checkHoadon = Chitiethoadon::where('IDSach', $masach)->exists();

        if($checkPhieumuon || $checkPhieutra || $checkGiahan || $checkPhieuphat || $checkHoadon) {
            return redirect()->back()->with('message', 'Không thể xóa đầu sách');
        }

        Dausach::where('id', $masach)->delete();

        return redirect()->back()->with([
            'message' => 'Xóa đầu sách thành công',
            'status' =>  200,
            ]);
    }
}


