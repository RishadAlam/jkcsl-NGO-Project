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
                <li class="breadcrumb-item">অফিসার</li>
                <li class="breadcrumb-item active" aria-current="page">অফিসার অনুমতি</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Savings Registration Form -->
<div class="savings_reg_form mx-auto mb-3 p-5">
    <div class="form_heading d-flex align-items-center justify-content-between my-3">
        <h2 class="text-center">অফিসার অনুমতি ফরম</h2>
        <div style="width: 350px;" class="select">
            <label for="officers">অফিসার</label>
            <select id="officers" class="form-control form-input p-3">
                <option value="null" disabled selected>অফিসার নির্বারচন করুন...</option>
            </select>
        </div>
    </div>
    <form id="userPermissionForm">
        <div class="row d-none" id="userPermission">

            <!-- checkbox Information Heading -->
            <div class="form_section_heading pb-1 shadow mb-3">
                <h4>নিবন্ধন ফরম</h4>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <input type="hidden" id="permissionID">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="regForm1" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="regForm1">
                        নতুন সদস্য নিবন্ধন ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="regForm2" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="regForm2">
                        সঞ্চয় সদস্য নিবন্ধন ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="regForm3" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="regForm3">
                        ঋণ সদস্য নিবন্ধন ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="regForm4" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="regForm4">
                        অফিসার নিবন্ধন ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="regForm5" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="regForm5">
                        ফিল্ড নিবন্ধন ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="regForm6" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="regForm6">
                        কেন্দ্র নিবন্ধন ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="regForm7" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="regForm7">
                        ক্ষেত্র নিবন্ধন ফরম
                    </label>
                </div>
            </div>

            <!-- checkbox Information Heading -->
            <div class="form_section_heading pb-1 shadow my-3">
                <h4>সংগ্রহ ফরম</h4>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="collectionForm1" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="collectionForm1">
                        সঞ্চয় সংগ্রহ ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="collectionForm2" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="collectionForm2">
                        ঋণ সংগ্রহ ফরম
                    </label>
                </div>
            </div>

            <!-- checkbox Information Heading -->
            <div class="form_section_heading pb-1 shadow my-3">
                <h4>উত্তোলন ফরম</h4>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="withdrawalForm1" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="withdrawalForm1">
                        সঞ্চয় উত্তোলন ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="withdrawalForm2" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="withdrawalForm2">
                        ঋণ-সঞ্চয় উত্তোলন ফরম
                    </label>
                </div>
            </div>

            <!-- checkbox Information Heading -->
            <div class="form_section_heading pb-1 shadow my-3">
                <h4>ক্লোজিং ফরম</h4>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="closingForm1" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="closingForm1">
                        সঞ্চয় ক্লোজিং ফরম
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="closingForm2" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="closingForm2">
                        ঋণ ক্লোজিং ফরম
                    </label>
                </div>
            </div>

            <!-- checkbox Information Heading -->
            <div class="form_section_heading pb-1 shadow my-3">
                <h4>কনট্রোল প্যানেল</h4>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="collectionReport" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="collectionReport">
                        কালেকশন রিপোর্ট
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="waitingWithdrawal" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="waitingWithdrawal">
                        অপেক্ষারত উত্তোলন
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="field" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="field">
                        ফিল্ড / কেন্দ্র / ক্ষেত্র
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="bookCheck" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="bookCheck">
                        বই চেকিং
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="expiredCollection" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="expiredCollection">
                        তামাদি কালেকশন
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="analytics" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="analytics">
                        এনালেটিক্স
                    </label>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-3">
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="checkbox" id="clientAcc" name="officerPermission" value="1">
                    <label role="button" class="form-check-label" for="clientAcc">
                        সদস্য একাউন্ট
                    </label>
                </div>
            </div>

            <!-- Form Buttons -->
            <div class="col-12">
                <button type="submit" class="btn form-control btn-button">সাবমিট করুন</button>
            </div>
        </div>
    </form>
</div>

<?php
include "include/footer.php";
?>
<script>
    $(document).ready(function() {

        function loadOfficer() {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    officer: '1'
                },
                success: function(data) {
                    $("#officers").html("");
                    $("#officers").html(data);
                }
            })
        }
        loadOfficer();

        $("#officers").on("change", function() {
            var officerID = $(this).val();

            $.ajax({
                url: "codes/officerPermissionAuthenticate.php",
                type: "POST",
                data: {
                    officerID: officerID,
                    permissonLoad: '1',
                },
                dataType: "JSON",
                success: function(data) {
                    $("#userPermissionForm").trigger('reset');
                    // console.log(data);
                    if (data != false) {
                        $("#userPermission").removeClass("d-none");
                        $.each(data, function(key, value) {
                            $("#permissionID").val(value.previlege_id);

                            if (value.regForm1 == 1) {
                                $("#regForm1").prop('checked', true);
                            }
                            if (value.regForm2 == 1) {
                                $("#regForm2").prop('checked', true);
                            }
                            if (value.regForm3 == 1) {
                                $("#regForm3").prop('checked', true);
                            }
                            if (value.regForm4 == 1) {
                                $("#regForm4").prop('checked', true);
                            }
                            if (value.regForm5 == 1) {
                                $("#regForm5").prop('checked', true);
                            }
                            if (value.regForm6 == 1) {
                                $("#regForm6").prop('checked', true);
                            }
                            if (value.regForm7 == 1) {
                                $("#regForm7").prop('checked', true);
                            }
                            if (value.collectionForm1 == 1) {
                                $("#collectionForm1").prop('checked', true);
                            }
                            if (value.collectionForm2 == 1) {
                                $("#collectionForm2").prop('checked', true);
                            }
                            if (value.withdrawalForm1 == 1) {
                                $("#withdrawalForm1").prop('checked', true);
                            }
                            if (value.withdrawalForm2 == 1) {
                                $("#withdrawalForm2").prop('checked', true);
                            }
                            if (value.closingForm1 == 1) {
                                $("#closingForm1").prop('checked', true);
                            }
                            if (value.closingForm2 == 1) {
                                $("#closingForm2").prop('checked', true);
                            }
                            if (value.collectionReport == 1) {
                                $("#collectionReport").prop('checked', true);
                            }
                            if (value.waitingWithdrawal == 1) {
                                $("#waitingWithdrawal").prop('checked', true);
                            }
                            if (value.field == 1) {
                                $("#field").prop('checked', true);
                            }
                            if (value.bookCheck == 1) {
                                $("#bookCheck").prop('checked', true);
                            }
                            if (value.expiredCollection == 1) {
                                $("#expiredCollection").prop('checked', true);
                            }
                            if (value.analytics == 1) {
                                $("#analytics").prop('checked', true);
                            }
                            if (value.clientAcc == 1) {
                                $("#clientAcc").prop('checked', true);
                            }
                        })
                    } else {
                        $("#userPermission").removeClass("d-none");
                    }
                }
            })
        })


        $("#userPermissionForm").on('submit', function(e) {
            e.preventDefault();
            var officerID = $("#officers").val();
            var permissionID = $("#permissionID").val();
            var regForm1 = 0;
            var regForm2 = 0;
            var regForm3 = 0;
            var regForm4 = 0;
            var regForm5 = 0;
            var regForm6 = 0;
            var regForm7 = 0;
            var collectionForm1 = 0;
            var collectionForm2 = 0;
            var withdrawalForm1 = 0;
            var withdrawalForm2 = 0;
            var closingForm1 = 0;
            var closingForm2 = 0;
            var collectionReport = 0;
            var waitingWithdrawal = 0;
            var field = 0;
            var bookCheck = 0;
            var expiredCollection = 0;
            var analytics = 0;
            var clientAcc = 0;

            if ($("#regForm1").is(':checked')) {
                regForm1 = 1;
            }
            if ($("#regForm2").is(':checked')) {
                regForm2 = 1;
            }
            if ($("#regForm3").is(':checked')) {
                regForm3 = 1;
            }
            if ($("#regForm4").is(':checked')) {
                regForm4 = 1;
            }
            if ($("#regForm5").is(':checked')) {
                regForm5 = 1;
            }
            if ($("#regForm6").is(':checked')) {
                regForm6 = 1;
            }
            if ($("#regForm7").is(':checked')) {
                regForm7 = 1;
            }
            if ($("#collectionForm1").is(':checked')) {
                collectionForm1 = 1;
            }
            if ($("#collectionForm2").is(':checked')) {
                collectionForm2 = 1;
            }
            if ($("#withdrawalForm1").is(':checked')) {
                withdrawalForm1 = 1;
            }
            if ($("#withdrawalForm2").is(':checked')) {
                withdrawalForm2 = 1;
            }
            if ($("#closingForm1").is(':checked')) {
                closingForm1 = 1;
            }
            if ($("#closingForm2").is(':checked')) {
                closingForm2 = 1;
            }
            if ($("#collectionReport").is(':checked')) {
                collectionReport = 1;
            }
            if ($("#waitingWithdrawal").is(':checked')) {
                waitingWithdrawal = 1;
            }
            if ($("#field").is(':checked')) {
                field = 1;
            }
            if ($("#bookCheck").is(':checked')) {
                bookCheck = 1;
            }
            if ($("#expiredCollection").is(':checked')) {
                expiredCollection = 1;
            }
            if ($("#analytics").is(':checked')) {
                analytics = 1;
            }
            if ($("#clientAcc").is(':checked')) {
                clientAcc = 1;
            }

            if ($("input[type=checkbox]").is(':checked')) {
                $.ajax({
                    url: "codes/officerPermissionAuthenticate.php",
                    type: "POST",
                    data: {
                        officerID: officerID,
                        permissonID: permissionID,
                        regForm1: regForm1,
                        regForm2: regForm2,
                        regForm3: regForm3,
                        regForm4: regForm4,
                        regForm5: regForm5,
                        regForm6: regForm6,
                        regForm7: regForm7,
                        collectionForm1: collectionForm1,
                        collectionForm2: collectionForm2,
                        withdrawalForm1: withdrawalForm1,
                        withdrawalForm2: withdrawalForm2,
                        closingForm1: closingForm1,
                        closingForm2: closingForm2,
                        collectionReport: collectionReport,
                        waitingWithdrawal: waitingWithdrawal,
                        field: field,
                        bookCheck: bookCheck,
                        expiredCollection: expiredCollection,
                        analytics: analytics,
                        clientAcc: clientAcc,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data != false) {
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "অফিসার অনুমতি সম্পন্ন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        } else {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "অফিসার অনুমতি সম্পন্ন হয়নি। আবার চেষ্টা করুন",
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
                    text: "অফিসার অনুমতি দেওয়া হয়নি । আবার চেষ্টা করুন",
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }

        })

    })
</script>
</body>

</html>