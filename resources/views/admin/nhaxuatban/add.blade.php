
@extends('admin.main')
@section('content')
    <!-- -->
    @if(Session::has('message'))
        <div class="alert alert-primary" role="alert">
            {{session('message')}}
        </div>
    @endif

    <!-- -->
    <form action="{{route('nhaxuatban.store')}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
        @include('share.error')
        <div class="card-body">
            <div class="form-group">
                <label for="tennhaxuatban">Tên Nhà Xuất Bản :</label>
                <input type="text" name="tennhaxuatban" class="form-control" id="tennhaxuatban" placeholder="Nhập tên Nhà xuất bản... ">
            </div>

            <div class="form-group">
                <label for="mota">Mô tả</label>
                <textarea name="mota" id="mota" rows="10" cols="80">

                </textarea>
                <script>
                    CKEDITOR.replace( 'mota' );
                </script>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @csrf
    </form>
@endsection

