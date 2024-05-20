$(document).ready(function () {
    $('#addDocgia, #editDocgia').validate({
        rules: {
            tendocgia: {
                required: true,
            },
            sodienthoai: {
                required: true,
                phoneNumber: true,
            },
        },
        messages: {
            tendocgia: {
                required: "Tên Độc Giả Không Được Để Trống",
            },
            sodienthoai: {
                required: "Số Điện Thoại Không Được Để Trống",
                phoneNumber: "Số Điện Thoại Gồm 10 Chữ Số",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element.closest('.form-validate'));
        },
        errorClass: "formGroup__error",
    });
    // Thêm phương thức 'phoneNumber'
    $.validator.addMethod("phoneNumber", function(value, element) {
        return this.optional(element) || /^[0-9]{10}$/.test(value);
    }, "Số Điện Thoại Gồm 10 Chữ Số");
});
