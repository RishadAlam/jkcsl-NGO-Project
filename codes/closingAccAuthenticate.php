<?php

use controller\ClientRegController\ClientRegController;

include_once "../controller/ClientRegController.php";
// session_start();

$reg = new ClientRegController();

if (isset($_POST['savings_profile_id'])) {
    // Store data in variable
    $clientID = $_POST['clientID'];
    $savings_profile_id = $_POST['savings_profile_id'];
    $feild_id = $_POST['feild'];
    $center_id = $_POST['center'];
    $period_id = $_POST['period'];
    $book = $_POST['book'];
    $interest = $_POST['interest'];
    $total_balance = $_POST['total_balance'];
    $expression = $_POST['details'];
    $officers_id = $_SESSION['auth']['user_id'];
    // print_r($_POST);

    $result = $reg->savClosing($clientID, $savings_profile_id, $feild_id, $center_id, $period_id, $book, $interest, $total_balance, $expression, $officers_id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

if (isset($_POST['loanID'])) {
    // Store data in variable
    $loanID = $_POST['loanID'];
    $feild = $_POST['feild'];
    $center = $_POST['center'];
    $clientID = $_POST['clientID'];
    $period = $_POST['period'];
    $reserve = $_POST['reserve'];
    $balance = $_POST['balance'];
    $loan_remaining = $_POST['loan_remaining'];
    $interest_remaining = $_POST['interest_remaining'];
    $details = $_POST['details'];
    $total_loan = $_POST['total_loan'];
    $total_deposit = $_POST['total_deposit'];
    $total_interest = $_POST['total_interest'];
    $deposit_interest = $_POST['deposit_interest'];
    $book = $_POST['book'];
    $officers_id = $_SESSION['auth']['user_id'];

    $result = $reg->loanClosing($loanID, $feild, $center, $clientID, $period, $reserve, $balance, $loan_remaining, $interest_remaining, $details, $officers_id, $total_loan, $total_deposit, $total_interest, $deposit_interest, $book);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}
