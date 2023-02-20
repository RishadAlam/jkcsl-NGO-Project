<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($clientAcc == 0) {
    redirect("404");
    ob_end_flush();
}
?>
<!-- Breadcrumb -->
<div id="breadcrumb">
    <div class="container_fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= baseUrl('/') ?>">ড্যাশবোর্ড</a></li>
                <li class="breadcrumb-item">ফিল্ড</li>
                <li class="breadcrumb-item"><a href="<?= baseUrl('field') ?>?field=<?= $_GET['field'] ?>" id="breadcrumb_name"></a></li>
                <li class="breadcrumb-item">কেন্দ্র</li>
                <li class="breadcrumb-item"><a href="<?= baseUrl('centers') ?>?center=<?= $_GET['center'] ?>" id="breadcrumb_subname"></a></li>
                <li class="breadcrumb-item active" aria-current="page">সদস্য প্রোফাইল</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Client Profile -->
<div class="client_profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="profile_intro">
                    <div class="img rounded">
                        <img id="client_img" src="<?= baseUrl('/') ?>img/pngfind.com-copyright-png-938050.png" alt="">
                    </div>
                    <div class=" p_status text-center my-3">
                        <span class="d-inline-block py-2 px-4 text-capitalize rounded" style="color: #fff; font-size: 18px;" id="status"></span>
                    </div>
                    <div class="p-short">
                        <ul>
                            <li class="text-center name" id="name"></li>
                            <li class="d-flex justify-content-between">বই নম্বর <span id="book">3012</span></li>
                            <li class="d-flex justify-content-between">ফিল্ড <span id="field_name"></span></li>
                            <li class="d-flex justify-content-between">কেন্দ্র <span id="center_name"></span></li>
                            <li class="d-flex justify-content-between">মোবাইল <span id="phone1"></span></li>
                            <li class="d-flex justify-content-between">যোগদান তারিখ <span id="start_date"></span></li>
                            <li class="d-flex justify-content-between">ক্লোজের তারিখ <span id="close_at"></span></li>
                            <?php
                            if ($_SESSION['auth']['user_role'] == '0') {
                            ?>
                                <button id="credentials_edit" class="btn btn-sm my-3 px-3 form-control rounden bg-danger text-center d-inline-block text-white" data-bs-toggle="modal" data-bs-target="#credentials">ইডিট</button>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile_details">
                    <div data-addui='tabs'>
                        <div role='tabs'>
                            <div>সদস্য প্রোফাইল</div>
                            <div>সঞ্চয় প্রোফাইল</div>
                            <div>ঋণ প্রোফাইল</div>
                        </div>
                        <div role='contents' class="contents mt-3 p-3">
                            <div class="p_details">
                                <div class="row">
                                    <div class="form_section_heading d-flex justify-content-between pb-1 shadow my-3">
                                        <h4>সদস্য পরিচিতি</h4>
                                        <span class="text-white-50">Last Update: <small class="text-danger" id="update_date"></small></span>
                                    </div>
                                    <div class="client_info row">
                                        <div class="col-md-6 my-3">
                                            <p>স্বামীঃ <span id="husband"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>পিতাঃ <span id="father"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>মাতাঃ <span id="mother"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>জাতীয় পরিচয় পত্রের নম্বরঃ <span id="nid"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>জন্ম তারিখঃ <span id="dob"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>পেশাঃ <span id="occupation"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>ধর্মঃ <span id="religion"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>লিঙ্গঃ <span id="gender"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>মোবাইল-২ঃ <span id="phone2"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>রক্তের গ্রুপঃ <span id="blood"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>বাৎসরিক আয়ঃ <span id="anual_income"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>অবস্থানঃ <span id="position"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>ব্যাংক একাউন্টঃ <span id="bank_acc"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>চেক নংঃ <span id="bank_check"></span></p>
                                        </div>
                                    </div>
                                    <div class="form_section_heading pb-1 shadow my-3">
                                        <h4>বর্তমান ঠিকানা</h4>
                                    </div>
                                    <div class="present_address row">
                                        <div class="col-md-12 my-3">
                                            <p id="present_address"></p>
                                        </div>
                                    </div>
                                    <div class="form_section_heading pb-1 shadow my-3">
                                        <h4>স্থায়ী ঠিকানা</h4>
                                    </div>
                                    <div class="permanant_address row">
                                        <div class="col-md-12 my-3">
                                            <p id="parmanent_address"></p>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm my-3 px-3 form-control rounden bg-warning text-center d-inline-block text-white" id="notif_view" data-bs-toggle="modal" data-bs-target="#message">ইডিট</a>
                                    <?php
                                    if ($_SESSION['auth']['user_role'] == '0') {
                                    ?>
                                        <button type="button" class="btn btn-sm px-3 form-control rounden bg-danger text-center d-inline-block text-white" id="register_delete">ডিলিট</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div>
                                <ul class="tab-wrap d-flex justify-content-between" id="clientSavings">
                                </ul>
                            </div>
                            <div>
                                <ul class="tab-wrap d-flex justify-content-between" id="clientLoan">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="credentials" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ফিল্ড এবং কেন্দ্র পরিবর্তন ফরম</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="credentials_update_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 select">
                            <label for="feild" class="pb-2">ফিল্ড <span class="text-danger">*</span></label>
                            <select id="feild" class="form-control input_field form-input p-3" name="feild">
                                <option class="feild" value="null" disabled selected>ফিল্ড নির্বারচন করুন...</option>

                            </select>
                            <input type="hidden" id="client_id" name="client_id" value="<?= $_GET['client'] ?>">
                            <div id="field-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ফিল্ড নির্বাচন করুন
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 select">
                            <label for="center" class="pb-2">কেন্দ্র <span class="text-danger">*</span></label>
                            <select id="center" class="form-control input_field form-input p-3" name="center">
                                <option class="feild" value="null" disabled selected>কেন্দ্র নির্বারচন করুন...</option>

                            </select>
                            <div id="center-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                কেন্দ্র নির্বারচন করুন
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="close">ক্লোজ</button>
                    <button type="submit" id="credentials_submit_btn" class="btn rounded btn-button">সাবমিট করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="show_messages">
    <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">প্রোফাইল ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" id="modal_close" aria-label="Close"></button>
                </div>
                <form id="client_profile_edit_form">
                    <div class="modal-body" id="modal_body">
                        <div class="row">
                            <!-- Form Information -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                                <input type="hidden" id="up_id" name="up_id">
                                <input type="text" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="সদস্য এর পুরো নাম লিখুন" id="up_name" name="name">
                                <div id="client_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    নাম লিখুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="husband_name" class="pb-2">স্বামীর নাম</label>
                                <input type="text" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="স্বামীর নাম লিখুন" id="up_husband_name" name="husband_name">
                                <div id="husband_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    পিতা / স্বামীর নাম লিখুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="father_name" class="pb-2">পিতার নাম</label>
                                <input type="text" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="পিতার নাম" id="up_father_name" name="father_name">
                                <div id="father_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    পিতা / স্বামীর নাম লিখুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="mother_name" class="pb-2">মাতার নাম <span class="text-danger">*</span></label>
                                <input type="text" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="মাতার নাম" id="up_mother_name" name="mother_name">
                                <div id="mother_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    মাতার নাম লিখুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="nid" class="pb-2">জাতীয় পরিচয় পত্রের নম্বর <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="জাতীয় পরিচয় পত্রের নম্বর" id="up_nid" name="nid">
                                <div id="nid-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    জাতীয় পরিচয় পত্রের নম্বর লিখুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="birth_reg_id_no" class="pb-2">জন্ম তারিখ <span class="text-danger">*</span></label>
                                <input type="date" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="জন্ম তারিখ" id="birth_reg_id_no" name="birth_reg_id_no">
                                <div id="birth_reg_id_no-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    জন্ম তারিখ লিখুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label class="pb-2">পেশা <span class="text-danger">*</span></label><br>
                                <div class="form-check d-inline-block me-2">
                                    <input class="form-check-input" type="radio" name="up_occapasion" id="business" value="ব্যবসা">
                                    <label class="form-check-label" for="business">
                                        ব্যবসা
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-2">
                                    <input class="form-check-input" type="radio" name="up_occapasion" id="employee" value="চাকুরি">
                                    <label class="form-check-label" for="employee">
                                        চাকুরি
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-2">
                                    <input class="form-check-input" type="radio" name="up_occapasion" id="worker" value="শ্রমিক">
                                    <label class="form-check-label" for="worker">
                                        শ্রমিক
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-2">
                                    <input class="form-check-input" type="radio" name="up_occapasion" id="driver" value="ড্রাইভার">
                                    <label class="form-check-label" for="driver">
                                        ড্রাইভার
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-2">
                                    <input class="form-check-input" type="radio" name="up_occapasion" id="rikshaw_driver" value="রিক্সা চালক">
                                    <label class="form-check-label" for="rikshaw_driver">
                                        রিক্সা চালক
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-2">
                                    <input class="form-check-input" type="radio" name="up_occapasion" id="house_wife" value="গৃহিনী">
                                    <label class="form-check-label" for="house_wife">
                                        গৃহিনী
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-2">
                                    <input class="form-check-input" type="radio" name="up_occapasion" id="others_occapasion" value="অন্যান্য">
                                    <label class="form-check-label" for="others_occapasion">
                                        অন্যান্য
                                    </label>
                                </div>
                                <div id="client_occapasion-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    পেশা নির্বাচন করুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="religion" class="pb-2">ধর্ম <span class="text-danger">*</span></label><br>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_religion" id="islam" value="ইসলাম">
                                    <label class="form-check-label" for="islam">
                                        ইসলাম
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_religion" id="hindu" value="হিন্দু">
                                    <label class="form-check-label" for="hindu">
                                        হিন্দু
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_religion" id="bhuddist" value="বৌদ্ধ">
                                    <label class="form-check-label" for="bhuddist">
                                        বৌদ্ধ
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_religion" id="cristian" value="খ্রিস্টান">
                                    <label class="form-check-label" for="cristian">
                                        খ্রিস্টান
                                    </label>
                                </div>
                                <div id="client_religion-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    ধর্ম নির্বাচন করুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="gender" class="pb-2">লিঙ্গ <span class="text-danger">*</span></label><br>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_gender" id="male" value="পুরুষ">
                                    <label class="form-check-label" for="male">
                                        পুরুষ
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_gender" id="female" value="মহিলা">
                                    <label class="form-check-label" for="female">
                                        মহিলা
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_gender" id="others_gender" value="অন্যান্য">
                                    <label class="form-check-label" for="others_gender">
                                        অন্যান্য
                                    </label>
                                </div>
                                <div id="client_gender-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    লিঙ্গ নির্বাচন করুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="phone_number" class="pb-2">মোবাইল <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" id="up_phone_number" name="phone_number">
                                <div id="client_mobile-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    মোবাইল নম্বর দিন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="phone_number_2" class="pb-2">মোবাইল - ২ (যদি থাকে)</label>
                                <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" id="up_phone_number_2" name="phone_number_2">
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="income" class="pb-2">বাৎসরিক আয় <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="বাৎসরিক আয়" id="up_income" name="income">
                                <div id="client_income-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    মোবাইল নম্বর দিন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="position" class="pb-2">অবস্থান <span class="text-danger">*</span></label><br>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_position" id="A" value="A">
                                    <label class="form-check-label" for="male">
                                        A
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_position" id="B" value="B">
                                    <label class="form-check-label" for="female">
                                        B
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_position" id="C" value="C">
                                    <label class="form-check-label" for="others_position">
                                        C
                                    </label>
                                </div>
                                <div class="form-check d-inline-block me-3">
                                    <input class="form-check-input" type="radio" name="up_position" id="D" value="D">
                                    <label class="form-check-label" for="others_gender">
                                        D
                                    </label>
                                </div>
                                <div id="client_position-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    অবস্থান নির্বাচন করুন
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3 select">
                                <label for="blood_group" class="pb-2">রক্তের গ্রুপ (যদি থাকে)</label>
                                <select id="up_blood_group" style="text-indent: 0;" class="form-control input_field form-input p-3" name="blood_group">
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
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="bank_account" class="pb-2">ব্যাংক একাউন্ট (যদি থাকে)</label>
                                <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="ব্যাংক একাউন্ট (যদি থাকে)" id="up_bank_account" name="bank_account">
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="check_no" class="pb-2">চেক নং (যদি থাকে)</label>
                                <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="চেক নং (যদি থাকে)" id="up_check_no" name="check_no">
                            </div>


                            <!-- Clint Image -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label class="pb-2">সদস্য ছবি</label><br>
                                <div class="text-start">
                                    <label id="client_image" for="client_pic"><img id="edit_image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image"></label>
                                    <input class="d-none" type="hidden" id="old_pic" name="old_pic" />
                                    <input class="d-none" type="file" id="client_pic" name="client_pic" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3 select">
                                <label for="present_address" class="pb-2">বর্তমান ঠিকানা<span class="text-danger">*</span></label>
                                <textarea style="text-indent: 0;" class="form-control p-3" id="up_present_address" name="up_present_address" rows="3"></textarea>
                                <div id="present_address-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    বর্তমান ঠিকানা লিখুন
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3 select">
                                <label for="parmanent_address" class="pb-2">স্থায়ী ঠিকানা<span class="text-danger">*</span></label>
                                <textarea style="text-indent: 0;" class="form-control p-3" id="up_parmanent_address" name="up_parmanent_address" rows="3"></textarea>
                                <div id="parmanent_address-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    স্থায়ী ঠিকানা লিখুন
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-danger" id="modal_close" data-bs-dismiss="modal">ক্লোজ</button>
                        <button type="submit" class="btn rounded btn-success">সাবমিট করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "include/footer.php";
?>
<script>
    $(document).ready(function() {
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
            var field = $(this).val();
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

        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let fieldID = urlParams.get('field');
        let centerID = urlParams.get('center');
        let clientID = urlParams.get('client');

        function cardLoad() {
            $.ajax({
                url: "codes/fieldDataAuthenticate.php",
                type: "POST",
                data: {
                    clientCard: 1,
                    centerID: centerID,
                    fieldID: fieldID
                },
                dataType: "JSON",
                success: function(data) {
                    if (data != false) {
                        $.each(data, function(key, value) {
                            $("#breadcrumb_name").text(value.field_name);
                            $("#breadcrumb_subname").text(value.center_name);
                            $("#field_name").text(value.field_name);
                            $("#center_name").text(value.center_name);
                        })
                    }
                }
            })
        }
        cardLoad();

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [day, month, year].join('-');
        }

        if (clientID != null) {
            function clientProfileLoad() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        clientProfile: 1,
                        clientID: clientID
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $.each(data, function(key, value) {
                                $("#register_delete").data('id', value.client_id);
                                $("#name").text(value.name);
                                $("#up_name").val(value.name);
                                $("#up_id").val(value.client_id);
                                $("#book").text(value.book);
                                $("#phone1").text(value.client_mobile_1);
                                $("#up_phone_number").val(value.client_mobile_1);
                                $("#start_date").text(formatDate(value.created_at));
                                $("#close_at").text(value.closing_at);
                                $("#husband").text(value.husbands_name);
                                $("#up_husband_name").val(value.husbands_name);
                                $("#father").text(value.fathers_name);
                                $("#up_father_name").val(value.fathers_name);
                                $("#mother").text(value.mothers_name);
                                $("#up_mother_name").val(value.mothers_name);
                                $("#nid").text(value.client_nid);
                                $("#up_nid").val(value.client_nid);
                                $("#dob").text(formatDate(value.client_dob));
                                $("#birth_reg_id_no").val(value.client_dob);
                                $("#occupation").text(value.client_occupation);
                                $("#religion").text(value.religion);
                                $("#gender").text(value.client_gander);
                                $("#phone2").text(value.client_mobile_2);
                                $("#up_phone_number_2").val(value.client_mobile_2);
                                $("#bank_acc").text(value.client_back_acc);
                                $("#up_bank_account").val(value.client_back_acc);
                                $("#bank_check").text(value.check_no);
                                $("#position").text(value.client_position);
                                $("#anual_income").text(value.client_income);
                                $("#up_check_no").val(value.check_no);
                                $("#up_income").val(value.client_income);
                                $("#up_blood_group").val(value.blood_grp);
                                $("#blood").text(value.blood_grp).trigger('change');
                                $("#present_address").text(value.present_address);
                                $("#up_present_address").val(value.present_address);
                                $("#parmanent_address").text(value.parmanent_address);
                                $("#up_parmanent_address").val(value.parmanent_address);
                                $("#update_date").text(formatDate(value.updated_at));
                                $('input:radio[name="up_occapasion"]').filter('[value= "' + value.client_occupation + '"]').attr('checked', true);
                                $('input:radio[name="up_religion"]').filter('[value= "' + value.religion + '"]').attr('checked', true);
                                $('input:radio[name="up_gender"]').filter('[value= "' + value.client_gander + '"]').attr('checked', true);
                                $('input:radio[name="up_position"]').filter('[value= "' + value.client_position + '"]').attr('checked', true);
                                if (value.status == 1) {
                                    $("#status").text("ACTIVE");
                                    $("#status").addClass("bg-success");
                                } else if (value.status == 2) {
                                    $("#status").text("PANDING");
                                    $("#status").addClass("bg-warning");
                                } else {
                                    $("#status").text("DEACTIVE");
                                    $("#status").addClass("bg-danger");
                                }
                                if (value.client_img != null) {
                                    $("#edit_image").attr("src", "./img/" + value.client_img);
                                    $("#old_pic").val(value.client_img);
                                    $("#client_img").attr("src", "./img/" + value.client_img);
                                    $("#edit_image").attr("src", "./img/" + value.client_img);
                                    $("#old_pic").val(value.client_img);
                                } else {
                                    $("#client_img").attr("src", "https://avatars.dicebear.com/api/micah/" + value.name + ".svg ");

                                }
                            })
                        }
                    }
                })
            }

            $("#client_profile_edit_form").on("submit", function(e) {
                e.preventDefault();

                var client_name = $("#up_name").val();
                var client_husband_name = $("#up_husband_name").val();
                var client_father_name = $("#up_father_name").val();
                var client_mother_name = $("#up_mother_name").val();
                var client_nid = $("#up_nid").val();
                var client_dob = $("#birth_reg_id_no").val();
                var client_occapasion = $('input[name=up_occapasion]:checked').val();
                var client_religion = $('input[name=up_religion]:checked').val();
                var client_gender = $('input[name=up_gender]:checked').val();
                var client_position = $('input[name=up_position]:checked').val();
                var client_income = $('#up_income').val();
                var client_img = $('#client_pic').val();
                var old_pic = $('#old_pic').val();
                var client_mobile = $('#up_phone_number').val();
                var client_mobile_2 = $('#up_phone_number_2').val();
                var client_blood = $('#up_blood_group').val();
                var client_bank_account = $('#up_bank_account').val();
                var client_check_no = $('#up_check_no').val();
                var up_present_address = $('#up_present_address').val();
                var up_parmanent_address = $('#up_parmanent_address').val();

                if (client_name == "" || client_name == null) {
                    $("#up_name").addClass("is-invalid");
                    $("#client_name-feedback").css("display", "block");
                }
                if ((client_husband_name == "" || client_husband_name == null) && (client_father_name == "" || client_father_name == null)) {
                    $("#up_husband_name").addClass("is-invalid");
                    $("#husband_name-feedback").css("display", "block");
                    $("#up_father_name").addClass("is-invalid");
                    $("#father_name-feedback").css("display", "block");
                }
                if (client_mother_name == "" || client_mother_name == null) {
                    $("#up_mother_name").addClass("is-invalid");
                    $("#mother_name-feedback").css("display", "block");
                }
                if (client_nid == "" || client_nid == null) {
                    $("#up_nid").addClass("is-invalid");
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
                    $("#up_phone_number").addClass("is-invalid");
                    $("#client_mobile-feedback").css("display", "block");
                }
                if (client_income == "" || client_income == null) {
                    $("#up_income").addClass("is-invalid");
                    $("#client_income-feedback").css("display", "block");
                }
                if (up_present_address == "" || up_present_address == null) {
                    $("#up_present_address").addClass("is-invalid");
                    $("#present_address-feedback").css("display", "block");
                }
                if (up_parmanent_address == "" || up_parmanent_address == null) {
                    $("#up_parmanent_address").addClass("is-invalid");
                    $("#parmanent_address-feedback").css("display", "block");
                }

                if (client_name != "" && client_name != null && client_mother_name != "" && client_mother_name != null && client_nid != "" && client_nid != null && client_dob != "" && client_dob != null && client_occapasion != "" && client_occapasion != null && client_religion != "" && client_religion != null && client_gender != "" && client_gender != null && client_mobile != "" && client_mobile != null && client_position != "" && client_position != null && client_income != "" && client_income != null) {
                    var formData = new FormData(this);
                    $.ajax({
                        url: "codes/clientProfileEditAuthenticate.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
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
                            if (data == 1) {
                                $("#client_profile_edit_form").trigger("reset");
                                $("select").select2("destroy");
                                $("select").select2();
                                $("#modal_close").trigger("click");
                                clientProfileLoad();
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "সদস্য আপডেট হয়েছে",
                                    icon: 'success',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                            if (data == 0) {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "সদস্য আপডেট হয়নি। আবার চেষ্টা করুন",
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

            function savingsLoad() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        clientSavings: 1,
                        clientID: clientID
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#clientSavings").html(data);
                    }
                })
            }

            function LoansLoad() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        clientLoan: 1,
                        clientID: clientID
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#clientLoan").html(data);
                    }
                })
            }

            clientProfileLoad();
            savingsLoad();
            LoansLoad();

            // Savings Delete
            $(document).on('click', '#savings_delete', function() {
                const id = $(this).data('id')
                Swal.fire({
                    title: 'আপনি কি সঞ্চয় প্রোফাইল ডিলিট দিতে চান?',
                    text: "সঞ্চয় প্রোফাইল ডিলিটের পর এটি ফিরে পাওয়া সম্ভব নয়।",
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    denyButtonText: `Don't delete`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "codes/profileEditAuthenticate.php",
                            type: "POST",
                            data: {
                                savingDelete: 1,
                                id: id
                            },
                            dataType: "JSON",
                            success: function(data) {
                                console.log(data)
                                if (data == 1) {
                                    swal.fire({
                                        title: "অভিনন্দন",
                                        text: "সঞ্চয় প্রোফাইল ডিলিট হয়েছে",
                                        icon: 'success',
                                        buttons: "OK",
                                        dangerMode: true,
                                    }).then(result => {
                                        location.reload()
                                    })
                                } else {
                                    swal.fire({
                                        title: "দুঃখিত",
                                        text: "সঞ্চয় প্রোফাইল ডিলিট হয়নি",
                                        icon: 'error',
                                        buttons: "OK",
                                        dangerMode: true,
                                    })
                                }
                            },
                            error: function(data) {
                                console.log(data)
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "সঞ্চয় প্রোফাইল ডিলিট হয়নি",
                                    icon: 'error',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('সঞ্চয় প্রোফাইল সংরক্ষিত রয়েছে।', '', 'info')
                    }
                })
            })

            // Loan Delete
            $(document).on('click', '#loan_delete', function() {
                const id = $(this).data('id')

                Swal.fire({
                    title: 'আপনি কি ঋণ প্রোফাইল ডিলিট দিতে চান?',
                    text: "ঋণ প্রোফাইল ডিলিটের পর এটি ফিরে পাওয়া সম্ভব নয়।",
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    denyButtonText: `Don't delete`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "codes/profileEditAuthenticate.php",
                            type: "POST",
                            data: {
                                loanDelete: 1,
                                id: id
                            },
                            dataType: "JSON",
                            success: function(data) {
                                console.log(data)
                                if (data == 1) {
                                    swal.fire({
                                        title: "অভিনন্দন",
                                        text: "ঋণ প্রোফাইল ডিলিট হয়েছে",
                                        icon: 'success',
                                        buttons: "OK",
                                        dangerMode: true,
                                    }).then(result => {
                                        location.reload()
                                    })
                                } else {
                                    swal.fire({
                                        title: "দুঃখিত",
                                        text: "ঋণ প্রোফাইল ডিলিট হয়নি",
                                        icon: 'error',
                                        buttons: "OK",
                                        dangerMode: true,
                                    })
                                }
                            },
                            error: function(data) {
                                console.log(data)
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "ঋণ প্রোফাইল ডিলিট হয়নি",
                                    icon: 'error',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('ঋণ প্রোফাইল সংরক্ষিত রয়েছে।', '', 'info')
                    }
                })
            })
        } else {
            $(location).attr('href', "<?= baseUrl('404') ?>");
        }

        $("#credentials_update_form").on("submit", function(e) {
            e.preventDefault();
            // Form Primary Data
            var id = $("#client_id").val();
            var feild = $("#feild").val();
            var center = $("#center").val();
            var url = "<?= baseUrl('client-profile?field=:fieldID&&center=:centerID&&savings=1&client=' . $_GET['client'] . '') ?>";

            url = url.replace(':fieldID', feild);
            url = url.replace(':centerID', center);

            // Form Validation
            if (id == "" || id == null) {
                $("#book").addClass("is-invalid");
                $("#field-feedback").css("display", "block");
            }
            if (feild == "" || feild == null) {
                $("#field").addClass("is-invalid");
                $("#field-feedback").css("display", "block");
            }
            if (center == "" || center == null) {
                $("#center").addClass("is-invalid");
                $("#center-feedback").css("display", "block");
            }


            if (id != "" && id != null && feild != "" && feild != null && center != "" && center != null) {
                var formData = new FormData(this);
                $.ajax({
                    url: "codes/profileEditAuthenticate.php",
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
                        console.log(data)
                        if (data == true) {
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "ইডিট সম্পন্ন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            }).then((result) => {
                                $(location).attr('href', url);
                            })
                        } else {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "ইডিট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
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

        // Register Delete
        $("#register_delete").on('click', function() {
            const id = $(this).data('id')

            Swal.fire({
                title: 'আপনি কি রেজিস্টার ডিলিট দিতে চান?',
                text: "রেজিস্টার ডিলিটের পর এটি ফিরে পাওয়া সম্ভব নয়।",
                icon: 'question',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't delete`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "codes/profileEditAuthenticate.php",
                        type: "POST",
                        data: {
                            registerDelete: 1,
                            id: id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            // console.log(data)
                            if (data == 1) {
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "রেজিস্টার ডিলিট হয়েছে",
                                    icon: 'success',
                                    buttons: "OK",
                                    dangerMode: true,
                                }).then(result => {
                                    $(location).attr('href', "<?= baseUrl('/') ?>");
                                })
                            } else if (data == 2) {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "রেজিস্টার ডিলিট করা সম্ভব নয়",
                                    icon: 'error',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            } else {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "রেজিস্টার ডিলিট হয়নি",
                                    icon: 'error',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                        },
                        error: function(data) {
                            console.log(data)
                            swal.fire({
                                title: "দুঃখিত",
                                text: "রেজিস্টার ডিলিট হয়নি",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('রেজিস্টার সংরক্ষিত রয়েছে।', '', 'info')
                }
            })
        })
    })
</script>
</body>

</html>