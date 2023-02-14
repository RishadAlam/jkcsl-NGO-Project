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
                <li class="breadcrumb-item active" aria-current="page">এফ ডি আর</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Enpance Chart -->
<div class="expance_chart my-3">
    <div class="container-fluid">
        <div class="expance_form d-flex justify-content-between">
            <div class="expance">
                <!-- Button trigger modal -->
                <button type="button" class="btn rounded btn-button" data-bs-toggle="modal" data-bs-target="#expance">
                    এফ.ডি.আর ফরম
                </button>

                <!-- Modal -->
                <div class="modal fade" id="expance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">এফ.ডি.আর ফরম</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="fdr_reg_form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                                            <input type="text" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="নাম লিখুন" id="name">
                                            <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                নাম লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="fdr-deposit" class="pb-2">এফ.ডি.আর (টাকা) <span class="text-danger">*</span></label>
                                            <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="এফ.ডি.আর লিখুন" id="fdr-deposit">
                                            <div id="fdr-deposit-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                এফ.ডি.আর লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="start-date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                            <input type="date" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="৫০" id="start-date">
                                            <div id="start-date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                তারিখ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="expiry-date" class="pb-2">মেয়াদ (তারিখ) <span class="text-danger">*</span></label>
                                            <input type="date" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="৫০" id="expiry-date">
                                            <div id="expiry-date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                মেয়াদ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="details" class="pb-2">মন্তব্য</label>
                                            <textarea class="form-control input_field p-3" id="details" rows="3" placeholder="মন্তব্য লিখুন..." id="details"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="close">ক্লোজ</button>
                                    <button type="submit" class="btn rounded btn-button">সাবমিট করুন</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Expance account statement -->
<div class="expance_account_statment my-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>একটিভ এফ.ডি.আর সমুহ</h4>
                            <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                        </div>
                        <table id="active_fdr_list" class="table table-bordered table-hover table-striped display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম</th>
                                    <th>তারিখ</th>
                                    <th>মেয়াদ</th>
                                    <th style="width: 20px;">মন্তব্য</th>
                                    <th>এফ.ডি.আর</th>
                                    <th>লাভ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>একশন</th>
                                    <th>ইডিট</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end" style="border-top: 1px solid #fff;">সর্বমোট</td>
                                    <td style="border-top: 1px solid #fff;"></td>
                                    <td colspan="4" style="border-top: 1px solid #fff;"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>ডিএকটিভ এফ.ডি.আর সমুহ</h4>
                            <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                        </div>
                        <table id="deactivate_frd" class="table table-bordered table-hover table-striped display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম</th>
                                    <th>তারিখ</th>
                                    <th>মেয়াদ</th>
                                    <th style="width: 20px;">মন্তব্য</th>
                                    <th>এফ.ডি.আর</th>
                                    <th>লাভ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>একশন</th>
                                    <th>ইডিট</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end" style="border-top: 1px solid #fff;">সর্বমোট</td>
                                    <td style="border-top: 1px solid #fff;"></td>
                                    <td colspan="4" style="border-top: 1px solid #fff;"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">এফ.ডি.আর ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" id="modal_close" aria-label="Close"></button>
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

        $("#fdr_reg_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var name = $("#name").val();
            var fdr_deposit = $("#fdr-deposit").val();
            var start_date = $("#start-date").val();
            var expiry_date = $("#expiry-date").val();
            var dec = $("#details").val();

            // Empty Input Checking
            if (name == "" || name == null) {
                $("#name").addClass("is-invalid");
                $("#name-feedback").css("display", "block");
            }
            if (fdr_deposit == "" || fdr_deposit == null) {
                $("#fdr-deposit").addClass("is-invalid");
                $("#fdr-deposit-feedback").css("display", "block");
            }
            if (start_date == "" || start_date == null) {
                $("#start-date").addClass("is-invalid");
                $("#start-date-feedback").css("display", "block");
            }
            if (expiry_date == "" || expiry_date == null) {
                $("#expiry-date").addClass("is-invalid");
                $("#expiry-date-feedback").css("display", "block");
            }

            // Ajax Action
            if (name != "" && name != null && fdr_deposit != "" && fdr_deposit != null && start_date != "" && start_date != null && expiry_date != "" && expiry_date != null) {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        name: name,
                        fdr_deposit: fdr_deposit,
                        start_date: start_date,
                        expiry_date: expiry_date,
                        dec: dec,
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#close").trigger("click");
                            activeFdrLoad();
                            deactiveFdrLoad();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "এফ.ডি.আর নিবন্ধিত হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "এফ.ডি.আর নিবন্ধিত হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        // console.log(data);
                    }
                })

            } else {
                swal.fire({
                    title: "দুঃখিত",
                    text: "ফরম পূরণ হয়নি । আবার চেষ্টা করুন",
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }

        })

        activeFdrLoad();

        function activeFdrLoad() {
            $('#active_fdr_list').DataTable({
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
                    total = api
                        .column(6)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    depositTotal = api
                        .column(5, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    interestTotal = api
                        .column(6, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(5).footer()).html('৳' + depositTotal + "/-");
                    $(api.column(6).footer()).html('৳' + interestTotal + "/-");
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
                    url: "codes/activeFdrAuthenticate.php",
                    type: "POST"
                }
            });
        }
        deactiveFdrLoad();

        function deactiveFdrLoad() {
            $('#deactivate_frd').DataTable({
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
                    total = api
                        .column(6)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    depositTotal = api
                        .column(5, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    interestTotal = api
                        .column(6, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(5).footer()).html('৳' + depositTotal + "/-");
                    $(api.column(6).footer()).html('৳' + interestTotal + "/-");
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
                    url: "codes/deactiveFdrAuthenticate.php",
                    type: "POST"
                }
            });
        }

        // fdr edit 
        $(document).on("click", "#edit_load", function() {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    fdr_id: id
                },
                success: function(data) {
                    // console.log(data);
                    $("#modal_body").html(data);
                }
            })
        })

        $("#load_edit_form").on("submit", function(e) {
            e.preventDefault();
            var name = $("#up_name").val();
            var fdr_deposit = $("#up_fdr-deposit").val();
            var start_date = $("#up_start-date").val();
            var expiry_date = $("#up_expiry-date").val();
            var dec = $("#up_details").val();
            var id = $("#id").val();

            // Empty Input Checking
            if (name == "" || name == null) {
                $("#name").addClass("is-invalid");
                $("#name-feedback").css("display", "block");
            }
            if (fdr_deposit == "" || fdr_deposit == null) {
                $("#fdr-deposit").addClass("is-invalid");
                $("#fdr-deposit-feedback").css("display", "block");
            }
            if (start_date == "" || start_date == null) {
                $("#start-date").addClass("is-invalid");
                $("#start-date-feedback").css("display", "block");
            }
            if (expiry_date == "" || expiry_date == null) {
                $("#expiry-date").addClass("is-invalid");
                $("#expiry-date-feedback").css("display", "block");
            }

            // Ajax Action
            if (name != "" && name != null && fdr_deposit != "" && fdr_deposit != null && start_date != "" && start_date != null && expiry_date != "" && expiry_date != null) {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        fdrID: id,
                        up_name: name,
                        up_fdr_deposit: fdr_deposit,
                        up_start_date: start_date,
                        up_expiry_date: expiry_date,
                        up_details: dec
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data == 1) {
                            $("#modal_close").trigger("click");
                            activeFdrLoad();
                            deactiveFdrLoad();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "এফ.ডি.আর আপডেট হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "এফ.ডি.আর আপডেট হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        // console.log(data);
                    }
                })

            } else {
                swal.fire({
                    title: "দুঃখিত",
                    text: "ফরম পূরণ হয়নি । আবার চেষ্টা করুন",
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }
        })

        $(document).on("click", "input[name='action']", function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr("id");
                var status = '1';
            } else {
                var id = $(this).attr("id");
                var status = '0';
            }

            if (id != "") {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        fdrSwitchID: id,
                        status: status
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            activeFdrLoad();
                            deactiveFdrLoad();
                        } else {
                            activeFdrLoad();
                            deactiveFdrLoad();
                            swal.fire({
                                title: "দুঃখিত",
                                text: "এফ.ডি.আর আপডেট হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                            })
                        }
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