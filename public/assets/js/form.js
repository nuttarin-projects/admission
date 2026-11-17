$(function() {
    $("#dl_fund").chained("#dl_year");
    $("#dl_section").chained("#dl_year");
    $("#dl_type").chained("#dl_section");
    $("#dl_faculty").chained("#dl_type");				
    $("#dl_course").chained("#dl_faculty");
});	

$("#frmAdmis").validate({
    rules:{
        dl_year: "required",
        tx_fname: "required",
        tx_lname: "required",
        tx_fname_en: "required",
        tx_lname_en: "required",
        dl_tname: "required",
        tx_birthdate: "required",
        tx_idcard: {
            required: true,
            number: true,
            minlength: 13,
            maxlength: 13,
            remote: "index.php?mode=chk-idcard"
        },		
        tx_mobile: {
            required: true,
            number: true,
            minlength: 9,
            maxlength: 10
        },
        tx_email: { required: true, email: true },
        dl_education: "required",
        tx_gpa: "required",
        tx_school: "required",
        dl_province: "required",																					
        dl_faculty: "required",
        dl_course: "required",
        dl_type: "required",
        dl_section: "required",
        dl_fund: "required",
        acceptPDPA:"required"
    },
    messages:{	
        dl_year: "กรุณากรอกข้อมูล",
        tx_fname: "กรุณากรอกข้อมูล",
        tx_lname: "กรุณากรอกข้อมูล",
        tx_fname_en: "กรุณากรอกข้อมูล",
        tx_lname_en: "กรุณากรอกข้อมูล",
        dl_tname: "กรุณากรอกข้อมูล",
        tx_birthdate: "กรุณากรอกข้อมูล",
        tx_idcard: {
            required: "กรุณากรอกข้อมูล",
            number: "กรอกข้อมูลเป็นตัวเลข",
            minlength: "ต้องกรอกเป็นตัวเลข 13 หลัก",
            maxlength: "ต้องกรอกเป็นตัวเลข 13 หลัก เท่านั้น",
            remote: "เลขที่บัตรประชาชนไม่ถูกต้อง"
        },	
        tx_mobile: {
            required: "กรุณากรอกข้อมูล",
            minlength: "ต้องกรอกเป็นตัวเลข 10 หลัก",
            maxlength: "ต้องกรอกเป็นตัวเลข 10 หลัก",
            number: "กรอกข้อมูลเป็นตัวเลข"
        },
        tx_email: { required: "กรุณากรอกข้อมูล", email: "กรอกข้อมูลกรอกข้อมูลให้ถูกต้อง" },	
        dl_education: "กรุณากรอกข้อมูล",
        tx_gpa: "กรุณากรอกข้อมูล",
        tx_school: "กรุณากรอกข้อมูล",
        dl_province: "กรุณากรอกข้อมูล",
        dl_faculty: "กรุณาระบุข้อมูล",
        dl_course: "กรุณาระบุข้อมูล",
        dl_type: "กรุณาระบุข้อมูล",
        dl_section: "กรุณาระบุข้อมูล",
        dl_fund: "กรุณาระบุข้อมูล",
        acceptPDPA: "กรุณายอมรับเงื่อนไข"
    },
    submitHandler: function(form) {
        form.submit(); // จะทำงานก็ต่อเมื่อข้อมูลผ่านการตรวจสอบครบถ้วนแล้ว
        alert("บันทึกข้อมูลเรียบร้อยแล้ว");
    }
});


