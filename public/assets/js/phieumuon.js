$(document).ready(function () {
   $('#lapphieuCard #lapphieumuon').validate({
       rules: {
           madocgia: {
               required: true, // Phương pháp kiểm tra 'required' đảm bảo rằng trường không được để trống
           },
           masachList: {
               required: true,
           }
       },
       messages: {
           madocgia: {
               required: "Vui lòng chọn mã độc giả hợp lệ.", // Thông báo khi giá trị của trường là rỗng
           },
           masachList: {
               required: "Vui lòng Chọn sách."
           }
       },
   });
    //
    $('#lapphieuCard #lapphieumuon').on('submit', function(event) {
        event.preventDefault();
        var masachListValue = $('#masachList').val();
        if(!masachListValue) {
            alert('Vui lòng thêm sách mượn');
            return;
        }
        // Nếu không có vấn đề, cho phép gửi biểu mẫu
        $(this).off('submit').submit();
    });
});


