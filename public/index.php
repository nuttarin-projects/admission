<?php
// เปิดแสดง Error ชั่วคราวระหว่างพัฒนา (ขึ้นระบบจริงค่อยปิด)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// เรียกใช้ไฟล์หลักจากโฟลเดอร์ app
require_once __DIR__ . '/../app/Config/DBManager.php';
require_once __DIR__ . '/../app/Models/Manager.php';
require_once __DIR__ . '/../app/Controllers/AdmissionController.php';

// เชื่อมต่อฐานข้อมูลและสร้าง Object ของ Model และ Controller
$database = new DBManager();
$db = $database->getConnection();

$model = new Manager($db);
$controller = new AdmissionController($model);

// รับค่า mode จาก URL (ถ้าไม่มีให้เป็นค่าว่าง)
$mode = $_GET['mode'] ?? '';

// กระจายงานไปยังเมธอดต่างๆ ใน AdmissionController
switch ($mode) {
    // ==========================================
    // ส่วนจัดการข้อมูล / บันทึกฟอร์ม (Actions)
    // ==========================================
    case 'enroll-start':
        $controller->saveStart();
        break;
    case 'enroll-form':
        $controller->saveBachelor();
        break;
    case 'enroll-payment':
        $controller->savePayment();
        break;
    case 'select_choice':
        $controller->selectPaymentChoice();
        break;
    case 'logout':
        $controller->logout();
        break;

    // ==========================================
    // ส่วนแสดงผลหน้าเว็บ (Page Views)
    // ==========================================
    case 'form':
        $controller->showForm();
        break;
    case 'payment':
        $controller->showPayment();
        break;
    case 'profile':
        $controller->showProfile();
        break;
    case 'check-status':
        $controller->showCheckStatus();
        break;
    case 'chk-idcard':
        $controller->checkIdcard();
        break;
    case 'chk-dupidcard':
        $controller->checkDupIdcard();
        break;
    case 'chk-status':
        $controller->status();
        break;
    default:
        // หน้าเริ่มต้น (Start)
        $controller->showStart();
        break;
}
