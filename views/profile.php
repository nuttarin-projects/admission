<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้สมัครเรียน</title>

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/admission.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container my-auto py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                <!-- กล่องการ์ดข้อมูลผู้สมัครเรียน-->
                <div class="card register-card p-4 p-md-5">
                    <div class="card-body">
                        <!-- แถบหัวข้อด้านบนสุดของการ์ด พร้อมปุ่ม Logout มุมขวา -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold text-purple-dark mb-0">ข้อมูลผู้สมัครเรียน</h3>
                            <small class="text-muted">ตรวจสอบสถานะและข้อมูลส่วนตัว</small>
                        </div>
                        
                        <!-- ปุ่มกด Logout ลิงก์ไปยังไฟล์ประมวลผล -->
                        <a href="index.php?mode=logout" class="btn btn-danger btn-sm px-3 py-2 fw-semibold" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่?');">
                            ออกจากระบบ
                        </a>
                        </div>
                        
                        <!-- ส่วนที่ 1: ข้อมูลส่วนตัว -->
                        <h5 class="mb-3 fw-bold border-purple pb-2">รายละเอียด</h5>
                        <div class="row">
                            <div class="col-md-6"><p><strong>เลขที่ใบสมัคร : </strong> <?=$data["admis_id"]?></p></div>
                            <div class="col-md-6"><p><strong>ปีการศึกษา : </strong> <?=$data["year_id"]?></p></div>
                            <div class="col-md-6"><p><strong>ชื่อ - นามสกุล : </strong> <?=$data["firstname"]." ".$data["lastname"]?></p></div>
                            <div class="col-md-6"><p><strong>เบอร์โทรศัพท์ : </strong> <?=$data["mobile"]?></p></div>
                            <div class="col-md-6"><p><strong>อีเมล : </strong> <?=$data["email"]?></p></div>
                            <div class="col-md-6"><p><strong>วุฒิการศึกษา : </strong> <?=$data["edu_desc"]?></p></div>
                            <div class="col-md-6"><p><strong>โรงเรียนเดิม : </strong> <?=$data["school"]?></p></div>
                            <div class="col-md-6"><p><strong>คณะ/วิทยาลัย : </strong> <?=$data["fac_name_th"]?> </p></div>
                            <div class="col-md-6"><p><strong>สาขาวิชา : </strong> <?=$data["cou_name_th"]?> </p></div>
                            <div class="col-md-6"><p><strong>หลักสูตร : </strong> <?=$data["type_desc"]?> <strong>รอบเวลาเรียน : </strong> <?=$data["sec_desc"]?></p></div>
                            <div class="col-md-6"><p><strong>การกู้ยืม กยศ. : </strong> 
                                <?php 
                                    if ($data["loan"] == "0") { echo "ใช้ทุนส่วนตัว"; 
                                    } else if ($data["loan"] == "1") { echo "มีความประสงค์กู้ยืม กยศ."; 
                                    } else { echo "เป็นกู้ยืม กยศ. รายเก่า"; }
                                ?> </p>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12" style="margin-top: 20px">
                <div class="card register-card p-4 p-md-5">
                    <div class="card-body">
                        <h5 class="mb-4 fw-bold border-purple pb-2">ตรวจสอบสถานะการสมัครเรียน</h5>

                        <div class="list-group status-timeline">
                            <!-- ขั้นตอนที่ 1: สมัครเรียน -->
                            <div class="list-group-item <?= $step1_done ? 'completed' : 'text-muted' ?> d-flex justify-content-between align-items-center mb-3">
                                <div>
                                <span class="status-icon" style="background-color: <?= $step1_done ? '#4a148c' : '#e1bee7' ?>;"></span>
                                <span class="<?= $step1_done ? 'fw-semibold text-dark' : '' ?>">1. สมัครเรียน</span>
                                </div>
                                <?php if ($step1_done): ?>
                                <span class="badge bg-success rounded-pill">สมัครเรียนสำเร็จ</span>
                                <?php else: ?>
                                <span class="badge bg-light text-muted rounded-pill">รอดำเนินการ</span>
                                <?php endif; ?>
                            </div>

                            <!-- ขั้นตอนที่ 2: แจ้งการชำระเงิน -->
                            <div class="list-group-item <?= $step2_done ? 'completed' : ($step1_done ? 'active-purple' : 'text-muted') ?> d-flex justify-content-between align-items-center mb-3">
                                <div>
                                <span class="status-icon" style="background-color: <?= $step2_done ? '#4a148c' : ($step1_done ? '#7b1fa2' : '#e1bee7') ?>;"></span>
                                <span class="<?= $step2_done ? 'fw-semibold text-dark' : '' ?>">2. แจ้งการชำระเงิน</span>
                                </div>
                                <?php if ($step2_done): ?>
                                <span class="badge bg-success rounded-pill">แจ้งการชำระเงินแล้ว</span>
                                <?php elseif ($step1_done): ?>
                                <span class="badge bg-warning text-dark rounded-pill">รอแจ้งชำระเงิน</span>
                                <?php else: ?>
                                <span class="badge bg-light text-muted rounded-pill">รอดำเนินการ</span>
                                <?php endif; ?>
                            </div>

                            <!-- ขั้นตอนที่ 3: ตรวจสอบข้อมูลการชำระเงิน -->
                            <div class="list-group-item <?= $step3_done ? 'completed' : ($step2_done ? 'active-purple' : 'text-muted') ?> d-flex justify-content-between align-items-center mb-3">
                                <div>
                                <span class="status-icon" style="background-color: <?= $step3_done ? '#4a148c' : ($step2_done ? '#7b1fa2' : '#e1bee7') ?>;"></span>
                                <span class="<?= $step3_done ? 'fw-semibold text-dark' : '' ?>">3. ตรวจสอบข้อมูลการชำระเงิน</span>
                                </div>
                                <?php if ($step3_done): ?>
                                <span class="badge bg-success rounded-pill">ตรวจสอบข้อมูลสำเร็จ</span>
                                <?php elseif ($step2_done): ?>
                                <span class="badge bg-warning text-dark rounded-pill">กำลังตรวจสอบ</span>
                                <?php else: ?>
                                <span class="badge bg-light text-muted rounded-pill">รอดำเนินการ</span>
                                <?php endif; ?>
                            </div>

                            <!-- ขั้นตอนที่ 4: ส่งข้อมูลให้ฝ่ายทะเบียน -->
                            <div class="list-group-item <?= $step4_done ? 'completed' : ($step3_done ? 'active-purple' : 'text-muted') ?> d-flex justify-content-between align-items-center mb-3">
                                <div>
                                <span class="status-icon" style="background-color: <?= $step4_done ? '#4a148c' : ($step3_done ? '#7b1fa2' : '#e1bee7') ?>;"></span>
                                <span class="<?= $step4_done ? 'fw-semibold text-dark' : '' ?>">4. ส่งข้อมูลให้ฝ่ายทะเบียน</span>
                                </div>
                                <?php if ($step4_done): ?>
                                <span class="badge bg-success rounded-pill">ส่งข้อมูลให้ทะเบียนสำเร็จ</span>
                                <?php elseif ($step3_done): ?>
                                <span class="badge bg-warning text-dark rounded-pill">กำลังส่งข้อมูล</span>
                                <?php else: ?>
                                <span class="badge bg-light text-muted rounded-pill">รอดำเนินการ</span>
                                <?php endif; ?>
                            </div>

                            <!-- ขั้นตอนที่ 5: ออกเลขทะเบียน -->
                            <div class="list-group-item <?= $step5_done ? 'completed' : ($step4_done ? 'active-purple' : 'text-muted') ?> d-flex justify-content-between align-items-center mb-3">
                                <div>
                                <span class="status-icon" style="background-color: <?= $step5_done ? '#4a148c' : ($step4_done ? '#7b1fa2' : '#e1bee7') ?>;"></span>
                                <span class="<?= $step5_done ? 'fw-semibold text-dark' : '' ?>">5. ออกเลขทะเบียน</span>
                                </div>
                                <?php if ($step5_done): ?>
                                <span class="badge bg-success rounded-pill">ออกเลขทะเบียนสำเร็จ (<?= htmlspecialchars($std_id) ?>)</span>
                                <?php elseif ($step4_done): ?>
                                <span class="badge bg-warning text-dark rounded-pill">รอออกเลขทะเบียน</span>
                                <?php else: ?>
                                <span class="badge bg-light text-muted rounded-pill">รอดำเนินการ</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <?php if (empty($ref_no)) { ?>
            <div class="col-12 col-lg-12" style="margin-top: 20px">
                <!-- กล่องการ์ดวิธีการชำระเงิน-->
                <div class="card register-card p-4 p-md-5">
                    <div class="card-body">
                        <div class="row">
                            <form id="frmChoice" action="index.php?mode=select_choice" method="post" enctype="multipart/form-data">
                                <h5 class="mb-3 fw-bold border-purple pb-2">วิธีการชำระเงิน</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rb_choice" id="rb_choice1" value="Tranfer" checked>
                                            <label class="form-check-label" for="rb_choice1">
                                                โอนเงินผ่านบัญชีธนาคาร / QR Code (แนบหลักฐานการชำระเงิน)
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rb_choice" id="rb_choice2" value="Credit">
                                            <label class="form-check-label" for="rb_choice2">
                                                ชำระโดยบัตรเครดิต <img src="assets/images/master-visa-jcb.png">
                                            </label>
                                        </div>

                                     </div>
                                </div>  
                                <!-- ปุ่มส่งข้อชำระเงิน -->
                                <div>
                                    <button type="submit" class="btn btn-submit btn-lg px-5 text-white fw-bold">ชำระเงิน</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
    
</body>
</html>