@extends('admin.main')
@section('content')
<div class="card listTable">
    <h5 class="card-header">DANH SÁCH PHIẾU TRẢ</h5>
    <hr class="my-0">
    <div class="listTable__add add-new">
        <a href="{{route('phieumuon.create')}}" class="btn btn-primary waves-effect waves-light" >
            <i class="bi bi-plus-lg me-0 me-sm-1 d-inline-block"></i>
            <span class="d-none d-sm-inline-block"> Add New Return </span>
        </a>
    </div>
    <hr class="my-0">
    <div class="card-body">
        <div class="card-datatable text-nowrap">
            <table id="BangPhieuTra" class="listTable__table table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Phiếu Trả</th>
                        <th>Mã Phiếu Mượn</th>
                        <th>Mã Nhân Viên</th>
                        <th>Mã Độc Giả</th>
                        <th>Ngày Trả</th>
                        <th>Trạng thái trả</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($phieutras as $phieutra)
                <tr>
                    <td>{{$phieutra->matra}}</td>
                    <td>{{$phieutra->maphieu}}</td>
                    <td>{{$phieutra->nhanvien->name}}</td>
                    <td>{{$phieutra->docgia->tendocgia}}</td>
                    <td>{{$phieutra->ngaytra}}</td>
                    <td>
                        @if($phieutra->trangthai === 1)
                            <span class="badge rounded-pill bg-label-info">Active</span>
                        @else
                            <span class="badge rounded-pill bg-label-danger">No Active</span>
                        @endif
                    </td>
                    <td>
                        <div class="actionFunc">
                            <a href="{{route('phieutra.view',[$phieutra->matra])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Preview">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{route('phieutra.view',[$phieutra->matra])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{route('phieutra.view',[$phieutra->matra])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-book-half"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Delete">
                                <i class="bi bi-trash"></i>
                            </a>
                            <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end m-0">
                                <a href="{{route('phieutra.view',[$phieutra->matra])}}" class="dropdown-item view-record">
                                    <i class="bi bi-eye"></i>
                                    <span>View</span>
                                </a>
                                <a href="{{route('phieutra.view',[$phieutra->matra])}}" class="dropdown-item edit-record">
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
                </tr>
                @endforeach
            </tbody>
                <tfoot>
                    <tr>
                        <th>Mã Phiếu Trả</th>
                        <th>Mã Phiếu Mượn</th>
                        <th>Mã Nhân Viên</th>
                        <th>Mã Độc Giả</th>
                        <th>Ngày Trả</th>
                        <th>Trạng thái trả</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

