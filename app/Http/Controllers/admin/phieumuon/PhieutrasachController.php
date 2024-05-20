<?php

namespace App\Http\Controllers\admin\phieumuon;

use App\Http\Controllers\Controller;
use App\Models\Chitiethoadon;
use App\Models\Chitietphieumuon;
use App\Models\Chitietphieutra;
use App\Models\Dausach;
use App\Models\Docgia;
use App\Models\Hoadon;
use App\Models\Phatquahan;
use App\Models\Phattrangthai;
use App\Models\Phieumuonsach;
use App\Models\Phieunopphat;
use App\Models\Phieutra;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

//
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PhieutrasachController extends Controller
{
    //
    public function list() {
        $phieutra = Phieutra::with(['nhanvien', 'docgia'])->get();

//        dd($phieutra);
        //
        return view('admin.phieutrasach.list', [
            'phieutras' => $phieutra,
        ]);
    }

    //
    public function view($id) {
        $trangthaimuon = Phattrangthai::all();
        $trangthaingay = Phatquahan::all();
        $phieutrasach = Phieutra::where('matra', $id)->first();
        $phieutra = Chitietphieutra::with('dausach','trangthaitra','quahan')->where('matra', $id)->get();
        //
//        dd($phieutra);
        return view('admin.phieutrasach.chitietphieutra', [
            'id' => $id,
            'phieutra' => $phieutrasach,
            'phieutras' => $phieutra,
            'trangthaimuon' => $trangthaimuon,
            'trangthaingay' => $trangthaingay,
        ]);
    }

    // Lập Phiếu Trả
    public function create(Request $request) {
        //
        $user = Auth::user();
        //
        return view('admin.phieutrasach.phieutra',[
            'nhanviens' => $user,
        ]);
    }

    //
    public function store(Request $request) {
        try {
            // Lấy Các Thông Tin
            $maphieumuon = $request->input('maphieumuonReturn');
            $madocgia = $request->input('madocgiaReturn');
            $manhanvien = $request->input('manhanvienReturn');

            // Kiểm Tra Mã Phiếu Đã Được Lập Chưa
            $isExist = Phieutra::where('maphieu', $maphieumuon)
                        ->where('madocgia', $madocgia)
                        ->exists();
            if ($isExist) {
                return redirect()->back()->with('message', 'Mã Phiếu Đã Tồn Tại.');
            }

            // Lập Phiếu Trả Sách
            $invoice = Phieutra::create([
                'maphieu' => $maphieumuon,
                'manv' => $manhanvien,
                'madocgia' => $madocgia,
                'ngaytra' => Carbon::now(),
                'trangthai' => 0,
            ]);
            //
            if($invoice) {
                //
                $chitietPhieuMuon = Chitietphieumuon::where('maphieu', $maphieumuon)->get();
                foreach ($chitietPhieuMuon as $chitiet) {
                    Chitietphieutra::create([
                        'matra' => $invoice->matra,
                        'IDSach' => $chitiet->IDSach,
                        'phat_trangthaisach_id' => 1,
                        'phat_quahan_id' => 1,
                        'trangthai' => 0,
                    ]);
                }
            }
            // Trả Về Nếu Thành Công
            return redirect()->back()->with('message', 'Mã Phiếu Đã Được Tạo Thành Công');
//            }
        } catch (Exception $e) {
//            // Bắt ngoại lệ và trả về thông báo bạn muốn
            return response()->json(['message' => "Lập Phiếu Thất Bại."]);
        }
    }

    // -------------------------------------------------------------------------- //
    //
    public function getInfo(Request $request) {
        //
        $maphieu = $request->input('maphieu');
        $madocgia = $request->input('madocgia');
        //
        $info = Phieumuonsach::where('maphieu', $maphieu)
                    ->where('madocgia', $madocgia)
                    ->first();
        if ($info) {
            $docgia = Docgia::where('madocgia', $madocgia)->first();

            return response()->json([
                'status' => 200,
                'message' => 'lấy thông tin thành công',
                'data' => $info,
                'docgia' => $docgia,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Mã Phiếu không tồn tại',
                'data' => '',
            ]);
        }
    }
    // --------------------------------- Trả Sách -------------------------------------- //
    public function updateStatus(Request $request) {
        // Lấy Giá Trị
        $maphieutra = $request->input('maphieutra');
        $masach = $request->input('masach');
        $statusPhat = $request->input('statusPhat');
        $status = $request->input('status');
        $action = $request->input('action');
//
//        dd($maphieutra , $masach);

        //
        $bookReturn = Chitietphieutra::where('matra', $maphieutra)
            ->where('IDSach', $masach)
            ->first();
        //
        if($bookReturn->trangthai == 1) {
            return redirect()->back()->with('message', 'Sách Đã Trả. Vui lòng chọn sách khác!');
        }

        //
        if($action == 'update') {
            $checkUpdate = $bookReturn->update([
                'phat_trangthaisach_id' => $statusPhat,
                'phat_quahan_id' => $status,
            ]);
            //
            return redirect()->back()->with('message', 'Cập Nhật Trạng Thái Sách Thành Công');
        }

        //
        if($action == 'return') {
            //
            if($statusPhat == 1 && $status == 1) {
                //
                $checkUpdate = $bookReturn->update([
                    'trangthai' => 1,
                ]);
                //
                $sach = Dausach::find($masach);

                // Nếu tìm thấy sách, giảm đi số lượng sách
                if ($sach) {
                    $sach->soluongsach += 1; // Giảm số lượng sách đi 1

                    // Lưu sách đã cập nhật
                    $sach->save();
                }
                //
                return redirect()->back()->with('message', 'Trả Sách Thành Công');
            }

            //
            if($statusPhat != 1 && $status != 1) {
                return redirect()->back()->with('message', 'Sách bị quá hạn và Sách bị hỏng!');
            }
            //
            if($statusPhat != 1) {
                return redirect()->back()->with('message', 'Sách bị hỏng hoặc mất!');
            }

            //
            if($status != 1) {
                return redirect()->back()->with('message', 'Sách bị quá hạn!');
            }
            //
            // $maphieutra  $masach
            $check = Phieunopphat::where('matra', $maphieutra)->first();


            $ketHopChuoi = $check->maphat . '-' .$masach ;

            $check1 = Hoadon::where('SoHoaDon', $ketHopChuoi)->first();

            if($check1) {
                $checkUpdate = $bookReturn->update([
                    'trangthai' => 1,
                ]);
                //
                return redirect()->back()->with('message', 'Trả Sách Thành Công');
            }
        }
    }

    // Return All
    public function returnAll(Request $request) {
        //
        $matra = $request->input('matra');
        $booksData = $request->input('booksData');
        //
        $arrID = [];
        $check = true;
        foreach ($booksData as $item) {
            if ($item['tinhTrang'] == 1 && $item['tinhTrangNgay'] == 1) {
                $arrID[] = $item['IDSach'];
            } else {
                $check = false;
                break;
            }
        }
        //
        if($check) {
            //
            $chitiet = Chitietphieutra::whereIn('IDSach', $arrID)
                            ->where('matra', $matra)
                            ->update(['trangthai' => 1]);
            //
            if ($chitiet) {
                Phieutra::where('matra', $matra)
                        ->update(['trangthai' => 1]);
            }
            //
            return response()->json([
                'message' => 'Trả Sách Thành Công!',
            ]);
        } else {
            return response()->json([
                'message' => 'Trả Sách Thất Bại. Tình trạng sách không phù hợp!',
            ]);
        }
    }
}

