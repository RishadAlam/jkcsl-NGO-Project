<?php

use controller\RegController\RegController\RegController;



include_once "../controller/RegController.php";
$reg = new RegController();

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $deposit = $_POST['fdr_deposit'];
    $start_date = $_POST['start_date'];
    $expiry_date = $_POST['expiry_date'];
    $dec = $_POST['dec'];
    $officer_id = $_SESSION['auth']['user_id'];

    $result = $reg->fdrReg($name, $deposit, $start_date, $expiry_date, $dec, $officer_id);

    if ($result != false) {
        echo $result;
    } else {
        echo true;
    }
}

if (isset($_POST['fdrID'])) {
    $fdrID = $_POST['fdrID'];
    $name = $_POST['up_name'];
    $deposit = $_POST['up_fdr_deposit'];
    $start_date = $_POST['up_start_date'];
    $expiry_date = $_POST['up_expiry_date'];
    $dec = $_POST['up_details'];

    $result = $reg->fdrupdate($fdrID, $name, $deposit, $start_date, $expiry_date, $dec);

    if ($result != false) {
        echo $result;
    } else {
        echo true;
    }
}

if (isset($_POST['income'])) {
    $income = $_POST['income'];
    $date = $_POST['date'];
    $dec = $_POST['dec'];
    $officer_id = $_SESSION['auth']['user_id'];

    $result = $reg->incomeReg($income, $date, $dec, $officer_id);

    if ($result != false) {
        echo $result;
    } else {
        echo true;
    }
}

if (isset($_POST['expence'])) {
    $type = $_POST['type'];
    $expence = $_POST['expence'];
    $date = $_POST['date'];
    $dec = $_POST['dec'];
    $officer_id = $_SESSION['auth']['user_id'];
    $fdrID = null;
    if (isset($_POST['id'])) {
        $fdrID = $_POST['id'];
    }
    $result = $reg->expenceReg($expence, $date, $dec, $officer_id, $type, $fdrID);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

if (isset($_POST['officer'])) {
    $officer = $_POST['officer'];
    $sub = $_POST['sub'];
    $details = $_POST['details'];
    $officer_id = $_SESSION['auth']['user_id'];

    $result = $reg->sendMSGReg($officer_id, $officer, $sub, $details);

    if ($result != false) {
        echo $result;
    } else {
        echo true;
    }
}

if (isset($_POST['fdrSwitchID'])) {
    $id = $_POST['fdrSwitchID'];
    $status = $_POST['status'];

    $result = $reg->fdrSwitch($id, $status);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Income Update
if (isset($_POST['update_income'])) {
    $income = $_POST['update_income'];
    $date = $_POST['update_date'];
    $dec = $_POST['update_dec'];
    $id = $_POST['id'];

    $result = $reg->incomeUpdate($income, $date, $dec, $id);

    if ($result != false) {
        echo true;
    } else {
        echo false;
    }
}

// Income Delete
if (isset($_POST['dlt_income_id'])) {
    $id = $_POST['dlt_income_id'];

    $result = $reg->incomeDelete($id);

    if ($result != false) {
        echo true;
    } else {
        echo false;
    }
}

// Ecpence Update 1
if (isset($_POST['update_expence'])) {
    $expence = $_POST['update_expence'];
    $date = $_POST['update_date'];
    $dec = $_POST['update_dec'];
    $id = $_POST['id'];

    $result = $reg->expenceUpdate($expence, $date, $dec, $id);

    if ($result != false) {
        echo true;
    } else {
        echo false;
    }
}

// Ecpence Delete 1
if (isset($_POST['dlt_expence_id'])) {
    $id = $_POST['dlt_expence_id'];

    $result = $reg->expenceDelete($id);

    if ($result != false) {
        echo true;
    } else {
        echo false;
    }
}
