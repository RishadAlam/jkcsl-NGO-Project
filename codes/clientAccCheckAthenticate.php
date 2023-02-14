<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

if (isset($_POST['savingsCheckID'])) {
    $savingsID = $_POST['savingsCheckID'];
    $checkID = $_POST['checkID'];

    $result = $fields->savingsAccChecking($savingsID, $checkID);
    if ($result != false && $result != null) {
        echo $result;
    } else {
        echo false;
    }
}
if (isset($_POST['loanCheckID'])) {
    $loanCheckID = $_POST['loanCheckID'];
    $checkID = $_POST['checkID'];

    $result = $fields->loanAccChecking($loanCheckID, $checkID);
    if ($result != false && $result != null) {
        echo $result;
    } else {
        echo false;
    }
}

// Tamadi

if (isset($_POST['TamadiSavingsCheckID'])) {
    $savingsID = $_POST['TamadiSavingsCheckID'];
    $checkID = $_POST['checkID'];

    $result = $fields->tamadiSavingsAccChecking($savingsID, $checkID);
    if ($result != false && $result != null) {
        echo $result;
    } else {
        echo false;
    }
}
if (isset($_POST['TamadiLoanCheckID'])) {
    $loanCheckID = $_POST['TamadiLoanCheckID'];
    $checkID = $_POST['checkID'];

    $result = $fields->tamadiLoanAccChecking($loanCheckID, $checkID);
    if ($result != false && $result != null) {
        echo $result;
    } else {
        echo false;
    }
}
