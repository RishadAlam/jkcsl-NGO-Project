<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($regForm6 == 0) {
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
                <li class="breadcrumb-item active" aria-current="page">ক্ষেন্দ্র নিবন্ধন</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Savings Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5" style="max-width: 1000px;">
    <div class="form_heading mb-5">
        <h2 class="text-center">কেন্দ্র নিবন্ধন ফরম</h2>
    </div>
    <form action="" id="center_reg_form">
        <div class="row">

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>ফরমের তথ্যাবলি</h4>
            </div>

            <!-- Form Information -->
            <div class="col-md-6 mb-3">
                <label for="center_name" class="pb-2">কেন্দ্রের নাম <span class="text-danger">*</span></label>
                <input type="text" class="form-control input_field form-input p-3" placeholder="কেন্দ্রের নাম লিখুন" name="center_name" id="center_name">
                <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    কেন্দ্রের নাম লিখুন
                </div>
            </div>
            <div class="col-md-6 mb-3 select">
                <label for="feild" class="pb-2">ফিল্ড <span class="text-danger">*</span></label>
                <select id="feild" class="form-control input_field form-input p-3" name="feild">
                    <option class="feild" value="" disabled selected>ফিল্ড নির্বারচন করুন...</option>
                </select>
                <div id="field-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    ফিল্ড নির্বারচন করুন
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="details" class="pb-2">বিস্তারিত</label>
                <textarea class="form-control input_field p-3" id="details" rows="3" placeholder="কেন্দ্র সম্পর্কে বিস্তারিত লিখুন..." name="details"></textarea>
                <div id="dec-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    কেন্দ্র সম্পর্কে বিস্তারিত লিখুন
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

        // Keyup validation
        $("#center_name").on("keyup", function() {
            var nameLentgh = $("#center_name").val().length;
            if (nameLentgh >= 100) {
                $("#center_name").attr("maxlength", "100");
                $("#center_name").addClass("is-invalid");
                $("#name-feedback").text("১০০ সংখ্যার মধ্যে কেন্দ্রের নাম লিখুন");
                $("#name-feedback").css("display", "block");
            } else {
                $("#center_name").removeClass("is-invalid");
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

        $("#center_reg_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var Name = $("#center_name").val();
            var dec = $("#details").val();
            var feild = $("#feild").val();
            var NameLength = Name.length;
            var DecLength = dec.length;
            // console.log(feild);

            // Empty Input Checking
            if (Name == "" || Name == null) {
                $("#center_name").addClass("is-invalid");
                $("#name-feedback").css("display", "block");
            }
            if (feild == "" || feild == null) {
                $("#feild").addClass("is-invalid");
                $("#field-feedback").css("display", "block");
            }

            // Length Checking
            if (NameLength > 100) {
                $("#center_name").addClass("is-invalid");
                $("#name-feedback").text("১০০ অক্ষরের মদ্ধ্যে কেন্দ্রের নাম লিখুন");
                $("#name-feedback").css("display", "block");
            }
            if (DecLength > 250) {
                $("#details").addClass("is-invalid");
                $("#dec-feedback").text("২৫০ অক্ষরের মদ্ধ্যে মন্তব্য লিখুন");
                $("#dec-feedback").css("display", "block");
            }

            // Ajax Action
            if (Name != "" && Name != null && NameLength < 100 && DecLength < 250 && feild != "" && feild != null) {
                $.ajax({
                    url: "codes/fieldAuthenticate.php",
                    type: "POST",
                    data: $("#center_reg_form").serialize(),
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
                                text: "এই নামে ইতোমধ্যে একটি কেন্দ্র নিবন্ধন রয়েছে",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 1) {
                            $("#center_reg_form").trigger("reset");
                            $("select").empty().trigger('change');
                            loadField();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "কেন্দ্র নিবন্ধিত হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "কেন্দ্র নিবন্ধিত হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        console.log(data);
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