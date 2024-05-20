@extends('admin.main')
@section('content')
    <!-- -->
    @if(Session::has('message'))
    <div class="alert alert-primary" role="alert">
            {{Session('message')}}
    </div>
    @endif

    <!-- Card Thông Tin Phiếu Trả -->
    <div class="card mb-3">
        <div class="card-header">
            <h6 class="card-title mb-0">THÔNG TIN PHIẾU TRẢ</h6>
        </div>
        <hr class="m-0">
        <div class="card-body">
            <div class="row mb-3">
                <!-- Mã Phiếu -->
                <div class="col-12 col-md-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" name="maphieutra" class="form-control" id="maphieutra" value="{{$phieutra->matra}}" disabled>
                        <label for="maphieutra">Mã Phiếu Trả</label>
                    </div>
                </div>
                <!-- / Mã Phiếu -->
                <!-- Mã Độc Giả -->
                <div class="col-12 col-md-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" name="maphieumuon" class="form-control" id="maphieumuon" value="{{$phieutra->maphieu}}" disabled>
                        <label for="maphieumuon">Mã Phiếu Mượn</label>
                    </div>
                </div>
                <!-- / Mã Độc Giả -->
                <!-- Ngày Tạo -->
                <div class="col-12 col-md-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" name="ngaytao" class="form-control" id="ngaytao" value="{{ date('Y-m-d', strtotime($phieutra->created_at)) }}" disabled>
                        <label for="ngaytao">Ngày Tạo</label>
                    </div>
                </div>
                <!-- / Ngày Tạo -->
            </div>
            <!-- Ghi Chú -->
            <div class="col-12 mb-4">
                <div class="col-md-12">
                    <label for="ghichu">Ghi chú:</label>
                    <textarea  class="form-control" name="ghichu" id="ghichu"> </textarea>
                </div>
            </div>
            <!-- / Ghi Chú -->
        </div>
    </div>
    <!-- / Card Thông Tin Phiếu Trả -->

    <!-- -->
    <div class="card mb-3">
        <div class="card-header">
            <h6 class="card-title mb-0">THÔNG TIN SÁCH TRẢ</h6>
        </div>
        <div class="card-body">
            <table id="BookReturnTable" class="table table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Sách</th>
                    <th>Tên Sách</th>
                    <th>Phạt trạng thái</th>
                    <th>Phạt quá hạn</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="borrowBook__list">
                @foreach($phieutras as $id => $phieutra)
                    <tr class="borrowBook__item">
                        <td>{{$id + 1}}</td>
                        <td>
                            <input type="text" style="background-color: #fff; border:none;" name="details[{{$id}}][product_name]" class="idSach" value="{{$phieutra->IDSach}}" disabled/>
                        </td>
                        <td>
                            {{$phieutra->dausach->tensach}}
                        </td>
                        <td>
                            <input type="text" style="background-color: #fff; border:none;" name="details[{{$id}}][product_name]" class="idSach" value="{{$phieutra->trangthaitra->trangthai}}" disabled/>
                        </td>
                        <td>
                            <input type="text" style="background-color: #fff; border:none;" name="details[{{$id}}][product_name]" class="idSach" value="{{$phieutra->quahan->trangthai}}" disabled/>
                        </td>
                        <td>
                            <div class="trangthai_{{$phieutra->IDSach}}"> @if($phieutra->trangthai == 1) Đã Trả @else Chưa trả @endif </div>
                            <input type="hidden" name="details[{{$id}}][trangthai]" class="trangthai" id="trangthai_{{$phieutra->IDSach}}" value="{{$phieutra->trangthai}}"/>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <!-- View Button -->
                                <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$phieutra->IDSach}}" title="Preview">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <!-- / View Button -->

                                <!-- Update Button -->
                                <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="modal" data-bs-target="#Update_{{$phieutra->IDSach}}" title="Update">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <!-- / Update Button -->

                                <!-- Return Button -->
                                <a href="javascript:void(0);" class="returnOneBookBtn btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-action="return" data-bs-toggle="modal" data-id="DetailReturn_{{$phieutra->IDSach}}" title="Return">
                                    <i class="bi bi-book"></i>
                                </a>
                                <!-- / Return Button -->

                                <!-- Lập phiếu phạt Button -->
                                <a href="{{route('phieuphat.store')}}" class="CreatePhieuPhat btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-maphieutra="{{$phieutra->matra}}" data-id-sach="{{$phieutra->IDSach}}" title="CreatePhieuPhat">
                                    <i class="bi bi-bookmark-plus"></i>
                                </a>
                                <!-- / Lập phiếu phạt Button -->
                            </div>
                        </td>
                    </tr>
                    <!-- -->

                    <!-- Modal Detail Return Book -->
                    <div class="modal fade" id="exampleModal_{{$phieutra->IDSach}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$phieutra->IDSach}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel{{$phieutra->IDSach}}">CHI TIẾT SÁCH TRẢ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- -->
                                <div class="modal-body">
                                    <div class="listDetail">
                                        <ul class="list-group list-group-flush m-0">
                                            <li class="list-group-item list-group-item-action waves-effect">
                                                <strong>Đầu Sách:</strong>
                                                <div class="d-inline-flex justify-content-start align-items-center product-name">
                                                    <div class="avatar-wrapper me-4">
                                                        <div class="avatar rounded-2 bg-label-secondary">
                                                            <img src="{{asset('assets/img/'.$phieutra->dausach->image)}}" alt="" class="rounded-2">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-nowrap text-heading fw-medium">{{$phieutra->dausach->tensach}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action waves-effect">
                                                <strong>Mã Phiếu Trả:</strong>
                                                <span>{{$phieutra->matra}}</span>
                                            </li>
                                            <li class="list-group-item list-group-item-action waves-effect">
                                                <strong>Phạt Trạng Thái:</strong>
                                                <span>{{$phieutra->trangthaitra->trangthai}} - {{$phieutra->trangthaitra->sotien}}</span>
                                            </li>
                                            <li class="list-group-item list-group-item-action waves-effect">
                                                <strong>Phạt Quá Hạn:</strong>
                                                <span>{{$phieutra->quahan->trangthai}} - {{$phieutra->quahan->sotien}}</span>
                                            </li>
                                            <li class="list-group-item list-group-item-action waves-effect">
                                                <strong>Trạng Thái:</strong>
                                                <span class="badge rounded-pill bg-label-danger" text-capitalized="">{{$phieutra->trangthai}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Modal Detail Return Book -->

                    <!-- Modal Detail Return Book -->
                    <div class="modal fade" id="Update_{{$phieutra->IDSach}}" tabindex="-1" aria-labelledby="Update{{$phieutra->IDSach}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Update{{$phieutra->IDSach}}">CẬP NHẬT SÁCH TRẢ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- -->
                                <div class="modal-body">
                                    <form id="DetailReturn_{{$phieutra->IDSach}}" action="{{route('phieutra.updateStatus', ['id' => $phieutra->matra])}}" method="POST">
                                        <!-- -->
                                        <div class="card mb-3">
                                            <ul class="list-group list-group-flush m-0">
                                                <li class="list-group-item list-group-item-action waves-effect">
                                                    <strong>Đầu Sách:</strong>
                                                    <div class="d-flex justify-content-start align-items-center product-name">
                                                        <div class="avatar-wrapper me-4">
                                                            <div class="avatar rounded-2 bg-label-secondary">
                                                                <img src="{{asset('assets/images/Image_Chandung.jpg')}}" alt="" class="rounded-2">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-nowrap text-heading fw-medium">{{$phieutra->dausach->tensach}}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action waves-effect">
                                                    <strong>Phạt Trạng Thái:</strong>
                                                    <div class="form-floating form-floating-outline mb-3">
                                                        <select class="form-select" name="statusPhat" id="statusPhat">
                                                            @foreach($trangthaimuon as $value)
                                                                <option @if($value->id == $phieutra->phat_trangthaisach_id) selected @endif value="{{$value->id}}">{{$value->trangthai}} - {{$value->sotien}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="statusPhat">Status</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action waves-effect">
                                                    <strong>Phạt Quá Hạn:</strong>
                                                    <div class="form-floating form-floating-outline mb-3">
                                                        <select class="form-select" name="status" id="status">
                                                            @foreach($trangthaingay as $value)
                                                                <option @if($value->id == $phieutra->phat_quahan_id) selected @endif value="{{$value->id}}">{{$value->trangthai}} - {{$value->sotien}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="status">Status</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action waves-effect">
                                                    <strong>Trạng Thái:</strong>
                                                    <span class="badge rounded-pill bg-label-danger" text-capitalized="">{{$phieutra->trangthai}}</span>
                                                </li>
                                            </ul>
                                            <input type="hidden" name="maphieutra" value="{{$phieutra->matra}}">
                                            <input type="hidden" name="masach" value="{{$phieutra->IDSach}}">
                                            <input type="hidden" name="action" value="">
                                        </div>
                                        <!-- -->
                                        @csrf
                                    </form>
                                </div>
                                <!-- -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                                    <button type="button" data-action="update" data-id="DetailReturn_{{$phieutra->IDSach}}" class="DetailReturnBook btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Modal Detail Return Book -->
                    <!-- -->
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- -->
    <div>
        <button type="button" @if($phieutra->trangthai == 1) disabled @endif class="returnAll btn btn-success">Xác Nhận Trả Sách</button>
    </div>
    <!-- -->
@endsection

