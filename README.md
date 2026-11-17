# 🎓 Admission System (ระบบรับสมัครเรียนออนไลน์)

ระบบรับสมัครเรียนออนไลน์ พัฒนาด้วยภาษา **PHP 8.2** ตามสถาปัตยกรรม **MVC (Model-View-Controller)** และทำงานร่วมกับ **Docker** เพื่อความสะดวกในการติดตั้งและจำลองสภาพแวดล้อมการพัฒนา

---

## ✨ Features (ฟีเจอร์หลัก)
- **Start Page:** เริ่มต้นสมัครเรียนด้วยการตรวจสอบเลขบัตรประจำตัวประชาชน 13 หลัก และวันเดือนปีเกิด
- **Application Form:** หน้ากรอกข้อมูลรายละเอียดการสมัครเรียน พร้อมตัวเลือกคณะและสาขาวิชาแบบสัมพันธ์กัน (Cascading Dropdown)
- **Profile Page:** แสดงข้อมูลรายละเอียดผู้สมัคร สถานะการอนุมัติใบสมัคร และสถานะการชำระเงิน
- **Payment Page:** หน้าสำหรับเลือกช่องทางและแจ้งหลักฐานการชำระเงินค่าลงทะเบียนเรียน
- **Check-Status Page:** ระบบเข้าสู่ระบบด้วยเลขบัตรประชาชนและวันเกิด เพื่อตรวจสอบสถานะการสมัครเรียนย้อนหลัง
- **Real-time Validation:** ใช้ **AJAX** ร่วมกับ **jQuery Validation** ในการตรวจสอบความถูกต้องของข้อมูลและเช็กข้อมูลซ้ำแบบ Real-time
- **Cookie & Access Control:** จัดการสิทธิ์การเข้าถึงและเปลี่ยนเส้นทาง (Redirect) ในแต่ละขั้นตอนด้วย Cookie

---

## 🛠️ Technology Stack

### Backend
- **PHP 8.2** (OOP, MVC Architecture, PDO Prepared Statements)
- **MySQL 5.7**
- **Apache** (Configured Document Root to `/public`)

### Frontend
- **HTML5 / CSS3**
- **Bootstrap 5**
- **JavaScript / jQuery**
- **jQuery Validation**

### Development Environment
- **Docker**
- **Docker Compose**

---

## 📂 Project Structure (โครงสร้างโปรเจกต์)

```text
├── app/
│   ├── Config/
│   │   └── DBManager.php           # ตั้งค่าการเชื่อมต่อฐานข้อมูล (PDO)
│   ├── Controllers/
│   │   └── AdmissionController.php # ควบคุม Logic, Validation, Cookie และเชื่อมข้อมูลระหว่าง Model กับ View
│   └── Models/
│       └── Manager.php             # จัดการคำสั่ง SQL และดึงข้อมูลจากฐานข้อมูล
├── public/
│   ├── assets/                     # เก็บไฟล์ CSS, JavaScript และรูปภาพ
│   └── index.php                   # Front Controller (Router) รับ Request ทั้งหมดของระบบ
├── views/                          # ส่วนแสดงผลหน้าเว็บ (HTML Templates)
│   ├── check-status.php
│   ├── form.php
│   ├── payment.php
│   ├── profile.php
│   └── start.php
├── .gitignore
├── docker-compose.yml
└── Dockerfile
```

---

## 🚀 Getting Started (วิธีการติดตั้งและรันโปรเจกต์)

### 1. Clone โปรเจกต์ลงเครื่อง
```bash
git clone https://github.com/nuttarin-projects/admission.git
cd admission
```

### 2. สร้างและรัน Container ด้วย Docker
```bash
docker compose up -d --build
```

### 3. นำเข้าฐานข้อมูล (Import Database)
1. เปิด **phpMyAdmin** ผ่านเบราว์เซอร์ที่: `http://localhost:8081`
2. เข้าสู่ระบบด้วยชื่อผู้ใช้ `admid` และรหัสผ่าน `Thebest1` *(หรือ `root` / `rootpassword`)*
3. เลือกฐานข้อมูล `admission` และทำการ **Import** ไฟล์ `.sql` ของระบบ

### 4. เข้าใช้งานระบบ
- **หน้าเว็บไซต์หลัก:** `http://localhost:8001`
- **phpMyAdmin:** `http://localhost:8081`

---

## ⚙️ Useful Docker Commands (คำสั่งจัดการเบื้องต้น)
- **หยุดการทำงานชั่วคราว (เมื่อเลิกใช้งานรายวัน):**
  ```bash
  docker compose stop
  ```
- **เปิดใช้งานต่อ:**
  ```bash
  docker compose start
  ```
- **ปิดและลบ Container ทั้งหมด:**
  ```bash
  docker compose down
  ```
