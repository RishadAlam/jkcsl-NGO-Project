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
                <li class="breadcrumb-item active" aria-current="page">খরচ</li>
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
                    খরচের ফরম
                </button>

                <!-- Modal -->
                <div class="modal fade" id="expance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">খরচের ফরম</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="daily_expence_form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="expance_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                            <input type="date" style="text-indent: 0;" class="form-control form-input p-3" placeholder="৫০" id="expance_date">
                                            <div id="date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                তারিখ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="expence" class="pb-2">খরচ (টাকা) <span class="text-danger">*</span></label>
                                            <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="খরচ লিখুন" id="expence">
                                            <div id="expence-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                খরচ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 select">
                                            <label for="details" class="pb-2">খরচের বিবরণ <span class="text-danger">*</span></label>
                                            <select id="details" class="form-control form-input p-3">
                                                <option class="feild" value="null" disabled selected>খরচের বিবরণ নির্বারচন করুন...</option>
                                                <option value="আপ্যায়ন খরচ">আপ্যায়ন খরচ</option>
                                                <option value="যাতায়াত খরচ">যাতায়াত খরচ</option>
                                                <option value="অফিস ভাড়া">অফিস ভাড়া</option>
                                                <option value="বিদ্যুৎ বিল">বিদ্যুৎ বিল</option>
                                                <option value="ষ্টেশনারী">ষ্টেশনারী</option>
                                                <option value="আসবাবপত্র">আসবাবপত্র</option>
                                                <option value="বাৎসরিক মিটিং">বাৎসরিক মিটিং</option>
                                                <option value="অন্যান্য">অন্যান্য</option>
                                            </select>
                                            <div id="details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                খরচের বিবরণ লিখুন
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="close">ক্লোজ</button>
                                    <button type="submit" class="btn rounded btn-button">সাবমিট করুন</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="expance">
                <!-- Button trigger modal -->
                <button type="button" class="btn rounded btn-button" data-bs-toggle="modal" data-bs-target="#fdr">
                    এফ.ডি.আর লভ্যাংশ ফরম
                </button>

                <!-- Modal -->
                <div class="modal fade" id="fdr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">এফ.ডি.আর ফরম</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="fdr_interest_form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fdr_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                            <input type="date" style="text-indent: 0;" class="form-control form-input p-3" placeholder="৫০" id="fdr_date">
                                            <div id="fdr_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                তারিখ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="interest" class="pb-2">লাভ (টাকা) <span class="text-danger">*</span></label>
                                            <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="এফ.ডি.আর লাভ লিখুন" id="interest">
                                            <div id="fdr_interest-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                লাভ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 select">
                                            <label for="clients" class="pb-2">এফ.ডি.আর সদস্য <span class="text-danger">*</span></label>
                                            <select id="clients" class="form-control form-input p-3">
                                                <option class="feild" value="null" disabled selected>সদস্য নির্বাচন করুন...</option>
                                            </select>
                                            <div id="fdr_details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                এফ.ডি.আর সদস্য নির্বাচন করুন
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="fdr_close">ক্লোজ</button>
                                    <button type="submit" class="btn rounded btn-button">সাবমিট করুন</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="expance">
                <!-- Button trigger modal -->
                <button type="button" class="btn rounded btn-button" data-bs-toggle="modal" data-bs-target="#salery">
                    বেতনের ফরম
                </button>

                <!-- Modal -->
                <div class="modal fade" id="salery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">বেতনের ফরম</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="salary_reg_form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="salary_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                            <input type="date" style="text-indent: 0;" class="form-control form-input p-3" placeholder="৫০" id="salary_date">
                                            <div id="salary_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                তারিখ লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="salary" class="pb-2">বেতন (টাকা) <span class="text-danger">*</span></label>
                                            <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="বেতন লিখুন" id="salary">
                                            <div id="salary-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                বেতন লিখুন
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 select">
                                            <label for="officer" class="pb-2">অফিসার <span class="text-danger">*</span></label>
                                            <select id="officer" class="form-control form-input p-3">
                                            </select>
                                            <div id="officer-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                                অফিসার নির্বাচন করুন
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="salary_close">ক্লোজ</button>
                                    <button type="submit" class="btn rounded btn-button">সাবমিট করুন</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="salary_acc_chart p-4">
                    <div class="chart_heading mb-3">
                        <h4>চলতি মাসে এফ.ডি.আর লভ্যাংশ প্রদান <span id="fdr_expence"></span> টাকা</h4>
                    </div>
                    <div>
                        <canvas id="fdr_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="salary_acc_chart p-4">
                    <div class="chart_heading mb-3">
                        <h4>চলতি মাসে বেতন প্রদান <span id="salary_expence"></span> টাকা</h4>
                    </div>
                    <div>
                        <canvas id="salary_acc_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="expance_acc_chart p-4">
                    <div class="chart_heading mb-3">
                        <h4>চলতি মাসে খরচ <span id="daily_expence"></span> টাকা</h4>
                    </div>
                    <div>
                        <canvas id="expance_acc_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="expance_acc_chart p-4">
                    <div class="chart_heading mb-3">
                        <h4>চলতি মাসে বই ক্লোজিং লভ্যাংশ <span id="closing_book_expence"></span> টাকা</h4>
                    </div>
                    <div>
                        <canvas id="closing_book_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Expance account statement -->
<div class="expance_account_statment my-3">
    <div class="container-fluid">
        <div class="text-end">
            <div id="reportrange" style="display: inline-block; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span id="date_range"></span> <i class="fa fa-caret-down"></i>
            </div>
            <input type="hidden" class="dateField">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>খরচের বিবৃতি</h4>
                            <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                        </div>
                        <table id="expance_list" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>তারিখ</th>
                                    <th>মন্তব্য</th>
                                    <th>খরচ</th>
                                    <th>ইডিট</th>
                                    <th>ডিলিট</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end" style="border-top: 1px solid #fff;">সর্বমোট</td>
                                    <td colspan="3" style="border-top: 1px solid #fff;"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>বেতনের বিবৃতি</h4>
                            <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                        </div>
                        <table id="salary_list" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>তারিখ</th>
                                    <th>অফিসার</th>
                                    <th>বেতন</th>
                                    <th>ইডিট</th>
                                    <th>ডিলিট</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end" style="border-top: 1px solid #fff;">সর্বমোট</td>
                                    <td colspan="3" style="border-top: 1px solid #fff;"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>এফ.ডি.আর লাভের বিবৃতি</h4>
                            <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                        </div>
                        <table id="fdr_interest_list" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>তারিখ</th>
                                    <th>সদস্য</th>
                                    <th>লভ্যাংশ</th>
                                    <th>ইডিট</th>
                                    <th>ডিলিট</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end" style="border-top: 1px solid #fff;">সর্বমোট</td>
                                    <td colspan="3" style="border-top: 1px solid #fff;"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table">
                    <div class="recent_collection">
                        <div class="table_heading d-flex align-items-center justify-content-between my-3">
                            <h4>বই ক্লোজিং লাভের বিবৃতি</h4>
                            <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                        </div>
                        <table id="closing_book_interest_list" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>তারিখ</th>
                                    <th>বিস্তারিত</th>
                                    <th>লভ্যাংশ</th>
                                    <th>ইডিট</th>
                                    <th>ডিলিট</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end" style="border-top: 1px solid #fff;">সর্বমোট</td>
                                    <td colspan="3" style="border-top: 1px solid #fff;"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Editing Modals -->
<div class="show_messages">
    <div class="modal fade" id="message1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">খরচ ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="income_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                <input type="hidden" id="expance1Updateid">
                                <input type="date" style="text-indent: 0;" class="form-control form-input p-3" id="up_income_date">
                                <div id="up_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    তারিখ লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="income" class="pb-2">খরচ (টাকা) <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="টাকা লিখুন" id="up_income">
                                <div id="up_income-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    খরচ লিখুন
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 select">
                                <label for="details" class="pb-2">খরচের বিবরণ <span class="text-danger">*</span></label>
                                <select id="up_details" class="form-control form-input p-3">
                                    <option class="feild" value="null" disabled selected>খরচের বিবরণ নির্বারচন করুন...</option>
                                    <option value="আপ্যায়ন খরচ">আপ্যায়ন খরচ</option>
                                    <option value="যাতায়াত খরচ">যাতায়াত খরচ</option>
                                    <option value="অফিস ভাড়া">অফিস ভাড়া</option>
                                    <option value="বিদ্যুৎ বিল">বিদ্যুৎ বিল</option>
                                    <option value="ষ্টেশনারী">ষ্টেশনারী</option>
                                    <option value="আসবাবপত্র">আসবাবপত্র</option>
                                    <option value="বাৎসরিক মিটিং">বাৎসরিক মিটিং</option>
                                    <option value="অন্যান্য">অন্যান্য</option>
                                </select>
                                <div id="up_details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    খরচের বিবরণ লিখুন
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="modalclose">ক্লোজ</button>
                        <button type="submit" class="btn rounded btn-button" id="expence_update_form1">সাবমিট করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="show_messages">
    <div class="modal fade" id="message2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">খরচ ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="income_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                <input type="hidden" id="salaryUpdateid">
                                <input type="date" style="text-indent: 0;" class="form-control form-input p-3" id="up_salary_date">
                                <div id="up_salary_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    তারিখ লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="income" class="pb-2">বেতন (টাকা) <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="টাকা লিখুন" id="up_salary">
                                <div id="up_salary-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    বেতন লিখুন
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 select">
                                <label for="officer" class="pb-2">অফিসার <span class="text-danger">*</span></label>
                                <select id="up_officer" class="form-control form-input p-3">
                                </select>
                                <div id="officer-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    অফিসার নির্বাচন করুন
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="salary_modalclose">ক্লোজ</button>
                        <button type="submit" class="btn rounded btn-button" id="salary_update_form1">সাবমিট করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="show_messages">
    <div class="modal fade" id="message3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">এফ ডি আর ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="income_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                <input type="hidden" id="fdrUpdateid">
                                <input type="date" style="text-indent: 0;" class="form-control form-input p-3" id="up_fdr_date">
                                <div id="up_fdr_date-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    তারিখ লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="income" class="pb-2">লাভ (টাকা) <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="টাকা লিখুন" id="up_fdr">
                                <div id="up_fdr-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    লাভ লিখুন
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 select">
                                <label for="clients" class="pb-2">এফ.ডি.আর সদস্য <span class="text-danger">*</span></label>
                                <select id="up_clients" class="form-control form-input p-3">
                                    <option class="feild" value="null" disabled selected>সদস্য নির্বাচন করুন...</option>
                                </select>
                                <div id="up_fdr_details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    এফ.ডি.আর সদস্য নির্বাচন করুন
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="fdr_modalclose">ক্লোজ</button>
                        <button type="submit" class="btn rounded btn-button" id="fdr_update_form1">সাবমিট করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="show_messages">
    <div class="modal fade" id="message4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">এফ ডি আর ইডিট ফরম</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="income_date" class="pb-2">তারিখ <span class="text-danger">*</span></label>
                                <input type="hidden" id="closingUpdateid">
                                <input type="date" style="text-indent: 0;" class="form-control form-input p-3" id="closing_date">
                                <div id="closing-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    তারিখ লিখুন
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="income" class="pb-2">লাভ (টাকা) <span class="text-danger">*</span></label>
                                <input type="number" style="text-indent: 0;" class="form-control form-input p-3" placeholder="টাকা লিখুন" id="closing_interest">
                                <div id="closing_interest-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    লাভ লিখুন
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 select">
                                <label for="clients" class="pb-2">বিস্তারিত<span class="text-danger">*</span></label>
                                <textarea class="form-control p-3" id="closing_details" rows="3"></textarea>
                                <div id="closing_details-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                    বিস্তারিত লিখুন
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-danger" data-bs-dismiss="modal" id="closing_modalclose">ক্লোজ</button>
                        <button type="submit" class="btn rounded btn-button" id="closing_update_form1">সাবমিট করুন</button>
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
        var Dates = [];
        var expence = [];
        var FDRDates = [];
        var FDRexpence = [];
        var salaryDates = [];
        var salaryexpence = [];
        var closingDates = [];
        var closingexpence = [];

        // expance Chart
        function dailyexpenceChart() {
            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    total_expance_type: 1,
                },
                success: function(data) {
                    // console.log(data);
                    $("#daily_expence").text(data);
                }
            })

            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    expence_type: 1,
                },
                dataType: "JSON",
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(key, value) {
                        var D = new Date(value.date);
                        Dates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                        expence.push(value.expence);

                    });

                    // expance Chart
                    const expance_acc_labels = Dates;

                    const expance_acc_data = {
                        labels: expance_acc_labels,
                        datasets: [{
                            backgroundColor: [
                                'rgb(60, 179, 113)',
                                'rgb(106, 90, 205)',
                                'rgb(255, 165, 0)',
                                'rgb(255, 99, 71)',
                                'rgb(255, 99, 187)',
                                'rgb(0, 99, 255)',
                                'rgb(0, 174, 255)',

                            ],
                            borderColor: '#695cfe',
                            color: '#fff',
                            data: expence,
                        }]
                    };

                    const expance_acc_config = {
                        type: 'bar',
                        data: expance_acc_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#fff'
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "চলতি মাসের তারিখ সমুহ",
                                        color: '#fff',
                                        padding: {
                                            top: 20
                                        }
                                    }
                                },
                                y: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "টাকা",
                                        color: '#fff',
                                    }
                                }
                            }
                        },
                    };

                    const expance_acc_chart = new Chart(
                        document.querySelector('#expance_acc_chart'),
                        expance_acc_config
                    );
                }
            })
        }
        dailyexpenceChart();

        // FDR Chart
        function fdrexpenceChart() {
            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    total_expance_type: 2,
                },
                success: function(data) {
                    // console.log(data);
                    $("#fdr_expence").text(data);
                }
            })

            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    expence_type: 2,
                },
                dataType: "JSON",
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(key, value) {
                        var D = new Date(value.date);
                        FDRDates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                        FDRexpence.push(value.expence);

                    });

                    // FDR Chart
                    const fdr_labels = FDRDates;

                    const fdr_data = {
                        labels: fdr_labels,
                        datasets: [{
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 205, 86, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(201, 203, 207, 1)',

                            ],
                            borderColor: '#695cfe',
                            color: '#fff',
                            data: FDRexpence,
                        }]
                    };

                    const fdr_config = {
                        type: 'bar',
                        data: fdr_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#fff'
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "চলতি মাসের তারিখ সমুহ",
                                        color: '#fff',
                                        padding: {
                                            top: 20
                                        }
                                    }
                                },
                                y: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "টাকা",
                                        color: '#fff',
                                    }
                                }
                            }
                        },
                    };

                    const fdr_chart = new Chart(
                        document.querySelector('#fdr_chart'),
                        fdr_config
                    );
                }
            })

        }
        fdrexpenceChart();

        // salary Chart
        function salaryexpenceChart() {
            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    total_expance_type: 3,
                },
                success: function(data) {
                    // console.log(data);
                    $("#salary_expence").text(data);
                }
            })

            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    expence_type: 3,
                },
                dataType: "JSON",
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(key, value) {
                        var D = new Date(value.date);
                        salaryDates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                        salaryexpence.push(value.expence);

                    });

                    // salary Chart
                    const salary_acc_labels = salaryDates;

                    const salary_acc_data = {
                        labels: salary_acc_labels,
                        datasets: [{
                            backgroundColor: [
                                'rgb(255, 99, 71)',
                                'rgb(255, 99, 187)',
                                'rgb(0, 99, 255)',
                                'rgb(0, 174, 255)',
                                'rgba(255, 205, 86, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(201, 203, 207, 1)',

                            ],
                            borderColor: '#695cfe',
                            color: '#fff',
                            data: salaryexpence,
                        }]
                    };

                    const salary_acc_config = {
                        type: 'bar',
                        data: salary_acc_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#fff'
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "চলতি মাসের তারিখ সমুহ",
                                        color: '#fff',
                                        padding: {
                                            top: 20
                                        }
                                    }
                                },
                                y: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "টাকা",
                                        color: '#fff',
                                    }
                                }
                            }
                        },
                    };

                    const salary_acc_chart = new Chart(
                        document.querySelector('#salary_acc_chart'),
                        salary_acc_config
                    );
                }
            })
        }
        salaryexpenceChart();
        // salary Chart
        function closingbookChart() {
            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    total_expance_type: 4,
                },
                success: function(data) {
                    $("#closing_book_expence").text(data);
                }
            })

            $.ajax({
                url: "codes/incomeExpenceAuthenticate.php",
                type: "POST",
                data: {
                    expence_type: 4,
                },
                dataType: "JSON",
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(key, value) {
                        var D = new Date(value.date);
                        closingDates.push(D.getDate() + "/" + (D.getMonth() + 1) + "/" + D.getFullYear());
                        closingexpence.push(value.expence);

                    });

                    // salary Chart
                    const salary_acc_labels = closingDates;

                    const salary_acc_data = {
                        labels: salary_acc_labels,
                        datasets: [{
                            backgroundColor: [
                                'rgba(201, 203, 207, 1)',
                                'rgb(0, 99, 255)',
                                'rgba(255, 205, 86, 1)',
                                'rgb(255, 99, 187)',
                                'rgba(153, 102, 255, 1)',
                                'rgb(255, 99, 71)',
                                'rgba(75, 192, 192, 1)',
                                'rgb(0, 174, 255)',

                            ],
                            borderColor: '#695cfe',
                            color: '#fff',
                            data: closingexpence,
                        }]
                    };

                    const salary_acc_config = {
                        type: 'bar',
                        data: salary_acc_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#fff'
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "চলতি মাসের তারিখ সমুহ",
                                        color: '#fff',
                                        padding: {
                                            top: 20
                                        }
                                    }
                                },
                                y: {
                                    ticks: {
                                        color: '#fff'
                                    },
                                    title: {
                                        display: true,
                                        text: "টাকা",
                                        color: '#fff',
                                    }
                                }
                            }
                        },
                    };

                    const salary_acc_chart = new Chart(
                        document.querySelector('#closing_book_chart'),
                        salary_acc_config
                    );
                }
            })
        }
        closingbookChart();

        $("#daily_expence_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var date = $("#expance_date").val();
            var expence = $("#expence").val();
            var dec = $("#details").val();

            // Empty Input Checking
            if (date == null || date == "") {
                $("#expance_date").addClass("is-invalid");
                $("#date-feedback").css("display", "block");
            }
            if (expence == "" || expence == null) {
                $("#expence").addClass("is-invalid");
                $("#expence-feedback").css("display", "block");
            }
            if (dec == "" || dec == null) {
                $("#details").addClass("is-invalid");
                $("#details-feedback").css("display", "block");
            }

            // Ajax Action
            if (date != "" && date != null && expence != "" && expence != null && dec != "" && dec != null) {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        type: 1,
                        date: date,
                        expence: expence,
                        dec: dec,
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            $("#daily_expence_form").trigger("reset");
                            $("#close").trigger("click");
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "দৈনিক খরচ গ্রহণ করা হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "দৈনিক খরচ গ্রহণ করা হয়নি। আবার চেষ্টা করুন",
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

        function loadFdr() {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    fdr: '1'
                },
                success: function(data) {
                    $("#clients").html("");
                    $("#up_clients").html("");
                    $("#clients").html(data);
                    $("#up_clients").html(data);
                    // console.log(data);
                }
            })
        }
        loadFdr();

        $("#fdr_interest_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var date = $("#fdr_date").val();
            var id = $("#clients").find(':selected').data('id');
            var expence = $("#interest").val();
            var dec = $("#clients").val();
            // Empty Input Checking
            if (date == null || date == "") {
                $("#fdr_date").addClass("is-invalid");
                $("#fdr_date-feedback").css("display", "block");
            }
            if (expence == "" || expence == null) {
                $("#interest").addClass("is-invalid");
                $("#fdr_interest-feedback").css("display", "block");
            }
            if (dec == "" || dec == null) {
                $("#clients").addClass("is-invalid");
                $("#fdr_details-feedback").css("display", "block");
            }

            // Ajax Action
            if (date != "" && date != null && expence != "" && expence != null && dec != "" && dec != null) {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        type: 2,
                        date: date,
                        id: id,
                        expence: expence,
                        dec: dec,
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            $("#fdr_interest_form").trigger("reset");
                            $("#fdr_close").trigger("click");
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "এফ.ডি.আর লাভ গ্রহণ করা হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "এফ.ডি.আর লাভ গ্রহণ করা হয়নি। আবার চেষ্টা করুন",
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

        function loadOfficer() {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    officer: '1'
                },
                success: function(data) {
                    $("#officer").html("");
                    $("#up_officer").html("");
                    $("#officer").html(data);
                    $("#up_officer").html(data);
                }
            })
        }
        loadOfficer();

        $("#salary_reg_form").on("submit", function(e) {
            e.preventDefault();

            // Store User primary Data
            var date = $("#salary_date").val();
            var expence = $("#salary").val();
            var dec = $("#officer").val();

            // Empty Input Checking
            if (date == null || date == "") {
                $("#salary_date").addClass("is-invalid");
                $("#salary_date-feedback").css("display", "block");
            }
            if (expence == "" || expence == null) {
                $("#salary").addClass("is-invalid");
                $("#salary-feedback").css("display", "block");
            }
            if (dec == "" || dec == null) {
                $("#officer").addClass("is-invalid");
                $("#officer-feedback").css("display", "block");
            }

            // Ajax Action
            if (date != "" && date != null && expence != "" && expence != null && dec != "" && dec != null) {
                $.ajax({
                    url: "codes/fdrAuthenticate.php",
                    type: "POST",
                    data: {
                        type: 3,
                        date: date,
                        expence: expence,
                        dec: dec,
                    },
                    beforeSend: function() {
                        $("#overlayer").fadeIn();
                        $("#preloader").fadeIn();
                    },
                    success: function(data) {
                        $("#overlayer").fadeOut();
                        $("#preloader").fadeOut();
                        if (data == 1) {
                            $("#salary_reg_form").trigger("reset");
                            $("#salary_close").trigger("click");
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "বেতন গ্রহণ করা হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "বেতন গ্রহণ করা হয়নি। আবার চেষ্টা করুন",
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

        window.addEventListener('load', function() {

            var dates = document.getElementById('date_range').innerText;
            var range = dates.split("-");
            let from_date = range[0];
            let end_date = range[1];

            let spanText = document.querySelector('#reportrange span')
            spanText.addEventListener('DOMSubtreeModified', function() {
                dates = document.querySelector('#reportrange span').innerText;
                range = dates.split("-");
                from_date = range[0];
                end_date = range[1];
                if (dates != "") {
                    expance1STMLoad();
                    salarySTMLoad();
                    fdrSTMLoad();
                    closingBookSTMLoad();
                }
            })

            // Daily Expence 
            function expance1STMLoad() {
                $('#expance_list').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column(3)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(3, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(3).footer()).html('৳' + pageTotal + "/-");
                    },
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/expanceSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            from_date: from_date,
                            end_date: end_date,
                        }
                    }
                })
            }
            expance1STMLoad();

            // Daily Expence edit Form
            $(document).on("click", "#edit_load", function() {
                var id = $(this).data("id");
                console.log(id);
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        expance1_id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(key, value) {
                            $("#expance1Updateid").val(value.id);
                            $("#up_income_date").val(value.date);
                            $("#up_income").val(value.expence);
                            $("#up_details").val(value.details).trigger('change');
                        })
                    }
                })
            })

            // Daily Expence Update
            $("#expence_update_form1").on("click", function(e) {
                e.preventDefault();

                // Store User primary Data
                var date = $("#up_income_date").val();
                var expence = $("#up_income").val();
                var dec = $("#up_details").val();
                var id = $("#expance1Updateid").val();

                // Empty Input Checking
                if (date == null || date == "") {
                    $("#up_income_date").addClass("is-invalid");
                    $("#up_date-feedback").css("display", "block");
                }
                if (expence == "" || expence == null) {
                    $("#up_income").addClass("is-invalid");
                    $("#up_income-feedback").css("display", "block");
                }
                if (dec == "" || dec == null) {
                    $("#up_details").addClass("is-invalid");
                    $("#up_details-feedback").css("display", "block");
                }

                // Ajax Action
                if (date != null && expence != "" && expence != null && dec != "" && dec != null) {
                    $.ajax({
                        url: "codes/fdrAuthenticate.php",
                        type: "POST",
                        data: {
                            update_date: date,
                            update_expence: expence,
                            update_dec: dec,
                            id: id
                        },
                        beforeSend: function() {
                            $("#overlayer").fadeIn();
                            $("#preloader").fadeIn();
                        },
                        success: function(data) {
                            $("#overlayer").fadeOut();
                            $("#preloader").fadeOut();
                            if (data == 1) {
                                $("#modalclose").trigger("click");
                                expance1STMLoad();
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "খরচ আপডেট করা হয়েছে",
                                    icon: 'success',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                            if (data == 0) {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "খরচ আপডেট করা হয়নি। আবার চেষ্টা করুন",
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

            // Daily Expence Delete
            $(document).on("click", "#dlt_btn", function() {
                var id = $(this).data("id");
                Swal.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: "ডিলিট করার পর আয় ফিরে পাওয়া সম্ভব নয়!",
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    denyButtonText: `Don't Delete`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "codes/fdrAuthenticate.php",
                            type: "POST",
                            data: {
                                dlt_expence_id: id
                            },
                            beforeSend: function() {
                                $("#overlayer").fadeIn();
                                $("#preloader").fadeIn();
                            },
                            success: function(data) {
                                $("#overlayer").fadeOut();
                                $("#preloader").fadeOut();
                                if (data == 1) {
                                    swal.fire({
                                        title: "অভিনন্দন",
                                        text: "ডিলিট সম্পন্ন হয়েছে",
                                        icon: 'success',
                                    })
                                    expance1STMLoad();
                                    salarySTMLoad();
                                    fdrSTMLoad();
                                } else {
                                    swal.fire({
                                        title: "দুঃখিত",
                                        text: "ডিলিট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
                                        icon: 'error',
                                    })
                                }
                                // Swal.fire('Saved!', '', 'success')
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('আয় সুরক্ষখিত রয়েছে', '', 'info')
                    }
                })
            })

            // Sallery Expence 
            function salarySTMLoad() {
                $('#salary_list').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column(3)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(3, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(3).footer()).html('৳' + pageTotal + "/-");
                    },
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/salarySTMAuthenticate.php",
                        type: "POST",
                        data: {
                            from_date: from_date,
                            end_date: end_date,
                        }
                    }
                })
            }
            salarySTMLoad();

            // Salary Expence edit Form
            $(document).on("click", "#salaryedit_load", function() {
                var id = $(this).data("id");
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        expance1_id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(key, value) {
                            $("#salaryUpdateid").val(value.id);
                            $("#up_salary_date").val(value.date);
                            $("#up_salary").val(value.expence);
                            $("#up_officer").val(value.details).trigger('change');
                        })
                    }
                })
            })

            // salary Expence Update
            $("#salary_update_form1").on("click", function(e) {
                e.preventDefault();

                // Store User primary Data
                var date = $("#up_salary_date").val();
                var expence = $("#up_salary").val();
                var dec = $("#up_officer").val();
                var id = $("#salaryUpdateid").val();

                // Empty Input Checking
                if (date == null || date == "") {
                    $("#up_salary_date").addClass("is-invalid");
                    $("#up_salary_date-feedback").css("display", "block");
                }
                if (expence == "" || expence == null) {
                    $("#up_salary").addClass("is-invalid");
                    $("#up_salary-feedback").css("display", "block");
                }
                if (dec == "" || dec == null) {
                    $("#up_officer").addClass("is-invalid");
                    $("#officer-feedback").css("display", "block");
                }

                // Ajax Action
                if (date != null && expence != "" && expence != null && dec != "" && dec != null) {
                    $.ajax({
                        url: "codes/fdrAuthenticate.php",
                        type: "POST",
                        data: {
                            update_date: date,
                            update_expence: expence,
                            update_dec: dec,
                            id: id
                        },
                        beforeSend: function() {
                            $("#overlayer").fadeIn();
                            $("#preloader").fadeIn();
                        },
                        success: function(data) {
                            $("#overlayer").fadeOut();
                            $("#preloader").fadeOut();
                            if (data == 1) {
                                $("#salary_modalclose").trigger("click");
                                salarySTMLoad();
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "খরচ আপডেট করা হয়েছে",
                                    icon: 'success',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                            if (data == 0) {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "খরচ আপডেট করা হয়নি। আবার চেষ্টা করুন",
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

            // FDR Expence 
            function fdrSTMLoad() {
                $('#fdr_interest_list').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column(3)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(3, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(3).footer()).html('৳' + pageTotal + "/-");
                    },
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/fdrSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            from_date: from_date,
                            end_date: end_date,
                        }
                    }
                })
            }
            fdrSTMLoad();

            // Salary Expence edit Form
            $(document).on("click", "#fdredit_load", function() {
                var id = $(this).data("id");
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        expance1_id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(key, value) {
                            $("#fdrUpdateid").val(value.id);
                            $("#up_fdr_date").val(value.date);
                            $("#up_fdr").val(value.expence);
                            $("#up_clients").val(value.details).trigger('change');
                        })
                    }
                })
            })

            // salary Expence Update
            $("#fdr_update_form1").on("click", function(e) {
                e.preventDefault();

                // Store User primary Data
                var date = $("#up_fdr_date").val();
                var expence = $("#up_fdr").val();
                var dec = $("#up_clients").val();
                var id = $("#fdrUpdateid").val();

                // Empty Input Checking
                if (date == null || date == "") {
                    $("#up_fdr_date").addClass("is-invalid");
                    $("#up_fdr_date-feedback").css("display", "block");
                }
                if (expence == "" || expence == null) {
                    $("#up_fdr").addClass("is-invalid");
                    $("#up_fdr-feedback").css("display", "block");
                }
                if (dec == "" || dec == null) {
                    $("#up_clients").addClass("is-invalid");
                    $("#up_fdr_details-feedback").css("display", "block");
                }

                // Ajax Action
                if (date != null && expence != "" && expence != null && dec != "" && dec != null) {
                    $.ajax({
                        url: "codes/fdrAuthenticate.php",
                        type: "POST",
                        data: {
                            update_date: date,
                            update_expence: expence,
                            update_dec: dec,
                            id: id
                        },
                        beforeSend: function() {
                            $("#overlayer").fadeIn();
                            $("#preloader").fadeIn();
                        },
                        success: function(data) {
                            $("#overlayer").fadeOut();
                            $("#preloader").fadeOut();
                            if (data == 1) {
                                $("#fdr_modalclose").trigger("click");
                                fdrSTMLoad();
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "খরচ আপডেট করা হয়েছে",
                                    icon: 'success',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                            if (data == 0) {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "খরচ আপডেট করা হয়নি। আবার চেষ্টা করুন",
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

            // Closing Book Expence 
            function closingBookSTMLoad() {
                $('#closing_book_interest_list').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        // Bold the grade for all 'A' grade browsers
                        if (aData[4] == "A") {
                            $('td:eq(4)', nRow).html('<b>A</b>');
                        }
                    },
                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column(3)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(3, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(3).footer()).html('৳' + pageTotal + "/-");
                    },
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/closingbookSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            from_date: from_date,
                            end_date: end_date
                        }
                    }
                })
            }
            closingBookSTMLoad();

            // Salary Expence edit Form
            $(document).on("click", "#closingBookedit_load", function() {
                var id = $(this).data("id");
                $.ajax({
                    url: "codes/incomeExpenceAuthenticate.php",
                    type: "POST",
                    data: {
                        expance1_id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(key, value) {
                            $("#closingUpdateid").val(value.id);
                            $("#closing_date").val(value.date);
                            $("#closing_interest").val(value.expence);
                            $("#closing_details").val(value.details);
                        })
                    }
                })
            })

            // Closing Book Expence Update
            $("#closing_update_form1").on("click", function(e) {
                e.preventDefault();

                // Store User primary Data
                var date = $("#closing_date").val();
                var expence = $("#closing_interest").val();
                var dec = $("#closing_details").val();
                var id = $("#closingUpdateid").val();

                // Empty Input Checking
                if (date == null || date == "") {
                    $("#closing_date").addClass("is-invalid");
                    $("#closing_date-feedback").css("display", "block");
                }
                if (expence == "" || expence == null) {
                    $("#closing_interest").addClass("is-invalid");
                    $("#closing_interest-feedback").css("display", "block");
                }
                if (dec == "" || dec == null) {
                    $("#closing_details").addClass("is-invalid");
                    $("#closing_details-feedback").css("display", "block");
                }

                // Ajax Action
                if (date != null && expence != "" && expence != null && dec != "" && dec != null) {
                    $.ajax({
                        url: "codes/fdrAuthenticate.php",
                        type: "POST",
                        data: {
                            update_date: date,
                            update_expence: expence,
                            update_dec: dec,
                            id: id
                        },
                        beforeSend: function() {
                            $("#overlayer").fadeIn();
                            $("#preloader").fadeIn();
                        },
                        success: function(data) {
                            $("#overlayer").fadeOut();
                            $("#preloader").fadeOut();
                            if (data == 1) {
                                $("#closing_modalclose").trigger("click");
                                closingBookSTMLoad();
                                swal.fire({
                                    title: "অভিনন্দন",
                                    text: "খরচ আপডেট করা হয়েছে",
                                    icon: 'success',
                                    buttons: "OK",
                                    dangerMode: true,
                                })
                            }
                            if (data == 0) {
                                swal.fire({
                                    title: "দুঃখিত",
                                    text: "খরচ আপডেট করা হয়নি। আবার চেষ্টা করুন",
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

        })

    })
</script>
</body>

</html>