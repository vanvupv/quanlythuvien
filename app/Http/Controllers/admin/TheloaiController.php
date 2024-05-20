<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dausach;
use App\Models\Theloai;
use Illuminate\Http\Request;

class TheloaiController extends Controller
{
    public function list() {
        $theloai = Theloai::all();
        return view('admin.theloai.listTheloai',[
            'theloais' => $theloai,
        ]);
    }

    public function add() {
        return view('admin.theloai.add');
    }

    public function store(Request $request) {
        $tentheloai = $request->input('tentheloai');
        $mota = $request->input('mota');

        if (Theloai::theloaiExists($tentheloai)) {
            return redirect()->back()->with('message', 'Tên Thể Loại Đã Tồn Tại');
        }

        Theloai::create([
            'tentl' => $tentheloai,
            'mota' => $mota,
        ]);

        return redirect()->back()->with([
            'message' => 'Thêm thể loại thành công',
            'status' => 200,
        ]);
    }

    public function view() {

    }

    public function edit($matheloai) {
        $theloaiDetail = Theloai::where('id', $matheloai)->first();

        return view('admin.theloai.editTheloai', [
            'matheloai' => $matheloai,
            'theloaiDetail' => $theloaiDetail,
        ]);
    }

    //
    public function postedit($matheloai, Request $request) {
        $tentheloai = $request->input('tentheloai');
        $mota = $request->input('mota');

        $theloai = Theloai::where('id', $matheloai)->first();
        $theloai->tentl = $tentheloai;
        $theloai->mota = $mota;

        if ($theloai->isDirty()) {
            $changedAttributes = $theloai->getDirty();

            if (isset($changedAttributes['tentl'])) {
                if (Theloai::theloaiExists($tentheloai)) {
                    return redirect()->back()->with('message', 'Thể Loại "' . $tentheloai . '" Đã Tồn Tại');
                }
            }
        }

        else {
            return redirect()->back()->with([
                'message' => 'Không có thông tin thay đổi',
                'status' => 200,
            ]);
        }

        Theloai::where('id', $matheloai)
            ->update([
                'tentl' => $tentheloai,
                'mota' => $mota,
            ]);

        return redirect()->back()->with([
            'message' => 'Cập nhật thể loại thành công',
            'status' => 200,
        ]);
    }

    public function delete($id) {
        $checkDausach = Dausach::where('matl', $id)->exists();

        if($checkDausach) {
            return redirect()->back()->with('message', "Không được phép xóa Thể loại này");
        }

        Theloai::where('id', $id)->delete();

        return redirect()->back()->with([
            'message' => 'Xóa thể loại thành công',
            'status' => 200,
        ]);
    }
}
