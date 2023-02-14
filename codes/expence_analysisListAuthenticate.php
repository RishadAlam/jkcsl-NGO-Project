<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));
$type = $_POST['type'];

if ($type == 'all') {
    $query = "SELECT expence, details, date, 
    CASE
        WHEN type = '1' THEN 'দৈনিক খরচ'
        WHEN type = '2' THEN 'এফ.ডি.আর লাভ'
        WHEN type = '3' THEN 'বেতন'
        WHEN type = '4' THEN 'বই ক্লোজিং লাভ'
    END AS type
    FROM expenses WHERE date BETWEEN '${from_date}' AND '${end_date}' ORDER BY date DESC";
} elseif ($type == 1) {
    $query = "SELECT expence, details, date, 'দৈনিক খরচ' AS type FROM expenses WHERE type = '1' AND date BETWEEN '${from_date}' AND '${end_date}' ORDER BY date DESC";
} elseif ($type == 2) {
    $query = "SELECT expence, details, date, 'এফ.ডি.আর লাভ' AS type FROM expenses WHERE type = '2' AND date BETWEEN '${from_date}' AND '${end_date}' ORDER BY date DESC";
} elseif ($type == 3) {
    $query = "SELECT e.expence, u.name AS details, e.date, 'বেতন' AS type FROM expenses AS e INNER JOIN users AS u ON u.id = e.details WHERE e.type = '3' AND e.date BETWEEN '${from_date}' AND '${end_date}' ORDER BY e.date DESC";
} elseif ($type == 4) {
    $query = "SELECT expence, details, date, 'বই ক্লোজিং লাভ' AS type FROM expenses WHERE type = '4' AND date BETWEEN '${from_date}' AND '${end_date}' ORDER BY date DESC";
}

$result = $collection->incomeExpanceRecordload($query);
if ($result != false && $result != null) {
    // print_r($result);
    // die();
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = date("d-m-Y", strtotime($value['date']));
        $subarray[] = $value['details'];
        $subarray[] = $value['type'];
        $subarray[] = $value['expence'];

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
