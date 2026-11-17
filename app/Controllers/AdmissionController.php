<?php

class AdmissionController
{
    private Manager $model;

    public function __construct(Manager $model)
    {
        $this->model = $model;
    }

    // ==========================================
    // 1. ส่วนแสดงผลหน้าเว็บ (Page Views)
    // ==========================================

    // หน้าแรก (Start)
    public function showStart()
    {
        // 1. รับค่า Cookie และตรวจสอบสิทธิ์การเข้าถึงหน้านี้
        $idcard    = $_COOKIE['idcard'] ?? "";
        $birthdate = $_COOKIE['birthdate'] ?? "";
        $admisId   = $_COOKIE['admis_id'] ?? "";

        // เช็ก $admisId ก่อน (หากสมัครเสร็จแล้วให้เด้งไปหน้า Profile ทันที)
        if ($admisId !== "") {
            header("Location: index.php?mode=profile");
            exit;
        }

        // หากกรอกหน้า Start ให้เด้งไปหน้า Form
        if ($idcard !== "" || $birthdate !== "") {
            header( "location: index.php?mode=form");
            exit;
        }

        require_once __DIR__ . '/../../views/start.php';
    }

    public function showForm()
    {
        // 1. รับค่า Cookie และตรวจสอบสิทธิ์การเข้าถึงหน้านี้
        $idcard    = $_COOKIE['idcard'] ?? "";
        $birthdate = $_COOKIE['birthdate'] ?? "";
        $admisId   = $_COOKIE['admis_id'] ?? "";

        // เช็ก $admisId ก่อน (หากสมัครเสร็จแล้วให้เด้งไปหน้า Profile ทันที)
        if ($admisId !== "") {
            header("Location: index.php?mode=profile");
            exit;
        }

        // หากยังไม่ได้กรอกหน้า Start ให้เด้งกลับไปหน้าแรก
        if ($idcard === "" || $birthdate === "") {
            header("Location: index.php");
            exit;
        }

        // 2. ดึงข้อมูลจาก Model เตรียมไว้ให้ไฟล์ View ใช้งาน
        $educationData = $this->model->getEducationAll();
        $yearData      = $this->model->getYearAll();
        $provinceData  = $this->model->getProvinceAll();
        $SectionData   = $this->model->getSectionAll();
        $typeData      = $this->model->getTypeAll();
        $facultyData   = $this->model->getFacultyAll();
        $courseData    = $this->model->getCourseAll();
        $appData       = $this->model->getApplicant($idcard);

        // 3. โหลดไฟล์ View (ตัวแปรด้านบนทั้งหมดจะถูกส่งเข้าไปใช้ใน form.php อัตโนมัติ)
        require_once __DIR__ . '/../../views/form.php';
    }

    // หน้าแสดงข้อมูลผู้สมัครและสถานะ (Profile)
    public function showProfile()
    {
        //$admisId = "69100001";
        $admisId = $_COOKIE['admis_id'] ?? "";

        if ($admisId == "") {
            header( "location: index.php");
            exit(0);
        }

        // ดึงข้อมูลผู้สมัครไปแสดงในหน้า profile.php
        $data = $this->model->getBachelor($admisId);

        //เช็คสถานะชำระเงินแล้ว
        $ref_no = $data["ref_no"] ?? "";
        $admis_id = $data["admis_id"] ?? "";
        $apv_status = $data["apv_status"] ?? "";
        $apv_enroll = $data["apv_enroll"] ?? "";
        $std_id = $data["std_id"] ?? "";

        // ตรวจสอบเงื่อนไขทีละขั้นตอน
        $step1_done = !empty($admis_id); // ถ้ามีค่า = สมัครเรียนสำเร็จ
        $step2_done = !empty($ref_no); // ถ้ามีค่า = แจ้งการชำระเงินสำเร็จ
        $step3_done = ($apv_status == 1); // ถ้าเท่ากับ 1 = ตรวจสอบข้อมูลสำเร็จ
        $step4_done = ($apv_enroll == 1); // ถ้าเท่ากับ 1 = ส่งข้อมูลให้ทะเบียนสำเร็จ
        $step5_done = !empty($std_id); // ถ้ามีค่า = ออกเลขทะเบียนสำเร็จ

        require_once __DIR__ . '/../../views/profile.php';
    }

    // หน้าชำระเงิน (Payment)
    public function showPayment()
    {
        $admisId = $_COOKIE['admis_id'] ?? "";
        //$admisId = "69100001";
        if ($admisId == "") {
            header( "location: index.php");
            exit(0);
        } 

        $data = $this->model->getBachelor($admisId);
        require_once __DIR__ . '/../../views/payment.php';
    }

    // หน้าตรวจสอบสถานะย้อนหลัง (Check-status)
    public function showCheckStatus()
    {
        require_once __DIR__ . '/../../views/check-status.php';
    }

    // ==========================================
    // 2. ส่วนจัดการข้อมูลและบันทึก (Actions)
    // ==========================================
    public function saveStart()
    {
        // 1. ตรวจสอบว่าเป็น POST Request หรือไม่ (ย้ายมาจาก index.php)
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php");
            exit;
        }

        // 2. รับค่าและจัดเตรียมข้อมูล
        $birthdate = $_POST["tx_birthdate"] ?? "";
        $idcard    = trim($_POST["tx_idcard"] ?? "");

        $data = [
            "birthdate" => $birthdate,
            "idcard"    => $idcard
        ];

        // 3. บันทึกลงฐานข้อมูลผ่าน Model
        $result = $this->model->insertApplicant($data);

        // 4. จัดการ Cookie และเปลี่ยนหน้า (ย้ายมาจาก index.php)
        if ($result) {
            setcookie ("idcard",$data["idcard"],time()+ 86400, "/");
            setcookie ("birthdate",$data["birthdate"],time()+ 86400, "/");
            
            header("Location: index.php?mode=form");
            exit;
        } else {
            echo "บันทึกข้อมูลไม่สำเร็จ";
            exit;
        }
    }

    public function saveBachelor()
    {
        // 1. ตรวจสอบว่าเป็น POST Request หรือไม่ (ย้ายมาจาก index.php)
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php");
            exit;
        }

        $name = trim( str_replace(["นางสาว", "น.ส.","นส.","นส ","นาย","น.ส " ],"",$_POST["tx_fname"] ?? "" ));
        $surname = trim($_POST["tx_lname"] ?? "");
        $name_en = trim( str_replace( ["นางสาว","น.ส.","นส.","นส ", "นาย","น.ส "],"",$_POST["tx_fname_en"] ?? "" ));
        $surname_en = trim($_POST["tx_lname_en"] ?? "");
        $title = $_POST["dl_tname"] ?? "";
        $birthday = $_POST["tx_birthdate"] ?? "";
        $idcard = trim($_POST["tx_idcard"] ?? "");
        $applicant_id = trim($_POST["applicant_id"] ?? "");
        $mobile = trim($_POST["tx_mobile"] ?? "");
        $email = trim($_POST["tx_email"] ?? "");
        $line = trim($_POST["tx_line"] ?? "");
        $facebook = trim($_POST["tx_facebook"] ?? "");
        $edu = $_POST["dl_education"] ?? "";
        $gpa = trim($_POST["tx_gpa"] ?? "");
        $school = trim($_POST["tx_school"] ?? "");
        $province = $_POST["dl_province"] ?? "";
        $portfolio = "-";
        $utm_source = $_POST["utm_source"] ?? "";
        $utm_campaign = $_POST["utm_campaign"] ?? "";
        $remark = $_POST["remark"] ?? "";

        $yearTerm = $_POST["dl_year"] ?? "";
        $year = $this->model->getYearId($yearTerm);
        $admis_id = $this->model->getAdmisId($yearTerm);
        $course = $_POST["dl_course"] ?? "";
        $type = $_POST["dl_type"] ?? "";
        $arr = explode("_", $type);
        $type = $arr[0] ?? "";
        $section = $_POST["dl_section"] ?? "";
        $arr = explode("_", $section);
        $section = $arr[0] ?? "";
        $loan = $_POST["dl_fund"] ?? "";
        $fund = "1";
        $fundtype = $_POST["dl_fund2"] ?? "";
        $refcode = $_POST["tx_refcode"] ?? "";
        if ($fundtype == "0") {
            $fund = "0";
            $fundtype = "";
        }

        //Enroll
        $name_en = trim( str_replace( ["นางสาว","น.ส.","นส.","นส ", "นาย","น.ส "],"",$_POST["tx_fname_en"] ?? "" ));
        $surname_en = trim($_POST["tx_lname_en"] ?? "");
        $title = $_POST["dl_tname"] ?? "";
        $birthday = $_POST["tx_birthdate"] ?? "";
        $gpa = trim($_POST["tx_gpa"] ?? "");
        
        /*Prepare Data*/ 
        $data = [
            // Admission
            "admis_id" => $admis_id,
            "applicant_id" => $applicant_id,
            "year" => $year,
            "course" => $course,
            "type" => $type,
            "section" => $section,
            // Fund
            "fund" => $fund,
            "fundtype" => $fundtype,
            "loan" => $loan,
            // Personal
            "name" => $name,
            "surname" => $surname,
            "idcard" => $idcard,
            // Education
            "edu" => $edu,
            "school" => $school,
            "province" => $province,
            // Contact
            "mobile" => $mobile,
            "email" => $email,
            "line" => $line,
            "facebook" => $facebook,
            "portfolio" => $portfolio,
            // Project
            "pro_id" => "",
            // System
            "admis_date" => date("Y-m-d H:i:s"),
            "ip" => $_SERVER["REMOTE_ADDR"] ?? "",
            // Marketing
            "utm_source" => $utm_source,
            "utm_campaign" => $utm_campaign,
            "remark" => $remark,
            "refer" => $refcode,
            // Personal
            "title" => $title,
            "name_en" => $name_en,
            "surname_en" => $surname_en,
            "birthday" => $birthday,
            // Education
            "gpa" => $gpa
        ];

        $result = $this->model->insertBachelor($data);
        $result2 = $this->model->insertEnroll($data);

        if ($result) {
            setcookie ("admis_id",$data["admis_id"],time()+ 86400, "/");
            header("Location: index.php?mode=profile");
            exit;
        } else {
            echo "บันทึกข้อมูลไม่สำเร็จ";
            exit;
        }
    }

    public function savePayment()
    {
        // 1. ตรวจสอบว่าเป็น POST Request หรือไม่ (ย้ายมาจาก index.php)
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php");
            exit;
        }

        $admis_id = $_POST["tx_admis_id"];
        $ref_no = "ADBA" . $admis_id;
        $amount = $_POST["tx_amount"];
        $date = trim($_POST["tx_date"]) . " " . $_POST["dl_hour"] . ":" . $_POST["dl_minute"];		
        $payway = "Transfer";
        $ip = $_SERVER['REMOTE_ADDR'];

        $file_arr = explode(".",basename($_FILES['file_upload']['name']));
        $payment =  $admis_id. date("YmdHis") . "." . $file_arr[sizeof($file_arr)-1];
        

        /*Prepare Data*/ 
        $data = [
            "admis_id" => $admis_id,
            "amount" => $amount,
            "pay_date_time" => $date,
            "pay_slip" => $payment,
            "pay_way" => $payway,
            "ref_no" => $ref_no,
            "add_ip" => $ip
        ];

        /*Insert Database*/ 
        $result = $this->model->insertPayment($data);

        if ($result) {
            header("Location: index.php?mode=profile");
            exit;
        } else {
            echo "บันทึกข้อมูลไม่สำเร็จ";
            exit;
        }
    }

    public function selectPaymentChoice () {
        $choice = $_POST["rb_choice"];

        if( $choice == "Tranfer" ) {
            header("Location: index.php?mode=payment");
            exit;
        } else if ($choice == "Credit") {
            echo "Coming Soon";
        }
    }

    public function logout()
    {
        setcookie("admis_id", "", time() - 86400, "/");
        setcookie("idcard", "", time() - 86400, "/");
        setcookie("birthdate", "", time() - 86400, "/");
        header("Location: index.php");
        exit;
    }

    public function checkDupIdcard () 
    {
        $idcard = trim($_GET["tx_idcard"] ?? ""); 
        $result = $this->model->checkDuplicateIdcard($idcard); 

        header("Content-Type: application/json; charset=utf-8"); 
        echo json_encode ([ "success" => 1, "data" => $result, "errors" => "" ], JSON_UNESCAPED_UNICODE); exit; 
    }

    public function status ()
    {
        $idcard = trim($_GET["tx_idcard"] ?? "");
        $birthdate = trim($_GET["tx_birthdate"] ?? "");

        if ($idcard === "" || $birthdate === "") {
            $response = [
                "success" => 0,
                "data" => false,
                "errors" => "ข้อมูลไม่ครบ"
            ];
        } else {
            $admis_id =  $this->model->checkStatus($idcard,$birthdate);

            setcookie ("admis_id",$admis_id,time()+ 86400, "/");
            setcookie ("idcard",$idcard,time()+ 86400, "/");
            setcookie ("birthdate",$birthdate,time()+ 86400, "/");
            $response = [
                "success" => 1,
                "data" => $admis_id,
                "errors" => ""
            ];
        }
        header("Content-Type: application/json; charset=utf-8");

        echo json_encode(
            $response,
            JSON_UNESCAPED_UNICODE
        );

        exit;
    }

    public function checkIdcard ()
    {
        $idcard = $_GET['tx_idcard'];

        if (strlen($idcard) != 13) {
            echo 'false';
        } else {
            $rev = strrev($idcard); // reverse string ขั้นที่ 0 เตรียมตัว
            //$lastDigit = array_pop($rev);
            $total = 0;
            
            for($i=1;$i<13;$i++) // ขั้นตอนที่ 1 - เอาเลข 12 หลักมา เขียนแยกหลักกันก่อน
            {
                $mul = $i +1;
                $count = $rev[$i]*$mul; // ขั้นตอนที่ 2 - เอาเลข 12 หลักนั้นมา คูณเข้ากับเลขประจำหลักของมัน
                $total = $total + $count; // ขั้นตอนที่ 3 - เอาผลคูณทั้ง 12 ตัวมา บวกกันทั้งหมด
            }
            
            $mod = $total % 11; //ขั้นตอนที่ 4 - เอาเลขที่ได้จากขั้นตอนที่ 3 มา mod 11 (หารเอาเศษ)
            $sub = 11 - $mod; //ขั้นตอนที่ 5 - เอา 11 ตั้ง ลบออกด้วย เลขที่ได้จากขั้นตอนที่ 4
            $check_digit = $sub % 10; //ถ้าเกิด ลบแล้วได้ออกมาเป็นเลข 2 หลัก ให้เอาเลขในหลักหน่วยมาเป็น Check Digit

            if( $rev[0] == $check_digit )  // ตรวจสอบ ค่าที่ได้ กับ เลขตัวสุดท้ายของ บัตรประจำตัวประชาชน
            {					
                echo 'true';	//return true; /// ถ้า ตรงกัน แสดงว่าถูก		
            } else {
                echo 'false'; // ไม่ตรงกันแสดงว่าผิด
            }
        }
        
    }
    
}
