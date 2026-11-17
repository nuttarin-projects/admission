<?php

class Manager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getEducationAll()
    {
        $sql = " SELECT edu_id, edu_desc, edu_sort FROM mt_education WHERE edu_flag = 'T' ORDER BY edu_sort ASC ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getYearAll()
    {
        $sql = " SELECT year_id, year_check, year_term, title FROM mt_year WHERE year_flag = 'T' ORDER BY year_sort ASC ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getYearId($yearTerm)
    {
        $sql = " SELECT year_id FROM mt_year WHERE year_term = :year_term AND year_flag = 'T' ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":year_term" => $yearTerm
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // ถ้าไม่พบข้อมูล ให้คืนค่าที่ส่งเข้ามา
        if ($result) {
            return $result["year_id"];
        }

        return $yearTerm;

    }


    public function getProvinceAll()
    {
        $sql = " SELECT province_id, province_name FROM mt_province ORDER BY province_id ASC ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getSectionAll()
    {
        $sql = " SELECT DISTINCT S.sec_id, sec_desc, Y.year_term FROM mt_section S, mt_cou_type_sec CTS, mt_year Y WHERE CTS.term = Y.year_term AND CTS.sec_id = S.sec_id AND year_flag = 'T' ORDER BY Y.year_term, S.sec_id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTypeAll()
    {
        $sql = " SELECT DISTINCT T.type_id, T.type_desc, CTS.sec_id, Y.year_term FROM mt_cou_type_sec CTS, mt_type T, mt_year Y  WHERE CTS.type_id =T.type_id AND CTS.term = Y.year_term AND year_flag = 'T' ORDER BY Y.year_term, CTS.sec_id, T.type_id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFacultyAll()
    {
        $sql = " SELECT DISTINCT F.fac_id, F.fac_name_th, CTS.type_id, CTS.sec_id, Y.year_term, F.fac_sort FROM mt_cou_type_sec CTS, mt_course C, mt_faculty F, mt_year Y WHERE CTS.term = Y.year_term AND CTS.cou_id = C.cou_id AND C.fac_id = F.fac_id AND year_flag = 'T' ORDER BY Y.year_term, CTS.sec_id, CTS.type_id, F.fac_sort, F.fac_id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseAll()
    {
        $sql = " SELECT C.cou_id, C.cou_name_th, CTS.type_id, CTS.sec_id, C.fac_id, Y.year_term, C.cou_sort FROM mt_cou_type_sec CTS, mt_course C, mt_year Y WHERE CTS.term = Y.year_term AND CTS.cou_id = C.cou_id AND year_flag = 'T' ORDER BY Y.year_term, CTS.sec_id, CTS.type_id, C.fac_id, C.cou_sort, C.cou_id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAdmisId($current)
    {
        $sql = "SELECT MAX(SUBSTRING(admis_id, 4, 5)) AS currentID FROM tr_bachelor WHERE SUBSTRING(admis_id, 1, 3) = :current";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":current" => $current
        ]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $admis_id = $record["currentID"] ?? null;
        if ($admis_id === null) {
            return $current . "00001";
        }
        $admis_id++;
        return $current . sprintf("%05d", $admis_id);
    }   

    public function insertApplicant($data)
    {
        $sql = "
            INSERT INTO applicant ( idcard, birthdate ) 
        VALUES (:idcard, :birthdate)";            

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":idcard" => $data["idcard"], ":birthdate" => $data["birthdate"]
        ]);

    }


    public function insertBachelor($data)
    {
        $sql = "
            INSERT INTO tr_bachelor ( admis_id, applicant_id, year_id, cou_id, type_id, sec_id, fund, fund_id, loan, firstname, lastname, idcard, edu_id, school, province_id, mobile, email, line_id, facebook, portfolio, pro_id, admis_date, ip_address, source, campaign, remark, refer_from )
            VALUES ( :admis_id, :applicant_id, :year, :course, :type, :section, :fund, :fundtype, :loan, :name, :surname, :idcard, :edu, :school, :province, :mobile, :email, :line, :facebook, :portfolio, :pro_id, :admis_date, :ip, :utm_source, :utm_campaign, :remark, :refer )";            

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":admis_id" => $data["admis_id"], ":applicant_id" => $data["applicant_id"], ":year" => $data["year"], ":course" => $data["course"], 
            ":type" => $data["type"], ":section" => $data["section"], ":fund" => $data["fund"], 
            ":fundtype" => $data["fundtype"], ":loan" => $data["loan"], ":name" => $data["name"], 
            ":surname" => $data["surname"], ":idcard" => $data["idcard"], ":edu" => $data["edu"], 
            ":school" => $data["school"], ":province" => $data["province"], ":mobile" => $data["mobile"], 
            ":email" => $data["email"], ":line" => $data["line"], ":facebook" => $data["facebook"], 
            ":portfolio" => $data["portfolio"], ":pro_id" => $data["pro_id"], ":admis_date" => $data["admis_date"], 
            ":ip" => $data["ip"], ":utm_source" => $data["utm_source"], ":utm_campaign" => $data["utm_campaign"], 
            ":remark" => $data["remark"], ":refer" => $data["refer"]
        ]);

    }

    public function insertEnroll($data)
    {
        $sql = "
            INSERT INTO tr_enroll ( admis_id, titlename, firstname_en, lastname_en, birthdate, gpa, add_on, add_ip ) 
        VALUES (:admis_id, :title, :name_en, :surname_en, :birthday, :gpa, :admis_date, :ip)";            

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":admis_id" => $data["admis_id"], ":title" => $data["title"], ":name_en" => $data["name_en"], 
            ":surname_en" => $data["surname_en"], ":birthday" => $data["birthday"], ":gpa" => $data["gpa"], 
            ":admis_date" => $data["admis_date"], ":ip" => $data["ip"]
        ]);

    }

    public function insertPayment($data)
    {
        $sql = "
            INSERT INTO tr_payment ( admis_id, amount, pay_date_time, pay_slip, pay_way, ref_no,  add_ip ) 
        VALUES (:admis_id, :amount, :pay_date_time, :pay_slip, :pay_way, :ref_no, :add_ip)";            

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":admis_id" => $data["admis_id"], ":amount" => $data["amount"], ":pay_date_time" => $data["pay_date_time"], 
            ":pay_slip" => $data["pay_slip"], ":pay_way" => $data["pay_way"], ":ref_no" => $data["ref_no"], 
            ":add_ip" => $data["add_ip"]
        ]);

    }

    public function getApplicant($idcard)
    {
        $sql = " SELECT applicant_id FROM applicant WHERE idcard = :idcard";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":idcard" => $idcard
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBachelor($admisId)
    {
        $sql = "SELECT BA.admis_id, TP.ref_no, TP.apv_status, TE.apv_status as apv_enroll, BA.std_id, BA.year_id, BA.loan, BA.firstname, BA.lastname, BA.idcard, ED.edu_desc, BA.school, BA.mobile, BA.email, FA.fac_name_th, CO.cou_name_th,TY. type_desc, SE.sec_desc, BA.admis_date FROM tr_bachelor BA 
                LEFT JOIN mt_education ED ON BA.edu_id = ED.edu_id 
                LEFT JOIN mt_course CO ON  BA.cou_id = CO.cou_id 
                LEFT JOIN mt_faculty FA ON CO.fac_id = FA.fac_id 
                LEFT JOIN mt_type TY ON BA.type_id = TY.type_id 
                LEFT JOIN mt_section SE ON BA.sec_id = SE.sec_id 
                LEFT JOIN tr_enroll TE ON BA.admis_id = TE.admis_id 
                LEFT JOIN tr_payment TP ON BA.admis_id = TP.admis_id 
                WHERE BA.admis_id = :admis_id";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":admis_id" => $admisId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkDuplicate($card, $yearTerm)
    {
        $sql = " SELECT 1 FROM tr_bachelor b INNER JOIN mt_year y ON b.year_id = y.year_id WHERE b.idcard = :idcard AND y.year_term = :yearTerm LIMIT 1";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":idcard" => $card,
            ":yearTerm" => $yearTerm
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public function checkStatus($idcard, $birthdate)
    {
        $sql = "SELECT tb.admis_id  FROM applicant a
                LEFT JOIN tr_bachelor tb on tb.applicant_id = a.applicant_id  
                WHERE a.idcard = :idcard AND a.birthdate = :birthdate LIMIT 1";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":idcard" => $idcard,
            ":birthdate" => $birthdate
        ]);

        // คืนค่า applicant_id ออกไปตรงๆ (ถ้าไม่พบข้อมูล จะได้ค่า false กลับไปเอง)
        return $stmt->fetchColumn();
    }

    public function checkDuplicateIdcard($idcard)
    {
        $sql = " SELECT applicant_id, idcard FROM applicant WHERE idcard = :idcard LIMIT 1";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":idcard" => $idcard
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row !== false;

    }

    
}