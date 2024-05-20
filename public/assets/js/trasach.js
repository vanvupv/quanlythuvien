$(document).ready(function () {
    $('.DetailReturnBook').on('click', function () {
        //
        let DetailReturnValue = $(this).data('id');
        let actionValue = $(this).data('action');
        //
        // console.log($('#'+DetailReturnValue).serializeArray());
        console.log(DetailReturnValue);
        //
        $('input[name=action]').val(actionValue)
        //
        $('#'+DetailReturnValue).submit();
    });

    $('.returnOneBookBtn').on('click', function () {
        //
        let returnOneBookBtn = $(this).data('id');
        let actionValue = $(this).data('action');
        //
        console.log(returnOneBookBtn, actionValue);
        //
        $('input[name=action]').val(actionValue);
        //
        $('#'+returnOneBookBtn).submit();
    });
    /* ----------------------------------------------- */

})
