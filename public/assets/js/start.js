document.addEventListener("DOMContentLoaded", function () {
    const toggler = document.querySelector(".navbar-toggler");
    const menu = document.querySelector("#mainNavbar");

    if (toggler && menu) {
    toggler.addEventListener("click", function () {
        menu.classList.toggle("show");
    });
    }
});


$.validator.addMethod("checkDuplicateIdcard", function(value, element) {
let result = false;
$.ajax({
    url: "index.php?mode=chk-dupidcard",
    type: "GET",
    data: {
        tx_idcard: value
    },
    dataType: "json",
    async: false,
    success: function(rs) {
        if (rs.success == 1) {
            // true = ซ้ำ
            // false = ไม่ซ้ำ
            result = !rs.data;
        }
    },
    error: function(xhr) {
        console.log(xhr.responseText);
        result = false;
    }
});

return result;
});

$("#frmStart").validate({
    rules:{
        tx_birthdate: "required",
        tx_idcard: {
            required: true,
            number: true,
            minlength: 13,
            maxlength: 13,
            remote: "index.php?mode=chk-idcard",
            checkDuplicateIdcard: true
        }	
    },
    messages:{	
        tx_birthdate: "กรุณากรอกข้อมูล",
        tx_idcard: {
            required: "กรุณากรอกข้อมูล",
            number: "กรอกข้อมูลเป็นตัวเลข",
            minlength: "ต้องกรอกเป็นตัวเลข 13 หลัก",
            maxlength: "ต้องกรอกเป็นตัวเลข 13 หลัก เท่านั้น",
            remote: "เลขที่บัตรประชาชนไม่ถูกต้อง",
            checkDuplicateIdcard: "เลขที่บัตรประชาชนนี้ถูกใช้งานแล้ว กรุณาตรวจสอบสถานะ"
        }	
    },
    submitHandler: function(form) {
        form.submit(); // จะทำงานก็ต่อเมื่อข้อมูลผ่านการตรวจสอบครบถ้วนแล้ว
    }
});


