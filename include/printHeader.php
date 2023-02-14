<?php
include_once "config/app.php";
if (!isset($_SESSION['authenticate']) && !isset($_COOKIE['userID'])) {
    redirect("login");
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
if ($page == "collection-print-report.php") {
    $pageName = "কালেকশন রিপোর্ট | ";
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
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="./CSS/style.css"> -->
    <!-- Responsive Css -->
    <!-- <link rel="stylesheet" href="./CSS/responsive.css"> -->
    <!-- Print Media -->
    <link rel="stylesheet" href="./CSS/print.css">
    <style>
        @media print {

            table th:nth-child(4) {
                width: 15%;
            }
        }
    </style>
</head>

<body>

    <!-- Report Header -->
    <section id="sheetHeader">
        <div class="conatiner-fluid">
            <div class="row">
                <div class="col-2 d-flex align-items-center">
                    <div class="logo">
                        <div class="img">
                            <img src="<?= baseUrl('img/') . $logo ?>" alt="logo">
                        </div>
                    </div>
                </div>
                <div class="col-8 text-center">
                    <h5>বিসমিল্লাহির রাহমানির রাহীম</h5>
                    <h2><?= $siteName ?></h2>
                    <h3>(একটি কল্যাণমূখী আর্থ-সামাজিক সংগঠন)</h3>
                    <h4>প্রধান কার্যালয়ঃ জানে আলম ভবন (২য় তলা), কালামিয়া বাজার, বাকলিয়া, চট্রগ্রাম</h4>
                    <h4>স্থাপিতঃ ২০১৬ইং, রেজিঃ ০০০০০০০০০০০০১২</h4>
                </div>
                <div class="col-2">
                </div>
            </div>
        </div>
    </section>
    <hr>