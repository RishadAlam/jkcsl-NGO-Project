<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

// Field Active Clients Account Load
$fieldID = $_POST['fieldID'];
$centerID = $_POST['center'];
$periodID = $_POST['period'];

if ($fieldID != null && $periodID == null && $centerID == null) {

    $query = "SELECT c.name, l.client_id, l.field_id, l.center_id, l.book, l.balance, l.total_loan, l.total_interest, l.loan_recover, l.loan_remaining, l.interest_recover, l.interest_remaining, f.field_name, cn.center_name, p.period_name  FROM loan_profiles AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = l.field_id INNER JOIN centers AS cn ON l.center_id = cn.center_id INNER JOIN periods AS p ON l.period_id = p.period_id WHERE l.field_id = '${fieldID}' AND l.status = '0'";
} elseif ($centerID != null && $periodID == null) {

    $query = "SELECT c.name, l.client_id, l.field_id, l.center_id, l.book, l.balance, l.total_loan, l.total_interest, l.loan_recover, l.loan_remaining, l.interest_recover, l.interest_remaining, f.field_name, cn.center_name, p.period_name  FROM loan_profiles AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = l.field_id INNER JOIN centers AS cn ON l.center_id = cn.center_id INNER JOIN periods AS p ON l.period_id = p.period_id WHERE l.center_id = '${centerID}' AND l.status = '0'";
} elseif ($periodID != null && $centerID == null && $fieldID == null) {

    $query = "SELECT c.name, l.client_id, l.field_id, l.center_id, l.book, l.balance, l.total_loan, l.total_interest, l.loan_recover, l.loan_remaining, l.interest_recover, l.interest_remaining, f.field_name, cn.center_name, p.period_name  FROM loan_profiles AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = l.field_id INNER JOIN centers AS cn ON l.center_id = cn.center_id INNER JOIN periods AS p ON l.period_id = p.period_id WHERE l.period_id = '${periodID}' AND l.status = '0'";
} elseif ($periodID != null && $centerID != null && $fieldID != null) {

    $query = "SELECT c.name, l.client_id, l.field_id, l.center_id, l.book, l.balance, l.total_loan, l.total_interest, l.loan_recover, l.loan_remaining, l.interest_recover, l.interest_remaining, f.field_name, cn.center_name, p.period_name  FROM loan_profiles AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = l.field_id INNER JOIN centers AS cn ON l.center_id = cn.center_id INNER JOIN periods AS p ON l.period_id = p.period_id WHERE l.field_id = '${fieldID}' AND l.center_id = '${centerID}' AND l.period_id = '${periodID}' AND l.status = '0'";
} elseif ($periodID != null && $centerID == null && $fieldID != null) {

    $query = "SELECT c.name, l.client_id, l.field_id, l.center_id, l.book, l.balance, l.total_loan, l.total_interest, l.loan_recover, l.loan_remaining, l.interest_recover, l.interest_remaining, f.field_name, cn.center_name, p.period_name  FROM loan_profiles AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = l.field_id INNER JOIN centers AS cn ON l.center_id = cn.center_id INNER JOIN periods AS p ON l.period_id = p.period_id WHERE l.field_id = '${fieldID}' AND l.period_id = '${periodID}' AND l.status = '0'";
} elseif ($periodID != null && $centerID != null && $fieldID == null) {

    $query = "SELECT c.name, l.client_id, l.field_id, l.center_id, l.book, l.balance, l.total_loan, l.total_interest, l.loan_recover, l.loan_remaining, l.interest_recover, l.interest_remaining, f.field_name, cn.center_name, p.period_name  FROM loan_profiles AS l INNER JOIN client_registers AS c ON l.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = l.field_id INNER JOIN centers AS cn ON l.center_id = cn.center_id INNER JOIN periods AS p ON l.period_id = p.period_id WHERE l.center_id = '${centerID}' AND l.period_id = '${periodID}' AND l.status = '0'";
}

$result = $fields->clientAccLoad($query);

if ($result != false && $result != null) {
    // print_r($result);
    // die();
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = $value['name'];
        $subarray[] = $value['book'];
        $subarray[] = $value['field_name'];
        $subarray[] = $value['center_name'];
        $subarray[] = $value['period_name'];
        $subarray[] = $value['balance'];
        $subarray[] = $value['loan_recover'];
        $subarray[] = $value['loan_remaining'];
        $subarray[] = $value['interest_recover'];
        $subarray[] = $value['interest_remaining'];
        $subarray[] = '<a href="' . baseUrl('client-profile') . '?field=' . $value['field_id'] . '&&center=' . $value['center_id'] . '&&savings=1&&client=' . $value['client_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bx-folder-open"></i></span></a>';

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
