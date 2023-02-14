<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

if (isset($_POST['savings_profile_id'])) {
    // Store data in variable
    $clientID = $_POST['clientID'];
    $savings_profile_id = $_POST['savings_profile_id'];
    $feild_id = $_POST['feild'];
    $center_id = $_POST['center'];
    $period_id = $_POST['period'];
    $book = $_POST['book'];
    $deposit = $_POST['deposit'];
    $expression = $_POST['details'];
    $officers_id = $_SESSION['auth']['user_id'];
    // print_r($_POST);

    $result = $collection->savingsCollection($clientID, $savings_profile_id, $feild_id, $center_id, $period_id, $book, $deposit, $expression, $officers_id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}
if (isset($_POST['savingsEditid'])) {
    // Store data in variable
    $id = $_POST['savingsEditid'];
    $deposit = $_POST['deposit'];
    $expression = $_POST['details'];
    // print_r($_POST);
    // die();

    $result = $collection->savingsedit($id, $deposit, $expression);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// collection Delete
if (isset($_POST['dlt_savings_collection_id'])) {
    $id = $_POST['dlt_savings_collection_id'];
    $table = "saving_collections";
    // echo $total;
    // die();

    $result = $collection->deleteCollection($table, $id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Approved Savings Collections
if (isset($_POST['savingsAppID'])) {
    $id = $_POST['savingsAppID'];
    // print_r($id);
    // die();

    $result = $collection->apprvsavingsCollection($id);

    if ($result != false) {
        print_r($result);
    } else {
        echo false;
    }
}

// Savings Field Report Load
if (isset($_POST['savingWithdrawReport']) && $_POST['savingWithdrawReport'] == 1) {
    $officer_id = null;
    if ($_SESSION['auth']['user_role'] != 0) {
        $officer_id = $_SESSION['auth']['user_id'];
    }

    $result = $collection->savingsWithdrawalReport($officer_id);
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
                            <td><a href="./collection-savings-withdrawal-report?report=' . $row['period_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
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
                            <td colspan="4" class="text-center">কোনো উত্তোলোন পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">0000</td>
                        </tr>';
        echo $output;
    }
}

// Loan Field Report Load
if (isset($_POST['loanWithdrawReport']) && $_POST['loanWithdrawReport'] == 1) {
    $officer_id = null;
    if ($_SESSION['auth']['user_role'] != 0) {
        $officer_id = $_SESSION['auth']['user_id'];
    }

    $result = $collection->loansWithdrawalReport($officer_id);
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
                            <td>' . $row['withdrawal'] . '</td>
                            <td><a href="./collection-loan-withdrawal-report?report=' . $row['period_id'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
                        </tr>';
            $withdrawal[] = $row['withdrawal'];
        }
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">' . array_sum($withdrawal) . '</td>
                        </tr>';
        echo $output;
    } else {
        $output .= '<tr>
                            <td colspan="7" class="text-center">কোনো উত্তোলোন পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">0000</td>
                        </tr>';
        echo $output;
    }
}

// savings Widthdrawal edit Load
if (isset($_POST['saving_withdrawal_id'])) {
    $id = $_POST['saving_withdrawal_id'];
    // echo $id;
    // die();
    $result = $collection->editableSavingsWithdload($id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '
            <div class="row">
                        <!-- Form Information -->
                        <div class="col-md-6 mb-3 select">
                            <label for="book" class="pb-2">বই নং </label>
                            <input type="hidden" id="id" value="' . $row['withdraw_id'] . '">
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" id="book" value="' . $row['book'] . '" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="pb-2">নাম</label>
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" value="' . $row['name'] . '" id="name" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="withdraw" class="pb-2">উত্তোলোন (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['withdrawal'] . '" id="withdraw">
                            <div id="withdraw-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                উত্তোলোন পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="balance_remaining" class="pb-2">অবশিষ্ট আমানত (টাকা)<span class="text-danger">*</span></label>
                        <input type="hidden" value="' . $row['balance_remaining'] + $row['withdrawal'] . '" id="total_balance" disabled>
                        <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['balance_remaining'] . '" id="balance_remaining" disabled>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="details" class="pb-2">মন্তব্য</label>
                            <textarea class="form-control p-3" id="details" rows="3">' . $row['expression'] . '</textarea>
                        </div>
                    </div>';
        }
        echo $output;
    } else {
        echo false;
    }
}

if (isset($_POST['savingsWithdEditid'])) {
    // Store data in variable
    $id = $_POST['savingsWithdEditid'];
    $withdraw = $_POST['withdraw'];
    $expression = $_POST['details'];
    $total = $_POST['total'];
    // print_r($_POST);
    // die();

    $result = $collection->savingsWithdedit($id, $withdraw, $total, $expression);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Withdrawal Delete
if (isset($_POST['dlt_savings_withdraw_id'])) {
    $id = $_POST['dlt_savings_withdraw_id'];
    $table = "saving_withdrawals";
    // echo $total;
    // die();

    $result = $collection->deleteWithdrawal($table, $id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Approved Savings Withdraw
if (isset($_POST['savingsWithAppID'])) {
    $id = $_POST['savingsWithAppID'];
    // print_r($id);
    // die();

    $result = $collection->apprvsavingsWithdrawal($id);

    if ($result != false) {
        print_r($result);
    } else {
        echo false;
    }
}

// loan Widthdrawal edit Load
if (isset($_POST['loan_withdrawal_id'])) {
    $id = $_POST['loan_withdrawal_id'];
    // echo $id;
    // die();
    $result = $collection->editableloanWithdload($id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '
            <div class="row">
                        <!-- Form Information -->
                        <div class="col-md-6 mb-3 select">
                            <label for="book" class="pb-2">বই নং </label>
                            <input type="hidden" id="id" value="' . $row['withdraw_id'] . '">
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" id="book" value="' . $row['book'] . '" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="pb-2">নাম</label>
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" value="' . $row['name'] . '" id="name" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="withdraw" class="pb-2">উত্তোলোন (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['withdrawal'] . '" id="withdraw">
                            <div id="withdraw-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                উত্তোলোন পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="balance_remaining" class="pb-2">অবশিষ্ট আমানত (টাকা)<span class="text-danger">*</span></label>
                        <input type="hidden" value="' . $row['balance_remaining'] + $row['withdrawal'] . '" id="total_balance" disabled>
                        <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['balance_remaining'] . '" id="balance_remaining" disabled>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="details" class="pb-2">মন্তব্য</label>
                            <textarea class="form-control p-3" id="details" rows="3">' . $row['expression'] . '</textarea>
                        </div>
                    </div>';
        }
        echo $output;
    } else {
        echo false;
    }
}

if (isset($_POST['loanWithdEditid'])) {
    // Store data in variable
    $id = $_POST['loanWithdEditid'];
    $withdraw = $_POST['withdraw'];
    $expression = $_POST['details'];
    $total = $_POST['total'];
    // print_r($_POST);
    // die();

    $result = $collection->loanWithdedit($id, $withdraw, $total, $expression);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Withdrawal Delete
if (isset($_POST['dlt_loan_withdraw_id'])) {
    $id = $_POST['dlt_loan_withdraw_id'];
    $table = "loan_savings_withdrawals";
    // echo $total;
    // die();

    $result = $collection->deleteWithdrawal($table, $id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Approved loan Withdraw
if (isset($_POST['loanWithAppID'])) {
    $id = $_POST['loanWithAppID'];
    // print_r($id);
    // die();

    $result = $collection->apprvLoanWithdrawal($id);

    if ($result != false) {
        print_r($result);
    } else {
        echo false;
    }
}
