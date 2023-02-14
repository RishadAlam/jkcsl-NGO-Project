<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$days7 = date("Y-m-d", strtotime("+7days"));
$days3 = date("Y-m-d", strtotime("+3days"));
$today = date("Y-m-d");
// echo $today;

$query = "SELECT chk.acc_check_id, chk.saving_profiles_id, chk.field_id, chk.center_id, chk.client_id, chk.book, DATE_FORMAT(chk.next_check_date, '%d-%m-%Y') AS next_check_date, DATE_FORMAT(chk.checked_at, '%d-%m-%Y') AS checked_at, s.balance, c.name, f.field_name, cn.center_name, p.period_name FROM savings_acc_checks AS chk INNER JOIN client_registers AS c ON c.client_id = chk.client_id INNER JOIN saving_profiles AS s ON s.saving_profiles_id = chk.saving_profiles_id INNER JOIN feilds AS f ON f.feild_id = chk.field_id INNER JOIN centers AS cn ON cn.center_id = chk.center_id INNER JOIN periods AS p ON p.period_id = chk.period_id WHERE chk.next_check_date < CURRENT_DATE() AND chk.status = '1' ORDER BY chk.next_check_date";

$result = $fields->checkingACC($query);
// echo "<pre>";
// print_r($result);

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
        $subarray[] = $value['checked_at'];
        $subarray[] = $value['next_check_date'];
        $subarray[] = '<a href="' . baseUrl('savings-profile-stm') . '?field=' . $value['field_id'] . '&&center=' . $value['center_id'] . '&&client=' . $value['client_id'] . '&&savings=' . $value['saving_profiles_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bx-folder-open"></i></span></a>';
        $subarray[] = '<div class="form-check form-switch text-center">
                            <input class="form-check-input" name="savingsAction" type="checkbox" data-checkID="' . $value['acc_check_id'] . '" role="switch" id="' . $value['saving_profiles_id'] . '">
                            <label class="form-check-label" for="' . $value['saving_profiles_id'] . '"></label>
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
