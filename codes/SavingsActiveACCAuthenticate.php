<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

// Field Active Clients Account Load
$fieldID = $_POST['fieldID'];
$centerID = $_POST['center'];
$periodID = $_POST['period'];

if ($fieldID != null && $periodID == null && $centerID == null) {

    $query = "SELECT c.name, s.client_id, s.field_id, s.center_id, s.book, s.balance, f.field_name, cn.center_name, p.period_name  FROM saving_profiles AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = s.field_id INNER JOIN centers AS cn ON s.center_id = cn.center_id INNER JOIN periods AS p ON s.period_id = p.period_id WHERE s.field_id = '${fieldID}' AND s.status = '1'";
} elseif ($centerID != null && $periodID == null) {

    $query = "SELECT c.name, s.client_id, s.field_id, s.center_id, s.book, s.balance, f.field_name, cn.center_name, p.period_name  FROM saving_profiles AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = s.field_id INNER JOIN centers AS cn ON s.center_id = cn.center_id INNER JOIN periods AS p ON s.period_id = p.period_id WHERE s.center_id = '${centerID}' AND s.status = '1'";
} elseif ($periodID != null && $centerID == null && $fieldID == null) {

    $query = "SELECT c.name, s.client_id, s.field_id, s.center_id, s.book, s.balance, f.field_name, cn.center_name, p.period_name  FROM saving_profiles AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = s.field_id INNER JOIN centers AS cn ON s.center_id = cn.center_id INNER JOIN periods AS p ON s.period_id = p.period_id WHERE s.period_id = '${periodID}' AND s.status = '1'";
} elseif ($periodID != null && $centerID != null) {

    $query = "SELECT c.name, s.client_id, s.field_id, s.center_id, s.book, s.balance, f.field_name, cn.center_name, p.period_name  FROM saving_profiles AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = s.field_id INNER JOIN centers AS cn ON s.center_id = cn.center_id INNER JOIN periods AS p ON s.period_id = p.period_id WHERE s.center_id = '${centerID}' AND s.period_id = '${periodID}' AND s.status = '1'";
} elseif ($periodID != null && $fieldID != null) {

    $query = "SELECT c.name, s.client_id, s.field_id, s.center_id, s.book, s.balance, f.field_name, cn.center_name, p.period_name  FROM saving_profiles AS s INNER JOIN client_registers AS c ON s.client_id = c.client_id INNER JOIN feilds AS f ON f.feild_id = s.field_id INNER JOIN centers AS cn ON s.center_id = cn.center_id INNER JOIN periods AS p ON s.period_id = p.period_id WHERE s.field_id = '${fieldID}' AND s.period_id = '${periodID}' AND s.status = '1'";
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
