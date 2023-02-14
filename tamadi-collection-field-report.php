<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($expiredCollection == 0) {
    redirect("404");
    ob_end_flush();
}
?>
<!-- Breadcrumb -->
<div id="breadcrumb">
    <div class="container_fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= baseUrl('/') ?>">ড্যাশবোর্ড</a></li>
                <li class="breadcrumb-item active" aria-current="page">তামাদি রিপোর্ট</li>
            </ol>
        </nav>
    </div>
</div>

<div class="feild_list_report me-3">
    <div class="container-fluid">
        <div class="table">
            <div class="recent_collection">
                <div class="form_heading mt-5 mb-3">
                    <h2>সঞ্চয় রিপোর্ট <span class="date"></span></h2>
                </div>
                <table class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="border-bottom">#</th>
                            <th class="border-bottom">ফিল্ড</th>
                            <th class="border-bottom">সংগ্রহ</th>
                            <th class="border-bottom">একশন</th>
                        </tr>
                    </thead>
                    <tbody id="savings_periods">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="table">
            <div class="recent_collection">
                <div class="form_heading mt-5 mb-3">
                    <h2>ঋণ রিপোর্ট <span class="date"></span></h2>
                </div>
                <table class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="border-bottom">#</th>
                            <th class="border-bottom">ফিল্ড</th>
                            <th class="border-bottom">সঞ্চয়</th>
                            <th class="border-bottom">ঋণ</th>
                            <th class="border-bottom">লাভ</th>
                            <th class="border-bottom">মোট আদায়</th>
                            <th class="border-bottom">একশন</th>
                        </tr>
                    </thead>
                    <tbody id="loan_periods">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include "include/footer.php";
?>
<script>
    savingsLoad();

    function savingsLoad() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                tamadiFieldReport: 1
            },
            success: function(data) {
                // console.log(data);
                if (data != false) {
                    console.log(data);
                    $("#savings_periods").html(data);
                }
            }
        })
    }
    loansLoad();

    function loansLoad() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                tamadiFieldReport: 2
            },
            success: function(data) {
                // console.log(data);
                if (data != false) {
                    $("#loan_periods").html(data);
                }
            }
        })
    }
</script>
</body>

</html>