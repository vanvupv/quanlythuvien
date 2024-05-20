@extends('admin.main')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-primary" role="alert">
            {{session('message')}}
        </div>
    @endif
    <!-- -->
    <h1 class="text-center mb-4">Lập Phiếu Trả Sách</h1>
    <!-- -->
    <div class="card mb-3">
        <div class="card-header">
            <h4 class="mb-2">TÌM KIẾM PHIẾU MƯỢN</h4>
            <span>Vui lòng nhập Mã Phiếu và Mã Độc Giả</span>
        </div>
        <hr class="m-0">
        <div class="card-body">
            <form id="searchPhieuForm" class="mb-3" method="POST" action="{{route('phieutra.info')}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="" name="maphieu"
                                   placeholder="Nhập mã phiếu" />
                            <label for="email">Mã Phiếu</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="" name="madocgia"
                                   placeholder="Nhập mã độc giả" />
                            <label for="email">Mã Độc Giả</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Search</button>
                </div>
                @csrf
            </form>
        </div>
    </div>

    <div id="lapphieumuon" class="lapphieumuon">
        <form id="invoiceForm" action="{{route('phieutra.store')}}" method="POST">
            <div class="row mb-4">
                <div class="col-12 col-lg-8">
                    <div class="card issueInfo mb-3">
                        <div class="card-header">
                            <h6 class="card-title m-0">THÔNG TIN PHIẾU MƯỢN</h6>
                        </div>
                        <hr class="m-0">
                        <div class="card-body ">
                           <!-- -->
                        </div>
                    </div>
                    <div class="card readerInfo">
                        <div class="card-header">
                            <h6 class="card-title m-0">THÔNG TIN ĐỘC GIẢ</h6>
                        </div>
                        <hr class="m-0">
                        <div class="card-body">
                            <!-- -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">THÔNG TIN NHÂN VIÊN</h5>
                        </div>
                        <hr class="mt-0">
                        <div class="card-body">
                            <div class="user-avatar-section mb-3">
                                <div class=" d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded mb-4" src="{{asset('theme/assets/img/avatars/Manga.jpg')}}" height="120" width="120"
                                         alt="User avatar">
                                    <div class="user-info text-center">
                                        <h5>{{$nhanviens->name}}</h5>
                                        <span class="badge bg-label-danger rounded-pill">{{$nhanviens->role->role_name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="info-container">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <span class="h6">Email:</span>
                                        <span>{{$nhanviens->email}}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="h6">Status:</span>
                                        <span class="badge bg-label-success rounded-pill">Active</span>
                                    </li>
                                    <li>
                                        <span class="h6">Role:</span>
                                        <span>{{$nhanviens->role->role_name}}</span>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" name="manhanvien" value="{{$nhanviens->id}}">
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="maphieumuonReturn" id="" class="" value="">
            <input type="hidden" name="madocgiaReturn" id="" class="" value="">
            <input type="hidden" name="manhanvienReturn" id="" class="" value="{{Auth::user()->id}}">

            <button type="submit" class="CreateReturn btn btn-success mb-5" disabled>LẬP PHIẾU</button>
            @csrf
        </form>
    </div>
@endsection
