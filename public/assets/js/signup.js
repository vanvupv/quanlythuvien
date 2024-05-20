$(document).ready(function () {
    $("#formSignup").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            username: {
                required: true,
                minlength: 6,
                maxlength: 10,
                noSpace: true,
                noSpecialChars: true,
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 10,
                noSpace: true,
                alphanumeric: true,
            },
            "re-password": {
                required: true,
                equalTo: "#password"
            },
        },
        messages: {
            email: {
                required: "Email is required",
                email : "Please enter a valid email address"
            },
            username: {
                required: "Username is required",
                minlength: "Username must be at least 6 characters",
                maxlength: "Username must not exceed 10 characters",
                noSpace: "Username cannot contain spaces",
                noSpecialChars: "Username cannot contain special characters",
            },
            password: {
                required: "Password is required",
                minlength: "Password must be at least 6 characters",
                maxlength: "Password must not exceed 10 characters",
                noSpace: "Password cannot contain spaces",
                alphanumeric: "Password can only contain letters and numbers",
            },
            "re-password": {
                required: "Please re-enter your password",
                equalTo: "Passwords do not match" // Thông báo khi mật khẩu không khớp
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element.closest('.form-validate'));
        },
        errorClass: "formGroup__error",
    });

    // Add custom validation methods
    $.validator.addMethod(
        "noSpace",
        function (value, element) {
            return value.trim().length > 0 && value.indexOf(" ") === -1;
        },
        "Spaces are not allowed"
    );
    $.validator.addMethod(
        "noSpecialChars",
        function (value, element) {
            return /^[a-zA-Z0-9]+$/.test(value);
        },
        "Special characters are not allowed"
    );
    $.validator.addMethod(
        "alphanumeric",
        function (value, element) {
            return /^[a-zA-Z0-9]+$/.test(value);
        },
        "Alphanumeric characters only"
    );
});

