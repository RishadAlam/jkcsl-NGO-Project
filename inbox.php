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
                <li class="breadcrumb-item active" aria-current="page">ইনবক্স</li>
            </ol>
        </nav>
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
                            <h4>ইনবক্স</h4>
                        </div>
                        <div>
                            <table id="account_list" class="table table-bordered table-hover table-striped display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th style="width:5%">#</th>
                                        <th style="width:10%">তারিখ</th>
                                        <th style="width:15%">অফিসার</th>
                                        <th style="width:20%">বিষয়</th>
                                        <th style="width:45%">বিস্তারিত</th>
                                        <th style="width:5%">ভিউ</th>
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
    $(document).ready(function() {
        $('#account_list').DataTable({
            // "processing": true,
            // "serverSide": true,
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
            "order": [],
            "searching": true,
            "ajax": {
                url: "codes/inboxAuthenticate.php",
                type: "POST"
            }
        });
    })

    $(document).on("click", "#notif_view", function() {
        var id = $(this).data("id");
        if ($(this).children("#msgView").html() != "<i class='bx bx-envelope' ></i>") {
            $(this).children("#msgView").html("<i class='bx bx-envelope-open'></i>");
            $(this).children("#msgView").removeClass("text-warning");
            $(this).children("#msgView").addClass("text-secondary");
        }
        
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                message_id: id
            },
            success: function(data) {
                $("#modal_body").html(data);
            }
        })
    })
</script>
</body>

</html>