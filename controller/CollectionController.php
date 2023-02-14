<?php

namespace controller\CollectionController\CollectionController;

use PDO;
use config\Database\Database;

include_once "../config/app.php";
// include_once "../config/database.php";

class CollectionController
{
    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->link;
        $this->db_name = $this->db->dbName;
    }

    public function savingsCollection($clientID, $savings_profile_id, $feild_id, $center_id, $period_id, $book, $deposit, $expression, $officers_id)
    {
        $sql = $this->conn->prepare("INSERT INTO saving_collections (client_id, savings_prof_id, feild_id, center_id, period_id, book, deposit, expression, officers_id) VALUES (:client_id, :savings_prof_id, :feild_id, :center_id, :period_id, :book, :deposit, :expression, :officers_id)");

        $sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book, ":deposit" => $deposit, ":expression" => $expression, ":officers_id" => $officers_id]);

        $insertID = $this->conn->lastInsertId();
        if ($insertID > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function loanCollection($clientID, $loan_profile_id, $feild_id, $center_id, $period_id, $book, $deposit, $loan, $interest, $total, $expression, $officers_id)
    {
        $sql = $this->conn->prepare("INSERT INTO loan_collections (client_id, loan_prof_id, feild_id, center_id, period_id, book, deposit, loan, interest, total, expression, officers_id) VALUES (:client_id, :loan_prof_id, :feild_id, :center_id, :period_id, :book, :deposit, :loan, :interest, :total, :expression, :officers_id)");

        $sql->execute([":client_id" => $clientID, ":loan_prof_id" => $loan_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book, ":deposit" => $deposit, ":loan" => $loan, ":interest" => $interest, ":total" => $total, ":expression" => $expression, ":officers_id" => $officers_id]);

        $insertID = $this->conn->lastInsertId();
        if ($insertID > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function savingswithdrawal($clientID, $savings_profile_id, $feild_id, $center_id, $period_id, $book, $withdraw, $balance_remaining, $expression, $officers_id)
    {
        $sql = $this->conn->prepare("SELECT created_at FROM saving_withdrawals WHERE client_id = :client_id AND savings_prof_id = :savings_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book ORDER BY created_at DESC LIMIT 1");

        if ($sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book])) {
            if ($sql->rowCount() > 0) {
                $result = $sql->fetchALL(PDO::FETCH_ASSOC);
                $last_withdraw = date_create($result[0]["created_at"]);
                $today = date_create(date("Y-m-d"));
                $diff = date_diff($last_withdraw, $today);
                $interval = $diff->format("%a");
            }
            if ($sql->rowCount() === 0 || $interval > 30) {
                $sql = $this->conn->prepare("INSERT INTO saving_withdrawals (client_id, savings_prof_id, feild_id, center_id, period_id, book, withdrawal, balance_remaining, expression, officers_id) VALUES (:client_id, :savings_prof_id, :feild_id, :center_id, :period_id, :book, :withdrawal, :balance_remaining, :expression, :officers_id)");

                $sql->execute([":client_id" => $clientID, ":savings_prof_id" => $savings_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book, ":withdrawal" => $withdraw, ":balance_remaining" => $balance_remaining, ":expression" => $expression, ":officers_id" => $officers_id]);

                $insertID = $this->conn->lastInsertId();
                if ($insertID > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return "26days not over";
            }
        } else {
            return false;
        }
    }


    public function loanSavingswithdrawal($clientID, $loan_profile_id, $feild_id, $center_id, $period_id, $book, $withdraw, $balance_remaining, $expression, $officers_id)
    {
        $sql = $this->conn->prepare("SELECT created_at FROM loan_savings_withdrawals WHERE client_id = :client_id AND loan_prof_id = :loan_prof_id AND feild_id = :feild_id AND center_id = :center_id AND period_id = :period_id AND book = :book ORDER BY created_at DESC LIMIT 1");

        if ($sql->execute([":client_id" => $clientID, ":loan_prof_id" => $loan_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book])) {
            if ($sql->rowCount() > 0) {
                $result = $sql->fetchALL(PDO::FETCH_ASSOC);
                $last_withdraw = date_create($result[0]["created_at"]);
                $today = date_create(date("Y-m-d"));
                $diff = date_diff($last_withdraw, $today);
                $interval = $diff->format("%a");
            }

            if ($sql->rowCount() === 0 || $interval > 30) {
                $sql = $this->conn->prepare("INSERT INTO loan_savings_withdrawals (client_id, loan_prof_id, feild_id, center_id, period_id, book, withdrawal, balance_remaining, expression, officers_id) VALUES (:client_id, :loan_prof_id, :feild_id, :center_id, :period_id, :book, :withdrawal, :balance_remaining, :expression, :officers_id)");

                if ($sql->execute([":client_id" => $clientID, ":loan_prof_id" => $loan_profile_id, ":feild_id" => $feild_id, ":center_id" => $center_id, ":period_id" => $period_id, ":book" => $book, ":withdrawal" => $withdraw, ":balance_remaining" => $balance_remaining, ":expression" => $expression, ":officers_id" => $officers_id])) {

                    $insertID = $this->conn->lastInsertId();
                    if ($insertID > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return "26days not over";
            }
        } else {
            return false;
        }
    }

    //Loan Collection edit 
    public function loanedit($id, $deposit, $loan, $interest, $total, $details)
    {
        $sql = $this->conn->prepare("UPDATE loan_collections SET deposit=:deposit,loan=:loan,interest=:interest,total=:total,expression=:expression WHERE collection_id = :id");
        $sql->execute([":deposit" => $deposit, ":loan" => $loan, ":interest" => $interest, ":total" => $total, ":expression" => $details, ":id" => $id]);

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }
    //Savings Collection edit 
    public function savingsedit($id, $deposit, $expression)
    {
        $sql = $this->conn->prepare("UPDATE saving_collections SET deposit= :deposit, expression= :expression WHERE collection_id = :id");
        $sql->execute([":deposit" => $deposit, ":expression" => $expression, ":id" => $id]);

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    //Collection Delete 
    public function deleteCollection($table, $id)
    {
        $sql = $this->conn->prepare("DELETE FROM ${table} WHERE collection_id = ?");
        $sql->execute([$id]);

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    //Withdrawal Delete 
    public function deleteWithdrawal($table, $id)
    {
        $sql = $this->conn->prepare("DELETE FROM ${table} WHERE withdraw_id = ?");
        $sql->execute([$id]);

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    //Approved Loan Collection
    public function apprvLoanCollection($id)
    {
        $this->conn->beginTransaction();

        $id = implode("','", $id);
        $query = "SELECT l.loan_profile_id, c.loan_prof_id, c.deposit, c.loan, c.interest, c.collection_id FROM loan_profiles AS l INNER JOIN loan_collections AS c ON c.loan_prof_id = l.loan_profile_id WHERE c.collection_id IN ('${id}')";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $loan_profile_id = $row['loan_profile_id'];
                $deposit = $row['deposit'];
                $loan = $row['loan'];
                $interest = $row['interest'];
                $collection_id = $row['collection_id'];

                $query = "UPDATE loan_profiles SET total_deposit= total_deposit + '${deposit}', balance= total_deposit - total_withdrawal,loan_recover= loan_recover + '${loan}' ,loan_remaining= loan_remaining - '${loan}',interest_recover= interest_recover + '${interest}',interest_remaining= interest_remaining - '${interest}', collection_ids= CONCAT( collection_ids, ', ', '${collection_id}') WHERE loan_profile_id = '${loan_profile_id}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();
            }
            // return $query;
            // die();
            if (
                $sql->rowCount() > 0
            ) {
                $query = "UPDATE loan_collections SET status = '1' WHERE collection_id IN ('${id}')";
                $sql = $this->conn->prepare($query);

                if ($sql->execute()) {
                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;
                    } else {
                        $this->conn->rollBack();
                        return false;
                    }
                }
            } else {
                $this->conn->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }

    //Approved Savings Collection
    public function apprvsavingsCollection($id)
    {
        $this->conn->beginTransaction();

        $id = implode("','", $id);
        $query = "SELECT s.saving_profiles_id, c.deposit, c.collection_id FROM saving_profiles AS s INNER JOIN saving_collections AS c ON c.savings_prof_id = s.saving_profiles_id WHERE c.collection_id IN ('${id}')";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $saving_profiles_id = $row['saving_profiles_id'];
                $deposit = $row['deposit'];
                $collection_id = $row['collection_id'];

                $query = "UPDATE saving_profiles SET total_deposit= total_deposit + '${deposit}', balance= total_deposit - total_withdrawal,collection_ids= CONCAT( collection_ids, ', ', '${collection_id}') WHERE saving_profiles_id = '${saving_profiles_id}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();
            }
            // return $query;
            // die();
            if (
                $sql->rowCount() > 0
            ) {
                $query = "UPDATE saving_collections SET status = '1' WHERE collection_id IN ('${id}')";
                $sql = $this->conn->prepare($query);

                if ($sql->execute()) {
                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;
                    } else {
                        $this->conn->rollBack();
                        return false;
                    }
                }
            } else {
                $this->conn->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }

    // Dashboard savings Collection Report load
    public function dashboardsavingsCollecReportload($officer_id = null)
    {
        $sql = "SELECT s.collection_id, s.book, s.deposit, s.expression, f.field_name, cn.center_name, p.period_name, c.name AS client_name, u.name AS officer_name, s.created_at_time, s.created_at_date FROM saving_collections AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN users AS u ON u.id = s.officers_id INNER JOIN feilds AS f ON f.feild_id = s.feild_id INNER JOIN centers AS cn ON cn.center_id = s.center_id INNER JOIN periods AS p ON p.period_id = s.period_id WHERE DATE(s.created_at_date) = DATE(CURRENT_DATE())";
        if ($officer_id != null) {
            $sql .= " AND s.officers_id = '${officer_id}'";
        }

        $sql .= " ORDER BY s.collection_id DESC";
        // return $sql;
        // die();
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

    // Dashboard loan Collection Report load
    public function dashboardloanCollecReportload($officer_id = null)
    {
        $sql = "SELECT l.collection_id, l.book, l.deposit, l.loan, l.interest, l.total, l.expression, f.field_name, cn.center_name, p.period_name, c.name AS client_name, u.name AS officer_name, l.created_at_time, l.created_at_date FROM loan_collections AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN users AS u ON u.id = l.officers_id INNER JOIN feilds AS f ON f.feild_id = l.feild_id INNER JOIN centers AS cn ON cn.center_id = l.center_id INNER JOIN periods AS p ON p.period_id = l.period_id WHERE DATE(l.created_at_date) = DATE(CURRENT_DATE())";
        if ($officer_id != null) {
            $sql .= " AND l.officers_id = '${officer_id}'";
        }

        $sql .= " ORDER BY l.collection_id DESC";

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

    // savings Collection Report load
    public function savingsCollecReportload($period = null, $officer_id = null, $tamadi = null, $from = null, $end = null)
    {
        $sql = "SELECT s.collection_id, s.book, s.deposit, s.expression, f.field_name, cn.center_name, p.period_name, c.name AS client_name, u.name AS officer_name, s.created_at_time, s.created_at_date FROM saving_collections AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN users AS u ON u.id = s.officers_id INNER JOIN feilds AS f ON f.feild_id = s.feild_id INNER JOIN centers AS cn ON cn.center_id = s.center_id INNER JOIN periods AS p ON p.period_id = s.period_id WHERE s.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND s.officers_id = '${officer_id}'";
        }
        if ($period != null) {
            $sql .= " AND s.period_id = '${period}'";
        }
        if ($from != null && $end != null) {
            $sql .= " AND DATE(s.created_at_date) BETWEEN '${from}' AND '${end}'";
        }
        if ($tamadi != null) {
            $sql .= " AND DATE(s.created_at_date) != DATE(CURRENT_DATE())";
        } else {
            $sql .= " AND DATE(s.created_at_date) = DATE(CURRENT_DATE())";
        }
        $sql .= " ORDER BY s.collection_id DESC";
        // return $sql;
        // die();
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


    // loan Collection Report load
    public function loanCollecReportload($period = null, $officer_id = null, $tamadi = null, $from = null, $end = null)
    {
        $sql = "SELECT l.collection_id, l.book, l.deposit, l.loan, l.interest, l.total, l.expression, f.field_name, cn.center_name, p.period_name, c.name AS client_name, u.name AS officer_name, l.created_at_time, l.created_at_date FROM loan_collections AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN users AS u ON u.id = l.officers_id INNER JOIN feilds AS f ON f.feild_id = l.feild_id INNER JOIN centers AS cn ON cn.center_id = l.center_id INNER JOIN periods AS p ON p.period_id = l.period_id  WHERE l.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND l.officers_id = '${officer_id}'";
        }
        if ($period != null) {
            $sql .= "  AND l.period_id = '${period}'";
        }
        if ($from != null && $end != null) {
            $sql .= " AND DATE(l.created_at_date) BETWEEN '${from}' AND '${end}'";
        }
        if ($tamadi != null) {
            $sql .= " AND DATE(l.created_at_date) != DATE(CURRENT_DATE())";
        } else {
            $sql .= " AND DATE(l.created_at_date) = DATE(CURRENT_DATE())";
        }
        $sql .= " ORDER BY l.collection_id DESC";

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

    // savings Collection Record load
    public function savingsCollecRecordload($query)
    {
        $sql = $query;

        // return $officer_id;
        // die();
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

    // savings Collection Record load
    public function incomeExpanceRecordload($query)
    {
        $sql = $query;

        // return $officer_id;
        // die();
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

    // savings withdrawal load
    public function savingsWithdrawalReport($officer_id = null)
    {
        $sql = "SELECT p.period_name, sw.period_id, SUM(sw.withdrawal) AS total FROM saving_withdrawals AS sw INNER JOIN periods AS p ON p.period_id = sw.period_id WHERE sw.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND sw.officers_id = $officer_id";
        }
        $sql .= " GROUP BY sw.period_id";
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

    // Loan withdrawal load
    public function loansWithdrawalReport($officer_id = null)
    {
        $sql = "SELECT p.period_name, lw.period_id, SUM(lw.withdrawal) AS withdrawal FROM loan_savings_withdrawals AS lw INNER JOIN periods AS p ON p.period_id = lw.period_id WHERE lw.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND lw.officers_id = '${officer_id}}'";
        }
        $sql .= " GROUP BY lw.period_id";
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

    // savings withdrawal Report load
    public function savingsCollecWithdReportload($period = null, $officer_id = null)
    {
        $sql = "SELECT sw.withdraw_id, sw.book, sw.withdrawal, sw.balance_remaining, sw.expression, f.field_name, cn.center_name, c.name AS client_name, u.name AS officer_name, sw.created_at FROM saving_withdrawals AS sw INNER JOIN client_registers AS c ON sw.client_id = c.client_id INNER JOIN users AS u ON u.id = sw.officers_id INNER JOIN feilds AS f ON f.feild_id = sw.feild_id INNER JOIN centers AS cn ON cn.center_id = sw.center_id WHERE sw.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND sw.officers_id = '${officer_id}'";
        }
        if ($period != null) {
            $sql .= " AND sw.period_id = '${period}'";
        }

        $sql .= " ORDER BY sw.withdraw_id DESC";
        // return $sql;
        // die();
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

    // savings Collection edit load
    public function editableSavingsWithdload($id)
    {
        $sql = $this->conn->prepare("SELECT sw.*, c.name FROM saving_withdrawals As sw INNER JOIN client_registers AS c ON c.client_id  = sw.client_id WHERE sw.withdraw_id = ?");
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

    //Savings Withdraw Collection edit 
    public function savingsWithdedit($id, $withdraw, $total, $expression)
    {
        $sql = $this->conn->prepare("UPDATE saving_withdrawals SET withdrawal= :withdrawal, balance_remaining = :total, expression= :expression WHERE withdraw_id  = :id");
        $sql->execute([":withdrawal" => $withdraw, ":total" => $total, ":expression" => $expression, ":id" => $id]);

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    //Approved Savings Collection
    public function apprvsavingsWithdrawal($id)
    {
        $this->conn->beginTransaction();

        $id = implode("','", $id);
        $query = "SELECT s.saving_profiles_id, sw.withdrawal, sw.withdraw_id  FROM saving_profiles AS s INNER JOIN saving_withdrawals AS sw ON sw.savings_prof_id = s.saving_profiles_id WHERE sw.withdraw_id  IN ('${id}')";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $saving_profiles_id = $row['saving_profiles_id'];
                $withdrawal = $row['withdrawal'];
                $withdraw_id = $row['withdraw_id'];

                $query = "UPDATE saving_profiles SET total_withdrawal= total_withdrawal + '${withdrawal}', balance= total_deposit - total_withdrawal, withdraw_ids= CONCAT(withdraw_ids, '${withdraw_id}', ', ') WHERE saving_profiles_id = '${saving_profiles_id}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();
            }
            // return $query;
            // die();
            if (
                $sql->rowCount() > 0
            ) {
                $query = "UPDATE saving_withdrawals SET status = '1' WHERE withdraw_id IN ('${id}')";
                $sql = $this->conn->prepare($query);

                if ($sql->execute()) {
                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;
                    } else {
                        $this->conn->rollBack();
                        return false;
                    }
                }
            } else {
                $this->conn->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }

    // loan withdrawal Report load
    public function loanCollecWithdReportload($period = null, $officer_id = null)
    {
        $sql = "SELECT lw.withdraw_id, lw.book, lw.withdrawal, lw.balance_remaining, lw.expression, f.field_name, cn.center_name, c.name AS client_name, u.name AS officer_name, lw.created_at FROM loan_savings_withdrawals AS lw INNER JOIN client_registers AS c ON lw.client_id = c.client_id INNER JOIN users AS u ON u.id = lw.officers_id INNER JOIN feilds AS f ON f.feild_id = lw.feild_id INNER JOIN centers AS cn ON cn.center_id = lw.center_id WHERE lw.status = '2'";
        if ($officer_id != null) {
            $sql .= " AND lw.officers_id = '${officer_id}'";
        }
        if ($period != null) {
            $sql .= " AND lw.period_id = '${period}'";
        }

        $sql .= " ORDER BY lw.withdraw_id DESC";
        // return $sql;
        // die();
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

    // savings Collection edit load
    public function editableloanWithdload($id)
    {
        $sql = $this->conn->prepare("SELECT lw.*, c.name FROM loan_savings_withdrawals As lw INNER JOIN client_registers AS c ON c.client_id  = lw.client_id WHERE lw.withdraw_id = ?");
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

    //Savings Withdraw Collection edit 
    public function loanWithdedit($id, $withdraw, $total, $expression)
    {
        $sql = $this->conn->prepare("UPDATE loan_savings_withdrawals SET withdrawal= :withdrawal, balance_remaining = :total, expression= :expression WHERE withdraw_id  = :id");
        $sql->execute([":withdrawal" => $withdraw, ":total" => $total, ":expression" => $expression, ":id" => $id]);

        if (
            $sql->rowCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    //Approved Savings Collection
    public function apprvLoanWithdrawal($id)
    {
        $this->conn->beginTransaction();

        $id = implode("','", $id);
        $query = "SELECT l.loan_profile_id , lw.withdrawal, lw.withdraw_id  FROM loan_profiles AS l INNER JOIN loan_savings_withdrawals AS lw ON lw.loan_prof_id = l.loan_profile_id WHERE lw.withdraw_id  IN ('${id}')";

        $sql = $this->conn->prepare($query);
        $sql->execute();

        if (
            $sql->rowCount() > 0
        ) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $loan_profile_id = $row['loan_profile_id'];
                $withdrawal = $row['withdrawal'];
                $withdraw_id = $row['withdraw_id'];

                $query = "UPDATE loan_profiles SET total_withdrawal= total_withdrawal + '${withdrawal}', balance= total_deposit - total_withdrawal, withdraw_ids= CONCAT(withdraw_ids, '${withdraw_id}', ', ') WHERE loan_profile_id = '${loan_profile_id}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();
            }
            // return $query;
            // die();
            if (
                $sql->rowCount() > 0
            ) {
                $query = "UPDATE loan_savings_withdrawals SET status = '1' WHERE withdraw_id IN ('${id}')";
                $sql = $this->conn->prepare($query);

                if ($sql->execute()) {
                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;
                    } else {
                        $this->conn->rollBack();
                        return false;
                    }
                }
            } else {
                $this->conn->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }
}
