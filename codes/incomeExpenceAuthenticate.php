<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

// Income Chart Load
if (isset($_POST['income']) && $_POST['income'] == 1) {
    if (isset($_POST['from_date']) && isset($_POST['end_date'])) {
        $from_date = date("Y-m-d", strtotime($_POST['from_date']));
        $end_date = date("Y-m-d", strtotime($_POST['end_date']));

        $query = "SELECT SUM(income) AS income, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM incomes WHERE date BETWEEN '${from_date}' AND  '${end_date}' GROUP BY date";
    } else {
        $query = "SELECT SUM(income) AS income, date FROM incomes WHERE MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY date";
    }
    // echo json_encode($from_date);
    // die();

    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(null);
    }
}

// Totsl Income Chart Load
if (isset($_POST['total_income']) && $_POST['total_income'] == 1) {
    if (isset($_POST['from_date']) && isset($_POST['end_date'])) {
        $from_date = date("Y-m-d", strtotime($_POST['from_date']));
        $end_date = date("Y-m-d", strtotime($_POST['end_date']));

        $query = "SELECT SUM(income) AS income FROM incomes WHERE date BETWEEN '${from_date}' AND  '${end_date}'";
    } else {
        $query = "SELECT SUM(income) AS income FROM incomes WHERE MONTH(date) = MONTH(CURRENT_DATE())";
    }

    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        foreach ($result as $val) {
            $income = $val['income'];
        }
        echo $income;
    } else {
        echo false;
    }
}

// Income edit Load
if (isset($_POST['income_id'])) {
    $id = $_POST['income_id'];
    $query = "SELECT * FROM incomes WHERE id = '${id}' LIMIT 1";
    // echo json_encode($from_date);
    // die();

    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(null);
    }
}

// expance edit Load
if (isset($_POST['expance1_id'])) {
    $id = $_POST['expance1_id'];
    $query = "SELECT * FROM expenses WHERE id = '${id}' LIMIT 1";
    // echo json_encode($from_date);
    // die();

    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(null);
    }
}

// Totsl Income Chart Load
if (isset($_POST['total_expance_type'])) {
    $type = $_POST['total_expance_type'];
    $query = "SELECT SUM(expence) AS expence FROM expenses WHERE type = '${type}' AND MONTH(date) = MONTH(CURRENT_DATE())";
    // echo json_encode($from_date);
    // die();

    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        foreach ($result as $val) {
            $expence = $val['expence'];
        }
        echo $expence;
    } else {
        echo null;
    }
}

// Income Chart Load
if (isset($_POST['expence_type'])) {
    $type = $_POST['expence_type'];
    $query = "SELECT SUM(expence) AS expence, date FROM expenses WHERE type = '${type}' AND MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY date";
    // echo json_encode($from_date);
    // die();

    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(null);
    }
}

// Total Expence Load
if (isset($_POST['total_expence']) && isset($_POST['from_date']) && isset($_POST['from_date']) && isset($_POST['type'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $type = $_POST['type'];

    if ($type == 'all') {
        $query = "SELECT SUM(expence) AS expence, '1' AS type FROM expenses WHERE type = '1' AND date BETWEEN '${from_date}' AND '${end_date}'
    UNION ALL
    SELECT SUM(expence) AS expence, '2' AS type FROM expenses WHERE type = '2' AND date BETWEEN '${from_date}' AND '${end_date}'
    UNION ALL
    SELECT SUM(expence) AS expence, '3' AS type FROM expenses WHERE type = '3' AND date BETWEEN '${from_date}' AND '${end_date}'
    UNION ALL
    SELECT SUM(expence) AS expence, '4' AS type FROM expenses WHERE type = '4' AND date BETWEEN '${from_date}' AND '${end_date}'";
    } elseif ($type == 1) {
        $query = "SELECT SUM(expence) AS expence, '1' AS type FROM expenses WHERE type = '1' AND date BETWEEN '${from_date}' AND '${end_date}'
        UNION ALL
        SELECT 0 AS expence, '2' AS type
        UNION ALL
        SELECT 0 AS expence, '3' AS type
        UNION ALL
        SELECT 0 AS expence, '4' AS type";
    } elseif ($type == 2) {
        $query = "SELECT SUM(expence) AS expence, '2' AS type FROM expenses WHERE type = '2' AND date BETWEEN '${from_date}' AND '${end_date}'
        UNION ALL
        SELECT 0 AS expence, '1' AS type
        UNION ALL
        SELECT 0 AS expence, '3' AS type
        UNION ALL
        SELECT 0 AS expence, '4' AS type";
    } elseif ($type == 3) {
        $query = "SELECT SUM(expence) AS expence, '3' AS type FROM expenses WHERE type = '3' AND date BETWEEN '${from_date}' AND '${end_date}'
        UNION ALL
        SELECT 0 AS expence, '1' AS type
        UNION ALL
        SELECT 0 AS expence, '2' AS type
        UNION ALL
        SELECT 0 AS expence, '4' AS type";
    } elseif ($type == 4) {
        $query = "SELECT SUM(expence) AS expence, '4' AS type FROM expenses WHERE type = '4' AND date BETWEEN '${from_date}' AND '${end_date}'
        UNION ALL
        SELECT 0 AS expence, '1' AS type
        UNION ALL
        SELECT 0 AS expence, '2' AS type
        UNION ALL
        SELECT 0 AS expence, '3' AS type";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
// Total Expence chart Load
if (isset($_POST['expanceChart']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['type'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $type = $_POST['type'];

    if ($type == 'all') {
        $query = "SELECT SUM(daily_expence) AS daily_expence, SUM(fdr_expence) AS fdr_expence, SUM(salery_expence) AS salery_expence, SUM(closing_expence) AS closing_expence, date FROM (
        SELECT expence as daily_expence, 0 AS fdr_expence, 0 AS salery_expence, 0 as closing_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '1' AND date BETWEEN '${from_date}' AND '${end_date}'
            UNION ALL
            SELECT 0 AS daily_expence, expence as fdr_expence, 0 AS salery_expence, 0 as closing_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '2' AND date BETWEEN '${from_date}' AND '${end_date}'
            UNION ALL
            SELECT 0 AS daily_expence, 0 as fdr_expence, expence AS salery_expence, 0 as closing_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '3' AND date BETWEEN '${from_date}' AND '${end_date}'
            UNION ALL
            SELECT 0 AS daily_expence, 0 as fdr_expence, 0 AS salery_expence, expence as closing_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '4' AND date BETWEEN '${from_date}' AND '${end_date}'
        ) AS a GROUP BY date";
    } elseif ($type == 1) {
        $query = "SELECT SUM(expence) AS daily_expence, 0 AS fdr_expence, 0 AS salery_expence, 0 AS closing_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '1' AND date BETWEEN '${from_date}' AND '${end_date}' GROUP BY date";
    } elseif ($type == 2) {
        $query = "SELECT SUM(expence) AS fdr_expence, 0 AS daily_expence, 0 AS salery_expence, 0 AS closing_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '2' AND date BETWEEN '${from_date}' AND '${end_date}' GROUP BY date";
    } elseif ($type == 3) {
        $query = "SELECT SUM(expence) AS salery_expence, 0 AS daily_expence, 0 AS fdr_expence, 0 AS closing_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '3' AND date BETWEEN '${from_date}' AND '${end_date}' GROUP BY date";
    } elseif ($type == 4) {
        $query = "SELECT SUM(expence) AS closing_expence, 0 AS daily_expence, 0 AS salery_expence, 0 AS fdr_expence, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM expenses WHERE type = '4' AND date BETWEEN '${from_date}' AND '${end_date}' GROUP BY date";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
// Total Loan ADD Close Load
if (isset($_POST['newLoanCloseLoan']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {
        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND  reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose FROM loan_profiles WHERE field_id = '${field}' AND  reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
// Total Loan ADD close chart Load
if (isset($_POST['newLoanCloseLoanChart']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanGiving) AS loanGiving, SUM(loanClose) AS loanClose, date FROM( SELECT COUNT(*) AS loanGiving, 0 AS loanClose, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS loanGiving, COUNT(*) AS loanClose, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM loan_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Total Saving ADD Close Load
if (isset($_POST['addCloseSavings']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {
        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND  reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings FROM saving_profiles WHERE field_id = '${field}' AND  reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' ) AS a";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Total Savings ADD close chart Load
if (isset($_POST['addCloseSavingsChart']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND center_id = '${center}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND period_id = '${period}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(newSavings) AS newSavings, SUM(closeSavings) AS closeSavings, date FROM( SELECT COUNT(*) AS newSavings, 0 AS closeSavings, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date UNION ALL SELECT 0 AS newSavings, COUNT(*) AS closeSavings, DATE_FORMAT(closing_at, '%d-%m-%Y') AS date FROM saving_profiles WHERE field_id = '${field}' AND reg_officer_id = '${officer}' AND closing_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY date ) AS a GROUP BY date";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}


// Total Loan collection analytics Load
if (isset($_POST['loanAnalytics']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal FROM (SELECT SUM(loan) as loanRec, SUM(interest) as interestRec, SUM(deposit) as depositRec, 0 as depositWithdrawal FROM loan_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, SUM(withdrawal) as depositWithdrawal FROM loan_savings_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
// Total Loan collection analytics Load
if (isset($_POST['loanAnlyticsChart']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(loanRec) as loanRec, SUM(interestRec) as interestRec, SUM(depositRec) as depositRec, SUM(depositWithdrawal) as depositWithdrawal, date FROM (SELECT loan as loanRec, interest as interestRec, deposit as depositRec, 0 as depositWithdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as loanRec, 0 as interestRec, 0 as depositRec, withdrawal as depositWithdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM loan_savings_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Total Savings collection analytics Load
if (isset($_POST['savingsAnalytics']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal FROM (SELECT SUM(deposit) as deposit, 0 as withdrawal FROM saving_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, SUM(withdrawal) as withdrawal FROM saving_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Total Savings collection analytics Load
if (isset($_POST['savingsAnalyticsChart']) && isset($_POST['from_date']) && isset($_POST['end_date']) && isset($_POST['field']) && isset($_POST['center']) && isset($_POST['period']) && isset($_POST['officer'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
    $field = $_POST['field'];
    $center = $_POST['center'];
    $period = $_POST['period'];
    $officer = $_POST['officer'];

    if ($field == null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer != null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center != null && $officer == null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND center_id= ${center} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer == null && $period != null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND period_id = '${period}' AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND period_id = '${period}' AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field == null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    } elseif ($field != null && $center == null && $officer != null && $period == null) {

        $query = "SELECT SUM(deposit) as deposit, SUM(withdrawal) as withdrawal, date FROM (SELECT deposit, 0 as withdrawal, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM saving_collections WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 as deposit, withdrawal, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM saving_withdrawals WHERE feild_id = ${field} AND officers_id = ${officer} AND created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";
    }
    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Total accountCalculation analytics Load
if (isset($_POST['accountCalculationAnalytics']) && isset($_POST['from_date']) && isset($_POST['end_date'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));

    $query = "SELECT SUM(income) AS income, SUM(interest) AS interest, SUM(expence) AS expence, (SUM(income)+SUM(interest))-SUM(expence) AS result FROM( SELECT SUM(income) AS income, 0 AS interest, 0 AS expence FROM incomes WHERE created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS income, SUM(interest) AS interest, 0 AS expence FROM loan_collections WHERE created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS income, 0 AS interest, SUM(expence) AS expence FROM expenses WHERE created_at BETWEEN '${from_date}' AND '${end_date}') AS a";

    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
// Total accountCalculationAnalyticsChart analytics Load
if (isset($_POST['accountCalculationAnalyticsChart']) && isset($_POST['from_date']) && isset($_POST['end_date'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));

    $query = "SELECT SUM(income) AS income, SUM(interest) AS interest, SUM(expence) AS expence, (SUM(income)+SUM(interest))-SUM(expence) AS result, date FROM( SELECT income AS income, 0 AS interest, 0 AS expence, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM incomes WHERE created_at BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS income, interest AS interest, 0 AS expence, DATE_FORMAT(created_at_date, '%d-%m-%Y') AS date FROM loan_collections WHERE created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS income, 0 AS interest, expence AS expence, DATE_FORMAT(created_at, '%d-%m-%Y') AS date FROM expenses WHERE created_at BETWEEN '${from_date}' AND '${end_date}') AS a GROUP BY date";

    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Total expenceCalculationAnalytics analytics Load
if (isset($_POST['expenceCalculationAnalytics']) && isset($_POST['from_date']) && isset($_POST['end_date'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));

    $query = "SELECT SUM(expence) AS expence, 
                CASE
                WHEN type = '1' THEN 'দৈনিক খরচ'
                WHEN type = '2' THEN 'এফ.ডি.আর লাভ'
                WHEN type = '3' THEN 'বেতন'
                WHEN type = '4' THEN 'বই ক্লোজিং লাভ'
                END AS type FROM expenses WHERE created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY type";

    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        $total = [];
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['type'] . '</td>
                            <td>৳' . $row['expence'] . '/-</td>
                        </tr>';
            $total[] = $row['expence'];
        }
        $output .= '</tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>সর্বমোট</td>
                            <td>৳' . array_sum($total) . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
    } else {
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3">কোনো খরচ পাওয়া যাইনি</td>
                    </tr>
                    </tbody>';
        echo $output;
    }
}

// Total expenceCalculationAnalytics analytics Load
if (isset($_POST['incomeCalculationAnalytics']) && isset($_POST['from_date']) && isset($_POST['end_date'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));

    $query = "SELECT SUM(income) AS income, details FROM incomes WHERE created_at BETWEEN '${from_date}' AND '${end_date}' GROUP BY details";

    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        $total = [];
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['details'] . '</td>
                            <td>৳' . $row['income'] . '/-</td>
                        </tr>';
            $total[] = $row['income'];
        }
        $output .= '</tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>সর্বমোট</td>
                            <td>৳' . array_sum($total) . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
    } else {
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3">কোনো আয় পাওয়া যাইনি</td>
                    </tr>
                    </tbody>';
        echo $output;
    }
}

// Total expenceCalculationAnalytics analytics Load
if (isset($_POST['interestCalculationAnalytics']) && isset($_POST['from_date']) && isset($_POST['end_date'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));

    $query = "SELECT SUM(l.interest) AS interest, p.period_name FROM loan_collections AS l INNER JOIN periods AS p ON p.period_id = l.period_id WHERE l.created_at_date BETWEEN '${from_date}' AND '${end_date}' GROUP BY l.period_id";

    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        $total = [];
        $output = '<thead>
                        <th>#</th>
                        <th>ক্ষেত্র</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>৳' . $row['interest'] . '/-</td>
                        </tr>';
            $total[] = $row['interest'];
        }
        $output .= '</tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>সর্বমোট</td>
                            <td>৳' . array_sum($total) . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
    } else {
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3">কোনো লাভ পাওয়া যাইনি</td>
                    </tr>
                    </tbody>';
        echo $output;
    }
}

// Total expenceCalculationAnalytics analytics Load
if (isset($_POST['finalCalculationAnalytics']) && isset($_POST['from_date']) && isset($_POST['end_date'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));

    $query = "SELECT SUM(interest)+SUM(income) AS tk, 'সর্বমোট আয়' AS name FROM (SELECT SUM(interest) AS interest, 0 AS income FROM loan_collections WHERE created_at_date BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS interest, SUM(income) AS income FROM incomes WHERE created_at BETWEEN '${from_date}' AND '${end_date}' ) AS b UNION ALL SELECT SUM(expence) AS tk, 'সর্বমোট খরচ' AS name FROM expenses WHERE created_at BETWEEN '${from_date}' AND '${end_date}'";

    // echo json_encode($query);
    // die();
    $result = $collection->incomeExpanceRecordload($query);
    if ($result != false && $result != null) {
        $total = [];
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>৳' . $row['tk'] . '/-</td>
                        </tr>';
            $total[] = $row['tk'];
        }
        $final = $total['0'] - $total['1'];
        $output .= '</tbody>
                    <tfoot>
                        <tr  style="font-weight: bolder;" class="';
        if ($final > 0) {
            $output .=          'bg-success';
        } else {
            $output .=          'bg-danger';
        }
        $output .=          '">
                            <td></td>
                            <td class="d-flex justify-content-between">';
        if ($final > 0) {
            $output .=       'লাভ <span><i class="bx bx-plus';
        } else {
            $output .=       'লোকসান <span><i class="bx bx-minus';
        }
        $output .=          '"></i></span></td>
                            <td style="font-size: 22px;">' . $final . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
    } else {
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3">কোনো হিসাব পাওয়া যাইনি</td>
                    </tr>
                    </tbody>';
        echo $output;
    }
}
