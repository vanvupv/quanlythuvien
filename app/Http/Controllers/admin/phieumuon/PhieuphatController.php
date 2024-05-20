<?php

namespace App\Http\Controllers\admin\phieumuon;

use App\Http\Controllers\Controller;
use App\Models\Chitietphieunopphat;
use App\Models\Chitietphieutra;
use App\Models\Phieunopphat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PhieuphatController extends Controller
{
    // Danh sách Phiếu Nộp Phạt
    public function list() {
        $phieunopphats = Phieunopphat::all();
        //
        return view('admin.phieuphat.danhsachphieuphat', [
            'title' => 'Danh Sách Phiếu Nộp Phạt',
            'phieunopphats' => $phieunopphats,
        ]);
    }

    //
    public function create() {
        //
        $user = Auth::user();

        //
        return view('admin.phieuphat.lapphieuphat',[
            'nhanviens' => $user,
        ]);
    }

    //
    public function store(Request $request) {
        //
        $maphieutra = $request->input('maphieutra');
        $idsach = $request->input('idsach');
        //
        $checkBook = Chitietphieutra::select('chitietphieutra.*', 'pq.sotien as sotien_quahan', 'pq.trangthai as pq_lydo', 'pts.sotien as sotien_trangthai', 'pts.trangthai as pts_lydo')
            ->leftJoin('phat_quahan as pq', 'chitietphieutra.phat_quahan_id', '=', 'pq.id')
            ->leftJoin('phat_trangthaisach as pts', 'chitietphieutra.phat_trangthaisach_id', '=', 'pts.id')
            ->where('chitietphieutra.matra', $maphieutra)
            ->where('chitietphieutra.IDSach', $idsach)
            ->first();
        //
        $checkphieu = Phieunopphat::where('matra', $maphieutra)->first();
        $chechchitiet = Chitietphieunopphat::where('maphat', $checkphieu->maphat)
            ->where('IDSach', $idsach)->first();

        //
        if($chechchitiet) {
            return response()->json([
                'status' => 403,
                'message' => 'Mã phiếu phạt đã tồn tại.Bạn có muốn chuyển đến trang phiếu phạt không?',
                'route' => route('phieuphat.view',[$checkphieu->maphat]),
            ]);
        }

        //
        if($checkphieu) {
            $checkphieu->details()->create([
                'IDSach' => $checkBook->IDSach,
                'sotienphat' => $checkBook->sotien_quahan + $checkBook->sotien_trangthai,
                'lydo' => $checkBook->pq_lydo . ',' . $checkBook->pts_lydo,
                'trangthaithanhtoan' => 0
            ]);

            return response()->json([
               'status' => 403,
                'message' => 'Mã phiếu phạt đã tồn tại.Bạn có muốn chuyển đến trang phiếu phạt không?',
                'route' => route('phieuphat.view',[$checkphieu->maphat]),
            ]);
        }

        //
        if($checkBook) {
            if($checkBook->phat_trangthaisach_id != 1 || $checkBook->phat_quahan_id != 1) {
                // Lập Phiếu Trả Sách
                $invoice = Phieunopphat::create([
                    'matra' => $maphieutra,
                    'ngaylapphieu' => Carbon::now(),
                    'ngayhoanthanh' => Carbon::now(),
                    'trangthaitra' => 0,
                    'sotienphat' => 0,
                ]);
                //
                if($invoice) {
                    //
                    $invoice->details()->create([
                        'IDSach' => $checkBook->IDSach,
                        'sotienphat' => $checkBook->sotien_quahan + $checkBook->sotien_trangthai,
                        'lydo' => $checkBook->pq_lydo . ',' . $checkBook->pts_lydo,
                        'trangthaithanhtoan' => 0
                        ]);
                    //
                    return response()->json(['message','Lập phiếu nộp phạt thành công']);
                }
            } else {
                return response()->json(['message','Sách không thể lập phiếu nộp phạt']);
            }
        }
        //
        return response()->json(['message','Sách không tồn tại trong phiếu trả']);
    }

    //
    public function view($maphieuphat, Request $request) {
        $phieuphat = Phieunopphat::where('maphat', $maphieuphat)->first();
        $phieuphatDetails = Chitietphieunopphat::with('dausach')->where('maphat', $maphieuphat)->get();
        //
        return view('admin.phieuphat.chitietphieuphat',[
            'title' => 'Chi Tiết Phiếu Trả',
            'phieuphat' => $phieuphat,
            'phieuphatDetails' => $phieuphatDetails,
        ]);
    }
}

