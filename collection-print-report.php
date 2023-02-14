<?php include 'include/printHeader.php' ?>
<!-- Report Heading -->
<section id="reportHeading" class="mb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <span><span id="breadcrumb_name"></span> কালেকশন রিপোর্ট</span>
            </div>
            <div class="col-6 text-end">
                <span>প্রিন্ট তারিখঃ <span class="date"></span></span>
            </div>
        </div>
    </div>
</section>

<!-- Report Content -->
<section id="reportContent">
    <div class="container-fluid">
        <div class="row">
            <table class="table table-bordered table-responsive" id="report">

            </table>
        </div>
    </div>
</section>

<script src="./JS/jquery-3.6.0.min.js"></script>

<!-- bootstrap -->
<script src="./JS/bootstrap.min.js"></script>
<!-- Date Range Picker -->
<script type="text/javascript" src="./JS/moment.min.js"></script>
<script type="text/javascript" src="./JS/daterangepicker.min.js"></script>
<!-- Time picker -->
<script src="./JS/mdtimepicker.min.js"></script>
<!-- Select2 -->
<script src="./JS/select2.min.js"></script>
<!-- main script -->
<script src="./JS/script.js"></script>
<script>
    $(document).ready(function() {
        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let report = urlParams.get('report');
        var officer = urlParams.get('officer');
        var date = urlParams.get('date');
        var savings = null;
        savings = urlParams.get('savings');
        var loan = null;
        loan = urlParams.get('loan');
        var tamadiSavings = null;
        tamadiSavings = urlParams.get('tamadiSavings');
        var tamadiLoan = null;
        tamadiLoan = urlParams.get('tamadiLoan');
        var from_date = null;
        from_date = urlParams.get('from_date');
        var end_date = null;
        end_date = urlParams.get('end_date');

        let fieldID = null;
        let centerID = null;

        function cardLoad() {
            $.ajax({
                url: "codes/fieldDataAuthenticate.php",
                type: "POST",
                data: {
                    fieldCard: 1,
                    centerID: centerID,
                    periodID: report,
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

        if (savings == 1) {
            $.ajax({
                url: "codes/savingsCollectionReportPrint.php",
                type: "POST",
                data: {
                    savings: 1,
                    report: report,
                    officer: officer,
                },
                success: function(data) {
                    $("#report").html('');
                    $("#report").html(data);
                    window.print();
                }
            })
        } else if (loan == 1) {
            $.ajax({
                url: "codes/savingsCollectionReportPrint.php",
                type: "POST",
                data: {
                    loan: 1,
                    report: report,
                    officer: officer,
                },
                success: function(data) {
                    $("#report").html('');
                    $("#report").html(data);
                    window.print();
                }
            })
        } else if (tamadiSavings == 1) {
            $.ajax({
                url: "codes/savingsCollectionReportPrint.php",
                type: "POST",
                data: {
                    tamadiSavings: 1,
                    report: report,
                    officer: officer,
                    from_date: from_date,
                    end_date: end_date,
                },
                success: function(data) {
                    $("#report").html('');
                    $("#report").html(data);
                    window.print();
                }
            })
        } else if (tamadiLoan == 1) {
            $.ajax({
                url: "codes/savingsCollectionReportPrint.php",
                type: "POST",
                data: {
                    tamadiLoan: 1,
                    report: report,
                    officer: officer,
                    from_date: from_date,
                    end_date: end_date,
                },
                success: function(data) {
                    $("#report").html('');
                    $("#report").html(data);
                    window.print();
                }
            })
        }
    })
</script>
</body>

</html>