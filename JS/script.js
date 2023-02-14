$(document).ready(function(){
    // toggle Sidebar
    $("#toggle").on("click", function(){
        $("#sidebar").toggleClass("close-btn");
    })
    $(".t_toggle").on("click", function(){
        $("#sidebar").toggleClass("close-btn");
    })
    $("#m_toggle").on("click", function(){
        $("#sidebar").toggleClass("close-btn");
    })

    // dropdown menu
    $(".dropdown>a").on("click", function(){
        if($(this).siblings("ul").attr("class") == "dropdown-m"){
            $(this).siblings("ul").removeClass("dropdown-m");
        }else{
            $(".dropdown>ul").removeClass("dropdown-m");
            $(this).siblings("ul").addClass("dropdown-m");
        }
    })

    // full Screen button
    $("#open_full_screen").on("click", function(){
        $(this).hide();
        $("#close_full_screen").show();
    })
    $("#close_full_screen").on("click", function(){
        $(this).hide();
        $("#open_full_screen").show();
    })

    // Custom Select
    $('select').select2({
        width: 'resolve',
        placeholder: "নির্বাচন করুন...",
        // allowClear: true,
        searchInputPlaceholder: 'সার্চ করুণ...'
    });

    // if outside click selectbox wil be closed
    $(document).on("click", function(){ 
        $(".select_btn").siblings(".content").removeClass("dropdown-m");
        $(".select_btn").children("i").css({"transform": "rotate(0deg)"});
    });

    // when click on label value will be assign
    $(".content>.option>li>label").on("click", function(){
        $(this).parents(".content").siblings(".select_btn").children("span").text($(this).text());
        $(this).parents(".content").removeClass("dropdown-m");
    })

    // Date And Time
    function showTime(){
        var date = new Date();
        
        var h = date.getHours();
        var m = date.getMinutes();
        var s = date.getSeconds();
        var session = "AM";
        var d = date.getDate();
        var M = date.getMonth() + 1;
        var y = date.getFullYear();
        var weekday = ["রবিবার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","শনিবার"];
        var day = weekday[date.getDay()];
        
        if(h >= 12){
            session = "PM";
        }
        if(h == 12){
            h = 12;
        }
        if(h > 12){
            h = h - 12;
        }
        if(h < 10){
            h = "0" + h;
        }
        if(m < 10){
            m = "0" + m;
        }
        if(s < 10){
            s = "0" + s;
        }
        if(d < 10){
            d = "0" + d;
        }
        if(M < 10){
            M = "0" + M;
        }

        var t_day = day;
        var t_date = d + "/" + M + "/" + y;
        var t_time = h + ":" + m + ":" + s + " " + session;
        $("#day").html(t_day);
        $("#date").html(t_date);
        $(".date").html(t_date);
        $("#time").html(t_time);
        setTimeout(showTime, 1000);
        
    }
    showTime();

    // backgound change
    $("input[name='backgound']").on("change", function (){
        let bg = $(this).val();
        $("body").css({
            background: 'url(./img/' + bg + ')',
            backgroundPosition: 'center',
            backgroundSize: 'cover',
            backgroundRepeat: 'no-repeat',
        });
    })

    // Time picker
    $('#timepickerstart').mdtimepicker({
        format:'h:mm tt',
    });
    $('#timepickerend').mdtimepicker({
        format:'h:mm tt',
    });

    // Table
    $('#recent_loan_collection').DataTable();
    $('#recent_savings_collection').DataTable();
    $('#salary_list').DataTable();
    $('#collection_report').DataTable();
    $('#deactivate_frd').DataTable();
    $('#fdr_interest_list').DataTable();
    $('#withdrawal_table').DataTable();
    $('#officers_collection_table').DataTable();
    $('#savings_account_list').DataTable();
    $('#loan_account_list').DataTable();
    $('#loan_giving_list').DataTable();
    $('#client_add_list').DataTable();
    $('#loan_checking_account_list').DataTable();

    // Back to Top Button
    $('#main').scroll(function () {
        let scrTop = $("#main").scrollTop();

        if (scrTop > 100) {
            $(".topbar").addClass('fixed');
          $("#top_btn").fadeIn(500);
        } else {
            $(".topbar").removeClass('fixed');
          $("#top_btn").fadeOut(500);
        }
    });

    $("#top_btn").on("click", function(){
        $("#main").animate(
            {
                scrollTop : 0
            }, 1000
        )
    })

    function filePreviewClient(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#client_image + img').remove();
                $('#client_image').html('<img id="image" src="'+e.target.result+'" style="width: 150px;" />');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }  
    $("#client_pic").change(function () {
        filePreviewClient(this);
    });

    // Nominee Image
    function filePreviewNominee(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#nominee_image + img').remove();
                $('#nominee_image').html('<img id="image" src="'+e.target.result+'" style="width: 150px;" />');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }  
    $("#nominee_pic").change(function () {
        filePreviewNominee(this);
    });
    
    // // scroll Bar
    new PerfectScrollbar('#main', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20,
        suppressScrollX: true,
        handlers: ['click-rail', 'drag-thumb', 'keyboard', 'wheel', 'touch'],
    });
    new PerfectScrollbar('.scrollbar', {
        wheelSpeed: 1,
        wheelPropagation: true,
        minScrollbarLength: 10,
        suppressScrollX: true,
        handlers: ['click-rail', 'drag-thumb', 'keyboard', 'wheel', 'touch'],
    });

    // date range Picker
    $(function() {

        var start = moment().startOf('month');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'আজ': [moment(), moment()],
            'গতকাল': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'গত ৭ দিন': [moment().subtract(6, 'days'), moment()],
            'গত 30 দিন': [moment().subtract(29, 'days'), moment()],
            'চলতি মাস': [moment().startOf('month'), moment()],
            'গত মাস': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'গত ৩৬৫ দিন': [moment().subtract(365, 'days'), moment()],
            // 'Life Time': [moment().startOf('1')]
            }
        }, cb);

        cb(start, end);

    });
});
