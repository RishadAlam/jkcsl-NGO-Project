<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($closingForm2 == 0) {
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
                <li class="breadcrumb-item">ক্লোজিং</li>
                <li class="breadcrumb-item active" aria-current="page">ঋণ ক্লোজিং</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Savings Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5">
    <div class="form_heading mb-5">
        <h2 class="text-center">ঋণ ক্লোজিং ফরম</h2>
    </div>
    <form>
        <div class="row">
            <?php if ($currentTime >= $start && $currentTime <= $end) { ?>
                <!-- Form Information Heading -->
                <div class="form_section_heading pb-1 shadow mb-3">
                    <h4>ফরমের তথ্যাবলি</h4>
                </div>

                <!-- Form Information -->
                <div class="col-md-6 mb-3 select">
                    <label for="feild" class="pb-2">ফিল্ড <span class="text-danger">*</span></label>
                    <select id="feild" class="form-control input_field form-input p-3" name="feild">
                        <option class="feild" value="null" disabled selected>ফিল্ড নির্বারচন করুন...</option>
                    </select>
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
                        কেন্দ্র নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="period" class="pb-2">ঋণ সংগ্রহ ক্ষেত্র <span class="text-danger">*</span></label>
                    <select id="period" class="form-control input_field form-input p-3">
                        <option class="feild" value="null" disabled selected>ক্ষেত্র নির্বারচন করুন...</option>
                    </select>
                    <div id="period-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ক্ষেত্র নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="book" class="pb-2">বই নং <span class="text-danger">*</span></label>
                    <select id="book" class="form-control input_field form-input p-3">
                        <option class="feild" value="null" disabled selected>বই নির্বারচন করুন...</option>
                    </select>
                    <div id="book-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বই নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="pb-2">নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="সদস্য এর নাম" id="name" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="reserve" class="pb-2">ক্লোজিং ফি (টাকা) </label>
                    <input type="hidden" id="hidden_reserve" disabled>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="reserve" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="balance" class="pb-2">অবশিষ্ট সঞ্চয় রয়েছে (টাকা) </label>
                    <input type="hidden" id="hidden_balance" disabled>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="balance" disabled>
                    <div id="balance-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">

                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_loan" class="pb-2">ঋণ প্রদান (টাকা) </label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="total_loan" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_deposit" class="pb-2">ঋণ আদায় (টাকা) </label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="total_deposit" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="loan_remaining" class="pb-2">ঋণ বাকি (টাকা) </label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="loan_remaining" disabled>
                    <div id="loan_remaining-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ঋণ বাকি রয়েছে, ঋণ আদায় সম্পন্ন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_interest" class="pb-2">সর্বমোট লাভ (টাকা) </label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="total_interest" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="deposit_interest" class="pb-2">লাভ আদায় (টাকা) </label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="deposit_interest" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="interest_remaining" class="pb-2">লাভ বাকি (টাকা) </label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="interest_remaining" disabled>
                    <div id="interest_remaining-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        লাভ বাকি রয়েছে, লাভ আদায় সম্পন্ন করুন
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="details" class="pb-2">মন্তব্য</label>
                    <textarea class="form-control input_field p-3" id="details" rows="3" placeholder="মন্তব্য লিখুন..."></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" id="loan-closing-form" class="btn form-control btn-button">সাবমিট করুন</button>
                </div>
            <?php } else { ?>
                <div class="col-md-12 text-center text-light" style="padding: 100px 0;">
                    <h1>ক্লোজিং সময় শেষ হয়ে গিয়েছে।</h1>
                    <h3>ক্লোজিং সময় <?= $timeStart ?> হতে <?= $timeEnd ?> পর্যন্ত।</h3>
                </div>
            <?php } ?>
        </div>
    </form>
</div>

<?php
include "include/footer.php";
?>
<script>
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

    $("#book").on('change', function() {
        var clientID = $(this).val();
        var reserve = $("#hidden_reserve").val();
        var book = $(this).find(':selected').data('book');
        var loanID = $(this).find(':selected').data('loanprofile');

        // console.log(clientID);
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                loanclientID: clientID,
                loanbook: book,
                loanloanID: loanID
            },
            dataType: "JSON",
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    $("#name").val(value.name);
                    $("#balance").val(value.balance - reserve);
                    $("#hidden_balance").val(value.balance - reserve);
                    $("#total_loan").val(value.total_loan);
                    $("#total_deposit").val(value.loan_recover);
                    $("#loan_remaining").val(value.loan_remaining);
                    $("#total_interest").val(value.total_interest);
                    $("#deposit_interest").val(value.interest_recover);
                    $("#interest_remaining").val(value.interest_remaining);
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
                period: '%2%'
            },
            success: function(data) {
                $("#period").html("");
                $("#period").html(data);
            }
        })
    }
    loadPeriod();

    $("#period").on('change', function() {
        period = $(this).find(':selected').data('days');
        var lperiod = $(this).val();
        var center = $("#center").val();
        var field = $("#feild").val();

        if (period == 365) {
            $("#reserve").val(200);
            $("#hidden_reserve").val(200);
        } else {
            $("#reserve").val(100);
            $("#hidden_reserve").val(100);
        }

        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                lField: field,
                lcenter: center,
                lperiod: lperiod,
            },
            success: function(data) {
                $("#book").html("");
                $("#book").html(data);
            }
        })
    })

    $("#withdraw").on("keyup", function() {
        var balance = $("#hidden_balance").val();
        var withdraw = $(this).val();
        balance = balance - withdraw;
        $("#balance").val(balance);
    })

    $('#loan-closing-form').on("click", function(e) {
        e.preventDefault();
        // Form Primary Data
        var total_loan = $("#total_loan").val();
        var total_deposit = $("#total_deposit").val();
        var total_interest = $("#total_interest").val();
        var deposit_interest = $("#deposit_interest").val();
        var feild = $("#feild").val();
        var center = $("#center").val();
        var clientID = $("#book").val();
        var period = $("#period").val();
        var reserve = $("#hidden_reserve").val();
        var balance = $("#balance").val();
        var loan_remaining = $("#loan_remaining").val();
        var interest_remaining = $("#interest_remaining").val();
        var details = $("#details").val();
        var loanID = $("#book").find(':selected').data('loanprofile');
        var book = $("#book").find(':selected').data('book');

        // Form Validation
        if (feild == "" || feild == null) {
            $("#feild").addClass("is-invalid");
            $("#field-feedback").css("display", "block");
        }
        if (center == "" || center == null) {
            $("#center").addClass("is-invalid");
            $("#center-feedback").css("display", "block");
        }
        if (clientID == "" || clientID == null) {
            $("#book").addClass("is-invalid");
            $("#book-feedback").css("display", "block");
        }
        if (period == "" || period == null) {
            $("#period").addClass("is-invalid");
            $("#period-feedback").css("display", "block");
        }
        if (balance > 0) {
            $("#balance").addClass("is-invalid");
            $("#balance-feedback").text("");
            $("#balance-feedback").text("সঞ্চয় উত্তোলোন করুন");
            $("#balance-feedback").css("display", "block");
        }
        if (balance < 0) {
            $("#balance").addClass("is-invalid");
            $("#balance-feedback").text("");
            $("#balance-feedback").text("পর্যাপ্ত পরিমাণ টাকা জমা নেই");
            $("#balance-feedback").css("display", "block");
        }
        if (loan_remaining > 0) {
            $("#loan_remaining").addClass("is-invalid");
            $("#loan_remaining-feedback").css("display", "block");
        }
        if (interest_remaining > 0) {
            $("#interest_remaining").addClass("is-invalid");
            $("#interest_remaining-feedback").css("display", "block");
        }

        if (feild != "" && feild != null && center != "" && center != null && clientID != "" && clientID != null && period != "" && period != null && balance == 0 && loan_remaining <= 0 && interest_remaining <= 0) {

            $.ajax({
                url: "codes/closingAccAuthenticate.php",
                type: "POST",
                data: {
                    loanID: loanID,
                    feild: feild,
                    center: center,
                    clientID: clientID,
                    period: period,
                    reserve: reserve,
                    balance: balance,
                    loan_remaining: loan_remaining,
                    interest_remaining: interest_remaining,
                    details: details,
                    total_loan: total_loan,
                    total_deposit: total_deposit,
                    total_interest: total_interest,
                    deposit_interest: deposit_interest,
                    book: book
                },
                beforeSend: function() {
                    $("#overlayer").fadeIn();
                    $("#preloader").fadeIn();
                },
                success: function(data) {
                    $("#overlayer").fadeOut();
                    $("#preloader").fadeOut();
                    if (data == 1) {
                        $("form").trigger("reset");
                        $("select").empty().trigger('change');
                        loadField();
                        loadPeriod();
                        swal.fire({
                            title: "অভিনন্দন",
                            text: "ঋণ ক্লোজ করা হয়েছে",
                            icon: 'success',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    }
                    if (data == 0) {
                        swal.fire({
                            title: "দুঃখিত",
                            text: "ঋণ ক্লোজ করা হয়নি। আবার চেষ্টা করুন",
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