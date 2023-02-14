<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($field == 0) {
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
                <li class="breadcrumb-item"><?php
                                            if (isset($_GET["field"])) {
                                            ?>ফিল্ড<?php } elseif (isset($_GET["center"])) {
                                                    ?>কেন্দ্র<?php } elseif (isset($_GET["period"])) {
                                                                ?>ক্ষেত্র<?php } ?></li>
                <li class="breadcrumb-item"><a href="<?php
                                                        if (isset($_GET["field"])) {
                                                            echo baseUrl('field') . '?field=' . $_GET['field'];
                                                        } elseif (isset($_GET["center"])) {
                                                            echo baseUrl('centers') . '?center=' . $_GET['center'];
                                                        } elseif (isset($_GET["period"])) {
                                                            echo baseUrl('savings-periods') . '?period=' . $_GET['period'];
                                                        } ?>" id="breadcrumb_name"></a></li>
                <li class="breadcrumb-item active" id="breadcrumb_subname" aria-current="page"></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Client Filter Form -->
<div class="client_filter_form">
    <div class="container-fluid">
        <div class="form_filter">
            <div class="row">
                <?php
                if (isset($_GET["period"])) {
                ?>
                    <div class="col-md-6 mb-3 select">
                        <label for="feild" class="pb-2">ফিল্ড <span class="text-danger">*</span></label>
                        <select id="feild" class="form-control input_field form-input p-3" name="feild">
                            <option class="feild" value="" disabled selected>ফিল্ড নির্বারচন করুন...</option>
                        </select>
                    </div>
                <?php }
                if (isset($_GET["field"]) || isset($_GET["period"])) {
                ?>
                    <div class="col-md-6 mb-3 select">
                        <label for="center" class="pb-2">কেন্দ্র <span class="text-danger">*</span></label>
                        <select id="center" class="form-control form-input p-3">
                            <option class="feild" value="null" disabled selected>সকল কেন্দ্র</option>
                        </select>
                    </div>
                <?php }
                if (isset($_GET["field"]) || isset($_GET["center"])) {
                ?>
                    <div class="col-md-6 mb-3 select">
                        <label for="period" class="pb-2">সঞ্চয়ের সংগ্রহ ক্ষেত্র <span class="text-danger">*</span></label>
                        <select id="period" class="form-control form-input p-3">
                            <option class="feild" value="null" disabled selected>সকল ক্ষেত্র</option>
                        </select>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="table">
            <div class="recent_collection">
                <table id="client_account_list" class="table table-bordered table-hover table-striped display responsive nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বই নং</th>
                            <th>ফিল্ড</th>
                            <th>কেন্দ্র</th>
                            <th>ক্ষেত্র</th>
                            <th>সঞ্চয়</th>
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

        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let fieldID = null;
        fieldID = urlParams.get('field');
        let savings = urlParams.get('savings');
        let savingsClose = urlParams.get('savingsClose');
        let centerID = null;
        centerID = urlParams.get('center');
        let periodID = null;
        periodID = urlParams.get('period');
        // console.log(centerID);

        function cardLoad() {
            $.ajax({
                url: "codes/fieldDataAuthenticate.php",
                type: "POST",
                data: {
                    fieldCard: 1,
                    centerID: centerID,
                    periodID: periodID,
                    fieldID: fieldID
                },
                dataType: "JSON",
                success: function(data) {
                    if (data != false) {
                        $.each(data, function(key, value) {
                            $("#breadcrumb_name").text(value.fieldName);
                        })
                    }
                }
            })
        }
        cardLoad();

        if (fieldID != null) {
            function loadCenters(field) {
                $.ajax({
                    url: "codes/loadFunction.php",
                    type: "POST",
                    data: {
                        field: field
                    },
                    success: function(data) {
                        $("#center").html("");
                        $("#center").html(data);
                    }
                })
            }
            loadCenters(fieldID);
            if (savings == 1) {
                $("#breadcrumb_subname").text("একটিভ সঞ্চয় সদস্য");

                function loadPeriod() {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            period: '%1%'
                        },
                        success: function(data) {
                            $("#period").html("");
                            $("#period").html(data);
                        }
                    })
                }
                loadPeriod();

                $("#center").on('change', function() {
                    center = $(this).val();
                    reportLoad(center);
                })
                $("#period").on('change', function() {
                    period = $(this).val();
                    reportLoad(null, period);
                })
                reportLoad();

                function reportLoad(center = null, period = null) {
                    $('#client_account_list').DataTable({
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
                            url: "codes/SavingsActiveACCAuthenticate.php",
                            type: "POST",
                            data: {
                                fieldID: fieldID,
                                center: center,
                                period: period
                            }
                        }
                    });
                }
            } else if (savingsClose == 1) {
                $("#breadcrumb_subname").text("ক্লোজ সঞ্চয় সদস্য");

                function loadPeriod() {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            period: '%1%'
                        },
                        success: function(data) {
                            $("#period").html("");
                            $("#period").html(data);
                        }
                    })
                }
                loadPeriod();

                $("#center").on('change', function() {
                    center = $(this).val();
                    reportLoad(center);
                })
                $("#period").on('change', function() {
                    period = $(this).val();
                    reportLoad(null, period);
                })
                reportLoad();

                function reportLoad(center = null, period = null) {
                    $('#client_account_list').DataTable({
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
                            url: "codes/SavingsDeactiveACCAuthenticate.php",
                            type: "POST",
                            data: {
                                fieldID: fieldID,
                                center: center,
                                period: period
                            }
                        }
                    });
                }
            }
        } else if (centerID != null) {
            if (savings == 1) {
                $("#breadcrumb_subname").text("একটিভ সঞ্চয় সদস্য");

                function loadPeriod() {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            period: '%1%'
                        },
                        success: function(data) {
                            $("#period").html("");
                            $("#period").html(data);
                        }
                    })
                }
                loadPeriod();

                $("#period").on('change', function() {
                    period = $(this).val();
                    reportLoad(null, period);
                })
                reportLoad();

                function reportLoad(fieldID = null, period = null) {
                    $('#client_account_list').DataTable({
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
                            url: "codes/SavingsActiveACCAuthenticate.php",
                            type: "POST",
                            data: {
                                fieldID: fieldID,
                                center: centerID,
                                period: period
                            }
                        }
                    });
                }
            } else if (savingsClose == 1) {
                $("#breadcrumb_subname").text("ক্লোজ সঞ্চয় সদস্য");

                function loadPeriod() {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            period: '%1%'
                        },
                        success: function(data) {
                            $("#period").html("");
                            $("#period").html(data);
                        }
                    })
                }
                loadPeriod();
                $("#period").on('change', function() {
                    period = $(this).val();
                    // console.log(period);
                    reportLoad(null, period);
                })
                reportLoad();

                function reportLoad(fieldID = null, period = null) {
                    $('#client_account_list').DataTable({
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
                            url: "codes/SavingsDeactiveACCAuthenticate.php",
                            type: "POST",
                            data: {
                                fieldID: fieldID,
                                center: centerID,
                                period: period
                            }
                        }
                    });
                }
            }
        } else if (periodID != null) {

            if (savings == 1) {
                $("#breadcrumb_subname").text("একটিভ সঞ্চয় সদস্য");

                function loadField() {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            fields: '1'
                        },
                        success: function(data) {
                            $("#feild").html("");
                            $("#feild").html(data);
                            // console.log(data);
                        }
                    })
                }
                loadField();

                function loadCenters(field) {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            field: field
                        },
                        success: function(data) {
                            $("#center").html("");
                            $("#center").html(data);
                        }
                    })
                }

                $("#feild").on('change', function() {
                    fieldID = $(this).val();
                    loadCenters(fieldID);
                    reportLoad(fieldID);
                })
                $("#center").on('change', function() {
                    centerID = $(this).val();
                    reportLoad(fieldID, centerID);
                })
                reportLoad();

                function reportLoad(fieldID = null, centerID = null) {
                    $('#client_account_list').DataTable({
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
                            url: "codes/SavingsActiveACCAuthenticate.php",
                            type: "POST",
                            data: {
                                fieldID: fieldID,
                                center: centerID,
                                period: periodID
                            }
                        }
                    });
                }
            } else if (savingsClose == 1) {
                $("#breadcrumb_subname").text("ক্লোজ সঞ্চয় সদস্য");

                function loadField() {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            fields: '1'
                        },
                        success: function(data) {
                            $("#feild").html("");
                            $("#feild").html(data);
                            // console.log(data);
                        }
                    })
                }
                loadField();

                function loadCenters(field) {
                    $.ajax({
                        url: "codes/loadFunction.php",
                        type: "POST",
                        data: {
                            field: field
                        },
                        success: function(data) {
                            $("#center").html("");
                            $("#center").html(data);
                        }
                    })
                }

                $("#feild").on('change', function() {
                    fieldID = $(this).val();
                    loadCenters(fieldID);
                    reportLoad(fieldID);
                })
                $("#center").on('change', function() {
                    centerID = $(this).val();
                    reportLoad(fieldID, centerID);
                })
                reportLoad();

                function reportLoad(fieldID = null, centerID = null) {
                    $('#client_account_list').DataTable({
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
                            url: "codes/SavingsDeactiveACCAuthenticate.php",
                            type: "POST",
                            data: {
                                fieldID: fieldID,
                                center: centerID,
                                period: periodID
                            }
                        }
                    });
                }
            }
        } else {
            $(location).attr('href', 'http://localhost/gkcsl/404');
        }

    })
</script>
</body>

</html>