@extends('admin.main')
@section('content')
    <div class="card">
        <form action="{{route('docgia.postedit',['id' => $detailDocgia->madocgia ])}}" method="POST" id="editDocgia" novalidate="novalidate" enctype="multipart/form-data">
            @include('share.error')
            <div class="card-body">
                <div class="infoBook">
                    <div class="infoBook__title">
                        <h6>1. Infomation Reader</h6>
                        <hr class="mt-0">
                    </div>
                    <div class="infoBook__content">
                        <div class="row">
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input type="hidden" name="madocgia" value="{{$detailDocgia->madg}}">
                                    <input type="text" name="madocgia" class="form-control" id="madocgia_bookCode" value="{{$detailDocgia->madg}}" disabled>
                                    <label for="madocgia_bookCode"> Mã Độc Giả </label>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-validate">
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" name="tendocgia" class="form-control" id="tendocgia" placeholder="Nhập tên Độc giả..." value="{{$detailDocgia->tendocgia}}">
                                        <label for="tendocgia">Tên Độc Giả</label>
                                    </div>
                                </div>
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <!-- Form Select -->
                                <div class="form-floating form-floating-outline mb-3">
                                    <select class="form-select" name="trangthai" id="trangthai">
                                        <option value="1" @if($detailDocgia->trangthaihoatdong === 1) selected @endif>Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="3">Suspended</option>
                                    </select>
                                    <label for="trangthai"> Trạng Thái </label>
                                </div>
                                <!-- / Form Select -->
                            </div>
                            <!-- -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-validate">
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" min="0" name="sodienthoai" class="form-control" id="sodienthoai" placeholder="Nhập số điện thoại..." value="{{$detailDocgia->sodienthoai}}">
                                        <label for="sodienthoai"> Số Điện Thoại </label>
                                    </div>
                                </div>
                            </div>
                            <!-- -->
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <textarea name="mota" id="mota" rows="10" cols="80"> </textarea>
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

