@extends('admin.main')
@section('content')
    <!-- -->
    @if(Session::has('message'))
        <div class="alert alert-primary" role="alert">
            {{session('message')}}
        </div>
    @endif

    <!-- -->
    <form action="{{route('tacgia.store')}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
        @include('share.error')
        <div class="card-body mb-3">
            <div class="form-group mb-3">
                <label for="tentacgia">Tên Tác Giả :</label>
                <input type="text" name="tentacgia" class="form-control" id="tentacgia" placeholder="Nhập tên Tác giả... ">
            </div>

            <div class="form-group mb-3">
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

