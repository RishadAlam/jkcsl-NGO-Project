<?php
include_once "config/app.php";
if (!isset($_SESSION['authenticate']) && !isset($_COOKIE['userID'])) {
    redirect("login.php");
}
if (!isset($_SESSION['authenticate']) && isset($_COOKIE['userID'])) {
    $_SESSION['authenticate'] = true;
    $_SESSION['auth']['user_name'] = $_COOKIE['userName'];
    $_SESSION['auth']['user_id'] = $_COOKIE['userID'];
    $_SESSION['auth']['user_role'] = $_COOKIE['userRole'];
    $_SESSION['auth']['user_img'] = $_COOKIE['userImg'];
}
date_default_timezone_set('Asia/Dhaka');
$theme = $db->bgTheme($_SESSION['auth']['user_id']);
$loadSite = $db->loadsite();
foreach ($loadSite as $row) {
    $siteName = $row['site_name'];
    $logo = $row['logo'];
}
$page = basename($_SERVER['PHP_SELF']);
$pageName = null;
if ($page == "savings-client-registration-form.php") {
    $pageName = "নতুন সদস্য নিবন্ধন | ";
} elseif ($page == "savings-account-registration-form.php") {
    $pageName = "সঞ্চয় পত্রের সদস্য নিবন্ধন | ";
} elseif ($page == "loan-account-registration-form.php") {
    $pageName = "ঋণ পত্রের সদস্য নিবন্ধন | ";
} elseif ($page == "officer-registration-form.php") {
    $pageName = "অফিসার নিবন্ধন | ";
} elseif ($page == "field-registration.php") {
    $pageName = "ফিল্ড নিবন্ধন | ";
} elseif ($page == "center-registration.php") {
    $pageName = "কেন্দ্র নিবন্ধন | ";
} elseif ($page == "time-period-registration-form.php") {
    $pageName = "সংগ্রহ ক্ষেত্র নিবন্ধন | ";
} elseif ($page == "savings-collection-form.php") {
    $pageName = "সঞ্চয় সংগ্রহ | ";
} elseif ($page == "loan-collection-form.php") {
    $pageName = "ঋণ সংগ্রহ | ";
} elseif ($page == "savings-withdraw-form.php") {
    $pageName = "সঞ্চয় উত্তোলন | ";
} elseif ($page == "loan-savings-withdraw-form.php") {
    $pageName = "ঋণ সঞ্চয় উত্তোলন | ";
} elseif ($page == "savings-account-closing-form.php") {
    $pageName = "সঞ্চয় ক্লোজিং | ";
} elseif ($page == "loan-account-closing-form.php") {
    $pageName = "ঋণ ক্লোজিং | ";
} elseif ($page == "collection-field-report.php") {
    $pageName = "কালেকশন রিপোর্ট | ";
} elseif ($page == "collection-withdrawal-field-report.php") {
    $pageName = "অপেক্ষারত উত্তোলন রিপোর্ট | ";
} elseif ($page == "checking-books.php") {
    $pageName = "বই চেকিং | ";
} elseif ($page == "tamadi-checking-books.php") {
    $pageName = "তামাদি বই চেকিং | ";
} elseif ($page == "tamadi-collection-field-report.php") {
    $pageName = "তামাদি কালেকশন রিপোর্ট | ";
} elseif ($page == "analytics.php") {
    $pageName = "হিসাব এনালেটিক্স | ";
} elseif ($page == "sand-box.php") {
    $pageName = "সেন্ড বক্স | ";
} elseif ($page == "fdr.php") {
    $pageName = "এফ ডি আর | ";
} elseif ($page == "officers.php") {
    $pageName = "সকল অফিসার | ";
} elseif ($page == "officers-permisson.php") {
    $pageName = "অফিসার অনুমতি | ";
} elseif ($page == "expense.php") {
    $pageName = "খরচ | ";
} elseif ($page == "income.php") {
    $pageName = "আয় | ";
} elseif ($page == "audit-report.php") {
    $pageName = "অডিট রিপোর্ট | ";
} elseif ($page == "settings.php") {
    $pageName = "সেটিংস | ";
} elseif ($page == "collection-savings-withdrawal-report.php" || $page == "collection-loan-withdrawal-report.php" || $page == "collection-savings-report.php" || $page == "collection-loan-report.php") {
    $pageName = "ক্ষেত্র তালিকা | ";
} elseif ($page == "field-savings-book-list.php" || $page == "field-loan-book-list.php") {
    $pageName = "সদস্য তালিকা | ";
} elseif ($page == "client-profile.php") {
    $pageName = "সদস্য প্রোফাইল | ";
} elseif ($page == "officer-profile.php") {
    $pageName = "অফিসার প্রোফাইল | ";
} elseif ($page == "savings-profile-stm.php") {
    $pageName = "সঞ্চয় প্রোফাইল | ";
} elseif ($page == "loan-profile-stm.php") {
    $pageName = "ঋণ প্রোফাইল | ";
} elseif ($page == "field.php") {
    $pageName = "ফিল্ড | ";
} elseif ($page == "centers.php") {
    $pageName = "কেন্দ্র| ";
} elseif ($page == "savings-periods.php") {
    $pageName = "সঞ্চয় ক্ষেত্র | ";
} elseif ($page == "loan-periods.php") {
    $pageName = "ঋণ ক্ষেত্র | ";
}
?>
<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageName . $siteName ?></title>
    <link rel="icon" type="image/x-icon" href="<?= baseUrl('img/') . $row['logo'] ?>">
    <!-- Kalpurush Font -->
    <link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet" />
    <!-- bootstrap5 -->
    <link href="./CSS/bootstrap.min.css" rel="stylesheet">
    <!-- Font Aowsome -->
    <link rel="stylesheet" href="./CSS/all.min.css">
    <!-- Box icon -->
    <link rel="stylesheet" href="./CSS/boxicons.min.css">
    <!-- Data Table -->
    <link rel="stylesheet" href="./CSS/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./CSS/responsive.dataTables.min.css">
    <!-- Tabs -->
    <link rel="stylesheet" href="./CSS/addTabs.min.css">
    <!-- Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="./CSS/daterangepicker.css" />
    <!-- Time Picker -->
    <link rel="stylesheet" href="./CSS/mdtimepicker.min.css">
    <!-- Custom scrolling -->
    <link rel="stylesheet" href="./CSS/perfect-scrollbar.css">
    <!-- Tail Select -->
    <link rel="stylesheet" href="./CSS/tail.select-light.css">
    <!-- Select2 -->
    <link href="./CSS/select2.min.css" rel="stylesheet" />
    <!-- google font (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="./CSS/style.css">
    <!-- Responsive Css -->
    <link rel="stylesheet" href="./CSS/responsive.css">
</head>

<body style="background-image: <?php foreach ($theme as $row) { ?> url(<?= baseUrl('/') ?>img/<?= $row['bg_img'] ?>) <?php } ?>; background-position: center; background-size: cover; background-repeat: no-repeat;">

    <!-- PreLoader -->
    <div id="overlayer"></div>
    <div id="preloader">
        <div id="loader"></div>
    </div>