<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($bookCheck == 0) {
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
                <li class="breadcrumb-item active" aria-current="page">বই চেকিং</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Client Filter Form -->
<div class="book_checking_table">
    <div class="container-fluid">

        <!-- Book Checking tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="savings-tab" data-bs-toggle="tab" href="#savings" role="tab" aria-controls="savings" aria-selected="true">সঞ্চয় বই</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="loan-tab" data-bs-toggle="tab" href="#loan" role="tab" aria-controls="loan" aria-selected="false">ঋণ বই</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="savings" role="tabpanel" aria-labelledby="savings-tab">
                <!-- table Data -->
                <div class="table m-0">
                    <div id="savings_table" class="recent_collection">
                        <table id="savingsCheckAcc" class="table display responsive nowrap table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম</th>
                                    <th>বই নং</th>
                                    <th>ফিল্ড</th>
                                    <th>কেন্দ্র</th>
                                    <th>ক্ষেত্র</th>
                                    <th>ব্যালেন্স</th>
                                    <th>চেকিং তারিখ</th>
                                    <th>পরবর্তি চেকিং</th>
                                    <th>একাউন্ট দেখুন</th>
                                    <?php if (!$_SESSION['auth']['user_role']) { ?>
                                        <th>একশন</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="loan" role="tabpanel" aria-labelledby="loan-tab">
                <!-- table Data -->
                <div class="table m-0">
                    <div id="loan_table" class="recent_collection" style="display: none;">
                        <table id="loan_checking_account" class="table display responsive nowrap table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম</th>
                                    <th>বই নং</th>
                                    <th>ফিল্ড</th>
                                    <th>কেন্দ্র</th>
                                    <th>ক্ষেত্র</th>
                                    <th>সঞ্চয় আদায়</th>
                                    <th>ঋণ আদায়</th>
                                    <th>ঋণ বাকি</th>
                                    <th>চেকিং তারিখ</th>
                                    <th>পরবর্তি চেকিং</th>
                                    <th>একাউন্ট দেখুন</th>
                                    <?php if (!$_SESSION['auth']['user_role']) { ?>
                                        <th>একশন</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "include/footer.php";
?>
<script>
    $(document).ready(function() {

        $("#loan-tab").on("click", function() {
            $("#loan_table").css("display", "block");
            setTimeout(function() {
                loanreportLoad();
            }, 1000)
        })

        function SavingreportLoad(center = null, period = null) {
            $('#savingsCheckAcc').DataTable({
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
                        targets: 5
                    },
                    {
                        responsivePriority: 4,
                        targets: 6
                    },
                    {
                        responsivePriority: 5,
                        targets: 9
                    },
                    <?php if (!$_SESSION['auth']['user_role']) { ?> {
                            responsivePriority: 6,
                            targets: 10
                        }
                    <?php } ?>
                ],
                // "retrieve": true,
                "paging": true,
                "bDestroy": true,
                "order": [],
                "searching": true,
                "ajax": {
                    url: "codes/SavingsCheckingACCAuthenticate.php",
                    type: "POST"
                }
            });
        }
        SavingreportLoad();

        function loanreportLoad(center = null, period = null) {
            $('#loan_checking_account').DataTable({
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
                        targets: 5
                    },
                    {
                        responsivePriority: 4,
                        targets: 6
                    },
                    {
                        responsivePriority: 5,
                        targets: 7
                    },
                    {
                        responsivePriority: 6,
                        targets: 8
                    },
                    {
                        responsivePriority: 7,
                        targets: 11
                    },
                    <?php if (!$_SESSION['auth']['user_role']) { ?> {
                            responsivePriority: 8,
                            targets: 12
                        }
                    <?php } ?>
                ],
                // "retrieve": true,
                "paging": true,
                "bDestroy": true,
                "order": [],
                "searching": true,
                "ajax": {
                    url: "codes/loanCheckingACCAuthenticate.php",
                    type: "POST"
                }
            });
        }

        $(document).on("click", "input[name='savingsAction']", function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr("id");
                var checkID = $(this).attr("data-checkID");
            }

            if (id != "" && checkID != "") {
                Swal.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: "বই চেক করার পর চেকটি ফিরে পাওয়া সম্ভব নয়!",
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'চেক করুন',
                    denyButtonText: `চেক করবেন না`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "codes/clientAccCheckAthenticate.php",
                            type: "POST",
                            data: {
                                savingsCheckID: id,
                                checkID: checkID,
                            },
                            beforeSend: function() {
                                $("#overlayer").fadeIn();
                                $("#preloader").fadeIn();
                            },
                            success: function(data) {
                                $("#overlayer").fadeOut();
                                $("#preloader").fadeOut();
                                if (data == 1) {
                                    swal.fire({
                                        title: "অভিনন্দন",
                                        text: "বই চেক সম্পন্ন হয়েছে",
                                        icon: 'success',
                                    })
                                    SavingreportLoad();
                                } else {
                                    SavingreportLoad();
                                    swal.fire({
                                        title: "দুঃখিত",
                                        text: "বই চেক হয়নি। আবার চেষ্টা করুন",
                                        icon: 'error',
                                    })
                                }
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('চেকটি সুরক্ষখিত রয়েছে', '', 'info')
                        $(this).prop('checked', false);
                    }
                })
            } else {
                swal.fire({
                    title: "দুঃখিত",
                    text: "",
                    icon: 'error',
                })
            }
        })
        $(document).on("click", "input[name='loanAction']", function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr("id");
                var checkID = $(this).attr("data-checkID");
            }

            if (id != "" && checkID != "") {
                Swal.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: "বই চেক করার পর চেকটি ফিরে পাওয়া সম্ভব নয়!",
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'চেক করুন',
                    denyButtonText: `চেক করবেন না`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "codes/clientAccCheckAthenticate.php",
                            type: "POST",
                            data: {
                                loanCheckID: id,
                                checkID: checkID,
                            },
                            beforeSend: function() {
                                $("#overlayer").fadeIn();
                                $("#preloader").fadeIn();
                            },
                            success: function(data) {
                                $("#overlayer").fadeOut();
                                $("#preloader").fadeOut();
                                if (data == 1) {
                                    swal.fire({
                                        title: "অভিনন্দন",
                                        text: "বই চেক সম্পন্ন হয়েছে",
                                        icon: 'success',
                                    })
                                    loanreportLoad();
                                } else {
                                    loanreportLoad();
                                    swal.fire({
                                        title: "দুঃখিত",
                                        text: "বই চেক হয়নি। আবার চেষ্টা করুন",
                                        icon: 'error',
                                    })
                                }
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('চেকটি সুরক্ষখিত রয়েছে', '', 'info')
                        $(this).prop('checked', false);
                    }
                })
            } else {
                swal.fire({
                    title: "দুঃখিত",
                    text: "",
                    icon: 'error',
                })
            }
        })
    })
</script>
</body>

</html>