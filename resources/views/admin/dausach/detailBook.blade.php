@extends('admin.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Book Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- Book Card -->
                <div class="card mb-6">
                    <div class="card-body pt-12">
                        <!-- Name Book -->
                        <div class="user-avatar-section mb-2">
                            <div class=" d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-4" src="{{asset('assets/img/'.$detailBook->image)}}" height="120" width="120" alt="Book avatar">
                                <div class="user-info text-center">
                                    <h5>{{$detailBook->tensach}}</h5>
                                    <span class="badge bg-label-danger rounded-pill">{{$detailBook->masach}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- / Name Book -->
                        <!-- -->
                        <div class="detailBook mb-3">
                            <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                                <div class="d-flex align-items-center" style="gap: 10px">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-primary rounded">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">12</h5>
                                        <span>Đang Mượn</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center" style="gap: 10px">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-primary rounded">
                                            <i class="bi bi-bookmark-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">4</h5>
                                        <span>Đã Mượn</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -->
                        <!-- Detail Book -->
                        <h5 class="pb-4 border-bottom mb-2">Details</h5>
                        <div class="info-container">
                            <ul class="list-unstyled mb-6">
                                <li class="mb-2">
                                    <span class="h6">Mã sách:</span>
                                    <span>{{$detailBook->masach}}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Tên Sách:</span>
                                    <span>{{$detailBook->tensach}}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Thể Loại:</span>
                                    <span>{{$detailBook->theloai->tentl}}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Tác giả:</span>
                                    <span>{{$detailBook->tacgia->hotentg}}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Nhà Xuất Bản:</span>
                                    <span>{{$detailBook->nhaxuatban->tennxb}}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Vị Trí:</span>
                                    <span>{{$detailBook->vitri->vitri_name}}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Trạng Thái:</span>
                                    <span class="badge bg-label-success rounded-pill">
                                       @if($detailBook->trangthai == 1)
                                           active
                                        @else
                                           no active
                                       @endif
                                    </span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Số lượng:</span>
                                    <span>{{$detailBook->soluongsach}}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('dausach.edit',['id' => $detailBook->id])}}" class="btn btn-primary me-4 waves-effect waves-light">Edit</a>
                                <a href="javascript:void(0);" class="btn btn-outline-danger suspend-user waves-effect">Suspend</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Book Card -->
            </div>
            <!--/ Book Sidebar -->

            <!-- Book Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- Slide Image table -->
                <div class="card mb-4">
                    <h5 class="card-header">Ảnh</h5>
                    <hr class="mt-0">
                    <div class="card-body pt-0">
                        <div class="card-datatable table-responsive mb-n8">
                            <img class="w-50" src="{{asset('assets/img/'.$detailBook->image)}}" alt=" {{ $detailBook->tensach }}">
                        </div>
                    </div>
                </div>
                <!-- / Slide Image table -->
                <!-- Desc table -->
                <div class="card mb-4">
                    <h5 class="card-header">Mô Tả Sách</h5>
                    <hr class="mt-0">
                    <div class="card-body pt-0">
                        <div class="card-datatable table-responsive mb-n8">
                            {!! $detailBook->gioithieusach !!}
                        </div>
                    </div>
                </div>
                <!-- / Desc table -->
            </div>
            <!--/ Book Content -->
        </div>
    </div>
@endsection


