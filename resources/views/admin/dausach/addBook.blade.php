@extends('admin.main')
@section('content')
    <div class="card">
        <form action="{{route('dausach.store')}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
        @include('share.error')
        <div class="card-body">
            <div class="infoBook">
                <div class="infoBook__title">
                    <h6>1. Infomation Book</h6>
                    <hr class="mt-0">
                </div>
                <div class="infoBook__content">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="hidden" name="masach" class="form-control" value="{{$bookCode}}">
                                <input type="text" name="masach" class="form-control" id="masach_bookCode" value="{{$bookCode}}" disabled>
                                <label for="masach">Mã Sách</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" name="tensach" class="form-control" id="tensach" placeholder="Nhập tên sách... ">
                                <label for="tensach">Tên Sách</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <!-- Form Select -->
                            <div class="form-floating form-floating-outline mb-3">
                                <select class="form-select" name="trangthai" id="trangthai">
                                    <option value="1" selected>Active</option>
                                    <option value="0">No Active</option>
                                </select>
                                <label for="trangthai"> Trạng Thái </label>
                            </div>
                            <!-- / Form Select -->
                        </div>
                        <!-- -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating form-floating-outline mb-3">
                                <select name="theloai" id="theloai" class="form-select">
                                    <option value="">Vui lòng chọn Thể loại</option>
                                    @foreach ($maloais as $id => $maLoai)
                                        <option value="{{ $id }}">{{$maLoai}}</option>
                                    @endforeach
                                </select>
                                <label for="theloai">Thể Loại</label>
                            </div>
                        </div>
                        <!-- -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating form-floating-outline mb-3">
                                <select name="tacgia" id="tacgia" class="form-select">
                                    <option value="">Vui lòng chọn Tác giả</option>
                                @foreach ($tacgias as $id => $tacgia)
                                        <option value="{{ $id }}">{{ $tacgia }}</option>
                                    @endforeach
                                </select>
                                <label for="tacgia">Tác Giả</label>
                            </div>
                        </div>
                        <!-- -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating form-floating-outline mb-3">
                                <select name="nhaxuatban" id="nhaxuatban" class="form-select">
                                    <option value="">Vui lòng chọn Nhà xuất bản</option>
                                @foreach ($nhaxuatbans as $id => $nhaxuatban)
                                        <option value="{{ $id }}">{{ $nhaxuatban }}</option>
                                    @endforeach
                                </select>
                                <label for="nhaxuatban">Nhà Xuất Bản</label>
                            </div>
                        </div>
                        <!-- -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating form-floating-outline mb-3">
                                <select name="vitri" id="vitri" class="form-select">
                                    <option value="">Vui lòng chọn Vị trí</option>
                                @foreach ($vitris as $id => $vitri)
                                        <option value="{{ $id }}">{{ $vitri }}</option>
                                    @endforeach
                                </select>
                                <label for="vitri"> Vị Trí Để Sách </label>
                            </div>
                        </div>
                        <!-- -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="number" min="0" name="soluong" class="form-control" id="soluong" placeholder="Nhập số lượng sách... ">
                                <label for="soluong">Số Lượng Sách</label>
                            </div>
                        </div>
                        <!-- -->
                    </div>
                </div>
            </div>

            <div class="imgBook mb-3">
                <div class="imgBook__title">
                    <h6>2. List Images Book</h6>
                    <hr class="mt-0">
                </div>
                <div class="imgBook__content">
                    <div class="form-floating form-floating-outline mb-3">
                        <div class="d-flex">
                            <input type="file" name="image" class="form-control form-control-input" id="image" accept="image/*">
                        </div>
                    </div>
                    <div class="imageInfo" style="padding:15px;display: none;">
                        <img id="preview-image" src="" alt="" style="max-width: 200px; max-height: 200px;">
                    </div>
                </div>
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
    </div>
@endsection

	 	 
