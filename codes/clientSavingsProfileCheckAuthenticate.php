<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$savingsID = $_POST['savingsID'];
$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));

$query = "SELECT balance, next_check_date, checked_at AS date FROM savings_acc_checks WHERE saving_profiles_id ='${savingsID}' AND DATE_FORMAT(checked_at, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}'";

$result = $fields->clientAccLoad($query);

if ($result != false && $result != null) {

    $i = 1;
    foreach ($result as $keys => $value) {

        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d/m/Y", strtotime($value['date']));
        $subarray[] = date("d/m/Y", strtotime($value['next_check_date']));
        $subarray[] = $value['balance'];

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
