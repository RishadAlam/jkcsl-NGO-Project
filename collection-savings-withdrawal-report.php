<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($waitingWithdrawal == 0) {
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
                <li class="breadcrumb-item"><a href="<?= baseUrl('collection-withdrawal-field-report') ?>">ক্ষেত্র তালিকা</a></li>
                <li class="breadcrumb-item active" aria-current="page" id="breadcrumb_name"></li>
            </ol>
        </nav>
    </div>
</div>

<!-- savings report -->
<div class="feild_list_report me-3">
    <div class="container-fluid">
        <div class="table">
            <div class="recent_collection">
                <div class="table_heading d-md-flex align-items-center justify-content-between my-3">
                    <h4>ডিপিএস রিপোর্ট</h4>
                    <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                    <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                        <div style="max-width: 350px;" class="select">
                            <label for="officers">অফিসার</label>
                            <select id="officers" class="form-control form-input p-3">
                                <option value="null" disabled selected>অফিসার নির্বারচন করুন...</option>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <table id="savings_withdrawal_report" class="table display responsive nowrap table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বই</th>
                            <th>ফিল্ড</th>
                            <th>কেন্দ্র</th>
                            <th>উত্তোলন</th>
                            <th>অবশিষ্ট</th>
                            <th>মন্তব্য</th>
                            <th>অফিসার</th>
                            <th>সময়</th>
                            <th>ইডিট</th>
                            <th>ডিলিট</th>
                            <?php if ($_SESSION['auth']['user_role'] == false) { ?>
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
                            <?php if ($_SESSION['auth']['user_role'] == false) { ?>
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
            setTimeout(function() {
                savings_withdrawalReportLoad(officer);
            }, 1000)
        })

        if (report != null) {
            savings_withdrawalReportLoad();

            function savings_withdrawalReportLoad(officer = null) {
                $('#savings_withdrawal_report').DataTable({
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
                            .column(5)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(5, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(5).footer()).html('৳' + pageTotal + "/-");
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

                        <?php if ($_SESSION['auth']['user_role'] == false) { ?> {
                                responsivePriority: 5,
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
                        url: "codes/collectionsSavingsWithdrawalAuthenticate.php",
                        type: "POST",
                        data: {
                            report: report,
                            officer: officer,
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
                url: "codes/savingsCollectionAuthenticate.php",
                type: "POST",
                data: {
                    saving_withdrawal_id: id
                },
                success: function(data) {
                    // console.log(data);
                    $("#modal_body").html(data);
                }
            })
        })

        $(document).on("keyup", "#withdraw", function() {
            balance_rem();
        })

        function balance_rem() {
            withdraw = $("#withdraw").val();
            var balances = $("#total_balance").val();
            var total = parseFloat(balances) - parseFloat(withdraw);
            $("#balance_remaining").val(total);
        }

        $("#load_edit_form").on("submit", function(e) {
            e.preventDefault();
            var withdraw = $("#withdraw").val();
            var total = $("#balance_remaining").val();
            var details = $("#details").val();
            var id = $("#id").val();

            if (withdraw == "" || withdraw == null) {
                $("#withdraw").addClass("is-invalid");
                $("#withdraw-feedback").css("display", "block");
            }
            if (withdraw != "" && withdraw != null) {

                $.ajax({
                    url: "codes/savingsCollectionAuthenticate.php",
                    type: "POST",
                    data: {
                        withdraw: withdraw,
                        savingsWithdEditid: id,
                        details: details,
                        total: total,
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
                            savings_withdrawalReportLoad();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "উত্তোলোন আপডেট সম্পন্ন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        } else {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "উত্তোলোন আপডেট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                    }
                })
            } else {
                swal.fire({
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
            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: "ডিলিট করার পর উত্তোলোন ফিরে পাওয়া সম্ভব নয়!",
                icon: 'question',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't Delete`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "codes/savingsCollectionAuthenticate.php",
                        type: "POST",
                        data: {
                            dlt_savings_withdraw_id: id
                        },
                        beforeSend: function() {
                            $("#overlayer").fadeIn();
                            $("#preloader").fadeIn();
                        },
                        success: function(data) {
                            $("#overlayer").fadeOut();
                            $("#preloader").fadeOut();
                            if (data == 1) {
                                savings_withdrawalReportLoad();
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "উত্তোলোন ডিলিট সম্পন্ন হয়েছে",
                                    icon: 'success',
                                })
                            } else {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "উত্তোলোন ডিলিট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                    icon: 'error',
                                })
                            }
                            // Swal.fire('Saved!', '', 'success')
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('উত্তোলোন সুরক্ষখিত রয়েছে', '', 'info')
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
                    url: "codes/savingsCollectionAuthenticate.php",
                    type: "POST",
                    data: {
                        savingsWithAppID: id
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            savings_withdrawalReportLoad();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "উত্তোলোন সম্পন্ন হয়েছে",
                                icon: 'success',
                            })
                        } else {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "উত্তোলোন সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                            })
                        }
                    }
                })
            } else {
                swal.fire({
                    title: "দুঃখিত",
                    text: "উত্তোলোন পাওয়া যাইনি।",
                    icon: 'error',
                })
            }
        })

    })
</script>
</body>

</html>