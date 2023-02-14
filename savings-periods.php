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
                <li class="breadcrumb-item">ক্ষেত্র</li>
                <li class="breadcrumb-item active" id="breadcrumb_name" aria-current="page"></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Total Client -->
<div class="total_client">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="savings_active_clients">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row align-items-center">
                                <div class="card_detail">
                                    <h4 class="py-2">একটিভ সঞ্চয় সদস্য</h4>
                                    <h3><span id="activeSavings"></span> জন</h3>

                                    <!-- Card Icon -->
                                    <div class="icon">
                                        <span><i class='bx bxs-user-check bg-success'></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= baseUrl('field-savings-book-list') ?>?period=<?= $_GET['period'] ?>&savings=1" class="d-flex justify-content-between"><span>বই দেখুন</span><span><i class='bx bxs-chevrons-right'></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="savings_active_clients">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row align-items-center">
                                <div class="card_detail">
                                    <h4 class="py-2">ক্লোজ সঞ্চয় সদস্য</h4>
                                    <h3><span id="deactiveSavings"></span> জন</h3>

                                    <!-- Card Icon -->
                                    <div class="icon">
                                        <span><i class='bx bxs-user-x bg-danger'></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= baseUrl('field-savings-book-list') ?>?period=<?= $_GET['period'] ?>&savingsClose=1" class="d-flex justify-content-between"><span>বই দেখুন</span><span><i class='bx bxs-chevrons-right'></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Client Charts -->
<div class="client_charts my-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="chart_body">
                    <div class="savings_chart p-4">
                        <div class="chart_heading mb-3">
                            <h4>চলতি মাসের সঞ্চয় সংগ্রহ হয়েছে <span id="total_savings_chart"></span> টাকা</h4>
                        </div>
                        <div>
                            <canvas id="savings_chart"></canvas>
                        </div>
                    </div>
                    <div class="withdraw_chart p-4">
                        <div class="chart_heading mb-3">
                            <h4>চলতি মাসের সঞ্চয় উত্তোলন হয়েছে <span id="total_savings_withdraw_chart"></span> টাকা</h4>
                        </div>
                        <div>
                            <canvas id="withdraw_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="chart_body">
                    <div class="added_client_chart p-4">
                        <div class="chart_heading mb-3">
                            <h4>চলতি মাসে সদস্য ভর্তি হয়েছে <span id="totalClientADD"></span> জন </h4>
                        </div>
                        <div>
                            <canvas id="client_add_chart"></canvas>
                        </div>
                    </div>
                    <div class="close_client_chart p-4">
                        <div class="chart_heading mb-3">
                            <h4>চলতি মাসে সদস্য ক্লোজ হয়েছে <span id="totalClientClose"></span> জন </h4>
                        </div>
                        <div>
                            <canvas id="client_close_chart"></canvas>
                        </div>
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
        var depositDate = [];
        var deposit = [];
        var withdrawalDates = [];
        var withdrawal = [];
        var DPSDates = [];
        var DPS = [];
        var clientAddDates = [];
        var clientAdd = [];
        var savingsCloseDates = [];
        var savingsClose = [];

        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let periodID = urlParams.get('period');

        if (periodID != null) {

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
                                $("#activeSavings").text(value.activeSavings);
                                $("#deactiveSavings").text(value.deactiveSavings);
                                $("#breadcrumb_name").text(value.fieldName);
                            })
                        } else {
                            $("#activeSavings").text(0);
                            $("#deactiveSavings").text(0);
                        }
                    }
                })
            }

            function totalCharts() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        totalChart: 1,
                        fieldID: null,
                        centerID: null,
                        periodID: periodID
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data != false) {
                            $.each(data, function(key, value) {
                                if (value.totalSavings == null) {
                                    $("#total_savings_chart").text("00");
                                } else {
                                    $("#total_savings_chart").text(value.totalSavings);
                                }

                                if (value.totalSavingWithdraw == null) {
                                    $("#total_savings_withdraw_chart").text("00");
                                } else {
                                    $("#total_savings_withdraw_chart").text(value.totalSavingWithdraw);
                                }

                                if (value.totalClientADD == null) {
                                    $("#totalClientADD").text("00");
                                } else {
                                    $("#totalClientADD").text(value.totalClientADD);
                                }

                                if (value.totalClientClose == null) {
                                    $("#totalClientClose").text("00");
                                } else {
                                    $("#totalClientClose").text(value.totalClientClose);
                                }
                            })
                        } else {
                            $("#total_savings_chart").text('0');
                            $("#total_DPS_chart").text('0');
                            $("#total_savings_withdraw_chart").text('0');
                            $("#totalClientADD").text('0');
                            $("#totalClientClose").text('0');
                        }
                    }
                })
            }

            function savingChart() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        savingChart: 1,
                        fieldID: null,
                        centerID: null,
                        periodID: periodID
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        $.each(data, function(key, value) {
                            var D = new Date(value.created_at_date);
                            depositDate.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                            deposit.push(value.deposit);
                        });

                        // Savings Data Chart
                        const savings_labels = depositDate;

                        const savings_data = {
                            labels: savings_labels,
                            datasets: [{
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 205, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(201, 203, 207, 1)'
                                ],
                                borderColor: '#695cfe',
                                color: '#fff',
                                data: deposit,
                            }]
                        };

                        const savings_config = {
                            type: 'bar',
                            data: savings_data,
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

                        const savings_chart = new Chart(
                            document.querySelector('#savings_chart'),
                            savings_config
                        );
                    }
                })
            }

            function savingWithdrawalChart() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        savingWithdrawalChart: 1,
                        fieldID: null,
                        centerID: null,
                        periodID: periodID
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        $.each(data, function(key, value) {
                            var D = new Date(value.created_at);
                            withdrawalDates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                            withdrawal.push(value.withdrawal);
                        });

                        // withdraw Data Chart
                        const withdraw_labels = withdrawalDates;

                        const withdraw_data = {
                            labels: withdraw_labels,
                            datasets: [{
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(201, 203, 207, 1)',
                                    'rgba(255, 205, 86, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',

                                ],
                                borderColor: '#695cfe',
                                color: '#fff',
                                data: withdrawal,
                            }]
                        };

                        const withdraw_config = {
                            type: 'bar',
                            data: withdraw_data,
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

                        const withdraw_chart = new Chart(
                            document.querySelector('#withdraw_chart'),
                            withdraw_config,
                        );
                    }
                })
            }

            function clientAddChart() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        clientAddChart: 1,
                        fieldID: null,
                        centerID: null,
                        periodID: periodID
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        $.each(data, function(key, value) {
                            var D = new Date(value.created_at);
                            clientAddDates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                            clientAdd.push(value.clientAdd);
                        });

                        // Client Add Data Chart
                        const client_add_data = {
                            labels: clientAddDates,
                            datasets: [{
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(201, 203, 207, 1)',
                                    'rgba(255, 205, 86, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',

                                ],
                                borderColor: '#695cfe',
                                color: '#fff',
                                data: clientAdd,
                            }]
                        };

                        const client_add_config = {
                            type: 'line',
                            data: client_add_data,
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
                                            text: "জন",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        };

                        const client_add_chart = new Chart(
                            document.querySelector('#client_add_chart'),
                            client_add_config
                        );
                    }
                })
            }

            function savingsCloseChart() {
                $.ajax({
                    url: "codes/fieldDataAuthenticate.php",
                    type: "POST",
                    data: {
                        savingsCloseChart: 1,
                        fieldID: null,
                        centerID: null,
                        periodID: periodID
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        $.each(data, function(key, value) {
                            var D = new Date(value.closing_at);
                            savingsCloseDates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                            savingsClose.push(value.savingsClose);
                        });

                        // Client Close Data Chart
                        const client_close_data = {
                            labels: savingsCloseDates,
                            datasets: [{
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(201, 203, 207, 1)',
                                    'rgba(255, 205, 86, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',

                                ],
                                borderColor: '#695cfe',
                                color: '#fff',
                                data: savingsClose,
                            }]
                        };

                        const client_close_config = {
                            type: 'line',
                            data: client_close_data,
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
                                            text: "জন",
                                            color: '#fff',
                                        }
                                    }
                                }
                            },
                        };

                        const client_close_chart = new Chart(
                            document.querySelector('#client_close_chart'),
                            client_close_config
                        );
                    }
                })
            }


            cardLoad();
            totalCharts();
            savingChart();
            savingWithdrawalChart();
            clientAddChart();
            savingsCloseChart();
        } else {
            $(location).attr('href', 'http://localhost/gkcsl/404');
        }
    })
</script>
</body>

</html>