@extends('admin.main')
@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-brand" href="#">Permission Management</div>
</nav>
<div class="container">
    <table class="table user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên Role</th>
            <th>Route Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissionList as $roleList)
            <tr>
                <td>{{$roleList['route_id']}}</td>
                <td>{{ $roleList['route_title'] }}</td>
                <td>{{$roleList['route_name']}}</td>
                <td>{{$role_id}}</td>
                <td>
                    <select name="" class="form-control" id=""
                            onchange="updatePermission(this, {{ $roleList['route_id'] }}, {{ $role_id }})"
                    >
                        <option value="0" {{ $roleList['status'] == 0 ? 'selected' : '' }} >Disable</option>
                        <option value="1" {{ $roleList['status'] == 1 ? 'selected' : '' }}>Enable</option>
                    </select>
                </td>
            </tr>
        @endforeach
        </tbody>
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <script>

            function updatePermission(that, routeID, roleID) {
                let statusNow = $(that).val(); // Thêm var để khai báo biến

                console.log(">>> Check: ", statusNow, routeID, roleID);
                $.post('{{ route('permission_save') }}', {
                    '_token': '{{ csrf_token() }}',
                    'route_id' : routeID,
                    'role_id': roleID,
                    'status' : statusNow
                }, function (data) {
                    // Xử lý dữ liệu sau khi gửi POST nếu cần
                });
            }

        </script>
    </table>
</div>

<li class="nav-item">
    <a href="{{ route('admin.main') }}" class="nav-link">
        <i class="fas fa-light fa-circle"></i>
        <p>Trở về trang admin</p>
    </a>
</li>
@endsection


