<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

// Client Savings STM Profile Load
if (isset($_POST['clientProfileSTM']) && isset($_POST['clientID']) && isset($_POST['savingsID']) && $_POST['clientProfileSTM'] == 1) {
    $clientID = $_POST['clientID'];
    $savingsID = $_POST['savingsID'];

    $query = "SELECT s.*, c.name, c.client_img, c.client_mobile_1, f.field_name, cn.center_name, p.period_name,
    (SELECT COUNT(*) FROM saving_collections WHERE savings_prof_id = '${savingsID}' AND status != '2') AS totalInstrallment,
    (SELECT COUNT(*) FROM saving_withdrawals WHERE savings_prof_id = '${savingsID}' AND status != '2') AS totalwithdrawal
     FROM saving_profiles AS s INNER JOIN periods AS p ON p.period_id = s.period_id INNER JOIN feilds AS f ON f.feild_id  = s.field_id INNER JOIN centers AS cn ON cn.center_id  = s.center_id INNER JOIN client_registers AS c ON c.client_id  = s.client_id WHERE s.saving_profiles_id  = '${savingsID}'";

    $result = $fields->clientAccLoad($query);
    if ($result != false) {
        echo json_encode($result);
        // print_r($result);
    } else {
        echo json_encode(false);
    }
}
// Client Loan STM Profile Load
if (isset($_POST['clientProfileSTM']) && isset($_POST['clientID']) && isset($_POST['loansID']) && $_POST['clientProfileSTM'] == 1) {
    $clientID = $_POST['clientID'];
    $loansID = $_POST['loansID'];

    $query = "SELECT l.*, c.name, c.client_img, c.client_mobile_1, f.field_name, cn.center_name, p.period_name,
    (SELECT COUNT(*) FROM loan_collections WHERE loan_prof_id = '${loansID}' AND status != '2') AS recoverInstrallment,
    (SELECT COUNT(*) FROM loan_savings_withdrawals WHERE loan_prof_id = '${loansID}' AND status != '2') AS totalwithdrawal
     FROM loan_profiles AS l INNER JOIN periods AS p ON p.period_id = l.period_id INNER JOIN feilds AS f ON f.feild_id  = l.field_id INNER JOIN centers AS cn ON cn.center_id  = l.center_id INNER JOIN client_registers AS c ON c.client_id  = l.client_id WHERE l.loan_profile_id   = '${loansID}'";

    $result = $fields->clientAccLoad($query);
    if ($result != false) {
        echo json_encode($result);
        // print_r($result);
    } else {
        echo json_encode(false);
    }
}

// Client Chart Profile Load
if (isset($_POST['clientProfileChartLoad']) && isset($_POST['clientID']) && isset($_POST['savingsID']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && $_POST['clientProfileChartLoad'] == 1) {
    $clientID = $_POST['clientID'];
    $savingsID = $_POST['savingsID'];
    $fieldID = $_POST['fieldID'];
    $centerID = $_POST['centerID'];

    $query = "SELECT date, SUM(deposit) AS deposit, SUM(withdrawal) AS withdrawal FROM (
                SELECT deposit, 0 withdrawal,  DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE savings_prof_id = '${savingsID}' AND feild_id = '${fieldID}' AND status = '1' AND center_id = '${centerID}' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())
                UNION ALL
                SELECT 0 deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE savings_prof_id = '${savingsID}' AND feild_id = '${fieldID}' AND status = '1' AND center_id = '${centerID}' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())
                ) AS a GROUP BY date";


    $result = $fields->clientAccLoad($query);
    if ($result != false) {
        echo json_encode($result);
        // print_r($result);
    } else {
        echo json_encode(false);
    }
}

// Client Loan Chart Profile Load
if (isset($_POST['clientProfileChartLoad']) && isset($_POST['clientID']) && isset($_POST['loansID']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && $_POST['clientProfileChartLoad'] == 1) {
    $clientID = $_POST['clientID'];
    $loansID = $_POST['loansID'];
    $fieldID = $_POST['fieldID'];
    $centerID = $_POST['centerID'];

    $query = "SELECT date, SUM(deposit) AS deposit, SUM(withdrawal) AS withdrawal, SUM(loan) AS loan, SUM(interest) AS interest FROM ( SELECT deposit,loan,interest, 0 withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE loan_prof_id = '${loansID}' AND feild_id = '${fieldID}' AND status = '1' AND center_id = '${centerID}' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) UNION ALL SELECT 0 AS deposit, 0 AS loan, 0 AS interest, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE loan_prof_id = '${loansID}' AND feild_id = '${fieldID}' AND status = '1' AND center_id = '${centerID}' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) ) AS a GROUP BY date";


    $result = $fields->clientAccLoad($query);
    if ($result != false) {
        echo json_encode($result);
        // print_r($result);
    } else {
        echo json_encode(false);
    }
}
