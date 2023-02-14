<?php

use controller\ClientRegController\ClientRegController;

include_once "../controller/ClientRegController.php";
$reg = new ClientRegController();


// Store Data
$feildID = $_POST['feild'];
$centerID = $_POST['center'];
$book = $_POST['book'];
$officerID = $_POST['officer'];
$periodID = $_POST['period'];
$deposit = $_POST['installment'];
$deposit_installment = $_POST['savings_installment'];
$expiry_date = $_POST['expiry_date'];
$interest = $_POST['interest'];
$total_w_ints = $_POST['total_taka_with_ints'];
$total_wt_ints = $_POST['total_taka_without_ints'];
$client_name = $_POST['name'];
$client_husband_name = $_POST['husband_name'];
$client_father_name = $_POST['father_name'];
$client_mother_name = $_POST['mother_name'];
$client_nid = $_POST['nid'];
$client_dob = $_POST['birth_reg_id_no'];
$client_occapasion = $_POST['occapasion'];
$religion = $_POST['religion'];
$client_gender = $_POST['gender'];
$phone_number = $_POST['phone_number'];
$phone_number_2 = $_POST['phone_number_2'];
$income = $_POST['income'];
$position = $_POST['position'];
$blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : null;
$bank_account = $_POST['bank_account'];
$check_no = $_POST['check_no'];

// Client Address
$client_home = $_POST['inputhome'];
$client_city = $_POST['inputCity'];
$client_holding = $_POST['holding'];
$client_sub_district = $_POST['sub_district'];
$client_district = $_POST['district'];
$client_post = $_POST['post'];
$client_state = $_POST['inputState'];
$client__p_home = $_POST['parmanent_inputAddress'];
$client__p_inputCity = $_POST['parmanent_inputCity'];
$client__p_holding = $_POST['parmanent_holding'];
$client__p_sub_district = $_POST['parmanent_sub_district'];
$client__p_post = $_POST['parmanent_post'];
$client__p_district = $_POST['parmanent_district'];
$client__p_inputState = $_POST['parmanent_inputState'];

// Client Full Address
$client_present_address = "বাড়ির এবং রাস্তাঃ " . $client_home . ", গ্রামঃ " . $client_city . ", ওয়ার্ড নম্বরঃ " . $client_holding . ", উপজেলাঃ " . $client_sub_district . ", পোষ্ট অফিসঃ " . $client_post . ", জেলাঃ " . $client_district . ", বিভাগঃ " . $client_state . "।";
// echo $client_present_address;
$client_permanent_address = "বাড়ির এবং রাস্তাঃ " . $client__p_home . ", গ্রামঃ " . $client__p_inputCity . ", ওয়ার্ড নম্বরঃ " . $client__p_holding . ", উপজেলাঃ " . $client__p_sub_district . ", পোষ্ট অফিসঃ " . $client__p_post . ", জেলাঃ " . $client__p_district . ", বিভাগঃ " . $client__p_inputState . "।";
// echo $client_permanent_address;

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
$client_img = $_FILES['client_pic']['name'];
$client_tmp_img = $_FILES['client_pic']['tmp_name'];
$client_img_size = $_FILES['client_pic']['size'];

// Store client Image Data
$nominee_img = $_FILES['nominee_pic']['name'];
$nominee_tmp_img = $_FILES['nominee_pic']['tmp_name'];
$nominee_img_size = $_FILES['nominee_pic']['size'];

// Image Validation Checking
if (!imgExtValidate($client_img) || !imgExtValidate($nominee_img)) {
    echo "image_ext_error";  // RETURN AN ERROR
} elseif (!imgSizeValidate($client_img_size) || !imgSizeValidate($nominee_img_size)) {
    echo "image_size_error";  // RETURN AN ERROR
} else {
    // Create image unique name
    $client_img_name = uniqid("client_") . "." . pathinfo($client_img, PATHINFO_EXTENSION);
    $nominee_img_name = uniqid("nominee_") . "." . pathinfo($nominee_img, PATHINFO_EXTENSION);

    // Image upload to the storage
    if (move_uploaded_file($client_tmp_img, "../img/" . $client_img_name) && move_uploaded_file($nominee_tmp_img, "../img/" . $nominee_img_name)) {
        $result = $reg->clientReg($feildID, $centerID, $periodID, $officerID, $book, $client_name, $client_husband_name, $client_father_name, $client_mother_name, $client_nid, $client_dob, $client_occapasion, $religion, $client_gender, $client_img_name, $phone_number, $phone_number_2, $income, $position, $blood_group, $bank_account, $check_no, $client_present_address, $client_permanent_address, $deposit, $expiry_date, $deposit_installment, $total_wt_ints, $interest, $total_w_ints, $nominee_name, $nominee_husband_name, $nominee_father_name, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $nominee_img_name, $Nominee_address);

        if ($result) {
            echo $result;
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}
