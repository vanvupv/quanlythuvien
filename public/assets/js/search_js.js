/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    var input, filter, ul, li, a, i;

    // Lấy thẻ input
    input = document.getElementById("myInput");

    // Lấy giá trị cần tìm
    filter = input.value.trim().toUpperCase();
    // console.log(filter);

    // Lấy khối Drop cần tìm kiếm
    div = document.getElementById("myDropdown");

    // Lấy tất cả thẻ a
    a = div.getElementsByTagName("a");
    // console.log(a);

    //
    valueSearch = document.getElementById("valueSearch");


    //
    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent.trim() || a[i].innerText.trim();
        console.log(txtValue);

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            valueSearch.innerText = txtValue;
            return;
        } else {
            valueSearch.innerText = "Không tìm thấy";
        }
    }
}
