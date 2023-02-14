<?php

use controller\dataLoadController\dataLoadController\dataLoadController;

include_once "../controller/dataLoadController.php";

$load = new dataLoadController();

$officer_id = null;
if ($_SESSION['auth']['user_role']) {
    $officer_id = $_SESSION['auth']['user_id'];
}

$query = "SELECT name AS loanOfficer, SUM(l.deposit) AS savings, SUM(l.loan) AS loan, SUM(l.interest) AS interest, SUM(l.total) AS total FROM loan_collections AS l INNER JOIN users AS u ON l.officers_id = u.id WHERE DATE(l.created_at_date) = DATE(CURRENT_DATE())";
if ($officer_id != null) {
    $query .= " AND l.officers_id = '${officer_id}'";
}
$query .= "  GROUP BY l.officers_id";

$result = $load->officerCollectionLoad($query);
if ($result != false) {
    $i = 1;
    foreach ($result as $keys => $value) {
        $subarray = array();
        $subarray[] = $i++;
        $subarray[] = $value['loanOfficer'];
        $subarray[] = $value['savings'];
        $subarray[] = $value['loan'];
        $subarray[] = $value['interest'];
        $subarray[] = $value['total'];
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
