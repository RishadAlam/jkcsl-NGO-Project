<?php

use controller\RegController\RegController\RegController;



include_once "../controller/RegController.php";
$reg = new RegController();

// Store User primary Data
$name = $_POST['name'];
$nid = ($_POST['nid'] != '') ? $_POST['nid'] : null;
$phone_number = $_POST['phone_number'];
$phone_number_2 = ($_POST['phone_number_2'] != '') ? $_POST['phone_number_2'] : null;
$dob = $_POST['edit_dob'];
$blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : null;
$old_pic = $_POST['old_pic'];
$id = $_POST['off_id'];


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

        if ($old_pic != "") {
            if (unlink('../img/' . $old_pic)) {
                // Image upload to the storage
                if (move_uploaded_file($tmp_img, "../img/" . $img_name)) {
                    // After upload image data will be store in database
                    $result = $reg->userUpdate($name, $nid, $phone_number, $phone_number_2, $blood_group, $dob, $id, $img_name);
                    if ($result != false) {
                        $_SESSION['auth']['user_img'] = $img_name;
                        echo $result; // DATA SUCCESSFULLY INSERTED
                    } else {
                        echo false; // DATA DOES NOT INSERTED
                    }
                } else {
                    echo false; // DATA DOES NOT INSERTED
                }
            } else {
                echo false; // DATA DOES NOT INSERTED
            }
        } else {
            if (move_uploaded_file($tmp_img, "../img/" . $img_name)) {
                // After upload image data will be store in database
                $result = $reg->userUpdate($name, $nid, $phone_number, $phone_number_2, $blood_group, $dob, $id, $img_name);
                if ($result != false) {
                    echo $result; // DATA SUCCESSFULLY INSERTED
                } else {
                    echo false; // DATA DOES NOT INSERTED
                }
            } else {
                echo false; // DATA DOES NOT INSERTED
            }
        }
    }
} else {

    // $user = array("email" => $email, "name" => $name, "nid" => $nid, "mobile_1" => $phone_number, "mobile_2" => $phone_number_2, "blood" => $blood_group, "dob" => $dob, "role" => $role, "status" => "2");
    $result = $reg->userUpdate($name, $nid, $phone_number, $phone_number_2, $blood_group, $dob, $id);
    if ($result) {
        echo $result; // DATA SUCCESSFULLY INSERTED
    } else {
        echo false; // DATA DOES NOT INSERTED
    }
}
