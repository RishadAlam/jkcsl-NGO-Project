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

    // Savings Khelapi Field
    public function savingskhelapiReport()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $weekDate = date('Y-m-d', strtotime('-8 days'));
        $halfmonth = date('Y-m-d', strtotime('-16 days'));
        $month = date('Y-m-d', strtotime('-32 days'));
        $savings = [];

        $periods_sql = "SELECT period_id, period_name, period FROM periods WHERE status = '1' AND period_type LIKE '%1%'";
        $periods_query = $this->conn->prepare($periods_sql);
        $periods_query->execute();
        $periods = $periods_query->fetchALL(PDO::FETCH_ASSOC);

        foreach ($periods as $keys => $period) {
            if ($period['period'] == '1') {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT saving_profiles_id FROM `saving_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_savings as $saving) {
                    $savingId = $saving['saving_profiles_id'];
                    $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${yesterday}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $savings[$keys]['period_id'] = $id;
                $savings[$keys]['period_days'] = $period['period'];
                $savings[$keys]['period_name'] = $period['period_name'];
                $savings[$keys]['total'] = sizeof($total);
            } elseif ($period['period'] == '7') {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT saving_profiles_id FROM `saving_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_savings as $saving) {
                    $savingId = $saving['saving_profiles_id'];
                    $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${weekDate}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $savings[$keys]['period_id'] = $id;
                $savings[$keys]['period_days'] = $period['period'];
                $savings[$keys]['period_name'] = $period['period_name'];
                $savings[$keys]['total'] = sizeof($total);
            } elseif ($period['period'] == '15') {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT saving_profiles_id FROM `saving_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_savings as $saving) {
                    $savingId = $saving['saving_profiles_id'];
                    $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${halfmonth}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $savings[$keys]['period_id'] = $id;
                $savings[$keys]['period_days'] = $period['period'];
                $savings[$keys]['period_name'] = $period['period_name'];
                $savings[$keys]['total'] = sizeof($total);
            } else {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT saving_profiles_id FROM `saving_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_savings as $saving) {
                    $savingId = $saving['saving_profiles_id'];
                    $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${month}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $savings[$keys]['period_id'] = $id;
                $savings[$keys]['period_days'] = $period['period'];
                $savings[$keys]['period_name'] = $period['period_name'];
                $savings[$keys]['total'] = sizeof($total);
            }
        }
        return $savings;
    }

    // Loan Khelapi Field
    public function loanskhelapiReport()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $weekDate = date('Y-m-d', strtotime('-8 days'));
        $halfmonth = date('Y-m-d', strtotime('-16 days'));
        $month = date('Y-m-d', strtotime('-32 days'));
        $loans = [];

        $periods_sql = "SELECT period_id, period_name, period FROM periods WHERE status = '1' AND period_type LIKE '%2%'";
        $periods_query = $this->conn->prepare($periods_sql);
        $periods_query->execute();
        $periods = $periods_query->fetchALL(PDO::FETCH_ASSOC);

        foreach ($periods as $keys => $period) {
            if ($period['period'] == '1') {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT loan_profile_id FROM `loan_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_loan as $loan) {
                    $loanId = $loan['loan_profile_id'];
                    $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${yesterday}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $loans[$keys]['period_id'] = $id;
                $loans[$keys]['period_days'] = $period['period'];
                $loans[$keys]['period_name'] = $period['period_name'];
                $loans[$keys]['total'] = sizeof($total);
            } elseif ($period['period'] == '7') {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT loan_profile_id FROM `loan_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_loan as $loan) {
                    $loanId = $loan['loan_profile_id'];
                    $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${weekDate}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $loans[$keys]['period_id'] = $id;
                $loans[$keys]['period_days'] = $period['period'];
                $loans[$keys]['period_name'] = $period['period_name'];
                $loans[$keys]['total'] = sizeof($total);
            } elseif ($period['period'] == '15') {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT loan_profile_id FROM `loan_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_loan as $loan) {
                    $loanId = $loan['loan_profile_id'];
                    $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${halfmonth}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $loans[$keys]['period_id'] = $id;
                $loans[$keys]['period_days'] = $period['period'];
                $loans[$keys]['period_name'] = $period['period_name'];
                $loans[$keys]['total'] = sizeof($total);
            } else {
                $id = $period['period_id'];
                $total = [];

                $ids_sql = "SELECT loan_profile_id FROM `loan_profiles` WHERE status != '0' AND period_id ='${id}'";
                $ids_query = $this->conn->prepare($ids_sql);
                $ids_query->execute();
                $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

                foreach ($total_loan as $loan) {
                    $loanId = $loan['loan_profile_id'];
                    $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${month}' AND '${today}'";
                    $sql = $this->conn->prepare($query);
                    $sql->execute();

                    if ($sql->rowCount() === 0) {
                        $total[] = $id;
                    }
                }

                $loans[$keys]['period_id'] = $id;
                $loans[$keys]['period_days'] = $period['period'];
                $loans[$keys]['period_name'] = $period['period_name'];
                $loans[$keys]['total'] = sizeof($total);
            }
        }
        return $loans;
    }

    //khelapi saving report
    public function savingKhelapiReport($id, $days)
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $weekDate = date('Y-m-d', strtotime('-8 days'));
        $halfmonth = date('Y-m-d', strtotime('-16 days'));
        $month = date('Y-m-d', strtotime('-32 days'));

        if ($days == '1') {
            $total = [];

            $ids_sql = "SELECT saving_profiles_id FROM saving_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_savings as $saving) {
                $savingId = $saving['saving_profiles_id'];
                $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${yesterday}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $savingId;
                }
            }
        } elseif ($days == '7') {
            $total = [];

            $ids_sql = "SELECT saving_profiles_id FROM saving_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_savings as $saving) {
                $savingId = $saving['saving_profiles_id'];
                $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${weekDate}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $savingId;
                }
            }
        } elseif ($days == '15') {
            $total = [];

            $ids_sql = "SELECT saving_profiles_id FROM saving_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_savings as $saving) {
                $savingId = $saving['saving_profiles_id'];
                $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${halfmonth}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $savingId;
                }
            }
        } else {
            $total = [];

            $ids_sql = "SELECT saving_profiles_id FROM saving_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_savings = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_savings as $saving) {
                $savingId = $saving['saving_profiles_id'];
                $query = "SELECT collection_id FROM saving_collections WHERE savings_prof_id = '${savingId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${month}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $savingId;
                }
            }
        }

        $savingIDS = implode(',', $total);
        $saving_sql = "SELECT reg.name, feild.field_name, center.center_name, period.period_name, savings.saving_profiles_id, savings.field_id, savings.center_id, reg.client_id, savings.book, savings.balance FROM saving_profiles AS savings INNER JOIN client_registers AS reg ON reg.client_id = savings.client_id INNER JOIN feilds AS feild ON feild.feild_id = savings.field_id INNER JOIN centers AS center ON center.center_id = savings.center_id INNER JOIN periods AS period ON period.period_id = savings.period_id WHERE saving_profiles_id IN (${savingIDS})";
        $saving_query = $this->conn->prepare($saving_sql);
        $saving_query->execute();
        $total_savings = $saving_query->fetchALL(PDO::FETCH_ASSOC);
        return $total_savings;
    }

    //khelapi Loan report
    public function loanKhelapiReport($id, $days)
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $weekDate = date('Y-m-d', strtotime('-8 days'));
        $halfmonth = date('Y-m-d', strtotime('-16 days'));
        $month = date('Y-m-d', strtotime('-32 days'));

        if ($days == '1') {
            $total = [];

            $ids_sql = "SELECT loan_profile_id FROM loan_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_loan as $loan) {
                $loanId = $loan['loan_profile_id'];
                $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${yesterday}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $loanId;
                }
            }
        } elseif ($days == '7') {
            $total = [];

            $ids_sql = "SELECT loan_profile_id FROM loan_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_loan as $loan) {
                $loanId = $loan['loan_profile_id'];
                $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${weekDate}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $loanId;
                }
            }
        } elseif ($days == '15') {
            $total = [];

            $ids_sql = "SELECT loan_profile_id FROM loan_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_loan as $loan) {
                $loanId = $loan['loan_profile_id'];
                $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${halfmonth}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $loanId;
                }
            }
        } else {
            $total = [];

            $ids_sql = "SELECT loan_profile_id FROM loan_profiles WHERE status != '0' AND period_id ='${id}'";
            $ids_query = $this->conn->prepare($ids_sql);
            $ids_query->execute();
            $total_loan = $ids_query->fetchALL(PDO::FETCH_ASSOC);

            foreach ($total_loan as $loan) {
                $loanId = $loan['loan_profile_id'];
                $query = "SELECT collection_id FROM loan_collections WHERE loan_prof_id = '${loanId}' AND status != '0' AND DATE(created_at_date) BETWEEN '${month}' AND '${today}'";
                $sql = $this->conn->prepare($query);
                $sql->execute();

                if ($sql->rowCount() === 0) {
                    $total[] = $loanId;
                }
            }
        }

        $loanIDS = implode(',', $total);
        $loan_sql = "SELECT reg.name, feild.field_name, center.center_name, period.period_name, loan.loan_profile_id, loan.field_id, loan.center_id, reg.client_id, loan.book, loan.balance, loan.total_loan, loan.loan_remaining, loan.interest_remaining FROM loan_profiles AS loan INNER JOIN client_registers AS reg ON reg.client_id = loan.client_id INNER JOIN feilds AS feild ON feild.feild_id = loan.field_id INNER JOIN centers AS center ON center.center_id = loan.center_id INNER JOIN periods AS period ON period.period_id = loan.period_id WHERE loan_profile_id IN (${loanIDS})";
        $loan_query = $this->conn->prepare($loan_sql);
        $loan_query->execute();
        $total_loan = $loan_query->fetchALL(PDO::FETCH_ASSOC);
        return $total_loan;
    }
}
