<?php

use controller\ProfileSTMUpdate\ProfileSTMController;

include_once "../controller/ProfileSTMUpdateController.php";
// session_start();

$collection = new ProfileSTMController();

// savings collection edit Load
if (isset($_POST['saving_collection_id'])) {
    $id = $_POST['saving_collection_id'];
    // echo $id;
    // die();
    $result = $collection->editsavingsColelction($id);
    $output = "";

    // print_r($result);
    // die();
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '<div class="row">
                        <!-- Form Information -->
                        <div class="col-md-6 mb-3 select">
                            <label for="book" class="pb-2">বই নং </label>
                            <input type="hidden" id="id" value="' . $row['collection_id'] . '">
                            <input type="hidden" id="saving_profiles_id" value="' . $row['saving_profiles_id'] . '">
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
                            <label for="past_total_deposit" class="pb-2">পূর্বের সঞ্চয় জমা <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . ($row['total_deposit'] - $row['deposit']) . '" id="past_total_deposit" readonly>
                            <div id="past_total_deposit-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="past-balance" class="pb-2">পূর্বের ব্যালেন্স <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . ($row['balance'] - $row['deposit']) . '" id="past-balance" readonly>
                            <div id="past-balance-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="savings" class="pb-2">সঞ্চয় (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['deposit'] . '" id="savings">
                            <div id="savings-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="after_total_deposit" class="pb-2">বর্তমান সঞ্চয় জমা <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['total_deposit'] . '" id="after_total_deposit" readonly>
                            <div id="after_total_deposit-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় জমা হয়নি
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="after-balance" class="pb-2">বর্তমান ব্যালেন্স <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['balance'] . '" id="after-balance" readonly>
                            <div id="after-balance-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় জমা হয়নি
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

if (isset($_POST['savingsEditid'])) {
    // Store data in variable
    $id = $_POST['savingsEditid'];
    $saving_profiles_id = $_POST['saving_profiles_id'];
    $deposit = $_POST['deposit'];
    $total_deposit = $_POST['total_deposit'];
    $expression = $_POST['details'];
    // print_r($_POST);
    // die();

    $result = $collection->savingCollectionUpdate($id, $saving_profiles_id, $total_deposit, $deposit, $expression);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Delete Saving Collection
if (isset($_POST['dlt_savings_collection_id'])) {
    $id = $_POST['dlt_savings_collection_id'];

    $result = $collection->deleteSavingsCollection($id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// loan collection edit Load
if (isset($_POST['load_collection_id'])) {
    $id = $_POST['load_collection_id'];
    // echo $id;
    // die();
    $result = $collection->editLoanCollection($id);
    $output = "";
    if ($result != false) {
        foreach ($result as $row) {
            $output .= '
            <div class="row">
                        <!-- Form Information -->
                        <div class="col-lg-4 col-md-6 mb-3 select">
                            <label for="book" class="pb-2">বই নং </label>
                            <input type="hidden" id="id" value="' . $row['collection_id'] . '">
                            <input type="hidden" id="loan_profile_id" value="' . $row['loan_prof_id'] . '">
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" id="book" value="' . $row['book'] . '" disabled>
                            <div id="book-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                বই নির্বারচন করুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="name" class="pb-2">নাম</label>
                            <input type="text" class="form-control form-input p-3" style="text-indent: 5px;" value="' . $row['name'] . '" id="name" disabled>
                        </div><div class="col-lg-4 col-md-6 mb-3">
                            <label for="past_total_deposit" class="pb-2">পূর্বের সঞ্চয় জমা <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . ($row['total_deposit'] - $row['deposit']) . '" id="past_total_deposit" readonly>
                            <div id="past_total_deposit-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="past-balance" class="pb-2">পূর্বের ব্যালেন্স <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . ($row['balance'] - $row['deposit']) . '" id="past-balance" readonly>
                            <div id="past-balance-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="past-loan-recovery" class="pb-2">পূর্বের ঋণ আদায় <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . ($row['loan_recover'] - $row['loan']) . '" id="past-loan-recovery" readonly>
                            <div id="past-loan-recovery-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="past-interest-recovery" class="pb-2">পূর্বের লাভ আদায় <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . ($row['interest_recover'] - $row['interest']) . '" id="past-interest-recovery" readonly>
                            <div id="past-interest-recovery-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="saving" class="pb-2">সঞ্চয় (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['deposit'] . '" id="saving">
                            <div id="saving-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="loan" class="pb-2">ঋণ (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;" id="loan" value="' . $row['loan'] . '" name="loan">
                            <div id="loan-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ঋণের পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="interest" class="pb-2">লাভ (টাকা) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;" id="interest" value="' . $row['interest'] . '">
                            <div id="interest-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                লাভের পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="total" class="pb-2">মোট (সঞ্চয় + ঋণ + লাভ)</label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;" id="total" value="' . $row['total'] . '" readonly>
                            <div id="total-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                টোটাল লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="after_total_deposit" class="pb-2">বর্তমান সঞ্চয় জমা <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['total_deposit'] . '" id="after_total_deposit" readonly>
                            <div id="after_total_deposit-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় জমা হয়নি
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="after-balance" class="pb-2">বর্তমান ব্যালেন্স <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['balance'] . '" id="after-balance" readonly>
                            <div id="after-balance-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় জমা হয়নি
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="after-loan-recovery" class="pb-2">বর্তমান ঋণ আদায় <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['loan_recover'] . '" id="after-loan-recovery" readonly>
                            <div id="after-loan-recovery-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                সঞ্চয় পরিমাণ লিখুন
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="after-interest-recovery" class="pb-2">বর্তমান লাভ আদায় <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-input p-3" style="text-indent: 5px;"  value="' . $row['interest_recover'] . '" id="after-interest-recovery" readonly>
                            <div id="after-interest-recovery-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
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

if (isset($_POST['loanEditid'])) {
    // Store data in variable
    $id = $_POST['loanEditid'];
    $loan_profile_id = $_POST['loan_profile_id'];
    $deposit = $_POST['deposit'];
    $loan = $_POST['loan'];
    $interest = $_POST['interest'];
    $total = $_POST['total'];
    $total_deposit = $_POST['total_deposit'];
    $loanRec = $_POST['loanRec'];
    $interestrec = $_POST['interestrec'];
    $expression = $_POST['details'];

    $result = $collection->loanCollectionUpdate($id, $loan_profile_id, $total_deposit, $loanRec, $interestrec, $deposit, $loan, $interest, $total, $expression);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

// Delete Loan Collection
if (isset($_POST['dlt_loan_collection_id'])) {
    $id = $_POST['dlt_loan_collection_id'];

    $result = $collection->deleteLoanCollection($id);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}
