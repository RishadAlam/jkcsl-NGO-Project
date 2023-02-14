<?php

use controller\ClientRegController\ClientRegController;

include_once "../controller/ClientRegController.php";
$reg = new ClientRegController();


// Store Data
$feildID = $_POST['feild'];
$centerID = $_POST['center'];
$clientID = $_POST['book'];
$book = $_POST['book_no'];
$officerID = $_POST['officer'];
$periodID = $_POST['period'];
$deposit = $_POST['installment'];
$deposit_installment = $_POST['savings_installment'];
$expiry_date = $_POST['expiry_date'];
$interest = $_POST['interest'];
$total_w_ints = $_POST['total_taka_with_ints'];
$total_wt_ints = $_POST['total_taka_without_ints'];


// Nominee Data
$nominee_name = $_POST['nominee_name'];
$nominee_husband_name = $_POST['nominee_husband_name'];
$nominee_father_name = $_POST['nominee_father_name'];
$nominee_mother_name = $_POST['nominee_mother_name'];
$nominee_birth_reg_id_no = $_POST['nominee_birth_reg_id_no'];
$nominee_nid = $_POST['nominee_nid'];
$nominee_occapasion = $_POST['nominee_occapasion'];
$relation = $_POST['relation'];
$nominee_gender = $_POST['nominee_gender'];
$nominee_home = $_POST['nominee_input_home'];
$nominee_city = $_POST['nominee_input_city'];
$nominee_holding = $_POST['nominee_holding'];
$nominee_sub_district = $_POST['nominee_sub_district'];
$nominee_post = $_POST['nominee_post'];
$nominee_district = $_POST['nominee_district'];
$nominee_state = $_POST['nominee_input_state'];

// Nominee Full Address
$Nominee_address = "বাড়ির এবং রাস্তাঃ " . $nominee_home . ", গ্রামঃ " . $nominee_city . ", ওয়ার্ড নম্বরঃ " . $nominee_holding . ", উপজেলাঃ " . $nominee_sub_district . ", পোষ্ট অফিসঃ " . $nominee_post . ", জেলাঃ " . $nominee_district . ", বিভাগঃ " . $nominee_state . "।";
// echo $Nominee_address;

// Store client Image Data
$nominee_img = $_FILES['nominee_pic']['name'];
$nominee_tmp_img = $_FILES['nominee_pic']['tmp_name'];
$nominee_img_size = $_FILES['nominee_pic']['size'];

// Image Validation Checking
if (!imgExtValidate($nominee_img)) {
    echo "image_ext_error";  // RETURN AN ERROR
} elseif (!imgSizeValidate($nominee_img_size)) {
    echo "image_size_error";  // RETURN AN ERROR
} else {
    // Create image unique name
    $nominee_img_name = uniqid("nominee_") . "." . pathinfo($nominee_img, PATHINFO_EXTENSION);

    // Image upload to the storage
    if (move_uploaded_file($nominee_tmp_img, "../img/" . $nominee_img_name)) {
        $result = $reg->savingsReg($feildID, $centerID, $periodID, $officerID, $clientID, $book, $deposit, $expiry_date, $deposit_installment, $total_wt_ints, $interest, $total_w_ints, $nominee_name, $nominee_husband_name, $nominee_father_name, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $nominee_img_name, $Nominee_address);

        if ($result) {
            echo $result;
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}
