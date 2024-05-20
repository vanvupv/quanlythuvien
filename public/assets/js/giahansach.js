$(document).ready(function () {
    // -------------------------------------------------------- //
    $('.renewBookBook').on('click', function () {
        //
        var maphieu = $('#maphieu_phieumuon');
        var idSach = $(this).closest('tr').find('input[name="phieumuonID"]');
        let IdDocgia = $('input[name=IdDocgia]#IdDocgia');
        //
        var renewRoute = $('input[name=routeDetail]').data('value');

        //
        $.ajax ({
            url: renewRoute,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                maphieu: maphieu.val(),
                idSach: idSach.data('id'),
                idDocgia: IdDocgia.val(),
            },
            //
            success: function (response) {
                //
                // console.log(response);
                // console.log(response.data);
                let bookRenew = response.data;
                let ngaytramoi = response.ngaytra;

                if(response.status = 403) {
                    $('.detailRenewModal').html(response.message);
                    return;
                }

                if(response.status = 400) {
                    $('.detailRenewModal').html(response.message);
                    return;
                }

                let bookRenewHtml = bookRenewDetailFunc(bookRenew, ngaytramoi);
                //
                $('.detailRenewModal').html(bookRenewHtml);
            },
            //
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });

    // ------------------------------------------------------------------ //
    // Hàm Hiển Thị Chi Tiết Gia Hạn
    const bookRenewDetailFunc = (bookItem, date) => {
        return `<table class="table">
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
                        <th>Mã Phiếu:</th>
                        <td><span>${bookItem.maphieu}</span></td>
                    </tr>
                    <tr>
                        <th>Mã Sách:</th>
                        <td><span>${bookItem.IDSach}</span></td>
                    </tr>
                    <tr>
                        <th>Ngày Mượn:</th>
                        <td><span>${bookItem.ngaymuon}</span></td>
                    </tr>
                    <tr>
                        <th>Ngày Trả:</th>
                        <td><span>${bookItem.ngaytra}</span></td>
                    </tr>
                     <tr>
                        <th>Ngày Trả Mới:</th>
                        <td><span>${date}</span></td>
                    </tr>
                    <tr>
                        <th>Trạng Thái:</th>
                        <td><span class="badge rounded-pill bg-label-danger" text-capitalized="">${bookItem.trangthai}</span></td>
                    </tr>

                </tbody>
            </table>
            <input type="hidden" name="renewBookID" data-id="${bookItem.IDSach}">`
    }

    /* ------------------------------------------------------------------ */
    $('.renewDetailBook').on('click', function () {
        //
        console.log(">>> Check Click!");
        //
        let maphieu = $('#maphieu_phieumuon');
        let idSach = $(this).closest('tr').find('input[name="phieumuonID"]');
        let IdDocgia = $('input[name=IdDocgia]#IdDocgia');
        //
        let renewDetailRoute = $('input[name=routeBorrowDetail]').data('value');


        //
        $.ajax ({
            url: renewDetailRoute,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                maphieu: maphieu.val(),
                idSach: idSach.data('id'),
                idDocgia: IdDocgia.val(),
            },
            //
            success: function (response) {
                //
                let data = response.data;
                var bookRenewHtml = '';

                if(response.status = 403) {
                    $('.detailRenewBookModal').html(response.message);
                    return;
                }

                data.forEach(function(item, index) {
                    let bookRenewHtmlItem =RenewDetailFunc(item, index);
                    bookRenewHtml += bookRenewHtmlItem;
                });

                //
                $('.detailRenewBookModal').html(bookRenewHtml);
            },

            //
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });

    //
    const RenewDetailFunc = (bookItem, index) => {
        return `<div class="info-container">
                    <ul class="list-unstyled mb-6">
                        <li class="mb-2">
                            <span class="h6"> Lần Mượn: </span>
                            <span>${++index}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6"> Mã Phiếu: </span>
                            <span>${bookItem.maphieu}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6"> Mã sách: </span>
                            <span>${bookItem.dausach.masach}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6"> Tên sách: </span>
                            <span>${bookItem.dausach.tensach}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6"> Ngày Gia Hạn: </span>
                            <span>${bookItem.ngaygiahan}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6"> Ngày Trả: </span>
                            <span>${bookItem.ngayhethan}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6"> Trạng Thái: </span>
                            <span class="badge bg-label-success rounded-pill">
                               ${bookItem.trangthai}
                            </span>
                        </li>
                    </ul>
                </div>
                <hr class="mt-0">`
    }

    // --------------------------------------------------------- //
    $('#detailModal .saveRenew').on('click', function () {

        //
        let maphieu = $('#maphieu_phieumuon');
        let idSach = $(this).closest(".modal-content").find("input[name='renewBookID']");

        //
        var maphieuValue = maphieu.val();
        var idSachValue = idSach.data('id');

        //
        if(!maphieuValue || !idSachValue) {
            alert("Thông tin không hợp lệ");
            return;
        }

        //
        let renewDetailRoute = $('input[name=routeRenewBook]').data('value');
        //
        $.ajax ({
            url: renewDetailRoute,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                maphieu: maphieu.val(),
                idSach: idSach.data('id'),
            },
            //
            success: function (response) {
               console.log(response);
            },
            //
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    })
    /* --------------------------------------------------------- */
});
