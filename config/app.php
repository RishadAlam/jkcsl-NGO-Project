<?php
// Use Namespace
// Include Database
include_once "Database.php";

use config\Database\Database;

session_start();

// Database Constant Define
function url()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        '/jonokollan%20NGO/'
    );
}
// define('SITE_URL', 'https://jonokollan.com/');
define('SITE_URL', url());
// print_r(SITE_URL);


// Create Database object
$db = new Database();
$conn = $db->link;
// print_r($conn);

// Create Url Function
function baseUrl($slung)
{
    return  SITE_URL . $slung;
}

// Create Validation Function
function validate($db, $input)
{
    return mysqli_real_escape_string($db, $input);
}

// Create Email Validation Function
function emailValidate($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

// Create Redirect Page Function
function redirect($page, $session = null, $message = null)
{
    $redirect_to = baseUrl($page);
    $_SESSION[$session] = $message;

    header("location: ${redirect_to}");
    exit(0);
}

// Create Password Checking Function
function confirm_password($pass, $confirm_pass)
{
    if ($pass === $confirm_pass) {
        return true;
    } else {
        return false;
    }
}

// Create Required Checking Function
function required($input)
{
    if ($input == "") {
        return false;
    } else {
        return true;
    }
}

// Create Image Extantion Validate 
function imgExtValidate($imgName)
{
    $extantion = pathinfo($imgName, PATHINFO_EXTENSION);
    $ext = strtolower($extantion);
    $validExt = array("jpg", "jpeg", "png", "webp");

    if (in_array($ext, $validExt)) {
        return true;
    } else {
        return false;
    }
}

// Create Image Size Validate
function imgSizeValidate($size)
{
    if ($size <= 6291456) {
        return true;
    } else {
        return false;
    }
}
