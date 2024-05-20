@extends('admin.main')
@section('content')
<!-- -->
<div class="row g-6 mb-4">
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0">Admin</p>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li class="avatar">
                            <span class="avatar-initial rounded-circle pull-up text-body" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="3 more">+3</span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="role-heading">
                        <h5 class="mb-1">Administrator</h5>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal">
                            <p class="mb-0">Edit Role</p>
                        </a>
                    </div>
                    <a href="javascript:void(0);" class="text-secondary"><i class="ri-file-copy-line ri-22px"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0">Admin</p>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li class="avatar">
                            <span class="avatar-initial rounded-circle pull-up text-body" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="3 more">+3</span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="role-heading">
                        <h5 class="mb-1">User</h5>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal">
                            <p class="mb-0">Edit Role</p>
                        </a>
                    </div>
                    <a href="javascript:void(0);" class="text-secondary"><i class="ri-file-copy-line ri-22px"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0">Total users</p>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                            <img class="rounded-circle" src="{{asset('theme/assets/img/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li class="avatar">
                            <span class="avatar-initial rounded-circle pull-up text-body" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="3 more">+3</span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="role-heading">
                        <h5 class="mb-1">Reader</h5>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal">
                            <p class="mb-0">Edit Role</p>
                        </a>
                    </div>
                    <a href="javascript:void(0);" class="text-secondary"><i class="ri-file-copy-line ri-22px"></i></a>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="col-xl-4 col-lg-6 col-md-6">--}}
{{--        <div class="card h-100">--}}
{{--            <div class="row h-100">--}}
{{--                <div class="col-5">--}}
{{--                    <div class="d-flex align-items-end h-100 justify-content-center">--}}
{{--                        <img src="{{asset('theme/assets/img/avatars/5.png')}}" class="img-fluid" alt="Image" width="80">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-7">--}}
{{--                    <div class="card-body text-sm-end text-center ps-sm-0">--}}
{{--                        <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role waves-effect waves-light">Add New Role</button>--}}
{{--                        <p class="mb-0">Add role, if it does not exist</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<!-- -->

<div class="card">

        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Danh Sách Quyền</h5>
            <div class="add-new">
                <!-- Add New -->
                <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" >
                    <i class="bi bi-plus-lg me-0 me-sm-1 d-inline-block"></i>
                    <span class="d-none d-sm-inline-block"> Add New Role </span>
                </a>
                <!-- / Add New -->
            </div>
        </div>

        <div class="card-datatable text-nowrap">
            <div class="container">
                <table id="PhanquyenTable" class="dt-column-search table table-bordered ">
                <!-- Head -->
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <!-- / Head -->
                <!-- Body -->
                <tbody>
                @foreach($roleLists as $roleList)
                    <tr>
                        <td>{{$roleList->id}}</td>
                        <td>{{$roleList->role_name}}</td>
                        <td class="" style="">
                            <div class="d-flex align-items-center">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect delete-record" data-bs-toggle="tooltip" title="Delete Invoice">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <a href="{{ route('permission_setting', ['id' => $roleList->id]) }}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-bs-toggle="tooltip" title="Preview">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end m-0" style="">
                                    <a href="{{ route('permission_setting', ['id' => $roleList->id]) }}" class="dropdown-item">
                                        <i class="bi bi-eye"></i>
                                        <span>View</span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>
                                    <a href="javascript:;" class="dropdown-item delete-record">
                                        <i class="bi bi-trash"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <!-- Footer -->
{{--                <tfoot>--}}
{{--                <tr>--}}
{{--                    <th>ID</th>--}}
{{--                    <th>Role</th>--}}
{{--                    <th>Action</th>--}}
{{--                </tr>--}}
{{--                </tfoot>--}}
                <!-- / Footer -->
            </table>
            </div>
        </div>
    </div>
@endsection




