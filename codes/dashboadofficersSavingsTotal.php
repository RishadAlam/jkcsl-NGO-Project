<?php

use controller\dataLoadController\dataLoadController\dataLoadController;

include_once "../controller/dataLoadController.php";

$load = new dataLoadController();

$officer_id = null;
if ($_SESSION['auth']['user_role']) {
    $officer_id = $_SESSION['auth']['user_id'];
}

$query = "SELECT name AS savingOfficer, SUM(s.deposit) AS savings FROM saving_collections AS s INNER JOIN users AS u ON s.officers_id = u.id WHERE DATE(s.created_at_date) = DATE(CURRENT_DATE())";
if ($officer_id != null) {
    $query .= " AND s.officers_id = '${officer_id}'";
}
$query .= "  GROUP BY s.officers_id";

$result = $load->officerCollectionLoad($query);
if ($result != false) {
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = $value['savingOfficer'];
        $subarray[] = $value['savings'];
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
