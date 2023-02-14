<?php

use controller\dataLoadController\dataLoadController\dataLoadController;

include_once "../controller/dataLoadController.php";

$load = new dataLoadController();

$officer_id = null;
if ($_SESSION['auth']['user_role']) {
    $officer_id = $_SESSION['auth']['user_id'];
}

$query = "SELECT lw.book, lw.withdrawal, f.field_name, cn.center_name, p.period_name, c.name AS client_name, u.name AS officer_name FROM loan_savings_withdrawals AS lw INNER JOIN client_registers AS c ON lw.client_id = c.client_id INNER JOIN users AS u ON u.id = lw.officers_id INNER JOIN feilds AS f ON f.feild_id = lw.feild_id INNER JOIN centers AS cn ON cn.center_id = lw.center_id INNER JOIN periods AS p ON p.period_id = lw.period_id WHERE DATE(lw.created_at) = DATE(CURRENT_DATE())";
if ($officer_id != null) {
    $query .= " AND lw.officers_id = '${officer_id}'";
}
$query .= " ORDER BY lw.withdraw_id DESC";
// echo $query;
// die();
$result = $load->dashboardWithdrawalLoad($query);
if ($result != false) {
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = $value['client_name'];
        $subarray[] = $value['book'];
        $subarray[] = $value['field_name'];
        $subarray[] = $value['center_name'];
        $subarray[] = $value['period_name'];
        $subarray[] = $value['withdrawal'];
        $subarray[] = $value['officer_name'];
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
