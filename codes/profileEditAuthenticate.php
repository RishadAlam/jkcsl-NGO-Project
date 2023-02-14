<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

// Credentials update
if (isset($_POST['client_id'])) {
    $id = $_POST['client_id'];
    $feildID = $_POST['feild'];
    $centerID = $_POST['center'];

    $result = $fields->credentialsUpdate($id, $feildID, $centerID);

    if ($result) {
        print_r($result);
    } else {
        echo var_dump($result);
    }
}

// Savings Profile Edit Load
if (isset($_POST['SavingProfileEdit']) && isset($_POST['savingID']) && $_POST['SavingProfileEdit'] == 1) {

    $savingID = $_POST['savingID'];

    $query = "SELECT saving.saving_profiles_id, saving.period_id, saving.book, saving.deposit_installment, saving.duration, saving.total_installment, saving.total_without_interest, saving.interest, saving.total_with_interest, saving.nominee_name, saving.nominee_husband, saving.nominee_father, saving.nominee_mother, saving.nominee_dob, saving.nominee_nid, saving.nominee_occupation, saving.nominee_relation, saving.nominee_gendar, saving.nominee_img, saving.nominee_address, register.name FROM saving_profiles AS saving INNER JOIN client_registers AS register ON register.client_id = saving.client_id WHERE saving_profiles_id = '${savingID}' LIMIT 1";

    $result = $fields->fieldCardsLoad($query);


    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Savings Profile Update
if (isset($_POST['saving_id'])) {

    $id = $_POST['saving_id'];
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
    $nomine_address = $_POST['nomine_address'];
    $old_pic = $_POST['old_pic'];


    // Image Validation Checking
    if (isset($_FILES['nominee_pic']['name']) && $_FILES['nominee_pic']['name'] != null) {
        // Store client Image Data
        $nominee_img = $_FILES['nominee_pic']['name'];
        $nominee_tmp_img = $_FILES['nominee_pic']['tmp_name'];
        $nominee_img_size = $_FILES['nominee_pic']['size'];

        if (!imgExtValidate($nominee_img)) {
            echo "image_ext_error";  // RETURN AN ERROR
        } elseif (!imgSizeValidate($nominee_img_size)) {
            echo "image_size_error";  // RETURN AN ERROR
        } else {
            if (unlink('../img/' . $old_pic)) {
                // Create image unique name
                $nominee_img_name = uniqid("nominee_") . "." . pathinfo($nominee_img, PATHINFO_EXTENSION);

                // Image upload to the storage
                if (move_uploaded_file($nominee_tmp_img, "../img/" . $nominee_img_name)) {
                    $result = $fields->savingsReg($id, $periodID, $deposit, $expiry_date, $deposit_installment, $total_wt_ints, $interest, $total_w_ints, $nominee_name, $nominee_husband_name, $nominee_father_name, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $nomine_address, $nominee_img_name);

                    if ($result) {
                        print_r($result);
                    } else {
                        echo false;
                    }
                } else {
                    echo false;
                }
            } else {
                echo false; // DATA DOES NOT INSERTED
            }
        }
    } else {
        $result = $fields->savingsReg($id, $periodID, $deposit, $expiry_date, $deposit_installment, $total_wt_ints, $interest, $total_w_ints, $nominee_name, $nominee_husband_name, $nominee_father_name, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $nomine_address);

        if ($result) {
            print_r($result);
        } else {
            echo var_dump($result);
        }
    }
}

// Loan Profile Edit Load
if (isset($_POST['LoanProfileEdit']) && isset($_POST['loanID']) && $_POST['LoanProfileEdit'] == 1) {

    $loanID = $_POST['loanID'];

    $query = "SELECT loan.loan_profile_id, loan.period_id, loan.book, loan.savings, loan.total_loan, loan.duration, loan.total_intsallment, loan.interest, loan.loan_installment, loan.interest_installment, loan.total_interest, loan.total_loan_w_ints, loan.nominee_name, loan.nominee_husband, loan.nominee_father, loan.nominee_mother, loan.nominee_dob, loan.nominee_nid, loan.nominee_occupation, loan.nominee_relation, loan.nominee_gendar, loan.nominee_img, loan.nominee_address, register.name FROM loan_profiles AS loan INNER JOIN client_registers AS register ON register.client_id = loan.client_id WHERE loan_profile_id = '${loanID}' LIMIT 1";

    $result = $fields->fieldCardsLoad($query);


    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

if (isset($_POST['loan_id'])) {

    $id = $_POST['loan_id'];
    $periodID = $_POST['period'];
    $deposit = $_POST['deposit'];
    $loan_given = $_POST['loan_given'];
    $installment = $_POST['installment'];
    $expiry_date = $_POST['expiry_date'];
    $interest = $_POST['interest'];
    $total_w_ints = $_POST['total_taka_with_int'];
    $total_interest = $_POST['total_interest'];
    $loan_installment = $_POST['loan_installment'];
    $interest_installment = $_POST['interest_installment'];


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
    $nomine_address = $_POST['nomine_address'];
    $old_pic = $_POST['old_pic'];


    // Image Validation Checking
    if (isset($_FILES['nominee_pic']['name']) && $_FILES['nominee_pic']['name'] != null) {
        // Store client Image Data
        $nominee_img = $_FILES['nominee_pic']['name'];
        $nominee_tmp_img = $_FILES['nominee_pic']['tmp_name'];
        $nominee_img_size = $_FILES['nominee_pic']['size'];

        if (!imgExtValidate($nominee_img)) {
            echo "image_ext_error";  // RETURN AN ERROR
        } elseif (!imgSizeValidate($nominee_img_size)) {
            echo "image_size_error";  // RETURN AN ERROR
        } else {
            if (unlink('../img/' . $old_pic)) {
                // Create image unique name
                $nominee_img_name = uniqid("nominee_") . "." . pathinfo($nominee_img, PATHINFO_EXTENSION);

                // Image upload to the storage
                if (move_uploaded_file($nominee_tmp_img, "../img/" . $nominee_img_name)) {
                    $result = $fields->loanRegEdit($id, $periodID, $deposit, $loan_given, $installment, $expiry_date, $total_w_ints, $total_interest, $interest, $loan_installment, $interest_installment, $nominee_name, $nominee_husband_name, $nominee_father_name, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $nomine_address, $nominee_img_name);

                    if ($result) {
                        print_r($result);
                    } else {
                        echo false;
                    }
                } else {
                    echo false;
                }
            } else {
                echo false; // DATA DOES NOT INSERTED
            }
        }
    } else {
        $result = $fields->loanRegEdit($id, $periodID, $deposit, $loan_given, $installment, $expiry_date, $total_w_ints, $total_interest, $interest, $loan_installment, $interest_installment, $nominee_name, $nominee_husband_name, $nominee_father_name, $nominee_mother_name, $nominee_birth_reg_id_no, $nominee_nid, $nominee_occapasion, $relation, $nominee_gender, $nomine_address);

        if ($result) {
            print_r($result);
        } else {
            echo var_dump($result);
        }
    }
}

// Savings Profile Deletes
if (isset($_POST['savingDelete']) && isset($_POST['id']) && $_POST['savingDelete'] == 1) {

    $id = $_POST['id'];
    $result = $fields->savingAccDelete($id);

    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Loan Profile Deletes
if (isset($_POST['loanDelete']) && isset($_POST['id']) && $_POST['loanDelete'] == 1) {

    $id = $_POST['id'];
    $result = $fields->loanAccDelete($id);

    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Register Delete
if (isset($_POST['registerDelete']) && isset($_POST['id']) && $_POST['registerDelete'] == 1) {

    $id = $_POST['id'];
    $result = $fields->registerDelete($id);

    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
