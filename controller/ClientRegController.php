<?php

namespace controller\ClientRegController;

use PDO;
use config\Database\Database;

include_once "../config/app.php";
include_once "../config/database.php";

class ClientRegController
{
    public $db, $conn, $db_name;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->link;
        $this->db_name = $this->db->dbName;
    }

    // Client Registation
    public function clientReg($feild_id, $center_id, $period_id, $register_officer, $book, $name, $husbands_name = null, $fathers_name = null, $mothers_name, $client_nid, $client_dob, $client_occupation, $religion, $client_gander, $client_img, $client_mobile_1, $client_mobile_2 = null, $client_income, $client_position, $blood_grp = null, $client_back_acc = null, $check_no = null, $present_address, $parmanent_address, $deposit_installment, $duration, $total_installment, $total_without_interest, $interest, $total_with_interest, $nominee_name, $nominee_husband = null, $nominee_father = null, $nominee_mother, $nominee_dob, $nominee_nid, $nominee_occupation, $nominee_relation, $nominee_gendar, $nominee_img, $nominee_address)
    {
        $this->conn->beginTransaction();

        // Book is exist or not
        $sql = $this->conn->prepare("SELECT * FROM client_registers WHERE book = ?");
        $sql->execute([$book]);
        $result = $sql->rowCount();
        if ($result > 0) {
            return "book_exist";  // DATA DOES NOT INSERTED
        } else {
            // client nid is exist or not
            $sql = $this->conn->prepare("SELECT * FROM client_registers WHERE client_nid = ?");
            $sql->execute([$client_nid]);
            $result = $sql->rowCount();
            if ($result > 0) {
                return "client_nid_exist";  // DATA DOES NOT INSERTED
            } else {
                $sql = $this->conn->prepare("INSERT INTO client_registers (feild_id, center_id, register_officer, book, name, husbands_name, fathers_name, mothers_name, client_nid, client_dob, client_occupation, religion, client_gander, client_img, client_mobile_1, client_mobile_2, client_income, client_position, blood_grp, client_back_acc, check_no, present_address, parmanent_address) VALUES (:feild_id, :center_id, :register_officer, :book, :name, :husbands_name, :fathers_name, :mothers_name, :client_nid, :client_dob, :client_occupation, :religion, :client_gander, :client_img, :client_mobile_1, :client_mobile_2, :client_income, :client_position, :blood_grp, :client_back_acc, :check_no, :present_address, :parmanent_address)");

                $sql->execute([":feild_id" => $feild_id, ":center_id" => $center_id, ":register_officer" => $register_officer, ":book" => $book, ":name" => $name, ":husbands_name" => $husbands_name, ":fathers_name" => $fathers_name, ":mothers_name" => $mothers_name, ":client_nid" => $client_nid, ":client_dob" => $client_dob, ":client_occupation" => $client_occupation, ":religion" => $religion, ":client_gander" => $client_gander, ":client_img" => $client_img, ":client_mobile_1" => $client_mobile_1, ":client_mobile_2" => $client_mobile_2, ":client_income" => $client_income, ":client_position" => $client_position, ":blood_grp" => $blood_grp, ":client_back_acc" => $client_back_acc, ":check_no" => $check_no, ":present_address" => $present_address, ":parmanent_address" => $parmanent_address]);

                $insertID = $this->conn->lastInsertId();

                if ($insertID > 0) {
                    $sql = $this->conn->prepare("INSERT INTO saving_profiles (field_id, center_id, period_id, reg_officer_id, client_id, book, deposit_installment, duration, total_installment, total_without_interest, interest, total_with_interest, total_deposit, total_withdrawal, balance, nominee_name, nominee_husband, nominee_father, nominee_mother, nominee_dob, nominee_nid, nominee_occupation, nominee_relation, nominee_gendar, nominee_img, nominee_address) VALUES (:field_id, :center_id, :period_id, :reg_officer_id, :client_id, :book, :deposit_installment, :duration, :total_installment, :total_without_interest, :interest, :total_with_interest, :total_deposit, :total_withdrawal, :balance, :nominee_name, :nominee_husband, :nominee_father, :nominee_mother, :nominee_dob, :nominee_nid, :nominee_occupation, :nominee_relation, :nominee_gendar, :nominee_img, :nominee_address)");

                    $sql->execute([":field_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":reg_officer_id" => $register_officer, ":client_id" => $insertID, ":book" => $book, ":deposit_installment" => $deposit_installment, ":duration" => $duration, ":total_installment" => $total_installment, ":total_without_interest" => $total_without_interest, ":interest" => $interest, ":total_with_interest" => $total_with_interest, ":total_deposit" => 0, ":total_withdrawal" => 0, ":balance" => 0, ":nominee_name" => $nominee_name, ":nominee_husband" => $nominee_husband, ":nominee_father" => $nominee_father, ":nominee_mother" => $nominee_mother, ":nominee_dob" => $nominee_dob, ":nominee_nid" => $nominee_nid, ":nominee_occupation" => $nominee_occupation, ":nominee_relation" => $nominee_relation, ":nominee_gendar" => $nominee_gendar, ":nominee_img" => $nominee_img, ":nominee_address" => $nominee_address]);
                    $spInsertID = $this->conn->lastInsertId();

                    if ($spInsertID > 0) {
                        $periodQuery = "SELECT period FROM periods WHERE period_id = '${period_id}' limit 1";
                        $periodSql = $this->conn->prepare($periodQuery);
                        $periodSql->execute();
                        $period_time = $periodSql->fetchALL(PDO::FETCH_ASSOC);
                        if ($period_time[0]['period'] == 30) {
                            $nextCheck = date("Y-m-d", strtotime("+90days"));
                        } elseif ($period_time[0]['period'] == 7) {
                            $nextCheck = date("Y-m-d", strtotime("+60days"));
                        } elseif ($period_time[0]['period'] == 365) {
                            $nextCheck = date("Y-m-d", strtotime("+120days"));
                        } else {
                            $nextCheck = date("Y-m-d", strtotime("+30days"));
                        }

                        $sql = $this->conn->prepare("INSERT INTO savings_acc_checks (saving_profiles_id, client_id, book, field_id, center_id, period_id, checked_officer_id, next_check_date) VALUES (:saving_profiles_id, :client_id, :book, :field_id, :center_id, :period_id, :checked_officer_id, :next_check_date)");

                        $sql->execute([":saving_profiles_id" => $spInsertID, ":client_id" => $insertID, ":book" => $book, ":field_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":checked_officer_id" => $register_officer, ":next_check_date" => $nextCheck]);

                        $result = $sql->rowCount();
                        if ($result > 0) {
                            $this->conn->commit();

                            $sql = $this->conn->prepare("SELECT f.field_name, c.center_name, s.balance, p.period_name, r.name FROM client_registers AS r INNER JOIN feilds AS f ON r.feild_id = f.feild_id INNER JOIN centers AS c ON r.center_id = c.center_id INNER JOIN saving_profiles as s ON r.client_id = s.client_id INNER JOIN periods as p ON s.period_id = p.period_id WHERE r.client_id = :client_id AND f.feild_id =:feild_id AND c.center_id  = :center_id AND s.saving_profiles_id = :saving_profiles_id AND p.period_id= :period_id");

                            if ($sql->execute([":client_id" => $insertID, ":feild_id" => $feild_id, ":center_id" => $center_id, ":saving_profiles_id" => $spInsertID,  ":period_id" => $period_id])) {
                                $result = $sql->rowCount();
                                if ($result > 0) {
                                    $row = $sql->fetch(PDO::FETCH_ASSOC);

                                    $date = strtotime($duration);
                                    $expiry = date("d/m/Y", $date);
                                    $from = $register_officer;
                                    $sub = "বই নং " . $book . " | সঞ্চয় নিবন্ধন";
                                    $details = "<bold>ফিল্ডঃ</bold> " . $row['field_name']  . "  <br> <bold>কেন্দ্রঃ</bold> " . $row['center_name']  . "  <br> <bold>ক্ষেত্রঃ</bold> " . $row['period_name']  . "  <br> <bold>বই নংঃ/<bold> " . $book . "<br> <bold>নামঃ</bold> " . $row['name']  . "  <br> <bold>নির্ধারিত সঞ্চয়ঃ </bold> " . $deposit_installment  . " টাকা<br> <bold>মেয়াদঃ</bold> " . $expiry . " তারিখ পর্যন্ত<br> <bold>লাভ<bold> " . $interest . " টাকা<br> <bold>সর্বমোট (লাভ ছাড়া)ঃ<bold> " . $total_without_interest . " টাকা<br> <bold>সর্বমোট (লাভ সহ)ঃ<bold> " . $total_with_interest . " টাকা";

                                    $sql = $this->conn->prepare("INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES ('${from}', '${sub}', '${details}', '1')");
                                    if ($sql->execute()) {
                                        return true;
                                    }

                                    return true;
                                } else {
                                    return true;
                                }
                            } else {
                                return true;
                            }
                        } else {
                            $this->conn->rollback();
                            return false;
                        }
                    } else {
                        $this->conn->rollback();
                        return false;
                    }
                } else {
                    $this->conn->rollback();
                    return false;
                }
            }
        }
    }

    // Savings Profile Registation
    public function savingsReg($feild_id, $center_id, $period_id, $register_officer, $clientID, $book, $deposit_installment, $duration, $total_installment, $total_without_interest, $interest, $total_with_interest, $nominee_name, $nominee_husband = null, $nominee_father = null, $nominee_mother, $nominee_dob, $nominee_nid, $nominee_occupation, $nominee_relation, $nominee_gendar, $nominee_img, $nominee_address)
    {
        $this->conn->beginTransaction();

        $sql = $this->conn->prepare("INSERT INTO saving_profiles (field_id, center_id, period_id, reg_officer_id, client_id, book, deposit_installment, duration, total_installment, total_without_interest, interest, total_with_interest, total_deposit, total_withdrawal, balance, nominee_name, nominee_husband, nominee_father, nominee_mother, nominee_dob, nominee_nid, nominee_occupation, nominee_relation, nominee_gendar, nominee_img, nominee_address) VALUES (:field_id, :center_id, :period_id, :reg_officer_id, :client_id, :book, :deposit_installment, :duration, :total_installment, :total_without_interest, :interest, :total_with_interest, :total_deposit, :total_withdrawal, :balance, :nominee_name, :nominee_husband, :nominee_father, :nominee_mother, :nominee_dob, :nominee_nid, :nominee_occupation, :nominee_relation, :nominee_gendar, :nominee_img, :nominee_address)");

        $sql->execute([":field_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":reg_officer_id" => $register_officer, ":client_id" => $clientID, ":book" => $book, ":deposit_installment" => $deposit_installment, ":duration" => $duration, ":total_installment" => $total_installment, ":total_without_interest" => $total_without_interest, ":interest" => $interest, ":total_with_interest" => $total_with_interest, ":total_deposit" => 0, ":total_withdrawal" => 0, ":balance" => 0, ":nominee_name" => $nominee_name, ":nominee_husband" => $nominee_husband, ":nominee_father" => $nominee_father, ":nominee_mother" => $nominee_mother, ":nominee_dob" => $nominee_dob, ":nominee_nid" => $nominee_nid, ":nominee_occupation" => $nominee_occupation, ":nominee_relation" => $nominee_relation, ":nominee_gendar" => $nominee_gendar, ":nominee_img" => $nominee_img, ":nominee_address" => $nominee_address]);

        $InsertID = $this->conn->lastInsertId();
        if ($InsertID > 0) {
            $periodQuery = "SELECT period FROM periods WHERE period_id = '${period_id}' limit 1";
            $periodSql = $this->conn->prepare($periodQuery);
            $periodSql->execute();
            $period_time = $periodSql->fetchALL(PDO::FETCH_ASSOC);
            if ($period_time[0]['period'] == 30) {
                $nextCheck = date("Y-m-d", strtotime("+90days"));
            } elseif ($period_time[0]['period'] == 7) {
                $nextCheck = date("Y-m-d", strtotime("+60days"));
            } elseif ($period_time[0]['period'] == 365) {
                $nextCheck = date("Y-m-d", strtotime("+120days"));
            } else {
                $nextCheck = date("Y-m-d", strtotime("+30days"));
            }
            $sql = $this->conn->prepare("INSERT INTO savings_acc_checks (saving_profiles_id, client_id, book, field_id, center_id, period_id, checked_officer_id, next_check_date) VALUES (:saving_profiles_id, :client_id, :book, :field_id, :center_id, :period_id, :checked_officer_id, :next_check_date)");

            $sql->execute([":saving_profiles_id" => $InsertID, ":client_id" => $clientID, ":book" => $book, ":field_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":checked_officer_id" => $register_officer, ":next_check_date" => $nextCheck]);

            $result = $sql->rowCount();
            if ($result > 0) {
                $this->conn->commit();

                $sql = $this->conn->prepare("SELECT f.field_name, c.center_name, s.balance, p.period_name, r.name FROM client_registers AS r INNER JOIN feilds AS f ON r.feild_id = f.feild_id INNER JOIN centers AS c ON r.center_id = c.center_id INNER JOIN saving_profiles as s ON r.client_id = s.client_id INNER JOIN periods as p ON s.period_id = p.period_id WHERE r.client_id = :client_id AND f.feild_id =:feild_id AND c.center_id  = :center_id AND s.saving_profiles_id = :saving_profiles_id AND p.period_id= :period_id");

                if ($sql->execute([":client_id" => $clientID, ":feild_id" => $feild_id, ":center_id" => $center_id, ":saving_profiles_id" => $InsertID,  ":period_id" => $period_id])) {
                    $result = $sql->rowCount();
                    if ($result > 0) {
                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                        $date = strtotime($duration);
                        $expiry = date("d/m/Y", $date);
                        $from = $register_officer;
                        $sub = "বই নং " . $book . " | নতুন সদস্য নিবন্ধন";
                        $details = "<bold>ফিল্ডঃ</bold> " . $row['field_name']  . "  <br> <bold>কেন্দ্রঃ</bold> " . $row['center_name']  . "  <br> <bold>ক্ষেত্রঃ</bold> " . $row['period_name']  . "  <br> <bold>বই নংঃ/<bold> " . $book . "<br> <bold>নামঃ</bold> " . $row['name']  . "  <br> <bold>নির্ধারিত সঞ্চয়ঃ </bold> " . $deposit_installment  . " টাকা<br> <bold>মেয়াদঃ</bold> " . $expiry . " তারিখ পর্যন্ত<br> <bold>লাভ<bold> " . $interest . " টাকা<br> <bold>সর্বমোট (লাভ ছাড়া)ঃ<bold> " . $total_without_interest . " টাকা<br> <bold>সর্বমোট (লাভ সহ)ঃ<bold> " . $total_with_interest . " টাকা";

                        $sql = $this->conn->prepare("INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES ('${from}', '${sub}', '${details}', '1')");
                        if ($sql->execute()) {
                            return true;
                        }

                        return true;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } else {
                $this->conn->rollback();
                return false;
            }
        } else {
            $this->conn->rollback();
            return false;
        }
    }

    // Loan Profile Registation
    public function loanReg($field_id, $center_id, $period_id, $reg_officer_id, $client_id, $book, $savings, $total_loan, $total_intsallment, $interest, $total_interest, $total_loan_w_ints, $loan_installment, $interest_installment, $duration, $loan_remaining, $interest_remaining, $nominee_name, $nominee_husband = null,  $nominee_father = null, $nominee_mother, $nominee_dob, $nominee_nid, $nominee_occupation, $nominee_relation, $nominee_gendar, $nominee_img, $nominee_address)
    {

        $this->conn->beginTransaction();
        // Book is exist or not
        $sql = $this->conn->prepare("SELECT * FROM loan_profiles WHERE book = :book AND client_id = :client AND period_id = :period AND status = '1'");
        $sql->execute([":book" => $book, ":client" => $client_id, ":period" => $period_id]);
        $result = $sql->rowCount();
        if ($result > 0) {
            return "book_exist";  // DATA DOES NOT INSERTED
        } else {
            $sql = $this->conn->prepare("INSERT INTO loan_profiles(field_id, center_id, period_id, reg_officer_id, client_id, book, savings, total_loan, total_intsallment, interest, total_interest, total_loan_w_ints, loan_installment, interest_installment, duration, loan_remaining, interest_remaining, nominee_name, nominee_husband, nominee_father, nominee_mother, nominee_dob, nominee_nid, nominee_occupation, nominee_relation, nominee_gendar, nominee_img, nominee_address) VALUES (:field_id, :center_id, :period_id, :reg_officer_id, :client_id, :book, :savings, :total_loan, :total_intsallment, :interest, :total_interest, :total_loan_w_ints, :loan_installment, :interest_installment, :duration, :loan_remaining, :interest_remaining, :nominee_name, :nominee_husband, :nominee_father, :nominee_mother, :nominee_dob, :nominee_nid, :nominee_occupation, :nominee_relation, :nominee_gendar, :nominee_img, :nominee_address)");

            if ($sql->execute([":field_id" => $field_id, ":center_id" => $center_id, ":period_id" => $period_id, ":reg_officer_id" => $reg_officer_id, ":client_id" => $client_id, ":book" => $book, ":savings" => $savings, ":total_loan" => $total_loan, ":total_intsallment" => $total_intsallment, ":interest" => $interest, ":total_interest" => $total_interest, ":total_loan_w_ints" => $total_loan_w_ints, ":loan_installment" => $loan_installment, ":interest_installment" => $interest_installment, ":duration" => $duration, ":loan_remaining" => $loan_remaining, ":interest_remaining" => $interest_remaining, ":nominee_name" => $nominee_name, ":nominee_husband" => $nominee_husband, ":nominee_father" => $nominee_father, ":nominee_mother" => $nominee_mother, ":nominee_dob" => $nominee_dob, ":nominee_nid" => $nominee_nid, ":nominee_occupation" => $nominee_occupation, ":nominee_relation" => $nominee_relation, ":nominee_gendar" => $nominee_gendar, ":nominee_img" => $nominee_img, ":nominee_address" => $nominee_address])) {

                $InsertID = $this->conn->lastInsertId();
                if ($InsertID > 0) {
                    $periodQuery = "SELECT period FROM periods WHERE period_id = '${period_id}' limit 1";
                    $periodSql = $this->conn->prepare($periodQuery);
                    $periodSql->execute();
                    $period_time = $periodSql->fetchALL(PDO::FETCH_ASSOC);
                    if ($period_time[0]['period'] == 30) {
                        $nextCheck = date("Y-m-d", strtotime("+90days"));
                    } elseif ($period_time[0]['period'] == 7) {
                        $nextCheck = date("Y-m-d", strtotime("+60days"));
                    } elseif ($period_time[0]['period'] == 365) {
                        $nextCheck = date("Y-m-d", strtotime("+120days"));
                    } else {
                        $nextCheck = date("Y-m-d", strtotime("+30days"));
                    }
                    $sql = $this->conn->prepare("INSERT INTO loan_acc_checks (loan_profile_id, client_id, book, field_id, center_id, period_id, loan_remaining, interest_remaining, checked_officer_id, next_check_date) VALUES (:loan_profile_id, :client_id, :book, :field_id, :center_id, :period_id, :loan_remaining, :interest_remaining, :checked_officer_id, :next_check_date)");

                    $sql->execute([":loan_profile_id" => $InsertID, ":client_id" => $client_id, ":book" => $book, ":field_id" => $field_id, ":center_id" => $center_id, ":period_id" => $period_id, ":loan_remaining" => $loan_remaining, ":interest_remaining" =>  $interest_remaining, ":checked_officer_id" => $reg_officer_id, ":next_check_date" => $nextCheck]);

                    $result = $sql->rowCount();
                    if ($result > 0) {
                        $this->conn->commit();

                        $sql = $this->conn->prepare("SELECT f.field_name, c.center_name, s.balance, p.period_name, r.name FROM client_registers AS r INNER JOIN feilds AS f ON r.feild_id = f.feild_id INNER JOIN centers AS c ON r.center_id = c.center_id INNER JOIN loan_profiles as s ON r.client_id = s.client_id INNER JOIN periods as p ON s.period_id = p.period_id WHERE r.client_id = :client_id AND f.feild_id =:feild_id AND c.center_id  = :center_id AND s.loan_profile_id = :loan_profile_id AND p.period_id= :period_id");

                        if ($sql->execute([":client_id" => $client_id, ":feild_id" => $field_id, ":center_id" => $center_id, ":loan_profile_id" => $InsertID,  ":period_id" => $period_id])) {
                            $result = $sql->rowCount();
                            if ($result > 0) {
                                $row = $sql->fetch(PDO::FETCH_ASSOC);
                                $date = strtotime($duration);
                                $expiry = date("d/m/Y", $date);
                                $from = $reg_officer_id;
                                $sub = "বই নং " . $book . " | ঋণ পত্র নিবন্ধন";
                                $details = "<bold>ফিল্ডঃ</bold> " . $row['field_name']  . "  <br> <bold>কেন্দ্রঃ</bold> " . $row['center_name']  . "  <br> <bold>ক্ষেত্রঃ</bold> " . $row['period_name']  . "  <br> <bold>বই নংঃ/<bold> " . $book . "<br> <bold>নামঃ</bold> " . $row['name']  . "  <br> <bold>নির্ধারিত সঞ্চয়ঃ </bold> " . $savings  . " টাকা<br> <bold>ঋণ প্রদানঃ<bold> " . $total_loan . " টাকা<br> <bold>মেয়াদঃ</bold> " . $expiry . " তারিখ পর্যন্ত<br> <bold>কিস্তি সংখ্যাঃ <bold> " . $total_intsallment . " টি<br> <bold>লাভ<bold> " . $interest . "% <br> <bold>সর্বমোট লাভঃ <bold> " . $total_interest . " টাকা<br> <bold>সর্বমোট ঋণ (লাভ সহ)ঃ <bold> " . $total_loan_w_ints . " টাকা";

                                $sql = $this->conn->prepare("INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES ('${from}', '${sub}', '${details}', '1')");
                                if ($sql->execute()) {
                                    return true;
                                }

                                return true;
                            } else {
                                return true;
                            }
                        } else {
                            return true;
                        }
                    } else {
                        $this->conn->rollback();
                        return false;
                    }
                } else {
                    $this->conn->rollback();
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    // Saving Profile closing
    public function savClosing($clientID, $savings_profile_id, $feild_id, $center_id, $period_id, $book, $interest, $total_balance, $expression, $officers_id)
    {

        $this->conn->beginTransaction();
        // Collection is exist or not
        $sql = $this->conn->prepare("SELECT count(*) AS row FROM saving_collections  WHERE client_id = :client_id AND savings_prof_id = :savings_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book");

        $sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result['row'] > 0) {

            $sql = $this->conn->prepare("UPDATE saving_collections SET status = '0'  WHERE client_id = :client_id AND savings_prof_id = :savings_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book");

            $sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book]);

            $result = $sql->rowCount();
            if ($result > 0) {
                $sql = $this->conn->prepare("SELECT count(*) AS row FROM saving_withdrawals  WHERE client_id = :client_id AND savings_prof_id = :savings_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book");

                $sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book]);

                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if ($result['row'] > 0) {

                    $sql = $this->conn->prepare("UPDATE saving_withdrawals SET status = '0'  WHERE client_id = :client_id AND savings_prof_id = :savings_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book");

                    $sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book]);

                    $result = $sql->rowCount();
                    if ($result == 0) {
                        $this->conn->rollback();
                        return false;
                    }
                }
            } else {
                $this->conn->rollback();
                return false;
            }
        }

        $sql = $this->conn->prepare("UPDATE saving_profiles SET status = '0', closing_interest = :interest, closing_balance_with_interest = :total_balance, closing_expression = :expression, closing_at = CURRENT_TIMESTAMP  WHERE client_id = :client_id AND saving_profiles_id = :savings_prof_id AND field_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book");

        if ($sql->execute([":interest" => $interest, ":total_balance" => $total_balance, "expression" => $expression, ":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book])) {

            $result = $sql->rowCount();
            if ($result > 0) {
                $sql = $this->conn->prepare("UPDATE savings_acc_checks SET status = '0' WHERE client_id = :client_id AND saving_profiles_id = :savings_prof_id AND field_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book");

                $sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book]);

                $result = $sql->rowCount();

                if ($result > 0) {

                    $sql = $this->conn->prepare("SELECT f.field_name, c.center_name, s.balance, p.period_name, r.name FROM client_registers AS r INNER JOIN feilds AS f ON r.feild_id = f.feild_id INNER JOIN centers AS c ON r.center_id = c.center_id INNER JOIN saving_profiles as s ON r.client_id = s.client_id INNER JOIN periods as p ON s.period_id = p.period_id WHERE r.client_id = :client_id AND f.feild_id =:feild_id AND c.center_id  = :center_id AND s.saving_profiles_id = :saving_profiles_id AND p.period_id= :period_id");

                    if ($sql->execute([":client_id" => $clientID, ":feild_id" => $feild_id, ":center_id" => $center_id, ":saving_profiles_id" => $savings_profile_id,  ":period_id" => $period_id])) {
                        $result = $sql->rowCount();
                        if ($result > 0) {
                            $row = $sql->fetch(PDO::FETCH_ASSOC);

                            $from = $officers_id;
                            $sub = "বই নং " . $book . " | সঞ্চয় ক্লোজ";
                            $details = "<bold>ফিল্ডঃ</bold> " . $row['field_name']  . "  <br> <bold>কেন্দ্রঃ</bold> " . $row['center_name']  . "  <br> <bold>ক্ষেত্রঃ</bold> " . $row['period_name']  . "  <br> <bold>বই নংঃ/<bold> " . $book . "<br> <bold>নামঃ</bold> " . $row['name']  . "  <br> <bold>আমানত ছিলোঃ</bold> " . $row['balance']  . " টাকা<br> <bold>লাভ দিয়েছেঃ</bold> " . $interest . " টাকা <br> <bold>সর্বমোটঃ<bold> " . $total_balance . " টাকা";

                            $expence = $sub . "<br>" . $details;

                            $sql = $this->conn->prepare("INSERT INTO expenses(expence, details, type, officer_id) VALUES ('${interest}', '${expence}', '4', '${from}')");
                            if ($sql->execute()) {
                                $this->conn->commit();

                                $sql = $this->conn->prepare("INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES ('${from}', '${sub}', '${details}', '1')");
                                if ($sql->execute()) {
                                    return true;
                                }

                                return true;
                            } else {
                                $this->conn->rollback();
                                return false;
                            }
                        } else {
                            return true;
                        }
                    } else {
                        return true;
                    }
                } else {

                    $this->conn->rollback();
                    return false;
                }
            } else {
                $this->conn->rollback();
                return false;
            }
        } else {
            $this->conn->rollback();
            return false;
        }
    }

    public function loanClosing($loanID, $feild, $center, $clientID, $period, $reserve, $balance, $loan_remaining, $interest_remaining, $details, $officers_id, $total_loan, $total_deposit, $total_interest, $deposit_interest, $book)
    {
        $this->conn->beginTransaction();
        // Collection is exist or not

        $sql = $this->conn->prepare("SELECT count(*) AS row FROM loan_collections  WHERE client_id = :client_id AND loan_prof_id = :loan_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id");

        $sql->execute([":client_id" => $clientID, ":loan_prof_id" => $loanID, ":feild_id" => $feild, ":center_id" => $center, ":period_id" => $period]);

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result['row'] > 0) {

            $sql = $this->conn->prepare("UPDATE loan_collections SET status = '0'  WHERE client_id = :client_id AND loan_prof_id = :loan_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id");

            $sql->execute([":client_id" => $clientID, ":loan_prof_id" => $loanID, ":feild_id" => $feild, ":center_id" => $center, ":period_id" => $period]);

            $result = $sql->rowCount();
            if ($result == 0) {
                $this->conn->rollback();
                return false;
            }
        }

        $sql = $this->conn->prepare("UPDATE loan_profiles SET status = '0', closing_fee = :closing_fee, closing_expression = :details, closing_at = CURRENT_TIMESTAMP WHERE client_id = :client_id AND loan_profile_id  = :loan_prof_id AND field_id = :feild_id AND center_id = :center_id AND period_id = :period_id");

        if ($sql->execute([":closing_fee" => $reserve, ":details" => $details, ":client_id" => $clientID, ":loan_prof_id" => $loanID, ":feild_id" => $feild, ":center_id" => $center, ":period_id" => $period])) {

            $result = $sql->rowCount();

            if ($result > 0) {

                $sql = $this->conn->prepare("UPDATE loan_acc_checks SET status = '0' WHERE client_id = :client_id AND loan_profile_id = :loan_prof_id AND field_id = :feild_id AND center_id = :center_id AND period_id = :period_id");

                $sql->execute([":client_id" => $clientID, ":loan_prof_id" => $loanID, ":feild_id" => $feild, ":center_id" => $center, ":period_id" => $period]);

                $result = $sql->rowCount();

                if ($result > 0) {
                    $date = date('Y-m-d');
                    $dec = "বই নং " . $book . " | ঋণ ক্লোজ";

                    $sql = $this->conn->prepare("INSERT INTO incomes (date, income, details, officer_id) VALUES (:date, :income, :details, :officer_id)");
                    $sql->execute([":date" => $date, ":income" => $reserve, ":details" => $dec, ":officer_id" => $officers_id]);
                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();

                        $sql = $this->conn->prepare("SELECT f.field_name, c.center_name, s.balance, p.period_name, r.name FROM client_registers AS r INNER JOIN feilds AS f ON r.feild_id = f.feild_id INNER JOIN centers AS c ON r.center_id = c.center_id INNER JOIN loan_profiles as s ON r.client_id = s.client_id INNER JOIN periods as p ON s.period_id = p.period_id WHERE r.client_id = :client_id AND f.feild_id =:feild_id AND c.center_id  = :center_id AND s.loan_profile_id = :loan_profile_id AND p.period_id= :period_id");

                        if ($sql->execute([":client_id" => $clientID, ":feild_id" => $feild, ":center_id" => $center, ":loan_profile_id" => $loanID,  ":period_id" => $period])) {
                            $result = $sql->rowCount();
                            if ($result > 0) {
                                $row = $sql->fetch(PDO::FETCH_ASSOC);

                                $from = $officers_id;
                                $sub = "বই নং " . $book . " | ঋণ ক্লোজ";
                                $details = "<bold>ফিল্ডঃ</bold> " . $row['field_name']  . "  <br> <bold>কেন্দ্রঃ</bold> " . $row['center_name']  . "  <br> <bold>ক্ষেত্রঃ</bold> " . $row['period_name']  . "  <br> <bold>বই নংঃ/<bold> " . $book . "<br> <bold>নামঃ</bold> " . $row['name']  . "  <br> <bold>সঞ্চয় ছিলোঃ</bold> " . $balance  . " টাকা<br> <bold>ঋণ দিয়েছেঃ</bold> " . $total_loan . " টাকা <br> <bold>ঋণ আদায়ঃ <bold> " . $total_deposit . " টাকা <br> <bold>ঋণ বাকি <bold> " . $loan_remaining . " টাকা<bold>সর্বমোট লাভঃ<bold> " . $total_interest . " টাকা <br> <bold>লাভ আদায়ঃ <bold> " . $deposit_interest . " টাকা <br> <bold>লাভ বাকি <bold> " . $interest_remaining . " টাকা";

                                $sql = $this->conn->prepare("INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES ('${from}', '${sub}', '${details}', '1')");
                                if ($sql->execute()) {
                                    return true;
                                }

                                return true;
                            } else {
                                return true;
                            }
                        } else {
                            return true;
                        }
                    } else {
                        $this->conn->rollback();
                        return false;
                    }
                } else {

                    $this->conn->rollback();
                    return false;
                }
            } else {
                $this->conn->rollback();
                return false;
            }
        } else {
            $this->conn->rollback();
            return false;
        }
    }
}
