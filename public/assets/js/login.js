$(document).ready(function () {
    // Xử lý sự kiện khi nhấp vào hình con mắt để hiển thị/ẩn mật khẩu
    $("#togglePassword").click(function () {
        const passwordInput = $("#password");
        const icon = $(this).find("i");

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("bi bi-eye-slash").addClass("bi bi-eye");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("bi bi-eye").addClass("bi bi-eye-slash");
        }
    });

    $("#re-togglePassword").click(function () {
        const passwordInput = $("#re-password");
        const icon = $(this).find("i");

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("bi bi-eye-slash").addClass("bi bi-eye");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("bi bi-eye").addClass("bi bi-eye-slash");
        }
    });

      $("#loginForm").validate({
        rules: {
          username: {
            required: true,
            minlength: 6,
            maxlength: 15,
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
        },
        messages: {
          username: {
            required: "Username is required",
            minlength: "Username must be at least 6 characters",
            maxlength: "Username must not exceed 15 characters",
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

