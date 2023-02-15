<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($_SESSION['auth']['user_role']) {
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
                <li class="breadcrumb-item active" aria-current="page">ঋণ খেলাপি রিপোর্ট</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Client Filter Form -->
<div class="book_checking_table">
    <div class="container-fluid">
        <!-- table Data -->
        <div class="table m-0">
            <div id="savings_table" class="recent_collection">
                <table id="loanAcc" class="table display responsive nowrap table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বই নং</th>
                            <th>ফিল্ড</th>
                            <th>কেন্দ্র</th>
                            <th>ক্ষেত্র</th>
                            <th>ব্যালেন্স</th>
                            <th>ঋণ প্রদান</th>
                            <th>ঋণ বাকি</th>
                            <th>লাভ বাকি</th>
                            <th>একাউন্ট দেখুন</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include "include/footer.php";
?>
<script>
    $(document).ready(function() {
        function SavingreportLoad(center = null, period = null) {
            let queryString = window.location.search;
            let urlParams = new URLSearchParams(queryString);
            let report = urlParams.get('report');
            let days = urlParams.get('days');

            $('#loanAcc').DataTable({
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
                        targets: 5
                    }
                ],
                // "retrieve": true,
                "paging": true,
                "bDestroy": true,
                "order": [],
                "searching": true,
                "ajax": {
                    url: "codes/khelapiloanReportAuthenticate.php",
                    type: "POST",
                    data: {
                        report_id: report,
                        report_days: days
                    }
                }
            });
        }
        SavingreportLoad();
    })
</script>
</body>

</html>