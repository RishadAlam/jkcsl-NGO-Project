<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($regForm2 == 0) {
    redirect("404");
    ob_end_flush();
}
?>
<!-- Breadcrumb -->
<div id="breadcrumb">
    <div class="container_fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="./index.html">ড্যাশবোর্ড</a></li>
                <li class="breadcrumb-item">নিবন্ধন</li>
                <li class="breadcrumb-item active" aria-current="page">সঞ্চয় নিবন্ধন</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Savings Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5">
    <div class="form_heading mb-5">
        <h2 class="text-center">সঞ্চয় পত্রের সদস্য নিবন্ধন ফরম</h2>
    </div>
    <form action="" id="savings_reg_form">
        <div class="row">

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>ফরমের তথ্যাবলি</h4>
            </div>

            <!-- Client Information -->
            <div class="form_info row p-0 m-0">
                <div class="col-md-6 mb-3 select">
                    <label for="feild" class="pb-2">ফিল্ড <span class="text-danger">*</span></label>
                    <select id="feild" class="form-control input_field form-input p-3" name="feild">
                        <option class="feild" value="null" disabled selected>ফিল্ড নির্বাচন করুন...</option>
                    </select>
                    <div id="field-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ফিল্ড নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="center" class="pb-2">কেন্দ্র <span class="text-danger">*</span></label>
                    <select id="center" class="form-control input_field form-input p-3" name="center">
                        <option class="feild" value="null" disabled selected>কেন্দ্র নির্বাচন করুন...</option>
                    </select>
                    <div id="center-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        কেন্দ্র নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="book" class="pb-2">বই নং <span class="text-danger">*</span></label>
                    <input type="hidden" id="hidden_book" value="" name="book_no">
                    <select id="book" class="form-control input_field form-input p-3" name="book">
                        <option class="feild" value="null" disabled selected>বই নির্বারচন করুন...</option>
                    </select>
                    <div id="book-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বই নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="officer" class="pb-2">নিবন্ধন অফিসার <span class="text-danger">*</span></label>
                    <select id="officer" class="form-control input_field form-input p-3" name="officer">
                    </select>
                    <div id="officer-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নিবন্ধন অফিসার নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="period" class="pb-2">সঞ্চয়ের সংগ্রহ ক্ষেত্র <span class="text-danger">*</span></label>
                    <select id="period" class="form-control input_field form-input p-3" name="period">
                        <option class="feild" value="null" disabled selected>ক্ষেত্র নির্বারচন করুন...</option>
                    </select>
                    <div id="period-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ক্ষেত্র নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="installment" class="pb-2">জমার পরিমাণ (টাকা) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="installment" name="installment">
                    <div id="installment-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        জমার পরিমাণ লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="expiry_date" class="pb-2">সঞ্চয়ের মেয়াদকাল <span class="text-danger">*</span></label>
                    <input type="date" class="form-control input_field form-input p-3" name="expiry_date" id="expiry_date">
                    <div id="expiry_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সঞ্চয়ের মেয়াদকাল লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="savings_installment" class="pb-2">কিস্তি সংখ্যা <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0" name="savings_installment" id="savings_installment">
                    <div id="savings_installment-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        কিস্তি সংখ্যা লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_taka_without_ints" class="pb-2">সর্বমোট টাকা (লাভ ছাড়া) <span class="text-danger">*</span></label>
                    <input type="number" id="total_taka_without_ints" name="total_taka_without_ints" hidden>
                    <input type="number" class="form-control input_field form-input p-3" id="total_taka_without_int" name="total_taka_without_int" value="0000" disabled>
                    <div id="total_taka_without_ints-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সর্বমোট টাকা (লাভ ছাড়া) দেওয়া হয়নি
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="interest" class="pb-2">লাভ (%) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0%" id="interest" name="interest">
                    <div id="interest-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সঞ্চয়ের লাভ লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_taka_with_ints" class="pb-2">সর্বমোট টাকা (লাভ সহ) <span class="text-danger">*</span></label>
                    <input type="number" id="total_taka_with_ints" name="total_taka_with_ints" hidden>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="সর্বমোট টাকা" id="total_taka_with_int" name="total_taka_with_int" disabled>
                    <div id="total_taka_with_ints-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সর্বমোট টাকা (লাভ সহ) দেওয়া হয়নি
                    </div>
                </div>
            </div>

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow my-3">
                <h4>সদস্য এর তথ্যাবলি</h4>
            </div>

            <!-- Client Information -->
            <div class="client_info row p-0 m-0">
                <div class="col-md-6 mb-3">
                    <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="সদস্য এর পুরো নাম লিখুন" id="name" name="name" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="husband_name" class="pb-2">স্বামীর নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="স্বামীর নাম লিখুন" id="husband_name" name="husband_name" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="father_name" class="pb-2">পিতার নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="পিতার নাম" id="father_name" name="father_name" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mother_name" class="pb-2">মাতার নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="মাতার নাম" id="mother_name" name="mother_name" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nid" class="pb-2">জাতীয় পরিচয় পত্রের নম্বর <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="জাতীয় পরিচয় পত্রের নম্বর" id="nid" name="nid" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="birth_reg_id_no" class="pb-2">জন্ম তারিখ <span class="text-danger">*</span></label>
                    <input type="date" class="form-control input_field form-input p-3" placeholder="জন্ম তারিখ" id="birth_reg_id_no" name="birth_reg_id_no" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="pb-2">পেশা <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="business" value="ব্যবসা" disabled>
                        <label class="form-check-label" for="business">
                            ব্যবসা
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="employee" value="চাকুরি" disabled>
                        <label class="form-check-label" for="employee">
                            চাকুরি
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="worker" value="শ্রমিক" disabled>
                        <label class="form-check-label" for="worker">
                            শ্রমিক
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="driver" value="ড্রাইভার" disabled>
                        <label class="form-check-label" for="driver">
                            ড্রাইভার
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="rikshaw_driver" value="রিক্সা চালক" disabled>
                        <label class="form-check-label" for="rikshaw_driver">
                            রিক্সা চালক
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="house_wife" value="গৃহিনী" disabled>
                        <label class="form-check-label" for="house_wife">
                            গৃহিনী
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="others_occapasion" value="অন্যান্য" disabled>
                        <label class="form-check-label" for="others_occapasion">
                            অন্যান্য
                        </label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="religion" class="pb-2">ধর্ম <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="islam" value="ইসলাম" disabled>
                        <label class="form-check-label" for="islam">
                            ইসলাম
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="hindu" value="হিন্দু" disabled>
                        <label class="form-check-label" for="hindu">
                            হিন্দু
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="bhuddist" value="বৌদ্ধ" disabled>
                        <label class="form-check-label" for="bhuddist">
                            বৌদ্ধ
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="cristian" value="খ্রিস্টান" disabled>
                        <label class="form-check-label" for="cristian">
                            খ্রিস্টান
                        </label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="pb-2">লিঙ্গ <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="পুরুষ" disabled>
                        <label class="form-check-label" for="male">
                            পুরুষ
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="মহিলা" disabled>
                        <label class="form-check-label" for="female">
                            মহিলা
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="gender" id="others_gender" value="অন্যান্য" disabled>
                        <label class="form-check-label" for="others_gender">
                            অন্যান্য
                        </label>
                    </div>
                </div>

                <!-- Clint Image -->
                <div class="col-md-6 mb-3">
                    <label class="pb-2">সদস্য ছবি <span class="text-danger">*</span></label><br>
                    <div class="text-start">
                        <label id="client_image" for="client_pic"><img id="image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image" disabled></label>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="pb-2">মোবাইল <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" id="phone_number" name="phone_number" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number_2" class="pb-2">মোবাইল - ২ (যদি থাকে)</label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" id="phone_number_2" name="phone_number_2" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="income" class="pb-2">বাৎসরিক আয় <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="বাৎসরিক আয়" id="income" name="income" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="position" class="pb-2">অবস্থান <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="A" value="A" disabled>
                        <label class="form-check-label" for="male">
                            A
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="B" value="B" disabled>
                        <label class="form-check-label" for="female">
                            B
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="C" value="C" disabled>
                        <label class="form-check-label" for="others_position">
                            C
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="D" value="C" disabled>
                        <label class="form-check-label" for="others_gender">
                            D
                        </label>
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="blood_group" class="pb-2">রক্তের গ্রুপ (যদি থাকে)</label>
                    <select id="blood_group" class="form-control input_field form-input p-3" name="blood_group" disabled>
                        <option class="feild" value="null" disabled selected>রক্তের গ্রুপ নির্বারচন করুন...</option>
                        <option value="A+">এ পজিটিভ (A+)</option>
                        <option value="A-">এ নেগেটিভ (A-)</option>
                        <option value="B+">বি পজিটিভ (B+)</option>
                        <option value="B-">বি নেগেটিভ (B-)</option>
                        <option value="O+">ও পজিটিভ (O+)</option>
                        <option value="O-">ও নেগেটিভ (O-)</option>
                        <option value="AB+">এবি পজিটিভ (AB+)</option>
                        <option value="AB-">এবি নেগেটিভ (AB-)</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bank_account" class="pb-2">ব্যাংক একাউন্ট (যদি থাকে)</label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="ব্যাংক একাউন্ট (যদি থাকে)" id="bank_account" name="bank_account" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="check_no" class="pb-2">চেক নং (যদি থাকে)</label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="চেক নং (যদি থাকে)" id="check_no" name="check_no" disabled>
                </div>

                <!-- Client Address -->
                <div class="form_section_heading pb-1 shadow my-3">
                    <h4>বর্তমান ঠিকানা</h4>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="client_present_address" class="pb-2">বর্তমান ঠিকানা</label>
                    <textarea class="form-control input_field p-3" id="client_present_address" name="client_present_address" rows="3" placeholder="বর্তমান ঠিকানা..." disabled></textarea>
                </div>
                <div class="form_section_heading pb-1 shadow my-3">
                    <h4>স্থায়ী ঠিকানা</h4>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="client_permanent_address" class="pb-2">স্থায়ী ঠিকানা</label>
                    <textarea class="form-control input_field p-3" id="client_permanent_address" name="client_permanent_address" rows="3" placeholder="স্থায়ী ঠিকানা..." disabled></textarea>
                </div>
            </div>

            <!-- Nominee Information Heading -->
            <div class="form_section_heading pb-1 shadow my-3">
                <h4>নমিনী এর তথ্যাবলি</h4>
            </div>

            <!-- Nominee Information -->
            <div class="nominee_info row p-0 m-0">
                <div class="col-md-6 mb-3">
                    <label for="nominee_name" class="pb-2">নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="নমিনী এর পুরো নাম" id="nominee_name" name="nominee_name">
                    <div id="nominee_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নমিনীর নাম লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nominee_husband_name" class="pb-2">স্বামীর নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="স্বামীর নাম" id="nominee_husband_name" name="nominee_husband_name">
                    <div id="nominee_husband_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নমিনীর স্বামীর / পিতার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nominee_father_name" class="pb-2">পিতার নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="পিতার নাম" id="nominee_father_name" name="nominee_father_name">
                    <div id="nominee_father_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নমিনীর স্বামীর / পিতার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nominee_mother_name" class="pb-2">মাতার নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="মাতার নাম" id="nominee_mother_name" name="nominee_mother_name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nominee_birth_reg_id_no" class="pb-2">জন্ম তারিখ</label>
                    <input type="date" class="form-control input_field form-input p-3" placeholder="জন্ম তারিখ" id="nominee_birth_reg_id_no" name="nominee_birth_reg_id_no">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nominee_nid" class="pb-2">জাতীয় পরিচয় পত্রের নম্বর</label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="জাতীয় পরিচয় পত্রের নম্বর" id="nominee_nid" name="nominee_nid">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="pb-2">পেশা <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="business" value="ব্যবসা">
                        <label class="form-check-label" for="business">
                            ব্যবসা
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="employee" value="চাকুরি">
                        <label class="form-check-label" for="employee">
                            চাকুরি
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="worker" value="শ্রমিক">
                        <label class="form-check-label" for="worker">
                            শ্রমিক
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="driver" value="ড্রাইভার">
                        <label class="form-check-label" for="driver">
                            ড্রাইভার
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="rikshaw_driver" value="রিক্সা চালক">
                        <label class="form-check-label" for="rikshaw_driver">
                            রিক্সা চালক
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="maleStudent" value="ছাত্র">
                        <label class="form-check-label" for="maleStudent">
                            ছাত্র
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="femaleStudent" value="ছাত্রী">
                        <label class="form-check-label" for="femaleStudent">
                            ছাত্রী
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="house_wife" value="গৃহিনী">
                        <label class="form-check-label" for="house_wife">
                            গৃহিনী
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="nominee_occapasion" id="others_occapasion" value="অন্যান্য">
                        <label class="form-check-label" for="others_occapasion">
                            অন্যান্য
                        </label>
                    </div>
                    <div id="nominee_occapasion-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নমিনীর পেশা নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="pb-2">সম্পর্ক <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="relation" id="husbandwife" value="স্বামী / স্ত্রী">
                        <label class="form-check-label" for="husbandwife">
                            স্বামী / স্ত্রী
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="relation" id="brothersister" value="ভাই / বোন">
                        <label class="form-check-label" for="brothersister">
                            ভাই / বোন
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="relation" id="fatherdaughter" value="বাবা / মেয়ে">
                        <label class="form-check-label" for="fatherdaughter">
                            বাবা / মেয়ে
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="relation" id="motherdaughter" value="মা / মেয়ে">
                        <label class="form-check-label" for="motherdaughter">
                            মা / মেয়ে
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="relation" id="sistersister" value="বোন / বোন">
                        <label class="form-check-label" for="sistersister">
                            বোন / বোন
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="relation" id="momson" value="মা / ছেলে">
                        <label class="form-check-label" for="momson">
                            মা / ছেলে
                        </label>
                    </div>
                    <div id="nominee_relation-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নমিনীর সম্পর্ক নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="pb-2">লিঙ্গ <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="nominee_gender" id="nominee_male" value="পুরুষ">
                        <label class="form-check-label" for="nominee_male">
                            পুরুষ
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="nominee_gender" id="nominee_female" value="মহিলা">
                        <label class="form-check-label" for="nominee_female">
                            মহিলা
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="nominee_gender" id="nominee_gender_others" value="অন্যান্য">
                        <label class="form-check-label" for="nominee_gender_others">
                            অন্যান্য
                        </label>
                    </div>
                    <div id="nominee_gender-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নমিনীর লিঙ্গ নির্বাচন করুন
                    </div>
                </div>
                <!-- Nominee Image -->
                <div class="col-md-6 mb-3">
                    <label class="pb-2">নমিনীর ছবি <span class="text-danger">*</span></label><br>
                    <div class="text-start">
                        <label id="nominee_image" for="nominee_pic"><img id="nominee_image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image"></label>
                        <input type="file" id="nominee_pic" name="nominee_pic" hidden />
                    </div>
                    <div id="nominee_img-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নমিনীর ছবি দিন
                    </div>
                </div>

                <!-- Nominee Address -->
                <div class="form_section_heading pb-1 shadow my-3">
                    <h4>নমিনীর ঠিকানা</h4>
                </div>
                <div class="col-12 mb-3">
                    <label for="nominee_input_home" class="form-label">বাড়ির এবং রাস্তার</label>
                    <input type="text" class="form-control input_field form-input p-3" id="nominee_input_home" placeholder="বাড়ির এবং রাস্তার নাম" name="nominee_input_home">
                    <div id="nominee_input_home-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বাড়ির এবং রাস্তার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nominee_input_city" class="form-label">গ্রাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="nominee_input_city" placeholder="গ্রামের নাম" name="nominee_input_city">
                    <div id="nominee_input_city-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        গ্রাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nominee_holding" class="form-label">ওয়ার্ড নম্বর <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="nominee_holding" placeholder="ওয়ার্ড নম্বর" name="nominee_holding">
                    <div id="nominee_holding-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ওয়ার্ড নম্বর দিন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nominee_sub_district" class="form-label">উপজেলা <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="nominee_sub_district" placeholder="উপজেলার নাম" name="nominee_sub_district">
                    <div id="nominee_sub_district-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        উপজেলার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nominee_post" class="form-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="nominee_post" placeholder="পোষ্ট অফিসের নাম" name="nominee_post">
                    <div id="nominee_post-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        পোষ্ট অফিসের নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nominee_district" class="form-label">জেলা <span class="text-danger">*</span></label>
                    <select id="nominee_district" class="form-control input_field form-input p-3 districts" name="nominee_district">
                    </select>
                    <div id="nominee_district-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        জেলার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3 select">
                    <label for="nominee_input_state" class="form-label">বিভাগ <span class="text-danger">*</span></label>
                    <select id="nominee_input_state" class="form-control input_field form-input p-3" name="nominee_input_state">
                        <option class="feild" value="null" disabled selected>বিভাগ নির্বাচন করুন...</option>
                        <option value="ঢাকা">ঢাকা</option>
                        <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                        <option value="খুলনা">খুলনা</option>
                        <option value="রংপুর">রংপুর</option>
                        <option value="বরিশাল">বরিশাল</option>
                        <option value="ময়মনসিংহ">ময়মনসিংহ</option>
                        <option value="সিলেট">সিলেট</option>
                        <option value="রাজশাহী">রাজশাহী</option>
                    </select>
                    <div id="nominee_input_state-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বিভাগের নাম লিখুন
                    </div>
                </div>
            </div>

            <!-- Form Buttons -->
            <div class="col-12">
                <button class="btn form-control btn-button">সাবমিট করুন</button>
            </div>
        </div>
    </form>
</div>

<?php
include "include/footer.php";
?>
<script>
    // Data Load Functions
    function loadField() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                fields: '1'
            },
            success: function(data) {
                $("#feild").html("");
                $("#feild").html(data);
                // console.log(data);
            }
        })
    }
    loadField();

    var field = "";
    $("#feild").on('change', function() {
        field = $(this).val();
        // console.log(field);
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                field: field
            },
            success: function(data) {
                $("#center").html("");
                $("#center").html(data);
            }
        })
    });

    $("#center").on('change', function() {
        var center = $(this).val();
        // console.log(field);
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                sField: field,
                center: center
            },
            success: function(data) {
                // console.log(data);
                $("#book").html("");
                $("#book").html(data);
            }
        })
    });

    $("#book").on('change', function() {
        var clientID = $(this).val();

        // console.log(books);
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                clientID: clientID
            },
            dataType: "JSON",
            success: function(data) {
                $.each(data, function(key, value) {
                    $("#name").val(value.name);
                    $("#hidden_book").val(value.book);
                    $("#husband_name").val(value.husbands_name);
                    $("#father_name").val(value.fathers_name);
                    $("#mother_name").val(value.mothers_name);
                    $("#nid").val(value.client_nid);
                    $("#birth_reg_id_no").val(value.client_dob);
                    $('input:radio[name="occapasion"]').filter('[value= "' + value.client_occupation + '"]').attr('checked', true);
                    $('input:radio[name="position"]').filter('[value= "' + value.client_position + '"]').attr('checked', true);
                    $('input:radio[name="religion"]').filter('[value= "' + value.religion + '"]').attr('checked', true);
                    $('input:radio[name="gender"]').filter('[value= "' + value.client_gander + '"]').attr('checked', true);
                    $("#image").attr('src', './img/' + value.client_img + '');
                    $("#phone_number").val(value.client_mobile_1);
                    $("#phone_number_2").val(value.client_mobile_2);
                    $("#income").val(value.client_income);
                    $("#blood_group").val(value.blood_grp);
                    $("#bank_account").val(value.client_back_acc);
                    $("#check_no").val(value.check_no);
                    $("#client_present_address").val(value.present_address);
                    $("#client_permanent_address").val(value.parmanent_address);

                })
            }
        })
    });

    function loadOfficer() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                officer: '1'
            },
            success: function(data) {
                $("#officer").html("");
                $("#officer").html(data);
            }
        })
    }
    loadOfficer();

    function loadPeriod() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                period: '%1%'
            },
            success: function(data) {
                $("#period").html("");
                $("#period").html(data);
            }
        })
    }
    loadPeriod();

    // $($('input[name=occapasion]')).on('change', function() {
    //     alert($('input[name=occapasion]:checked').val());
    // })
    var period = 0;
    // Total Savings Calculation
    $($("#period")).on('change', function() {
        period = $(this).find(':selected').data('days');
        // console.log(period);
    })

    $("#installment").on("keyup", function() {
        totalValue();
    })

    $("#savings_installment").on("keyup", function() {
        totalValue();
    })

    $("#interest").on("keyup", function() {
        totalValue();
    })

    function totalValue() {
        var installment = $("#installment").val();
        var savings_installment = $("#savings_installment").val();
        var interest = $("#interest").val();
        var ceil = Math.round(installment * savings_installment);
        var total = ceil;
        var total_int = ((total / 100) * interest);
        var total_with_int = Math.round(parseFloat(total) + parseFloat(total_int));
        $("#total_taka_without_ints").val(ceil);
        $("#total_taka_without_int").val(ceil);
        $("#total_taka_with_ints").val(total_with_int);
        $("#total_taka_with_int").val(total_with_int);
    }


    $("#savings_reg_form").on("submit", function(e) {
        e.preventDefault();
        // Form Primary Data
        var feild = $("#feild").val();
        var center = $("#center").val();
        var clientID = $("#book").val();
        var book = $("#hidden_book").val();
        var officer = $("#officer").val();
        var period = $("#period").val();
        var expiry_date = $("#expiry_date").val();
        var savings_installment = $("#savings_installment").val();
        var installment = $("#installment").val();
        var total_taka_without_ints = $("#total_taka_without_ints").val();
        var interest = $("#interest").val();
        var total_taka_with_ints = $("#total_taka_with_ints").val();

        // Nominee Personal Data
        var nominee_name = $("#nominee_name").val();
        var nominee_husband_name = $("#nominee_husband_name").val();
        var nominee_father_name = $("#nominee_father_name").val();
        var nominee_mother_name = $("#nominee_mother_name").val();
        var nominee_nid = $("#nominee_nid").val();
        var nominee_dob = $("#nominee_birth_reg_id_no").val();
        var nominee_occapasion = $('input[name=nominee_occapasion]:checked').val();
        var nominee_relation = $('input[name=relation]:checked').val();
        var nominee_gender = $('input[name=nominee_gender]:checked').val();
        var nominee_img = $('#nominee_pic').val();

        // Nominee parmanent Address
        var nominee_home = $('#nominee_input_home').val();
        var nominee_city = $('#nominee_input_city').val();
        var nominee_holding = $('#nominee_holding').val();
        var nominee_sub_district = $('#nominee_sub_district').val();
        var nominee_post = $('#nominee_post').val();
        var nominee_district = $('#nominee_district').val();
        var nominee_state = $('#nominee_input_state').val();

        // Form Validation
        if (feild == "" || feild == null) {
            $("#feild").addClass("is-invalid");
            $("#field-feedback").css("display", "block");
        }
        if (center == "" || center == null) {
            $("#center").addClass("is-invalid");
            $("#center-feedback").css("display", "block");
        }
        if (book == "" || book == null) {
            $("#book").addClass("is-invalid");
            $("#book-feedback").css("display", "block");
        }
        if (officer == "" || officer == null) {
            $("#officer").addClass("is-invalid");
            $("#officer-feedback").css("display", "block");
        }
        if (period == "" || period == null) {
            $("#period").addClass("is-invalid");
            $("#period-feedback").css("display", "block");
        }
        if (expiry_date == "" || expiry_date == null) {
            $("#expiry_date").addClass("is-invalid");
            $("#expiry_date-feedback").css("display", "block");
        }
        if (savings_installment == 0 || savings_installment == null) {
            $("#savings_installment").addClass("is-invalid");
            $("#savings_installment-feedback").css("display", "block");
        }
        if (installment == "" || installment == null) {
            $("#installment").addClass("is-invalid");
            $("#installment-feedback").css("display", "block");
        }
        if (interest == "" || interest == null) {
            $("#interest").addClass("is-invalid");
            $("#interest-feedback").css("display", "block");
        }
        if (total_taka_without_ints == 0 || total_taka_without_ints == null) {
            $("#total_taka_without_ints").addClass("is-invalid");
            $("#total_taka_without_ints-feedback").css("display", "block");
        }
        if (total_taka_with_ints == 0 || total_taka_with_ints == null) {
            $("#total_taka_with_ints").addClass("is-invalid");
            $("#total_taka_with_ints-feedback").css("display", "block");
        }


        // Nominee
        if (nominee_name == "" || nominee_name == null) {
            $("#nominee_name").addClass("is-invalid");
            $("#nominee_name-feedback").css("display", "block");
        }
        if ((nominee_husband_name == "" || nominee_husband_name == null) && (nominee_father_name == "" || nominee_father_name == null)) {
            $("#nominee_husband_name").addClass("is-invalid");
            $("#nominee_husband_name-feedback").css("display", "block");
            $("#nominee_father_name").addClass("is-invalid");
            $("#nominee_father_name-feedback").css("display", "block");
        }
        if (nominee_occapasion == "" || nominee_occapasion == null) {
            $("#nominee_occapasion-feedback").css("display", "block");
        }
        if (nominee_relation == "" || nominee_relation == null) {
            $("#nominee_relation-feedback").css("display", "block");
        }
        if (nominee_gender == "" || nominee_gender == null) {
            $("#nominee_gender-feedback").css("display", "block");
        }
        if (nominee_img == "" || nominee_img == null) {
            $("#nominee_img-feedback").css("display", "block");
        }

        // Nominee Adreess
        if (nominee_home == "" || nominee_home == null) {
            $("#nominee_input_home").addClass("is-invalid");
            $("#nominee_input_home-feedback").css("display", "block");
        }
        if (nominee_city == "" || nominee_city == null) {
            $("#nominee_input_city").addClass("is-invalid");
            $("#nominee_input_city-feedback").css("display", "block");
        }
        if (nominee_holding == "" || nominee_holding == null) {
            $("#nominee_holding").addClass("is-invalid");
            $("#nominee_holding-feedback").css("display", "block");
        }
        if (nominee_sub_district == "" || nominee_sub_district == null) {
            $("#nominee_sub_district").addClass("is-invalid");
            $("#nominee_sub_district-feedback").css("display", "block");
        }
        if (nominee_post == "" || nominee_post == null) {
            $("#nominee_post").addClass("is-invalid");
            $("#nominee_post-feedback").css("display", "block");
        }
        if (nominee_district == "" || nominee_district == null) {
            $("#nominee_district").addClass("is-invalid");
            $("#nominee_district-feedback").css("display", "block");
        }
        if (nominee_state == "" || nominee_state == null) {
            $("#nominee_input_state").addClass("is-invalid");
            $("#nominee_input_state-feedback").css("display", "block");
        }

        if (feild != "" && feild != null && center != "" && center != null && book != "" && book != null && officer != "" && officer != null && period != "" && period != null && expiry_date != "" && expiry_date != null && savings_installment != "" && savings_installment != null && installment != "" && installment != null && interest != "" && interest != null && total_taka_without_ints != 0 && total_taka_without_ints != null && total_taka_with_ints != 0 && total_taka_with_ints != null && nominee_name != "" && nominee_name != null && nominee_occapasion != "" && nominee_occapasion != null && nominee_relation != "" && nominee_relation != null && nominee_gender != "" && nominee_gender != null && nominee_img != "" && nominee_img != null && nominee_home != "" && nominee_home != null && nominee_city != "" && nominee_city != null && nominee_holding != "" && nominee_holding != null && nominee_sub_district != "" && nominee_sub_district != null && nominee_post != "" && nominee_post != null && nominee_district != "" && nominee_district != null && nominee_state != "" && nominee_state != null) {
            var formData = new FormData(this);
            $.ajax({
                url: "codes/savingsAuthenticate.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#overlayer").fadeIn();
                    $("#preloader").fadeIn();
                },
                success: function(data) {
                    $("#overlayer").fadeOut();
                    $("#preloader").fadeOut();
                    if (data == "image_ext_error") {
                        swal.fire({
                            title: "নিচে দেয়া ফরমেটের ছবি ব্যবহার করুন",
                            text: "'jpg', 'jpeg', 'png', 'webp'",
                            icon: "error",
                            buttons: "Cancel",
                            dangerMode: true,
                        })
                    }
                    if (data == "image_size_error") {
                        swal.fire({
                            title: "২ এমবির ছোট ছবি ব্যবহার করুন",
                            text: "",
                            icon: "error",
                            buttons: "Cancel",
                            dangerMode: true,
                        })
                    }
                    if (data == "book_exist") {
                        swal.fire({
                            title: "দুঃখিত",
                            text: book + " নম্বর বই ইতোমধ্যে নিবন্ধিত রয়েছে",
                            icon: 'error',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    }
                    if (data == 1) {
                        $("#savings_reg_form").trigger("reset");
                        $("select").select2("destroy");
                        $("select").select2();
                        loadField();
                        loadPeriod();
                        loadOfficer();
                        swal.fire({
                            title: "অভিনন্দন",
                            text: "সদস্য নিবন্ধিত হয়েছে",
                            icon: 'success',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    }
                    if (data == 0) {
                        swal.fire({
                            title: "দুঃখিত",
                            text: "সদস্য নিবন্ধিত হয়নি। আবার চেষ্টা করুন",
                            icon: 'error',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    }
                }
            })
        } else {
            swal.fire({
                title: "দুঃখিত",
                text: "ফরম পূরণ হয়নি । আবার চেষ্টা করুন",
                icon: 'error',
                buttons: "OK",
                dangerMode: true,
            })
        }

    })
</script>
</body>

</html>