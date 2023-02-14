<?php

namespace controller\ProfileSTMUpdate;

use PDO;
use config\Database\Database;

include_once "../config/app.php";

class ProfileSTMController
{
    public $db, $conn, $db_name;
    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->link;
        $this->db_name = $this->db->dbName;
    }

    // savings Collection edit load
    public function editsavingsColelction($id)
    {
        $sql = $this->conn->prepare("SELECT s.*, c.name, sp.total_deposit, sp.balance, sp.saving_profiles_id FROM saving_collections As s INNER JOIN client_registers AS c ON c.client_id  = s.client_id INNER JOIN saving_profiles AS sp ON sp.saving_profiles_id = s.savings_prof_id WHERE s.collection_id = ?");
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

    // Saving Collection Update
    public function savingCollectionUpdate($id, $saving_profiles_id, $total_deposit, $deposit, $expression)
    {
        $this->conn->beginTransaction();

        $query = "UPDATE saving_profiles SET total_deposit= '${total_deposit}', balance= total_deposit - total_withdrawal WHERE saving_profiles_id = '${saving_profiles_id}'";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $this->conn->prepare("UPDATE saving_collections SET deposit= :deposit, expression= :expression WHERE collection_id = :id");
            $sql->execute([":deposit" => $deposit, ":expression" => $expression, ":id" => $id]);

            if (
                $sql->rowCount() > 0
            ) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollBack();
                return false;
            }
        } else {
            $this->conn->rollBack();
            return false;
        }
    }

    // Delete Savings Collection
    public function deleteSavingsCollection($id)
    {
        $this->conn->beginTransaction();

        $query = "SELECT collection_id, deposit, savings_prof_id FROM saving_collections WHERE collection_id = '${id}' LIMIT 1";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $saving_profiles_id = $row['savings_prof_id'];
                $deposit = $row['deposit'];

                $query = "UPDATE saving_profiles SET total_deposit= total_deposit - '${deposit}', balance= total_deposit - total_withdrawal WHERE saving_profiles_id = '${saving_profiles_id}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() > 0) {
                    $query = "DELETE FROM saving_collections WHERE collection_id = '${id}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;
                    } else {
                        $this->conn->rollBack();
                        return false;
                    }
                } else {
                    $this->conn->rollBack();
                    return false;
                }
            }
        } else {
            $this->conn->rollBack();
            return false;
        }
    }
    
    // Loan Collection edit load
    public function editLoanCollection($id)
    {
        $sql = $this->conn->prepare("SELECT l.*, c.name, lp.total_deposit, lp.balance, lp.loan_recover, lp.interest_recover FROM loan_collections As l INNER JOIN client_registers AS c ON c.client_id  = l.client_id INNER JOIN loan_profiles AS lp ON lp.loan_profile_id = l.loan_prof_id WHERE l.collection_id = ?");
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

    public function loanCollectionUpdate($id, $loan_profile_id, $total_deposit, $loanRec, $interestrec, $deposit, $loan, $interest, $total, $expression)
    {
        $this->conn->beginTransaction();

        $query = "UPDATE loan_profiles SET total_deposit= '${total_deposit}', balance= total_deposit - total_withdrawal, loan_recover= '${loanRec}', loan_remaining= total_loan - loan_recover, interest_recover= '${interestrec}', interest_remaining=  total_interest - interest_recover  WHERE loan_profile_id = '${loan_profile_id}'";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $this->conn->prepare("UPDATE loan_collections SET deposit= :deposit, loan= :loan, interest= :interest, total= :total, expression= :expression WHERE collection_id = :id");
            $sql->execute([":deposit" => $deposit, ":loan" => $loan, ":interest" => $interest, ":total" => $total, ":expression" => $expression, ":id" => $id]);

            if (
                $sql->rowCount() > 0
            ) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollBack();
                return false;
            }
        } else {
            $this->conn->rollBack();
            return false;
        }
    }

    // Delete Savings Collection
    public function deleteLoanCollection($id)
    {
        $this->conn->beginTransaction();

        $query = "SELECT collection_id, deposit, loan, interest, loan_prof_id FROM loan_collections WHERE collection_id = '${id}' LIMIT 1";
        $sql = $this->conn->prepare($query);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $loan_prof_id = $row['loan_prof_id'];
                $deposit = $row['deposit'];
                $loan = $row['loan'];
                $interest = $row['interest'];

                $query = "UPDATE loan_profiles SET total_deposit= total_deposit - '${deposit}', balance= total_deposit - total_withdrawal, loan_recover= loan_recover - '${loan}', loan_remaining= total_loan - loan_recover, interest_recover= interest_recover - '${interest}', interest_remaining=  total_interest - interest_recover WHERE loan_profile_id = '${loan_prof_id}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() > 0) {
                    $query = "DELETE FROM loan_collections WHERE collection_id = '${id}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;
                    } else {
                        $this->conn->rollBack();
                        return false;
                    }
                } else {
                    $this->conn->rollBack();
                    return false;
                }
            }
        } else {
            $this->conn->rollBack();
            return false;
        }
    }
}
