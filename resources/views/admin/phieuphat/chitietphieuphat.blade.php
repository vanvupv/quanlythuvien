@extends('admin.main')
@section('content')
    <!-- -->
    @if(Session::has('message'))
        <div class="alert alert-primary" role="alert">
            {{Session('message')}}
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-header">
            <h6 class="card-title mb-0">THÔNG TIN PHIẾU PHẠT</h6>
        </div>
        <hr class="m-0">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 col-md-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" name="maphieuphat" class="form-control" id="maphieuphat" value="{{$phieuphat->maphat}}" disabled>
                        <label for="maphieuphat">Mã Phiếu Phạt</label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" name="maphieutra" class="form-control" id="maphieutra" value="{{$phieuphat->matra}}" disabled>
                        <label for="maphieutra">Mã Phiếu Trả</label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" name="ngaytao" class="form-control" id="ngaytao" value="{{ date('Y-m-d', strtotime($phieuphat->created_at)) }}" disabled>
                        <label for="ngaytao">Ngày Tạo</label>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="col-md-12">
                    <label for="ghichu">Ghi chú:</label>
                    <textarea  class="form-control" name="ghichu" id="ghichu"> </textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <h6 class="card-title mb-0">THÔNG TIN SÁCH PHẠT</h6>
        </div>
        <div class="card-body">
            <table id="BookReturnTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Phiếu Phạt</th>
                        <th>Mã Sách</th>
                        <th>Tên Sách</th>
                        <th>Số Tiền Phạt</th>
                        <th>Lý Do</th>
                        <th>Trạng Thái Thanh Toán</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="borrowBook__list">
                @foreach($phieuphatDetails as $phieuphatDetail)
                    <tr class="borrowBook__item">
                        <td>{{$phieuphatDetail->maphat}}</td>
                        <td>{{$phieuphatDetail->dausach->masach}}</td>
                        <td>{{$phieuphatDetail->dausach->tensach}}</td>
                        <td>{{$phieuphatDetail->sotienphat}}</td>
                        <td>{{$phieuphatDetail->lydo}}</td>
                        <td>
                            <div class="">
                                @if($phieuphatDetail->trangthaithanhtoan == 1)
                                    Đã Trả
                                @else
                                    Chưa trả
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <form  action="{{route('checkout')}}" method="post">
                                    <input type="hidden" name="order_id" value="{{$phieuphat->maphat}}-{{$phieuphatDetail->IDSach}}">
                                    <input type="hidden" name="money" value="{{$phieuphatDetail->sotienphat}}">
                                    <button type="submit" name="redirect" class="btn btn-success"> Thanh toán VNPay </button>
                                    @csrf
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                    <!-- -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- -->
@endsection

