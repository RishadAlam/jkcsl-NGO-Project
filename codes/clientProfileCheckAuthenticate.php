<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$loansID = $_POST['loansID'];
$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));

$query = "SELECT balance, loan_recover, loan_remaining, interest_recover, interest_remaining, next_check_date, checked_at AS date FROM loan_acc_checks WHERE loan_profile_id ='${loansID}' AND DATE_FORMAT(checked_at, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}'";

$result = $fields->clientAccLoad($query);

if ($result != false && $result != null) {

    $i = 1;
    foreach ($result as $keys => $value) {

        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d/m/Y", strtotime($value['date']));
        $subarray[] = date("d/m/Y", strtotime($value['next_check_date']));
        $subarray[] = $value['balance'];
        $subarray[] = $value['loan_recover'];
        $subarray[] = $value['loan_remaining'];
        $subarray[] = $value['interest_recover'];
        $subarray[] = $value['interest_remaining'];

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
