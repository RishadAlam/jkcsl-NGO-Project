<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$days7 = date("Y-m-d", strtotime("+7days"));
$days3 = date("Y-m-d", strtotime("+3days"));
$today = date("Y-m-d");
// echo $today;

$query = "SELECT lhk.acc_check_id, lhk.loan_profile_id, lhk.field_id, lhk.center_id, lhk.client_id, lhk.book, DATE_FORMAT(lhk.next_check_date, '%d-%m-%Y') AS next_check_date, DATE_FORMAT(lhk.checked_at, '%d-%m-%Y') AS checked_at, l.balance, (l.loan_recover + l.interest_recover) AS loanRec, (l.loan_remaining + l.interest_remaining) AS loanRem, c.name, f.field_name, cn.center_name, p.period_name FROM loan_acc_checks AS lhk INNER JOIN client_registers AS c ON c.client_id = lhk.client_id INNER JOIN loan_profiles AS l ON l.loan_profile_id = lhk.loan_profile_id INNER JOIN feilds AS f ON f.feild_id = lhk.field_id INNER JOIN centers AS cn ON cn.center_id = lhk.center_id INNER JOIN periods AS p ON p.period_id = lhk.period_id WHERE lhk.next_check_date BETWEEN CURRENT_DATE() AND '${days7}' AND lhk.status = '1' ORDER BY lhk.next_check_date";

$result = $fields->checkingACC($query);
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
        $subarray[] = $value['loanRec'];
        $subarray[] = $value['loanRem'];
        $subarray[] = $value['checked_at'];
        $subarray[] = $value['next_check_date'];
        $subarray[] = '<a href="' . baseUrl('loan-profile-stm') . '?field=' . $value['field_id'] . '&&center=' . $value['center_id'] . '&&client=' . $value['client_id'] . '&&loans=' . $value['loan_profile_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bx-folder-open"></i></span></a>';
        $subarray[] = '<div class="form-check form-switch text-center">
                            <input class="form-check-input" name="loanAction" type="checkbox" data-checkID="' . $value['acc_check_id'] . '" role="switch" id="' . $value['loan_profile_id'] . '">
                            <label class="form-check-label" for="' . $value['loan_profile_id'] . '"></label>
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
