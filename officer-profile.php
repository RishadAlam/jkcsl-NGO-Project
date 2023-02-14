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
                <li class="breadcrumb-item active" aria-current="page">প্রোফাইল</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Officer Profile -->
<div class="client_profile officer_profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="profile_intro">
                    <div class="img rounded">
                        <img id="img" src="./img/pngfind.com-copyright-png-938050.png" alt="">
                    </div>
                    <div class="p_status text-center my-3">
                        <span class="d-inline-block py-2 px-4 text-capitalize rounded" style="color: #fff; font-size: 18px;" id="status"></span>
                    </div>
                    <div class="p-short">
                        <ul>
                            <li class="text-center name" id="name"></li>
                            <li class="d-flex justify-content-between">পদবি <span id="role"></span></li>
                            <li class="d-flex justify-content-between">ইমেল <span id="email"></span></li>
                            <li class="d-flex justify-content-between">রক্তের গ্রুপ <span id="blood"></span></li>
                            <li class="d-flex justify-content-between">মোবাইল <span id="mobile_1"></span></li>
                            <li class="d-flex justify-content-between">যোগদান তারিখ <span id="start"></span></li>
                            <li class="d-flex justify-content-between">বিদায় তারিখ <span id="expiry"></span></li>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile_details">
                    <div data-addui='tabs'>
                        <div role='tabs'>
                            <div>অফিসার প্রোফাইল</div>
                        </div>
                        <div role='contents' class="contents mt-3 p-3">
                            <div class="p_details">
                                <div class="row">
                                    <div class="form_section_heading d-flex justify-content-between pb-1 shadow my-3">
                                        <h4>অফিসার পরিচিতি</h4>
                                        <span class="text-white-50">Last Update: <small class="text-danger" id="update_date"></small></span>
                                    </div>
                                    <div class="client_info row">
                                        <div class="col-md-6 my-3">
                                            <p>জাতীয় পরিচয় পত্রের নম্বরঃ <span id="nid"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>জন্ম তারিখঃ <span id="dob"></span></p>
                                        </div>
                                        <div class="col-md-6 my-3">
                                            <p>মোবাইল-২ঃ <span id="mobile_2"></span></p>
                                        </div>
                                    </div>
                                    <?php
                                    if ((isset($_GET['id']) && $_GET['id'] ==  $_SESSION['auth']['user_id']) || !isset($_GET['id'])) { ?>
                                        <a href="#" class="btn btn-sm my-3 px-3 form-control rounden bg-warning text-center d-inline-block text-black" id="notif_view" data-bs-toggle="modal" data-bs-target="#message">EDIT</a>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-cards">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">প্রদানকৃত ঋণ</h4>
                                                <h3><span id="loan_giving"></span>টি</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">ঋণ প্রদান</h4>
                                                <h3><span id="total_loan"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">উত্তোলন</h4>
                                                <h3><span id="widthdrawal"></span>টি</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">সঞ্চয় সদস্য ভর্তি</h4>
                                                <h3><span id="total_savings"></span>জন</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">ঋণ আদায়</h4>
                                                <h3><span id="loan_collection"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">লাভ আদায়</h4>
                                                <h3><span id="interest_collection"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">ঋণ সঞ্চয় আদায়</h4>
                                                <h3><span id="loan_savings_collection"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">সঞ্চয় আদায়</h4>
                                                <h3><span id="savings_collection"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="account_card">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center">
                                            <div class="card_detail">
                                                <h4 class="py-2">উত্তোলন প্রদান</h4>
                                                <h3><span id="withdrawal_giving"></span>৳</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account_statment my-3 text-end">
            <div id="reportrange" style="display: inline-block; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span id="date_range"></span> <i class="fa fa-caret-down"></i>
            </div>
            <div class="table">
                <div class="recent_collection">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <!-- <div class="row" style="width: 100%;"> -->
                            <button class="col-6 col-sm-2 nav-link active" id="nav-savings-tab" data-bs-toggle="tab" data-bs-target="#nav-savings" type="button" role="tab" aria-controls="nav-savings" aria-selected="true">সঞ্চয় সংগ্রহ</button>
                            <button class="col-6 col-sm-2 nav-link" id="nav-savingsWithdrawal-tab" data-bs-toggle="tab" data-bs-target="#nav-savingsWithdrawal" type="button" role="tab" aria-controls="nav-savingsWithdrawal" aria-selected="true">সঞ্চয় উত্তোলন</button>
                            <button class="col-6 col-sm-2 nav-link" id="nav-loan-tab" data-bs-toggle="tab" data-bs-target="#nav-loan" type="button" role="tab" aria-controls="nav-loan" aria-selected="false">ঋণ সংগ্রহ</button>
                            <button class="col-6 col-sm-2 nav-link" id="nav-loan-saving-withdrawal-tab" data-bs-toggle="tab" data-bs-target="#nav-loan-saving-withdrawal" type="button" role="tab" aria-controls="nav-loan-saving-withdrawal" aria-selected="false">ঋণ সঞ্চয় উত্তোলন</button>
                            <button class="col-6 col-sm-2 nav-link" id="nav-loan-giving-tab" data-bs-toggle="tab" data-bs-target="#nav-loan-giving" type="button" role="tab" aria-controls="nav-loan-giving" aria-selected="true">ঋণ প্রদান</button>
                            <button class="col-6 col-sm-2 nav-link" id="nav-client-add-tab" data-bs-toggle="tab" data-bs-target="#nav-client-add" type="button" role="tab" aria-controls="nav-client-add" aria-selected="false">সদস্য ভর্তি</button>
                            <!-- </div> -->
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-savings" role="tabpanel" aria-labelledby="nav-savings-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>সঞ্চয় বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <table id="savings_collection_list" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>সদস্য</th>
                                        <th>বই নং</th>
                                        <th>ফিল্ড</th>
                                        <th>কেন্দ্র</th>
                                        <th>ক্ষেত্র</th>
                                        <th>সংগ্রহ</th>
                                        <th>তারিখ</th>
                                        <th>সময়</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td class="text-end border-top"></td>
                                        <td class="text-end border-top"></td>
                                        <td class="text-end border-top"></td>
                                        <td class="text-end border-top"></td>
                                        <td class="text-end border-top"></td>
                                        <td class="text-end border-top">সর্বমোট</td>
                                        <td class="border-top" style="font-weight: bolder;"></td>
                                        <td class="border-top" style="font-weight: bolder;"></td>
                                        <td class="border-top" style="font-weight: bolder;"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade show" id="nav-savingsWithdrawal" role="tabpanel" aria-labelledby="nav-savingsWithdrawal-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>উত্তোলন বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="savingWithdrawal" style="display: none;">
                                <table id="savings_collection_withdrawal_list" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>সদস্য</th>
                                            <th>বই নং</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>উত্তোলন</th>
                                            <th>তারিখ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top">সর্বমোট</td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-loan" role="tabpanel" aria-labelledby="nav-loan-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>ঋণ বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="loanSTM" style="display: none;">
                                <table id="loan_collection_list" class="w-100 table display responsive nowrap table-bordered table-hover table-striped  text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>সদস্য</th>
                                            <th>বই নং</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>ঋণ সঞ্চয়</th>
                                            <th>ঋণ আদায়</th>
                                            <th>লভ্যাংশ</th>
                                            <th>মোট</th>
                                            <th>তারিখ</th>
                                            <th>সময়</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top">সর্বমোট</td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="nav-loan-saving-withdrawal" role="tabpanel" aria-labelledby="nav-loan-saving-withdrawal-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>উত্তোলন বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="loanSavingWithd" style="display: none;">
                                <table id="loan_collection_withdrawal_list" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>সদস্য</th>
                                            <th>বই নং</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>উত্তোলন</th>
                                            <th>তারিখ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top">সর্বমোট</td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-loan-giving" role="tabpanel" aria-labelledby="nav-loan-giving-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>ঋণ বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="loanGivingStm" style="display: none;">
                                <table id="loan_giving_list" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>সদস্য</th>
                                            <th>বই নং</th>
                                            <th>ফিল্ড</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ঋণ সঞ্চয়</th>
                                            <th>ঋণ প্রদান</th>
                                            <th>লাভ</th>
                                            <th>মোট</th>
                                            <th>তারিখ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top">সর্বমোট</td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-client-add" role="tabpanel" aria-labelledby="nav-client-add-tab">
                            <div class="table_heading d-flex align-items-center justify-content-between my-3">
                                <h4>সদস্য বিবৃতি</h4>
                                <a href="" class="d-inline-block py-1 px-3 text-capitalize bg-secondary bg-gradient rounded" style="color: #fff; cursor: pointer; font-size: 18px;">Print</a>
                            </div>
                            <div id="cluentADDCLOSe" style="display: none;">
                                <table id="client_add_list" class="w-100 table display responsive nowrap table-bordered table-hover table-striped text-start">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>সদস্য</th>
                                            <th>বই নং</th>
                                            <th>ফিল্ড</th>
                                            <th>কেন্দ্র</th>
                                            <th>ক্ষেত্র</th>
                                            <th>সঞ্চয়</th>
                                            <th>লাভ</th>
                                            <th>সর্বমোট</th>
                                            <th>তারিখ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top"></td>
                                            <td class="text-end border-top">সর্বমোট</td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                            <td class="border-top" style="font-weight: bolder;"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
if ((isset($_GET['id']) && $_GET['id'] ==  $_SESSION['auth']['user_id']) || !isset($_GET['id'])) { ?>

    <!-- Modal -->
    <div class="show_messages">
        <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">প্রোফাইল ইডিট ফরম</h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" id="modal_close" aria-label="Close"></button>
                    </div>
                    <form id="load_edit_form">
                        <div class="modal-body" id="modal_body">
                            <div class="row">
                                <!-- Form Information -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                                    <input type="hidden" name="off_id" id="off_id">
                                    <input type="text" style="text-indent: 5px;" class="form-control form-input p-3" name="name" id="edit_name">
                                    <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                        অফিসারের নাম লিখুন
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nid" class="pb-2">জাতীয় পরিচয় পত্রের নম্বর</label>
                                    <input type="number" style="text-indent: 5px;" class="form-control form-input p-3" name="nid" id="edit_nid">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="pb-2">মোবাইল <span class="text-danger">*</span></label>
                                    <input type="number" style="text-indent: 5px;" class="form-control form-input p-3" name="phone_number" id="edit_phone_number">
                                    <div id="phone-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                        অফিসারের মোবাইল নম্বর দিন
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number_2" class="pb-2">মোবাইল - ২ (যদি থাকে)</label>
                                    <input type="number" class="form-control form-input p-3" style="text-indent: 5px;" name="phone_number_2" id="edit_phone_number_2">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="pb-2">জন্ম তারিখ</label>
                                    <input type="date" style="text-indent: 5px;" class="form-control form-input p-3" placeholder="জন্ম তারিখ" name="edit_dob" id="edit_dob">
                                </div>
                                <div class="col-md-6 mb-3 select">
                                    <label for="blood_group" class="pb-2">রক্তের গ্রুপ (যদি থাকে)</label>
                                    <select id="edit_blood_group" class="form-control form-input p-3" name="blood_group">
                                        <option class="feild" value="null" disabled selected>রক্তের গ্রুপ নির্বারচন করুন...</option>
                                        <option value="A+">এ পজিটিভ (A+)</option>
                                        <option value="A-">এ নেগেটিভ (A-)</option>
                                        <option value="B+">বি পজিটিভ (B+)</option>
                                        <option value="B-">বি নেগেটিভ (B-)</option>
                                        <option value="O+">ও পজিটিভ (O+)</option>
                                        <option value="O-">ও নেগেটিভ (O-)</option>
                                        <option value="AB+">এবি পজিটিভ (AB+)</option>
                                        <option value="AB-">এবি নেগেটিভ (AB-)</option>
                                    </select>
                                </div>

                                <!-- Clint Image -->
                                <div class="col-md-6 mb-3">
                                    <label class="pb-2">সদস্য ছবি</label><br>
                                    <div class="text-start">
                                        <label id="client_image" for="client_pic"><img id="edit_image" style="width: 150px;" src="./img/pngfind.com-copyright-png-938050.png" alt="Profile-Image"></label>
                                        <input class="d-none" type="hidden" id="old_pic" name="old_pic" />
                                        <input class="d-none" type="file" id="client_pic" name="client_pic" />
                                    </div>
                                </div>
                            </div>
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
<?php }
?>
<?php
include "include/footer.php";
?>

<script>
    $(document).ready(function() {
        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        var officerID = urlParams.get('id');

        if (officerID == null) {
            officerID = <?php echo $_SESSION['auth']['user_id'] ?>;
        }
        <?php
        if ($_SESSION['auth']['user_role'] != 0) {
            if (isset($_GET['id']) && $_GET['id'] !=  $_SESSION['auth']['user_id']) { ?>
                $(location).attr('href', 'http://localhost/gkcsl/404');
        <?php }
        } ?>

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [day, month, year].join('-');
        }

        function userProfileLoad() {
            $.ajax({
                url: "codes/loadFunction.php",
                type: "POST",
                data: {
                    officerUserID: officerID
                },
                dataType: "JSON",
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(key, value) {
                        $("#name").text(value.name);
                        $("#off_id").val(value.id);
                        $("#edit_name").val(value.name);
                        $("#role").text(value.role);
                        $("#email").text(value.email);
                        $("#blood").text(value.blood);
                        $("#edit_blood_group").val(value.blood).trigger('change');
                        $("#mobile_1").text(value.mobile_1);
                        $("#edit_phone_number").val(value.mobile_1);
                        $("#start").text(formatDate(value.created_at));
                        $("#expiry").text(value.resign_date);
                        $("#update_date").text(formatDate(value.updated_at));
                        $("#nid").text(value.nid);
                        $("#edit_nid").val(value.nid);
                        $("#dob").text(formatDate(value.dob));
                        $("#edit_dob").val(value.dob);
                        $("#mobile_2").text(value.mobile_2);
                        $("#edit_phone_number_2").val(value.mobile_2);
                        if (value.status == 1) {
                            $("#status").text("ACTIVE");
                            $("#status").addClass("bg-success");
                        } else if (value.status == 2) {
                            $("#status").text("PANDING");
                            $("#status").addClass("bg-warning");
                        } else {
                            $("#status").text("DEACTIVE");
                            $("#status").addClass("bg-danger");
                        }
                        if (value.image != null) {
                            $("#edit_image").attr("src", "./img/" + value.image);
                            $("#img").attr("src", "./img/" + value.image);
                            $("#old_pic").val(value.image);
                        } else {
                            $("#img").attr("src", "https://avatars.dicebear.com/api/micah/" + value.name + ".svg ");

                        }
                        if (value.loan_giving != null) {
                            var loan_giving = value.loan_giving;
                        } else {
                            var loan_giving = 0;
                        }
                        $("#loan_giving").text(loan_giving);


                        if (value.total_loan != null) {
                            var total_loan = value.total_loan;
                        } else {
                            var total_loan = 0;
                        }
                        $("#total_loan").text(total_loan);


                        if (value.saving_withdrawals != null) {
                            var saving_withdrawals = value.saving_withdrawals;
                        } else {
                            var saving_withdrawals = 0;
                        }
                        if (value.loan_savings_withdrawals != null) {
                            var loan_savings_withdrawals = value.loan_savings_withdrawals;
                        } else {
                            var loan_savings_withdrawals = 0;
                        }
                        $("#widthdrawal").text(parseFloat(saving_withdrawals) + parseFloat(loan_savings_withdrawals));


                        if (value.total_savings != null) {
                            var total_savings = value.total_savings;
                        } else {
                            var total_savings = 0;
                        }

                        $("#total_savings").text(total_savings);


                        if (value.total_loan_collection != null) {
                            var total_loan_collection = value.total_loan_collection;
                        } else {
                            var total_loan_collection = 0;
                        }

                        $("#loan_collection").text(total_loan_collection);


                        if (value.total_interest_collection != null) {
                            var total_interest_collection = value.total_interest_collection;
                        } else {
                            var total_interest_collection = 0;
                        }


                        $("#interest_collection").text(total_interest_collection);


                        if (value.total_loan_saving_collection != null) {
                            var total_loan_saving_collection = value.total_loan_saving_collection;
                        } else {
                            var total_loan_saving_collection = 0;
                        }


                        $("#loan_savings_collection").text(total_loan_saving_collection);


                        if (value.Total_savings_collection != null) {
                            var Total_savings_collection = value.Total_savings_collection;
                        } else {
                            var Total_savings_collection = 0;
                        }


                        $("#savings_collection").text(Total_savings_collection);


                        if (value.loan_saving_widthdraw != null) {
                            var loan_saving_widthdraw = value.loan_saving_widthdraw;
                        } else {
                            var loan_saving_widthdraw = 0;
                        }
                        if (value.savings_widthdraw != null) {
                            var savings_widthdraw = value.savings_widthdraw;
                        } else {
                            var savings_widthdraw = 0;
                        }

                        $("#withdrawal_giving").text(parseFloat(loan_saving_widthdraw) + parseFloat(savings_widthdraw));
                    })
                }
            })
        }

        userProfileLoad();

        $("#load_edit_form").on("submit", function(e) {
            e.preventDefault();
            // Store User primary Data
            var name = $("#edit_name").val();
            var phone_number = $("#edit_phone_number").val();
            var phone_length = phone_number.length;

            // Empty Input Checking
            if (name == "" || name == null) {
                $("#name").addClass("is-invalid");
                $("#name-feedback").css("display", "block");
            }
            if (phone_number == "" || phone_number == null) {
                $("#phone_number").addClass("is-invalid");
                $("#phone-feedback").css("display", "block");
            }
            if (phone_length != 11) {
                $("#phone_number").addClass("is-invalid");
                $("#phone-feedback").text("১১ ডিজিটের মোবাইল নম্বর দিন");
                $("#phone-feedback").css("display", "block");
            }

            // Ajax Action
            if (name != "" && phone_number != "" && phone_length == 11) {
                var formData = new FormData(this);
                $.ajax({
                    url: "codes/officersProfileAuthenticate.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
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
                            $("#modal_close").trigger("click");
                            $("select").empty().trigger('change');
                            userProfileLoad();
                            swal.fire({
                                title: "অভিনন্দন",
                                text: "অফিসার আপডেট সম্পন্ন হয়েছে",
                                icon: 'success',
                                buttons: "OK",
                                dangerMode: true,
                            })
                        }
                        if (data == 0) {
                            swal.fire({
                                title: "দুঃখিত",
                                text: "অফিসার আপডেট সম্পন্ন হয়নি। আবার চেষ্টা করুন",
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
                    text: "আবার চেষ্টা করুন",
                    icon: 'error',
                    buttons: "OK",
                    dangerMode: true,
                })
            }
        })

        window.addEventListener('load', function() {
            var dates = document.getElementById('date_range').innerText;
            var range = dates.split("-");
            var from_date = range[0];
            var end_date = range[1];

            let spanText = document.querySelector('#reportrange span')
            spanText.addEventListener('DOMSubtreeModified', function() {
                dates = document.querySelector('#reportrange span').innerText;
                range = dates.split("-");
                from_date = range[0];
                end_date = range[1];
                if (dates != "") {
                    // console.log(from_date);
                    savingsSTMLoad();
                    savingsWithdrawalSTMLoad();
                    loanWithdrawalSTMLoad();
                    loanSTMLoad();
                    loanGivingSTMLoad();
                    savingsAddSTMLoad();
                }
            })

            function savingsSTMLoad() {
                $('#savings_collection_list').DataTable({
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
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html('৳' + pageTotal + "/-");
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 5
                        },
                        {
                            responsivePriority: 4,
                            targets: 6
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/officerProfSavingsSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            officerID: officerID,
                            from_date: from_date,
                            end_date: end_date,
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            function savingsWithdrawalSTMLoad() {
                $('#savings_collection_withdrawal_list').DataTable({
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
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html('৳' + pageTotal + "/-");
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 6
                        },
                        {
                            responsivePriority: 4,
                            targets: 7
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/officerProfSavingsWithSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            officerID: officerID,
                            from_date: from_date,
                            end_date: end_date
                        }
                        // // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            function loanWithdrawalSTMLoad() {
                $('#loan_collection_withdrawal_list').DataTable({
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
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html('৳' + pageTotal + "/-");
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 6
                        },
                        {
                            responsivePriority: 4,
                            targets: 7
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/officerProfloanWithSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            officerID: officerID,
                            from_date: from_date,
                            end_date: end_date
                        }
                        // // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            function loanSTMLoad() {
                $('#loan_collection_list').DataTable({
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
                        deposit = api
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        loan = api
                            .column(7)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        interest = api
                            .column(8)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        total = api
                            .column(9)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        depositTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        loanTotal = api
                            .column(7, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        interestTotal = api
                            .column(8, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        pageTotal = api
                            .column(9, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html('৳' + depositTotal + "/-");
                        $(api.column(7).footer()).html('৳' + loanTotal + "/-");
                        $(api.column(8).footer()).html('৳' + interestTotal + "/-");
                        $(api.column(9).footer()).html('৳' + pageTotal + "/-");
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 6
                        },
                        {
                            responsivePriority: 4,
                            targets: 7
                        }, {
                            responsivePriority: 5,
                            targets: 8
                        },
                        {
                            responsivePriority: 6,
                            targets: 9
                        },
                        {
                            responsivePriority: 7,
                            targets: 10
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/officerProfloanSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            officerID: officerID,
                            from_date: from_date,
                            end_date: end_date,
                        }
                        // // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            function loanGivingSTMLoad() {
                $('#loan_giving_list').DataTable({
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
                        deposit = api
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        loan = api
                            .column(7)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        interest = api
                            .column(8)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        total = api
                            .column(9)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        depositTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        loanTotal = api
                            .column(7, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        interestTotal = api
                            .column(8, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        pageTotal = api
                            .column(9, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html('৳' + depositTotal + "/-");
                        $(api.column(7).footer()).html('৳' + loanTotal + "/-");
                        $(api.column(8).footer()).html('৳' + interestTotal + "/-");
                        $(api.column(9).footer()).html('৳' + pageTotal + "/-");
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 6
                        },
                        {
                            responsivePriority: 4,
                            targets: 7
                        }, {
                            responsivePriority: 5,
                            targets: 8
                        },
                        {
                            responsivePriority: 6,
                            targets: 9
                        },
                        {
                            responsivePriority: 7,
                            targets: 10
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/officerProfloanGivingSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            officerID: officerID,
                            from_date: from_date,
                            end_date: end_date,
                        }
                        // // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }

            function savingsAddSTMLoad() {
                $('#client_add_list').DataTable({
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
                        deposit = api
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        total = api
                            .column(8)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        depositTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        pageTotal = api
                            .column(8, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html('৳' + depositTotal + "/-");
                        $(api.column(8).footer()).html('৳' + pageTotal + "/-");
                    },
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 2,
                            targets: 2
                        },
                        {
                            responsivePriority: 3,
                            targets: 6
                        },
                        {
                            responsivePriority: 4,
                            targets: 7
                        }, {
                            responsivePriority: 5,
                            targets: 8
                        },
                        {
                            responsivePriority: 6,
                            targets: 9
                        }
                    ],
                    // "retrieve": true,
                    "paging": true,
                    "bDestroy": true,
                    "order": [],
                    "searching": true,
                    "ajax": {
                        url: "codes/officerProfSavingsAddSTMAuthenticate.php",
                        type: "POST",
                        data: {
                            officerID: officerID,
                            from_date: from_date,
                            end_date: end_date,
                        }
                        // dataType: "JSON",
                        // success: function(data) {
                        //     console.log(data);
                        // }
                    }
                })
            }
            
            savingsSTMLoad();
            $("#nav-savingsWithdrawal-tab").on("click", function() {
                $("#savingWithdrawal").css("display", "block");
                setTimeout(function() {
                    savingsWithdrawalSTMLoad();
                }, 1000)
            })
            $("#nav-loan-tab").on("click", function() {
                $("#loanSTM").css("display", "block");
                setTimeout(function() {
                    loanSTMLoad();
                }, 1000)
            })
            $("#nav-loan-saving-withdrawal-tab").on("click", function() {
                $("#loanSavingWithd").css("display", "block");
                setTimeout(function() {
                    loanWithdrawalSTMLoad();
                }, 1000)
            })
            $("#nav-loan-giving-tab").on("click", function() {
                $("#loanGivingStm").css("display", "block");
                setTimeout(function() {
                    loanGivingSTMLoad();
                }, 1000)
            })
            $("#nav-client-add-tab").on("click", function() {
                $("#cluentADDCLOSe").css("display", "block");
                setTimeout(function() {
                    savingsAddSTMLoad();
                }, 1000)
            })
        })
    })
</script>
</body>

</html>