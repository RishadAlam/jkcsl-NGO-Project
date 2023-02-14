<?php
include "include/header.php";
include "include/sidebar.php";
include "include/topbar.php";
?>

<!-- Breadcrumb -->
<div id="breadcrumb">
    <div class="container_fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="./index.html">ড্যাশবোর্ড</a></li>
                <li class="breadcrumb-item active" aria-current="page">সেটিংস</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Expance account statement -->
<div class="settings my-3">
    <div class="container-fluid">
        <div class="row">
            <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                <div class="col-md-6">
                    <div class="table">
                        <div class="recent_collection">
                            <div class="table_heading mt-3">
                                <h4 style="font-size: 22px;">প্রাথমিক সেটিংস</h4>
                            </div>
                            <div class="web_settings">
                                <form id="primarySettings">
                                    <div class="img text-center">
                                        <div class="text-center">
                                            <label id="client_image" for="client_pic"><img id="image" class=" rounded-circle" style="width: 150px;" src="" alt="log"></label>
                                            <input type="hidden" name="old_logo" id="old_logo" />
                                            <input class="d-none" type="file" id="client_pic" name="logo" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="org_name" class="pb-2">প্রতিষ্ঠানের নাম</label>
                                        <input type="text" style="color: #000 !important; text-indent: 5px;" class="form-control form-input p-3" value="জনকল্যাণ কর্মজীবি কো-অপারেটিভ সোসাইটি লিমিটেড" id="org_name" name="siteName">
                                        <div id="org_name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                            প্রতিষ্ঠানের নাম লিখুন
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="timepickerstart" class="pb-2">কালেকশন শুরু হবে</label>
                                            <input type="text" style="color: #000 !important; text-indent: 5px;" class="form-control form-input p-3" id="timepickerstart" name="timeStart" />
                                        </div>
                                        <div class="col-6">
                                            <label for="timepickerend" class="pb-2">কালেকশন শেষ হবে</label>
                                            <input type="text" style="color: #000 !important; text-indent: 5px;" class="form-control form-input p-3" id="timepickerend" name="timeEnd" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn form-control rounded btn-button mt-3">আপডেট</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table">
                        <div class="recent_collection">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4 style="font-size: 22px;">অফিসার সেটিংস</h4>
                            </div>
                            <table class="table table-responsive table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>নাম</th>
                                        <th>স্ট্যাটাস</th>
                                        <th>একশন</th>
                                    </tr>
                                </thead>
                                <tbody id="officersBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading mt-3">
                            <h4 style="font-size: 22px;">বেকগ্রাউন্ড সেটিংস</h4>
                        </div>
                        <div class="web_settings">
                            <form id="bg_theme" class="clearfix">
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-1" value="background_1.jpg">
                                    <label class="form-check-label" for="bg-1">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_1.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-2" value="background_2.webp">
                                    <label class="form-check-label" for="bg-2">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_2.webp" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-3" value="background_3.jpg">
                                    <label class="form-check-label" for="bg-3">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_3.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-4" value="background_4.jpg">
                                    <label class="form-check-label" for="bg-4">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_4.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-5" value="background_5.jpg">
                                    <label class="form-check-label" for="bg-5">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_5.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-6" value="background_6.jpg">
                                    <label class="form-check-label" for="bg-6">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_6.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-7" value="background_7.jpg">
                                    <label class="form-check-label" for="bg-7">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_7.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-8" value="background_8.jpg">
                                    <label class="form-check-label" for="bg-8">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_8.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-9" value="background_9.jpg">
                                    <label class="form-check-label" for="bg-9">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_9.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check" style="float: left; padding: 8px;">
                                    <input class="form-check-input" type="radio" hidden name="backgound" id="bg-10" value="background_10.jpg">
                                    <label class="form-check-label" for="bg-10">
                                        <div class="img">
                                            <img style="width: 120px; height: 100px;" src="./img/background_10.jpg" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div id="bg-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    ছবি নির্বাচন করুন
                                </div>
                                <button type="submit" class="btn form-control rounded btn-button mt-3">আপডেট</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($_SESSION['auth']['user_role'] == false) { ?>
                <div class="col-md-12">
                    <div class="table">
                        <div class="recent_collection overflow-auto">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4 style="font-size: 22px;">ফিল্ড সেটিংস</h4>
                            </div>
                            <table class="table table-responsive table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ফিল্ড</th>
                                        <th>মন্তব্য</th>
                                        <th>স্ট্যাটাস</th>
                                        <th>ইডিট</th>
                                        <th>একশন</th>
                                    </tr>
                                </thead>
                                <tbody id="fieldBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table">
                        <div class="recent_collection overflow-auto">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4 style="font-size: 22px;">কেন্দ্র সেটিংস</h4>
                            </div>
                            <table class="table table-responsive table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>কেন্দ্র</th>
                                        <th>মন্তব্য</th>
                                        <th>স্ট্যাটাস</th>
                                        <th>ইডিট</th>
                                        <th>একশন</th>
                                    </tr>
                                </thead>
                                <tbody id="centerBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table">
                        <div class="recent_collection overflow-auto">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4 style="font-size: 22px;">ক্ষেত্র সেটিংস</h4>
                            </div>
                            <table class="table table-responsive table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ক্ষেত্র</th>
                                        <th>মন্তব্য</th>
                                        <th>কালেকশন টাইপ</th>
                                        <th>সঞ্চয়/ঋণ</th>
                                        <th>স্ট্যাটাস</th>
                                        <th>ইডিট</th>
                                        <th>একশন</th>
                                    </tr>
                                </thead>
                                <tbody id="periodsBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="show_messages">
    <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ইডিট ফরম</h5>
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
        loadSettings();

        function loadSettings() {
            $.ajax({
                url: "codes/settingAuthenticate.php",
                type: "POST",
                data: {
                    settings: 1
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $.each(data, function(key, value) {
                        $("#old_logo").val(value.logo);
                        $("#image").attr("src", "<?= baseUrl('/') ?>img/" + value.logo);
                        $("#org_name").val(value.site_name);
                        $("#timepickerstart").val(value.time_start);
                        $("#timepickerend").val(value.time_end);

                    })
                }
            })
        }

        // BAckground Image
        $("#bg_theme").on("submit", function(e) {
            e.preventDefault();
            var img = $("input[type=radio]:checked").val();
            console.log(img);

            if (img == "" || img == null) {
                $("#bg-feedback").css("display", "inline-block");
            } else {
                $.ajax({
                    url: "codes/settingAuthenticate.php",
                    type: "POST",
                    data: {
                        bgImg: img
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "বেকগ্রাউন্ড পরিবর্তন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        } else {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "বেকগ্রাউন্ড পরিবর্তন হয়নি। আবার চেষ্টা করুন",
                                icon: 'error',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                    }
                })
            }
        })

        $("#primarySettings").on("submit", function(e) {
            e.preventDefault();

            var logo = $("#client_pic").val();
            var org_name = $("#org_name").val();
            var timeStart = $("#timepickerstart").val();
            var timeEnd = $("#timepickerend").val();

            if (org_name == null || org_name == "") {
                $("#org_name").addClass("is-invalid");
                $("#org_name-feedback").css("display", "block");
            }

            if (org_name != "" && org_name != null) {
                var formData = new FormData(this);
                $.ajax({
                    url: "codes/settingAuthenticate.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == "image_ext_error") {
                            swal.fire({
                                title: "নিচে দেয়া ফরমেটের ছবি ব্যবহার করুন",
                                text: "'jpg', 'jpeg', 'png', 'webp'",
                                icon: "error",
                                buttons: "Cancel",
                                dangerMode: true,
                            })
                        }
                        if (data == "image_size_error") {
                            swal.fire({
                                title: "২ এমবির ছোট ছবি ব্যবহার করুন",
                                text: "",
                                icon: "error",
                                buttons: "Cancel",
                                dangerMode: true,
                            })
                        }
                        if (data == 1) {
                            loadSettings();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "প্রাথমিক সেটিংস সম্পন্ন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "প্রাথমিক সেটিংস সম্পন্ন হয়নি। আবার চেষ্টা করুন",
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
                    text: "",
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }

        })

        function loadOfficer() {
            $.ajax({
                url: "codes/settingAuthenticate.php",
                type: "POST",
                data: {
                    officer: '1'
                },
                success: function(data) {
                    $("#officersBody").html("");
                    $("#officersBody").html(data);
                }
            })
        }
        loadOfficer();

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
                    url: "codes/settingAuthenticate.php",
                    type: "POST",
                    data: {
                        officersID: id,
                        status: status
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            loadOfficer();
                        } else {
                            loadOfficer();
                            swal.fire({
                                title: "দুঃখিত",
                                text: "অফিসার আপডেট হয়নি। আবার চেষ্টা করুন",
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

        function loadField() {
            $.ajax({
                url: "codes/settingAuthenticate.php",
                type: "POST",
                data: {
                    fields: '1'
                },
                success: function(data) {
                    $("#fieldBody").html("");
                    $("#fieldBody").html(data);
                    // console.log(data);
                }
            })
        }
        loadField();

        $(document).on("click", "input[name='fieldAction']", function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr("id");
                var status = '1';
            } else {
                var id = $(this).attr("id");
                var status = '0';
            }

            if (id != "") {
                $.ajax({
                    url: "codes/settingAuthenticate.php",
                    type: "POST",
                    data: {
                        fieldID: id,
                        status: status
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            loadField();
                        } else {
                            loadField();
                            swal.fire({
                                title: "দুঃখিত",
                                text: "ফিল্ড আপডেট হয়নি। আবার চেষ্টা করুন",
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

        function loadCenter() {
            $.ajax({
                url: "codes/settingAuthenticate.php",
                type: "POST",
                data: {
                    center: '1'
                },
                success: function(data) {
                    $("#centerBody").html("");
                    $("#centerBody").html(data);
                    // console.log(data);
                }
            })
        }
        loadCenter();

        $(document).on("click", "input[name='centerAction']", function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr("id");
                var status = '1';
            } else {
                var id = $(this).attr("id");
                var status = '0';
            }

            if (id != "") {
                $.ajax({
                    url: "codes/settingAuthenticate.php",
                    type: "POST",
                    data: {
                        centerID: id,
                        status: status
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            loadCenter();
                        } else {
                            loadCenter();
                            swal.fire({
                                title: "দুঃখিত",
                                text: "কেন্দ্র আপডেট হয়নি। আবার চেষ্টা করুন",
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

        function loadPeriod() {
            $.ajax({
                url: "codes/settingAuthenticate.php",
                type: "POST",
                data: {
                    period: '1'
                },
                success: function(data) {
                    $("#periodsBody").html("");
                    $("#periodsBody").html(data);
                    // console.log(data);
                }
            })
        }
        loadPeriod();

        $(document).on("click", "input[name='periodAction']", function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr("id");
                var status = '1';
            } else {
                var id = $(this).attr("id");
                var status = '0';
            }

            if (id != "") {
                $.ajax({
                    url: "codes/settingAuthenticate.php",
                    type: "POST",
                    data: {
                        periodID: id,
                        status: status
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            loadPeriod();
                        } else {
                            loadPeriod();
                            swal.fire({
                                title: "দুঃখিত",
                                text: "কেন্দ্র আপডেট হয়নি। আবার চেষ্টা করুন",
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

        $(document).on("click", "#edit_load", function() {
            var id = $(this).data("id");
            var type = $(this).data("type");

            $.ajax({
                url: "codes/settingAuthenticate.php",
                type: "POST",
                data: {
                    settingsEdit: 1,
                    settingType: type,
                    id: id
                },
                success: function(data) {
                    // console.log(data);
                    $("#modal_body").html(data);
                }
            })

        })

        $("#load_edit_form").on("submit", function(e) {
            e.preventDefault();
            var name = $("#name").val();
            var type = $("#type").val();
            var id = $("#id").val();
            var dec = $("#details").val();

            // Empty Input Checking
            if (name == "" || name == null) {
                $("#name").addClass("is-invalid");
                $("#name-feedback").css("display", "block");
            }

            // Ajax Action
            if (name != "" && name != null) {
                $.ajax({
                    url: "codes/settingAuthenticate.php",
                    type: "POST",
                    data: {
                        type: type,
                        id: id,
                        name: name,
                        dec: dec
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data == 1) {
                            $("#modal_close").trigger("click");
                            loadPeriod();
                            loadCenter();
                            loadField();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "আপডেট সম্পন্ন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "আপডেট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
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
    })
</script>
</body>

</html>