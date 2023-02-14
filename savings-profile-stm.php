<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($clientAcc == 0) {
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
                <li class="breadcrumb-item">ফিল্ড</li>
                <li class="breadcrumb-item"><a href="<?= baseUrl('field') ?>?field=<?= $_GET['field'] ?>" id="breadcrumb_field_name"></a></li>
                <li class="breadcrumb-item">কেন্দ্র</li>
                <li class="breadcrumb-item"><a href="<?= baseUrl('centers') ?>?center=<?= $_GET['center'] ?>" id="breadcrumb_center_name"></a></li>
                <li class="breadcrumb-item" id="sttus"></li>
                <li class="breadcrumb-item"><a href="<?= baseUrl('client-profile') ?>?field=<?= $_GET['field'] ?>&&center=<?= $_GET['center'] ?>&&savings=1&&client=<?= $_GET['client'] ?>">সদস্য প্রোফাইল</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span id="current_page"></span> প্রোফাইল</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Client Profile -->
<div class="client_profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="profile_intro">
                    <div class="img rounded">
                        <img id="client_img" src="<?= baseUrl('/') ?>img/pngfind.com-copyright-png-938050.png" alt="">
                    </div>
                    <div class="p_status text-center my-3">
                        <span class="d-inline-block py-2 px-4 text-capitalize rounded" style="color: #fff; font-size: 18px;" id="status"></span>
                    </div>
                    <div class="p-short">
                        <ul>
                            <li class="text-center name" id="name"></li>
                            <li class="d-flex justify-content-between">বই নম্বর <span id="book">3012</span></li>
                            <li class="d-flex justify-content-between">ফিল্ড <span id="field_name"></span></li>
                            <li class="d-flex justify-content-between">কেন্দ্র <span id="center_name"></span></li>
                            <li class="d-flex justify-content-between">ক্ষেত্র <span id="period_name"></span></li>
                            <li class="d-flex justify-content-between">মোবাইল <span id="phone"></span></li>
                            <li class="d-flex justify-content-between">যোগদান তারিখ <span id="start_date"></span></li>
                            <li class="d-flex justify-content-between">ক্লোজের তারিখ <span id="close_at"></span></li>
                            <!-- <button class="btn btn-sm my-3 px-3 form-control rounden bg-primary text-center d-inline-block text-white">Edit</button> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="account-cards">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">সঞ্চয় সংখ্যা</h4>
                                                <h3><span class="counter_up" id="installment"></span> টি</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">উত্তোলন সংখ্যা</h4>
                                                <h3><span class="counter_up" id="withdrawalInstallment"></span> টি</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">সর্বমোট সঞ্চয়</h4>
                                                <h3><span class="counter_up" id="balance"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">উত্তোলন</h4>
                                                <h3><span class="counter_up" id="withdrawal"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account_chart">
                    <div class="account_loan_chart p-4">
                        <div class="chart_heading mb-3">
                            <h4><span id="period_chartName"></span> চার্ট</h4>
                        </div>
                        <div>
                            <canvas id="account_savings_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account_statment client_profile_stm">
            <div class="table text-end">
                <div id="reportrange" class="d-inline-block" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span id="date_range"></span> <i class="fa fa-caret-down"></i>
                </div>
                <div class="recent_collection">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-between" id="nav-tab" role="tablist">
                            <button class="col-6 col-sm-3 nav-link active" id="nav-accstm-tab" data-bs-toggle="tab" data-bs-target="#nav-accstm" type="button" role="tab" aria-controls="nav-accstm" aria-selected="true">একাউন্ট বিবৃতি</button>
                            <button class="col-6 col-sm-3 nav-link" id="nav-savings-tab" data-bs-toggle="tab" data-bs-target="#nav-savings" type="button" role="tab" aria-controls="nav-savings" aria-selected="true">সঞ্চয় জমা</button>
                            <button class="col-6 col-sm-3 nav-link" id="nav-savingsWithdrawal-tab" data-bs-toggle="tab" data-bs-target="#nav-savingsWithdrawal" type="button" role="tab" aria-controls="nav-savingsWithdrawal" aria-selected="true">সঞ্চয় উত্তোলন</button>
                            <button class="col-6 col-sm-3 nav-link" id="nav-accCheck-tab" data-bs-toggle="tab" data-bs-target="#nav-accCheck" type="button" role="tab" aria-controls="nav-accCheck" aria-selected="true">বই চেক</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-accstm" role="tabpanel" aria-labelledby="nav-accstm-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>একাউন্ট বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <table id="clientProfileStm" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>তারিখ</th>
                                        <th>মন্তব্য</th>
                                        <th>জমা</th>
                                        <th>উত্তোলন</th>
                                        <th>সর্বমোট</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td class="text-end border-top"></td>
                                        <td class="text-end border-top"></td>
                                        <td class="text-end border-top">সর্বমোট</td>
                                        <td class="border-top" style="font-weight: bolder;"></td>
                                        <td class="border-top" style="font-weight: bolder;"></td>
                                        <td class="border-top" style="font-weight: bolder;"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade show" id="nav-savings" role="tabpanel" aria-labelledby="nav-savings-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>সঞ্চয় বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="savingsCollection" style="display: none;">
                                <table id="clientProfileCollection" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>তারিখ</th>
                                            <th>সময়</th>
                                            <th>অফিসার</th>
                                            <th>মন্তব্য</th>
                                            <th>সংগ্রহ</th>
                                            <?php if ($_SESSION['auth']['user_role'] == '0') { ?>
                                                <th>ইডিট</th>
                                                <th>ডিলিট</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top">সর্বমোট</td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <?php if ($_SESSION['auth']['user_role'] == '0') { ?>
                                                <td class="text-end border-top"></td>
                                                <td class="text-end border-top"></td>
                                            <?php } ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="nav-savingsWithdrawal" role="tabpanel" aria-labelledby="nav-savingsWithdrawal-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>উত্তোলন বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="collectionWithdraw" style="display: none;">
                                <table id="clientProfileWithdrawal" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>তারিখ</th>
                                            <th>অফিসার</th>
                                            <th>মন্তব্য</th>
                                            <th>উত্তোলন</th>
                                            <th>অবশিষ্ট জমা</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top">সর্বমোট</td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="nav-accCheck" role="tabpanel" aria-labelledby="nav-accCheck-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>বই চেক</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="accCheck" style="display: none;">
                                <table id="clientProfileCheck" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>চেকের তারিখ</th>
                                            <th>পরবর্তি চেকের তারিখ</th>
                                            <th>জমা ছিলো</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
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
        let fieldID = urlParams.get('field');
        let centerID = urlParams.get('center');
        let clientID = urlParams.get('client');
        let savings = urlParams.get('savings');

        function cardLoad() {
            $.ajax({
                url: "codes/fieldDataAuthenticate.php",
                type: "POST",
                data: {
                    clientCard: 1,
                    centerID: centerID,
                    fieldID: fieldID
                },
                dataType: "JSON",
                success: function(data) {
                    if (data != false) {
                        $.each(data, function(key, value) {
                            $("#breadcrumb_field_name").text(value.field_name);
                            $("#breadcrumb_center_name").text(value.center_name);
                        })
                    }
                }
            })
        }
        cardLoad();

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [day, month, year].join('-');
        }
        if (clientID != null) {

            function profileLoad() {
                $.ajax({
                    url: "codes/clientProfileStmAuthenticate.php",
                    type: "POST",
                    data: {
                        clientProfileSTM: 1,
                        clientID: clientID,
                        savingsID: savings
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data != false) {
                            $.each(data, function(key, value) {
                                $("#name").text(value.name);
                                $("#book").text(value.book);
                                $("#field_name").text(value.field_name);
                                $("#center_name").text(value.center_name);
                                $("#period_name").text(value.period_name);
                                $("#period_chartName").text(value.period_name);
                                $("#current_page").text(value.period_name);
                                $("#phone").text(value.client_mobile_1);
                                $("#start_date").text(formatDate(value.created_at));
                                $("#close_at").text(value.closing_at);
                                $("#installment").text(value.totalInstrallment);
                                $("#withdrawalInstallment").text(value.totalwithdrawal);
                                $("#balance").text(value.balance);
                                $("#withdrawal").text(value.total_withdrawal);

                                if (value.status == 1) {
                                    $("#status").text("ACTIVE");
                                    $("#sttus").text("একটিভ সঞ্চয় সদস্য");
                                    $("#status").addClass("bg-success");
                                } else if (value.status == 2) {
                                    $("#status").text("PANDING");
                                    $("#status").addClass("bg-warning");
                                } else {
                                    $("#status").text("DEACTIVE");
                                    $("#status").addClass("bg-danger");
                                    $("#sttus").text("ডিএকটিভ সঞ্চয় সদস্য");
                                }
                                if (value.client_img != null) {
                                    $("#client_img").attr("src", "./img/" + value.client_img);
                                } else {
                                    $("#client_img").attr("src", "https://avatars.dicebear.com/api/micah/" + value.name + ".svg ");

                                }
                            })
                        }
                    }
                })
            }

            function profileChartLoad() {
                $.ajax({
                    url: "codes/clientProfileStmAuthenticate.php",
                    type: "POST",
                    data: {
                        clientProfileChartLoad: 1,
                        clientID: clientID,
                        savingsID: savings,
                        fieldID: fieldID,
                        centerID: centerID
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // account savings page chart
                        var savings_data_table = data;

                        var account_savings_chart_data = {
                            datasets: [{
                                label: 'আদায় ৳',
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
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
                                    yAxisKey: 'deposit',
                                }
                            }, {
                                label: 'উত্তোলন ৳',
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
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
                                    yAxisKey: 'withdrawal',
                                }
                            }]
                        };

                        var account_savings_chart_config = {
                            type: 'line',
                            data: account_savings_chart_data,
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
                        };

                        var account_savings_chart_chart = new Chart(
                            document.querySelector('#account_savings_chart'),
                            account_savings_chart_config
                        );
                    }
                })
            }
            profileChartLoad();
            profileLoad();
            
            // Edit Collection
            $(document).on("click", "#edit_load", function() {
                var id = $(this).data("id");
                $.ajax({
                    url: "codes/editUpdateColelctionAuthenticate.php",
                    type: "POST",
                    data: {
                        saving_collection_id: id
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#modal_body").html(data);
                    }
                })
            })

            $(document).on("keyup", "#savings", function() {
                finalBalance()
            })

            // edit Table Balance Calculation
            function finalBalance() {
                let pastDeposit = $("#past_total_deposit").val()
                let pastbalance = $("#past-balance").val()

                let afterDeposit = $("#after_total_deposit")
                let afterbalance = $("#after-balance")

                let deposit = $("#savings").val()

                afterDeposit.val(parseInt(pastDeposit) + parseInt(deposit))
                afterbalance.val(parseInt(pastbalance) + parseInt(deposit))
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
                        // console.log(from_date);
                        accStmLoad();
                        clientProfileCollection();
                        clientProfileWithdrawal();
                        clientProfileCheck();
                    }
                })
                
                // Update Collection
                $("#load_edit_form").on("submit", function(e) {
                    e.preventDefault();
                    var savings = $("#savings").val();
                    var afterDeposit = $("#after_total_deposit").val()
                    var afterbalance = $("#after-balance").val()
                    var details = $("#details").val();
                    var id = $("#id").val();
                    var saving_profiles_id = $("#saving_profiles_id").val();

                    if (savings == "" || savings == null) {
                        $("#savings").addClass("is-invalid");
                        $("#savings-feedback").css("display", "block");
                    }
                    if (afterDeposit == "" || afterDeposit == null) {
                        $("#after_total_deposit").addClass("is-invalid");
                        $("#after_total_deposit-feedback").css("display", "block");
                    }
                    if (afterbalance == "" || afterbalance == null) {
                        $("#after-balance").addClass("is-invalid");
                        $("#after-balance-feedback").css("display", "block");
                    }
                    if (savings != "" && savings != null && afterDeposit != "" && afterDeposit != null && afterbalance != "" && afterbalance != null) {

                        $.ajax({
                            url: "codes/editUpdateColelctionAuthenticate.php",
                            type: "POST",
                            data: {
                                deposit: savings,
                                total_deposit: afterDeposit,
                                savingsEditid: id,
                                saving_profiles_id: saving_profiles_id,
                                details: details,
                            },
                            beforeSend: function() {
                                $("#overlayer").fadeIn();
                                $("#preloader").fadeIn();
                            },
                            success: function(data) {
                                console.log(data);
                                $("#overlayer").fadeOut();
                                $("#preloader").fadeOut();
                                if (data == 1) {
                                    $("#modal_close").trigger("click");
                                    accStmLoad();
                                    clientProfileCollection();
                                    clientProfileWithdrawal();
                                    clientProfileCheck();
                                    swal.fire({
                                        title: "অভিনন্দন",
                                        text: "কালেকশন আপডেট সম্পন্ন হয়েছে",
                                        icon: 'success',
                                        buttons: "OK",
                                        dangerMode: true,
                                    })
                                } else {
                                    swal.fire({
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
                        swal.fire({
                            title: "দুঃখিত",
                            text: "ফরম পূরণ হয়নি । আবার চেষ্টা করুন",
                            icon: 'question',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    }
                })

                // Delete Collection
                $(document).on("click", "#dlt_btn", function() {
                    var id = $(this).data("id");
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
                                url: "codes/editUpdateColelctionAuthenticate.php",
                                type: "POST",
                                data: {
                                    dlt_savings_collection_id: id
                                },
                                beforeSend: function() {
                                    $("#overlayer").fadeIn();
                                    $("#preloader").fadeIn();
                                },
                                success: function(data) {
                                    $("#overlayer").fadeOut();
                                    $("#preloader").fadeOut();
                                    if (data == 1) {
                                        accStmLoad();
                                        clientProfileCollection();
                                        clientProfileWithdrawal();
                                        clientProfileCheck();
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

                function accStmLoad() {
                    $('#clientProfileStm').DataTable({
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
                            totalwith = api
                                .column(4)
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
                            pageTotalwith = api
                                .column(4, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(3).footer()).html('৳' + pageTotal + "/-");
                            $(api.column(4).footer()).html('৳' + pageTotalwith + "/-");
                            $(api.column(5).footer()).html('৳' + (pageTotal - pageTotalwith) + "/-");
                        },
                        "responsive": true,
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: 1
                            },
                            {
                                responsivePriority: 2,
                                targets: 3
                            },
                            {
                                responsivePriority: 3,
                                targets: 4
                            },
                            {
                                responsivePriority: 4,
                                targets: 5
                            }
                        ],
                        // "retrieve": true,
                        "paging": false,
                        "bDestroy": true,
                        "order": [],
                        "searching": true,
                        "ajax": {
                            url: "codes/clientAccSTMAuthenticate.php",
                            type: "POST",
                            data: {
                                savingsID: savings,
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

                function clientProfileCollection() {
                    $('#clientProfileCollection').DataTable({
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
                                targets: 5
                            },
                            {
                                responsivePriority: 3,
                                targets: 2
                            },
                            {
                                responsivePriority: 4,
                                targets: 3
                            }
                        ],
                        // "retrieve": true,
                        "paging": true,
                        "bDestroy": true,
                        "order": [],
                        "searching": true,
                        "ajax": {
                            url: "codes/clientSavingsProfileCollectionAuthenticate.php",
                            type: "POST",
                            data: {
                                savingsID: savings,
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

                function clientProfileWithdrawal() {
                    $('#clientProfileWithdrawal').DataTable({
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
                                .column(4)
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total over this page
                            pageTotal = api
                                .column(4, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(4).footer()).html('৳' + pageTotal + "/-");
                        },
                        "responsive": true,
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: 1
                            },
                            {
                                responsivePriority: 2,
                                targets: 4
                            },
                            {
                                responsivePriority: 3,
                                targets: 5
                            },
                            {
                                responsivePriority: 4,
                                targets: 2
                            }
                        ],
                        // "retrieve": true,
                        "paging": true,
                        "bDestroy": true,
                        "order": [],
                        "searching": true,
                        "ajax": {
                            url: "codes/clientsavingsProfileWithdrawalAuthenticate.php",
                            type: "POST",
                            data: {
                                savingsID: savings,
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

                function clientProfileCheck() {
                    $('#clientProfileCheck').DataTable({
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
                                targets: 3
                            }
                        ],
                        // "retrieve": true,
                        "paging": true,
                        "bDestroy": true,
                        "order": [],
                        "searching": true,
                        "ajax": {
                            url: "codes/clientSavingsProfileCheckAuthenticate.php",
                            type: "POST",
                            data: {
                                savingsID: savings,
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
                accStmLoad();
                $("#nav-savings-tab").on("click", function() {
                    $("#savingsCollection").css("display", "block");
                    setTimeout(function() {
                        clientProfileCollection();
                    }, 1000)
                })
                $("#nav-savingsWithdrawal-tab").on("click", function() {
                    $("#collectionWithdraw").css("display", "block");
                    setTimeout(function() {
                        clientProfileWithdrawal();
                    }, 1000)
                })
                $("#nav-accCheck-tab").on("click", function() {
                    $("#accCheck").css("display", "block");
                    setTimeout(function() {
                        clientProfileCheck();
                    }, 1000)
                })
            })
        } else {
            $(location).attr('href', '<?= baseUrl("404") ?>');
        }
    })
</script>
</body>

</html>