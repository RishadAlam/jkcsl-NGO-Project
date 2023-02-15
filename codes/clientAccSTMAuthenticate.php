<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$savingsID = $_POST['savingsID'];
$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));

$query = "SELECT DATE_FORMAT('${from_date}' - INTERVAL 1 DAY, '%d-%m-%Y') AS date, exp, SUM(deposit)-SUM(withdrawal) AS deposit, 0 AS withdrawal, SUM(deposit)-SUM(withdrawal) AS balance FROM ( SELECT SUM(deposit) AS deposit, 'পূর্বের লেনদেন' AS exp, 0 AS withdrawal, created_at_date AS date FROM saving_collections WHERE savings_prof_id ='${savingsID}' AND status!='2' AND DATE_FORMAT(created_at_date, '%Y-%m-%d') NOT BETWEEN '${from_date}' AND '${end_date}' UNION ALL SELECT 0 AS deposit, 'পূর্বের লেনদেন' AS exp, SUM(withdrawal) AS withdrawal, created_at AS date FROM saving_withdrawals WHERE savings_prof_id ='${savingsID}' AND status!='2' AND DATE_FORMAT(created_at, '%Y-%m-%d') NOT BETWEEN '${from_date}' AND '${end_date}' ) AS a

UNION ALL

SELECT date, exp, SUM(deposit) AS deposit, SUM(withdrawal) AS withdrawal, SUM(deposit)-SUM(withdrawal) AS balance FROM (
SELECT '' AS exp, deposit, 0 AS withdrawal, created_at_date AS date FROM saving_collections WHERE savings_prof_id ='${savingsID}' AND status!='2' AND DATE_FORMAT(created_at_date, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}'
UNION ALL
SELECT '' AS exp, 0 AS deposit, withdrawal, created_at AS date FROM saving_withdrawals WHERE savings_prof_id ='${savingsID}' AND status!='2' AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}'
) AS b GROUP BY date";


$result = $fields->clientAccLoad($query);
// $result1 = $fields->clientAccLoad($query);

if ($result != false && $result != null) {
    // print_r($result);
    // die();
    $i = 1;
    // $balance = "";
    // $combine = array_merge($result, $result1);
    $sum = [];
    foreach ($result as $keys => $value) {
        // $balances = 0;
        if ($keys > 0) {
            // $balances = $value['balance'] + $result[$keys - 1]['balance'];
            $balances += $result[$keys]['balance'];
        } else {
            $balances = $value['balance'];
        }

        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d/m/Y", strtotime($value['date']));
        $subarray[] = $value['exp'];
        $subarray[] = $value['deposit'];
        $subarray[] = $value['withdrawal'];
        $subarray[] = $balances;

        $output[] = $subarray;
    }
    $data = array(
        // "recordsFiltered" => $rowCount,
        "data" => $output,
    );
    echo json_encode($data);
    // print_r($output);
} else {
    echo json_encode(null);
}
