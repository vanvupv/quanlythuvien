<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Docgia;
use App\Models\Phieumuonsach;
use App\Models\Phieutra;
use Illuminate\Http\Request;

class DocgiaController extends Controller
{
    //
    public function list() {
        $docgias = Docgia::all();
        return view('admin.docgia.listDocgia',[
            'docgias' => $docgias,
        ]);
    }

    //
    public function add() {
        $readerCode = Docgia::generateUniqueBookCode();

        return view('admin.docgia.addDocgia',[
            'readerCode' => $readerCode,
        ]);
    }

    //
    public function store(Request $request) {
        //
        $madocgia = $request->input('madocgia');
        $tendocgia = $request->input('tendocgia');
        $sodienthoai = $request->input('sodienthoai');
        $mota = $request->input('mota');
        //
        Docgia::create([
            'madg' => $madocgia,
            'tendocgia' => $tendocgia,
            'sodienthoai' => $sodienthoai,
            'trangthaihoatdong' => 1,
        ]);
        //
        return redirect()->back()->with('message', "Thêm Độc Giả Thành Công");
    }

    //
    public function detail() {

    }

    //
    public function edit($id) {
        // $detailBook
        $detailDocgia = Docgia::where('madocgia',$id)->first();
        //
        return view('admin.docgia.editDocgia', [
            'title' => 'Sửa đầu sách',
            'detailDocgia' => $detailDocgia,
        ]);
    }

    //
    public function postedit($id, Request $request) {
        //
        try {
            $docgia = Docgia::findOrFail($id);
            $docgia->madg = $request->input('madocgia');
            $docgia->tendocgia = (string)$request->input('tendocgia');
            $docgia->sodienthoai = $request->input('sodienthoai');
            $docgia->trangthaihoatdong = $request->input('trangthai');
            //
            $docgia->save();
            Session()->flash('message','Sửa Thông Tin Độc Giả Thành Công');
            return redirect()->back();
        }
        catch (Exception $ex){
            Session()->flash('message',$ex->getMessage());
            return false;
        }
    }

    public function delete(Request $request, $id) {
        $masach = $id;

        $checkPhieumuon = Phieumuonsach::where('madocgia', $masach)->exists();
        $checkPhieutra = Phieutra::where('madocgia', $masach)->exists();

        if($checkPhieumuon || $checkPhieutra) {
            return redirect()->back()->with('message', 'Không thể xóa độc giả');
        }

        Docgia::where('madocgia', $masach)->delete();

        return redirect()->back()->with([
            'message' => 'Xóa độc giả thành công',
            'status' =>  200,
        ]);
    }
}
