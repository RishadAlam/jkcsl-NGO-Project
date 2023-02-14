<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($collectionReport == 0) {
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
                <li class="breadcrumb-item">কালেকশন রিপোর্ট</li>
                <li class="breadcrumb-item"><a href="<?= baseUrl('collection-field-report') ?>">ক্ষেত্র তালিকা</a></li>
                <li class="breadcrumb-item active" id="breadcrumb_name" aria-current="page"></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Loan Report -->
<div class="feild_list_report me-3">
    <div class="container-fluid">
        <div class="table">
            <div class="recent_collection">
                <div class="table_heading d-md-flex align-items-center justify-content-between my-3">
                    <h4>তারিখঃ <span class="date"></span></h4>
                    <h4>মাসিক ঋণ রিপোর্ট</h4>
                    <button id="reportPrint" class="border-0 d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</button>
                    <?php if (!$_SESSION['auth']['user_role']) { ?>
                        <div style="max-width: 350px;" class="select">
                            <label for="officers">অফিসার</label>
                            <select id="officers" class="form-control form-input p-3">
                                <option value="null" disabled selected>অফিসার নির্বারচন করুন...</option>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <table id="collection_loan_report" class="table display responsive nowrap table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বই</th>
                            <th>সঞ্চয়</th>
                            <th>কিস্তি</th>
                            <th>লাভ</th>
                            <th>মোট আদায়</th>
                            <th>মন্তব্য</th>
                            <th>অফিসার</th>
                            <th>সময়</th>
                            <th>ইডিট</th>
                            <th>ডিলিট</th>
                            <?php if (!$_SESSION['auth']['user_role']) { ?>
                                <th>একশন
                                    <div class="form-check form-switch text-center">
                                        <input class="form-check-input" name="all_check" type="checkbox" role="switch" id="all_check">
                                        <label class="form-check-label" for="all_check"></label>
                                    </div>
                                </th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td class="text-end" style="border-top: 1px solid #fff;"></td>
                            <td class="text-end" style="border-top: 1px solid #fff;"></td>
                            <td class="text-end" style="border-top: 1px solid #fff;">সর্বমোট</td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <td style="border-top: 1px solid #fff;"></td>
                            <?php if (!$_SESSION['auth']['user_role']) { ?>
                                <td style="border-top: 1px solid #fff;">
                                    <button type="submit" id="save" class="btn text-end rounded btn-button" style="display: none;">Save</button>
                                </td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="show_messages">
    <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">কালেকশন ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="load_edit_form">
                    <div class="modal-body" id="modal_body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-danger" id="modal_close" data-bs-dismiss="modal">ক্লোজ</button>
                        <button type="submit" class="btn rounded btn-success">সাবমিট করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "include/footer.php";
?>
<script>
    $('#all_check').on("click", function() {
        if ($('#all_check').is(':checked')) {
            $("input[name='action']").prop('checked', true);
        } else {
            $("input[name='action']").prop('checked', false);
        }
        checked();
    })
    var totalCheck = "";
    var totalChecked = "";
    $(document).on("click", "input[name='action']", function() {
        checked();
    })

    function checked() {
        totalCheck = $("input[name='action']").length;
        totalChecked = $("input[name='action']:checked").length;

        if (totalCheck == totalChecked) {
            $("#all_check").prop('checked', true);
        } else {
            $("#all_check").prop('checked', false);
        }

        if (totalChecked > 0) {
            $("#save").css("display", "block");
        } else {
            $("#save").css("display", "none");
        }
    }

    $(document).ready(function() {
        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let periodID = urlParams.get('report');

        function cardLoad() {
            $.ajax({
                url: "codes/fieldDataAuthenticate.php",
                type: "POST",
                data: {
                    fieldCard: 1,
                    fieldID: null,
                    centerID: null,
                    periodID: periodID
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

        function loadOfficer() {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    officer: '1'
                },
                success: function(data) {
                    $("#officers").html('');
                    $("#officers").html(data);
                }
            })
        }
        loadOfficer();

        let queryString2 = window.location.search;
        let urlParams2 = new URLSearchParams(queryString2);
        let report = urlParams2.get('report');
        var officer = null;

        $("#officers").on("change", function() {
            officer = $("#officers").val();
            // console.log(officer
            setTimeout(function() {
                reportLoad(officer);
            }, 1000)
        })

        $("#reportPrint").on("click", function() {
            reportPrint();
        })

        function reportPrint() {
            window.open('<?= baseUrl("collection-print-report") ?>?report=' + report + '&&officer=' + officer + '&&date=null&&loan=1');
        }

        if (report != null) {
            reportLoad();

            function reportLoad(officer = null) {
                $('#collection_loan_report').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column(3)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        total = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        total = api
                            .column(5)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        total = api
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        depositTotal = api
                            .column(3, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        loanTotal = api
                            .column(4, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        interestTotal = api
                            .column(5, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        toalTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(3).footer()).html('৳' + depositTotal + "/-");
                        $(api.column(4).footer()).html('৳' + loanTotal + "/-");
                        $(api.column(5).footer()).html('৳' + interestTotal + "/-");
                        $(api.column(6).footer()).html('৳' + toalTotal + "/-");
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
                        },
                        {
                            responsivePriority: 6,
                            targets: 6
                        },
                        <?php if (!$_SESSION['auth']['user_role']) { ?> {
                                responsivePriority: 7,
                                targets: 12
                            }
                        <?php } ?>
                    ],
                    // "retrieve": true,
                    "paging": false,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/collectionloanAuthenticate.php",
                        type: "POST",
                        data: {
                            report: report,
                            officer: officer
                        }
                    }
                });
            }
        } else {
            $(location).attr('href', 'http://localhost/gkcsl/404');
        }

        $(document).on("click", "#edit_load", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    load_collection_id: id
                },
                success: function(data) {
                    // console.log(data);
                    $("#modal_body").html(data);
                }
            })
        })

        $(document).on("keyup", "#savings", function() {
            totals();
        })
        $(document).on("keyup", "#loan", function() {
            totals();
        })
        $(document).on("keyup", "#interest", function() {
            totals();
        })

        function totals() {
            var savings = $("#savings").val();
            var loan = $("#loan").val();
            var interest = $("#interest").val();
            var total = parseFloat(savings) + parseFloat(loan) + parseFloat(interest);
            $("#hidden_total").val(total);
            $("#total").val(total);
        }


        $("#load_edit_form").on("submit", function(e) {
            e.preventDefault();
            var savings = $("#savings").val();
            var loan = $("#loan").val();
            var interest = $("#interest").val();
            var total = $("#total").val();
            var details = $("#details").val();
            var id = $("#id").val();

            if (savings == "" || savings == null) {
                $("#savings").addClass("is-invalid");
                $("#savings-feedback").css("display", "block");
            }
            if (loan == "" || loan == null) {
                $("#loan").addClass("is-invalid");
                $("#loan-feedback").css("display", "block");
            }
            if (savings != "" && savings != null && loan != "" && loan != null && interest != "" && interest != null && total != "" && total != null) {

                $.ajax({
                    url: "codes/loanCollectionAuthenticate.php",
                    type: "POST",
                    data: {
                        deposit: savings,
                        loan: loan,
                        interest: interest,
                        total: total,
                        loadEditid: id,
                        details: details,
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            $("#modal_close").trigger("click");
                            reportLoad();
                            swal({
                                title: "অভিনন্দন",
                                text: "কালেকশন আপডেট সম্পন্ন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        } else {
                            swal({
                                title: "দুঃখিত",
                                text: "কালেকশন আপডেট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                    }
                })
            } else {
                swal({
                    title: "দুঃখিত",
                    text: "ফরম পূরণ হয়নি । আবার চেষ্টা করুন",
                    icon: 'question',
                    buttons: "OK",
                    dangerMode: true,
                })
            }
        })

        $(document).on("click", "#dlt_btn", function() {
            var id = $(this).data("id");
            // console.log(id);
            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: "ডিলিট করার পর কালেকশনটি ফিরে পাওয়া সম্ভব নয়!",
                icon: 'question',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't Delete`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "codes/loanCollectionAuthenticate.php",
                        type: "POST",
                        data: {
                            dlt_load_collection_id: id
                        },
                        beforeSend: function() {
                            $("#overlayer").fadeIn();
                            $("#preloader").fadeIn();
                        },
                        success: function(data) {
                            $("#overlayer").fadeOut();
                            $("#preloader").fadeOut();
                            if (data == 1) {
                                reportLoad();
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "কালেকশন ডিলিট সম্পন্ন হয়েছে",
                                    icon: 'success',
                                })
                            } else {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "কালেকশন ডিলিট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                    icon: 'error',
                                })
                            }
                            // Swal.fire('Saved!', '', 'success')
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('কালেকশন সুরক্ষখিত রয়েছে', '', 'info')
                }
            })
        })

        $("#save").on("click", function() {
            var id = [];
            $("input[name='action']:checked").each(function(i) {
                id[i] = $(this).attr("id");
            })
            if (id != "") {
                $.ajax({
                    url: "codes/loanCollectionAuthenticate.php",
                    type: "POST",
                    data: {
                        loanAppID: id
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            reportLoad();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "কালেকশন সম্পন্ন হয়েছে",
                                icon: 'success',
                            })
                        } else {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "কালেকশন সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                            })
                        }
                    }
                })
            } else {
                swal.fire({
                    title: "দুঃখিত",
                    text: "কালেকশন পাওয়া যাইনি।",
                    icon: 'error',
                })
            }
        })

    })
</script>
</body>

</html>