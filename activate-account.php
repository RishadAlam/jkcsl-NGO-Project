<?php
include_once "config/app.php";
// ob_start();
if (isset($_SESSION['authenticate']) || isset($_COOKIE['userID'])) {
  if ($_SESSION['authenticate'] == true || isset($_COOKIE['userID'])) {
    redirect("index.php", "loggedin", "আপনি ইতিমধ্যে এ লগইন করেছেন");
  }
}

if (!isset($_GET['token']) && !isset($_GET['email'])) {
  redirect("login");
}
?>
<!DOCTYPE html>
<html lang="bn">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>জনকল্যাণ কর্মজীবি কো-অপারেটিভ সোসাইটি লিমিটেড</title>
  <link rel="icon" type="image/x-icon" href="./img/download.jpg" />
  <!-- Kalpurush Font -->
  <link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet" />
  <!-- bootstrap5 -->
  <link href="./CSS/bootstrap.min.css" rel="stylesheet" />
  <!-- Box icon -->
  <link rel="stylesheet" href="./CSS/boxicons.min.css" />
  <!-- google font (Poppins) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" href="./CSS/style.css" />
  <style>
    body {
      color: var(--text-color) !important;
      font-size: 18px !important;
    }

    ::placeholder {
      color: var(--text-color) !important;
    }

    :-moz-placeholder,
    ::-moz-placeholder,
    :-ms-input-placeholder,
    ::-webkit-input-placeholder {
      color: var(--text-color) !important;
    }

    .heading-section {
      font-size: 32px;
      color: var(--text-color);
    }

    .login-wrap {
      position: relative;
      color: var(--text-color);
    }

    .form-control {
      background: transparent;
      border: none;
      height: 50px;
      color: white !important;
      border: 1px solid transparent;
      background: rgba(0, 0, 0, 0.2);
      border-radius: 40px;
      padding-left: 20px;
      padding-right: 20px;
      -webkit-transition: 0.3s;
      -o-transition: 0.3s;
      transition: 0.3s;
    }

    .form-control:focus {
      background: rgba(0, 0, 0, 0.5) !important;
      color: var(--text-color) !important;
    }

    .form-group {
      margin-bottom: 1rem;
      position: relative;
    }

    .field-icon {
      position: absolute;
      top: 50%;
      right: 15px;
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.9);
      cursor: pointer;
    }

    .btn.btn-primary {
      background: var(--primary_color) !important;
      border: 1px solid var(--primary_color) !important;
      color: var(--text-color) !important;
    }

    .checkbox-wrap {
      display: block;
      position: relative;
      padding-left: 30px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .checkbox-wrap input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      cursor: pointer;
    }

    .checkbox-wrap .checkmark>i {
      position: absolute;
      font-size: 25px;
      top: 50%;
      -webkit-transition: 0.3s;
      -o-transition: 0.3s;
      transition: 0.3s;
      color: var(--text-color);
    }

    .checkbox-wrap input:checked~.checkmark .bx-checkbox {
      display: none;
    }

    .checkbox-wrap input:checked~.checkmark .bxs-check-square {
      display: block !important;
      font-size: 19px !important;
    }

    .message {
      border-radius: 40px;
      padding: 5px 20px !important;
      margin-top: 5px;
      text-align: center;
    }
  </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="
      background-image: url(img/background_6.jpg);
      background-position: center;
        background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
      width: 100vw;
    ">
  <section class="ftco-section w-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-3">
          <div class="img mx-auto mb-4" style="width: 200px">
            <img src="./img/download.jpg" alt="" />
          </div>
          <h2 class="heading-section">জনকল্যাণ কর্মজীবি কো-অপারেটিভ সোসাইটি লিমিটেড</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <div class="login-wrap p-0">
            <h3 class="mb-4 text-center">লগইন পাসওয়ার্ড নিশ্চিত করুন</h3>
            <h4 class="mb-4 text-center bg-success message"><?= isset($_GET['email']) && isset($_GET['token']) ? "অ্যাকাউন্ট সক্রিয় হয়েছে" : '' ?></h4>
            <form id="activation_form">
              <div class="form-group">
                <input type="hidden" id="token" value="<?= $_GET['token'] ?>" />
                <input type="text" style="background: rgba(0, 0, 0, 0.2);" class="form-control" id="email" value="<?= isset($_GET['email']) ? $_GET['email'] : '' ?>" disabled />
              </div>
              <div class="form-group">
                <input type="password" id="password-field" class="form-control" placeholder="নতুন পাসওয়ার্ড" name="new_password" />
                <span toggle="#password-field" class="field-icon toggle-password" style="color: var(--primary_color);"><i class="bx bx-lock"></i></span>
              </div>
              <span id="new_password_feedback" class="text-light mb-3 bg-danger message" style="display: none;">নতুন পাসওয়ার্ড দিন</span>
              <div class="form-group">
                <input type="password" id="cpassword-field" class="form-control" placeholder="নিশ্চিত পাসওয়ার্ড" name="confirm_password" />
                <span toggle="#cpassword-field" class="field-icon toggle-password" style="color: var(--primary_color);"><i class="bx bx-lock"></i></span>
              </div>
              <span id="confirm_password_feedback" class="text-light mb-3 bg-danger message" style="display: none;">পাসওয়ার্ড নিশ্চিত করুন</span>
              <button type="submit" class="form-control btn btn-primary px-3">সাবমিট করুন</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- jQuery 3.6 -->
  <script src="./JS/jquery-3.6.0.min.js"></script>
  <!-- bootstrap -->
  <script src="./JS/bootstrap.min.js"></script>
  <!-- Sweet Alert -->
  <script src="./JS/sweetalert.min.js"></script>
  <script src="./JS/sweetalert2@11.js"></script>
  <!-- My script -->
  <script type="text/javascript">
    (function($) {
      // "use strict";
      $(".toggle-password").click(function() {
        //   $(this).children("i").toggle('<i class="bx bx-lock-open"></i>');
        if ($(this).children("i").hasClass("bx bx-lock")) {
          $(this).children("i").removeClass();
          $(this).children("i").addClass("bx bx-key");
        } else {
          $(this).children("i").removeClass();
          $(this).children("i").addClass("bx bx-lock");
        }
        //   $(this).html() == '<i class="bx bx-lock">'
        //     ? $(this).html('<i class="bx bx-lock-open"></i>')
        //     : $(this).html('<i class="bx bx-lock">');

        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    })(jQuery);

    $(document).ready(function() {
      $("#activation_form").on("submit", function(e) {
        e.preventDefault();

        // Store User primary Data
        var email = $("#email").val();
        var token = $("#token").val();
        var new_password = $("input[name='new_password']").val();
        var confirm_password = $("input[name='confirm_password']").val();
        console.log(email);
        // Empty Input Checking
        if (new_password == "" || new_password == null) {
          $("input[name='new_password']").addClass("is-invalid");
          $("#new_password_feedback").css("display", "block");
        } else if (new_password.length < 8) {

          $("input[name='new_password']").addClass("is-invalid");
          $("#new_password_feedback").text("সর্বনিম্ন ৮ অক্ষরের পাসওয়ার্ড দিন");
          $("#new_password_feedback").css("display", "block");
        } else if (confirm_password == "" || confirm_password == null) {
          $("#new_password_feedback").css("display", "none");
          $("input[name='new_password']").removeClass("is-invalid");
          $("input[name='new_password']").removeClass("is-invalid");
          $("#new_password_feedback").css("display", "none");

          $("#confirm_password").addClass("is-invalid");
          $("#confirm_password_feedback").css("display", "block");
        } else if (new_password != confirm_password) {
          $("#confirm_password").addClass("is-invalid");
          $("#confirm_password_feedback").text("পাসওয়ার্ড মেলেনি");
          $("#confirm_password_feedback").css("display", "block");
        }


        // Ajax Action
        if (new_password != "" && confirm_password != "" && new_password.length >= 8 && new_password == confirm_password) {

          $.ajax({
            url: "codes/authentication.php",
            type: "POST",
            data: {
              new_password: new_password,
              email: email,
              token: token
            },
            success: function(data) {
              console.log(data);
              if (data == 1) {
                $(location).attr('href', 'http://localhost/gkcsl/login?activateAccount=1');
              }
              if (data == 0) {
                swal.fire({
                  title: "দুঃখিত",
                  text: "আপনার একাউন্ট সক্রিয় হয়নি। আবার চেষ্টা করুন",
                  icon: 'error',
                  buttons: "OK",
                  dangerMode: true,
                })
              }
              if (data == "email_error") {
                swal.fire({
                  title: "দুঃখিত",
                  text: "আপনার একাউন্ট পাওয়া যাইনি",
                  icon: 'error',
                  buttons: "OK",
                  dangerMode: true,
                })
              }
              if (data == "token_error") {
                $(location).attr('href', 'http://localhost/gkcsl/404');
              }
            }
          })
        }

      })

    })
  </script>
</body>

</html>