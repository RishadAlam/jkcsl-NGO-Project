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
                <li class="breadcrumb-item active" aria-current="page">সকল অফিসার</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Officers -->
<div class="cofficers">
    <div class="container-fluid">
        <div class="row" id="allofficer">

        </div>
    </div>
</div>



<?php
include "include/footer.php";
?>
<script>
    officerLoad();

    function officerLoad() {
        $.ajax({
            url: "codes/loadFunction.php",
            type: "POST",
            data: {
                allofficer: 1
            },
            success: function(data) {
                // console.log(data);
                $("#allofficer").html(data);
            }
        })
    }
</script>
</body>

</html>