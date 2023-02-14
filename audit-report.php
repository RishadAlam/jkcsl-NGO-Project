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
                <li class="breadcrumb-item active" aria-current="page">অডিট রিপোর্ট</li>
            </ol>
        </nav>
    </div>
</div>

<!-- audit -->
<div class="audit">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="audit_table p-3">
                    <div class="audit_heading text-center my-3">
                        <h3 class="fw-bolder">সাধারণ সঞ্চয়</h3>
                    </div>
                    <div class="audit_savings_table">
                        <table class="table table-responsive table-striped" id="savingsBody">
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="audit_table p-3">
                    <div class="audit_heading  text-center my-3">
                        <h3 class="fw-bolder">ঋণ সঞ্চয়</h3>
                    </div>
                    <div class="audit_savings_table">
                        <table class="table table-responsive table-striped" id="loanSavingsBody">
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-3">
                <div class="audit_table p-3" style="overflow-x: auto;">
                    <div class="audit_heading  text-center my-3">
                        <h3 class="fw-bolder">ঋণ</h3>
                    </div>
                    <div class="audit_savings_table">
                        <table class="table table-responsive table-striped" id="loansBody">
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="audit_table p-3">
                    <div class="audit_heading  text-center my-3">
                        <h3 class="fw-bolder">সর্বমোট সঞ্চয়</h3>
                    </div>
                    <div class="audit_savings_table">
                        <table class="table table-responsive table-striped" id="totalSavingsBody">
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="audit_table p-3">
                    <div class="audit_heading  text-center my-3">
                        <h3 class="fw-bolder">সর্বশেষ হিসাব</h3>
                    </div>
                    <div class="audit_savings_table">
                        <table class="table table-responsive table-striped" id="finalBody">
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

        function SavingsLoad() {
            $.ajax({
                url: "codes/auditAuthenticate.php",
                type: "POST",
                data: {
                    savings: 1
                },
                success: function(data) {
                    // console.log(data);
                    if (data != false) {
                        $("#savingsBody").html(data);
                    }
                }
            })
        }
        SavingsLoad();

        function loanSavingsLoad() {
            $.ajax({
                url: "codes/auditAuthenticate.php",
                type: "POST",
                data: {
                    loanSavings: 1
                },
                success: function(data) {
                    // console.log(data);
                    if (data != false) {
                        $("#loanSavingsBody").html("");
                        $("#loanSavingsBody").html(data);
                    }
                }
            })
        }
        loanSavingsLoad();

        function loansLoad() {
            $.ajax({
                url: "codes/auditAuthenticate.php",
                type: "POST",
                data: {
                    loans: 1
                },
                success: function(data) {
                    // console.log(data);
                    if (data != false) {
                        $("#loansBody").html('');
                        $("#loansBody").html(data);
                    }
                }
            })
        }
        loansLoad();

        function totalSavingsLoad() {
            $.ajax({
                url: "codes/auditAuthenticate.php",
                type: "POST",
                data: {
                    totalSavings: 1
                },
                success: function(data) {
                    if (data != false) {
                        $("#totalSavingsBody").html('');
                        $("#totalSavingsBody").html(data);
                    }
                }
            })
        }
        totalSavingsLoad();

        function finalAuditLoad() {
            $.ajax({
                url: "codes/auditAuthenticate.php",
                type: "POST",
                data: {
                    finalAudit: 1
                },
                success: function(data) {
                    if (data != false) {
                        $("#finalBody").html('');
                        $("#finalBody").html(data);
                    }
                }
            })
        }
        finalAuditLoad();


    })
</script>
</body>

</html>