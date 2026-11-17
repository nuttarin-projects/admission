
$("#frmPayment").validate({
    rules: {
        tx_admis_id: "required",					
        tx_amount:{
            required: true,
            number: true
        },					
        tx_date: "required",
        dl_hour: "required",
        dl_minute: "required",	
        file_upload: { 
            required: true
        }				
    },
    messages: {	
        tx_admis_id: "กรุณาระบุข้อมูลให้ครบถ้วน",
        tx_amount: {
            required: "กรุณากรอกข้อมูลให้ครบถ้วน",
            regex: "กรอกข้อมูลกรอกข้อมูลให้ถูกต้อง",
        },
        tx_date: "กรุณาระบุข้อมูล",
        dl_hour: "ระบุข้อมูล",
        dl_minute: "ระบุข้อมูล",
        file_upload: { 
            required: "กรุณาระบุไฟล์"  
        }	
    },
    submitHandler: function(form) {
        form.submit(); // จะทำงานก็ต่อเมื่อข้อมูลผ่านการตรวจสอบครบถ้วนแล้ว
        alert("บันทึกข้อมูลเรียบร้อยแล้ว");
    }
});

