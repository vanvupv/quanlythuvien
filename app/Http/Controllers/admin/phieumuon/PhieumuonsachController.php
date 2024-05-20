<?php

namespace App\Http\Controllers\admin\phieumuon;

use App\Http\Controllers\Controller;
//
use Illuminate\Support\Facades\Auth;
//
use App\Models\Chitietphieumuon;
use App\Models\Dausach;
use App\Models\Docgia;
use App\Models\Giahansach;
use App\Models\Phieumuonsach;
use App\Models\User;
use App\Models\Phieutra;

//
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Carbon\Carbon;
use DB;

class PhieumuonsachController extends Controller
{
    // Danh sach
    public function list() {
        $phieumuon = Phieumuonsach::with(['nhanvien', 'docgia'])->get();

//        dd($phieumuon);

        return view('admin.phieumuonsach.listPhieumuon', [
            'phieumuons' => $phieumuon,
        ]);
    }

    // -------------------------------- Lập Phiếu Mượn Sách ------------------------- //
    // Lấy Thông Tin Độc Giả
    public function getInfoReader(Request $request) {
        $madocgia = $request->input('madocgia');

        if (!$madocgia) {
            return response()->json([
                'status' => 400,
                'message' => 'Yêu cầu cung cấp mã độc giả.',
                'data' => null,
            ]);
        }

        $infoDocgia = Docgia::where('madocgia', $madocgia)->first();

        if (!$infoDocgia) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy độc giả với mã được cung cấp.',
                'data' => null,
            ]);
        }

        // ĐK - 1
        if ($infoDocgia->trangthaihoatdong == 0) {
            return response()->json([
                'status' => 403,
                'message' => 'Độc giả đã bị khóa.',
                'data' => null,
            ]);
        }

        // ĐK - 2
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $numLoansThisMonth =Phieumuonsach::where('madocgia', $infoDocgia->madocgia)
            ->whereBetween('ngaylap', [$startOfMonth, $endOfMonth])
            ->count();

        if($numLoansThisMonth > 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Độc giả không đủ điều kiện để lập phiếu. Số Lần Lập Phiếu Trong Tháng Là '.$numLoansThisMonth,
                'data' => null,
            ]);
        }

        // Success
        return response()->json([
            'status' => 200,
            'message' => 'Thành công.',
            'data' => $infoDocgia,
        ]);
    }

    // Lấy Thông Tin Đầu Sách
    public function getInfoBook(Request $request)
    {
        $optionValue = $request->input('option');
        $masachList = $request->input('bookCodeList');

        // DK - 1
        if (!$optionValue) {
            return response()->json([
                'status' => 400,
                'message' => 'Yêu cầu chọn Đầu sách',
                'data' => null,
            ]);
        }
        //
        $book = Dausach::select('dausach.masach', 'dausach.tensach', 'theloai.tentl', 'tacgia.hotentg', 'nxb.tennxb', 'dausach.trangthai', 'dausach.soluongsach', 'dausach.image')
            ->where('dausach.id', $optionValue)
            ->join('theloai', 'dausach.matl', '=', 'theloai.id')
            ->join('tacgia', 'dausach.matg', '=', 'tacgia.id')
            ->join('nxb', 'dausach.manxb', '=', 'nxb.id')
            ->first();

        // DK - 2
        if(!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy Đầu sách',
                'data' => null,
            ]);
        }

        // DK - 3
        if ($book->trangthai == 0) {
            return response()->json([
                'status' => 403,
                'message' => 'Đầu Sách đã bị khóa',
                'data' => null,
            ]);
        }

        // DK - 4
        if ($book->soluongsach < 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Đầu Sách đã hết. Vui lòng chọn sách khác',
                'data' => null,
            ]);
        }

        // DK - 5
        $maList = [];
        if ($masachList) {
            $maList = explode(',', $masachList);
            if (!in_array($optionValue, $maList)) {
                $maList[] = $optionValue;
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => "Sách đã tồn tại. Vui lòng chọn sách khác!",
                    'data' => '',
                ]);
            }
        } else {
            $maList[] = $optionValue;
        }

        // Success
        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $book,
            'maList' => $maList,
        ]);
    }

    // Lưu Thông Tin Bảng Sách Mượn
    public function saveList(Request $request) {
        //
        $optionValue = $request->input('option');
        $masachList = $request->input('bookCodeList');

        // DK - 1
        if (!$optionValue) {
            return response()->json([
                'status' => 400,
                'message' => 'Yêu cầu chọn Đầu sách',
                'data' => null,
            ]);
        }

        // DK - 2
        $book = Dausach::where('dausach.id', $optionValue)->first();

        if (!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Mã Sách Không Tồn Tại',
                'data' => null,
            ]);
        }

        // DK - 3
        if ($book->trangthai == 0) {
            return response()->json([
                'status' => 403,
                'message' => 'Đầu Sách đã bị khóa. Vui lòng chọn sách khác',
                'data' => null,
            ]);
        }

        // Dk - 4
        if ($book->soluongsach < 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Đầu Sách đã hết. Vui lòng chọn sách khác',
                'data' => null,
            ]);
        }

        // DK - 5
        $maList = [];
        //
        if ($masachList) {
            $maList = explode(',', $masachList);
            if (!in_array($optionValue, $maList)) {
                $maList[] = $optionValue;
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => "Sách đã tồn tại trong danh sách. Vui lòng chọn quyển khác!",
                    'data' => '',
                ]);
            }
        } else {
            $maList[] = $optionValue;
        }

        // Success
        return response()->json([
            'status' => 200,
            'message' => "Thêm sách mượn thành công",
            'data' => $book,
            'maList' => $maList,
        ]);
    }

    // Lap phieu
    public function create() {
        $dausach = Dausach::all();
        //
        $user = Auth::user();
        //
        $docgia = Docgia::all();
        //
        $maphieumuon = Phieumuonsach::getNextMaphieu();
        return view('admin.phieumuonsach.lapphieumuon', [
            'dausachs' => $dausach,
            'nhanviens' => $user,
            'docgias' => $docgia,
            'maphieumuon' => $maphieumuon,
        ]);
    }

    //
    public function store(Request $request) {
        $masachList = $request->input('masachList');
        $array = explode(",", $masachList);
        $bookList = Dausach::whereIn('id', $array)->get();
        $hientai = Carbon::now();
        //
        try {
            $invoice = Phieumuonsach::create([
                'manv' => $request->input('manhanvien'),
                'madocgia' => $request->input('madocgia'),
                'ngaylap' => $request->input('ngaytao'),
                'ngaytra' => Carbon::parse($hientai)->addDays(7),
                'trangthai' => 1,
                'ghichu' => '',
            ]);
            //
            if ($invoice) {
                // Tạo Mảng
                if ($bookList) {
                    $new_Array = [];
                    foreach ($bookList as $book) {
                        $new_Array[] = [
                            'IDSach' => $book->id,
                            'ngaymuon' => $hientai,
                            'ngaytra' => Carbon::parse($hientai)->addDays(7),
                            'trangthai' => '1',
                        ];
                    }
                    // Thêm chi tiết hóa đơn
                    $invoice->details()->createMany($new_Array);

                    // Cập nhật số lượng sách
                    foreach ($new_Array as $item) {
                        // Tìm sách bằng ID
                        $sach = Dausach::find($item['IDSach']);

                        // Nếu tìm thấy sách, giảm đi số lượng sách
                        if ($sach) {
                            $sach->soluongsach -= 1; // Giảm số lượng sách đi 1

                            // Lưu sách đã cập nhật
                            $sach->save();
                        }
                    }
                };
            }
            //
            return redirect()->back()->with('message', 'Mượn sách thành công.');
        } catch (Exception $e) {

        }
    }
    // --------------------------------------------------------------------------- //
    //
    public function view($id) {
        $maphieu = $id;
        $phieumuon = Phieumuonsach::with(['nhanvien','docgia'])
            ->where('maphieu', $maphieu)->first();
        $chitietmaphieu = Chitietphieumuon::with(['phieumuon'])
            ->where('maphieu', $maphieu)->get();

        //
        return view('admin.phieumuonsach.chitietphieumuon', [
            'phieumuon' => $phieumuon,
            'maphieu' => $maphieu,
            'chitietmaphieus' => $chitietmaphieu,
        ]);
    }

    // ----------------------------------------------------------- //
    // Thông Tin Gia Hạn
    public function getLatestRenewalInfo(Request $request) {
        // Lấy ID & maphieu
        $idsach = $request->input('idSach');
        $maphieu = $request->input('maphieu');
        $madocgia = $request->input('idDocgia');

        //
        if (!$madocgia) {
            return response()->json([
                'status' => 400,
                'message' => 'Yêu cầu cung cấp mã độc giả.',
                'data' => null,
            ]);
        }

        //
        $infoDocgia = Docgia::where('madocgia', $madocgia)->first();

        if (!$infoDocgia) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy độc giả với mã được cung cấp.',
                'data' => null,
            ]);
        }

        // ĐK - 1
        if ($infoDocgia->trangthaihoatdong == 0) {
            return response()->json([
                'status' => 403,
                'message' => 'Độc giả đã bị khóa.',
                'data' => null,
            ]);
        }

        // ĐK -5
        $giahanCount = Giahansach::where('maphieu', $maphieu)
            ->where('IDSach', $idsach)
            ->count();

        if ($giahanCount >= 2) {
            return response()->json([
                'status' => 403,
                'message' => 'Số Lần Gia Hạn Của Bạn Đã Hết',
                'data' => null,
            ]);
        }

        // ĐK - 2


        // Lấy Quyển Sách Cần Gia Hạn
        $bookDetail = Chitietphieumuon::join('dausach', 'chitietphieumuon.IDSach', '=', 'dausach.id')
            ->where('chitietphieumuon.maphieu', $maphieu)
            ->where('chitietphieumuon.IDSach', $idsach)
            ->select('chitietphieumuon.*', 'dausach.tensach', 'dausach.image')
            ->first();

        // ĐK - 3
        $ngayhientai = Carbon::now();
        $ngaytra = Carbon::parse($bookDetail->ngaytra);

        if ($ngayhientai->lessThan($ngaytra->subDays(2))) {
            return response()->json([
                'status' => 403,
                'message' => 'Ngày gia hạn quá sớm',
                'data' => null,
            ]);
        }

        // ĐK - 4
        if ($ngayhientai->greaterThan($ngaytra)) {
            return response()->json([
                'status' => 403,
                'message' => 'Sách quá hạn! Không thể gia hạn',
                'data' => null,
            ]);
        }

        //
        $ngaytrahientai = $bookDetail->ngaytra;
        $ngaytramoi =  Carbon::parse($ngaytrahientai)->addDays(7);

        //
        return response()->json([
            'status' => 200,
            'message' => "Thông Tin Gia Hạn Sách",
            'data' => $bookDetail,
            'maphieu' => $maphieu,
            'numberRenew' => (int)$giahanCount + 1,
            'ngaymuon' => $ngaytrahientai ?? '',
            'ngaytra' => $ngaytramoi ?? '',
        ]);
    }

    // Chi Tiết Gia Hạn
    public function getBookBorrowDetails(Request $request) {
        // Lấy ID & Ma Phieu
        $idsach = $request->input('idSach');
        $maphieu = $request->input('maphieu');

         // Lấy Quyển Sách Cần Gia Hạn
        $renewDetail = Giahansach::with(['dausach'])->where('maphieu', $maphieu)
            ->where('IDSach', $idsach)
            ->get();

        if(count($renewDetail) < 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Bạn chưa gia hạn sách',
                'data' => null,
            ]);
        }

        //
        return response()->json([
            'status' => 200,
            'message' => "Chi Tiết Sách Mượn",
            'data' => $renewDetail,
        ]);
    }

    // Gia Hạn Sách
    public function renewBook(Request $request) {
        // Lấy ID & Ma Phieu
        $idsach = $request->input('idSach');
        $maphieu = $request->input('maphieu');
        $madocgia = $request->input('idDocgia');

        // Lấy Quyển Sách Cần Gia Hạn
        $bookDetail = Chitietphieumuon::where('maphieu', $maphieu)
            ->where('IDSach', $idsach)
            ->first();

        // Lấy thông tin Ngày trả và Trạng thái
        $ngaytra = $bookDetail->ngaytra;
        $ngaytraBook = Carbon::parse($bookDetail->ngaytra);
        $daynow = Carbon::now();

        //
        $infoDocgia = Docgia::where('madocgia', $madocgia)->first();

        if (!$infoDocgia) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy độc giả với mã được cung cấp.',
                'data' => null,
            ]);
        }

        // ĐK - 1
        if ($infoDocgia->trangthaihoatdong == 0) {
            return response()->json([
                'status' => 403,
                'message' => 'Độc giả đã bị khóa.',
                'data' => null,
            ]);
        }

        // Số Ngày Cho Phép
        if ($ngaytraBook->diffInDays($daynow) > 3) {
            return response()->json([
                'status' => 400,
                'message' => "Gia Hạn Sách Không Thành Công",
            ]);
        }
        // Số Lần Gia Hạn
        $giahanCount = Giahansach::where('maphieu', $maphieu)
            ->where('IDSach', $idsach)
            ->count();
        //
        if ((int)$giahanCount > 3) {
            return response()->json([
                'status' => 400,
                'message' => "Số lần Gia hạn. Gia Hạn Sách Không Thành Công",
            ]);
        }
        //
        $ngaytramoi = Carbon::parse($ngaytra)->addDays(7);

        // Lưu Thông Tin Gia Hạn Vào Phiếu Mượn
        Giahansach::create([
            'maphieu' => $maphieu,
            'IDSach' => $idsach,
            'ngaygiahan' => $ngaytra,
            'ngayhethan' => $ngaytramoi,
            'trangthai' => 1,
        ]);

        // Cập Nhật Ngày Trả Của Sách
        Chitietphieumuon::where('maphieu', $maphieu)
            ->where('IDSach', $idsach)
            ->update([
                'ngaytra' => $ngaytramoi,
            ]);

        //
        return response()->json([
            'status' => 200,
            'message' => "Gia Hạn Sách Thành Công",
        ]);

    }

    //
    public function return($maphieu) {
        // Kiểm tra xem mã phiếu đã tồn tại trong bảng Phieutra hay chưa
        $exists = Phieutra::where('maphieu', $maphieu)->first();
        if ($exists) {
            return redirect()->route('phieutra.view',[$exists->matra]);
        } else {
            return redirect()->route('phieutra')->with('message','Vui lòng lập phiếu trả sách');
        }
    }
}

