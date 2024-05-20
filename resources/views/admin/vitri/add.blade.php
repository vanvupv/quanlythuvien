
@extends('admin.main')
@section('content')
    <!-- -->
    @if(Session::has('message'))
        <div class="alert alert-primary" role="alert">
            {{session('message')}}
        </div>
    @endif

    <!-- -->
    <form action="{{route('vitri.store')}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
        @include('share.error')
        <div class="card-body">
            <div class="form-group">
                <label for="tenvitri">Tên Vị Trí :</label>
                <input type="text" name="tenvitri" class="form-control" id="tenvitri" placeholder="Nhập tên Vị Trí...">
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

