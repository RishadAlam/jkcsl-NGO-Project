<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($regForm1 == 0) {
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
        <h2 class="text-center">নতুন সদস্য নিবন্ধন ফরম</h2>
    </div>
    <form action="#" id="savings_reg_form">
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
                <div class="col-md-6 mb-3">
                    <label for="book" class="pb-2">বই নম্বর <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="নতুন বই নম্বর লিখুন" id="book" name="book">
                    <div id="book-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নতুন বই নম্বর লিখুন
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
                    <label for="expiry_date" class="pb-2">সঞ্চয়ের মেয়াদকাল (মাস) <span class="text-danger">*</span></label>
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
                    <input type="text" class="form-control input_field form-input p-3" placeholder="সদস্য এর পুরো নাম লিখুন" id="name" name="name">
                    <div id="client_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নাম লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="husband_name" class="pb-2">স্বামীর নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="স্বামীর নাম লিখুন" id="husband_name" name="husband_name">
                    <div id="husband_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        পিতা / স্বামীর নাম লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="father_name" class="pb-2">পিতার নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="পিতার নাম" id="father_name" name="father_name">
                    <div id="father_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        পিতা / স্বামীর নাম লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mother_name" class="pb-2">মাতার নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="মাতার নাম" id="mother_name" name="mother_name">
                    <div id="mother_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        মাতার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nid" class="pb-2">জাতীয় পরিচয় পত্রের নম্বর <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="জাতীয় পরিচয় পত্রের নম্বর" id="nid" name="nid">
                    <div id="nid-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        জাতীয় পরিচয় পত্রের নম্বর লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="birth_reg_id_no" class="pb-2">জন্ম তারিখ <span class="text-danger">*</span></label>
                    <input type="date" class="form-control input_field form-input p-3" placeholder="জন্ম তারিখ" id="birth_reg_id_no" name="birth_reg_id_no">
                    <div id="birth_reg_id_no-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        জন্ম তারিখ লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="pb-2">পেশা <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="business" value="ব্যবসা">
                        <label class="form-check-label" for="business">
                            ব্যবসা
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="employee" value="চাকুরি">
                        <label class="form-check-label" for="employee">
                            চাকুরি
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="worker" value="শ্রমিক">
                        <label class="form-check-label" for="worker">
                            শ্রমিক
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="driver" value="ড্রাইভার">
                        <label class="form-check-label" for="driver">
                            ড্রাইভার
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="rikshaw_driver" value="রিক্সা চালক">
                        <label class="form-check-label" for="rikshaw_driver">
                            রিক্সা চালক
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="house_wife" value="গৃহিনী">
                        <label class="form-check-label" for="house_wife">
                            গৃহিনী
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" name="occapasion" id="others_occapasion" value="অন্যান্য">
                        <label class="form-check-label" for="others_occapasion">
                            অন্যান্য
                        </label>
                    </div>
                    <div id="client_occapasion-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        পেশা নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="religion" class="pb-2">ধর্ম <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="islam" value="ইসলাম">
                        <label class="form-check-label" for="islam">
                            ইসলাম
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="hindu" value="হিন্দু">
                        <label class="form-check-label" for="hindu">
                            হিন্দু
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="bhuddist" value="বৌদ্ধ">
                        <label class="form-check-label" for="bhuddist">
                            বৌদ্ধ
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="religion" id="cristian" value="খ্রিস্টান">
                        <label class="form-check-label" for="cristian">
                            খ্রিস্টান
                        </label>
                    </div>
                    <div id="client_religion-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ধর্ম নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="pb-2">লিঙ্গ <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="পুরুষ">
                        <label class="form-check-label" for="male">
                            পুরুষ
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="মহিলা">
                        <label class="form-check-label" for="female">
                            মহিলা
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="gender" id="others_gender" value="অন্যান্য">
                        <label class="form-check-label" for="others_gender">
                            অন্যান্য
                        </label>
                    </div>
                    <div id="client_gender-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        লিঙ্গ নির্বাচন করুন
                    </div>
                </div>

                <!-- Clint Image -->
                <div class="col-md-6 mb-3">
                    <label class="pb-2">সদস্য ছবি <span class="text-danger">*</span></label><br>
                    <div class="text-start">
                        <label id="client_image" for="client_pic"><img id="image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image"></label>
                        <input type="file" id="client_pic" name="client_pic" hidden />
                    </div>
                    <div id="client_img-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সদস্য ছবি দিন
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="pb-2">মোবাইল <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" id="phone_number" name="phone_number">
                    <div id="client_mobile-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        মোবাইল নম্বর দিন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number_2" class="pb-2">মোবাইল - ২ (যদি থাকে)</label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" id="phone_number_2" name="phone_number_2">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="income" class="pb-2">বাৎসরিক আয় <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="বাৎসরিক আয়" id="income" name="income">
                    <div id="client_income-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বাৎসরিক আয় দিন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="position" class="pb-2">অবস্থান <span class="text-danger">*</span></label><br>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="A" value="A">
                        <label class="form-check-label" for="male">
                            A
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="B" value="B">
                        <label class="form-check-label" for="female">
                            B
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="C" value="C">
                        <label class="form-check-label" for="others_position">
                            C
                        </label>
                    </div>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="position" id="D" value="C">
                        <label class="form-check-label" for="others_gender">
                            D
                        </label>
                    </div>
                    <div id="client_position-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        অবস্থান নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="blood_group" class="pb-2">রক্তের গ্রুপ (যদি থাকে)</label>
                    <select id="blood_group" class="form-control input_field form-input p-3" name="blood_group">
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
                    <input type="number" class="form-control input_field form-input p-3" placeholder="ব্যাংক একাউন্ট (যদি থাকে)" id="bank_account" name="bank_account">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="check_no" class="pb-2">চেক নং (যদি থাকে)</label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="চেক নং (যদি থাকে)" id="check_no" name="check_no">
                </div>

                <!-- Client Address -->
                <div class="form_section_heading pb-1 shadow my-3">
                    <h4>বর্তমান ঠিকানা</h4>
                </div>
                <div class="col-12 mb-3">
                    <label for="inputhome" class="form-label">বাড়ির এবং রাস্তার <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="inputhome" placeholder="বাড়ির এবং রাস্তার নাম" name="inputhome">
                    <div id="client_home-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বাড়ির এবং রাস্তার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="inputCity" class="form-label">গ্রাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="inputCity" placeholder="গ্রামের নাম" name="inputCity">
                    <div id="client_city-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        গ্রাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="holding" class="form-label">ওয়ার্ড নম্বর <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="holding" placeholder="ওয়ার্ড নম্বর" name="holding">
                    <div id="client_holding-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ওয়ার্ড নম্বর দিন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="sub_district" class="form-label">উপজেলা <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="sub_district" placeholder="উপজেলার নাম" name="sub_district">
                    <div id="client_sub_district-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        উপজেলার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="post" class="form-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="post" placeholder="পোষ্ট অফিসের নাম" name="post">
                    <div id="client_post-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        পোষ্ট অফিসের নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="district" class="form-label">জেলা <span class="text-danger">*</span></label>
                    <select id="district" class="form-control input_field form-input p-3 districts" name="district">
                    </select>
                    <div id="client_district-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        জেলার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3 select">
                    <label for="inputState" class="form-label">বিভাগ <span class="text-danger">*</span></label>
                    <select id="inputState" class="form-control input_field form-input p-3" name="inputState">
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
                    <div id="client_state-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বিভাগের নাম লিখুন
                    </div>
                </div>
                <div class="form_section_heading pb-1 shadow my-3">
                    <h4>স্থায়ী ঠিকানা</h4>
                </div>
                <div class="col-12 mb-3 text-end">
                    <label class="form-check-label" style="cursor: pointer;" for="add_checkbox">যদি বর্তমান ঠিকানা এবং স্থায়ী ঠিকানা একই হয় </label>
                    <input type="checkbox" class="form-check-input" style="cursor: pointer;" id="add_checkbox">
                </div>
                <div class="col-12 mb-3">
                    <label for="parmanent_inputAddress" class="form-label">বাড়ির এবং রাস্তার</label>
                    <input type="text" class="form-control input_field form-input p-3" id="parmanent_inputAddress" placeholder="বাড়ির এবং রাস্তার নাম" name="parmanent_inputAddress">
                    <div id="client_p_home-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বাড়ির এবং রাস্তার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="parmanent_inputCity" class="form-label">গ্রাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="parmanent_inputCity" placeholder="গ্রামের নাম" name="parmanent_inputCity">
                    <div id="client_p_city-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        গ্রাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="parmanent_holding" class="form-label">ওয়ার্ড নম্বর <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="parmanent_holding" placeholder="ওয়ার্ড নম্বর" name="parmanent_holding">
                    <div id="client_p_holding-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ওয়ার্ড নম্বর দিন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="parmanent_sub_district" class="form-label">উপজেলা <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="parmanent_sub_district" placeholder="উপজেলার নাম" name="parmanent_sub_district">
                    <div id="client_p_sub_district-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        উপজেলার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="parmanent_post" class="form-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input_field form-input p-3" id="parmanent_post" placeholder="পোষ্ট অফিসের নাম" name="parmanent_post">
                    <div id="client_p_post-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        পোষ্ট অফিসের নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="parmanent_district" class="form-label">জেলা <span class="text-danger">*</span></label>
                    <select id="parmanent_district" class="form-control input_field form-input p-3 districts" name="parmanent_district">
                    </select>
                    <div id="client_p_district-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        জেলার নাম লিখুন
                    </div>
                </div>
                <div class="col-md-4 mb-3 select">
                    <label for="parmanent_inputState" class="form-label">বিভাগ <span class="text-danger">*</span></label>
                    <select id="parmanent_inputState" class="form-control input_field form-input p-3" name="parmanent_inputState">
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
                    <div id="client_p_state-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বিভাগের নাম লিখুন
                    </div>
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
                    <label for="nominee_mother_name" class="pb-2">মাতার নাম </label>
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
                        <label id="nominee_image" for="nominee_pic"><img id="nomine_image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image"></label>
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
                <div class="col-12 mb-3 text-end">
                    <label class="form-check-label" style="cursor: pointer;" for="nominee_add_checkbox">যদি সদস্যের ঠিকানা এবং নমিনীর ঠিকানা একই হয় </label>
                    <input type="checkbox" class="form-check-input" style="cursor: pointer;" id="nominee_add_checkbox">
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
    $(document).ready(function() {
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

        $("#feild").on('change', function() {
            var field = $(this).val();
            console.log(field);
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

        // Adress auto fillup
        $("#add_checkbox").on("click", function() {
            if ($(this).is(':checked')) {
                $("#parmanent_inputAddress").val($("#inputhome").val());
                $("#parmanent_inputCity").val($("#inputCity").val());
                $("#parmanent_holding").val($("#holding").val());
                $("#parmanent_sub_district").val($("#sub_district").val());
                $("#parmanent_post").val($("#post").val());
                $("#parmanent_district").val($("#district").val()).trigger('change');
                $("#parmanent_inputState").val($("#inputState").val()).trigger('change');
            }
        })

        $("#nominee_add_checkbox").on("click", function() {
            if ($(this).is(':checked')) {
                $("#nominee_input_home").val($("#inputhome").val());
                $("#nominee_input_city").val($("#inputCity").val());
                $("#nominee_holding").val($("#holding").val());
                $("#nominee_sub_district").val($("#sub_district").val());
                $("#nominee_post").val($("#post").val());
                $("#nominee_district").val($("#district").val()).trigger('change');
                $("#nominee_input_state").val($("#inputState").val()).trigger('change');
            }
        })


        $("#savings_reg_form").on("submit", function(e) {
            e.preventDefault();
            // Form Primary Data
            var feild = $("#feild").val();
            var center = $("#center").val();
            var book = $("#book").val();
            var officer = $("#officer").val();
            var period = $("#period").val();
            var expiry_date = $("#expiry_date").val();
            var savings_installment = $("#savings_installment").val();
            var installment = $("#installment").val();
            var total_taka_without_ints = $("#total_taka_without_ints").val();
            var interest = $("#interest").val();
            var total_taka_with_ints = $("#total_taka_with_ints").val();

            // Personal Data
            var client_name = $("#name").val();
            var client_husband_name = $("#husband_name").val();
            var client_father_name = $("#father_name").val();
            var client_mother_name = $("#mother_name").val();
            var client_nid = $("#nid").val();
            var client_dob = $("#birth_reg_id_no").val();
            var client_occapasion = $('input[name=occapasion]:checked').val();
            var client_religion = $('input[name=religion]:checked').val();
            var client_gender = $('input[name=gender]:checked').val();
            var client_position = $('input[name=position]:checked').val();
            var client_income = $('#income').val();
            var client_img = $('#client_pic').val();
            var client_mobile = $('#phone_number').val();
            var client_mobile_2 = $('#phone_number_2').val();
            var client_blood = $('#blood_group').val();
            var client_bank_account = $('#bank_account').val();
            var client_check_no = $('#check_no').val();

            // Client present Address
            var client_home = $('#inputhome').val();
            var client_city = $('#inputCity').val();
            var client_holding = $('#holding').val();
            var client_sub_district = $('#sub_district').val();
            var client_post = $('#post').val();
            var client_district = $('#district').val();
            var client_state = $('#inputState').val();

            // Client parmanent Address
            var client_p_home = $('#parmanent_inputAddress').val();
            var client_p_city = $('#parmanent_inputCity').val();
            var client_p_holding = $('#parmanent_holding').val();
            var client_p_sub_district = $('#parmanent_sub_district').val();
            var client_p_post = $('#parmanent_post').val();
            var client_p_district = $('#parmanent_district').val();
            var client_p_state = $('#parmanent_inputState').val();

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
            if (client_name == "" || client_name == null) {
                $("#client_name").addClass("is-invalid");
                $("#client_name-feedback").css("display", "block");
            }
            if ((client_husband_name == "" || client_husband_name == null) && (client_father_name == "" || client_father_name == null)) {
                $("#husband_name").addClass("is-invalid");
                $("#husband_name-feedback").css("display", "block");
                $("#father_name").addClass("is-invalid");
                $("#father_name-feedback").css("display", "block");
            }
            if (client_mother_name == "" || client_mother_name == null) {
                $("#mother_name").addClass("is-invalid");
                $("#mother_name-feedback").css("display", "block");
            }
            if (client_nid == "" || client_nid == null) {
                $("#nid").addClass("is-invalid");
                $("#nid-feedback").css("display", "block");
            }
            if (client_dob == "" || client_dob == null) {
                $("#birth_reg_id_no").addClass("is-invalid");
                $("#birth_reg_id_no-feedback").css("display", "block");
            }
            if (client_occapasion == "" || client_occapasion == null) {
                $("#client_occapasion-feedback").css("display", "block");
            }
            if (client_religion == "" || client_religion == null) {
                $("#client_religion-feedback").css("display", "block");
            }
            if (client_gender == "" || client_gender == null) {
                $("#client_gender-feedback").css("display", "block");
            }
            if (client_position == "" || client_position == null) {
                $("#client_position-feedback").css("display", "block");
            }
            if (client_img == "" || client_img == null) {
                $("#client_img-feedback").css("display", "block");
            }
            if (client_mobile == "" || client_mobile == null) {
                $("#phone_number").addClass("is-invalid");
                $("#client_mobile-feedback").css("display", "block");
            }
            if (client_income == "" || client_income == null) {
                $("#income").addClass("is-invalid");
                $("#client_income-feedback").css("display", "block");
            }

            // Adreess
            if (client_home == "" || client_home == null) {
                $("#inputhome").addClass("is-invalid");
                $("#client_home-feedback").css("display", "block");
            }
            if (client_city == "" || client_city == null) {
                $("#inputCity").addClass("is-invalid");
                $("#client_city-feedback").css("display", "block");
            }
            if (client_holding == "" || client_holding == null) {
                $("#holding").addClass("is-invalid");
                $("#client_holding-feedback").css("display", "block");
            }
            if (client_sub_district == "" || client_sub_district == null) {
                $("#sub_district").addClass("is-invalid");
                $("#client_sub_district-feedback").css("display", "block");
            }
            if (client_post == "" || client_post == null) {
                $("#post").addClass("is-invalid");
                $("#client_post-feedback").css("display", "block");
            }
            if (client_district == "" || client_district == null) {
                $("#district").addClass("is-invalid");
                $("#client_district-feedback").css("display", "block");
            }
            if (client_state == "" || client_state == null) {
                $("#inputState").addClass("is-invalid");
                $("#client_state-feedback").css("display", "block");
            }
            if (client_p_home == "" || client_p_home == null) {
                $("#parmanent_inputAddress").addClass("is-invalid");
                $("#client_p_home-feedback").css("display", "block");
            }
            if (client_p_city == "" || client_p_city == null) {
                $("#parmanent_inputCity").addClass("is-invalid");
                $("#client_p_city-feedback").css("display", "block");
            }
            if (client_p_holding == "" || client_p_holding == null) {
                $("#parmanent_holding").addClass("is-invalid");
                $("#client_p_holding-feedback").css("display", "block");
            }
            if (client_p_sub_district == "" || client_p_sub_district == null) {
                $("#parmanent_sub_district").addClass("is-invalid");
                $("#client_p_sub_district-feedback").css("display", "block");
            }
            if (client_p_post == "" || client_p_post == null) {
                $("#parmanent_post").addClass("is-invalid");
                $("#client_p_post-feedback").css("display", "block");
            }
            if (client_p_district == "" || client_p_district == null) {
                $("#parmanent_district").addClass("is-invalid");
                $("#client_p_district-feedback").css("display", "block");
            }
            if (client_p_state == "" || client_p_state == null) {
                $("#parmanent_inputState").addClass("is-invalid");
                $("#client_p_state-feedback").css("display", "block");
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

            if (feild != "" && feild != null && center != "" && center != null && book != "" && book != null && officer != "" && officer != null && period != "" && period != null && expiry_date != "" && expiry_date != null && savings_installment != "" && savings_installment != null && installment != "" && installment != null && interest != "" && interest != null && total_taka_without_ints != 0 && total_taka_without_ints != null && total_taka_with_ints != 0 && total_taka_with_ints != null && client_name != "" && client_name != null && client_mother_name != "" && client_mother_name != null && client_nid != "" && client_nid != null && client_dob != "" && client_dob != null && client_occapasion != "" && client_occapasion != null && client_religion != "" && client_religion != null && client_gender != "" && client_gender != null && client_img != "" && client_img != null && client_mobile != "" && client_mobile != null && client_home != "" && client_home != null && client_city != "" && client_city != null && client_holding != "" && client_holding != null && client_sub_district != "" && client_sub_district != null && client_post != "" && client_post != null && client_district != "" && client_district != null && client_state != "" && client_state != null && client_p_home != "" && client_p_home != null && client_p_city != "" && client_p_city != null && client_p_holding != "" && client_p_holding != null && client_p_sub_district != "" && client_p_sub_district != null && client_p_post != "" && client_p_post != null && client_p_district != "" && client_p_district != null && client_p_state != "" && client_p_state != null && nominee_name != "" && nominee_name != null && nominee_occapasion != "" && nominee_occapasion != null && nominee_relation != "" && nominee_relation != null && nominee_gender != "" && nominee_gender != null && nominee_img != "" && nominee_img != null && nominee_home != "" && nominee_home != null && nominee_city != "" && nominee_city != null && nominee_holding != "" && nominee_holding != null && nominee_sub_district != "" && nominee_sub_district != null && nominee_post != "" && nominee_post != null && nominee_district != "" && nominee_district != null && nominee_state != "" && nominee_state != null && client_position != "" && client_position != null && client_income != "" && client_income != null) {
                var formData = new FormData(this);
                $.ajax({
                    url: "codes/clientAuthenticate.php",
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
                        if (data == "client_nid_exist") {
                            swal.fire({
                                title: "দুঃখিত",
                                text: client_nid + " এন-আই-ডি নম্বর ইতোমধ্য নিবন্ধিত রয়েছে",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 1) {
                            $("#savings_reg_form").trigger("reset");
                            $("select").select2("destroy");
                            $("select").select2();
                            $("#client_image").html('<img id="image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image">');
                            $("#nominee_image").html('<img id="nomine_image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image">');
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
                    text: "ফরম পুরণ হয়নি",
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }

        })
    })
</script>
</body>

</html>