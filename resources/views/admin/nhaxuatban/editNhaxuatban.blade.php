
@extends('admin.main')
@section('content')
    <form action="{{route('nhaxuatban.postedit',['id' => $nhaxuatbanDetail->id])}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
        @include('share.error')
        <div class="card">
            <h5 class="card-header"> SỬA TÁC GIẢ </h5>
            <div class="card-body">
                <div class="form-group">
                    <label for="manhaxuatban"> Mã Nhà Xuất Bản </label>
                    <input  type="text" name="manhaxuatban" class="form-control" id="manhaxuatban" value="{{$manhaxuatban}}" disabled>
                </div>

                <div class="form-group">
                    <label for="tennxb"> Tên Nhà Xuất Bản: </label>
                    <input type="text" name="tennxb" class="form-control" id="tennxb" placeholder="Nhập tên Nhà xuất bản..." value="{{$nhaxuatbanDetail->tennxb}}">
                </div>

                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <textarea name="mota" id="mota" rows="10" cols="80">
                        {{$nhaxuatbanDetail->gioithieunxb}}
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

