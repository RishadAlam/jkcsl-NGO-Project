<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

// Client Profile Load
if (isset($_POST['clientSavings']) && isset($_POST['clientID']) && $_POST['clientSavings'] == 1) {

    $clientID = $_POST['clientID'];

    $query = "SELECT s.*, p.period_name, u.name FROM saving_profiles AS s INNER JOIN periods AS p ON p.period_id = s.period_id INNER JOIN users AS u ON u.id = s.reg_officer_id WHERE s.client_id = '${clientID}'";

    $result = $fields->clientAccLoad($query);

    $output = "";
    if ($result != false) {
        // echo json_encode($result);
        foreach ($result as $key => $row) {
            $output .= '<li>
                            <input type="radio" id="tab-' . $row['saving_profiles_id'] . '" name="tab"';
            if ($key == 0) {
                $output .=  'checked';
            }
            $output .=      '/>
                            <label for="tab-' . $row['saving_profiles_id'] . '">
                                ' . $row['period_name'] . '
                            </label>
                            <div class="tab-content">
                                <div class="savings_info">
                                    <div class="row">
                                        <div class="form_section_heading pb-1 shadow my-3">
                                            <h4>' . $row['period_name'] . ' সঞ্চয় তথ্যাবলি</h4>
                                        </div>
                                        <div class="client_info row">
                                            <div class="col-md-6 my-3">
                                                <p>একাউন্ট <span class="d-inline-block py-1 px-4 text-capitalize';
            if ($row['status'] == 1) {
                $output .= ' bg-success ';
            } elseif ($row['status'] == 2) {
                $output .= ' bg-warning ';
            } else {
                $output .= ' bg-danger ';
            }
            $output .=                       'rounded" style="color: #fff; font-size: 18px;">';
            if ($row['status'] == 1) {
                $output .= 'ACTIVE';
            } elseif ($row['status'] == 2) {
                $output .= 'HOLD';
            } else {
                $output .= 'DEACTIVE';
            }
            $output .=                      '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>একাউন্ট হিসাব <a href="' . baseUrl('savings-profile-stm') . '?field=' . $row['field_id'] . '&&center=' . $row['center_id'] . '&&client=' . $row['client_id'] . '&&savings=' . $row['saving_profiles_id'] . '" class="d-inline-block p-3 text-capitalize bg-primary rounded" style="color: #fff; font-size: 18px;"><span style="cursor: pointer; font-size: 26px;"><i class="bx bxs-user-account d-block"></i></span></a></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>সঞ্চয় কিস্তির পরিমাণঃ <span>' . $row['deposit_installment'] . ' টাকা</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>শুরুর তারিখঃ <span>' . date("d M Y", strtotime($row['created_at'])) . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>সঞ্চয়ের মেয়াদকালঃ <span>' . date("d M Y", strtotime($row['duration'])) . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>লাভঃ <span>' . $row['interest'] . '%</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>সর্বমোট টাকা (লাভ ছাড়া): <span>' . $row['total_without_interest'] . ' টাকা</span></p>
                                            </div>
                                            <div class="col-md-6 my-3 ">
                                                <p>সর্বমোট টাকা (লাভ সহ): <span>' . $row['total_with_interest'] . ' টাকা</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>নিবন্ধন অফিসার: <span>' . $row['name'] . '</span></p>
                                            </div>
                                        </div>
                                        <div class="form_section_heading pb-1 shadow my-3">
                                            <h4>নমিনির তথ্যাবলি</h4>
                                        </div>
                                        <div class="client_info row">
                                            <div class="col-md-6 my-3">
                                                <p>নামঃ <span>' . $row['nominee_name'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>স্বামীঃ <span>' . $row['nominee_husband'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>পিতাঃ <span>' . $row['nominee_father'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>মাতাঃ <span>' . $row['nominee_mother'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>জাতীয় পরিচয় পত্রের নম্বরঃ <span>' . $row['nominee_nid'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>জন্ম তারিখঃ <span>' . date("d M Y", strtotime($row['nominee_dob'])) . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>লিঙ্গঃ <span>' . $row['nominee_gendar'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>পেশাঃ <span>' . $row['nominee_occupation'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>সম্পর্কঃ <span>' . $row['nominee_relation'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>ছবিঃ <span class="text-end"><img style="width: 50%;" src="./img/' . $row['nominee_img'] . '" alt=""></span></p>
                                            </div>
                                        </div>
                                        <div class="form_section_heading pb-1 shadow my-3">
                                            <h4>নমিনির ঠিকানা</h4>
                                        </div>
                                        <div class="present_address row">
                                            <div class="col-md-12 my-3">
                                                <p>' . $row['nominee_address'] . '</p>
                                            </div>
                                        </div>
                                        <div class="form_section_heading pb-1 shadow my-3">
                                            <h4>ক্লোজিং</h4>
                                        </div>
                                        <div class="present_address row">
                                            <div class="col-md-6 my-3">
                                                <p>লাভ প্রদানঃ <span>' . $row['closing_interest'] . ' টাকা</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>সঞ্চয় প্রদান (লাভ সহ): <span>' . $row['closing_balance_with_interest'] . ' টাকা</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>মন্তব্যঃ <span>' . $row['closing_expression'] . '</span></p>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <p>ক্লোজিং তারিখঃ <span>' . date("d M Y", strtotime($row['closing_at'])) . '</span></p>
                                            </div>
                                        </div>';
            if ($row['status'] == '0' && $_SESSION['auth']['user_role'] == '0') {
                $output .= '<button data-id="' . $row['saving_profiles_id'] . '" id="savings_delete" class="btn btn-sm my-3 px-3 form-control rounden bg-danger text-center d-inline-block text-white">DELETE</button>';
            } else {
                $output .= '<a href="' . baseUrl('/savings-account-edit-form') . '?field=' . $row['field_id'] . '&&center=' . $row['center_id'] . '&client=' . $row['client_id'] . '&&savings=' . $row['saving_profiles_id'] . '" class="btn btn-sm my-3 px-3 form-control rounden bg-warning text-center d-inline-block text-black">EDIT</a>';
            }

            $output .= '</div>
                                </div>
                            </div>
                        </li>';
        }
        echo $output;
    } else {
        echo (false);
    }
}
// Client Profile Load
if (isset($_POST['clientLoan']) && isset($_POST['clientID']) && $_POST['clientLoan'] == 1) {

    $clientID = $_POST['clientID'];

    $query = "SELECT l.*, p.period_name, u.name FROM loan_profiles AS l INNER JOIN periods AS p ON p.period_id = l.period_id INNER JOIN users AS u ON u.id = l.reg_officer_id WHERE l.client_id = '${clientID}'";

    $result = $fields->clientAccLoad($query);

    $output = "";
    if ($result != false) {
        // echo json_encode($result);
        foreach ($result as $key => $row) {
            $output .= '<li>
                                        <input type="radio" id="ltab-' . $row['loan_profile_id'] . '" name="ltab"';
            if ($key == 0) {
                $output .=  'checked';
            }
            $output .=                   '/>
                                        <label for="ltab-' . $row['loan_profile_id'] . '">
                                            ' . $row['period_name'] . '
                                        </label>
                                        <div class="tab-content">
                                            <div class="savings_info">
                                                <div class="row">
                                                    <div class="form_section_heading pb-1 shadow my-3">
                                                        <h4>' . $row['period_name'] . ' ঋণের তথ্যাবলি</h4>
                                                    </div>
                                                    <div class="client_info row">
                                                        <div class="col-md-6 my-3">
                                                            <p>একাউন্ট <span class="d-inline-block py-1 px-4 text-capitalize';
            if ($row['status'] == 1) {
                $output .= ' bg-success ';
            } elseif ($row['status'] == 2) {
                $output .= ' bg-warning ';
            } else {
                $output .= ' bg-danger ';
            }
            $output .=
                'rounded" style="color: #fff; font-size: 18px;">';
            if ($row['status'] == 1) {
                $output .= 'ACTIVE';
            } elseif ($row['status'] == 2) {
                $output .= 'HOLD';
            } else {
                $output .= 'DEACTIVE';
            }
            $output .=                      '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>একাউন্ট হিসাব <a href="' . baseUrl('loan-profile-stm') . '?field=' . $row['field_id'] . '&&center=' . $row['center_id'] . '&&client=' . $row['client_id'] . '&&loans=' . $row['loan_profile_id'] . '" class="d-inline-block p-3 text-capitalize bg-primary rounded" style="color: #fff; font-size: 18px;"><span style="cursor: pointer; font-size: 26px;"><i class="bx bxs-user-account d-block"></i></span></a></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>ঋণ প্রদান <span>' . $row['total_loan'] . ' টাকা</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>কিস্তির পরিমাণঃ <span>' . $row['loan_installment'] . ' টাকা</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>ঋণ সঞ্চয় পরিমাণঃ <span>' . $row['savings'] . ' টাকা</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>প্রিমিয়াম সংখ্যাঃ <span>' . $row['total_intsallment'] . ' টি</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>শুরুর তারিখঃ <span>' . date("d M Y", strtotime($row['created_at'])) . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>মেয়াদকালঃ <span>' . date("d M Y", strtotime($row['duration'])) . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>লাভঃ <span>' . $row['interest'] . '%</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>লাভের পরিমাণঃ <span>' . $row['interest_installment'] . ' টাকা</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>সর্বমোট লাভঃ <span>' . $row['total_interest'] . ' টাকা</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3 ">
                                                            <p>সর্বমোট টাকা (লাভ সহ): <span>' . $row['total_loan_w_ints'] . ' টাকা</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>নিবন্ধন অফিসার: <span>' . $row['name'] . '</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="form_section_heading pb-1 shadow my-3">
                                                        <h4>নমিনির তথ্যাবলি</h4>
                                                    </div>
                                                    <div class="client_info row">
                                                        <div class="col-md-6 my-3">
                                                            <p>নামঃ <span>' . $row['nominee_name'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>স্বামীঃ <span>' . $row['nominee_husband'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>পিতাঃ <span>' . $row['nominee_father'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>মাতাঃ <span>' . $row['nominee_mother'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>জাতীয় পরিচয় পত্রের নম্বরঃ <span>' . $row['nominee_nid'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>জন্ম তারিখঃ <span>' . date("d M Y", strtotime($row['nominee_dob'])) . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>লিঙ্গঃ <span>' . $row['nominee_gendar'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>পেশাঃ <span>' . $row['nominee_occupation'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>সম্পর্কঃ <span>' . $row['nominee_relation'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>ছবিঃ <span class="text-end"><img style="width: 50%;" src="./img/' . $row['nominee_img'] . '" alt=""></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="form_section_heading pb-1 shadow my-3">
                                                        <h4>নমিনির ঠিকানা</h4>
                                                    </div>
                                                    <div class="present_address row">
                                                        <div class="col-md-12 my-3">
                                                            <p>' . $row['nominee_address'] . '</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="form_section_heading pb-1 shadow my-3">
                                                        <h4>ক্লোজিং</h4>
                                                    </div>
                                                    <div class="present_address row">
                                                        <div class="col-md-6 my-3">
                                                            <p>ক্লোজিং ফিঃ <span>' . $row['closing_fee'] . ' টাকা</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>মন্তব্যঃ <span>' . $row['closing_expression'] . '</span></p>
                                                        </div>
                                                        <div class="col-md-6 my-3">
                                                            <p>ক্লোজিং তারিখঃ <span>' . date("d M Y", strtotime($row['closing_at'])) . '</span></p>
                                                        </div>
                                                    </div>';
            if ($row['status'] == '0' && $_SESSION['auth']['user_role'] == '0') {
                $output .= '<button data-id="' . $row['loan_profile_id'] . '" id="loan_delete" class="btn btn-sm my-3 px-3 form-control rounden bg-danger text-center d-inline-block text-white">DELETE</button>';
            } else {
                $output .= '<a href="' . baseUrl('/loan-account-edit-form') . '?field=' . $row['field_id'] . '&&center=' . $row['center_id'] . '&client=' . $row['client_id'] . '&&loans=' . $row['loan_profile_id'] . '" class="btn btn-sm my-3 px-3 form-control rounden bg-warning text-center d-inline-block text-black">EDIT</a>';
            }

            $output .= '</div>
                                            </div>
                                        </div>
                                    </li>';
        }
        echo $output;
        // print_r($result);
    } else {
        echo (false);
    }
}

// Client Profile Load
if (isset($_POST['clientProfile']) && isset($_POST['clientID']) && $_POST['clientProfile'] == 1) {

    $clientID = $_POST['clientID'];

    $query = "SELECT * FROM client_registers WHERE client_id = '${clientID}' LIMIT 1";

    $result = $fields->fieldCardsLoad($query);


    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Client Card Load
if (isset($_POST['clientCard']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && $_POST['clientCard'] == 1) {

    $fieldID = $_POST['fieldID'];
    $centerID = $_POST['centerID'];

    $query = "SELECT field_name,
                (SELECT center_name FROM centers WHERE center_id = '${centerID}') AS center_name
                FROM feilds WHERE feild_id = '${fieldID}'";

    $result = $fields->fieldCardsLoad($query);


    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
// Field Card Load
if (isset($_POST['fieldCard']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['fieldCard'] == 1) {

    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT COUNT(*) AS activeSavings, 
                (SELECT COUNT(*) FROM saving_profiles WHERE field_id = $fieldID AND status = '0') AS deactiveSavings,
                (SELECT COUNT(*) FROM loan_profiles WHERE field_id = $fieldID AND status = '1') AS activeloan,
                (SELECT COUNT(*) FROM loan_profiles WHERE field_id = $fieldID AND status = '0') AS deactiveloan,
                (SELECT field_name FROM feilds WHERE feild_id = $fieldID) AS fieldName
                FROM saving_profiles WHERE field_id = $fieldID AND status = '1'";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT COUNT(*) AS activeSavings, 
                (SELECT COUNT(*) FROM saving_profiles WHERE center_id = '${centerID}' AND status = '0') AS deactiveSavings,
                (SELECT COUNT(*) FROM loan_profiles WHERE center_id = '${centerID}' AND status = '1') AS activeloan,
                (SELECT COUNT(*) FROM loan_profiles WHERE center_id = '${centerID}' AND status = '0') AS deactiveloan,
                (SELECT center_name FROM centers WHERE center_id = '${centerID}') AS fieldName
                FROM saving_profiles WHERE center_id = '${centerID}' AND status = '1'";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT COUNT(*) AS activeSavings, 
                (SELECT COUNT(*) FROM saving_profiles WHERE period_id = '${periodID}' AND status = '0') AS deactiveSavings,
                (SELECT COUNT(*) FROM loan_profiles WHERE period_id = '${periodID}' AND status = '1') AS activeloan,
                (SELECT COUNT(*) FROM loan_profiles WHERE period_id = '${periodID}' AND status = '0') AS deactiveloan,
                (SELECT period_name FROM periods WHERE period_id = '${periodID}') AS fieldName
                FROM saving_profiles WHERE period_id = '${periodID}' AND status = '1'";

        $result = $fields->fieldCardsLoad($query);
    }

    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field Savings Chart Total Load
if (isset($_POST['totalChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['totalChart'] == 1) {

    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT SUM(deposit) AS totalSavings, 

                (SELECT SUM(deposit) FROM saving_collections WHERE feild_id = $fieldID AND status = '1' AND period_id = '25' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalDPS,
                (SELECT SUM(loan) FROM loan_collections WHERE feild_id = $fieldID AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalLoan,
                (SELECT SUM(deposit) FROM loan_collections WHERE feild_id = $fieldID AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalLoanSavings,
                (SELECT COUNT(*) FROM saving_profiles WHERE field_id = $fieldID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalClientADD,
                (SELECT COUNT(*) FROM saving_profiles WHERE field_id = $fieldID AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE())) AS totalClientClose,
                (SELECT COUNT(*) FROM loan_profiles WHERE field_id = $fieldID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalLoanGiving,
                (SELECT COUNT(*) FROM loan_profiles WHERE field_id = $fieldID AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE())) AS totalLoanClose,
                (SELECT SUM(withdrawal) FROM saving_withdrawals WHERE feild_id = $fieldID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalSavingWithdraw,
                (SELECT SUM(withdrawal) FROM loan_savings_withdrawals WHERE feild_id = $fieldID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalLoanSavingsWithdraw

                FROM saving_collections WHERE feild_id = $fieldID AND status = '1' AND period_id !='25' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())";

        $result = $fields->totalChart($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT SUM(deposit) AS totalSavings, 

                (SELECT SUM(loan) FROM loan_collections WHERE period_id = $periodID AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalLoan,
                (SELECT SUM(deposit) FROM loan_collections WHERE period_id = $periodID AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalLoanSavings,
                (SELECT COUNT(*) FROM saving_profiles WHERE period_id = $periodID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalClientADD,
                (SELECT COUNT(*) FROM saving_profiles WHERE period_id = $periodID AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE())) AS totalClientClose,
                (SELECT COUNT(*) FROM loan_profiles WHERE period_id = $periodID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalLoanGiving,
                (SELECT COUNT(*) FROM loan_profiles WHERE period_id = $periodID AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE())) AS totalLoanClose,
                (SELECT SUM(withdrawal) FROM saving_withdrawals WHERE period_id = $periodID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalSavingWithdraw,
                (SELECT SUM(withdrawal) FROM loan_savings_withdrawals WHERE period_id = $periodID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalLoanSavingsWithdraw

                FROM saving_collections WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())";

        $result = $fields->totalChart($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT SUM(deposit) AS totalSavings, 

                (SELECT SUM(deposit) FROM saving_collections WHERE center_id = $centerID AND status = '1' AND period_id = '25' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalDPS,
                (SELECT SUM(loan) FROM loan_collections WHERE center_id = $centerID AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalLoan,
                (SELECT SUM(deposit) FROM loan_collections WHERE center_id = $centerID AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE())) AS totalLoanSavings,
                (SELECT COUNT(*) FROM saving_profiles WHERE center_id = $centerID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalClientADD,
                (SELECT COUNT(*) FROM saving_profiles WHERE center_id = $centerID AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE())) AS totalClientClose,
                (SELECT COUNT(*) FROM loan_profiles WHERE center_id = $centerID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalLoanGiving,
                (SELECT COUNT(*) FROM loan_profiles WHERE center_id = $centerID AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE())) AS totalLoanClose,
                (SELECT SUM(withdrawal) FROM saving_withdrawals WHERE center_id = $centerID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalSavingWithdraw,
                (SELECT SUM(withdrawal) FROM loan_savings_withdrawals WHERE center_id = $centerID AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())) AS totalLoanSavingsWithdraw

                FROM saving_collections WHERE center_id = $centerID AND status = '1' AND period_id !='25' AND MONTH(created_at_date) = MONTH(CURRENT_DATE())";

        $result = $fields->totalChart($query);
    }

    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field Savings Chart Load
if (isset($_POST['savingChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['savingChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT SUM(deposit) AS deposit, created_at_date FROM saving_collections WHERE feild_id = '${fieldID}'  AND period_id !='25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT SUM(deposit) AS deposit, created_at_date FROM saving_collections WHERE center_id = '${centerID}'  AND period_id !='25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT SUM(deposit) AS deposit, created_at_date FROM saving_collections WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field Savings Withdrawal Chart Load
if (isset($_POST['savingWithdrawalChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['savingWithdrawalChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT SUM(withdrawal) AS withdrawal, created_at FROM saving_withdrawals WHERE feild_id = '${fieldID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT SUM(withdrawal) AS withdrawal, created_at FROM saving_withdrawals WHERE center_id = '${centerID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT SUM(withdrawal) AS withdrawal, created_at FROM saving_withdrawals WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field DPS Chart Load
if (isset($_POST['DPSChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && $_POST['DPSChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT SUM(deposit) AS DPS, created_at_date FROM saving_collections WHERE feild_id = '${fieldID}'  AND period_id ='25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT SUM(deposit) AS DPS, created_at_date FROM saving_collections WHERE center_id = '${centerID}'  AND period_id ='25' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field loan Chart Load
if (isset($_POST['loanChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['loanChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT SUM(loan) AS loan, created_at_date FROM loan_collections WHERE feild_id = '${fieldID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT SUM(loan) AS loan, created_at_date FROM loan_collections WHERE center_id = '${centerID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT SUM(loan) AS loan, created_at_date FROM loan_collections WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }

    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field loan Savings Chart Load
if (isset($_POST['loanSavingChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['loanSavingChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT SUM(deposit) AS loanDeposit, created_at_date FROM loan_collections WHERE feild_id = '${fieldID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT SUM(deposit) AS loanDeposit, created_at_date FROM loan_collections WHERE center_id = '${centerID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT SUM(deposit) AS loanDeposit, created_at_date FROM loan_collections WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at_date) = MONTH(CURRENT_DATE()) AND YEAR(created_at_date) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at_date, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }

    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field loan Savings Withdrawal Chart Load
if (isset($_POST['loanSavingWithdrawChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['loanSavingWithdrawChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT SUM(withdrawal) AS loanWithdrawal, created_at FROM loan_savings_withdrawals WHERE feild_id = '${fieldID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT SUM(withdrawal) AS loanWithdrawal, created_at FROM loan_savings_withdrawals WHERE center_id = '${centerID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT SUM(withdrawal) AS loanWithdrawal, created_at FROM loan_savings_withdrawals WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field clientAddChart Chart Load
if (isset($_POST['clientAddChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['clientAddChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT COUNT(*) AS clientAdd, created_at FROM saving_profiles WHERE field_id = '${fieldID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT COUNT(*) AS clientAdd, created_at FROM saving_profiles WHERE center_id = '${centerID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT COUNT(*) AS clientAdd, created_at FROM saving_profiles WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field savingsClose Chart Load
if (isset($_POST['savingsCloseChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['savingsCloseChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT COUNT(*) AS savingsClose, closing_at FROM saving_profiles WHERE field_id = '${fieldID}' AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(closing_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT COUNT(*) AS savingsClose, closing_at FROM saving_profiles WHERE center_id = '${centerID}' AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(closing_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT COUNT(*) AS savingsClose, closing_at FROM saving_profiles WHERE period_id = '${periodID}' AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(closing_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
// Field loanCloseChart Chart Load
if (isset($_POST['loanCloseChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['loanCloseChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT COUNT(*) AS loanClose, closing_at FROM loan_profiles WHERE field_id = '${fieldID}' AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(closing_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT COUNT(*) AS loanClose, closing_at FROM loan_profiles WHERE center_id = '${centerID}' AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(closing_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT COUNT(*) AS loanClose, closing_at FROM loan_profiles WHERE period_id = '${periodID}' AND status = '0' AND MONTH(closing_at) = MONTH(CURRENT_DATE()) AND YEAR(closing_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(closing_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}

// Field clientAddChart Chart Load
if (isset($_POST['loanGvingChart']) && isset($_POST['fieldID']) && isset($_POST['centerID']) && isset($_POST['periodID']) && $_POST['loanGvingChart'] == 1) {
    if ($_POST['fieldID'] != null) {
        $fieldID = $_POST['fieldID'];

        $query = "SELECT COUNT(*) AS loanGving, created_at FROM loan_profiles WHERE field_id = '${fieldID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['centerID'] != null) {
        $centerID = $_POST['centerID'];

        $query = "SELECT COUNT(*) AS loanGving, created_at FROM loan_profiles WHERE center_id = '${centerID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    } elseif ($_POST['periodID'] != null) {
        $periodID = $_POST['periodID'];

        $query = "SELECT COUNT(*) AS loanGving, created_at FROM loan_profiles WHERE period_id = '${periodID}' AND status = '1' AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) GROUP BY DATE_FORMAT(created_at, '%d-%m-%Y')";

        $result = $fields->fieldCardsLoad($query);
    }


    $result = $fields->chartLoad($query);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo json_encode(false);
    }
}
