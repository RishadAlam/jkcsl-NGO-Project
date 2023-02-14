<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();
if (isset($_POST['loan_profile_id'])) {
    // Store data in variable
    $clientID = $_POST['clientID'];
    $loan_profile_id = $_POST['loan_profile_id'];
    $feild_id = $_POST['feild'];
    $center_id = $_POST['center'];
    $period_id = $_POST['period'];
    $book = $_POST['book'];
    $deposit = $_POST['deposit'];
    $loan = $_POST['loan'];
    $interest = $_POST['interest'];
    $total = $_POST['total'];
    $expression = $_POST['details'];
    $officers_id = $_SESSION['auth']['user_id'];

    $result = $collection->loanCollection($clientID, $loan_profile_id, $feild_id, $center_id, $period_id, $book, $deposit, $loan, $interest, $total, $expression, $officers_id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// collection edit
if (isset($_POST['loadEditid'])) {
    $deposit = $_POST['deposit'];
    $loan = $_POST['loan'];
    $interest = $_POST['interest'];
    $total = $_POST['total'];
    $details = $_POST['details'];
    $id = $_POST['loadEditid'];
    // echo $total;
    // die();

    $result = $collection->loanedit($id, $deposit, $loan, $interest, $total, $details);

    if ($result != false) {
        echo true;
    } else {
        echo false;
    }
}

// collection Delete
if (isset($_POST['dlt_load_collection_id'])) {
    $id = $_POST['dlt_load_collection_id'];
    $table = "loan_collections";
    // echo $total;
    // die();

    $result = $collection->deleteCollection($table, $id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Approved loan Collections
if (isset($_POST['loanAppID'])) {
    $id = $_POST['loanAppID'];
    // print_r($id);
    // die();

    $result = $collection->apprvLoanCollection($id);

    if ($result != false) {
        print_r($result);
    } else {
        echo false;
    }
}
