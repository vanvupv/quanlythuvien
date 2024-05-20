<!-- Lib jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Lib jQuery Validator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Lib Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Lib Datatable -->
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

<!-- Lib Laravel File Manager -->
{{--<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>--}}
{{--<script>--}}
{{--    $('#lfm').filemanager('image');--}}
{{--</script>--}}


<!-- Admin JS -->
<script src="{{asset('theme/dist/js/adminlte.js')}}"></script>
<script src="{{asset('theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('theme/assets/vendor/js/menu.js')}}"></script>
<script src="{{asset('theme/assets/js/main.js')}}"></script>
<!-- End Admin JS -->

<!-- Customize -->
<script src="{{asset('assets/js/login.js')}}"></script>
<script src="{{asset('assets/js/signup.js')}}"></script>
<script src="{{asset('assets/js/phieumuon.js')}}"></script>
<script src="{{asset('assets/js/search_js.js')}}"></script>
<script src="{{asset('assets/js/giahansach.js')}}"></script>
<script src="{{asset('assets/js/lapphieutra.js')}}"></script>
<script src="{{asset('assets/js/trasach.js')}}"></script>
<script src="{{asset('assets/js/lapphieuphat.js')}}"></script>
<script src="{{asset('assets/js/docgia.js')}}"></script>
<!-- End Customize -->

<script>
    $(document).ready(function () {
        // -----------
        //
        $('#BookTable1 .deleteBookList').on('click', function (e) {
            e.preventDefault();
            let checkDelete = confirm('Bạn có muốn xóa quyển sách này không?');

            if(!checkDelete) {
                return;
            }

            var idBook = $(this).data('id-book');
            var route = $(this).data('route');


            $.ajax ({
                url: route,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    masach: idBook,
                },
                //
                success: function (response) {
                    console.log(response);
                    let status = 1;
                    if(status == 200) {
                    }

                    if(status == 400) {
                        return;
                    }

                    if(status == 403) {
                        return;
                    }

                    if(status == 404) {
                        return;
                    }
                },
                //
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        })
        // -------------------------------------------------------------------- //
        let tableWidth = $('#BookTable').width(); // Lấy chiều rộng của bảng
        let windowWidth = $('.BookTable').width(); // Lấy chiều rộng của cửa sổ

        let scrollXEnabled = tableWidth > windowWidth; // Kích hoạt scrollX nếu bảng rộng hơn cửa sổ
        let scrollCollapseEnabled = tableWidth > 800; // Giả sử bạn muốn kích hoạt nếu chiều rộng bảng > 800px
 
        $('#BookTable').DataTable({
            "scrollX": scrollXEnabled,
            "scrollCollapse": scrollCollapseEnabled,
            "paging": true, // Kích hoạt phân trang
            "pageLength": 10, // Số bản ghi mỗi trang
            "lengthMenu": [5, 10, 15, 20, 25, 50, 100],
        });

        // -------------------------------------------------------------------- //
        $('#ReaderTable').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_"
            },
        });

        // -------------------------------------------------------------------- //
        $("#tennhanvien").select2();
        // -------------------------------------------------------------------- //
        $("#BangPhieuMuon").DataTable();
        // -------------------------------------------------------------------- //
        $('#PhieuphatTable').DataTable();

        $('#PhanquyenTable').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_"
            },
        });

        // -------------------------------------------------------------------- //
        $('.detailCategoryModal').on('click', function (e) {
            e.preventDefault();
            let hrefRoute = $(this).attr('href');
            let idCategory = $(this).data('id-category');
            console.log('>>> Check: ', hrefRoute, idCategory);
        })

    // ---------------------------------- LẬP PHIẾU MƯỢN ----------------------------- //
        // -- Lấy Thông Tin Độc Giả
        $(".searchReader select#madocgia").select2().on("change", function () {
            // Lấy giá trị của option được chọn
            let selectedValue = $(this).val();
            let listTestRoute = `{{ route('phieumuon.getInfoReader') }}`;

            $.ajax ({
                url: listTestRoute,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    madocgia: selectedValue,
                },
                //
                success: function (response) {
                    console.log(response);
                    var data = response.data;
                    var status = response.status;
                    var infoReaderSearch = $('.infoReaderSearch');

                    if(status == 200) {
                        if(data) {
                            infoReaderSearch.html(infoReaderSearchFunc(data));
                            $('.createPhieumuon').attr('disabled', false);
                            $('.themsachBtn').attr('disabled', false);
                            return;
                        } else {
                            return;
                        }
                    }

                   if(status == 400) {
                        infoReaderSearch.html(response.message);
                        $('.createPhieumuon').attr('disabled', true);
                       $('.themsachBtn').attr('disabled', true);
                       return;
                   }

                    if(status == 403) {
                        infoReaderSearch.html(response.message);
                        $('.createPhieumuon').attr('disabled', true);
                        $('.themsachBtn').attr('disabled', true);
                        return;
                    }

                    if(status == 404) {
                        infoReaderSearch.html(response.message);
                        $('.createPhieumuon').attr('disabled', true);
                        $('.themsachBtn').attr('disabled', true);
                        return;
                    }
                },
                //
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        });
        const infoReaderSearchFunc = (infoReader) => {
            return  `<div class="col-12 col-md-6">
                    <div class=" info-container">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <span class="h6">Username:</span>
                                <span>${infoReader.tendocgia}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Mã Độc Giả:</span>
                                <span>${infoReader.madg}</span>
                            </li>
                             <li class="mb-2">
                                <span class="h6">Số Điện Thoại:</span>
                                <span>${infoReader.sodienthoai}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Status:</span>
                                <span class="badge bg-label-success rounded-pill">${infoReader.trangthaihoatdong}</span>
                            </li>
                            <li>
                                <span class="h6">Role:</span>
                                <span>Reader</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-4" src="" height="120" width="120"
                                 alt="User avatar">
                            <div class="user-info text-center">
                                <h5>${infoReader.tendocgia}</h5>
                                <span class="badge bg-label-danger rounded-pill">Reader</span>
                            </div>
                        </div>
                    </div>
                </div>`
        }

        // -- Lấy Thông Tin Đầu Sách
        $('#selectBookCode select#masach').select2({
            dropdownParent: $("#exampleModal")
        });

        $('#selectBookCode select#masach').on('change', function() {
            //
            var selectedOption = $(this).val().trim();
            var bookCodeList = $('input[name=masachList]').val().trim();
            var bookDetailItem = $('#bookDetail');
            //
            var bookCodeArr = [];
            if(bookCodeList) {
                bookCodeArr = bookCodeList.split(',');
            }
            if (bookCodeArr.includes(selectedOption)) {
                alert("Sách Đã Tồn Tại Trong Danh Sách");
                bookDetailItem.html('');
                return;
            }

            $.ajax({
                url: `{{ route('phieumuon.save') }}`,
                type: 'POST',
                data: {
                    option: selectedOption,
                    bookCodeList: bookCodeList,
                    _token: '{{ csrf_token() }}' // CSRF token để bảo mật
                },
                success: function (response) {
                    var status = response.status;
                    var data = response.data;

                    //
                    if(status == 200) {
                        // Lấy Thông Tin Sách Và Mã Sách
                        bookDetailItem.html(bookDetailFunc(data));
                        return;
                    }

                    //
                    if(status == 400) {
                        bookDetailItem.html(response.message);
                        return;
                    }

                    //
                    if(status == 403) {
                        bookDetailItem.html(response.message);
                        return;
                    }

                    //
                    if(status == 404) {
                        bookDetailItem.html(response.message);
                        return;
                    }
                },
            });
        });

        // -- Save Change - Lưu Thông Tin Đầu Sách
        $('.saveBook').on('click', function () {
            // Lấy Giá Trị Lựa Chọn
            let selectedOption = $('#masach').val().trim();
            let bookCodeList = $('input[name=masachList]').val().trim();

            // DK - 1
            if(!selectedOption) {
                alert("Vui lòng chọn Mã Sách");
                return;
            }

            // Gửi giá trị đã chọn đến server thông qua AJAX
            $.ajax({
                url: `{{ route('phieumuon.saveList') }}`,
                type: 'POST',
                data: {
                    option: selectedOption,
                    bookCodeList: bookCodeList,
                    _token: '{{ csrf_token() }}' // CSRF token để bảo mật
                },
                success: function (response) {
                    console.log(">>> Check Event Save!");
                    console.log(response.status);
                    // Xử Lý Thành Công
                    if(response.status == 200) {
                        // Lấy Thông Tin Sách Và Mã Sách
                        let book = response.data;
                        let maListBook = response.maList.toString();

                        // Hiển Thị Thông Tin Sách
                        let bookListTable = $('#bookListTable');
                        if(!book) {
                            bookListTable.html("Rỗng");
                            return;
                        }
                        bookListTable.append(bookTableFunc(book));
                        //
                        $('input[name=masachList]').val(maListBook);
                        $('#exampleModal').modal('hide');

                        //
                        var bookDetailItem = $('#bookDetail');
                        bookDetailItem.html('');
                        $('select[name=masach]').val('').trigger('change.select2');
                        return;
                    }

                    //
                    if(response.status == 400) {
                        alert(response.message);
                        return;
                    }

                    //
                    if(response.status == 403) {
                        alert(response.message);
                        return;
                    }
                },
            });
        });

        // -- Sự Kiện Close
        $('.closeBook').click(function() {
            // Lấy giá trị đã chọn từ select
            let selectedBook = $('select[name=masach]');
            let bookDetail = $('#bookDetail');
            // Gán Các Giá Trị Ban Đầu
            bookDetail.html('');
            selectedBook.val('').trigger('change.select2');
        });

        // -- Sự Kiện Delete Book
        $(document).on('click', '.deleteBook', function() {
            //
            var bookID = $(this).data('id');
            //
            let bookListCode = $('input[name=masachList]').val();
            // Chia chuỗi thành mảng các giá trị
            let bookListArr = bookListCode.split(',');
            // Lọc mảng để loại bỏ giá trị bookID
            bookListArr = bookListArr.filter(function(code) {
                return code.trim() !== bookID.toString().trim();
            });
            console.log(bookListArr);
            // Nối mảng lại thành chuỗi và cập nhật lại giá trị cho input
            $('input[name=masachList]').val(bookListArr.join(','));
            //
            $(this).closest('tr').remove();
        });

        // -- Submit Form


        // Hàm Hiển Thị Chi Tiết Sách Mượn
        const bookDetailFunc = (bookItem) => {
            return `<table class="table m-0">
                <tbody>
                    <tr>
                        <th>Đầu Sách:</th>
                        <td>
                            <div class="d-flex justify-content-start align-items-center product-name">
                                <div class="avatar-wrapper me-4">
                                    <div class="avatar rounded-2 bg-label-secondary">
                                        <img src="${bookItem.image}" alt="" class="rounded-2">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-nowrap text-heading fw-medium">${bookItem.tensach}</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Danh Mục:</th>
                        <td><span>${bookItem.tentl}</span></td>
                    </tr>
                    <tr>
                        <th>Mã Sách:</th>
                        <td><span>${bookItem.masach}</span></td>
                    </tr>
                    <tr>
                        <th>Số Lượng:</th>
                        <td><span>${bookItem.soluongsach}</span></td>
                    </tr>
                    <tr>
                        <th>Tác Giả:</th>
                        <td><span>${bookItem.hotentg}</span></td>
                    </tr>
                    <tr>
                        <th>Nhà Xuất Bản:</th>
                        <td><span>${bookItem.tennxb}</span></td>
                    </tr>
                    <tr>
                        <th>Trạng Thái:</th>
                        <td><span class="badge rounded-pill bg-label-danger" text-capitalized="">${bookItem.trangthai}</span></td>
                    </tr>
                </tbody>
            </table>`
        }

        // Hàm Giao diện Thêm Sách
        const bookTableFunc = (bookItem) => {
            return `<tr>
                        <td>${bookItem.id}</td>
                        <td>${bookItem.masach}</td>
                        <td>${bookItem.tensach}</td>
                        <td><img style="width:auto; " height="80px" src="${bookItem.image}" alt="${bookItem.tensach}"></td>
                        <td> <button type="button" data-id="${bookItem.id}" class="deleteBook btn btn-secondary"><i class="bi bi-x-lg"></i></button></td>
                    </tr>`;
        };
        // --------------------------------------------------------------------------- //
    });

    //
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('preview-image');
                previewImage.src = e.target.result;
                previewImage.parentNode.style.display = 'block'; // Hiển thị khối chứa ảnh
            };
            reader.readAsDataURL(file); // Đọc nội dung file dưới dạng URL mã hóa base64
        }
    });


</script>
</body>
</html>

