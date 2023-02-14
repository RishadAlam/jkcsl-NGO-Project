<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($analytics == 0) {
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
                <li class="breadcrumb-item active" aria-current="page">হিসাব এনালেটিক্স</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Analytics -->
<section id="analytics">
    <div class="container-fluid">
        <div class="analytics_tabs">
            <div class="date_picker text-end">
                <div id="reportrange" class="d-inline-block p-3 rounded-0 shadow-none" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span id="date_range"></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>

            <!-- Main Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="savings-tab" data-bs-toggle="tab" href="#savings" role="tab" aria-controls="savings" aria-selected="true">সঞ্চয় ও ডিপিএস</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="loan-tab" data-bs-toggle="tab" href="#loan" role="tab" aria-controls="loan" aria-selected="false">ঋণ</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="client-add-remove-tab" data-bs-toggle="tab" href="#client-add-remove" role="tab" aria-controls="client-add-remove" aria-selected="false">সদস্য নিবন্ধন/ক্লোজিং</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="loan-add-close-tab" data-bs-toggle="tab" href="#loan-add-close" role="tab" aria-controls="loan-add-close" aria-selected="false">ঋণ নিবন্ধন/ক্লোজিং</a>
                </li>
                <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="expance-tab" data-bs-toggle="tab" href="#expance" role="tab" aria-controls="expance" aria-selected="false">খরচ</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="income-tab" data-bs-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="false">আয়</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="score-tab" data-bs-toggle="tab" href="#score" role="tab" aria-controls="score" aria-selected="false">হিসাব</a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Main Tab contents -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="savings" role="tabpanel" aria-labelledby="savings-tab">
                    <div class="savings">
                        <!-- Savings Filter Form -->
                        <form action="">
                            <div class="row">
                                <!-- Field -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="savings_feild" class="pb-2 text-white">ফিল্ড</label>
                                    <select id="savings_feild" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <!-- Centers -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="savings_center" class="pb-2 text-white">কেন্দ্র</label>
                                    <select id="savings_center" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                                    <!-- offisers -->
                                    <div class="col-md-6 mb-3 select">
                                        <label for="savings_officer" class="pb-2 text-white">অফিসার</label>
                                        <select id="savings_officer" class="form-control form-input p-3">
                                        </select>
                                    </div>
                                <?php } ?>
                                <!-- time period -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="savings_period" class="pb-2 text-white">ক্ষেত্র</label>
                                    <select id="savings_period" class="form-control form-input p-3">
                                    </select>
                                </div>
                            </div>
                        </form>

                        <!-- Chart -->
                        <div class="main_content">
                            <!-- Chart Heading -->
                            <div class="analytics_chart_heading text-center">
                                <h2>সর্বমোট কালেকশন ৳<span id="deposit"></span>/- এবং উত্তোলন ৳<span id="withdrawal"></span>/-</h2>
                            </div>
                            <!-- Analytics Chart -->
                            <div class="analytics_chart">
                                <canvas id="savings_chart"></canvas>
                            </div>
                            <!-- analytics Table -->
                            <div class="table mt-5">
                                <table id="Savings_collection_table" class="table display responsive nowrap table-bordered table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>তারিখ</th>
                                            <th>নাম</th>
                                            <th>বই নং</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>সঞ্চয়</th>
                                            <th>উত্তোলন</th>
                                            <th>অফিসার</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="loan" role="tabpanel" aria-labelledby="loan-tab">
                    <div class="loan">
                        <!-- Savings Filter Form -->
                        <form action="">
                            <div class="row">
                                <!-- Field -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="loan_feild" class="pb-2 text-white">ফিল্ড</label>
                                    <select id="loan_feild" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <!-- Centers -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="loan_center" class="pb-2 text-white">কেন্দ্র</label>
                                    <select id="loan_center" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                                    <!-- offisers -->
                                    <div class="col-md-6 mb-3 select">
                                        <label for="loan_officer" class="pb-2 text-white">অফিসার</label>
                                        <select id="loan_officer" class="form-control form-input p-3">
                                        </select>
                                    </div>
                                <?php } ?>
                                <!-- time period -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="loan_period" class="pb-2 text-white">ক্ষেত্র</label>
                                    <select id="loan_period" class="form-control form-input p-3">
                                    </select>
                                </div>
                            </div>
                        </form>

                        <!-- Chart -->
                        <div class="main_content">
                            <!-- Chart Heading -->
                            <div class="analytics_chart_heading text-center">
                                <h2>সর্বমোট ঋণ আদায় ৳<span id="loanRec"></span>/-, সঞ্চয় আদায় ৳<span id="depositRec"></span>/- <br> লাভ আদায় ৳<span id="interestRec"></span>/- এবং সঞ্চয় উত্তোলন ৳<span id="depositWithdrawal"></span>/-</h2>
                            </div>
                            <!-- Analytics Chart -->
                            <div class="analytics_chart">
                                <canvas id="loan_chart"></canvas>
                            </div>
                            <!-- analytics Table -->
                            <div class="table mt-5" id="loanTable" style="display: none;">
                                <table id="loan_collection_table" class="table display responsive nowrap table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>তারিখ</th>
                                            <th>নাম</th>
                                            <th>বই নং</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>ঋণ সঞ্চয়</th>
                                            <th>ঋণ</th>
                                            <th>ঋণ লাভ</th>
                                            <th>সর্বমোট</th>
                                            <th>সঞ্চয় উত্তোলন</th>
                                            <th>অফিসার</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="client-add-remove" role="tabpanel" aria-labelledby="client-add-remove-tab">
                    <div class="client">
                        <!-- Savings Filter Form -->
                        <form action="">
                            <div class="row">
                                <!-- Field -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="addClose_feild" class="pb-2 text-white">ফিল্ড</label>
                                    <select id="addClose_feild" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <!-- Centers -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="addClose_center" class="pb-2 text-white">কেন্দ্র</label>
                                    <select id="addClose_center" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                                    <!-- offisers -->
                                    <div class="col-md-6 mb-3 select">
                                        <label for="addClose_officer" class="pb-2 text-white">অফিসার</label>
                                        <select id="addClose_officer" class="form-control form-input p-3">
                                        </select>
                                    </div>
                                <?php } ?>
                                <!-- time period -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="addClose_period" class="pb-2 text-white">ক্ষেত্র</label>
                                    <select id="addClose_period" class="form-control form-input p-3">
                                    </select>
                                </div>
                            </div>
                        </form>

                        <!-- Chart -->
                        <div class="main_content">
                            <!-- Chart Heading -->
                            <div class="analytics_chart_heading text-center">
                                <h2>সদস্য ভর্তি <span id="newSaings"></span> জন এবং ক্লোজিং <span id="closeSavings"></span> জন</h2>
                            </div>
                            <!-- Analytics Chart -->
                            <div class="analytics_chart">
                                <canvas id="client_chart"></canvas>
                            </div>
                            <!-- analytics Table -->
                            <div class="table mt-5" id="savingsRegTable" style="display: none;">
                                <table id="newSavingsCloseSavings_table" class="table table-bordered display responsive nowrap table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>তারিখ</th>
                                            <th>নাম</th>
                                            <th>বই নং</th>
                                            <th>টাইপ</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>সঞ্চয়</th>
                                            <th>লাভ (%)</th>
                                            <th>অফিসার</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="loan-add-close" role="tabpanel" aria-labelledby="loan-add-close-tab">
                    <div class="loan_reg">
                        <!-- Savings Filter Form -->
                        <form action="">
                            <div class="row">
                                <!-- Field -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="loanAddClose_feild" class="pb-2 text-white">ফিল্ড</label>
                                    <select id="loanAddClose_feild" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <!-- Centers -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="loanAddClose_center" class="pb-2 text-white">কেন্দ্র</label>
                                    <select id="loanAddClose_center" class="form-control form-input p-3">
                                    </select>
                                </div>
                                <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                                    <!-- offisers -->
                                    <div class="col-md-6 mb-3 select">
                                        <label for="loanAddClose_officer" class="pb-2 text-white">অফিসার</label>
                                        <select id="loanAddClose_officer" class="form-control form-input p-3">
                                        </select>
                                    </div>
                                <?php } ?>
                                <!-- time period -->
                                <div class="col-md-6 mb-3 select">
                                    <label for="loanAddClose_period" class="pb-2 text-white">ক্ষেত্র</label>
                                    <select id="loanAddClose_period" class="form-control form-input p-3">
                                    </select>
                                </div>
                            </div>
                        </form>

                        <!-- Chart -->
                        <div class="main_content">
                            <!-- Chart Heading -->
                            <div class="analytics_chart_heading text-center">
                                <h2>ঋণ নিবন্ধন <span id="newLoan"></span> জন এবং ক্লোজিং <span id="closeLoan"></span> জন</h2>
                            </div>
                            <!-- Analytics Chart -->
                            <div class="analytics_chart">
                                <canvas id="loan_reg_chart"></canvas>
                            </div>
                            <!-- analytics Table -->
                            <div class="table mt-5" id="loanRegTable" style="display: none;">
                                <table id="newLoanCloseLoan_table" class="table table-bordered display responsive nowrap table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>তারিখ</th>
                                            <th>নাম</th>
                                            <th>বই নং</th>
                                            <th>টাইপ</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>ঋণ</th>
                                            <th>লাভ (%)</th>
                                            <th>লাভ (টাকা)</th>
                                            <th>অফিসার</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                    <div class="tab-pane fade" id="expance" role="tabpanel" aria-labelledby="expance-tab">
                        <div class="expance">
                            <!-- Savings Filter Form -->
                            <form action="">
                                <div class="row">
                                    <div class="period_tabs mb-3">
                                        <div class="form-check d-inline-block">
                                            <input class="form-check-input" checked hidden type="radio" name="expance" id="allexpance" value="all">
                                            <label class="form-check-label" for="allexpance">
                                                সকল খরচ
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input class="form-check-input" hidden type="radio" name="expance" id="daily_expance" value="1">
                                            <label class="form-check-label" for="daily_expance">
                                                দৈনিক খরচ
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input class="form-check-input" hidden type="radio" name="expance" id="salery_expance" value="3">
                                            <label class="form-check-label" for="salery_expance">
                                                বেতন
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input class="form-check-input" hidden type="radio" name="expance" id="fdr_expance" value="2">
                                            <label class="form-check-label" for="fdr_expance">
                                                এফ.ডি.আর লাভ
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input class="form-check-input" hidden type="radio" name="expance" id="accClosing_expance" value="4">
                                            <label class="form-check-label" for="accClosing_expance">
                                                বই ক্লোজিং লাভ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Chart -->
                            <div class="main_content">
                                <!-- Chart Heading -->
                                <div class="analytics_chart_heading text-center">
                                    <h2>দৈনিক খরচ ৳<span id="dailyExpence"></span>/- এফ.ডি.আর ৳<span id="fdrExpence"></span>/- বেতন ৳<span id="salaryExpence"></span>/- বই ক্লোজিং লাভ ৳<span id="closingInterestExpence"></span>/-</h2>
                                </div>
                                <!-- Analytics Chart -->
                                <div class="analytics_chart">
                                    <canvas id="expance_chart"></canvas>
                                </div>
                                <!-- analytics Table -->
                                <div class="table mt-5" id="expenceTable" style="display: none;">
                                    <table id="expence_table" class="table table-bordered display responsive nowrap table-hover table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>তারিখ</th>
                                                <th>মন্তব্য</th>
                                                <th>টাইপ</th>
                                                <th>ব্যয়</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab">
                        <!-- Chart -->
                        <div class="main_content">
                            <!-- Chart Heading -->
                            <div class="analytics_chart_heading text-center">
                                <h2>সর্বমোট আয় ৳<span id="total_income"></span>/-</h2>
                            </div>
                            <!-- Analytics Chart -->
                            <div class="analytics_chart">
                                <canvas id="income_chart"></canvas>
                            </div>
                            <!-- analytics Table -->
                            <div class="table mt-5" id="incomeTable" style="display: none;">
                                <table id="income_table" class="table table-bordered display responsive nowrap table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>তারিখ</th>
                                            <th>মন্তব্য</th>
                                            <th>আয়</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="score" role="tabpanel" aria-labelledby="score-tab">
                        <div class="score">

                            <!-- Chart -->
                            <div class="main_content">
                                <!-- Chart Heading -->
                                <div class="analytics_chart_heading text-center">
                                    <h2>সর্বমোট <br> (আয় ৳<span id="incomeCal"></span>/- + লাভ ৳<span id="interest"></span>/-) - খরচ ৳<span id="expence"></span>/- = ফলাফল ৳<span id="result"></span>/-</h2>
                                </div>
                                <!-- Analytics Chart -->
                                <div class="analytics_chart">
                                    <canvas id="score_chart"></canvas>
                                </div>
                                <!-- analytics Table -->
                                <div class="table mt-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="audit_table p-3">
                                                <div class="audit_heading  text-center my-3">
                                                    <h3 class="fw-bolder">খরচ</h3>
                                                </div>
                                                <div class="audit_savings_table">
                                                    <table class="table table-responsive table-striped" id="expenceCalculationAnalyticsTable">
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="audit_table p-3">
                                                <div class="audit_heading  text-center my-3">
                                                    <h3 class="fw-bolder">আয়</h3>
                                                </div>
                                                <div class="audit_savings_table">
                                                    <table class="table table-responsive table-striped" id="incomeCalculationAnalyticsTable">
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="audit_table p-3">
                                                <div class="audit_heading  text-center my-3">
                                                    <h3 class="fw-bolder">ঋণ লাভ আদায়</h3>
                                                </div>
                                                <div class="audit_savings_table">
                                                    <table class="table table-responsive table-striped" id="interestCalculationAnalyticsTable">
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="audit_table p-3">
                                                <div class="audit_heading  text-center my-3">
                                                    <h3 class="fw-bolder">সর্বশেষ হিসাব</h3>
                                                </div>
                                                <div class="audit_savings_table">
                                                    <table class="table table-responsive table-striped" id="finalCalculationAnalyticsTable">
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php
include "include/footer.php";
?>

<script>
    $(document).ready(function() {
        var loanAnalytics_field = $("#loan_feild");
        var loanAnalytics_officer = $("#loan_officer");
        var loanAnalytics_period = $("#loan_period");
        loadField(loanAnalytics_field);
        loadOfficer(loanAnalytics_officer);
        loadPeriod(loanAnalytics_period, "%2%");
        loanAnalytics_field.on('change', function() {
            var field = $(this).val();
            var center = $("#loan_center");
            loadCenter(field, center);
        });

        var savings_field = $("#savings_feild");
        var savings_officer = $("#savings_officer");
        var savings_period = $("#savings_period");
        loadField(savings_field);
        loadOfficer(savings_officer);
        loadPeriod(savings_period, "%1%");
        savings_field.on('change', function() {
            var field = $(this).val();
            var center = $("#savings_center");
            loadCenter(field, center);
        });

        var addClose_field = $("#addClose_feild");
        var addClose_officer = $("#addClose_officer");
        var addClose_period = $("#addClose_period");
        loadField(addClose_field);
        loadOfficer(addClose_officer);
        loadPeriod(addClose_period, "%1%");
        addClose_field.on('change', function() {
            var field = $(this).val();
            var center = $("#addClose_center");
            loadCenter(field, center);
        });

        var loanAddClose_field = $("#loanAddClose_feild");
        var loanAddClose_officer = $("#loanAddClose_officer");
        var loanAddClose_period = $("#loanAddClose_period");
        loadField(loanAddClose_field);
        loadOfficer(loanAddClose_officer);
        loadPeriod(loanAddClose_period, "%2%");
        loanAddClose_field.on('change', function() {
            var field = $(this).val();
            var center = $("#loanAddClose_center");
            loadCenter(field, center);
        });

        function loadField(field) {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    fields: '1'
                },
                success: function(data) {
                    field.html("");
                    field.html(data);
                    // alert(data);
                }
            })
        }

        function loadCenter(field, center) {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    field: field
                },
                success: function(data) {
                    center.html("");
                    center.html(data);
                }
            })
        }

        function loadPeriod(period, type) {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    period: type
                },
                success: function(data) {
                    period.html("");
                    period.html(data);
                }
            })
        }

        function loadOfficer(officer) {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    officer: '1'
                },
                success: function(data) {
                    officer.html("");
                    officer.html(data);
                }
            })
        }

        window.addEventListener('load', function() {
            var dates = document.getElementById('date_range').innerText;
            var range = dates.split("-");
            var from_date = range[0];
            var end_date = range[1];

            let spanText = document.querySelector('#reportrange span')
            spanText.addEventListener('DOMSubtreeModified', function() {
                dates = document.querySelector('#reportrange span').innerText;
                range = dates.split("-");
                from_date = range[0];
                end_date = range[1];
                if (dates != "") {
                    income_table_load();
                    expence_table();
                    newLoanCloseLoan_table();
                    newSavingsCloseSavings_table();
                    loan_collection_table();
                    Savings_collection_table();
                    account_calculation_table()
                }
            })
            var income_chart_config = '';
            var expance_chart_config = '';
            var loan_reg_chart_config = '';
            var client_chart_config = '';
            var loan_chart_config = '';
            var savings_chart_config = '';
            var score_chart_config = '';

            var types = 'all';
            $("input[name = expance]").on("change", function() {
                types = $(this).val();
                expence_table();
            })

            function income_table_load() {
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        total_income: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    success: function(data) {
                        if (data != false) {
                            $("#total_income").text("");
                            $("#total_income").text(data);
                        } else {
                            $("#total_income").text("");
                            $("#total_income").text('0');

                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        income: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // income Chart
                        var income_data_table = data;
                        var income_chart = document.getElementById('income_chart').getContext('2d');

                        if (income_chart_config != '') {
                            income_chart_config.destroy();
                        }
                        income_chart_config = new Chart(income_chart, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'আয় ৳',
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    color: '#fff',
                                    data: income_data_table,
                                    parsing: {
                                        yAxisKey: 'income',
                                    }
                                }]
                            },
                            options: {
                                parsing: {
                                    xAxisKey: 'date',
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: '#fff'
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "তারিখ সমুহ",
                                            color: '#fff',
                                            padding: {
                                                top: 20
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "টাকা",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        });
                    }
                })

                $('#income_table').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    // "retrieve": true,
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 0
                        },
                        {
                            responsivePriority: 2,
                            targets: 1
                        }
                    ],
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/incomeSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            from_date: from_date,
                            end_date: end_date,
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            function expence_table() {
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        total_expence: 1,
                        type: types,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $.each(data, function(key, value) {
                                if (value.type == 1) {
                                    $("#dailyExpence").text("");
                                    $("#dailyExpence").text(value.expence);
                                } else if (value.type == 2) {
                                    $("#fdrExpence").text("");
                                    $("#fdrExpence").text(value.expence);
                                } else if (value.type == 3) {
                                    $("#salaryExpence").text("");
                                    $("#salaryExpence").text(value.expence);
                                } else if (value.type == 4) {
                                    $("#closingInterestExpence").text("");
                                    $("#closingInterestExpence").text(value.expence);
                                }
                            })
                        } else {
                            $("#dailyExpence").text("");
                            $("#dailyExpence").text('0');
                            $("#fdrExpence").text("");
                            $("#fdrExpence").text('0');
                            $("#salaryExpence").text("");
                            $("#salaryExpence").text('0');
                            $("#closingInterestExpence").text("");
                            $("#closingInterestExpence").text('0');

                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        expanceChart: 1,
                        type: types,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        // expance Chart
                        var expance_data_table = data;
                        const expance_chart = document.getElementById('expance_chart').getContext('2d');

                        if (expance_chart_config != '') {
                            expance_chart_config.destroy();
                        }

                        expance_chart_config = new Chart(expance_chart, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'দৈনিক খরচ ৳',
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    color: '#fff',
                                    data: expance_data_table,
                                    parsing: {
                                        yAxisKey: 'daily_expence',
                                    }
                                }, {
                                    label: 'বেতন ৳',
                                    backgroundColor: [
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    color: '#fff',
                                    data: expance_data_table,
                                    parsing: {
                                        yAxisKey: 'salery_expence',
                                    }
                                }, {
                                    label: 'এফ.ডি.আর লাভ ৳',
                                    backgroundColor: [
                                        'rgba(155, 169, 64, 1)'
                                    ],
                                    borderColor: 'rgba(155, 169, 64, 1)',
                                    color: '#fff',
                                    data: expance_data_table,
                                    parsing: {
                                        yAxisKey: 'fdr_expence',
                                    }
                                }, {
                                    label: 'বই ক্লোজিং লাভ ৳',
                                    backgroundColor: [
                                        'rgba(255, 205, 86, 1)'
                                    ],
                                    borderColor: 'rgba(255, 205, 86, 1)',
                                    color: '#fff',
                                    data: expance_data_table,
                                    parsing: {
                                        yAxisKey: 'closing_expence',
                                    }
                                }]
                            },
                            options: {
                                parsing: {
                                    xAxisKey: 'date',
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: '#fff'
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "তারিখ সমুহ",
                                            color: '#fff',
                                            padding: {
                                                top: 20
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "টাকা",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        });
                    }
                })

                $('#expence_table').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 0
                        },
                        {
                            responsivePriority: 2,
                            targets: 1
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/expence_analysisListAuthenticate.php",
                        type: "POST",
                        data: {
                            type: types,
                            from_date: from_date,
                            end_date: end_date,
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            var loanFiled = null;
            var loanCenter = null;
            var loanPeriod = null;
            if ('<?= $_SESSION['auth']['user_role'] ?>' == false) {
                var loanOfficer = null;
            } else {
                var loanOfficer = <?= $_SESSION['auth']['user_id'] ?>;
            }

            loanAddClose_field.on('change', function() {
                loanFiled = loanAddClose_field.val();
                newLoanCloseLoan_table();
            });
            loanAddClose_officer.on('change', function() {
                loanOfficer = loanAddClose_officer.val();
                newLoanCloseLoan_table();
            });
            $("#loanAddClose_center").on('change', function() {
                loanCenter = $(this).val();
                newLoanCloseLoan_table();
            });
            loanAddClose_period.on('change', function() {
                loanPeriod = loanAddClose_period.val();
                newLoanCloseLoan_table();
            });


            function newLoanCloseLoan_table() {
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        newLoanCloseLoan: 1,
                        field: loanFiled,
                        center: loanCenter,
                        period: loanPeriod,
                        officer: loanOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $.each(data, function(key, value) {
                                $("#newLoan").text("");
                                $("#newLoan").text(value.loanGiving);
                                $("#closeLoan").text("");
                                $("#closeLoan").text(value.loanClose);

                            })
                        } else {
                            $("#newLoan").text("");
                            $("#newLoan").text('0');
                            $("#closeLoan").text("");
                            $("#closeLoan").text('0');

                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        newLoanCloseLoanChart: 1,
                        field: loanFiled,
                        center: loanCenter,
                        period: loanPeriod,
                        officer: loanOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        // loan Registration ANd Close Chart
                        var loan_reg_data_table = data;
                        const loan_reg_chart = document.getElementById('loan_reg_chart').getContext('2d');

                        if (loan_reg_chart_config != '') {
                            loan_reg_chart_config.destroy();
                        }

                        loan_reg_chart_config = new Chart(loan_reg_chart, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'ঋণ নিবন্ধন',
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    color: '#fff',
                                    data: loan_reg_data_table,
                                    parsing: {
                                        yAxisKey: 'loanGiving',
                                    }
                                }, {
                                    label: 'ঋণ ক্লোজ',
                                    backgroundColor: [
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    color: '#fff',
                                    data: loan_reg_data_table,
                                    parsing: {
                                        yAxisKey: 'loanClose',
                                    }
                                }]
                            },
                            options: {
                                parsing: {
                                    xAxisKey: 'date',
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: '#fff'
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "তারিখ সমুহ",
                                            color: '#fff',
                                            padding: {
                                                top: 20
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "টাকা",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        });

                    }
                })

                $('#newLoanCloseLoan_table').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 3
                        },
                        {
                            responsivePriority: 4,
                            targets: 4
                        },
                        {
                            responsivePriority: 5,
                            targets: 8
                        },
                        {
                            responsivePriority: 6,
                            targets: 9
                        },
                        {
                            responsivePriority: 7,
                            targets: 10
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/loanRegLoanCloseAnlyticsAuthentication.php",
                        type: "POST",
                        data: {
                            field: loanFiled,
                            center: loanCenter,
                            period: loanPeriod,
                            officer: loanOfficer,
                            from_date: from_date,
                            end_date: end_date
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            var addCloseSavingsFiled = null;
            var addCloseSavingsCenter = null;
            var addCloseSavingsPeriod = null;
            if ('<?= $_SESSION['auth']['user_role'] ?>' == false) {
                var addCloseSavingsOfficer = null;
            } else {
                var addCloseSavingsOfficer = <?= $_SESSION['auth']['user_id'] ?>;
            }

            addClose_field.on('change', function() {
                addCloseSavingsFiled = addClose_field.val();
                newSavingsCloseSavings_table();
            });
            addClose_officer.on('change', function() {
                addCloseSavingsOfficer = addClose_officer.val();
                newSavingsCloseSavings_table();
            });
            $("#addClose_center").on('change', function() {
                addCloseSavingsCenter = $(this).val();
                newSavingsCloseSavings_table();
            });
            addClose_period.on('change', function() {
                addCloseSavingsPeriod = addClose_period.val();
                newSavingsCloseSavings_table();
            });

            function newSavingsCloseSavings_table() {
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        addCloseSavings: 1,
                        field: addCloseSavingsFiled,
                        center: addCloseSavingsCenter,
                        period: addCloseSavingsPeriod,
                        officer: addCloseSavingsOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $.each(data, function(key, value) {
                                $("#newSaings").text("");
                                $("#newSaings").text(value.newSavings);
                                $("#closeSavings").text("");
                                $("#closeSavings").text(value.closeSavings);

                            })
                        } else {
                            $("#newSaings").text("");
                            $("#newSaings").text('0');
                            $("#closeSavings").text("");
                            $("#closeSavings").text('0');

                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        addCloseSavingsChart: 1,
                        field: addCloseSavingsFiled,
                        center: addCloseSavingsCenter,
                        period: addCloseSavingsPeriod,
                        officer: addCloseSavingsOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        // Savings Registration ANd Close Chart
                        var client_data_table = data;

                        if (client_chart_config != '') {
                            client_chart_config.destroy();
                        }

                        const client_chart = document.getElementById('client_chart').getContext('2d');
                        client_chart_config = new Chart(client_chart, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'সদস্য ভর্তি',
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    color: '#fff',
                                    data: client_data_table,
                                    parsing: {
                                        yAxisKey: 'newSavings',
                                    }
                                }, {
                                    label: 'সদস্য ক্লোজ',
                                    backgroundColor: [
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    color: '#fff',
                                    data: client_data_table,
                                    parsing: {
                                        yAxisKey: 'closeSavings',
                                    }
                                }]
                            },
                            options: {
                                parsing: {
                                    xAxisKey: 'date',
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: '#fff'
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "তারিখ সমুহ",
                                            color: '#fff',
                                            padding: {
                                                top: 20
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "টাকা",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        });
                    }
                })

                $('#newSavingsCloseSavings_table').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 3
                        },
                        {
                            responsivePriority: 4,
                            targets: 4
                        },
                        {
                            responsivePriority: 5,
                            targets: 8
                        },
                        {
                            responsivePriority: 6,
                            targets: 9
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/savingsAddCloseAnlyticsAuthentication.php",
                        type: "POST",
                        data: {
                            field: addCloseSavingsFiled,
                            center: addCloseSavingsCenter,
                            period: addCloseSavingsPeriod,
                            officer: addCloseSavingsOfficer,
                            from_date: from_date,
                            end_date: end_date
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            var loanCollection_field = null;
            var loanCollectionCenter = null;
            var loanCollectionPeriod = null;
            if ('<?= $_SESSION['auth']['user_role'] ?>' == false) {
                var loanCollectionOfficer = null;
            } else {
                var loanCollectionOfficer = <?= $_SESSION['auth']['user_id'] ?>;
            }

            loanAnalytics_field.on('change', function() {
                loanCollection_field = loanAnalytics_field.val();
                loan_collection_table();
            });
            loanAnalytics_officer.on('change', function() {
                loanCollectionOfficer = loanAnalytics_officer.val();
                loan_collection_table();
            });
            $("#loan_center").on('change', function() {
                loanCollectionCenter = $(this).val();
                loan_collection_table();
            });
            loanAnalytics_period.on('change', function() {
                loanCollectionPeriod = loanAnalytics_period.val();
                loan_collection_table();
            });

            function loan_collection_table() {
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        loanAnalytics: 1,
                        field: loanCollection_field,
                        center: loanCollectionCenter,
                        period: loanCollectionPeriod,
                        officer: loanCollectionOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $.each(data, function(key, value) {
                                $("#loanRec").text("");
                                $("#loanRec").text(value.loanRec);
                                $("#depositRec").text("");
                                $("#depositRec").text(value.depositRec);
                                $("#interestRec").text("");
                                $("#interestRec").text(value.interestRec);
                                $("#depositWithdrawal").text("");
                                $("#depositWithdrawal").text(value.depositWithdrawal);

                            })
                        } else {
                            $("#loanRec").text("");
                            $("#loanRec").text('0');
                            $("#depositRec").text("");
                            $("#depositRec").text('0');
                            $("#interestRec").text("");
                            $("#interestRec").text('0');
                            $("#depositWithdrawal").text("");
                            $("#depositWithdrawal").text('0');

                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        loanAnlyticsChart: 1,
                        field: loanCollection_field,
                        center: loanCollectionCenter,
                        period: loanCollectionPeriod,
                        officer: loanCollectionOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);

                        // Loan Chart
                        var loan_data_table = data;
                        const loan_chart = document.getElementById('loan_chart').getContext('2d');
                        if (loan_chart_config != '') {
                            loan_chart_config.destroy();
                        }
                        loan_chart_config = new Chart(loan_chart, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'ঋণ আদায় ৳',
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    color: '#fff',
                                    data: loan_data_table,
                                    parsing: {
                                        yAxisKey: 'loanRec',
                                    }
                                }, {
                                    label: 'সঞ্চয় আদায় ৳',
                                    backgroundColor: [
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    color: '#fff',
                                    data: loan_data_table,
                                    parsing: {
                                        yAxisKey: 'depositRec',
                                    }
                                }, {
                                    label: 'লাভ আদায় ৳',
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 1)',

                                    ],
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    color: '#fff',
                                    data: loan_data_table,
                                    parsing: {
                                        yAxisKey: 'interestRec',
                                    }
                                }, {
                                    label: 'সঞ্চয় উত্তোলন ৳',
                                    backgroundColor: [
                                        'red'
                                    ],
                                    borderColor: 'red',
                                    color: '#fff',
                                    data: loan_data_table,
                                    parsing: {
                                        yAxisKey: 'depositWithdrawal',
                                    }
                                }]
                            },
                            options: {
                                parsing: {
                                    xAxisKey: 'date',
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: '#fff'
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "তারিখ সমুহ",
                                            color: '#fff',
                                            padding: {
                                                top: 20
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "টাকা",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        });
                    }
                })

                $('#loan_collection_table').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 3
                        },
                        {
                            responsivePriority: 4,
                            targets: 7
                        },
                        {
                            responsivePriority: 5,
                            targets: 8
                        },
                        {
                            responsivePriority: 6,
                            targets: 9
                        },
                        {
                            responsivePriority: 7,
                            targets: 10
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/loanAnlyticsAuthentication.php",
                        type: "POST",
                        data: {
                            field: loanCollection_field,
                            center: loanCollectionCenter,
                            period: loanCollectionPeriod,
                            officer: loanCollectionOfficer,
                            from_date: from_date,
                            end_date: end_date
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            var savingsCollection_field = null;
            var savingsCollectionCenter = null;
            var savingsCollectionPeriod = null;
            if ('<?= $_SESSION['auth']['user_role'] ?>' == false) {
                var savingsCollectionOfficer = null;
            } else {
                var savingsCollectionOfficer = <?= $_SESSION['auth']['user_id'] ?>;
            }

            savings_field.on('change', function() {
                savingsCollection_field = savings_field.val();
                Savings_collection_table();
            });
            savings_officer.on('change', function() {
                savingsCollectionOfficer = savings_officer.val();
                Savings_collection_table();
            });
            $("#savings_center").on('change', function() {
                savingsCollectionCenter = $(this).val();
                Savings_collection_table();
            });
            savings_period.on('change', function() {
                savingsCollectionPeriod = savings_period.val();
                Savings_collection_table();
            });

            function Savings_collection_table() {
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        savingsAnalytics: 1,
                        field: savingsCollection_field,
                        center: savingsCollectionCenter,
                        period: savingsCollectionPeriod,
                        officer: savingsCollectionOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $.each(data, function(key, value) {
                                $("#deposit").text("");
                                $("#deposit").text(value.deposit);
                                $("#withdrawal").text("");
                                $("#withdrawal").text(value.withdrawal);

                            })
                        } else {
                            $("#deposit").text("");
                            $("#deposit").text('0');
                            $("#withdrawal").text("");
                            $("#withdrawal").text('0');

                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        savingsAnalyticsChart: 1,
                        field: savingsCollection_field,
                        center: savingsCollectionCenter,
                        period: savingsCollectionPeriod,
                        officer: savingsCollectionOfficer,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // Savings Charts
                        var savings_data_table = data;
                        const savings_chart = document.getElementById('savings_chart').getContext('2d');

                        if (savings_chart_config != '') {
                            savings_chart_config.destroy();
                        }

                        savings_chart_config = new Chart(savings_chart, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'আদায় ৳',
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(201, 203, 207, 1)',
                                        'rgba(255, 205, 86, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',

                                    ],
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    color: '#fff',
                                    data: savings_data_table,
                                    parsing: {
                                        yAxisKey: 'deposit',
                                    }
                                }, {
                                    label: 'উত্তোলন ৳',
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(201, 203, 207, 1)',
                                        'rgba(255, 205, 86, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',

                                    ],
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    color: '#fff',
                                    data: savings_data_table,
                                    parsing: {
                                        yAxisKey: 'withdrawal',
                                    }
                                }]
                            },
                            options: {
                                parsing: {
                                    xAxisKey: 'date',
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: '#fff'
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "তারিখ সমুহ",
                                            color: '#fff',
                                            padding: {
                                                top: 20
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "টাকা",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        });
                    }
                })

                $('#Savings_collection_table').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 3
                        },
                        {
                            responsivePriority: 4,
                            targets: 7
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/savingsAnlyticsAuthentication.php",
                        type: "POST",
                        data: {
                            field: savingsCollection_field,
                            center: savingsCollectionCenter,
                            period: savingsCollectionPeriod,
                            officer: savingsCollectionOfficer,
                            from_date: from_date,
                            end_date: end_date
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }
            // Savings_collection_table();

            function account_calculation_table() {
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        accountCalculationAnalytics: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $.each(data, function(key, value) {
                                $("#incomeCal").text("");
                                $("#incomeCal").text(value.income);
                                $("#interest").text("");
                                $("#interest").text(value.interest);
                                $("#expence").text("");
                                $("#expence").text(value.expence);
                                $("#result").text("");
                                $("#result").text(value.result);

                            })
                        } else {
                            $("#incomeCal").text("");
                            $("#incomeCal").text('0');
                            $("#interest").text("");
                            $("#interest").text('0');
                            $("#expence").text("");
                            $("#expence").text('0');
                            $("#result").text("");
                            $("#result").text('0');

                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        accountCalculationAnalyticsChart: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);

                        var score_data_table = data;
                        const score_chart = document.getElementById('score_chart').getContext('2d');
                        if (score_chart_config != '') {
                            score_chart_config.destroy();
                        }

                        score_chart_config = new Chart(score_chart, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'খরচ ৳',
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    color: '#fff',
                                    data: score_data_table,
                                    parsing: {
                                        yAxisKey: 'expence',
                                    }
                                }, {
                                    label: 'আয় ৳',
                                    backgroundColor: [
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    color: '#fff',
                                    data: score_data_table,
                                    parsing: {
                                        yAxisKey: 'income',
                                    }
                                }, {
                                    label: 'লাভ ৳',
                                    backgroundColor: [
                                        'rgba(155, 169, 64, 1)'
                                    ],
                                    borderColor: 'rgba(155, 169, 64, 1)',
                                    color: '#fff',
                                    data: score_data_table,
                                    parsing: {
                                        yAxisKey: 'interest',
                                    }
                                }, {
                                    label: 'ফলাফল ৳',
                                    backgroundColor: [
                                        'rgba(205, 50, 604, 1)'
                                    ],
                                    borderColor: 'rgba(205, 50, 604, 1)',
                                    color: '#fff',
                                    data: score_data_table,
                                    parsing: {
                                        yAxisKey: 'result',
                                    }
                                }]
                            },
                            options: {
                                parsing: {
                                    xAxisKey: 'date',
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: '#fff'
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "তারিখ সমুহ",
                                            color: '#fff',
                                            padding: {
                                                top: 20
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#fff'
                                        },
                                        title: {
                                            display: true,
                                            text: "টাকা",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        });
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        expenceCalculationAnalytics: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $("#expenceCalculationAnalyticsTable").html("");
                            $("#expenceCalculationAnalyticsTable").html(data);
                        } else {
                            $("#expenceCalculationAnalyticsTable").html("");
                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        incomeCalculationAnalytics: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $("#incomeCalculationAnalyticsTable").html("");
                            $("#incomeCalculationAnalyticsTable").html(data);
                        } else {
                            $("#incomeCalculationAnalyticsTable").html("");
                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        interestCalculationAnalytics: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $("#interestCalculationAnalyticsTable").html("");
                            $("#interestCalculationAnalyticsTable").html(data);
                        } else {
                            $("#interestCalculationAnalyticsTable").html("");
                        }
                    }
                })

                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        finalCalculationAnalytics: 1,
                        from_date: from_date,
                        end_date: end_date
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            $("#finalCalculationAnalyticsTable").html("");
                            $("#finalCalculationAnalyticsTable").html(data);
                        } else {
                            $("#finalCalculationAnalyticsTable").html("");
                        }
                    }
                })

            }

            Savings_collection_table();
            $("#loan-tab").on("click", function() {
                $("#loanTable").css("display", "block");
                setTimeout(function() {
                    loan_collection_table();
                }, 1000)
            })
            $("#client-add-remove-tab").on("click", function() {
                $("#savingsRegTable").css("display", "block");
                setTimeout(function() {
                    newSavingsCloseSavings_table();
                }, 1000)
            })
            $("#loan-add-close-tab").on("click", function() {
                $("#loanRegTable").css("display", "block");
                setTimeout(function() {
                    newLoanCloseLoan_table();
                }, 1000)
            })
            $("#expance-tab").on("click", function() {
                $("#expenceTable").css("display", "block");
                setTimeout(function() {
                    expence_table();
                }, 1000)
            })
            $("#income-tab").on("click", function() {
                $("#incomeTable").css("display", "block");
                setTimeout(function() {
                    income_table_load();
                }, 1000)
            })
            $("#score-tab").on("click", function() {
                setTimeout(function() {
                    account_calculation_table();
                }, 1000)
            })
        })
    })
</script>
</body>

</html>