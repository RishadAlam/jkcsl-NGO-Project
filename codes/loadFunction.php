<?php

use controller\dataLoadController\dataLoadController\dataLoadController;



include_once "../controller/dataLoadController.php";

$load = new dataLoadController();

if (isset($_POST['inquery'])) {
    $liveSearch = $_POST['inquery'];
    $result = $load->liveSearch($liveSearch);
    $output = "";
    if ($result != false) {
        // print_r($result);
        // echo json_encode($result);
        foreach ($result as $row) {
            $output .= '<tr onclick="location.href=';
            $output .= "'" . baseUrl("client-profile")  . "?field=" . $row["feild_id"]  . "&&center=" . $row["center_id"] . "&&savings=1&&client=" . $row["client_id"] . "'";
            $output .= '" style="cursor: pointer;">
                                        <td>' . $row['book'] . '</td>
                                        <td>' . $row['name'] . '</td>
                                    </tr>';
        }
    } else {
        $output .= '<tr >
                        <td colspan="2" class="text-center">কোনো বই পাওয়া যাইনি</td>
                    </tr>';
    }
    echo $output;
}

if (isset($_POST['fields']) && $_POST['fields'] == 1) {
    $result = $load->feildsLoad();
    $output = "";
    if ($result != false) {
        $output .= '<option class="feild" value="null" disabled selected>ফিল্ড নির্বারচন করুন...</option>';
        // echo json_encode($result);
        foreach ($result as $row) {
            $output .= '<option value="' . $row['feild_id'] . '">' . $row['field_name'] . '</option>';
        }
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো ফিল্ড পাওয়া যাইনি</option>';
    }
}

if (isset($_POST['field'])) {
    $result = $load->centersLoad($_POST['field']);
    if ($result != false) {
        $output =
            '<option class="feild" value="null" disabled selected>কেন্দ্র নির্বাচন করুন...</option>';
        foreach ($result as $row) {
            $output .=
                '<option class="feild" value="' . $row['center_id'] . '">' . $row['center_name'] . '</option>';
        }
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো কেন্দ্র পাওয়া যাইনি</option>';
    }
}

if (isset($_POST['clientID'])) {
    $result = $load->clinetInfoLoad($_POST['clientID']);
    if ($result != false) {
        // $output = '';
        // foreach ($result as $row) {
        //     $output .= $row;
        // }
        echo json_encode($result);
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো কেন্দ্র পাওয়া যাইনি</option>';
    }
}

if (isset($_POST['loanclientID']) && isset($_POST['loanbook']) && isset($_POST['loanloanID'])) {
    // echo $_POST['loanclientID'];
    // die();
    $result = $load->loanInfoLoad($_POST['loanclientID'], $_POST['loanbook'], $_POST['loanloanID']);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo $_POST['clientID'];
    }
}

if (isset($_POST['sField']) && isset($_POST['center'])) {
    $result = $load->booksLoad($_POST['sField'], $_POST['center']);

    if ($result != false) {
        $output =
            '<option class="feild" value="null" disabled selected>বই নির্বাচন করুন...</option>';
        foreach ($result as $row) {
            $output .=
                '<option data-book="' . $row['book'] . '" value="' . $row['client_id'] . '">' . $row['book'] . '</option>';
        }
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো বই পাওয়া যাইনি</option>';
    }
}

if (isset($_POST['cField']) && isset($_POST['ccenter']) && isset($_POST['cperiod'])) {
    $result = $load->savingsbookLoad($_POST['cField'], $_POST['ccenter'], $_POST['cperiod']);

    if ($result != false) {
        $output =
            '<option class="feild" value="null" disabled selected>বই নির্বাচন করুন...</option>';
        foreach ($result as $row) {
            $output .=
                '<option data-savingprofile="' . $row['saving_profiles_id'] . '" data-book="' . $row['book'] . '" value="' . $row['client_id'] . '">' . $row['book'] . '</option>';
        }
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো বই পাওয়া যাইনি</option>';
    }
}

if (isset($_POST['lField']) && isset($_POST['lcenter']) && isset($_POST['lperiod'])) {
    $result = $load->loanbookLoad($_POST['lField'], $_POST['lcenter'], $_POST['lperiod']);

    if ($result != false) {
        $output =
            '<option class="feild" value="null" disabled selected>বই নির্বাচন করুন...</option>';
        foreach ($result as $row) {
            $output .=
                '<option data-loanprofile="' . $row['loan_profile_id'] . '" data-book="' . $row['book'] . '" value="' . $row['client_id'] . '">' . $row['book'] . '</option>';
        }
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো বই পাওয়া যাইনি</option>';
    }
}

if (isset($_POST['officer']) && $_POST['officer'] == 1) {
    $result = $load->officersLoad();
    if ($result != false) {
        $output = '<option class="feild" value="null" disabled selected>অফিসার নির্বারচন করুন...</option>';
        // echo json_encode($result);
        foreach ($result as $row) {
            $output .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো অফিসার পাওয়া যাইনি</option>';
    }
}
if (isset($_POST['period'])) {
    $result = $load->periodsLoad($_POST['period']);
    if ($result != false) {
        $output = '<option class="feild" value="null" disabled selected>ক্ষেত্র নির্বারচন করুন...</option>';
        // echo json_encode($result);
        $output .= '<optgroup label="দৈনিক">';
        foreach ($result as $row) {
            if ($row['period'] == 1) {
                $output .= '<option data-days="' . $row['period'] . '" value="' . $row['period_id'] . '">' . $row['period_name'] . '</option>';
            }
        }
        $output .= '</optgroup>';
        $output .= '<optgroup label="সাপ্তাহিক">';
        foreach ($result as $row) {
            if ($row['period'] == 7) {
                $output .= '<option data-days="' . $row['period'] . '" value="' . $row['period_id'] . '">' . $row['period_name'] . '</option>';
            }
        }
        $output .= '</optgroup>';
        $output .= '<optgroup label="মাসিক">';
        foreach ($result as $row) {
            if ($row['period'] == 30) {
                $output .= '<option data-days="' . $row['period'] . '" value="' . $row['period_id'] . '">' . $row['period_name'] . '</option>';
            }
        }
        $output .= '</optgroup>';
        $output .= '<optgroup label="বাৎসরিক">';
        foreach ($result as $row) {
            if ($row['period'] == 365) {
                $output .= '<option data-days="' . $row['period'] . '" value="' . $row['period_id'] . '">' . $row['period_name'] . '</option>';
            }
        }
        $output .= '</optgroup>';
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো ক্ষেত্র পাওয়া যাইনি</option>';
    }
}

// print_r($_POST['bsavings_profile']);
// die();
if (isset($_POST['bclientid']) && isset($_POST['bbook']) && isset($_POST['bsavings_profile'])) {
    // print_r($_POST['bsavings_profile']);
    // die();
    $result = $load->clinetSavingsInfoLoad($_POST['bclientid'], $_POST['bbook'], $_POST['bsavings_profile']);
    if ($result != false) {
        echo json_encode($result);
        // echo $result;
    } else {
        echo $result;
    }
    // echo $result;
}

if (isset($_POST['wclientid']) && isset($_POST['wbook']) && isset($_POST['wsavings_profile'])) {
    // print_r($_POST['bsavings_profile']);
    // die();
    $result = $load->clinetSavingsInfoLoad($_POST['wclientid'], $_POST['wbook'], $_POST['wsavings_profile']);
    if ($result != false) {
        echo json_encode($result);
        // echo $result;
    } else {
        echo $result;
    }
    // echo $result;
}

if (isset($_POST['bclientid']) && isset($_POST['bbook']) && isset($_POST['bloan_profile'])) {
    // print_r($_POST['bbook']);
    // die();
    $result = $load->clinetLoanInfoLoad($_POST['bclientid'], $_POST['bbook'], $_POST['bloan_profile']);
    if ($result != false) {
        echo json_encode($result);
        // echo $result;
    } else {
        echo $result;
    }
    // echo $result;
}

// FDR Clients Load
if (isset($_POST['fdr']) && $_POST['fdr'] == 1) {
    $result = $load->fdrLoad();
    $output = "";
    if ($result != false) {
        $output .= '<option class="feild" value="null" disabled selected>সদস্য নির্বাচন করুন...</option>';
        // echo json_encode($result);
        foreach ($result as $row) {
            $output .= '<option data-id="' . $row['id'] . '" value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        echo $output;
    } else {
        echo '<option class="feild" value="null" disabled selected>কোনো সদস্য পাওয়া যাইনি</option>';
    }
}

// Notification number Load
if (isset($_POST['bell']) && $_POST['bell'] == 1) {
    if (isset($_SESSION['auth']['user_id'])) {
        $officer_id = $_SESSION['auth']['user_id'];
        $result = $load->bellLoad($officer_id);
        if ($result != false) {
            echo $result['bell'];
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}

// Notification Load
if (isset($_POST['bell']) && $_POST['bell'] == 2) {
    if (isset($_SESSION['auth']['user_id'])) {
        $officer_id = $_SESSION['auth']['user_id'];
        $result = $load->notifload($officer_id, '5');
        $output = "";
        if ($result != false) {
            foreach ($result as $row) {
                $output .= '<li><a href="./inbox">' . $row['name'] . '<br>' . $row['sub'] . '</a></li>';
            }
            $output .= '<li><a href="./inbox" class="btn form-control btn-button">সবগুলো দেখুন</a></li>';
            echo $output;
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}

// Savings Field Report Load
if (isset($_POST['fieldReport']) && $_POST['fieldReport'] == 1) {
    $officer_id = null;
    if ($_SESSION['auth']['user_role']) {
        $officer_id = $_SESSION['auth']['user_id'];
    }
    // echo $officer_id;
    // die();
    $date = true;
    $result = $load->savingsfieldReport($officer_id, $date);
    $output = "";
    if ($result != false) {
        // print_r($result);
        // die();
        $deposit = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>' . $row['total'] . '</td>
                            <td><a href="./collection-savings-report?report=' . $row['period_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
                        </tr>';
            $deposit[] = $row['total'];
        }
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">' . array_sum($deposit) . '</td>
                        </tr>';
        echo $output;
    } else {
        $output .= '<tr>
                            <td colspan="4" class="text-center">কোনো কালেকশন পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">0000</td>
                        </tr>';
        echo $output;
    }
}

// Loan Field Report Load
if (isset($_POST['fieldReport']) && $_POST['fieldReport'] == 2) {
    $officer_id = null;
    if ($_SESSION['auth']['user_role']) {
        $officer_id = $_SESSION['auth']['user_id'];
    }
    $date = true;

    $result = $load->loansfieldReport($officer_id, $date);
    $output = "";
    if ($result != false) {
        $deposit = array();
        $loan = array();
        $interest = array();
        $total = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>' . $row['deposit'] . '</td>
                            <td>' . $row['loan'] . '</td>
                            <td>' . $row['interest'] . '</td>
                            <td>' . $row['total'] . '</td>
                            <td><a href="./collection-loan-report?report=' . $row['period_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
                        </tr>';
            $deposit[] = $row['deposit'];
            $loan[] = $row['loan'];
            $interest[] = $row['interest'];
            $total[] = $row['total'];
        }
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td class="border-top">' . array_sum($deposit) . '</td>
                            <td class="border-top">' . array_sum($loan) . '</td>
                            <td class="border-top">' . array_sum($interest) . '</td>
                            <td colspan="2" class="border-top">' . array_sum($total) . '</td>
                        </tr>';
        echo $output;
    } else {
        $output .= '<tr>
                            <td colspan="7" class="text-center">কোনো কালেকশন পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td class="border-top">0000</td>
                            <td class="border-top">0000</td>
                            <td class="border-top">0000</td>
                            <td colspan="2" class="border-top">0000</td>
                        </tr>';
        echo $output;
    }
}

// Tamadi Savings Field Report Load
if (isset($_POST['tamadiFieldReport']) && $_POST['tamadiFieldReport'] == 1) {
    $officer_id = null;
    if ($_SESSION['auth']['user_role']) {
        $officer_id = $_SESSION['auth']['user_id'];
    }
    $result = $load->savingsfieldReport($officer_id);
    $output = "";
    if ($result != false) {
        // print_r($result);
        // die();
        $deposit = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>' . $row['total'] . '</td>
                            <td><a href="./tamadi-collection-savings-report?report=' . $row['period_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
                        </tr>';
            $deposit[] = $row['total'];
        }
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">' . array_sum($deposit) . '</td>
                        </tr>';
        echo $output;
    } else {
        $output .= '<tr>
                            <td colspan="4" class="text-center">কোনো কালেকশন পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">0000</td>
                        </tr>';
        echo $output;
    }
}

// Tamadi Loan Field Report Load
if (isset($_POST['tamadiFieldReport']) && $_POST['tamadiFieldReport'] == 2) {
    $officer_id = null;
    if ($_SESSION['auth']['user_role']) {
        $officer_id = $_SESSION['auth']['user_id'];
    }

    $result = $load->loansfieldReport($officer_id);
    $output = "";
    if ($result != false) {
        $deposit = array();
        $loan = array();
        $interest = array();
        $total = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>' . $row['deposit'] . '</td>
                            <td>' . $row['loan'] . '</td>
                            <td>' . $row['interest'] . '</td>
                            <td>' . $row['total'] . '</td>
                            <td><a href="./tamadi-collection-loan-report?report=' . $row['period_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
                        </tr>';
            $deposit[] = $row['deposit'];
            $loan[] = $row['loan'];
            $interest[] = $row['interest'];
            $total[] = $row['total'];
        }
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td class="border-top">' . array_sum($deposit) . '</td>
                            <td class="border-top">' . array_sum($loan) . '</td>
                            <td class="border-top">' . array_sum($interest) . '</td>
                            <td colspan="2" class="border-top">' . array_sum($total) . '</td>
                        </tr>';
        echo $output;
    } else {
        $output .= '<tr>
                            <td colspan="7" class="text-center">কোনো কালেকশন পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td class="border-top">0000</td>
                            <td class="border-top">0000</td>
                            <td class="border-top">0000</td>
                            <td colspan="2" class="border-top">0000</td>
                        </tr>';
        echo $output;
    }
}


// meessage Load
if (isset($_POST['message_id'])) {
    $id = $_POST['message_id'];
    // echo $id;
    // die();
    $result = $load->msgload($id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '<div class="row">
                        <div class="col-md-12 my-3">
                            <h6><span><i class="bx bx-calendar"></i></span>সময়ঃ ' . date("d-m-Y, h:i:s A", strtotime($row['created_at'])) . '</h6>
                        </div>
                        <div class="col-md-12 my-3">
                            <h4>অফিসারঃ <span>' . $row['name'] . '</span></h4>
                        </div>
                        <div class="col-md-12 my-3">
                            <h4>বিষয়ঃ <span>' . $row['sub'] . '</span></h4>
                        </div>
                        <div class="col-md-12 my-3">
                            <h4>বিস্তারিতঃ<br> <span>' . $row['details'] . '</span></h4>
                        </div>
                    </div>';
        }

        echo $output;
    } else {
        echo false;
    }
}
if (isset($_POST['sendmessage_id'])) {
    $id = $_POST['sendmessage_id'];
    // echo $id;
    // die();
    $result = $load->sendmsgload($id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '<div class="row">
                        <div class="col-md-12 my-3">
                            <h6><span><i class="bx bx-calendar"></i></span>সময়ঃ ' . date("d-m-Y, h:i:s A", strtotime($row['created_at'])) . '</h6>
                        </div>
                        <div class="col-md-12 my-3">
                            <h4>অফিসারঃ <span>' . $row['name'] . '</span></h4>
                        </div>
                        <div class="col-md-12 my-3">
                            <h4>বিষয়ঃ <span>' . $row['sub'] . '</span></h4>
                        </div>
                        <div class="col-md-12 my-3">
                            <h4>বিস্তারিতঃ<br> <span>' . $row['details'] . '</span></h4>
                        </div>
                    </div>';
        }

        echo $output;
    } else {
        echo false;
    }
}

// loan collection edit Load
if (isset($_POST['load_collection_id'])) {
    $id = $_POST['load_collection_id'];
    // echo $id;
    // die();
    $result = $load->editableloaddataload($id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '
            <div class="row">
                        <!-- Form Information -->
                        <div class="col-md-6 mb-3 select">
                            <label for="book" class="pb-2">বই নং </label>
                            <input type="hidden" id="id" value="' . $row['collection_id'] . '">
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" id="book" value="' . $row['book'] . '" disabled>
                            <div id="book-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                বই নির্বারচন করুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="pb-2">নাম</label>
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" value="' . $row['name'] . '" id="name" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="savings" class="pb-2">সঞ্চয় (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['deposit'] . '" id="savings">
                            <div id="savings-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="loan" class="pb-2">ঋণ (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;" id="loan" value="' . $row['loan'] . '" name="loan">
                            <div id="loan-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ঋণের পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="interest" class="pb-2">লাভ (টাকা)</label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;" id="interest" value="' . $row['interest'] . '"';
            if ($_SESSION['auth']['user_role'] != 0) {
                $output .=     'disabled';
            }

            $output .=     '>
                            <div id="interest-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                লাভের পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total" class="pb-2">মোট (সঞ্চয় + ঋণ + লাভ)</label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;" id="total" value="' . $row['total'] . '" disabled>
                            <div id="total-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                টোটাল লিখুন
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="details" class="pb-2">মন্তব্য</label>
                            <textarea class="form-control p-3" id="details" rows="3">' . $row['expression'] . '</textarea>
                        </div>
                        <div class="col-md-12">

                        </div>
                    </div>';
        }
        echo $output;
    } else {
        echo false;
    }
}
// savings collection edit Load
if (isset($_POST['saving_collection_id'])) {
    $id = $_POST['saving_collection_id'];
    // echo $id;
    // die();
    $result = $load->editablesavingsdataload($id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '
            <div class="row">
                        <!-- Form Information -->
                        <div class="col-md-6 mb-3 select">
                            <label for="book" class="pb-2">বই নং </label>
                            <input type="hidden" id="id" value="' . $row['collection_id'] . '">
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" id="book" value="' . $row['book'] . '" disabled>
                            <div id="book-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                বই নির্বারচন করুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="pb-2">নাম</label>
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" value="' . $row['name'] . '" id="name" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="savings" class="pb-2">সঞ্চয় (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['deposit'] . '" id="savings">
                            <div id="savings-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="details" class="pb-2">মন্তব্য</label>
                            <textarea class="form-control p-3" id="details" rows="3">' . $row['expression'] . '</textarea>
                        </div>
                        <div class="col-md-12">

                        </div>
                    </div>';
        }
        echo $output;
    } else {
        echo false;
    }
}

// FDR single Clients Load
if (isset($_POST['fdr_id'])) {
    $id = $_POST['fdr_id'];
    $status = null;

    $result = $load->fdrLoad($status, $id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '<div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                                <input type="hidden" id="id" value="' . $row['id'] . '">
                                <input type="text" style="text-indent: 0;" class="form-control form-input p-3" value="' . $row['name'] . '" id="up_name">
                                <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    নাম লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fdr-deposit" class="pb-2">এফ.ডি.আর (টাকা) <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control form-input p-3" value="' . $row['deposit'] . '" id="up_fdr-deposit">
                                <div id="fdr-deposit-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    এফ.ডি.আর লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="start-date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                <input type="date" style="text-indent: 0;" class="form-control form-input p-3" value="' . $row['start'] . '" id="up_start-date">
                                <div id="start-date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    তারিখ লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expiry-date" class="pb-2">মেয়াদ (তারিখ) <span class="text-danger">*</span></label>
                                <input type="date" style="text-indent: 0;" class="form-control form-input p-3" value="' . $row['expiry'] . '" id="up_expiry-date">
                                <div id="expiry-date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    মেয়াদ লিখুন
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="details" class="pb-2">মন্তব্য</label>
                                <textarea class="form-control p-3" rows="3" id="up_details">' . $row['details'] . '</textarea>
                            </div>
                        </div>';
        }
        echo $output;
        // print_r($result);
    } else {
        echo false;
    }
}
// Officer Load
if (isset($_POST['allofficer']) && $_POST['allofficer'] == 1) {

    $result = $load->allOfficer();
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '<div class="col-md-6 col-lg-4">
                            <div class="profile_intro">
                                <div class="img rounded">
                                    <img src=';
            if ($row['image'] != "") {
                $output .=  '"./img/' . $row['image'];
            } else {
                $output .= '"https://avatars.dicebear.com/api/personas/' . $row['name'] . '.svg';
            }
            $output .= '" alt="">
                                </div>
                                <div class="p_status text-center my-3">
                                    <span class="d-inline-block py-2 px-4 text-capitalize';
            if ($row['status'] == 1) {
                $output .= ' bg-success';
            } elseif ($row['status'] == 2) {
                $output .= ' bg-warning';
            } else {
                $output .= ' bg-danger';
            }
            $output .= ' rounded" style="color: #fff; font-size: 18px;">';
            if ($row['status'] == 1) {
                $output .= 'ACTIVE';
            } elseif ($row['status'] == 2) {
                $output .= 'PANDING';
            } else {
                $output .= 'DEACTIVE';
            }
            $output .= '</span>
                                </div>
                                <div class="p-short">
                                    <ul>
                                        <li class="text-center name">' . $row['name'] . '</li>
                                        <li class="d-flex justify-content-between">পদবি <span>' . $row['role'] . '</span></li>
                                        <li class="d-flex justify-content-between">ইমেল <span>' . $row['email'] . '</span></li>
                                        <li class="d-flex justify-content-between">রক্তের গ্রুপ <span>' . $row['blood'] . '</span></li>
                                        <li class="d-flex justify-content-between">মোবাইল <span>' . $row['mobile_1'] . '</span></li>
                                        <li class="d-flex justify-content-between">যোগদান তারিখ <span>' . $row['created_at'] . '</span></li>
                                        <li class="d-flex justify-content-between">বিদায় তারিখ <span>' . $row['resign_date'] . '</span></li>
                                        <a href="./officer-profile?id=' . $row['id'] . '" class="btn my-3 px-3 btn-button form-control rounden text-center d-inline-block text-white">প্রোফাইল</a>
                                    </ul>
                                </div>
                            </div>
                        </div>';
        }
        echo $output;
        // print_r($result);
    } else {
        echo false;
    }
}

// officer profile
if (isset($_POST['officerUserID'])) {
    $id = $_POST['officerUserID'];
    // print_r($_POST['bbook']);
    // die();
    $result = $load->allOfficer($id);
    if ($result != false) {
        echo json_encode($result);
    } else {
        echo $result;
    }
}
