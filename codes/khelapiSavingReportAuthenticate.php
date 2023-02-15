<?php

use controller\ProfileSTMUpdate\ProfileSTMController;

include_once "../controller/ProfileSTMUpdateController.php";
$fields = new ProfileSTMController();

$id = $_POST['report_id'];
$days = $_POST['report_days'];
$result = $fields->savingKhelapiReport($id, $days);

if ($result != false && $result != null) {
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
        $subarray[] = '<a href="' . baseUrl('savings-profile-stm') . '?field=' . $value['field_id'] . '&&center=' . $value['center_id'] . '&&client=' . $value['client_id'] . '&&savings=' . $value['saving_profiles_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bx-folder-open"></i></span></a>';

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
