<?php
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
?>
<!-- Breadcrumb -->
<div id="breadcrumb">
    <div class="container_fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="./index.html">ড্যাশবোর্ড</a></li>
                <li class="breadcrumb-item active" aria-current="page">পাসওয়ার্ড পরিবর্তন</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Field Registration Form -->
<div class="savings_reg_form mx-auto my-5 p-5" style="max-width: 600px;">
    <div class="form_heading mb-5">
        <h2 class="text-center">পাসওয়ার্ড পরিবর্তন ফরম</h2>
    </div>
    <form id="chengePasswordForm">
        <div class="row">

            <!-- Form Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>ফরমের তথ্যাবলি</h4>
            </div>

            <!-- Form Information -->
            <div class="col-md-12 mb-3">
                <label for="current-password" class="pb-2">পূর্বের পাসওয়ার্ড <span class="text-danger">*</span></label>
                <input type="password" class="form-control input_field form-input p-3" id="current-password">
                <div id="current-password-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    পূর্বের পাসওয়ার্ড দিন
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="new-password" class="pb-2">নতুন পাসওয়ার্ড <span class="text-danger">*</span></label>
                <input type="password" class="form-control input_field form-input p-3" id="new-password">
                <div id="new-password-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    নতুন পাসওয়ার্ড দিন
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="confirm-password" class="pb-2">কনফার্ম পাসওয়ার্ড <span class="text-danger">*</span></label>
                <input type="password" class="form-control input_field form-input p-3" id="confirm-password">
                <div id="confirm-password-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                    কনফার্ম পাসওয়ার্ড দিন
                </div>
            </div>
            <div class="col-md-12">
                <button type="reset" class="btn form-control btn-button my-3">রিসেট করুন</button>
                <button type="submit" class="btn form-control input_field btn-button">পাসওয়ার্ড পরিবর্তন করুন</button>
            </div>
        </div>
    </form>
</div>

<?php
include "include/footer.php";
?>
<script>
    $("#chengePasswordForm").on("submit", function(e) {
        e.preventDefault();
        var currentPassword = $("#current-password").val();
        var newPassword = $("#new-password").val();
        var confirmPassword = $("#confirm-password").val();

        // Empty Input Checking
        if (currentPassword == "" || currentPassword == null) {
            $("#current-password").addClass("is-invalid");
            $("#current-password-feedback").css("display", "block");
        }
        if (newPassword == "" || newPassword == null) {
            $("#new-password").addClass("is-invalid");
            $("#new-password-feedback").css("display", "block");
        }
        if (confirmPassword == "" || confirmPassword == null) {
            $("#confirm-password").addClass("is-invalid");
            $("#confirm-password-feedback").css("display", "block");
        }

        if (newPassword != confirmPassword) {
            $("#confirm-password").addClass("is-invalid");
            $("#confirm-password-feedback").css("display", "block");
            $("#confirm-password-feedback").text("নতুন পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মিল নেই");
        }

        // Ajax Action
        if (currentPassword != "" && currentPassword != null && newPassword != "" && newPassword != null && confirmPassword != "" && confirmPassword != null && newPassword === confirmPassword) {
            $.ajax({
                url: "codes/authentication.php",
                type: "POST",
                data: {
                    currentPassword: currentPassword,
                    newPassword: newPassword,
                    confirmPassword: confirmPassword,
                },
                beforeSend: function() {
                    $("#overlayer").fadeIn();
                    $("#preloader").fadeIn();
                },
                success: function(data) {
                    $("#overlayer").fadeOut();
                    $("#preloader").fadeOut();
                    if (data == true) {
                        $("#chengePasswordForm").trigger("reset");
                        swal.fire({
                            title: "অভিনন্দন",
                            text: "পাসসওয়ার্ড পরিবর্তন করা হয়েছে",
                            icon: 'success',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    } else if (data == "wrongPassword") {
                        $("#current-password").addClass("is-invalid");
                        $("#current-password-feedback").text("পাসওয়ার্ড সঠিক হয়নি");
                        $("#current-password-feedback").css("display", "block");
                        swal.fire({
                            title: "দুঃখিত",
                            text: "পাসওয়ার্ড সঠিক হয়নি",
                            icon: 'error',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    } else {
                        swal.fire({
                            title: "দুঃখিত",
                            text: "পাসসওয়ার্ড পরিবর্তন করা হয়নি। আবার চেষ্টা করুন",
                            icon: 'error',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    }
                    // console.log(data);
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