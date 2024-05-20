@extends('admin.main')
@section('content')
<form action="{{route('tacgia.postedit',['id' => $tacgiaDetail->id])}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
    @include('share.error')
    <div class="card">
        <h5 class="card-header"> SỬA TÁC GIẢ </h5>
        <div class="card-body">
            <div class="form-group">
                <label for="matacgia"> Mã Tác Giả </label>
                <input  type="text" name="matacgia" class="form-control" id="matacgia" value="{{$matacgia}}" disabled>
            </div>

            <div class="form-group">
                <label for="tentacgia"> Tên Tác Giả: </label>
                <input type="text" name="tentacgia" class="form-control" id="tentacgia" placeholder="Nhập tên Tác giả..." value="{{$tacgiaDetail->hotentg}}">
            </div>

            <div class="form-group">
                <label for="mota">Mô tả</label>
                <textarea name="mota" id="mota" rows="10" cols="80">
                {{$tacgiaDetail->gioithieu}}
            </textarea>
                <script>
                    CKEDITOR.replace( 'mota' );
                </script>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"> Cập nhật </button>
        </div>
    </div>
    @csrf
</form>
@endsection

