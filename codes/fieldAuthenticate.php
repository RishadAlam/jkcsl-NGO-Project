<?php

use controller\RegController\RegController\RegController;


include_once "../controller/RegController.php";
$reg = new RegController();

if (isset($_POST['field_name'])) {
    // Store Field primary Data
    $field_name = $_POST['field_name'];
    $field_dec = $_POST['field_dec'];
    $result = $reg->fieldReg($field_name, $field_dec);
    if ($result) {
        echo $result; // DATA SUCCESSFULLY INSERTED
    } else {
        echo false; // DATA DOES NOT INSERTED
    }
}

if (isset($_POST['center_name'])) {
    // Store Field primary Data
    $center_name = $_POST['center_name'];
    $center_details = $_POST['details'];
    $feild = $_POST['feild'];

    $result = $reg->centerReg($center_name, $center_details, $feild);
    if ($result) {
        echo $result; // DATA SUCCESSFULLY INSERTED
    } else {
        echo false; // DATA DOES NOT INSERTED
    }
}

if (isset($_POST['period_name'])) {
    // Store Field primary Data
    $period_name = $_POST['period_name'];
    $period = $_POST['period'];
    $period_type = $_POST['period_type'];
    $period_details = $_POST['period_details'];

    $result = $reg->periodReg($period_name, $period, $period_type, $period_details);
    if ($result) {
        echo $result; // DATA SUCCESSFULLY INSERTED
    } else {
        echo false; // DATA DOES NOT INSERTED
    }
}
