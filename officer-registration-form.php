<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($regForm4 == 0) {
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
                <li class="breadcrumb-item active" aria-current="page">অফিসার নিবন্ধন</li>
            </ol>
        </nav>
    </div>
</div>

<!-- officers Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5">
    <div class="form_heading mb-5">
        <h2 class="text-center">অফিসার নিবন্ধন ফরম</h2>
    </div>
    <form id="reg_form" method="POST">
        <div class="row">

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>ফরমের তথ্যাবলি</h4>
            </div>

            <!-- Form Information -->
            <div class="col-md-6 mb-3">
                <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                <input type="text" class="form-control input_field form-input p-3" placeholder="পুরো নাম লিখুন" name="name" id="name">
                <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    অফিসারের নাম লিখুন
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="nid" class="pb-2">জাতীয় পরিচয় পত্রের নম্বর</label>
                <input type="number" class="form-control input_field form-input p-3" placeholder="জাতীয় পরিচয় পত্রের নম্বর" name="nid" id="nid">
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone_number" class="pb-2">মোবাইল <span class="text-danger">*</span></label>
                <input type="number" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" name="phone_number" id="phone_number">
                <div id="phone-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    অফিসারের মোবাইল নম্বর দিন
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone_number_2" class="pb-2">মোবাইল - ২ (যদি থাকে)</label>
                <input type="number" class="form-control input_field form-input p-3" placeholder="মোবাইল নম্বর" name="phone_number_2" id="phone_number_2">
            </div>
            <div class="col-md-6 mb-3">
                <label for="dob" class="pb-2">জন্ম তারিখ</label>
                <input type="date" class="form-control input_field form-input p-3" placeholder="জন্ম তারিখ" name="dob" id="dob">
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
                <label for="email" class="pb-2">ইমেল (ইংরেজি) <span class="text-danger">*</span></label>
                <input type="email" class="form-control input_field form-input p-3" placeholder="ইমেল লিখুন ইংরেজিতে" id="email" name="email">
                <div id="email-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    অফিসারের ইমেল আইডি দিন
                </div>
            </div>
            <div class="col-md-6 mb-3 select">
                <label for="role" class="pb-2">পদবী <span class="text-danger">*</span></label>
                <select id="role" class="form-control input_field form-input p-3" name="role">
                    <option class="feild" value="null" disabled selected>পদবী নির্বারচন করুন...</option>
                    <option value="ফিল্ড অফিসার">ফিল্ড অফিসার</option>
                    <option value="কম্পিউটার অফিসার">কম্পিউটার অফিসার</option>
                    <option value="ম্যানাজার">ম্যানাজার</option>
                    <option value="শাখা প্রধান">শাখা প্রধান</option>
                </select>
                <div id="role-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    অফিসারের পদবি দিন
                </div>
            </div>

            <!-- Clint Image -->
            <div class="col-md-6 mb-3">
                <label class="pb-2">সদস্য ছবি</label><br>
                <div class="text-start">
                    <label id="client_image" for="client_pic"><img id="image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image"></label>
                    <input class="d-none" type="file" id="client_pic" name="client_pic" />
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn form-control btn-button" id="submit" name="submit">সাবমিট করুন</button>
            </div>
        </div>
    </form>
</div>

<?php
include "include/footer.php";
?>
<script>
    $(document).ready(function() {
        $("#reg_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var name = $("#name").val();
            var phone_number = $("#phone_number").val();
            var email = $("#email").val();
            var role = $("#role").val();
            var phone_length = phone_number.length;

            // Empty Input Checking
            if (name == "" || name == null) {
                $("#name").addClass("is-invalid");
                $("#name-feedback").css("display", "block");
            }
            if (phone_number == "" || phone_number == null) {
                $("#phone_number").addClass("is-invalid");
                $("#phone-feedback").css("display", "block");
            }
            if (phone_length != 11) {
                $("#phone_number").addClass("is-invalid");
                $("#phone-feedback").text("১১ ডিজিটের মোবাইল নম্বর দিন");
                $("#phone-feedback").css("display", "block");
            }
            if (email == "" || email == null) {
                $("#email").addClass("is-invalid");
                $("#email-feedback").css("display", "block");
            }
            if (role == "" || role == null) {
                $("#role").addClass("is-invalid");
                $("#role-feedback").css("display", "block");
            }

            // Ajax Action
            if (name != "" && phone_number != "" && phone_length == 11 && email != "" && role != "") {
                var formData = new FormData(this);
                $.ajax({
                    url: "codes/officersAuthenticate.php",
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
                        if (data == "email_exist") {
                            swal.fire({
                                title: "দুঃখিত",
                                text: " এই ইমেলটি ইতোমধ্যে নিবন্ধিত রয়েছে",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 1) {
                            $("#reg_form").trigger("reset");
                            $("select").empty().trigger('change');
                            $("#image").attr("src", "./img/pngfind.com-copyright-png-938050.png");
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "অফিসার নিবন্ধিত হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "অফিসার নিবন্ধিত হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                    },
                    error: function(data){
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        console.log(data)
                    }
                })
            } else {
                swal.fire({
                    title: "দুঃখিত",
                    text: "আবার চেষ্টা করুন",
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