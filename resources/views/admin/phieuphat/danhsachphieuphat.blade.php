@extends('admin.main')
@section('content')
<div class="card listTable">
    <h5 class="card-header">DANH SÁCH PHIẾU PHẠT</h5>
    <hr class="m-0">
    <div class="listTable__add add-new">
        <a href="#" class="btn btn-primary waves-effect waves-light" >
            <i class="bi bi-plus-lg me-0 me-sm-1 d-inline-block"></i>
            <span class="d-none d-sm-inline-block">Add New Citation  </span>
        </a>
    </div>
    <hr class="m-0">
    <div class="card-body">
        <div class="card-datatable text-nowrap">
            <table id="PhieuphatTable" class="listTable__table table table-bordered">
                <thead>
                <tr>
                    <th>Mã Phiếu Phạt</th>
                    <th>Mã Phiếu Trả</th>
                    <th>Ngày Lập Phiếu</th>
                    <th>Ngày Hoàn Thành</th>
                    <th>Trạng Thái Trả</th>
                    <th>Số Tiền Phạt</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($phieunopphats as $phieunopphat)
                    <tr>
                        <td>{{$phieunopphat->maphat}}</td>
                        <td>{{$phieunopphat->matra}}</td>
                        <td>{{$phieunopphat->ngaylapphieu}}</td>
                        <td>{{$phieunopphat->ngayhoanthanh}}</td>
                        <td>
                            @if($phieunopphat->trangthaitra === 1)
                                <span class="badge rounded-pill bg-label-info">Active</span>
                            @else
                                <span class="badge rounded-pill bg-label-danger">No Active</span>
                            @endif
                        </td>
                        <td>{{$phieunopphat->sotienphat}}</td>
                        <td>
                            <div class="actionFunc">
                                <a href="{{route('phieuphat.view',['id' => $phieunopphat->maphat])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Preview">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{route('phieuphat.view',['id' => $phieunopphat->maphat])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{route('phieuphat.view',['id' => $phieunopphat->maphat])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-book-half"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end m-0">
                                    <a href="{{route('phieuphat.view',['id' => $phieunopphat->maphat])}}" class="dropdown-item view-record">
                                        <i class="bi bi-eye"></i>
                                        <span>View</span>
                                    </a>
                                    <a href="{{route('phieuphat.view',['id' => $phieunopphat->maphat])}}" class="dropdown-item edit-record">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>
                                    <a href="#" class="dropdown-item delete-record">
                                        <i class="bi bi-trash"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr
                @endforeach
                </tbody>
                <!-- / Body -->
                <!-- Footer -->
                <tfoot>
                <tr>
                    <th>Mã Phiếu Phạt</th>
                    <th>Mã Phiếu Trả</th>
                    <th>Ngày Lập Phiếu</th>
                    <th>Ngày Hoàn Thành</th>
                    <th>Trạng Thái Trả</th>
                    <th>Số Tiền Phạt</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <!-- / Footer -->
            </table>
        </div>
    </div>
    </div>
@endsection


