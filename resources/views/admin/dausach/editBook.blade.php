@extends('admin.main')
@section('content')
    <div class="card">
        <form action="{{route('dausach.postedit', ['id' => $detailBook->id])}}" method="POST" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
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
                                    <input type="hidden" name="masach" class="form-control" value="{{$detailBook->masach}}">
                                    <input type="text" name="masach" class="form-control" id="masach_bookCode" value="{{$detailBook->masach}}" disabled>
                                    <label for="masach">Mã Sách</label>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" name="tensach" class="form-control" id="tensach" placeholder="Nhập tên sách..." value="{{$detailBook->tensach}}">
                                    <label for="tensach">Tên Sách</label>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <!-- Form Select -->
                                <div class="form-floating form-floating-outline mb-3">
                                    <select class="form-select" name="trangthai" id="trangthai">
                                        <option value="1"  @if($detailBook->trangthai === 1) selected @endif>Active</option>
                                        <option value="0" @if($detailBook->trangthai === 0) selected @endif>No Active</option>
                                    </select>
                                    <label for="trangthai">Status</label>
                                </div>
                                <!-- / Form Select -->
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <select name="theloai" id="theloai" class="form-select">
                                        @foreach ($maloais as $id => $maLoai)
                                            <option @if($detailBook->matl == $id) selected @endif value="{{ $id }}">{{$maLoai}}</option>
                                        @endforeach
                                    </select>
                                    <label for="theloai">Thể Loại</label>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <select name="tacgia" id="tacgia" class="form-select">
                                        @foreach ($tacgias as $id => $tacgia)
                                            <option @if($detailBook->matg == $id) selected @endif value="{{ $id }}">{{ $tacgia }}</option>
                                        @endforeach
                                    </select>
                                    <label for="tacgia">Tác Giả</label>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <select name="nhaxuatban" id="nhaxuatban" class="form-select">
                                        @foreach ($nhaxuatbans as $id => $nhaxuatban)
                                            <option @if($detailBook->manxb == $id) selected @endif value="{{ $id }}">{{ $nhaxuatban }}</option>
                                        @endforeach
                                    </select>
                                    <label for="nhaxuatban">Nhà Xuất Bản</label>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="number" min="0" name="soluong" class="form-control" id="soluong" placeholder="Nhập số lượng sách..." value="{{$detailBook->soluongsach}}">
                                    <label for="soluong">Số Lượng Sách</label>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <select name="vitri" id="vitri" class="form-select">
                                        <option value="">Vui lòng chọn Vị trí</option>
                                        @foreach ($vitris as $id => $vitri)
                                            <option @if($detailBook->mavitri == $id) selected @endif  value="{{ $id }}">{{ $vitri }}</option>
                                        @endforeach
                                    </select>
                                    <label for="vitri"> Vị Trí Để Sách </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="imgBook">
                    <div class="imgBook__title">
                        <h6>2. List Images Book</h6>
                        <hr class="mt-0">
                    </div>
                    <div class="imgBook__content">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="file" name="image" class="form-control" id="image" accept="image/*">
                            <label for="">Thêm Ảnh</label>
                        </div>

                            <div class="imageInfo" style="padding:15px;">
                                <img id="preview-image" src="@if($detailBook->image) {{asset('assets/img/'.$detailBook->image)}}  @endif"
                                     alt="{{$detailBook->tensach}}" style="max-width: 200px; max-height: 200px;">
                            </div>
                    </div>
                </div>
                <hr class="mt-3">
                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <textarea name="mota" id="mota" rows="10" cols="80">
                        {!! $detailBook->gioithieusach !!}
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
