<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($regForm5 == 0) {
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
                <li class="breadcrumb-item active" aria-current="page">ফিল্ড নিবন্ধন</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Field Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5" style="max-width: 600px;">
    <div class="form_heading mb-5">
        <h2 class="text-center">ফিল্ড নিবন্ধন ফরম</h2>
    </div>
    <form action="" id="field_form">
        <div class="row">

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>ফরমের তথ্যাবলি</h4>
            </div>

            <!-- Form Information -->
            <div class="col-md-12 mb-3">
                <label for="name" class="pb-2">ফিল্ডের নাম <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-input p-3 input_field" placeholder="ফিল্ডের নাম লিখুন" id="field_name" name="field_name">
                <div id="field-name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    ফিল্ডের নাম লিখুন
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="details" class="pb-2">বিস্তারিত</label>
                <textarea class="form-control p-3 input_field" id="details" name="field_dec" rows="3" placeholder="ফিল্ড সম্পর্কে বিস্তারিত লিখুন..."></textarea>
                <div id="field-dec-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    ফিল্ড সম্পর্কে বিস্তারিত লিখুন
                </div>
            </div>
            <div class="col-md-12">
                <button id="reg_reset" class="btn form-control btn-button my-3">রিসেট করুন</button>
                <button type="submit" class="btn form-control btn-button">সাবমিট করুন</button>
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
        $("#field_name").on("keyup", function() {
            var nameLentgh = $("#field_name").val().length;
            if (nameLentgh >= 100) {
                $("#field_name").attr("maxlength", "100");
                $("#field_name").addClass("is-invalid");
                $("#field-name-feedback").text("১০০ সংখ্যার মধ্যে ফিল্ডের নাম লিখুন");
                $("#field-name-feedback").css("display", "block");
            } else {
                $("#field_name").removeClass("is-invalid");
                $("#field-name-feedback").css("display", "none");
            }
        })
        $("#details").on("keyup", function() {
            var decLentgh = $("#details").val().length;
            if (decLentgh >= 250) {
                $("#details").attr("maxlength", "250");
                $("#details").addClass("is-invalid");
                $("#field-dec-feedback").text("২৫০ সংখ্যার মধ্যে ফিল্ডের মন্তব্য লিখুন");
                $("#field-dec-feedback").css("display", "block");
            } else {
                $("#details").removeClass("is-invalid");
                $("#field-dec-feedback").css("display", "none");
            }
        })

        $("#field_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var fieldName = $("#field_name").val();
            var field_dec = $("#details").val();
            var fieldNameLength = fieldName.length;
            var fieldDecLength = field_dec.length;

            // Empty Input Checking
            if (fieldName == "" || fieldName == null) {
                $("#field_name").addClass("is-invalid");
                $("#field-name-feedback").css("display", "block");
            }

            // Length Checking
            if (fieldNameLength > 100) {
                $("#field_name").addClass("is-invalid");
                $("#field-name-feedback").text("১০০ অক্ষরের মদ্ধ্যে ফিল্ডের নাম লিখুন");
                $("#field-name-feedback").css("display", "block");
            }
            if (fieldDecLength > 250) {
                $("#details").addClass("is-invalid");
                $("#field-dec-feedback").text("২৫০ অক্ষরের মদ্ধ্যে মন্তব্য লিখুন");
                $("#field-dec-feedback").css("display", "block");
            }

            // Ajax Action
            if (fieldName != "" && fieldName != null && fieldNameLength < 100 && fieldDecLength < 250) {
                $.ajax({
                    url: "codes/fieldAuthenticate.php",
                    type: "POST",
                    data: $("#field_form").serialize(),
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
                                text: "এই নামে ইতোমধ্যে একটি ফিল্ড নিবন্ধন রয়েছে",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 1) {
                            $("#field_form").trigger("reset");
                            swal({
                                title: "অভিনন্দন",
                                text: "ফিল্ড নিবন্ধিত হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal({
                                title: "দুঃখিত",
                                text: "ফিল্ড নিবন্ধিত হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        // console.log(data);
                    }
                })
            }

        })
    })
</script>
</body>

</html>