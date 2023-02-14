<?php

use controller\dataLoadController\dataLoadController\dataLoadController;



include_once "../controller/dataLoadController.php";

$load = new dataLoadController();

if (isset($_POST['card']) && $_POST['card'] == 1) {
    $officer_id = null;
    if ($_SESSION['auth']['user_role']) {
        $officer_id = $_SESSION['auth']['user_id'];
    }

    // echo json_encode($officer_id);
    // die();

    $result = $load->cardsLoad($officer_id);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
