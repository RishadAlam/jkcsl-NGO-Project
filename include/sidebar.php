<?php

$page = basename($_SERVER['PHP_SELF']);
$pageQuery = basename($_SERVER['QUERY_STRING']);
// echo "<pre>";
// print_r($page . '?' . $pageQuery);
// die();

$allFiled = $db->fieldLoad();
$allCenters = $db->centersLoad();
$savingsPeriods = $db->periodsLoad('1');
$loanPeriods = $db->periodsLoad('2');
$userPermissions = $db->userPrevilege();
foreach ($loadSite as $row) {
    $timeStart = $row['time_start'];
    $timeEnd = $row['time_end'];
}
if ($userPermissions) {
    foreach ($userPermissions as $row) {
        $regForm1 = $row['regForm1'];
        $regForm2 = $row['regForm2'];
        $regForm3 = $row['regForm3'];
        $regForm4 = $row['regForm4'];
        $regForm5 = $row['regForm5'];
        $regForm6 = $row['regForm6'];
        $regForm7 = $row['regForm7'];
        $collectionForm1 = $row['collectionForm1'];
        $collectionForm2 = $row['collectionForm2'];
        $withdrawalForm1 = $row['withdrawalForm1'];
        $withdrawalForm2 = $row['withdrawalForm2'];
        $closingForm1 = $row['closingForm1'];
        $closingForm2 = $row['closingForm2'];
        $collectionReport = $row['collectionReport'];
        $waitingWithdrawal = $row['waitingWithdrawal'];
        $field = $row['field'];
        $bookCheck = $row['bookCheck'];
        $expiredCollection = $row['expiredCollection'];
        $analytics = $row['analytics'];
        $clientAcc = $row['clientAcc'];
    }
} else {
    $regForm1 = 0;
    $regForm2 = 0;
    $regForm3 = 0;
    $regForm4 = 0;
    $regForm5 = 0;
    $regForm6 = 0;
    $regForm7 = 0;
    $collectionForm1 = 0;
    $collectionForm2 = 0;
    $withdrawalForm1 = 0;
    $withdrawalForm2 = 0;
    $closingForm1 = 0;
    $closingForm2 = 0;
    $collectionReport = 0;
    $waitingWithdrawal = 0;
    $field = 0;
    $bookCheck = 0;
    $expiredCollection = 0;
    $analytics = 0;
    $clientAcc = 0;
}
$currentTime =  date('H:i', time());
$start =  date('H:i', strtotime($timeStart));
$end =  date('H:i', strtotime($timeEnd));
?>
<!-- SideBar -->
<section id="sidebar" class="sidebar">
    <!-- logo -->
    <div class="logo">
        <a href="<?= baseUrl('/') ?>">
            <?php
            foreach ($loadSite as $row) { ?>
                <div class="img mb-3">
                    <img src="<?= baseUrl('/') ?>img/<?= $row['logo'] ?>" alt="logo">
                </div>
                <div class="web_name text-center">
                    <h3><?= $row['site_name'] ?></h3>
                </div>
            <?php
            }
            ?>
        </a>
    </div>

    <!-- Sidebar Sizing Btn -->
    <div class="close">
        <span id="toggle" class="toggle"><i class='bx bx-chevron-right'></i></span>
        <span id="m_toggle"><i class='bx bx-x'></i></span>
    </div>

    <!-- Menu -->
    <nav class="scrollbar">
        <ul>
            <li><a class="<?= $page == 'index.php' ? 'active' : '' ?>" href="<?= baseUrl('/') ?>">
                    <span class="menu-icon"><i class='bx bx-home'></i></span>
                    <span class="menu-title">ড্যাশবোর্ড</span>
                </a></li>
            <?php if ($regForm1 != 0 || $regForm2 != 0 || $regForm3 != 0 || $regForm4 != 0 || $regForm5 != 0 || $regForm6 != 0 || $regForm7 != 0) { ?>
                <li class="dropdown"><a class="<?= $page == 'savings-account-registration-form.php' || $page == 'savings-client-registration-form.php' || $page == 'loan-account-registration-form.php' || $page == 'officer-registration-form.php' || $page == 'field-registration.php' || $page == 'center-registration.php' || $page == 'time-period-registration-form.php' ? 'active' : '' ?>">
                        <span class="menu-icon"><i class='bx bx-folder-open'></i></span>
                        <span class="menu-title">নিবন্ধন</span>
                    </a>
                    <ul class="<?= $page == 'savings-account-registration-form.php' || $page == 'savings-client-registration-form.php' || $page == 'loan-account-registration-form.php' || $page == 'officer-registration-form.php' || $page == 'field-registration.php' || $page == 'center-registration.php' || $page == 'time-period-registration-form.php' ? 'dropdown-m' : '' ?>">
                        <?php if ($regForm1 != 0) { ?>
                            <li><a class="<?= $page == 'savings-client-registration-form.php' ? 'active' : '' ?>" href="<?= baseUrl('savings-client-registration-form') ?>">
                                    <span class="menu-icon"><i class='bx bxs-user-rectangle'></i></span>
                                    <span class="menu-title">নতুন সদস্য নিবন্ধন</span>
                                </a></li>
                        <?php }
                        if ($regForm2 != 0) { ?>
                            <li><a class="<?= $page == 'savings-account-registration-form.php' ? 'active' : '' ?>" href="<?= baseUrl('savings-account-registration-form') ?>">
                                    <span class="menu-icon"><i class='bx bxs-user-badge'></i></span>
                                    <span class="menu-title">সঞ্চয় সদস্য নিবন্ধন</span>
                                </a></li>
                        <?php }
                        if ($regForm3 != 0) { ?>
                            <li><a class="<?= $page == 'loan-account-registration-form.php' ? 'active' : '' ?>" href="<?= baseUrl('loan-account-registration-form') ?>">
                                    <span class="menu-icon"><i class='bx bxs-user-detail'></i></span>
                                    <span class="menu-title">ঋণ সদস্য নিবন্ধন</span>
                                </a></li>
                        <?php }
                        if ($regForm4 != 0) { ?>
                            <li><a class="<?= $page == 'officer-registration-form.php' ? 'active' : '' ?>" href="<?= baseUrl('officer-registration-form') ?>">
                                    <span class="menu-icon"><i class='bx bx-user-pin'></i></span>
                                    <span class="menu-title">অফিসার নিবন্ধন</span>
                                </a></li>
                        <?php }
                        if ($regForm5 != 0) { ?>
                            <li><a class="<?= $page == 'field-registration.php' ? 'active' : '' ?>" href="<?= baseUrl('field-registration') ?>">
                                    <span class="menu-icon"><i class='bx bx-qr'></i></span>
                                    <span class="menu-title">ফিল্ড নিবন্ধন</span>
                                </a></li>
                        <?php }
                        if ($regForm6 != 0) { ?>
                            <li><a class="<?= $page == 'center-registration.php' ? 'active' : '' ?>" href="<?= baseUrl('center-registration') ?>">
                                    <span class="menu-icon"><i class='bx bx-bullseye'></i></span>
                                    <span class="menu-title">কেন্দ্র নিবন্ধন</span>
                                </a></li>
                        <?php }
                        if ($regForm7 != 0) { ?>
                            <li><a class="<?= $page == 'time-period-registration-form.php' ? 'active' : '' ?>" href="<?= baseUrl('time-period-registration-form') ?>">
                                    <span class="menu-icon"><i class='bx bx-transfer'></i></span>
                                    <span class="menu-title">সংগ্রহ ক্ষেত্র নিবন্ধন</span>
                                </a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($collectionForm1 != 0 || $collectionForm2 != 0) { ?>
                <li class="dropdown"><a class="<?= $page == 'savings-collection-form.php' || $page == 'loan-collection-form.php' ? 'active' : '' ?>" href="#">
                        <span class="menu-icon"><i class='bx bxs-pen'></i></span>
                        <span class="menu-title">সংগ্রহ</span>
                    </a>
                    <ul class=" <?= $page == 'savings-collection-form.php' || $page == 'loan-collection-form.php' ? 'dropdown-m' : '' ?> ">
                        <?php if ($collectionForm1 != 0) { ?>
                            <li><a class=" <?= $page == 'savings-collection-form.php' ? 'active' : '' ?>" href="<?= baseUrl('savings-collection-form') ?>">
                                    <span class="menu-icon"><i class='bx bx-dollar-circle'></i></span>
                                    <span class="menu-title">সঞ্চয় সংগ্রহ</span>
                                </a>
                            </li>
                        <?php }
                        if ($collectionForm2 != 0) { ?>
                            <li><a class="<?= $page == 'loan-collection-form.php' ? 'active' : '' ?>" href="<?= baseUrl('loan-collection-form') ?>">
                                    <span class="menu-icon"><i class='bx bxs-dollar-circle'></i></span>
                                    <span class="menu-title">ঋণ সংগ্রহ</span>
                                </a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($withdrawalForm1 != 0 || $withdrawalForm2 != 0) { ?>
                <li class="dropdown"><a class=" <?= $page == 'savings-withdraw-form.php' || $page == 'loan-savings-withdraw-form.php' ? 'active' : '' ?> " href="#">
                        <span class="menu-icon"><i class='bx bx-money-withdraw'></i></span>
                        <span class="menu-title">উত্তোলন</span>
                    </a>
                    <ul class=" <?= $page == 'savings-withdraw-form.php' || $page == 'loan-savings-withdraw-form.php' ? 'dropdown-m' : '' ?> ">
                        <?php if ($withdrawalForm1 != 0) { ?>
                            <li><a class="<?= $page == 'savings-withdraw-form.php' ? 'active' : '' ?>" href="<?= baseUrl('savings-withdraw-form') ?>">
                                    <span class="menu-icon"><i class='bx bx-message-square-x'></i></span>
                                    <span class="menu-title">সঞ্চয় উত্তোলন</span>
                                </a></li>
                        <?php }
                        if ($withdrawalForm2 != 0) { ?>
                            <li><a class="<?= $page == 'loan-savings-withdraw-form.php' ? 'active' : '' ?>" href="<?= baseUrl('loan-savings-withdraw-form') ?>">
                                    <span class="menu-icon"><i class='bx bxs-message-square-x'></i></span>
                                    <span class="menu-title">ঋণ সঞ্চয় উত্তোলন</span>
                                </a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($closingForm1 != 0 || $closingForm2 != 0) { ?>
                <li class="dropdown"><a class=" <?= $page == 'savings-account-closing-form.php' || $page == 'loan-account-closing-form.php' ? 'active' : '' ?> " href="#">
                        <span class="menu-icon"><i class='bx bx-window-close'></i></span>
                        <span class="menu-title">ক্লোজিং</span>
                    </a>
                    <ul class=" <?= $page == 'savings-account-closing-form.php' || $page == 'loan-account-closing-form.php' ? 'dropdown-m' : '' ?> ">
                        <?php if ($closingForm1 != 0) { ?>
                            <li><a class="<?= $page == 'savings-account-closing-form.php' ? 'active' : '' ?>" href="<?= baseUrl('savings-account-closing-form') ?>">
                                    <span class="menu-icon"><i class='bx bx-message-square-x'></i></span>
                                    <span class="menu-title">সঞ্চয় ক্লোজিং</span>
                                </a></li>
                        <?php }
                        if ($closingForm2 != 0) { ?>
                            <li><a class="<?= $page == 'loan-account-closing-form.php' ? 'active' : '' ?>" href="<?= baseUrl('loan-account-closing-form') ?>">
                                    <span class="menu-icon"><i class='bx bxs-message-square-x'></i></span>
                                    <span class="menu-title">ঋণ ক্লোজিং</span>
                                </a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($collectionReport != 0) { ?>
                <li><a class="<?= $page == 'collection-field-report.php' || $page == 'collection-savings-report.php' || $page == 'collection-loan-report.php' ? 'active' : '' ?>" href="<?= baseUrl('collection-field-report') ?>">
                        <span class="menu-icon"><i class='bx bxs-report'></i></span>
                        <span class="menu-title">কালেকশন রিপোর্ট</span>
                    </a></li>
            <?php }
            if ($waitingWithdrawal != 0) { ?>
                <li><a class="<?= $page == 'collection-withdrawal-field-report.php' || $page == 'collection-withdrawal-savings-report.php' || $page == 'collection-loan-withdrawal-report.php' ? 'active' : '' ?>" href="<?= baseUrl('collection-withdrawal-field-report') ?>">
                        <span class="menu-icon"><i class='bx bx-math'></i></span>
                        <span class="menu-title">অপেক্ষারত উত্তোলন</span>
                    </a></li>
            <?php }
            if ($field != 0) { ?>
                <li class="dropdown"><a class="<?= $page == 'field.php' ? 'active' : '' ?>" href="#">
                        <span class="menu-icon"><i class='bx bx-category-alt'></i></span>
                        <span class="menu-title">ফিল্ড</span>
                    </a>
                    <ul class="<?= $page == 'field.php' ? 'dropdown-m' : '' ?>">
                        <?php foreach ($allFiled as $field) { ?>
                            <li><a class="<?php if ($page . '?' . $pageQuery == 'field.php?field=' . $field['feild_id']) {
                                                echo 'active';
                                            } else {
                                                echo "";
                                            } ?>" href="<?= baseUrl('field') ?>?field=<?= $field['feild_id'] ?>">
                                    <span class="menu-icon"><i class='bx bxs-florist'></i></span>
                                    <span class="menu-title"><?= $field['field_name'] ?></span>
                                </a></li>
                        <?php }
                        ?>
                    </ul>
                </li>
                <li class="dropdown"><a class="<?= $page == 'centers.php' ? 'active' : '' ?>" href="#">
                        <span class="menu-icon"><i class='bx bx-building-house'></i></span>
                        <span class="menu-title">কেন্দ্র</span>
                    </a>
                    <ul class="<?= $page == 'centers.php' ? 'dropdown-m' : '' ?>">
                        <?php foreach ($allCenters as $center) { ?>
                            <li><a class="<?php if ($page . '?' . $pageQuery == 'centers.php?center=' . $center['center_id']) {
                                                echo 'active';
                                            } else {
                                                echo "";
                                            } ?>" href="<?= baseUrl('centers') ?>?center=<?= $center['center_id'] ?>">
                                    <span class="menu-icon"><i class='bx bxs-institution'></i></span>
                                    <span class="menu-title"><?= $center['center_name'] ?></span>
                                </a></li>
                        <?php }
                        ?>
                    </ul>
                </li>
                <li class="dropdown"><a class="<?= $page == 'savings-periods.php' ? 'active' : '' ?>" href="#">
                        <span class="menu-icon"><i class='bx bx-collection'></i></span>
                        <span class="menu-title">সঞ্চয় ক্ষেত্র</span>
                    </a>
                    <ul class="<?= $page == 'savings-periods.php' ? 'dropdown-m' : '' ?>">
                        <?php foreach ($savingsPeriods as $period) { ?>
                            <li><a class="<?php if ($page . '?' . $pageQuery == 'savings-periods.php?period=' . $period['period_id']) {
                                                echo 'active';
                                            } else {
                                                echo "";
                                            } ?>" href="<?= baseUrl('savings-periods') ?>?period=<?= $period['period_id'] ?>">
                                    <span class="menu-icon"><i class='bx bx-braille'></i></span>
                                    <span class="menu-title"><?= $period['period_name'] ?></span>
                                </a></li>
                        <?php }
                        ?>
                    </ul>
                </li>
                <li class="dropdown"><a class="<?= $page == 'loan-periods.php' ? 'active' : '' ?>" href="#">
                        <span class="menu-icon"><i class='bx bx-sitemap'></i></span>
                        <span class="menu-title">ঋণ ক্ষেত্র</span>
                    </a>
                    <ul class="<?= $page == 'loan-periods.php' ? 'dropdown-m' : '' ?>">
                        <?php foreach ($loanPeriods as $lperiod) { ?>
                            <li><a class="<?php if ($page . '?' . $pageQuery == 'loan-periods.php?period=' . $lperiod['period_id']) {
                                                echo 'active';
                                            } else {
                                                echo "";
                                            } ?>" href="<?= baseUrl('loan-periods') ?>?period=<?= $lperiod['period_id'] ?>">
                                    <span class="menu-icon"><i class='bx bx-stats'></i></span>
                                    <span class="menu-title"><?= $lperiod['period_name'] ?></span>
                                </a></li>
                        <?php }
                        ?>
                    </ul>
                </li>
            <?php }
            if ($bookCheck != 0) { ?>
                <li><a class="<?= $page == 'checking-books.php' ? 'active' : '' ?>" href="<?= baseUrl('checking-books') ?>">
                        <span class="menu-icon"><i class='bx bx-book-open'></i></span>
                        <span class="menu-title">বই চেকিং</span>
                    </a></li>
                <li><a class="<?= $page == 'tamadi-checking-books.php' ? 'active' : '' ?>" href="<?= baseUrl('tamadi-checking-books') ?>">
                        <span class="menu-icon"><i class='bx bxs-bookmark-minus'></i></span>
                        <span class="menu-title">তামাদি বই চেকিং</span>
                    </a></li>
            <?php }
            if ($expiredCollection != 0) { ?>
                <li><a class="<?= $page == 'tamadi-collection-field-report.php' || $page == 'tamadi-collection-savings-report.php' || $page == 'tamadi-collection-loan-report.php' ? 'active' : '' ?>" href="<?= baseUrl('tamadi-collection-field-report') ?>">
                        <span class="menu-icon"><i class='bx bxl-twitch'></i></span>
                        <span class="menu-title">তামাদি কালেকশন</span>
                    </a></li>
            <?php }
            if ($analytics != 0) { ?>
                <li><a class="<?= $page == 'analytics.php' ? 'active' : '' ?>" href="<?= baseUrl('analytics') ?>">
                        <span class="menu-icon"><i class='bx bx-line-chart'></i></span>
                        <span class="menu-title">এনালেটিক্স</span>
                    </a></li>
            <?php } ?>
            <li><a class="<?= $page == 'sand-box.php' ? 'active' : '' ?>" href="<?= baseUrl('sand-box') ?>">
                    <span class="menu-icon"><i class='bx bx-envelope'></i></span>
                    <span class="menu-title">সেন্ড-বক্স</span>
                </a></li>
            <?php
            if (!$_SESSION['auth']['user_role']) { ?>
                <li><a class="<?= $page == 'khelapi-field-report.php' ? 'active' : '' ?>" href="<?= baseUrl('khelapi-field-report') ?>">
                        <span class="menu-icon"><i class='bx bxl-deviantart'></i></span>
                        <span class="menu-title">খেলাপি রিপোর্ট</span>
                    </a></li>
                <li><a class="<?= $page == 'fdr.php' ? 'active' : '' ?>" href="<?= baseUrl('fdr') ?>">
                        <span class="menu-icon"><i class='bx bx-coin-stack'></i></span>
                        <span class="menu-title">এফ ডি আর</span>
                    </a></li>
                <li><a class="<?= $page == 'officers.php' ? 'active' : '' ?>" href="<?= baseUrl('officers') ?>">
                        <span class="menu-icon"><i class='bx bx-group'></i></span>
                        <span class="menu-title">অফিসার</span>
                    </a></li>
                <li><a class="<?= $page == 'officers-permisson.php' ? 'active' : '' ?>" href="<?= baseUrl('officers-permisson') ?>">
                        <span class="menu-icon"><i class='bx bx-server'></i></span>
                        <span class="menu-title">অফিসার অনুমতি</span>
                    </a></li>
                <li><a class="<?= $page == 'expense.php' ? 'active' : '' ?>" href="<?= baseUrl('expense') ?>">
                        <span class="menu-icon"><i class='bx bx-money'></i></span>
                        <span class="menu-title">ব্যয়</span>
                    </a></li>
                <li><a class="<?= $page == 'income.php' ? 'active' : '' ?>" href="<?= baseUrl('income') ?>">
                        <span class="menu-icon"><i class='bx bx-dollar'></i></span>
                        <span class="menu-title">আয়</span>
                    </a></li>
                <li><a class="<?= $page == 'audit-report.php' ? 'active' : '' ?>" href="<?= baseUrl('audit-report') ?>">
                        <span class="menu-icon"><i class='bx bx-analyse'></i></span>
                        <span class="menu-title">অডিট</span>
                    </a></li>
            <?php } ?>
            <li><a class="<?= $page == 'settings.php' ? 'active' : '' ?>" href="<?= baseUrl('settings') ?>">
                    <span class="menu-icon"><i class='bx bx-cog'></i></span>
                    <span class="menu-title">সেটিংস</span>
                </a></li>
        </ul>
    </nav>

</section>