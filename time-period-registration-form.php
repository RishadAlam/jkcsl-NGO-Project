<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($regForm7 == 0) {
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
                <li class="breadcrumb-item active" aria-current="page">ক্ষেত্র নিবন্ধন</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Period Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5" style="max-width: 1000px;">
    <div class="form_heading mb-5">
        <h2 class="text-center">সংগ্রহ ক্ষেত্র নিবন্ধন ফরম</h2>
    </div>
    <form action="" id="period_reg_form">
        <div class="row">

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>ফরমের তথ্যাবলি</h4>
            </div>

            <!-- Form Information -->
            <div class="col-md-6 mb-3">
                <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-input p-3" placeholder="সংগ্রহ ক্ষেত্রের নাম লিখুন" id="period_name" name="period_name">
                <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    কেন্দ্রের নাম লিখুন
                </div>
            </div>
            <!-- <div class="col-md-6 mb-3 select">
                <label for="center" class="pb-2">কেন্দ্র <span class="text-danger">*</span></label>
                <select id="center" class="form-control form-input p-3">
                    <option class="" value="null" disabled selected>কেন্দ্র নির্বারচন করুন...</option>
                    <option value="">কালামিয়া বাজার</option>
                    <option value="">বহদ্দারহাট</option>
                    <option value="">মোহাম্মদপুর</option>
                </select>
            </div> -->
            <div class="col-md-6 mb-3">
                <label for="period" class="pb-2">সময়কাল (দিন) <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-input p-3" placeholder="সময়কাল লিখুন দিন আকারে" id="period" name="period">
                <div id="period-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    সময়কাল লিখুন
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="pb-2">সংগ্রহ ক্ষেত্র <span class="text-danger">*</span></label><br>
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" name="types" value="1">
                    <label class="form-check-label" for="business">
                        সঞ্চয়
                    </label>
                </div>
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" name="types" value="2">
                    <label class="form-check-label" for="employee">
                        ঋণ
                    </label>
                </div>
                <div id="type-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    সংগ্রহ ক্ষেত্র দিন
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="details" class="pb-2">বিস্তারিত</label>
                <textarea class="form-control p-3" id="details" rows="3" placeholder="সংগ্রহ ক্ষেত্র সম্পর্কে বিস্তারিত লিখুন..."></textarea>
                <div id="dec-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    ক্ষেত্র সম্পর্কে বিস্তারিত লিখুন
                </div>
            </div>
            <div class="col-md-12">
                <button id="reg_reset" class="btn form-control btn-button my-3">রিসেট করুন</button>
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

        // Keyup validation
        $("#period_name").on("keyup", function() {
            var nameLentgh = $("#period_name").val().length;
            if (nameLentgh >= 100) {
                $("#period_name").attr("maxlength", "100");
                $("#period_name").addClass("is-invalid");
                $("#name-feedback").text("১০০ সংখ্যার মধ্যে ক্ষেত্রের নাম লিখুন");
                $("#name-feedback").css("display", "block");
            } else {
                $("#period_name").removeClass("is-invalid");
                $("#name-feedback").css("display", "none");
            }
        })
        $("#details").on("keyup", function() {
            var decLentgh = $("#details").val().length;
            if (decLentgh >= 250) {
                $("#details").attr("maxlength", "250");
                $("#details").addClass("is-invalid");
                $("#dec-feedback").text("২৫০ সংখ্যার মধ্যে মন্তব্য লিখুন");
                $("#dec-feedback").css("display", "block");
            } else {
                $("#details").removeClass("is-invalid");
                $("#dec-feedback").css("display", "none");
            }
        })

        $("#period_reg_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var Name = $("#period_name").val();
            var dec = $("#details").val();
            var period = $("#period").val();
            var NameLength = Name.length;
            var DecLength = dec.length;
            var type = [];
            $(':checkbox:checked').each(function(i) {
                type[i] = $(this).val();
            })
            // console.log(Name);


            // Empty Input Checking
            if (Name == "" || Name == null) {
                $("#period_name").addClass("is-invalid");
                $("#name-feedback").css("display", "block");
            }
            if (type == 0) {
                $("#type-feedback").css("display", "block");
            }
            if (period == "" || period == null) {
                $("#period").addClass("is-invalid");
                $("#period-feedback").css("display", "block");
            }

            // Length Checking
            if (NameLength > 100) {
                $("#period_name").addClass("is-invalid");
                $("#name-feedback").text("১০০ অক্ষরের মদ্ধ্যে ক্ষেত্রের নাম লিখুন");
                $("#name-feedback").css("display", "block");
            }
            if (DecLength > 250) {
                $("#details").addClass("is-invalid");
                $("#dec-feedback").text("২৫০ অক্ষরের মদ্ধ্যে মন্তব্য লিখুন");
                $("#dec-feedback").css("display", "block");
            }

            // Ajax Action
            if (Name != "" && Name != null && NameLength < 100 && DecLength < 250 && period != "" && period != null && type != 0) {
                $.ajax({
                    url: "codes/fieldAuthenticate.php",
                    type: "POST",
                    data: {
                        period_name: Name,
                        period: period,
                        period_type: type,
                        period_details: dec
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == "name_exist") {
                            swal({
                                title: "দুঃখিত",
                                text: "এই নামে ইতোমধ্যে একটি ক্ষেত্র নিবন্ধন রয়েছে",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 1) {
                            $("#period_reg_form").trigger("reset");
                            swal({
                                title: "অভিনন্দন",
                                text: "ক্ষেত্র নিবন্ধিত হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal({
                                title: "দুঃখিত",
                                text: "ক্ষেত্র নিবন্ধিত হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        console.log(data);
                    }
                })
            } else {
                swal({
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