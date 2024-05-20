@extends('admin.main')
@section('content')
<div class="card listTable">
    @include('share.error')
    <h5 class="card-header">Danh Sách Độc Giả</h5>
    <hr class="my-0">
    <div class="listTable__add add-new">
        <a href="{{route('docgia.add')}}" class="btn btn-primary waves-effect waves-light" >
            <i class="bi bi-plus-lg me-0 me-sm-1 d-inline-block"></i>
            <span class="d-none d-sm-inline-block"> Add New Reader </span>
        </a>
    </div>
    <hr class="my-0">
    <div class="card-body">
        <div class="card-datatable text-nowrap">
            <table id="BookTable" class="listTable__table table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã Độc Giả</th>
                    <th>Tên Độc Giả</th>
                    <th>Trạng Thái</th>
                    <th>Số Điện Thoại</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($docgias)
                    @foreach($docgias as $docgia)
                        <tr>
                            <td>{{$docgia->madocgia}}</td>
                            <td>{{$docgia->madg}}</td>
                            <td>{{$docgia->tendocgia}}</td>
                            <td>
                                @if($docgia->trangthaihoatdong === 1)
                                    <span class="badge rounded-pill bg-label-info">Active</span>
                                @else
                                    <span class="badge rounded-pill bg-label-danger">No Active</span>
                                @endif
                            </td>
                            <td> {{$docgia->sodienthoai}} </td>
                            <td>
                                <div class="actionFunc">
                                    <a data-id-category="{{$docgia->madocgia}}" class="detailCategoryModal btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect"
                                       data-bs-toggle="modal"  data-bs-target="#detailCategoryModal_{{$docgia->madocgia}}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{route('docgia.edit',['id' => $docgia->madocgia])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{route('docgia.delete',['id' => $docgia->madocgia])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <a href="{{route('docgia.detail',['id' => $docgia->madocgia])}}" class="dropdown-item view-record">
                                            <i class="bi bi-eye"></i>
                                            <span>View</span>
                                        </a>
                                        <a href="{{route('docgia.edit',['id' => $docgia->madocgia])}}" class="dropdown-item edit-record">
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
                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailCategoryModal_{{$docgia->madocgia}}" tabindex="-1" aria-labelledby="detailCategoryModalLabel_{{$docgia->madocgia}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailCategoryModalLabel_{{$docgia->madocgia}}"> Chi Tiết Độc Giả </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="info-container">
                                            <ul class="list-unstyled mb-6">
                                                <li class="mb-2">
                                                    <span class="h6"> Mã Độc Giả: </span>
                                                    <span>{{$docgia->madg}}</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6"> Tên Độc Giả: </span>
                                                    <span>{{$docgia->tendocgia}}</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6"> Số Điện Thoại: </span>
                                                    <span>{{$docgia->sodienthoai }}</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6"> Tình Trạng Hoạt Động: </span>
                                                    @if($docgia->trangthaihoatdong === 1)
                                                        <span class="badge rounded-pill bg-label-info">Active</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-label-danger">No Active</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="closeTheLoai btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Modal Detail -->
                    @endforeach
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Mã Độc Giả</th>
                    <th>Tên Độc Giả</th>
                    <th>Trạng Thái</th>
                    <th>Số Điện Thoại</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

