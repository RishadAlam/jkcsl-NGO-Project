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
                <li class="breadcrumb-item active" aria-current="page">সেন্ড বক্স</li>
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
                    বার্তা পাঠান
                </button>

                <!-- Modal -->
                <div class="modal fade" id="expance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">বার্তা ফরম</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" id="form_close" aria-label="Close"></button>
                            </div>
                            <form id="sendbox_form">
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-6 mb-3 select">
                                            <label for="officer" class="pb-2">অফিসার <span class="text-danger">*</span></label>
                                            <select id="officer" class="form-control input_field form-input p-3">
                                                <option class="feild" value="null" disabled selected>সদস্য নির্বাচন করুন...</option>
                                            </select>
                                            <div id="officer-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                অফিসার নির্বাচন করুণ
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="sub" class="pb-2">বিষয় <span class="text-danger">*</span></label>
                                            <input type="text" style="text-indent: 0;" class="form-control input_field form-input p-3" placeholder="বার্তার বিষয় লিখুন" id="sub">
                                            <div id="sub-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                বিষয় লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="details" class="pb-2">বিস্তারিত <span class="text-danger">*</span></label>
                                            <textarea class="form-control input_field p-3" id="details" rows="3" placeholder="বিস্তারিত লিখুন..."></textarea>
                                            <div id="details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                বিস্তারিত লিখুন
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal">ক্লোজ</button>
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

<!-- Notification -->
<div class="notification my-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>বার্তা সেন্ড</h4>
                        </div>
                        <table id="sendbox_table" class="table table-bordered table-hover table-striped display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>তারিখ</th>
                                    <th>অফিসার</th>
                                    <th style="min-width: 80px;">বিষয়</th>
                                    <th>বিস্তারিত</th>
                                    <th>ভিউ</th>
                                    <th>অবস্থা</th>
                                </tr>
                            </thead>
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
                    <h5 class="modal-title" id="exampleModalLabel">মেসেজ বক্স</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal_body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal">ক্লোজ</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "include/footer.php";
?>
<script>
    function loadOfficer() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                officer: '1'
            },
            success: function(data) {
                $("#officer").html("");
                $("#officer").html(data);
            }
        })
    }
    loadOfficer();

    sendbox();

    function sendbox() {
        $('#sendbox_table').DataTable({
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
                url: "codes/sendboxAuthenticate.php",
                type: "POST"
            }
        });
    }

    $(document).on("click", "#notif_view", function() {
        var id = $(this).data("id");
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                sendmessage_id: id
            },
            success: function(data) {
                $("#modal_body").html(data);
            }
        })
    })

    $("#sendbox_form").on("submit", function(e) {
        e.preventDefault();
        // Form Primary Data
        var officer = $("#officer").val();
        var sub = $("#sub").val();
        var details = $("#details").val();

        // Form Validation
        if (officer == "" || officer == null) {
            $("#officer").addClass("is-invalid");
            $("#officer-feedback").css("display", "block");
        }
        if (sub == "" || sub == null) {
            $("#sub").addClass("is-invalid");
            $("#sub-feedback").css("display", "block");
        }
        if (details == "" || details == null) {
            $("#details").addClass("is-invalid");
            $("#details-feedback").css("display", "block");
        }

        if (officer != "" && officer != null && sub != "" && sub != null && details != "" && details != null) {

            $.ajax({
                url: "codes/fdrAuthenticate.php",
                type: "POST",
                data: {
                    officer: officer,
                    sub: sub,
                    details: details,
                },
                success: function(data) {
                    // console.log(data);
                    if (data == 1) {
                        $("#sendbox_form").trigger("reset");
                        $("select").empty().trigger('change');
                        $("#form_close").trigger("click");
                        loadOfficer();
                        sendbox();
                        swal.fire({
                            title: "অভিনন্দন",
                            text: "বার্তা প্রেরণ সম্পন্ন হয়েছে",
                            icon: 'success',
                            buttons: "OK",
                            dangerMode: true,
                        })
                    } else {
                        swal.fire({
                            title: "দুঃখিত",
                            text: "বার্তা প্রেরণ সম্পন্ন হয়নি। আবার চেষ্টা করুন",
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