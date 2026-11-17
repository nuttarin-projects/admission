<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เริ่มต้นสมัครเรียนออนไลน์</title>

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
                <a class="nav-link active px-3" href="index.php">สมัครเรียน</a>
                </li>
                <li class="nav-item">
                <a class="nav-link px-3" href="index.php?mode=check-status">ตรวจสอบสถานะ</a>
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
                        <!-- หัวข้อหลัก -->
                        <h2 class="card-title text-center mb-2 fw-bold text-purple-dark">เริ่มต้นการสมัคร</h2>
                        <p class="text-center text-muted mb-4">กรุณากรอกข้อมูลเพื่อเริ่มต้นการสมัครเรียน</p>
                        <!-- เริ่มต้นฟอร์ม -->
                        <form id="frmStart" action="index.php?mode=enroll-start" method="POST">
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label for="tx_idcard" class="form-label text-dark fw-semibold">บัตรประจำตัวประชาชน <span class="required">*</span></label>
                                    <input type="text" id="tx_idcard" name="tx_idcard" class="form-control" maxlength="13" placeholder="123xxxxxxxxxx">
                                </div>
                                <div class="col-md-12">
                                    <label for="tx_birthdate" class="form-label text-dark fw-semibold">วันเดือนปีเกิด <span class="required">*</span></label>
                                    <input type="date" id="tx_birthdate" name="tx_birthdate" class="form-control">
                                </div>
                            </div>
                            
                            <!-- กล่องเตือนข้อความสำคัญ เรื่องเลขบัตรฯ และวันเกิด -->
                            <div class="alert alert-purple d-flex align-items-center mb-4" role="alert">
                                <!-- ไอคอนเครื่องหมายตกใจ (!) แบบ SVG -->
                                <svg xmlns="http://w3.org" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-3" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div>
                                    <strong class="d-block mb-1">ข้อมูลสำคัญ!</strong>
                                    เลขประจำตัวประชาชนและวันเดือนปีเกิดจะใช้สำหรับตรวจสอบข้อมูลผู้สมัครและป้องกันการสมัครซ้ำ
                                </div>
                            </div>

                            <!-- ปุ่มถัดไปหน้าสมัคร -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-submit btn-lg px-5 text-white fw-bold">ถัดไป</button>
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
    <script src="assets/js/start.js"></script>
</body>
</html>