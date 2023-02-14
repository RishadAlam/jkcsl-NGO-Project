<?php

use controller\LoginController\LoginController\LoginController;


// include_once "../config/app.php";
include_once "../controller/LoginController.php";
$auth = new LoginController();

// Login Functionality
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['remember_me'])) {
        $rememberMe = $_POST['remember_me'];
    }
    
    // Empty Email or Password Checking
    if (!required($email)) {
        redirect("login.php", "email_error", "ইমেল প্রয়োজন");
    }

    // Empty Password Checking
    if (!required($_POST['password'])) {
        redirect("login.php", "password_error", "পাসওয়ার্ড প্রয়োজন");
    }

    // Invalid Email Checking
    if (!emailValidate($email)) {
        redirect("login.php", "email_error", "আপনার ইমেলটি সঠিক নয়");
    }

    $Pass = sha1($password);

    $login = $auth->login($email, $Pass, $rememberMe);

    if ($login) {
        redirect("index.php", "login_success", "স্বাগতম");
    }
}

// Logout Functionality
if (isset($_POST['logout'])) {
    $logout = $auth->logout();

    if ($logout) {
        redirect("login.php");
    } else {
        redirect("404.php");
    }
}

// Chenge password Functionality
if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $result = $auth->chengePassword($currentPassword, $newPassword, $confirmPassword);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

if (isset($_POST['token']) && isset($_POST['email']) && isset($_POST['new_password'])) {
    $newPass = $_POST['new_password'];
    $email = $_POST['email'];
    $token = $_POST['token'];

    $result = $auth->activateAccount($newPass, $email, $token);

    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}
