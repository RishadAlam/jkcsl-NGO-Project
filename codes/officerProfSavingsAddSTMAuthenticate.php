<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

$officer_id = $_POST['officerID'];
$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));
$query = "SELECT s.book, s.deposit_installment, s.interest, s.total_with_interest, s.created_at, c.name, f.field_name, cn.center_name, p.period_name  FROM saving_profiles AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = s.field_id INNER JOIN centers AS cn ON cn.center_id = s.center_id INNER JOIN periods AS p ON p.period_id = s.period_id WHERE s.status = '1' AND s.reg_officer_id = '${officer_id}' AND DATE_FORMAT(s.created_at, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}' ORDER BY s.saving_profiles_id DESC";
// echo json_encode($from_date);
// die();

$result = $collection->savingsCollecRecordload($query);
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
        $subarray[] = $value['deposit_installment'];
        $subarray[] = $value['interest'] . "%";
        $subarray[] = $value['total_with_interest'];
        $subarray[] = date("d M Y", strtotime($value['created_at']));

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
