<?php

namespace App\Http\Controllers;

use App\Models\Dausach;
use App\Models\Theloai;
use Illuminate\Http\Request;

class ShopController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('permission');
//    }

    //
    public function index(Request $request) {
        $loaisanphams = Theloai::all();

        $query = Dausach::query();

        $q_options = $request->query("categories");
        if ($q_options) {
            $arr_options = explode(',',$q_options);
            $query->whereIn('id',$arr_options);
        }

        $sanphams = $query->paginate(10);

        $sanphams->appends($request->query());

        return view('shop', [
            'sanphams' => $sanphams,
            'loaisanphams' => $loaisanphams,
            'q_options' => $q_options,
        ])->with('request', $request);;
    }
}

