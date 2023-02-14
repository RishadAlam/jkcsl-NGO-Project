<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));
$query = "SELECT * FROM incomes WHERE DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}' ORDER BY DATE_FORMAT(date, '%Y-%m-%d') DESC";
// echo json_encode($from_date);
// die();

$result = $collection->incomeExpanceRecordload($query);
if ($result != false && $result != null) {
    // print_r($result);
    // die();
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d M Y", strtotime($value['date']));
        $subarray[] = $value['details'];
        $subarray[] = $value['income'];
        $subarray[] = '<a href="#" title="ইডিট" data-bs-toggle="modal" id="edit_load" data-id="' . $value['id'] . '" data-bs-target="#message"><span class="text-warning" style="cursor: pointer; font-size: 22px;"><i class="bx bxs-edit"></i></span></a>';
        $subarray[] = '<a href="#" title="ডিলিট" id="dlt_btn" data-id="' . $value['id'] . '" ><span class="text-danger" style="cursor: pointer; font-size: 22px;"><i class="bx bx-trash"></i></span></a>';

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
