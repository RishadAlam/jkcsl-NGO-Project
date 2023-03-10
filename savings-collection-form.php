<?php
ob_start();
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
if ($collectionForm1 == 0) {
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
                <li class="breadcrumb-item">সংগ্রহ</li>
                <li class="breadcrumb-item active" aria-current="page">সঞ্চয় সংগ্রহ</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Savings input Form -->
<div class="savings_reg_form mx-auto my-5 p-5">
    <div class="form_heading mb-5">
        <h2 class="text-center">সঞ্চয় সংগ্রহ ফরম</h2>
    </div>
    <form action="" id="savings_collection_form">
        <div class="row">
            <?php if ($currentTime >= $start && $currentTime <= $end) { ?>
                <!-- Form Information Heading -->
                <div class="form_section_heading pb-1 shadow mb-3">
                    <h4>ফরমের তথ্যাবলি</h4>
                </div>

                <!-- Form Information -->
                <div class="col-md-6 mb-3 select">
                    <label for="feild" class="pb-2">ফিল্ড <span class="text-danger">*</span></label>
                    <select id="feild" class="form-control input_field form-input p-3" name="feild">
                        <option class="feild" value="null" disabled selected>ফিল্ড নির্বারচন করুন...</option>

                    </select>
                    <div id="field-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ফিল্ড নির্বাচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="center" class="pb-2">কেন্দ্র <span class="text-danger">*</span></label>
                    <select id="center" class="form-control input_field form-input p-3" name="center">
                        <option class="feild" value="null" disabled selected>কেন্দ্র নির্বারচন করুন...</option>

                    </select>
                    <div id="center-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        কেন্দ্র নির্বারচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="period" class="pb-2">সঞ্চয়ের সংগ্রহ ক্ষেত্র <span class="text-danger">*</span></label>
                    <select id="period" class="form-control input_field form-input p-3" name="period">
                        <option class="feild" value="null" disabled selected>ক্ষেত্র নির্বারচন করুন...</option>

                    </select>
                    <div id="period-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        ক্ষেত্র নির্বারচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3 select">
                    <label for="book" class="pb-2">বই নং <span class="text-danger">*</span></label>
                    <select id="book" class="form-control input_field form-input p-3" name="book">
                        <option class="feild" value="null" disabled selected>বই নির্বারচন করুন...</option>

                    </select>
                    <div id="book-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        বই নির্বারচন করুন
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="pb-2">নাম</label>
                    <input type="text" class="form-control input_field form-input p-3" placeholder="সদস্য এর নাম" id="name" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="savings" class="pb-2">সঞ্চয় (টাকা) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control input_field form-input p-3" placeholder="0000" id="savings">
                    <div id="savings-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                        সঞ্চয় পরিমাণ লিখুন
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="details" class="pb-2">মন্তব্য</label>
                    <textarea class="form-control input_field p-3" id="details" rows="3" placeholder="মন্তব্য লিখুন..."></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn form-control btn-button">সাবমিট করুন</button>
                </div>
            <?php } else { ?>
                <div class="col-md-12 text-center text-light" style="padding: 100px 0;">
                    <h1>কালেকশনের সময় শেষ হয়ে গিয়েছে।</h1>
                    <h3>কালেকশন সময় <?= $timeStart ?> হতে <?= $timeEnd ?> পর্যন্ত।</h3>
                </div>
            <?php } ?>
        </div>
    </form>
</div>

<?php
include "include/footer.php";
?>
<script>
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

    var field = "";
    $("#feild").on('change', function() {
        var field = $(this).val();
        // console.log(field);
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
    });

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
        booksload();
    });
    $("#center").on('change', function() {
        booksload();
    });

    function booksload() {
        var center = $("#center").val();
        var field = $("#feild").val();
        var period = $("#period").val();
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                cField: field,
                ccenter: center,
                cperiod: period
            },
            success: function(data) {
                // console.log(data);
                $("#book").html("");
                $("#book").html(data);
            }
        })
    }

    $("#book").on('change', function() {
        var clientID = $(this).val();
        var book = $(this).find(':selected').data('book');
        var savings_profile = $(this).find(':selected').data('savingprofile');

        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                bclientid: clientID,
                bbook: book,
                bsavings_profile: savings_profile,
            },
            dataType: "JSON",
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    $("#name").val(value.name);
                    $("#savings").val(value.deposit_installment);
                })
            }
        })
    });

    $("#savings_collection_form").on("submit", function(e) {
        e.preventDefault();
        // Form Primary Data
        var feild = $("#feild").val();
        var center = $("#center").val();
        var period = $("#period").val();
        var clientID = $("#book").val();
        var savings = $("#savings").val();
        var details = $("#details").val();
        var book = $("#book").find(':selected').data('book');
        var savings_profile = $("#book").find(':selected').data('savingprofile');

        // Form Validation
        if (feild == "" || feild == null) {
            $("#feild").addClass("is-invalid");
            $("#field-feedback").css("display", "block");
        }
        if (center == "" || center == null) {
            $("#center").addClass("is-invalid");
            $("#center-feedback").css("display", "block");
        }
        if (book == "" || book == null) {
            $("#book").addClass("is-invalid");
            $("#book-feedback").css("display", "block");
        }
        if (period == "" || period == null) {
            $("#period").addClass("is-invalid");
            $("#period-feedback").css("display", "block");
        }
        if (savings == "" || savings == null) {
            $("#savings").addClass("is-invalid");
            $("#savings-feedback").css("display", "block");
        }

        if (feild != "" && feild != null && center != "" && center != null && book != "" && book != null && period != "" && period != null && savings != "" && savings != null) {

            $.ajax({
                url: "codes/savingsCollectionAuthenticate.php",
                type: "POST",
                data: {
                    feild: feild,
                    center: center,
                    period: period,
                    clientID: clientID,
                    deposit: savings,
                    book: book,
                    savings_profile_id: savings_profile,
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
                        $("#savings").val(null);
                        $("#details").val(null);
                        $("#name").val(null);
                        booksload();
                        swal.fire({
                            title: "অভিনন্দন",
                            text: "কালেকশন সম্পন্ন হয়েছে",
                            icon: 'success',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    } else {
                        swal.fire({
                            title: "দুঃখিত",
                            text: "কালেকশন সম্পন্ন হয়নি। আবার চেষ্টা করুন",
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
</script>
</body>

</html>