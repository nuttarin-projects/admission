<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบสถานะ</title>

     <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/admission.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-white-purple w-100 mb-4">
        <div class="container">
            <!-- ชื่อระบบ / โลโก้ -->
            <a class="navbar-brand fw-bold" href="index.php">ระบบรับสมัครเรียนออนไลน์</a>
            
            <!-- ปุ่มเปิดเมนูบนมือถือ -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- รายการเมนู -->
            <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                <li class="nav-item">
                <a class="nav-link px-3" href="index.php">สมัครเรียน</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active px-3" href="index.php?mode=check-status">ตรวจสอบสถานะ</a>
                </li>
                <li class="nav-item">
                <a class="nav-link px-3" href="">ดูหลักสูตร</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container my-auto py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">

                <!-- กล่องการ์ดฟอร์มสมัครเรียน -->
                <div class="card register-card p-4 p-md-5">
                    <div class="card-body">
                        <!-- ส่วนหัวข้อพร้อมไอคอนวงกลมตรงกลาง -->
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-light text-purple-dark rounded-circle mb-3" style="width: 64px; height: 64px;">
                                <i class="bi bi-search fs-3"></i>
                            </div>
                            <h2 class="card-title mb-1 fw-bold text-purple-dark">ตรวจสอบสถานะการสมัคร</h2>
                            <p class="text-muted small">กรอกข้อมูลที่เคยลงทะเบียนไว้ เพื่อติดตามผลและชำระเงิน</p>
                        </div>
                        <!-- เริ่มต้นฟอร์ม -->
                        <form id="frmCheck">  
                            <div id="cardExist" class="alert alert-purple align-items-center mb-4" role="alert" style="display:none">
                                <div>
                                    <strong class="d-block mb-1">ไม่พบข้อมูลการลงทะเบียน!</strong>
                                    <a href="index.php">คลิกที่นี่</a> เพื่อลงทะเบียน
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label for="tx_idcard" class="form-label text-dark fw-semibold">บัตรประจำตัวประชาชน <span class="required">*</span></label>
                                    <input type="text" id="tx_idcard" name="tx_idcard" class="form-control infoCheck" maxlength="13" placeholder="123xxxxxxxxxx">
                                </div>
                                <div class="col-md-12">
                                    <label for="tx_birthdate" class="form-label text-dark fw-semibold">วันเดือนปีเกิด <span class="required">*</span></label>
                                    <input type="date" id="tx_birthdate" name="tx_birthdate" class="form-control infoCheck">
                                </div>
                            </div>
                            <!-- ปุ่มกดแบบเต็มความกว้าง -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-submit btn-lg text-white fw-bold shadow-sm">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>เข้าสู่ระบบตรวจสอบสถานะ
                                </button>
                            </div>
                           
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Validate -->   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.22.1/jquery.validate.min.js"></script>
    <script src="assets/js/check-status.js?t=2"></script>
</body>
</html>