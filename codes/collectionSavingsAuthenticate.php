<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

$officer_id = null;
$period = null;
if (isset($_POST['officer'])) {
    $officer_id = $_POST['officer'];
}
if ($_SESSION['auth']['user_role']) {
    $officer_id = $_SESSION['auth']['user_id'];
}
// echo json_encode($officer_id);
// die();
if (isset($_POST['report'])) {
    $period = $_POST['report'];
}
$result = $collection->savingsCollecReportload($period, $officer_id);
if ($result != false && $result != null) {
    // echo json_encode($result);
    // die();
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = $value['client_name'];
        $subarray[] = $value['book'];
        $subarray[] = $value['deposit'];
        $subarray[] = $value['expression'];
        $subarray[] = $value['officer_name'];
        $subarray[] = date("h:i:s A", strtotime($value['created_at_time']));
        $subarray[] = '<a href="#" title="ইডিট" data-bs-toggle="modal" id="edit_load" data-id="' . $value['collection_id'] . '" data-bs-target="#message"><span class="text-warning" style="cursor: pointer; font-size: 22px;"><i class="bx bxs-edit"></i></span></a>';
        $subarray[] = '<a href="#" title="ডিলিট" id="dlt_btn" data-id="' . $value['collection_id'] . '" ><span class="text-danger" style="cursor: pointer; font-size: 22px;"><i class="bx bx-trash"></i></span></a>';
        $subarray[] = '<div class="form-check form-switch text-center">
                                            <input class="form-check-input" name="action" type="checkbox" role="switch" id="' . $value['collection_id'] . '">
                                            <label class="form-check-label" for="' . $value['collection_id'] . '"></label>
                                        </div>';
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
