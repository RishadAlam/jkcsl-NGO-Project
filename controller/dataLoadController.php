<?php

namespace controller\dataLoadController\dataLoadController;

use PDO;
use config\Database\Database;

include_once "../config/app.php";
// include_once "../config/database.php";

class dataLoadController
{
    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->link;
        $this->db_name = $this->db->dbName;
    }

    // Live Search function
    public function liveSearch($liveSearch)
    {
        if ($liveSearch != "") {
            $sql = $this->conn->prepare("SELECT client_id, feild_id, center_id, name, book FROM client_registers WHERE book LIKE '%${liveSearch}%' OR name LIKE '%${liveSearch}%'");
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $result = $sql->fetchALL(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }
    }
    // Feild Dataload function
    public function feildsLoad()
    {
        // return $table;
        // die();
        $sql = $this->conn->prepare("SELECT * FROM feilds WHERE status = 1");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Center Dataload function
    public function centersLoad($where = null)
    {
        if ($where == null) {
            $sql = $this->conn->prepare("SELECT * FROM centers WHERE status = 1");
            $sql->execute();
        } else {
            $sql = $this->conn->prepare("SELECT * FROM centers WHERE status = 1 AND feild_id = ?");
            $sql->execute([$where]);
        }
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function booksLoad($field = null, $center = null)
    {
        if ($field == null && $field == null) {
            $sql = $this->conn->prepare("SELECT book  FROM client_registers WHERE status = 1");
            $sql->execute();
        } else {
            $sql = $this->conn->prepare("SELECT client_id, book  FROM client_registers WHERE status = 1 AND feild_id = :feild AND center_id = :center");
            $sql->execute([':feild' => $field, ':center' => $center]);
        }
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function savingsbookLoad($field = null, $center = null, $period = null)
    {
        if ($field == null && $field == null && $period = null) {
            $sql = $this->conn->prepare("SELECT book  FROM saving_profiles WHERE status = 1");
            $sql->execute();
        } else {
            $sql = $this->conn->prepare("SELECT saving_profiles_id, client_id, book  FROM saving_profiles WHERE status = 1 AND field_id = :feild AND center_id = :center AND period_id = :period");
            $sql->execute([':feild' => $field, ':center' => $center, ':period' => $period]);
        }
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function loanbookLoad($field = null, $center = null, $period = null)
    {
        if ($field == null && $field == null && $period = null) {
            $sql = $this->conn->prepare("SELECT book  FROM loan_profiles WHERE status = 1");
            $sql->execute();
        } else {
            $sql = $this->conn->prepare("SELECT loan_profile_id, client_id, book, balance, total_loan, loan_recover, loan_remaining, total_interest, interest_recover, interest_remaining  FROM loan_profiles WHERE status = 1 AND field_id = :feild AND center_id = :center AND period_id = :period");
            $sql->execute([':feild' => $field, ':center' => $center, ':period' => $period]);
        }
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function clinetSavingsInfoLoad($clientID, $book, $savings_profile)
    {
        // return $savings_profile;
        // die();
        $sql = $this->conn->prepare("SELECT reg.name, sav.deposit_installment, sav.balance, sav.total_without_interest, sav.total_with_interest  FROM client_registers AS reg INNER JOIN saving_profiles AS sav ON reg.client_id = sav.client_id WHERE reg.client_id = :id AND sav.book = :book AND sav.saving_profiles_id = :saving");

        $sql->execute([":id" => $clientID, ":book" => $book, ":saving" => $savings_profile]);

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
        // return $sql->rowCount();
    }

    public function clinetLoanInfoLoad($clientID, $book, $loan_profile)
    {
        // return $savings_profile;
        // die();
        $sql = $this->conn->prepare("SELECT reg.name, lon.savings, lon.loan_installment, lon.interest_installment, lon.balance  FROM client_registers AS reg INNER JOIN  loan_profiles AS lon ON reg.client_id = lon.client_id WHERE reg.client_id = :id AND lon.book = :book AND lon.loan_profile_id = :loan");

        $sql->execute([":id" => $clientID, ":book" => $book, ":loan" => $loan_profile]);

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
        // return $sql->rowCount();
    }

    public function clinetInfoLoad($clientID)
    {
        $sql = $this->conn->prepare("SELECT *  FROM client_registers WHERE status = 1 AND client_id = ? LIMIT 1");
        $sql->execute([$clientID]);

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function loanInfoLoad($clientID, $book, $loanID)
    {
        $sql = $this->conn->prepare("SELECT r.name, l.balance, l.total_loan, l.loan_recover, l.loan_remaining, l.interest_recover, l.interest_remaining, l.total_interest  FROM client_registers AS r INNER JOIN loan_profiles AS l ON r.client_id = l.client_id WHERE l.status = 1 AND r.client_id = :clientID AND l.book = :book AND l.loan_profile_id = :loan LIMIT 1");
        $sql->execute([":clientID" => $clientID, ":book" => $book, ":loan" => $loanID]);

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Period Dataload function
    public function periodsLoad($where = null)
    {
        if ($where == null) {
            $sql = $this->conn->prepare("SELECT * FROM periods WHERE status = 1");
            $sql->execute();
        } else {
            $sql = $this->conn->prepare("SELECT * FROM periods WHERE status = 1 AND period_type LIKE ?");
            $sql->execute([$where]);
        }

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Officers Dataload function
    public function officersLoad($where = null)
    {
        $id = $_SESSION['auth']['user_id'];
        if ($where == null) {
            $sql = $this->conn->prepare("SELECT * FROM users WHERE status = 1");
            $sql->execute();
        } else {
            $sql = $this->conn->prepare("SELECT * FROM users WHERE id != '${id}' AND status = ?");
            $sql->execute([$where]);
        }

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // FDR Clients Load
    public function fdrLoad($status = 1, $id = null)
    {
        $query = "SELECT * FROM fdr_lists";
        if ($status != null) {
            $query .= " WHERE status = '${status}'";
        }
        if ($id != null) {
            if ($status != null) {
                $query .= " AND id = '${id}'";
            } else {
                $query .= " WHERE id = '${id}'";
            }
        }
        $query .= " ORDER BY id DESC";
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

    // Total notification load
    public function bellload($officer_id)
    {
        // return $table;
        // die();
        $sql = $this->conn->prepare("SELECT COUNT(*) AS bell FROM notification WHERE status = '0' AND (to_officer_id = '${officer_id}' OR to_officer_id = '0')");
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Total notification load
    public function notifload($officer_id, $limit = null)
    {
        // return $officer_id;
        // die();
        $query = "SELECT n.id, n.sub, n.details, n.created_at, n.status, u.name FROM notification As n INNER JOIN users AS u ON u.id = n.from_officer_id WHERE (n.to_officer_id = '${officer_id}' OR n.to_officer_id = '0') AND DATE_FORMAT(n.created_at, '%Y-%m-%d') >= (DATE(NOW()) - INTERVAL 30 DAY) ORDER BY n.created_at DESC";
        if ($limit != null) {
            $query .= " LIMIT $limit";
        }
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

    public function sendboxload($officer_id)
    {
        // return $officer_id;
        // die();
        $sql = $this->conn->prepare("SELECT n.id, n.sub, n.details, n.created_at, n.status, u.name FROM notification As n INNER JOIN users AS u ON u.id = n.to_officer_id WHERE n.from_officer_id = '${officer_id}' ORDER BY n.created_at DESC");
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
    // savingsfieldReport load
    public function savingsfieldReport($officer_id = null, $date = null)
    {
        $sql = "SELECT p.period_name, s.period_id, SUM(s.deposit) AS total FROM saving_collections AS s INNER JOIN periods AS p ON p.period_id = s.period_id WHERE s.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND s.officers_id = $officer_id";
        }
        if ($date != null) {
            $sql .= " AND DATE(s.created_at_date) = DATE(CURRENT_DATE())";
        } else {
            $sql .= " AND DATE(s.created_at_date) != DATE(CURRENT_DATE())";
        }
        $sql .= " GROUP BY s.period_id";
        $sql = $this->conn->prepare($sql);
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
    // savingsfieldReport load
    public function loansfieldReport($officer_id = null, $date = null)
    {
        $sql = "SELECT p.period_name, l.period_id, SUM(l.deposit) AS deposit, SUM(l.loan) AS loan, SUM(l.interest) AS interest, SUM(l.total) AS total FROM loan_collections AS l INNER JOIN periods AS p ON p.period_id = l.period_id WHERE l.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND l.officers_id = $officer_id";
        }
        if ($date != null) {
            $sql .= " AND DATE(l.created_at_date) = DATE(CURRENT_DATE())";
        } else {
            $sql .= " AND DATE(l.created_at_date) != DATE(CURRENT_DATE())";
        }
        $sql .= " GROUP BY l.period_id";
        $sql = $this->conn->prepare($sql);
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

    // message load
    public function msgload($id)
    {

        $sql1 = $this->conn->prepare("UPDATE notification SET status='1' WHERE id = '${id}'");
        $sql1->execute();

        $sql = $this->conn->prepare("SELECT n.sub, n.details, n.created_at, u.name FROM notification As n INNER JOIN users AS u ON u.id = n.from_officer_id WHERE n.id = ?");
        $sql->execute([$id]);

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }
    public function sendmsgload($id)
    {
        $sql = $this->conn->prepare("SELECT n.sub, n.details, n.created_at, u.name FROM notification As n INNER JOIN users AS u ON u.id = n.to_officer_id WHERE n.id = ?");
        $sql->execute([$id]);

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    // Loan Collection edit load
    public function editableloaddataload($id)
    {
        $sql = $this->conn->prepare("SELECT l.*, c.name FROM loan_collections As l INNER JOIN client_registers AS c ON c.client_id  = l.client_id WHERE l.collection_id = ?");
        $sql->execute([$id]);

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }
    // savings Collection edit load
    public function editablesavingsdataload($id)
    {
        $sql = $this->conn->prepare("SELECT s.*, c.name FROM saving_collections As s INNER JOIN client_registers AS c ON c.client_id  = s.client_id WHERE s.collection_id = ?");
        $sql->execute([$id]);

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }
    // all officer load
    public function allOfficer($id = null)
    {
        if ($id == null) {
            $query = "SELECT * FROM users";
        } else {
            $query = "SELECT *, 
                    (SELECT COUNT(*) FROM loan_profiles WHERE reg_officer_id = '${id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS loan_giving, 
                    (SELECT SUM(total_loan) FROM loan_profiles WHERE reg_officer_id = '${id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS total_loan, 
                    (SELECT SUM(loan) FROM loan_collections WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS total_loan_collection, 
                    (SELECT SUM(deposit) FROM loan_collections WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS total_loan_saving_collection, 
                    (SELECT SUM(interest) FROM loan_collections WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS total_interest_collection, 
                    (SELECT SUM(withdrawal) FROM saving_withdrawals WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS savings_widthdraw, 
                    (SELECT SUM(withdrawal) FROM loan_savings_withdrawals WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS loan_saving_widthdraw, 
                    (SELECT COUNT(*) FROM saving_withdrawals WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS saving_withdrawals, 
                    (SELECT COUNT(*) FROM loan_savings_withdrawals WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS loan_savings_withdrawals, 
                    (SELECT COUNT(*) FROM saving_profiles WHERE reg_officer_id = '${id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS total_savings,
                    (SELECT SUM(deposit) FROM saving_collections WHERE officers_id = '${id}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS Total_savings_collection 
                    FROM users WHERE id = '${id}'";
        }
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

    // Dashboard Card load
    public function cardsLoad($officer_id = null)
    {
        if ($officer_id == null) {
            $query = "SELECT IFNULL(SUM(deposit),0) AS total_dps_collection, 
                (SELECT IFNULL(SUM(total_loan),0) FROM loan_profiles WHERE status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS total_loan, 
                (SELECT IFNULL(SUM(loan),0) FROM loan_collections WHERE status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS total_loan_collection,
                (SELECT IFNULL(SUM(deposit),0) FROM saving_collections WHERE period_id != '25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS Total_savings_collection 
                FROM saving_collections WHERE period_id = '25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())";
        } else {
            $query = "SELECT IFNULL(SUM(deposit),0) AS total_dps_collection, 
                (SELECT IFNULL(SUM(total_loan),0) FROM loan_profiles WHERE reg_officer_id = '${officer_id}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE())) AS total_loan, 
                (SELECT IFNULL(SUM(loan),0) FROM loan_collections WHERE officers_id = '${officer_id}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS total_loan_collection,
                (SELECT IFNULL(SUM(deposit),0) FROM saving_collections WHERE officers_id = '${officer_id}' AND period_id != '25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())) AS Total_savings_collection 
                FROM saving_collections WHERE officers_id = '${officer_id}' AND period_id = '25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())";
        }
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

    // officer Collection Report load
    public function officerCollectionLoad($query)
    {

        // return $sql;
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
    // withdrawal load
    public function dashboardWithdrawalLoad($query)
    {

        // return $sql;
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
}
