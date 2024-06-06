$(document).ready(function () {
    // ----------------------------------------------------- //
    $('#searchPhieuForm').on("submit", function (event) {
        event.preventDefault();
        //
        let maphieu = $(this).find('input[name=maphieu]');
        let madocgia = $(this).find('input[name=madocgia]');
        //
        let route = $(this).attr('action');
        //
        $.ajax ({
            url: route,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                maphieu: maphieu.val(),
                madocgia: madocgia.val(),
            },
            //
            success: function (response) {
                console.log(response);
                var status = response.status;
                var CreateReturn = $('.CreateReturn');

                if(status == 200) {
                    //
                    let readerInfo = response.docgia;
                    let issueInfo = response.data;
                    //
                    //
                    let readerInfoHtml = readerInfoFunc(readerInfo);
                    let issueInfoHTML = issueInfoFunc(issueInfo);
                    //
                    $('.readerInfo > .card-body').html(readerInfoHtml);
                    $('.issueInfo > .card-body').html(issueInfoHTML);
                    //
                    $('input[name=maphieumuonReturn]').val(issueInfo.maphieu);
                    $('input[name=madocgiaReturn]').val(issueInfo.madocgia);
                    //
                    CreateReturn.attr('disabled', false);
                    return;
                }
					 
                if(status == 404) {
                    alert(response.message);
                    $('.readerInfo > .card-body').html('Không tìm thấy thông tin');
                    $('.issueInfo > .card-body').html('Không tìm thấy thông tin');
                    CreateReturn.attr('disabled', true);
                    return;
                }
            },
            //
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });

    /* ------------------------------------------------------ */
    const readerInfoFunc = (reader) => {
        return `<div class="row">
            <div class="col-12 col-md-6">
                <div class="info-container">
                    <ul class="list-unstyled mb-6">
                        <li class="mb-2">
                            <span class="h6">Username:</span>
                            <span>${reader.tendocgia}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6">Mã Độc Giả:</span>
                            <span>${reader.madg}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6">Status:</span>
                            <span class="badge bg-label-success rounded-pill">${reader.trangthaihoatdong}</span>
                        </li>
                        <li class="mb-2">
                            <span class="h6">Số Điện Thoại:</span>
                            <span>${reader.sodienthoai}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-4" src="{{asset('theme/.jpg')}}" height="120" width="120"
                             alt="User avatar">
                        <div class="user-info text-center">
                            <h5>${reader.tendocgia}</h5>
                            <span class="badge bg-label-danger rounded-pill">Reader</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    };

    /* ----------------------------------------------------- */
    const issueInfoFunc = (issue) => {
        return `<div class="info-container">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <span class="h6">Mã Phiếu:</span>
                    <span>${issue.maphieu}</span>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <span class="h6">Ngày Lập:</span>
                    <span>${issue.ngaylap}</span>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <span class="h6">Người Lập:</span>
                    <span>${issue.manv}</span>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <span class="h6">Trạng Thái:</span>
                    <span>${issue.trangthai}</span>
                </div>
            </div>
        </div>`
    };

    // ----------------------------------------------------- //
    $('#invoiceForm').on('submit', function (event) {
        event.preventDefault();
        //
        let maphieumuonReturn = $('input[name=maphieumuonReturn]').val();
        let madocgiaReturn =   $('input[name=madocgiaReturn]').val();
        let manhanvienReturn =   $('input[name=manhanvienReturn]').val();
        //
        if(maphieumuonReturn && madocgiaReturn && manhanvienReturn) {
            $(this).off('submit').submit();
        } else {
            alert('Mã Không Hợp Lệ!');
        }
        //

    });
})
