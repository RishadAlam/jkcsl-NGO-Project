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
                <li class="breadcrumb-item active" aria-current="page">আয়</li>
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
                    আয়ের ফরম
                </button>

                <!-- Modal -->
                <div class="modal fade" id="expance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">আয়ের ফরম</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="income_reg_form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="income_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                            <input type="date" style="text-indent: 0;" class="form-control input_field form-input p-3" id="income_date">
                                            <div id="date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                তারিখ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="income" class="pb-2">আয় (টাকা) <span class="text-danger">*</span></label>
                                            <input type="number" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="টাকা লিখুন" id="income">
                                            <div id="income-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                আয় লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 select">
                                            <label for="details" class="pb-2">আয়ের বিবরণ <span class="text-danger">*</span></label>
                                            <select id="details" class="form-control input_field form-input p-3">
                                                <option class="feild" value="null" disabled selected>আয়ের বিবরণ নির্বাচন করুন...</option>
                                                <option value="ফরম ফি">ফরম ফি</option>
                                                <option value="ক্লোজিং ফি">ক্লোজিং ফি</option>
                                                <option value="বই ফি">বই ফি</option>
                                                <option value="বীমা ফি">বীমা ফি</option>
                                                <option value="সার্ভিস ফি">সার্ভিস ফি</option>
                                                <option value="জরিমানা">জরিমানা</option>
                                                <option value="অন্যান্য">অন্যান্য</option>
                                            </select>
                                            <div id="details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                আয়ের বিবরণ লিখুন
                                            </div>
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
        <div class="row">
            <div class="col-md-12">
                <div class="expance_acc_chart p-4">
                    <div class="chart_heading mb-3">
                        <h4>চলতি মাসে আয় হয়েছে <span id="total_income"></span> টাকা</h4>
                    </div>
                    <div>
                        <canvas id="income_acc_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Expance account statement -->
<div class="expance_account_statment my-3">
    <div class="container-fluid">
        <div class="text-end">
            <div id="reportrange" style="display: inline-block; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span id="date_range"></span> <i class="fa fa-caret-down"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>আয়ের বিবৃতি</h4>
                            <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                        </div>
                        <table id="income_list" class="table display responsive nowrap table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>তারিখ</th>
                                    <th>মন্তব্য</th>
                                    <th>আয়</th>
                                    <th>ইডিট</th>
                                    <th>ডিলিট</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">আয়ের ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="income_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                <input type="hidden" id="incomeUpdateid">
                                <input type="date" style="text-indent: 0;" class="form-control form-input p-3" id="up_income_date">
                                <div id="up_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    তারিখ লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="income" class="pb-2">আয় (টাকা) <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="টাকা লিখুন" id="up_income">
                                <div id="up_income-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    আয় লিখুন
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 select">
                                <label for="details" class="pb-2">আয়ের বিবরণ <span class="text-danger">*</span></label>
                                <select id="up_details" class="form-control form-input p-3">
                                    <option class="feild" value="null" disabled selected>আয়ের বিবরণ নির্বাচন করুন...</option>
                                    <option value="ফরম ফি">ফরম ফি</option>
                                    <option value="ক্লোজিং ফি">ক্লোজিং ফি</option>
                                    <option value="বই ফি">বই ফি</option>
                                    <option value="বীমা ফি">বীমা ফি</option>
                                    <option value="সার্ভিস ফি">সার্ভিস ফি</option>
                                    <option value="জরিমানা">জরিমানা</option>
                                    <option value="অন্যান্য">অন্যান্য</option>
                                </select>
                                <div id="up_details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    আয়ের বিবরণ লিখুন
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="modalclose">ক্লোজ</button>
                        <button type="submit" class="btn rounded btn-button" id="income_update_form">সাবমিট করুন</button>
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
        var incomes = '';
        var Dates = [];
        var income = [];
        var dts = '';
        // var income_acc_labels = null;

        function incomeChart() {
            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    total_income: 1,
                },
                success: function(data) {
                    $("#total_income").text(data);
                }
            })

            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    income: 1,
                },
                dataType: "JSON",
                success: function(data) {
                    // console.log(data);
                    // $("#total_income").text(data.income);
                    $.each(data, function(key, value) {
                        var D = new Date(value.date);
                        Dates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                        income.push(value.income);
                    });
                    const income_acc_data = {
                        labels: Dates,
                        datasets: [{
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 205, 86, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(201, 203, 207, 1)',

                            ],
                            borderColor: '#695cfe',
                            color: '#fff',
                            data: income,
                        }]
                    };

                    const income_acc_config = {
                        type: 'bar',
                        data: income_acc_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#fff'
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
                                        text: "চলতি মাসের তারিখ সমুহ",
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
                    };

                    const income_acc_chart = new Chart(
                        document.querySelector('#income_acc_chart'),
                        income_acc_config
                    );
                }
            })
        }
        incomeChart();

        $("#income_reg_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var date = $("#income_date").val();
            var income = $("#income").val();
            var dec = $("#details").val();

            // Empty Input Checking
            if (date == null || date == "") {
                $("#date").addClass("is-invalid");
                $("#date-feedback").css("display", "block");
            }
            if (income == "" || income == null) {
                $("#income").addClass("is-invalid");
                $("#income-feedback").css("display", "block");
            }
            if (dec == "" || dec == null) {
                $("#details").addClass("is-invalid");
                $("#details-feedback").css("display", "block");
            }

            // Ajax Action
            if (date != null && income != "" && income != null && dec != "" && dec != null) {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        date: date,
                        income: income,
                        dec: dec,
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            $("#income_reg_form").trigger("reset");
                            $("#close").trigger("click");
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "আয় গ্রহণ করা হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "আয় গ্রহণ করা হয়নি। আবার চেষ্টা করুন",
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
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }

        })

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
                    incomeSTMLoad();
                }
            })

            function incomeSTMLoad() {
                $('#income_list').DataTable({
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

                        // Total over this page
                        pageTotal = api
                            .column(3, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(3).footer()).html('৳' + pageTotal + "/-");
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
                    ],
                    // "retrieve": true,
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
            incomeSTMLoad();
        })

        $(document).on("click", "#edit_load", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    income_id: id
                },
                dataType: "JSON",
                success: function(data) {
                    $.each(data, function(key, value) {
                        $("#incomeUpdateid").val(value.id);
                        $("#up_income_date").val(value.date);
                        $("#up_income").val(value.income);
                        $("#up_details").val(value.details).trigger('change');
                    })
                }
            })
        })

        $("#income_update_form").on("click", function(e) {
            e.preventDefault();

            // Store User primary Data
            var date = $("#up_income_date").val();
            var income = $("#up_income").val();
            var dec = $("#up_details").val();
            var id = $("#incomeUpdateid").val();

            // Empty Input Checking
            if (date == null || date == "") {
                $("#up_income_date").addClass("is-invalid");
                $("#up_date-feedback").css("display", "block");
            }
            if (income == "" || income == null) {
                $("#up_income").addClass("is-invalid");
                $("#up_income-feedback").css("display", "block");
            }
            if (dec == "" || dec == null) {
                $("#up_details").addClass("is-invalid");
                $("#up_details-feedback").css("display", "block");
            }

            // Ajax Action
            if (date != null && income != "" && income != null && dec != "" && dec != null) {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        update_date: date,
                        update_income: income,
                        update_dec: dec,
                        id: id
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            $("#income_reg_form").trigger("reset");
                            $("#modalclose").trigger("click");
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "আয় আপডেট করা হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "আয় আপডেট করা হয়নি। আবার চেষ্টা করুন",
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
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }

        })

        $(document).on("click", "#dlt_btn", function() {
            var id = $(this).data("id");
            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: "ডিলিট করার পর আয় ফিরে পাওয়া সম্ভব নয়!",
                icon: 'question',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't Delete`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "codes/fdrAuthenticate.php",
                        type: "POST",
                        data: {
                            dlt_income_id: id
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
                                    text: "ডিলিট সম্পন্ন হয়েছে",
                                    icon: 'success',
                                })
                            } else {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "ডিলিট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                    icon: 'error',
                                })
                            }
                            // Swal.fire('Saved!', '', 'success')
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('আয় সুরক্ষখিত রয়েছে', '', 'info')
                }
            })
        })
    })
</script>
</body>

</html>