@extends('admin.main')
@section('content')
    <form action="{{route('theloai.postedit',['id' => $theloaiDetail->id])}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
        @include('share.error')
        <div class="card">
            <h5 class="card-header"> SỬA THỂ LOẠI </h5>
            <div class="card-body">
                <div class="form-group">
                    <label for="matheloai"> Mã Thể Loại </label>
                    <input  type="text" name="matheloai" class="form-control" id="matheloai" value="{{$matheloai}}" disabled>
                </div>
                <div class="form-group">
                    <label for="tentheloai"> Tên Thể Loại: </label>
                    <input type="text" name="tentheloai" class="form-control" id="tentheloai" placeholder="Nhập tên thể loại... " value="{{$theloaiDetail->tentl}}">
                </div>
                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <textarea name="mota" id="mota" rows="10" cols="80">
                    {{$theloaiDetail->mota}}
                    </textarea>
                    <script>
                        CKEDITOR.replace( 'mota' );
                    </script>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"> Cập nhật </button>
            </div>
        </div>
        @csrf
    </form>
@endsection


