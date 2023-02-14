<?php

use controller\dataLoadController\dataLoadController\dataLoadController;

// include_once "../config/app.php";
include_once "../controller/dataLoadController.php";

$load = new dataLoadController();
$officer_id = $_SESSION['auth']['user_id'];
$result = $load->sendboxload($officer_id);
$output = "";
if ($result != false) {
    $output = [];
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d/m/Y h:i:s A", strtotime($value['created_at']));
        $subarray[] = $value['name'];
        $subarray[] = strlen($value['sub']) > 50 ? substr(substr($value['sub'], 0, 50,), 0, strrpos(substr($value['sub'], 0, 50,), ' ')) . '...' : $value['sub'];
        $subarray[] = substr(substr($value['details'], 0, 300,), 0, strrpos(substr($value['details'], 0, 300,), ' ')) . '...';
        $subarray[] = '<a href="#" title="মেসেজ দেখুন" data-id="' . $value["id"] . '" id="notif_view" data-bs-toggle="modal" data-bs-target="#message"><span class="text-success" style="cursor: pointer; font-size: 36px;"><i class="bx bx-envelope-open"></i></span></a>';
        $subarray[] = $value['status'] == 1 ? "<span class='text-success' style='font-size:36px'><i class='bx bxs-check-circle' ></i></span>" : "<span class='text-success' style='font-size:36px'><i class='bx bx-check'></i></i></span>";

        $output[] = $subarray;
    }

    $row = $load->bellLoad($officer_id);
    if ($row != false) {
        $rowCount = $row['bell'];
    }


    $data = array(
        "recordsFiltered" => $rowCount,
        "data" => $output,
    );
    echo json_encode($data);
} else {
    echo json_encode(null);
}
