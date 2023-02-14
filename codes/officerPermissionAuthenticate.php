<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

if (isset($_POST['officerID']) && isset($_POST['permissonLoad']) && $_POST['permissonLoad'] == '1') {
    $id = $_POST['officerID'];

    $query = "SELECT * FROM user_privileges WHERE user_id = '${id}' LIMIT 1";
    $result = $fields->clientAccLoad($query);

    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
if (isset($_POST['officerID']) && isset($_POST['permissonID'])) {
    $id = $_POST['officerID'];
    $regForm1 = $_POST['regForm1'];
    $regForm2 = $_POST['regForm2'];
    $regForm3 = $_POST['regForm3'];
    $regForm4 = $_POST['regForm4'];
    $regForm5 = $_POST['regForm5'];
    $regForm6 = $_POST['regForm6'];
    $regForm7 = $_POST['regForm7'];
    $collectionForm1 = $_POST['collectionForm1'];
    $collectionForm2 = $_POST['collectionForm2'];
    $withdrawalForm1 = $_POST['withdrawalForm1'];
    $withdrawalForm2 = $_POST['withdrawalForm2'];
    $closingForm1 = $_POST['closingForm1'];
    $closingForm2 = $_POST['closingForm2'];
    $collectionReport = $_POST['collectionReport'];
    $waitingWithdrawal = $_POST['waitingWithdrawal'];
    $field = $_POST['field'];
    $bookCheck = $_POST['bookCheck'];
    $expiredCollection = $_POST['expiredCollection'];
    $analytics = $_POST['analytics'];
    $clientAcc = $_POST['clientAcc'];

    if ($_POST['permissonID'] == "") {
        $query = "INSERT INTO user_privileges(user_id, regForm1, regForm2, regForm3, regForm4, regForm5, regForm6, regForm7, collectionForm1, collectionForm2, withdrawalForm1, withdrawalForm2, closingForm1, closingForm2, collectionReport, waitingWithdrawal, field, bookCheck, expiredCollection, analytics, clientAcc) VALUES ('${id}', '${regForm1}', '${regForm2}', '${regForm3}', '${regForm4}', '${regForm5}', '${regForm6}', '${regForm7}', '${collectionForm1}', '${collectionForm2}', '${withdrawalForm1}', '${withdrawalForm2}', '${closingForm1}', '${closingForm2}', '${collectionReport}', '${waitingWithdrawal}', '${field}', '${bookCheck}', '${expiredCollection}', '${analytics}', '${clientAcc}')";
    } else {
        $permissonID = $_POST['permissonID'];

        $query = "UPDATE user_privileges SET regForm1='${regForm1}',regForm2='${regForm2}',regForm3='${regForm3}',regForm4='${regForm4}',regForm5='${regForm5}',regForm6='${regForm6}',regForm7='${regForm7}',collectionForm1='${collectionForm1}',collectionForm2='${collectionForm2}',withdrawalForm1='${withdrawalForm1}',withdrawalForm2='${withdrawalForm2}',closingForm1='${closingForm1}',closingForm2='${closingForm2}',collectionReport='${collectionReport}',waitingWithdrawal='${waitingWithdrawal}',field='${field}',bookCheck='${bookCheck}',expiredCollection='${expiredCollection}',analytics='${analytics}',clientAcc='${clientAcc}' WHERE previlege_id = '${permissonID}'";
    }
    $result = $fields->userPermission($query);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}
