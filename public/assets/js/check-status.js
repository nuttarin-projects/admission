$("#frmCheck").validate({
    rules:{
        tx_birthdate: "required",
        tx_idcard: {
            required: true,
            number: true,
            minlength: 13,
            maxlength: 13,
            remote: "index.php?mode=chk-idcard"
        }	
    },
    messages:{	
        tx_birthdate: "กรุณากรอกข้อมูล",
        tx_idcard: {
            required: "กรุณากรอกข้อมูล",
            number: "กรอกข้อมูลเป็นตัวเลข",
            minlength: "ต้องกรอกเป็นตัวเลข 13 หลัก",
            maxlength: "ต้องกรอกเป็นตัวเลข 13 หลัก เท่านั้น",
            remote: "เลขที่บัตรประชาชนไม่ถูกต้อง"
        }	
    },
    submitHandler: function(form) {
        let tx_idcard = $('#tx_idcard').val().trim();
        let tx_birthdate = $('#tx_birthdate').val().trim();
        
        $.ajax({
            url: "index.php?mode=chk-status",
            type: "GET",
            dataType: "json",
            data: {
                tx_idcard: tx_idcard,
                tx_birthdate: tx_birthdate
            },
            success: function (rs) {
                if (rs.success == 1) {
                    if (rs.data !== false && rs.data !== "" && rs.data !== null) {
                        // สั่งเปลี่ยนหน้าไปยังหน้า Profile ทันที (Cookie ถูกเซ็ตเรียบร้อยแล้วจากฝั่ง PHP)
                        window.location.href = "index.php?mode=profile"; 
                        $('#cardExist').hide();
                    } else {
                        $('#cardExist').show();
                    }
                }
            }
        });
        return false; // บังคับหยุดไม่ให้รีเฟรชหน้า
    
    }
});