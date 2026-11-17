<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งการชำระเงิน</title>

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
                        <!-- หัวข้อหลัก -->
                        <h2 class="card-title text-center mb-2 fw-bold text-purple-dark">แจ้งชำระเงิน / แนบสลิป</h2>
                        <p class="text-center text-muted mb-4">กรุณากรอกข้อมูลการชำระเงินให้ครบถ้วน</p>
                        <div class="row">
                            <form id="frmPayment" action="index.php?mode=enroll-payment" method="post" enctype="multipart/form-data">
                                <h5 class="mb-3 fw-bold border-purple pb-2">แบบฟอร์ม</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-dark fw-semibold">เลขที่ผู้สมัคร <span class="required">*</span></label>
                                        <input type="text" class="form-control" value="<?=$data["admis_id"]?>" disabled>
                                        <input type="hidden" id="tx_admis_id" name="tx_admis_id" value="<?=$data["admis_id"]?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tx_amount" class="form-label text-dark fw-semibold">จำนวนเงิน <span class="required">*</span></label>
                                        <input type="number" class="form-control" name="tx_amount" id="tx_amount" maxlength="10">
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label for="tx_date" class="form-label text-dark fw-semibold">วัน - เวลาที่โอน <span class="required">*</span></label>
                                        <input type="date" class="form-control" name="tx_date" id="tx_date">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dl_hour" class="form-label text-dark fw-semibold">ชั่วโมง <span class="required">*</span></label>
                                        <select name="dl_hour" id="dl_hour" class="form-select">
                                            <option value="">ชั่วโมง</option>
                                            <?php for ($i = 0; $i < 24; $i++) { ?>
                                                <option value="<?=sprintf("%'.02d", $i)?>"><?=sprintf("%'.02d", $i)?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dl_minute" class="form-label text-dark fw-semibold">นาที <span class="required">*</span></label>
                                        <select name="dl_minute" id="dl_minute" class="form-select">
                                            <option value="">นาที</option>
                                            <?php for ($i = 0; $i < 60; $i++) { ?>
                                                <option value="<?=sprintf("%'.02d", $i)?>"><?=sprintf("%'.02d", $i)?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-12">
                                        <label for="tx_fname" class="form-label text-dark fw-semibold">หลักฐานชำระเงิน <span class="required">*</span></label>
                                        <input type="file" class="form-control" name="file_upload" id="file_upload" accept="image/*,.pdf">
                                    </div>
                                </div>
                                <!-- ปุ่มส่งข้อชำระเงิน -->
                                <div>
                                    <button type="submit" class="btn btn-submit btn-lg px-5 text-white fw-bold">บันทึกข้อมูลชำระเงิน</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Validate -->   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.22.1/jquery.validate.min.js"></script>
    <script src="assets/js/payment.js"></script>
    
</body>
</html>