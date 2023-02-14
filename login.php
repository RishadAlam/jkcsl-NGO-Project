<?php
include_once "config/app.php";
// ob_start();
if (isset($_SESSION['authenticate']) || isset($_COOKIE['userID'])) {
  if ($_SESSION['authenticate'] == true || isset($_COOKIE['userID'])) {
    redirect("index.php", "loggedin", "আপনি ইতিমধ্যে এ লগইন করেছেন");
  }
}
$loadSite = $db->loadsite();
foreach ($loadSite as $row) {
  $logo = $row['logo'];
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
      font-size: 24px;
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
          <div class="img mx-auto mb-4" style="width: 150px;">
            <img src="<?= baseUrl("img/") . $logo ?>" alt="" style="border-radius: 50%; object-position: center;" />
          </div>
          <h2 class="heading-section">জনকল্যাণ কর্মজীবি কো-অপারেটিভ সোসাইটি লিমিটেড</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <div class="login-wrap p-0">
            <h4 class="mb-4 text-center <?= isset($_GET['activateAccount']) ? "bg-success d-block message" : '' ?>"><?= isset($_GET['activateAccount']) ? "লগইন পাসওয়ার্ড নিশ্চিত হয়েছে লগইন করুন" : '' ?></h4>
            <h3 class="mb-4 text-center">প্রবেশ করুন</h3>
            <form action="codes/authentication.php" class="signin-form" method="POST">
              <div class="form-group">
                <input type="text" class="form-control <?= isset($_SESSION['email_error']) ? 'is-invalid' : '' ?>" placeholder="ইমেল আইডি" name="email" value="<?= isset($_COOKIE['userEmail']) ? $_COOKIE['userEmail'] : '' ?>" />
                <span class="text-light <?= isset($_SESSION['email_error']) ? "bg-danger d-block message" : '' ?>">
                  <?= isset($_SESSION['email_error']) ? $_SESSION['email_error'] : '' ?>
                </span>
              </div>
              <div class="form-group">
                <input id="password-field" type="password" class="form-control <?= isset($_SESSION['password_error']) ? 'is-invalid' : '' ?>" placeholder="পাসওয়ার্ড" name="password" value="<?= isset($_COOKIE['userPass']) ? sha1($_COOKIE['userPass']) : '' ?>" />
                <span toggle="#password-field" class="field-icon toggle-password" style="color: var(--primary_color);"><i class="bx bx-lock"></i></span>
              </div>
              <span class="text-light mb-3 <?= isset($_SESSION['password_error']) ? "bg-danger d-block message" : '' ?>">
                <?= isset($_SESSION['password_error']) ? $_SESSION['password_error'] : '' ?>
              </span>
              <div class="form-group">
                <button type="submit" class="form-control btn btn-primary submit px-3" name="login">লগইন করুন</button>
              </div>
              <div class="form-group d-md-flex">
                <div class="w-50">
                  <label class="checkbox-wrap checkbox-primary">মনে রাখুন
                    <input type="checkbox" name="remember_me" />
                    <span class="checkmark"><i class="bx bx-checkbox"></i><i class="bx bxs-check-square d-none"></i></span>
                  </label>
                </div>
                <div class="w-50 text-md-right">
                  <a href="#" style="color: #fff">পাসওয়ার্ড ভুলে গিয়েছেন?</a>
                </div>
              </div>
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
  </script>
</body>

</html>
<?php
unset($_SESSION['email_error']);
unset($_SESSION['password_error']);
?>