<?php

namespace controller\FieldDataController\FieldDataController;

use PDO;
use config\Database\Database;

include_once "../config/app.php";
// include_once "../config/database.php";

class FieldDataController
{
    public $db, $conn, $db_name;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->link;
        $this->db_name = $this->db->dbName;
    }

    // Field Cards load
    public function fieldCardsLoad($query)
    {
        // return $query;
        // die();
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Field Cards load
    public function totalChart($query)
    {
        // return $query;
        // die();
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Field Cards load
    public function chartLoad($query)
    {
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Field clientAccLoad load
    public function clientAccLoad($query)
    {

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function clientEdit($id, $name, $husband_name = null, $father_name = null, $mother_name, $nid, $birth_reg_id_no, $up_occapasion, $up_religion, $up_gender, $phone_number, $phone_number_2, $income, $up_position, $blood_group = null, $bank_account, $check_no, $up_present_address, $up_parmanent_address, $client_img_name = null)
    {
        if ($client_img_name != null) {
            $query = "UPDATE client_registers SET name=:name,husbands_name=:husband,fathers_name=:father,mothers_name=:mother,client_nid=:nid,client_dob=:dob,client_occupation=:occupation,religion=:religion,client_gander=:gander,client_img='${client_img_name}',client_mobile_1=:mobile1,client_mobile_2=:mobile2,client_income=:income,client_position=:position,blood_grp=:blood,client_back_acc=:bankAcc,check_no=:bankCheck,present_address=:presentAddress,parmanent_address=:permanentAddress,updated_at= CURRENT_DATE() WHERE client_id = :id";
        } else {
            $query = "UPDATE client_registers SET name=:name,husbands_name=:husband,fathers_name=:father,mothers_name=:mother,client_nid=:nid,client_dob=:dob,client_occupation=:occupation,religion=:religion,client_gander=:gander,client_mobile_1=:mobile1,client_mobile_2=:mobile2,client_income=:income,client_position=:position,blood_grp=:blood,client_back_acc=:bankAcc,check_no=:bankCheck,present_address=:presentAddress,parmanent_address=:permanentAddress,updated_at= CURRENT_DATE() WHERE client_id = :id";
            // $query = "UPDATE client_registers SET name='$name',husbands_name='$husband_name',fathers_name='$father_name',mothers_name = '$mother_name',client_nid='$nid',client_dob='$birth_reg_id_no',client_occupation='$up_occapasion',religion='$up_religion',client_gander='$up_gender',client_mobile_1='$phone_number',client_mobile_2='$phone_number_2',client_income='$income',client_position='$up_position',blood_grp='$blood_group',client_back_acc='$bank_account',check_no='$check_no',present_address='$up_present_address',parmanent_address'$up_parmanent_address',updated_at= CURRENT_DATE() WHERE client_id = '$id'";
        }
        // echo $query;
        // die();
        $sql = $this->conn->prepare($query);
        $sql->execute([":name" => $name, ":husband" => $husband_name, ":father" => $father_name, ":mother" => $mother_name, ":nid" => $nid, ":dob" => $birth_reg_id_no, ":occupation" => $up_occapasion, ":religion" => $up_religion, ":gander" => $up_gender, ":mobile1" => $phone_number, ":mobile2" => $phone_number_2, ":income" => $income, ":position" => $up_position, ":blood" => $blood_group, ":bankAcc" => $bank_account, ":bankCheck" => $check_no, ":presentAddress" => $up_present_address, ":permanentAddress" => $up_parmanent_address, ":id" => $id]);

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    // Audit Functions
    // Savings Audit Function
    public function savingsAuditLoad()
    {
        $query = "SELECT SUM(deposit) AS total, period_name FROM ( SELECT l.deposit AS deposit, p.period_name FROM saving_collections AS l INNER JOIN periods AS p ON p.period_id = l.period_id WHERE l.status = '1' UNION ALL SELECT 0 AS deposit, period_name FROM periods WHERE period_type LIKE '%1%' ) AS a GROUP BY period_name";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Loan Savings Audit Function
    public function loanSavingsAuditLoad()
    {
        $query = "SELECT SUM(deposit) AS total, period_name FROM ( SELECT l.deposit AS deposit, p.period_name FROM loan_collections AS l INNER JOIN periods AS p ON p.period_id = l.period_id WHERE l.period_id IN (SELECT period_id FROM periods WHERE period_type LIKE '%2%') AND l.status = '1' UNION ALL SELECT 0 AS deposit, period_name FROM periods WHERE period_type LIKE '%2%' ) AS a GROUP BY period_name";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Loan  Audit Function
    public function loansAuditLoad()
    {
        $query = "SELECT SUM(total_loan) AS total_loan, SUM(total_interest) AS total_interest, SUM(loan) AS loan, SUM(interest) AS interest, (SUM(total_loan)-SUM(loan)) AS loan_rem, (SUM(total_interest)-SUM(interest)) AS interest_rem, (SUM(loan)+(SUM(total_loan)-SUM(loan))) AS loan_total, (SUM(interest)+(SUM(total_interest)-SUM(interest))) AS interest_total, period_name FROM ( SELECT lp.total_loan, lp.total_interest, 0 AS loan, 0 AS interest, p.period_name FROM loan_profiles AS lp INNER JOIN periods AS p ON p.period_id = lp.period_id WHERE lp.status = '1' UNION ALL SELECT 0 AS total_loan, 0 AS total_interest, l.loan AS loan, l.interest AS interest, p.period_name FROM loan_collections AS l INNER JOIN periods AS p ON p.period_id = l.period_id WHERE l.status = '1' UNION ALL SELECT 0 AS total_loan, 0 AS total_interest, 0 AS loan, 0 AS interest, period_name FROM periods WHERE period_type LIKE '%2%' ) AS a GROUP BY period_name";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Total Savings Function
    public function totalFDRLoad()
    {
        $query = "SELECT 'সাধারণ সঞ্চয়' AS name, SUM(deposit) AS savings FROM saving_collections WHERE status = '1'
                    UNION ALL
                    SELECT 'ঋণ সঞ্চয়' AS name, SUM(deposit) AS savings FROM loan_collections WHERE status = '1'
                    UNION ALL 
                    SELECT 'এফ.ডি.আর' AS name, SUM(deposit) AS savings FROM fdr_lists WHERE status = '1'";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Final Audit Calculation Function
    public function finalAuditLoad()
    {
        $query = "SELECT 'সর্বমোট ঋণ বাকি' AS name, (SUM(totalLoan)-SUM(loan)) AS tk FROM ( 
            SELECT SUM(total_loan) AS totalLoan, 0 AS loan FROM loan_profiles WHERE status = '1' UNION ALL SELECT 0 AS totalLoan, SUM(loan) AS loan FROM loan_collections WHERE status = '1' ) AS a
            UNION ALL
            SELECT 'সর্বমোট সঞ্চয়' AS name, SUM(savings) AS tk FROM (
                SELECT 'সাধারণ সঞ্চয়' AS name, SUM(deposit) AS savings FROM saving_collections WHERE status = '1'
                UNION ALL
                SELECT 'ঋণ সঞ্চয়' AS name, SUM(deposit) AS savings FROM loan_collections WHERE status = '1'
                UNION ALL 
                SELECT 'এফ.ডি.আর' AS name, SUM(deposit) AS savings FROM fdr_lists WHERE status = '1') AS b";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function userPermission($query)
    {

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    // Checking CLient ACCOUNT Function
    public function checkingACC($query)
    {
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function savingsAccChecking($savingsID, $checkID)
    {
        $query = "SELECT saving_profiles_id, client_id, book, field_id, center_id, period_id, balance FROM saving_profiles WHERE saving_profiles_id = '${savingsID}' LIMIT 1";

        $sql = $this->conn->prepare($query);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            $savingsCheckID = $result[0]['saving_profiles_id'];
            $client_id = $result[0]['client_id'];
            $book = $result[0]['book'];
            $field_id = $result[0]['field_id'];
            $center_id = $result[0]['center_id'];
            $period_id = $result[0]['period_id'];
            $balance = $result[0]['balance'];

            $periodQuery = "SELECT period FROM periods WHERE period_id = '${period_id}' limit 1";
            $periodSql = $this->conn->prepare($periodQuery);
            $periodSql->execute();
            $period_time = $periodSql->fetchALL(PDO::FETCH_ASSOC);
            if ($period_time[0]['period'] == 30) {
                $nextCheckDate = date("Y-m-d", strtotime("+90days"));
            } elseif ($period_time[0]['period'] == 7) {
                $nextCheckDate = date("Y-m-d", strtotime("+60days"));
            } elseif ($period_time[0]['period'] == 365) {
                $nextCheckDate = date("Y-m-d", strtotime("+120days"));
            } else {
                $nextCheckDate = date("Y-m-d", strtotime("+30days"));
            }
            $officerID = $_SESSION['auth']['user_id'];

            $insertQuery = "INSERT INTO savings_acc_checks(saving_profiles_id, client_id, book, field_id, center_id, period_id, balance, checked_officer_id, next_check_date) VALUES ('${savingsCheckID}', '${client_id}', '${book}', '${field_id}', '${center_id}', '${period_id}', '${balance}', '${officerID}', '${nextCheckDate}')";

            $this->conn->beginTransaction();
            $sql = $this->conn->prepare($insertQuery);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $updateQuery = "UPDATE `savings_acc_checks` SET status ='2' WHERE acc_check_id = '${checkID}'";

                $sql = $this->conn->prepare($updateQuery);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $this->conn->commit();
                    return true;
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
    public function loanAccChecking($loanCheckID, $checkID)
    {
        $query = "SELECT loan_profile_id, client_id, book, field_id, center_id, period_id, balance, loan_recover, loan_remaining, interest_recover, interest_remaining FROM loan_profiles WHERE loan_profile_id = '${loanCheckID}' LIMIT 1";

        $sql = $this->conn->prepare($query);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            $loanCheckID = $result[0]['loan_profile_id'];
            $client_id = $result[0]['client_id'];
            $book = $result[0]['book'];
            $field_id = $result[0]['field_id'];
            $center_id = $result[0]['center_id'];
            $period_id = $result[0]['period_id'];
            $balance = $result[0]['balance'];
            $loan_recover = $result[0]['loan_recover'];
            $loan_remaining = $result[0]['loan_remaining'];
            $interest_recover = $result[0]['interest_recover'];
            $interest_remaining = $result[0]['interest_remaining'];

            $periodQuery = "SELECT period FROM periods WHERE period_id = '${period_id}' limit 1";
            $periodSql = $this->conn->prepare($periodQuery);
            $periodSql->execute();
            $period_time = $periodSql->fetchALL(PDO::FETCH_ASSOC);
            if ($period_time[0]['period'] == 30) {
                $nextCheckDate = date("Y-m-d", strtotime("+90days"));
            } elseif ($period_time[0]['period'] == 7) {
                $nextCheckDate = date("Y-m-d", strtotime("+60days"));
            } elseif ($period_time[0]['period'] == 365) {
                $nextCheckDate = date("Y-m-d", strtotime("+120days"));
            } else {
                $nextCheckDate = date("Y-m-d", strtotime("+30days"));
            }
            $officerID = $_SESSION['auth']['user_id'];

            $insertQuery = "INSERT INTO loan_acc_checks(loan_profile_id, client_id, book, field_id, center_id, period_id, balance, loan_recover, loan_remaining, interest_recover, interest_remaining, checked_officer_id, next_check_date) VALUES ('${loanCheckID}', '${client_id}', '${book}', '${field_id}', '${center_id}', '${period_id}', '${balance}', '${loan_recover}', '${loan_remaining}', '${interest_recover}', '${interest_remaining}', '${officerID}', '${nextCheckDate}')";

            $this->conn->beginTransaction();
            $sql = $this->conn->prepare($insertQuery);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $updateQuery = "UPDATE loan_acc_checks SET status ='2' WHERE acc_check_id = '${checkID}'";

                $sql = $this->conn->prepare($updateQuery);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $this->conn->commit();
                    return true;
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

    // Tamadi Account Check

    public function tamadiSavingsAccChecking($savingsID, $checkID)
    {
        $query = "SELECT saving_profiles_id, client_id, book, field_id, center_id, period_id, balance FROM saving_profiles WHERE saving_profiles_id = '${savingsID}' LIMIT 1";

        $sql = $this->conn->prepare($query);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            $savingsCheckID = $result[0]['saving_profiles_id'];
            $client_id = $result[0]['client_id'];
            $book = $result[0]['book'];
            $field_id = $result[0]['field_id'];
            $center_id = $result[0]['center_id'];
            $period_id = $result[0]['period_id'];
            $balance = $result[0]['balance'];

            $periodQuery = "SELECT period FROM periods WHERE period_id = '${period_id}' limit 1";
            $periodSql = $this->conn->prepare($periodQuery);
            $periodSql->execute();
            $period_time = $periodSql->fetchALL(PDO::FETCH_ASSOC);
            if ($period_time[0]['period'] == 30) {
                $nextCheckDate = date("Y-m-d", strtotime("+90days"));
            } elseif ($period_time[0]['period'] == 7) {
                $nextCheckDate = date("Y-m-d", strtotime("+60days"));
            } elseif ($period_time[0]['period'] == 365) {
                $nextCheckDate = date("Y-m-d", strtotime("+120days"));
            } else {
                $nextCheckDate = date("Y-m-d", strtotime("+30days"));
            }
            $officerID = $_SESSION['auth']['user_id'];

            $insertQuery = "INSERT INTO savings_acc_checks(saving_profiles_id, client_id, book, field_id, center_id, period_id, balance, checked_officer_id, next_check_date) VALUES ('${savingsCheckID}', '${client_id}', '${book}', '${field_id}', '${center_id}', '${period_id}', '${balance}', '${officerID}', '${nextCheckDate}')";

            $this->conn->beginTransaction();
            $sql = $this->conn->prepare($insertQuery);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $updateQuery = "UPDATE savings_acc_checks SET status ='2' WHERE acc_check_id = '${checkID}'";

                $sql = $this->conn->prepare($updateQuery);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $updateQuery = "UPDATE saving_profiles SET status ='1' WHERE saving_profiles_id = '${savingsID}'";

                    $sql = $this->conn->prepare($updateQuery);
                    $sql->execute();
                    if (
                        $sql->rowCount() > 0
                    ) {
                        $this->conn->commit();
                        return true;
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
            return false;
        }
    }
    public function tamadiLoanAccChecking($loanCheckID, $checkID)
    {
        $query = "SELECT loan_profile_id, client_id, book, field_id, center_id, period_id, balance, loan_recover, loan_remaining, interest_recover, interest_remaining FROM loan_profiles WHERE loan_profile_id = '${loanCheckID}' LIMIT 1";

        $sql = $this->conn->prepare($query);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            $loanCheckID = $result[0]['loan_profile_id'];
            $client_id = $result[0]['client_id'];
            $book = $result[0]['book'];
            $field_id = $result[0]['field_id'];
            $center_id = $result[0]['center_id'];
            $period_id = $result[0]['period_id'];
            $balance = $result[0]['balance'];
            $loan_recover = $result[0]['loan_recover'];
            $loan_remaining = $result[0]['loan_remaining'];
            $interest_recover = $result[0]['interest_recover'];
            $interest_remaining = $result[0]['interest_remaining'];

            $periodQuery = "SELECT period FROM periods WHERE period_id = '${period_id}' limit 1";
            $periodSql = $this->conn->prepare($periodQuery);
            $periodSql->execute();
            $period_time = $periodSql->fetchALL(PDO::FETCH_ASSOC);
            if ($period_time[0]['period'] == 30) {
                $nextCheckDate = date("Y-m-d", strtotime("+90days"));
            } elseif ($period_time[0]['period'] == 7) {
                $nextCheckDate = date("Y-m-d", strtotime("+60days"));
            } elseif ($period_time[0]['period'] == 365) {
                $nextCheckDate = date("Y-m-d", strtotime("+120days"));
            } else {
                $nextCheckDate = date("Y-m-d", strtotime("+30days"));
            }
            $officerID = $_SESSION['auth']['user_id'];

            $insertQuery = "INSERT INTO loan_acc_checks(loan_profile_id, client_id, book, field_id, center_id, period_id, balance, loan_recover, loan_remaining, interest_recover, interest_remaining, checked_officer_id, next_check_date) VALUES ('${loanCheckID}', '${client_id}', '${book}', '${field_id}', '${center_id}', '${period_id}', '${balance}', '${loan_recover}', '${loan_remaining}', '${interest_recover}', '${interest_remaining}', '${officerID}', '${nextCheckDate}')";

            $this->conn->beginTransaction();
            $sql = $this->conn->prepare($insertQuery);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $updateQuery = "UPDATE loan_acc_checks SET status ='2' WHERE acc_check_id = '${checkID}'";

                $sql = $this->conn->prepare($updateQuery);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $updateQuery = "UPDATE loan_profiles SET status ='1' WHERE loan_profile_id = '${loanCheckID}'";

                    $sql = $this->conn->prepare($updateQuery);
                    $sql->execute();
                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;
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
            return false;
        }
    }

    // Savings Profile Update
    public function savingsReg($id, $periodID, $deposit, $expiry_date, $deposit_installment, $total_wt_ints, $interest, $total_w_ints, $nominee_name, $nominee_husband_name = null, $nominee_father_name = null, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $Nominee_address, $nominee_img_name = null)
    {
        $this->conn->beginTransaction();

        if (isset($nominee_img_name)) {
            $sql = $this->conn->prepare("UPDATE saving_profiles SET deposit_installment='${deposit}',duration='${expiry_date}',total_installment='${deposit_installment}',total_without_interest='${total_wt_ints}',interest='${interest}',total_with_interest='${total_w_ints}', nominee_name='${nominee_name}',nominee_husband='${nominee_husband_name}',nominee_father='${nominee_father_name}',nominee_mother='${nominee_mother_name}',nominee_dob='${nominee_birth_reg_id_no}',nominee_nid='${nominee_nid}',nominee_occupation='${nominee_occapasion}',nominee_relation='${relation}',nominee_gendar='${nominee_gender}',nominee_img='${nominee_img_name}',nominee_address='${Nominee_address}' WHERE saving_profiles_id = $id");
        } else {
            $sql = $this->conn->prepare("UPDATE saving_profiles SET deposit_installment='${deposit}',duration='${expiry_date}',total_installment='${deposit_installment}',total_without_interest='${total_wt_ints}',interest='${interest}',total_with_interest='${total_w_ints}', nominee_name='${nominee_name}',nominee_husband='${nominee_husband_name}',nominee_father='${nominee_father_name}',nominee_mother='${nominee_mother_name}',nominee_dob='${nominee_birth_reg_id_no}',nominee_nid='${nominee_nid}',nominee_occupation='${nominee_occapasion}',nominee_relation='${relation}',nominee_gendar='${nominee_gender}',nominee_address='${Nominee_address}' WHERE saving_profiles_id = $id");
        }

        // $sql->execute();
        if ($sql->execute()) {
            $sql = $this->conn->prepare("SELECT period_id FROM `saving_profiles` WHERE saving_profiles_id = $id");
            $sql->execute();

            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            $period_id = $result[0]['period_id'];

            if ($period_id != $periodID) {
                $saving_collections_sql = $this->conn->prepare("SELECT COUNT(*) AS total_collection FROM saving_collections WHERE savings_prof_id = $id");
                $saving_collections_sql->execute();
                $saving_collections = $saving_collections_sql->fetchALL(PDO::FETCH_ASSOC);

                if ($saving_collections[0]['total_collection'] > 0) {
                    $sql = $this->conn->prepare("UPDATE saving_collections SET period_id='$periodID' WHERE savings_prof_id = $id");
                    $sql->execute();

                    if ($sql->rowCount() == 0) {
                        $this->conn->rollback();
                        return false;
                        die();
                    }
                }

                $saving_withdrawal_sql = $this->conn->prepare("SELECT COUNT(*) AS total_withdrawal FROM saving_withdrawals WHERE savings_prof_id = $id");
                $saving_withdrawal_sql->execute();
                $saving_withdrawal = $saving_withdrawal_sql->fetchALL(PDO::FETCH_ASSOC);

                if ($saving_withdrawal[0]['total_withdrawal'] > 0) {
                    $sql = $this->conn->prepare("UPDATE saving_withdrawals SET period_id='$periodID' WHERE savings_prof_id = $id");
                    $sql->execute();

                    if ($sql->rowCount() == 0) {
                        $this->conn->rollback();
                        return false;
                        die();
                    }
                }

                $sql = $this->conn->prepare("UPDATE saving_profiles SET period_id='$periodID' WHERE saving_profiles_id = $id");
                $sql->execute();

                if ($sql->rowCount()) {
                    $this->conn->commit();
                    return true;
                } else {
                    $this->conn->rollback();
                    return false;
                }
            } else {
                $this->conn->commit();
                return true;
            }
        } else {
            $this->conn->rollback();
            return false;
        }
    }

    // Loan Profile Update
    public function loanRegEdit($id, $periodID, $deposit, $loan_given, $installment, $expiry_date, $total_w_ints, $total_interest, $interest, $loan_installment, $interest_installment, $nominee_name, $nominee_husband_name = null, $nominee_father_name = null, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $Nominee_address, $nominee_img_name = null)
    {
        $this->conn->beginTransaction();

        if (isset($nominee_img_name)) {
            $sql = $this->conn->prepare("UPDATE loan_profiles SET savings='${deposit}',total_loan='${loan_given}',total_intsallment='${installment}',interest='${interest}',total_interest='${total_interest}',total_loan_w_ints='${total_w_ints}',loan_installment='${loan_installment}',interest_installment='${interest_installment}',duration='${expiry_date}',loan_remaining=total_loan - loan_recover,interest_remaining=total_interest - interest_recover,nominee_name='${nominee_name}',nominee_husband='${nominee_husband_name}',nominee_father='${nominee_father_name}',nominee_mother='${nominee_mother_name}',nominee_dob='${nominee_birth_reg_id_no}',nominee_nid='${nominee_nid}',nominee_occupation='${nominee_occapasion}',nominee_relation='${relation}',nominee_gendar='${nominee_gender}', nominee_img='${nominee_img_name}',nominee_address='${Nominee_address}' WHERE loan_profile_id = $id");
        } else {
            $sql = $this->conn->prepare("UPDATE loan_profiles SET savings='${deposit}',total_loan='${loan_given}',total_intsallment='${installment}',interest='${interest}',total_interest='${total_interest}',total_loan_w_ints='${total_w_ints}',loan_installment='${loan_installment}',interest_installment='${interest_installment}',duration='${expiry_date}',loan_remaining=total_loan - loan_recover,interest_remaining=total_interest - interest_recover,nominee_name='${nominee_name}',nominee_husband='${nominee_husband_name}',nominee_father='${nominee_father_name}',nominee_mother='${nominee_mother_name}',nominee_dob='${nominee_birth_reg_id_no}',nominee_nid='${nominee_nid}',nominee_occupation='${nominee_occapasion}',nominee_relation='${relation}',nominee_gendar='${nominee_gender}',nominee_address='${Nominee_address}' WHERE loan_profile_id = $id");
        }

        // $sql->execute();
        if ($sql->execute()) {
            $sql = $this->conn->prepare("SELECT period_id FROM loan_profiles WHERE loan_profile_id = $id");
            $sql->execute();

            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            $period_id = $result[0]['period_id'];

            if ($period_id != $periodID) {
                $loan_collections_sql = $this->conn->prepare("SELECT COUNT(*) AS total_collection FROM loan_collections WHERE loan_prof_id = $id");
                $loan_collections_sql->execute();
                $loan_collections = $loan_collections_sql->fetchALL(PDO::FETCH_ASSOC);

                if ($loan_collections[0]['total_collection'] > 0) {
                    $sql = $this->conn->prepare("UPDATE loan_collections SET period_id='$periodID' WHERE loan_prof_id = $id");
                    $sql->execute();

                    if ($sql->rowCount() == 0) {
                        $this->conn->rollback();
                        return false;
                        die();
                    }
                }

                $loan_saving_withdrawal_sql = $this->conn->prepare("SELECT COUNT(*) AS total_withdrawal FROM loan_savings_withdrawals WHERE loan_prof_id = $id");
                $loan_saving_withdrawal_sql->execute();
                $loan_saving_withdrawal = $loan_saving_withdrawal_sql->fetchALL(PDO::FETCH_ASSOC);

                if ($loan_saving_withdrawal[0]['total_withdrawal'] > 0) {
                    $sql = $this->conn->prepare("UPDATE loan_savings_withdrawals SET period_id='$periodID' WHERE loan_prof_id = $id");
                    $sql->execute();

                    if ($sql->rowCount() == 0) {
                        $this->conn->rollback();
                        return false;
                        die();
                    }
                }

                $sql = $this->conn->prepare("UPDATE loan_profiles SET period_id='$periodID' WHERE loan_profile_id = $id");
                $sql->execute();

                if ($sql->rowCount()) {
                    $this->conn->commit();
                    return true;
                } else {
                    $this->conn->rollback();
                    return false;
                }
            } else {
                $this->conn->commit();
                return true;
            }
        } else {
            $this->conn->rollback();
            return false;
        }
    }

    // Loan Profile Delete
    public function loanAccDelete($id)
    {
        $this->conn->beginTransaction();

        $loan_collections_sql = $this->conn->prepare("SELECT COUNT(*) AS total_collection FROM loan_collections WHERE loan_prof_id = $id");
        $loan_collections_sql->execute();
        $loan_collections = $loan_collections_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_collections[0]['total_collection'] > 0) {
            $sql = $this->conn->prepare("DELETE FROM loan_collections WHERE loan_prof_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $loan_withdrawal_sql = $this->conn->prepare("SELECT COUNT(*) AS total_withdrawal FROM loan_savings_withdrawals WHERE loan_prof_id = $id");
        $loan_withdrawal_sql->execute();
        $loan_withdrawal = $loan_withdrawal_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_withdrawal[0]['total_withdrawal'] > 0) {
            $sql = $this->conn->prepare("DELETE FROM loan_savings_withdrawals WHERE loan_prof_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $sql = $this->conn->prepare("DELETE FROM loan_acc_checks WHERE loan_profile_id = $id");
        $sql->execute();

        if ($sql->rowCount() == 0) {
            $this->conn->rollback();
            return false;
            die();
        }

        $nominee_img_sql = $this->conn->prepare("SELECT nominee_img FROM loan_profiles WHERE loan_profile_id = $id");
        $nominee_img_sql->execute();
        $nominee_img = $nominee_img_sql->fetchALL(PDO::FETCH_ASSOC);
        $nominee_image = $nominee_img[0]['nominee_img'];

        if (unlink('../img/' . $nominee_image)) {
            $sql = $this->conn->prepare("DELETE FROM loan_profiles WHERE loan_profile_id = $id");
            $sql->execute();

            if ($sql->rowCount()) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollback();
                return false;
            }
        } else {
            $this->conn->rollback();
            return false;
        }
    }

    // Savings Profile Delete
    public function savingAccDelete($id)
    {
        $this->conn->beginTransaction();

        $saving_collections_sql = $this->conn->prepare("SELECT COUNT(*) AS total_collection FROM saving_collections WHERE savings_prof_id = $id");
        $saving_collections_sql->execute();
        $saving_collections = $saving_collections_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($saving_collections[0]['total_collection'] > 0) {
            $sql = $this->conn->prepare("DELETE FROM saving_collections WHERE savings_prof_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $saving_withdrawal_sql = $this->conn->prepare("SELECT COUNT(*) AS total_withdrawal FROM saving_withdrawals WHERE savings_prof_id = $id");
        $saving_withdrawal_sql->execute();
        $saving_withdrawal = $saving_withdrawal_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($saving_withdrawal[0]['total_withdrawal'] > 0) {
            $sql = $this->conn->prepare("DELETE FROM saving_withdrawals WHERE savings_prof_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $sql = $this->conn->prepare("DELETE FROM loan_acc_checks WHERE saving_profiles_id = $id");
        $sql->execute();

        if ($sql->rowCount() == 0) {
            $this->conn->rollback();
            return false;
            die();
        }

        $nominee_img_sql = $this->conn->prepare("SELECT nominee_img FROM saving_profiles WHERE saving_profiles_id = $id");
        $nominee_img_sql->execute();
        $nominee_img = $nominee_img_sql->fetchALL(PDO::FETCH_ASSOC);
        $nominee_image = $nominee_img[0]['nominee_img'];

        if (unlink('../img/' . $nominee_image)) {
            $sql = $this->conn->prepare("DELETE FROM saving_profiles WHERE saving_profiles_id = $id");
            $sql->execute();

            if ($sql->rowCount()) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollback();
                return false;
            }
        } else {
            $this->conn->rollback();
            return false;
        }
    }

    // Credentials Update
    public function credentialsUpdate($id, $feildID, $centerID)
    {
        $this->conn->beginTransaction();

        $saving_collections_sql = $this->conn->prepare("SELECT COUNT(*) AS total_collection FROM saving_collections WHERE client_id = $id");
        $saving_collections_sql->execute();
        $saving_collections = $saving_collections_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($saving_collections[0]['total_collection'] > 0) {
            $sql = $this->conn->prepare("UPDATE saving_collections SET feild_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $saving_withdrawal_sql = $this->conn->prepare("SELECT COUNT(*) AS total_withdrawal FROM saving_withdrawals WHERE client_id = $id");
        $saving_withdrawal_sql->execute();
        $saving_withdrawal = $saving_withdrawal_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($saving_withdrawal[0]['total_withdrawal'] > 0) {
            $sql = $this->conn->prepare("UPDATE saving_withdrawals SET feild_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $loan_collections_sql = $this->conn->prepare("SELECT COUNT(*) AS total_collection FROM loan_collections WHERE client_id = $id");
        $loan_collections_sql->execute();
        $loan_collections = $loan_collections_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_collections[0]['total_collection'] > 0) {
            $sql = $this->conn->prepare("UPDATE loan_collections SET feild_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $loan_withdrawal_sql = $this->conn->prepare("SELECT COUNT(*) AS total_withdrawal FROM loan_savings_withdrawals WHERE client_id = $id");
        $loan_withdrawal_sql->execute();
        $loan_withdrawal = $loan_withdrawal_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_withdrawal[0]['total_withdrawal'] > 0) {
            $sql = $this->conn->prepare("UPDATE loan_savings_withdrawals SET feild_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $saving_acc_sql = $this->conn->prepare("SELECT COUNT(*) AS total_saving FROM saving_profiles WHERE client_id = $id");
        $saving_acc_sql->execute();
        $saving_acc = $saving_acc_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($saving_acc[0]['total_saving'] > 0) {
            $sql = $this->conn->prepare("UPDATE saving_profiles SET field_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $loan_acc_sql = $this->conn->prepare("SELECT COUNT(*) AS total_loan FROM loan_profiles WHERE client_id = $id");
        $loan_acc_sql->execute();
        $loan_acc = $loan_acc_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_acc[0]['total_loan'] > 0) {
            $sql = $this->conn->prepare("UPDATE loan_profiles SET field_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $loan_acc_check_sql = $this->conn->prepare("SELECT COUNT(*) AS total_loan_check FROM loan_acc_checks WHERE client_id = $id");
        $loan_acc_check_sql->execute();
        $loan_acc_check = $loan_acc_check_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_acc_check[0]['total_loan_check'] > 0) {
            $sql = $this->conn->prepare("UPDATE loan_acc_checks SET field_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $saving_acc_check_sql = $this->conn->prepare("SELECT COUNT(*) AS total_saving_check FROM savings_acc_checks WHERE client_id = $id");
        $saving_acc_check_sql->execute();
        $saving_acc_check = $saving_acc_check_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($saving_acc_check[0]['total_saving_check'] > 0) {
            $sql = $this->conn->prepare("UPDATE savings_acc_checks SET field_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $this->conn->rollback();
                return false;
                die();
            }
        }

        $sql = $this->conn->prepare("UPDATE client_registers SET feild_id='${feildID}',center_id='${centerID}' WHERE client_id = $id");
        $sql->execute();

        if ($sql->rowCount()) {
            $this->conn->commit();
            return true;
        } else {
            $this->conn->rollback();
            return false;
        }
    }

    // Register Delete
    public function registerDelete($id)
    {
        $loan_saving_profile_sql = $this->conn->prepare("SELECT COUNT(*) AS total_saving_profile FROM saving_profiles WHERE client_id = $id");
        $loan_saving_profile_sql->execute();
        $loan_saving_profile = $loan_saving_profile_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_saving_profile[0]['total_saving_profile'] > 0) {
            return '2';
            die();
        }

        $loan_loan_profile_sql = $this->conn->prepare("SELECT COUNT(*) AS total_loan_profile FROM loan_profiles WHERE client_id = $id");
        $loan_loan_profile_sql->execute();
        $loan_loan_profile = $loan_loan_profile_sql->fetchALL(PDO::FETCH_ASSOC);

        if ($loan_loan_profile[0]['total_loan_profile'] > 0) {
            return '2';
            die();
        }

        $client_img_sql = $this->conn->prepare("SELECT client_img FROM client_registers WHERE client_id = $id");
        $client_img_sql->execute();
        $client_img = $client_img_sql->fetchALL(PDO::FETCH_ASSOC);
        $client_image = $client_img[0]['client_img'];

        if (unlink('../img/' . $client_image)) {
            $sql = $this->conn->prepare("DELETE FROM client_registers WHERE client_id = $id");
            $sql->execute();

            if ($sql->rowCount()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
