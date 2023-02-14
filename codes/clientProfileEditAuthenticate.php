<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();


// print_r($_POST['blood_group']);
// print_r($_FILES);
// die();

$id = $_POST['up_id'];
$name = $_POST['name'];
$husband_name = $_POST['husband_name'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$nid = $_POST['nid'];
$birth_reg_id_no = $_POST['birth_reg_id_no'];
$up_occapasion = $_POST['up_occapasion'];
$up_religion = $_POST['up_religion'];
$up_gender = $_POST['up_gender'];
$phone_number = $_POST['phone_number'];
$phone_number_2 = $_POST['phone_number_2'];
$income = $_POST['income'];
$up_position = $_POST['up_position'];
$blood_group = (isset($_POST['blood_group']) ? $_POST['blood_group'] : "null");
$bank_account = $_POST['bank_account'];
$check_no = $_POST['check_no'];
$old_pic = $_POST['old_pic'];
$up_present_address = $_POST['up_present_address'];
$up_parmanent_address = $_POST['up_parmanent_address'];


if ($_FILES['client_pic']['name']) {
    $client_img = $_FILES['client_pic']['name'];
    $client_tmp_img = $_FILES['client_pic']['tmp_name'];
    $client_img_size = $_FILES['client_pic']['size'];

    if (!imgExtValidate($client_img)) {
        echo "image_ext_error";  // RETURN AN ERROR
    } elseif (!imgSizeValidate($client_img_size)) {
        echo "image_size_error";  // RETURN AN ERROR
    } else {
        // Create image unique name
        $client_img_name = uniqid("client_") . "." . pathinfo($client_img, PATHINFO_EXTENSION);

        if ($old_pic != "") {
            if (unlink('../img/' . $old_pic)) {
                // Image upload to the storage
                if (move_uploaded_file($client_tmp_img, "../img/" . $client_img_name)) {

                    $result = $fields->clientEdit($id, $name, $husband_name, $father_name, $mother_name, $nid, $birth_reg_id_no, $up_occapasion, $up_religion, $up_gender, $phone_number, $phone_number_2, $income, $up_position, $blood_group, $bank_account, $check_no, $up_present_address, $up_parmanent_address, $client_img_name);
                } else {
                    echo false;
                }
            } else {
                echo false; // DATA DOES NOT INSERTED
            }
        } else {
            if (move_uploaded_file($client_tmp_img, "../img/" . $client_img_name)) {

                $result = $fields->clientEdit($id, $name, $husband_name, $father_name, $mother_name, $nid, $birth_reg_id_no, $up_occapasion, $up_religion, $up_gender, $phone_number, $phone_number_2, $income, $up_position, $blood_group, $bank_account, $check_no, $up_present_address, $up_parmanent_address, $client_img_name);
            } else {
                echo false;
            }
        }
        // Image upload to the storage
        if ($result) {
            echo $result;
        } else {
            echo false;
        }
    }
} else {
    $result = $fields->clientEdit($id, $name, $husband_name, $father_name, $mother_name, $nid, $birth_reg_id_no, $up_occapasion, $up_religion, $up_gender, $phone_number, $phone_number_2, $income, $up_position, $blood_group, $bank_account, $check_no, $up_present_address, $up_parmanent_address);

    if ($result) {
        echo $result;
    } else {
        echo false;
    }
}
