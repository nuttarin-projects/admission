<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครเรียนออนไลน์</title>

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/admission.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container container my-auto py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">

                <!-- กล่องการ์ดฟอร์มสมัครเรียน -->
                <div class="card register-card p-4 p-md-5">
                    <div class="card-body">
                        <!-- หัวข้อหลัก -->
                        <h2 class="card-title text-center mb-2 fw-bold text-purple-dark">ฟอร์มสมัครเรียนออนไลน์</h2>
                        <p class="text-center text-muted mb-4">กรุณากรอกข้อมูลให้ครบถ้วนเพื่อลงทะเบียนเข้าเรียน</p>

                         <!-- เริ่มต้นฟอร์ม -->
                        <form id="frmAdmis" action="index.php?mode=enroll-form" method="POST">
                            <!-- ส่วนที่ 1: ข้อมูลส่วนตัว -->
                            <h5 class="mb-3 fw-bold border-purple pb-2">1. ข้อมูลส่วนตัว</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-semibold">บัตรประจำตัวประชาชน <span class="required">*</span></label>
                                    <input type="text" class="form-control" maxlength="13" value ="<?=htmlspecialchars($idcard)?>" disabled>
                                    <input type="hidden" id="tx_idcard" name="tx_idcard" value="<?=htmlspecialchars($idcard)?>"> 
                                    <input type="hidden" id="applicant_id" name="applicant_id" value="<?=htmlspecialchars($appData["applicant_id"])?>"> 
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="dl_tname" class="form-label text-dark fw-semibold">คำนำหน้า <span class="required">*</span> </label>
                                    <select class="form-select" id="dl_tname" name="dl_tname">
                                        <option value="">คำนำหน้า</option>
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="tx_fname" class="form-label text-dark fw-semibold">ชื่อจริง (ภาษาไทย) <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="tx_fname" name="tx_fname" maxlength="100" placeholder="สมชาย">
                                </div>
                                <div class="col-md-4">
                                    <label for="tx_lname" class="form-label text-dark fw-semibold">นามสกุล (ภาษาไทย) <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="tx_lname" name="tx_lname" maxlength="100"  placeholder="ใจดี">
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="tx_fname_en" class="form-label text-dark fw-semibold">ชื่อจริง (ภาษาอังกฤษ) <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="tx_fname_en" name="tx_fname_en" maxlength="100" placeholder="Somchai">
                                </div>
                                <div class="col-md-4">
                                    <label for="tx_lname_en" class="form-label text-dark fw-semibold">นามสกุล (ภาษาอังกฤษ) <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="tx_lname_en" name="tx_lname_en" maxlength="100"  placeholder="Jaidee" >
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-dark fw-semibold">วันเดือนปีเกิด <span class="required">*</span></label>
                                    <input type="date" id="tx_birthdate" name="tx_birthdate" class="form-control" value="<?=htmlspecialchars($birthdate)?>" disabled>
                                    <input type="hidden" id="tx_birthdate" name="tx_birthdate" value="<?=htmlspecialchars($birthdate)?>">
                                </div>
                            </div>

                            <!-- ส่วนที่ 2: ข้อมูลการติดต่อ -->
                            <h5 class="mb-3 fw-bold border-purple pb-2">2. ข้อมูลการติดต่อ</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="tx_email" class="form-label text-dark fw-semibold">อีเมล <span class="required">*</span></label>
                                    <input type="text" id="tx_email" name="tx_email" class="form-control" maxlength="50"  placeholder="email@exam.com">
                                </div>
                                <div class="col-md-6">
                                    <label for="tx_mobile" class="form-label text-dark fw-semibold">เบอร์โทรศัพท์ <span class="required">*</span></label>
                                    <input type="text" inputmode="numeric" pattern="[0-9]{10}" id="tx_mobile" name="tx_mobile" class="form-control"  maxlength="10" placeholder="098xxxxxxx">
                                </div>
                            </div>

                            <!-- ส่วนที่ 3: ข้อมูลการศึกษา -->
                            <h5 class="mb-3 fw-bold border-purple pb-2">3. ข้อมูลการศึกษา</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="dl_education" class="form-label text-dark fw-semibold">วุฒิการศึกษา <span class="required">*</span></label>
                                    <select name="dl_education" id="dl_education" class="form-select">
                                        <option value="">วุฒิการศึกษา</option>
                                        <?php foreach ($educationData as $row) {?>
                                            <option value="<?=$row['edu_id']?>"><?=$row['edu_desc']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tx_gpa" class="form-label text-dark fw-semibold">เกรดเฉลี่ยสะสม <span class="required">*</span></label>
                                    <input type="text" id="tx_gpa" name="tx_gpa" class="form-control" maxlength="4" placeholder="3.50">
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="tx_school" class="form-label text-dark fw-semibold">โรงเรียนเดิม <span class="required">*</span></label>
                                    <input type="text" id="tx_school" name="tx_school" class="form-control" maxlength="100" placeholder="โรงเรียนเดิม..">
                                </div>
                                <div class="col-md-6">
                                    <label for="dl_province" class="form-label text-dark fw-semibold">จังหวัดโรงเรียนเดิม <span class="required">*</span></label>
                                    <select name="dl_province" id="dl_province" class="form-select">
                                        <option value="">จังหวัด</option>
                                        <?php foreach ($provinceData as $row) {?>
                                            <option value="<?=$row["province_id"]?>"><?=$row["province_name"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- ส่วนที่ 4: วิทยาลัย/คณะ และหลักสูตร -->
                            <h5 class="mb-3 fw-bold border-purple pb-2">4. วิทยาลัย/คณะ และหลักสูตร</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="dl_year" class="form-label text-dark fw-semibold">ปีการศึกษาที่ต้องการสมัคร <span class="required">*</span></label>
                                    <select name="dl_year" id="dl_year" class="form-select">
                                        <option value="">ปีการศึกษา</option>
                                        <?php foreach ($yearData as $row) { ?>
                                            <option value="<?=$row["year_term"]?>"><?=$row["title"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="dl_section" class="form-label text-dark fw-semibold">รอบเวลาเรียน <span class="required">*</span></label>
                                    <select name="dl_section" id="dl_section" class="form-select">
                                        <option value="">รอบเวลาเรียน</option>
                                        <?php foreach ($SectionData as $row) { ?>
                                            <option value="<?=$row["sec_id"]. "_" .$row["year_term"]?>" class="<?=$row["year_term"]?>"><?=$row["sec_desc"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="dl_type" class="form-label text-dark fw-semibold">หลักสูตร <span class="required">*</span></label>
                                    <select name="dl_type" id="dl_type" class="form-select">
                                        <option value="">หลักสูตร</option>
                                        <?php foreach ($typeData as $row) { ?>
                                            <option value="<?=$row["type_id"]. "_" .$row["sec_id"]. "_" .$row["year_term"]?>" class="<?=$row["sec_id"]. "_" .$row["year_term"]?>"><?=$row["type_desc"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="dl_faculty" class="form-label text-dark fw-semibold">คณะ/วิทยาลัย <span class="required">*</span></label>
                                    <select name="dl_faculty" id="dl_faculty" class="form-select">
                                        <option value="">คณะ/วิทยาลัย</option>
                                        <?php foreach ($facultyData as $row) { ?>
                                            <option value="<?=$row["fac_id"]. "_" .$row["type_id"]. "_" .$row["sec_id"]. "_" .$row["year_term"]?>" 
                                                class="<?=$row["type_id"]. "_" .$row["sec_id"]. "_" .$row["year_term"]?>">
                                                <?=$row['fac_name_th']?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="dl_course" class="form-label text-dark fw-semibold">สาขาวิชา <span class="required">*</span></label>
                                    <select name="dl_course" id="dl_course" class="form-select">
                                        <option value="">สาขาวิชา</option>
                                        <?php foreach ($courseData as $row) { ?>
                                            <option value="<?=$row["cou_id"]?>" class="<?=$row["fac_id"]. "_" .$row["type_id"]. "_" .$row["sec_id"]. "_" .$row["year_term"]?>"><?=$row["cou_name_th"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                 <div class="col-md-6">
                                    <label for="dl_faculty" class="form-label text-dark fw-semibold">ประสงค์จะกู้ยืม กยศ. <span class="required">*</span></label>
                                    <select name="dl_fund" id="dl_fund" class="form-select">
                                        <option value="">ระบุ</option>
                                        
                                        <option value="0" class="691">ใช้ทุนส่วนตัว</option>
                                        <option value="1" class="691">ประสงค์กู้ยืม กยศ.
                                        </option>
                                        <option value="2" class="691">เป็นผู้กู้ กยศ.
                                            รายเก่า</option>
                                    </select>
                                </div>
                            </div>
                        
                            <!-- เงื่อนไขและการกดยอมรับ -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="acceptPDPA" name="acceptPDPA">
                                <label class="form-check-label small text-secondary" for="acceptPDPA">
                                ฉันยอมรับเงื่อนไขการสมัครเรียน และยืนยันว่าข้อมูลข้างต้นเป็นความจริง
                                </label>
                            </div>

                            <!-- ปุ่มส่งข้อมูลสมัครเรียน -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-light btn-clear btn-lg px-4 me-md-2">ล้างข้อมูล</button>
                                <button type="submit" class="btn btn-submit btn-lg px-5 text-white fw-bold">ส่งใบสมัคร</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- จบกล่องการ์ด -->
            </div>
        </div>
    </div>

    <!-- Validate -->   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.22.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-chained/1.0.1/jquery.chained.min.js" integrity="sha512-rcWQG55udn0NOSHKgu3DO5jb34nLcwC+iL1Qq6sq04Sj7uW27vmYENyvWm8I9oqtLoAE01KzcUO6THujRpi/Kg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/form.js"></script>
</body>
</html>