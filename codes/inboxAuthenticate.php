<?php

use controller\dataLoadController\dataLoadController\dataLoadController;

include_once "../controller/dataLoadController.php";

$load = new dataLoadController();
$officer_id = $_SESSION['auth']['user_id'];
$result = $load->notifload($officer_id);
$output = "";
if ($result != false) {
    $output = [];
    $i = 1;
    foreach ($result as $keys => $value) {
        $status = $value['status'] == 1 ? "<span class='text-secondary' style='cursor: pointer; font-size: 36px;' id='msgView'><i class='bx bx-envelope-open'></i></span>" : "<span class='text-warning' style='cursor: pointer; font-size: 36px;' id='msgView'><i class='bx bx-envelope' ></i></span>";
        
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d/m/Y h:i:s A", strtotime($value['created_at']));
        $subarray[] = $value['name'];
        $subarray[] = $value['sub'];
        $subarray[] = substr(substr($value['details'], 0, 200,), 0, strrpos(substr($value['details'], 0, 200,), ' ')) . '...';
                $subarray[] = '<a href="#" title="মেসেজ দেখুন" data-id="' . $value["id"] . '" id="notif_view" data-bs-toggle="modal" data-bs-target="#message">' . $status . '</a>';
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
