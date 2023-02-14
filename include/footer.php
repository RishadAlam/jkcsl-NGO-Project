<!-- Footer -->
<div class="footer mt-3">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6 text-start">
                <P>All Rights Reserved by RISHAD ALAM</P>
            </div>
            <div class="col-md-6 text-center text-md-end"><a href="#">জনকল্যাণ কর্মজীবি কো-অপারেটিভ সোসাইটি লিমিটেড</a></div>
        </div>
    </div>
</div>
</section>

<!-- back to top -->
<div id="top_btn" class="back_to_top">
    <a><span><i class='bx bxs-chevron-up-circle'></i></span></a>
</div>


<!-- jQuery 3.6 -->
<script src="./JS/jquery-3.6.0.min.js"></script>

<!-- bootstrap -->
<script src="./JS/bootstrap.min.js"></script>
<!-- Tabs -->
<script src="./JS/AddTabs.js"></script>
<!-- font Aowsome -->
<script src="./JS/all.min.js"></script>
<!-- Custom Scrolling -->
<script type="text/javascript" src="./JS/perfect-scrollbar.min.js"></script>
<!-- Box Icon -->
<script src="./JS/boxicons.js"></script>
<!-- waypoints -->
<script src="./JS/jquery.waypoints.min.js"></script>
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> -->
<!-- Counter Up -->
<script src="./JS/jquery.counterup.min.js"></script>
<!-- <script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"> </script> -->
<!-- Data Table -->
<script src="./JS/jquery.dataTables.min.js"></script>
<script src="./JS/dataTables.responsive.min.js"></script>
<!-- Date Range Picker -->
<script type="text/javascript" src="./JS/moment.min.js"></script>
<script type="text/javascript" src="./JS/daterangepicker.min.js"></script>
<!-- Time picker -->
<script src="./JS/mdtimepicker.min.js"></script>
<!-- Tail Select -->
<script src="./JS/tail.select.min.js"></script>
<!-- Charts -->
<script src="./JS/chart.js"></script>
<!-- Select2 -->
<script src="./JS/select2.min.js"></script>
<!-- Sweet Alert -->
<script src="./JS/sweetalert.min.js"></script>
<script src="./JS/sweetalert2@11.js"></script>
<!-- main script -->
<script src="./JS/script.js"></script>
<!-- My script -->
<script type="text/javascript">
    var elem = document.documentElement;

    /* View in fullscreen */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    }

    /* Close fullscreen */
    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }

    // PreLoader
    window.onload = function() {
        //hide the preloader
        // $('.counter_up').counterUp({
        //     delay: 20,
        //     time: 2000
        // });
        document.querySelector("#preloader").style.display = "none";
        document.querySelector("#overlayer").style.display = "none";

    }

    var allFields = document.querySelectorAll(".input_field");
    for (var i = 0; i < allFields.length; i++) {

        allFields[i].addEventListener("keyup", function(event) {

            if (event.keyCode === 13) {
                console.log('Enter clicked')
                event.preventDefault();

                if (this.parentElement.nextElementSibling.querySelector('.input_field')) {
                    this.parentElement.nextElementSibling.querySelector('.input_field').focus();
                }
            }
        });

    }
</script>
<script>
    $(document).ready(function() {
        $.getJSON('json/district.json', function(result) {
            var districts = "<option selected disabled>জেলা নির্বাচন করুন...</option>";
            $.each(result.districts, function(key, value) {
                districts += "<option value='" + value.bn_name + "'>" + value.bn_name + "</option>";
            })
            $(".districts").html(districts);
        })

        function bell() {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    bell: 1
                },
                success: function(data) {
                    if (data != false) {
                        if(data > 99){
                            $("#total_notif").text('99+').show();
                        }else{
                            $("#total_notif").text(data).show();
                        }
                    } else {
                        $("#total_notif").hide();
                    }
                }
            })
            setTimeout(bell, 3000000);
        }
        bell();

        $("#notif_bell").on("click", function() {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    bell: 2
                },
                success: function(data) {
                    // console.log(data);
                    if (data != false) {
                        $("#notif_list").html("");
                        $("#notif_list").html(data);
                    }
                }
            })
        })

        $("#liveSearch").on("keyup", function() {
            var inquery = $(this).val();
            // console.log(inquery);
            if (inquery != "") {
                $.ajax({
                    url: "codes/loadFunction.php",
                    type: "POST",
                    data: {
                        inquery: inquery
                    },
                    success: function(data) {
                        console.log(data);
                        if (data != false) {
                            $("#liveSearchBody").html("");
                            $(".searchBox").fadeIn();
                            $("#liveSearchBody").html(data);
                        } else {
                            $("#liveSearchBody").html("");
                            $(".searchBox").fadeOut();
                        }
                    }
                })
            } else {
                $(".searchBox").fadeOut();
                $("#liveSearchBody").html("");
            }
        })
    })
</script>