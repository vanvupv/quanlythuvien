@extends('admin.main')
@section('content')
    <form action="{{route('vitri.postedit',['id' => $vitriDetail->id])}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
        @include('share.error')
        <div class="card">
            <h5 class="card-header"> SỬA VỊ TRÍ </h5>
            <div class="card-body">
                <div class="form-group">
                    <label for="mavitri"> Mã Vị Trí </label>
                    <input  type="text" name="mavitri" class="form-control" id="mavitri" value="{{$mavitri}}" disabled>
                </div>

                <div class="form-group">
                    <label for="tenvitri"> Tên Vị Trí: </label>
                    <input type="text" name="tenvitri" class="form-control" id="tenvitri" placeholder="Nhập tên Vị Trí..." value="{{$vitriDetail->vitri_name}}">
                </div>

                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <textarea name="mota" id="mota" rows="10" cols="80">
                        {{$vitriDetail->vitri_title}}
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

