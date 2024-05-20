<?php

namespace App\Http\Controllers\admin\hoadon;

use App\Http\Controllers\Controller;
use App\Models\Chitietphieunopphat;
use App\Models\Hoadon;
use App\Models\Phieunopphat;
use App\Models\Phieutra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoadonController extends Controller
{
    //
    public function store(Request $request) {
        // Lấy các giá trị từ tham số URL - Method GET
        $vnpAmount = $request->query('vnp_Amount');
        $vnpBankCode = $request->query('vnp_BankCode');
        $vnpBankTranNo = $request->query('vnp_BankTranNo');
        $vnpCardType = $request->query('vnp_CardType');
        $vnpOrderInfo = $request->query('vnp_OrderInfo');
        $vnpPayDate = $request->query('vnp_PayDate');
        $vnpResponseCode = $request->query('vnp_ResponseCode');
        $vnpTmnCode = $request->query('vnp_TmnCode');
        $vnpTransactionNo = $request->query('vnp_TransactionNo');
        $vnpTransactionStatus = $request->query('vnp_TransactionStatus');

        $vnpSecureHash = $request->query('vnp_SecureHash');;

        // Mã Phiếu Phạt + Đầu sách
        $vnpTxnRef = $request->query('vnp_TxnRef');

        list($maPhieu, $maDauSach) = explode('-', $vnpTxnRef);

        // Chuyển mã phiếu và mã đầu sách thành số nguyên (nếu cần)
        $maphiephatu = (int) $maPhieu;
        $madausach = (int) $maDauSach;

        $chitietPhieuphat = Phieunopphat::where('maphat', $maphiephatu)->first();
        $phieutra = Phieutra::where('matra', $chitietPhieuphat->matra)->first();

        $user = Auth::user();

        // Lưu dữ liệu vào bảng Hoadon
        $hoaDon = Hoadon::create([
            'SoHoaDon' => $vnpTxnRef, // Sử dụng vnpTxnRef làm số hóa đơn
            'Maphat' => $maphiephatu,
            'Manhanvien' => $user->id,
            'Madocgia' => $phieutra->madocgia,
            'TongTien' => $vnpAmount,
            'GhiChu' => $vnpOrderInfo,
        ]);

        // Kiểm tra nếu hóa đơn đã được tạo thành công
        if ($hoaDon) {
            // Lưu dữ liệu vào bảng Chitiethoadon
            $chitietHoaDon = $hoaDon->details()->create([
                'MaHD' => $hoaDon->MaHD, // Sử dụng MaHD của hóa đơn mới tạo
                'IDSach' => $madausach, // Bạn có thể đặt IDSach nếu cần thiết
                'Thanhtien' => $vnpAmount, // Lưu tổng số tiền
                'Ghichu' => $vnpOrderInfo, // Lưu nội dung thanh toán
            ]);
            //
            $chitietPhieunop = Chitietphieunopphat::where('maphat', $maphiephatu)
                ->where('IDSach', $madausach)
                ->update([
                    'trangthaithanhtoan' => 1,
                ]);

            // Trả về phản hồi JSON thông báo thành công
            return redirect()->route('phieuphat.list')->with(['message' => 'Hóa đơn và chi tiết hóa đơn đã được lưu thành công']);
        } else {
            // Xử lý trường hợp hóa đơn không được tạo thành công
            return response()->json(['message' => 'Không thể tạo hóa đơn'], 500);
        }
    }
}
