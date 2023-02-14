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
                <li class="breadcrumb-item active" aria-current="page">ঋণ পত্র ইডিট</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Savings Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5">
    <div class="form_heading mb-5">
        <h2 class="text-center">ঋণ পত্রের ইডিট ফরম</h2>
    </div>
    <form id="saving_acc_edit">
        <div class="row">
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
                    <label for="book" class="pb-2">বই নং <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" id="book" name="book" disabled>
                    <input type="hidden" id="loan_id" name="loan_id">

                    <div id="saving_id-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বই নির্বাচন করুন
                    </div>
                </div>
            </div>

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>ফরমের তথ্যাবলি</h4>
            </div>

            <!-- Client Information -->
            <div class="form_info row p-0 m-0">
                <div class="col-md-6 mb-3 select">
                    <label for="period" class="pb-2">ঋণ সংগ্রহ ক্ষেত্র <span class="text-danger">*</span></label>
                    <select id="period" class="form-control input_field form-input p-3" name="period">
                    </select>
                    <div id="period-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ক্ষেত্র নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="deposit" class="pb-2">সঞ্চয় কিস্তির পরিমাণ (টাকা) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="deposit" name="deposit">
                    <div id="deposit-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সঞ্চয় কিস্তির পরিমাণ লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="loan_given" class="pb-2">ঋণ প্রদান (টাকা) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0" name="loan_given" id="loan_given">
                    <div id="loan_given-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ঋণ প্রদান লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="installment" class="pb-2">কিস্তি সংখ্যা <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0" name="installment" id="installment">
                    <div id="installment-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        কিস্তি সংখ্যা লিখুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="expiry_date" class="pb-2">ঋণের মেয়াদকাল <span class="text-danger">*</span></label>
                    <input type="date" class="form-control input_field form-input p-3" name="expiry_date" id="expiry_date">
                    <div id="expiry_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ঋণের মেয়াদকাল লিখুন
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
                    <label for="total_interest" class="pb-2">সর্বমোট লাভ <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" id="total_interest" name="total_interest" readonly>
                    <div id="total_interest-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সর্বমোট লাভ দেওয়া হয়নি
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_taka_with_int" class="pb-2">সর্বমোট টাকা (লাভ সহ) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" id="total_taka_with_int" name="total_taka_with_int" readonly>
                    <div id="total_taka_with_int-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সর্বমোট টাকা (লাভ সহ) দেওয়া হয়নি
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="loan_installment" class="pb-2">নির্ধারিত কিস্তি (টাকা) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" id="loan_installment" name="loan_installment" readonly>
                    <div id="loan_installment-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নির্ধারিত কিস্তি দেওয়া হয়নি
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="interest_installment" class="pb-2">নির্ধারিত লাভ (টাকা) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" id="interest_installment" name="interest_installment" readonly>
                    <div id="interest_installment-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        নির্ধারিত লাভ দেওয়া হয়নি
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
                        <label id="nominee_image" for="nominee_pic"><img id="nominee_images" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image"></label>
                        <input type="file" id="nominee_pic" name="nominee_pic" hidden />
                        <input type="hidden" id="old_pic" name="old_pic" />
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
                    <label for="nomine_address" class="pb-2">বর্তমান ঠিকানা<span class="text-danger">*</span></label>
                    <textarea style="text-indent: 0;" class="form-control p-3" id="nomine_address" name="nomine_address" rows="3"></textarea>
                    <div id="nomine_address-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বর্তমান ঠিকানা লিখুন
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
    let queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    let fieldID = urlParams.get('field');
    let centerID = urlParams.get('center');
    let clientID = urlParams.get('client');
    let loanID = urlParams.get('loans');

    // console.log(clientID)
    // console.log(loanID)

    if (clientID != null && loanID != null) {

        function clientProfileLoad() {
            $.ajax({
                url: "codes/profileEditAuthenticate.php",
                type: "POST",
                data: {
                    LoanProfileEdit: 1,
                    loanID: loanID
                },
                dataType: "JSON",
                success: function(data) {
                    console.table(data);
                    if (data != false) {
                        $.each(data, function(key, value) {
                            $("#loan_id").val(value.loan_profile_id);
                            $("#name").val(value.name);
                            $("#book").val(value.book);
                            $("#period").val(value.period_id).trigger('change');
                            $("#deposit").val(value.savings);
                            $("#loan_given").val(value.total_loan);
                            $("#expiry_date").val(value.duration);
                            $("#interest").val(value.interest);
                            $("#total_interest").val(value.total_interest);
                            $("#total_taka_with_int").val(value.total_loan_w_ints);
                            $("#installment").val(value.total_intsallment);
                            $("#loan_installment").val(value.loan_installment);
                            $("#interest_installment").val(value.interest_installment);

                            $("#nominee_name").val(value.nominee_name);
                            $("#nominee_husband_name").val(value.nominee_husband);
                            $("#nominee_father_name").val(value.nominee_father);
                            $("#nominee_mother_name").val(value.nominee_mother);
                            $("#nominee_mother_name").val(value.nominee_mother);
                            $("#nominee_birth_reg_id_no").val(value.nominee_dob);
                            $("#nominee_nid").val(value.nominee_nid);
                            $("#nomine_address").val(value.nominee_address);
                            $('input:radio[name="nominee_occapasion"]').filter('[value= "' + value.nominee_occupation + '"]').attr('checked', true);
                            $('input:radio[name="relation"]').filter('[value= "' + value.nominee_relation + '"]').attr('checked', true);
                            $('input:radio[name="nominee_gender"]').filter('[value= "' + value.nominee_gendar + '"]').attr('checked', true);

                            if (value.nominee_img != null) {
                                $("#nominee_images").attr("src", "./img/" + value.nominee_img);
                                $("#old_pic").val(value.nominee_img);
                            } else {
                                $("#nominee_images").attr("src", "./img/pngfind.com-copyright-png-938050.png");

                            }
                        })
                        totalValue();
                    }
                }
            })
        }

        clientProfileLoad();
    } else {
        $(location).attr('href', "<?= baseUrl('404') ?>");
    }


    function loadPeriod() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                period: '%2%'
            },
            success: function(data) {
                $("#period").html("");
                $("#period").html(data);
            }
        })
    }
    loadPeriod();

    $("#installment").on("keyup", function() {
        totalValue();
    })

    $("#loan_given").on("keyup", function() {
        totalValue();
    })

    $("#interest").on("keyup", function() {
        totalValue();
    })

    function totalValue() {
        var total_loan = $("#loan_given").val();
        var expiry_date = $("#installment").val();
        var interest = $("#interest").val();
        var total = $("#loan_given").val();
        var total_int = ((total / 100) * interest);
        var total_interest = Math.round(total_int);
        var ceil = total_loan / expiry_date;
        if (ceil % 1 == 0) {
            var ceil_i = ceil;
        } else {
            var ceil_i = Math.ceil(parseFloat(ceil) + parseFloat(1));
        };
        var total_with_int = Math.ceil(parseFloat(total) + parseFloat(total_int));
        var interest_ints = total_int / expiry_date;
        if (interest_ints % 1 == 0) {
            var interest_i = interest_ints;
        } else {
            var interest_i = Math.ceil(parseFloat(interest_ints) + parseFloat(1));
        };
        $("#loan_installment").val(ceil_i);
        $("#total_interest").val(total_interest);

        $("#total_taka_with_int").val(total_with_int);
        $("#interest_installment").val(interest_i);
    }


    $("#saving_acc_edit").on("submit", function(e) {
        e.preventDefault();
        // Form Primary Data
        var id = $("#loan_id").val();
        var period = $("#period").val();
        var expiry_date = $("#expiry_date").val();
        var deposit = $("#deposit").val();
        var loan_given = $("#loan_given").val();
        var installment = $("#installment").val();
        var total_interest = $("#total_interest").val();
        var interest = $("#interest").val();
        var total_taka_with_ints = $("#total_taka_with_int").val();
        var loan_installment = $("#loan_installment").val();
        var interest_installment = $("#interest_installment").val();

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
        var nomine_address = $('#nomine_address').val();

        // Form Validation
        if (id == "" || id == null) {
            $("#book").addClass("is-invalid");
            $("#saving_id-feedback").css("display", "block");
        }
        if (period == "" || period == null) {
            $("#period").addClass("is-invalid");
            $("#period-feedback").css("display", "block");
        }
        if (expiry_date == "" || expiry_date == null) {
            $("#expiry_date").addClass("is-invalid");
            $("#expiry_date-feedback").css("display", "block");
        }
        if (deposit == 0 || deposit == null) {
            $("#deposit").addClass("is-invalid");
            $("#deposit-feedback").css("display", "block");
        }
        if (loan_given == 0 || loan_given == null) {
            $("#loan_given").addClass("is-invalid");
            $("#loan_given-feedback").css("display", "block");
        }
        if (installment == "" || installment == null) {
            $("#installment").addClass("is-invalid");
            $("#installment-feedback").css("display", "block");
        }
        if (interest == "" || interest == null) {
            $("#interest").addClass("is-invalid");
            $("#interest-feedback").css("display", "block");
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

        // Nominee Adreess
        if (nomine_address == "" || nomine_address == null) {
            $("#nomine_address").addClass("is-invalid");
            $("#nomine_address-feedback").css("display", "block");
        }

        if (id != "" && id != null && period != "" && period != null && expiry_date != "" && expiry_date != null && deposit != "" && deposit != null && installment != "" && installment != null && interest != "" && interest != null && loan_given != 0 && loan_given != null && nominee_name != "" && nominee_name != null && nominee_occapasion != "" && nominee_occapasion != null && nominee_relation != "" && nominee_relation != null && nominee_gender != "" && nominee_gender != null && nomine_address != "" && nomine_address != null) {
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
                    if (data == true) {
                        swal.fire({
                            title: "অভিনন্দন",
                            text: "ইডিট সম্পন্ন হয়েছে",
                            icon: 'success',
                            buttons: "OK",
                            dangerMode: true,
                        }).then((result) => {
                            $(location).attr('href', "<?= baseUrl('client-profile?field=' . $_GET['field'] . '&&center=' . $_GET['center'] . '&&savings=1&client=' . $_GET['client'] . '') ?>");
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
</script>
</body>

</html>