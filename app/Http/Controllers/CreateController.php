<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use mysql_xdevapi\Exception;

class CreateController extends Controller
{
    //
    public function  view() {
        return view('view');
    }

    public function create(Request $request) {
//
        try {
//            $invoice = Invoice::create([
//                'customer_name' => $request->input('customer_name'),
//                // Các trường khác của hóa đơn
//            ]);

            $data = $request->input('details');
            foreach ($data as $detailData) {
                var_dump($detailData); // Hiển thị dữ liệu trong Laravel
            }
            die();

            // Thêm các chi tiết hóa đơn
            foreach ($request->input('details') as $detailData) {
                $invoice->details()->create([
                    'product_name' => $detailData['product_name'],
                    'quantity' => $detailData['quantity'],
                    // Các trường khác của chi tiết hóa đơn
                ]);
            }

            // Trả về phản hồi thành công
//            return response()->json(['message' => 'Invoice created successfully'], 200);

        } catch (Exception) {

        }


    }
}
