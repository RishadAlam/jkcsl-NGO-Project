<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

$days7 = date("Y-m-d", strtotime("+7days"));

// Savings Book Checks
$query = "SELECT chk.acc_check_id, chk.saving_profiles_id, chk.field_id, chk.center_id, chk.client_id, chk.book, DATE_FORMAT(chk.next_check_date, '%d-%m-%Y') AS next_check_date, DATE_FORMAT(chk.checked_at, '%d-%m-%Y') AS checked_at, s.balance, c.name, f.field_name, cn.center_name, p.period_name FROM savings_acc_checks AS chk INNER JOIN client_registers AS c ON c.client_id = chk.client_id INNER JOIN saving_profiles AS s ON s.saving_profiles_id = chk.saving_profiles_id INNER JOIN feilds AS f ON f.feild_id = chk.field_id INNER JOIN centers AS cn ON cn.center_id = chk.center_id INNER JOIN periods AS p ON p.period_id = chk.period_id WHERE chk.next_check_date BETWEEN CURRENT_DATE() AND '${days7}' AND chk.status = '1' ORDER BY chk.next_check_date";

$result = $fields->checkingACC($query);
// echo "<pre>";
// print_r($result);

if ($result != false) {
    foreach ($result as $row) {
        $from = '1';
        $sub = "বই নং " . $row['book'] . " | " . $row['period_name']  . " বই চেক";
        $details = "<bold>নামঃ</bold> " . $row['name']  . "  <br> <bold>বই নংঃ<bold> " . $row['book'] . "<br> <bold>ফিল্ডঃ</bold> " . $row['field_name']  . "  <br> <bold>কেন্দ্রঃ</bold> " . $row['center_name']  . "  <br> <bold>ক্ষেত্রঃ</bold> " . $row['period_name']  . "  <br> <bold>সর্বশেষ চেক ছিলোঃ</bold> " . $row['checked_at']  . " <br> <bold>পরবর্তি চেকঃ</bold> " . $row['next_check_date'] . "<br> " . $row['next_check_date'] . " তারিখের মধ্যে বইটি চেকের জন্য অফিসে আনার অনুরোধ করা হলো। <br>";

        $notif1 = "INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES ('${from}', '${sub}', '${details}', '0')";
        $fields->userPermission($notif1);
        // echo $sub . "<br>";
        // echo $details . "<br>";
    }
}

//Loan Books Checks
$query2 = "SELECT lhk.acc_check_id, lhk.loan_profile_id, lhk.field_id, lhk.center_id, lhk.client_id, lhk.book, DATE_FORMAT(lhk.next_check_date, '%d-%m-%Y') AS next_check_date, DATE_FORMAT(lhk.checked_at, '%d-%m-%Y') AS checked_at, l.balance, (l.loan_recover + l.interest_recover) AS loanRec, (l.loan_remaining + l.interest_remaining) AS loanRem, c.name, f.field_name, cn.center_name, p.period_name FROM loan_acc_checks AS lhk INNER JOIN client_registers AS c ON c.client_id = lhk.client_id INNER JOIN loan_profiles AS l ON l.loan_profile_id = lhk.loan_profile_id INNER JOIN feilds AS f ON f.feild_id = lhk.field_id INNER JOIN centers AS cn ON cn.center_id = lhk.center_id INNER JOIN periods AS p ON p.period_id = lhk.period_id WHERE lhk.next_check_date BETWEEN CURRENT_DATE() AND '${days7}' AND lhk.status = '1' ORDER BY lhk.next_check_date";

$result2 = $fields->checkingACC($query2);
// echo "<pre>";
// print_r($result2);

if ($result2 != false) {
    foreach ($result2 as $row) {
        $from = '1';
        $sub = "বই নং " . $row['book'] . " | " . $row['period_name']  . " বই চেক";
        $details = "<bold>নামঃ</bold> " . $row['name']  . "  <br> <bold>বই নংঃ<bold> " . $row['book'] . "<br> <bold>ফিল্ডঃ</bold> " . $row['field_name']  . "  <br> <bold>কেন্দ্রঃ</bold> " . $row['center_name']  . "  <br> <bold>ক্ষেত্রঃ</bold> " . $row['period_name']  . "  <br> <bold>সর্বশেষ চেক ছিলোঃ</bold> " . $row['checked_at']  . " <br> <bold>পরবর্তি চেকঃ</bold> " . $row['next_check_date'] . "<br> " . $row['next_check_date'] . " তারিখের মধ্যে বইটি চেকের জন্য অফিসে আনার অনুরোধ করা হলো। <br>";

        $notif2 = "INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES ('${from}', '${sub}', '${details}', '0')";
        $fields->userPermission($notif2);
        // echo $sub . "<br>";
        // echo $details . "<br>";
    }
}


// Tamadi Savings Books Check
$query3 = "UPDATE saving_profiles SET status='2' WHERE saving_profiles_id  IN (SELECT saving_profiles_id FROM savings_acc_checks WHERE next_check_date < CURRENT_DATE() AND status = '1')";

$result3 = $fields->userPermission($query3);

// Tamadi Loan Books Check
$query4 = "UPDATE loan_profiles SET status='2' WHERE loan_profile_id  IN (SELECT loan_profile_id FROM loan_acc_checks WHERE next_check_date < CURRENT_DATE() AND status = '1')";

$result4 = $fields->userPermission($query4);
