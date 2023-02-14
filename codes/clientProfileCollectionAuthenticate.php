<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$loansID = $_POST['loansID'];
$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));

$query = "SELECT l.collection_id, l.deposit, l.loan, l.interest, l.total, l.created_at_date AS date, l.created_at_time AS time, l.expression, u.name FROM loan_collections AS l INNER JOIN users AS u ON l.officers_id = u.id WHERE l.loan_prof_id ='${loansID}' AND DATE_FORMAT(l.created_at_date, '%Y-%m-%d') BETWEEN '${from_date}' AND '${end_date}'";

$result = $fields->clientAccLoad($query);

if ($result != false && $result != null) {

    $i = 1;
    foreach ($result as $keys => $value) {

        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d/m/Y", strtotime($value['date']));
        $subarray[] = date("h:i:s A", strtotime($value['time']));
        $subarray[] = $value['name'];
        $subarray[] = $value['expression'];
        $subarray[] = $value['deposit'];
        $subarray[] = $value['loan'];
        $subarray[] = $value['interest'];
        $subarray[] = $value['total'];
        $subarray[] = '<a href="#" title="ইডিট" data-bs-toggle="modal" id="edit_load" data-id="' . $value['collection_id'] . '" data-bs-target="#message"><span class="text-warning" style="cursor: pointer; font-size: 22px;"><i class="bx bxs-edit"></i></span></a>';
        $subarray[] = '<a href="#" title="ডিলিট" id="dlt_btn" data-id="' . $value['collection_id'] . '" ><span class="text-danger" style="cursor: pointer; font-size: 22px;"><i class="bx bx-trash"></i></span></a>';


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
