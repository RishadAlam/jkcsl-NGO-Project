<?php

use controller\RegController\RegController\RegController;



include_once "../controller/RegController.php";
$reg = new RegController();

// Store User primary Data
$name = $_POST['name'];
$nid = ($_POST['nid'] != '') ? $_POST['nid'] : null;
$phone_number = $_POST['phone_number'];
$phone_number_2 = ($_POST['phone_number_2'] != '') ? $_POST['phone_number_2'] : null;
$dob = $_POST['dob'];
$blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : null;
$email = $_POST['email'];
$role = $_POST['role'];
$fromEmail = "contact@jonokollan.com";
$headers = "From: " . $fromEmail;
$token = bin2hex(random_bytes(16));
$url = baseUrl('activate-account') . '?email=' . $email . '&&token=' . $token;
$subject = "Account Activation";
$body = "হ্যালো ${name}, আপনার অ্যাকাউন্ট সক্রিয় করতে হবে । আপনার অ্যাকাউন্ট সক্রিয় করতে এখানে ক্লিক করুন: ${url}";

// var_dumb(mail($email, $subject, $body, $headers));

//         die();

// Checking image is exists or not
if (strlen($_FILES['client_pic']['name']) != 0) {

    // Store User Image Data
    $img = $_FILES['client_pic']['name'];
    $tmp_img = $_FILES['client_pic']['tmp_name'];
    $img_size = $_FILES['client_pic']['size'];

    // Image Validation Checking
    if (!imgExtValidate($img)) {
        echo "image_ext_error";  // RETURN AN ERROR
    } elseif (!imgSizeValidate($img_size)) {
        echo "image_size_error";  // RETURN AN ERROR
    } else {

        // Create image unique name
        $img_name = uniqid("user_") . "." . pathinfo($img, PATHINFO_EXTENSION);

        // Image upload to the storage
        if (move_uploaded_file($tmp_img, "../img/" . $img_name)) {
            // After upload image data will be store in database
            $result = $reg->userReg($email, $name, $nid, $phone_number, $phone_number_2, $blood_group, $dob, $role, "2", $token, $img_name);
            if ($result) {
                if (mail($email, $subject, $body, $headers)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false; // DATA DOES NOT INSERTED
            }
        } else {
            echo false; // DATA DOES NOT INSERTED
        }
    }
} else {
    $result = $reg->userReg($email, $name, $nid, $phone_number, $phone_number_2, $blood_group, $dob, $role, "2", $token);
    if ($result) {
        if (mail($email, $subject, $body, $headers)) {
            echo true;
        } else {
            echo false;
        }
    } else {
        echo false; // DATA DOES NOT INSERTED
    }
}
