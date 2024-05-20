$(document).ready(function () {
    $('.CreatePhieuPhat').on('click', function (event) {
        //
        event.preventDefault();
        //
        let maphieutra = $(this).data('maphieutra');
        let idsach = $(this).data('id-sach');
        //
        console.log(maphieutra, idsach);
        //
        let route = $(this).attr('href');
        console.log(route);
        //
        $.ajax ({
            url: route,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                maphieutra: maphieutra,
                idsach: idsach,
            },
            success: function (response) {
                var status = response.status;

                //
                if(status == 403) {
                    let check = confirm(response.message);
                    if(check) {
                        window.location.href = response.route;
                    }
                }

                //
                if(status == 200) {

                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });
});
