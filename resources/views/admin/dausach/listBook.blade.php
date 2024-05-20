@extends('admin.main')
@section('content')
<div class="card listTable">
    @include('share.error')
    <h5 class="card-header">Danh Sách Đầu Sách</h5>
    <hr class="my-0">
    <div class="listTable__add add-new">
        <a href="{{route('dausach.add')}}" class="btn btn-primary waves-effect waves-light" >
            <i class="bi bi-plus-lg me-0 me-sm-1 d-inline-block"></i>
            <span class="d-none d-sm-inline-block"> Add New Book </span>
        </a>
    </div>
    <hr class="my-0">
    <div class="card-body">
        <div class="card-datatable text-nowrap">
            <table id="BookTable" class="listTable__table table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã Sách</th>
                    <th>Tên Sách</th>
                    <th>Trạng Thái</th>
                    <th>Số Lượng Sách</th>
                    <th>Ảnh</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($dausachs)
                    @foreach($dausachs as $dausach)
                    <tr>
                        <td>{{$dausach->id}}</td>
                        <td>{{$dausach->masach}}</td>
                        <td>{{$dausach->tensach}}</td>
                        <td>
                            @if($dausach->trangthai === 1)
                                <span class="badge rounded-pill bg-label-info">Active</span>
                            @else
                                <span class="badge rounded-pill bg-label-danger">No Active</span>
                            @endif
                        </td>
                        <td>
                            @if($dausach->soluongsach > 0)
                                {{$dausach->soluongsach}}
                            @else
                                <span class="badge rounded-pill bg-label-danger">Hết Sách</span>
                            @endif
                        </td>
                        <td>
                            <div class="avatarImg">
                                 <img src="{{asset('assets/img/'.$dausach->image)}}" alt="{{$dausach->tensach}}">
                            </div>
                        </td>
                        <td>
                            <div class="actionFunc">
                                <a href="{{route('dausach.detail',['id' => $dausach->id])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Preview">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{route('dausach.edit',['id' => $dausach->id])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                @if($dausach->trangthai === 1)
                                    <a href="{{route('dausach.inactive',['id' => $dausach->id])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Inactive">
                                        <i class="bi bi-power"></i>
                                    </a>
                                @else
                                    <a href="{{route('dausach.active',['id' => $dausach->id])}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Active">
                                        <i class="bi bi-power"></i>
                                    </a>
                                @endif
                                <a href="{{route('dausach.delete',['id' => $dausach->id])}}" data-route="{{route('dausach.delete',['id' => $dausach->id])}}"  data-id-book="{{$dausach->id}}" class="deleteBookList btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end m-0">
                                    <a href="{{route('dausach.detail',['id' => $dausach->id])}}" class="dropdown-item view-record">
                                        <i class="bi bi-eye"></i>
                                        <span>View</span>
                                    </a>
                                    <a href="{{route('dausach.edit',['id' => $dausach->id])}}" class="dropdown-item edit-record">
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
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Mã Sách</th>
                    <th>Tên Sách</th>
                    <th>Trạng Thái</th>
                    <th>Số Lượng Sách</th>
                    <th>Ảnh</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection



