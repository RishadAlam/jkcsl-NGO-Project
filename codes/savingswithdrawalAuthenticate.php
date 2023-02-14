<?php

use controller\CollectionController\CollectionController\CollectionController;



include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

// Store data in variable
$clientID = $_POST['clientID'];
$savings_profile_id = $_POST['savings_profile_id'];
$feild_id = $_POST['feild'];
$center_id = $_POST['center'];
$period_id = $_POST['period'];
$book = $_POST['book'];
$withdraw = $_POST['withdraw'];
$balance_remaining = $_POST['balance_remaining'];
$expression = $_POST['details'];
$officers_id = $_POST['officerID'];
// print_r($_POST);

$result = $collection->savingswithdrawal($clientID, $savings_profile_id, $feild_id, $center_id, $period_id, $book, $withdraw, $balance_remaining, $expression, $officers_id);

if ($result != false) {
    echo $result;
} else {
    echo false;
}
