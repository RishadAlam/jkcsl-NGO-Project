<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$savingsID = $_POST['savingsID'];
$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));

$query = "SELECT sw.withdrawal, sw.balance_remaining, DATE_FORMAT(sw.created_at, '%d-%m-%Y') AS date, sw.expression, u.name FROM saving_withdrawals AS sw INNER JOIN users AS u ON sw.officers_id = u.id WHERE sw.savings_prof_id ='${savingsID}' AND sw.status='1' AND DATE_FORMAT(sw.created_at, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}'";

$result = $fields->clientAccLoad($query);

if ($result != false && $result != null) {

    $i = 1;
    foreach ($result as $keys => $value) {

        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d/m/Y", strtotime($value['date']));
        $subarray[] = $value['name'];
        $subarray[] = $value['expression'];
        $subarray[] = $value['withdrawal'];
        $subarray[] = $value['balance_remaining'];

        $output[] = $subarray;
    }
    $data = array(
        // "recordsFiltered" => $rowCount,
        "data" => $output,
    );
    echo json_encode($data);
} else {
    echo json_encode(null);
}
