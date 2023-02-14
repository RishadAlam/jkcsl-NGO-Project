<!-- Main Body -->
<section id="main">
    <!-- TopBar -->
    <div class="topbar py-1 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-5 col-4 justify-content-start d-flex">
                    <div class="t_toggle d-none">
                        <span><i class='bx bx-menu-alt-left'></i></span>
                    </div>
                    <div class="screen me-3">
                        <span id="open_full_screen" onclick="openFullscreen()"><i class='bx bx-fullscreen'></i></span>
                        <span id="close_full_screen" style="display: none;" onclick="closeFullscreen()"><i class='bx bx-exit-fullscreen'></i></span>
                    </div>
                    <form class="form position-relative">
                        <span class="search"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control form-input" placeholder="অনুসন্ধান করুন..." id="liveSearch">
                        <span class="left-pan"><i class="fa fa-microphone"></i></span>
                        <div class="searchBox">
                            <table class="table table-striped m-0 p-3">
                                <tbody id="liveSearchBody">
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 col-4 time d-flex flex-fill justify-content-end">
                    <!-- <h4 id="time">বুধবার | 0৩ আগস্ট ২০২২ | ০৬ঃ২৫</h4> -->
                    <div class="col-2 text-end" id="day"></div>
                    <div class="col-5 text-center" id="date"></div>
                    <div class="col-5 text-lg-start text-end" id="time"></div>
                </div>
                <div class="col-md-2 col-4 user">
                    <div class="notification dropdown">
                        <a id="notif_bell">
                            <span><i class='bx bx-bell'></i></span>
                            <p class="num" id="total_notif" style="display: none;"></p>
                        </a>
                        <ul id="notif_list" style="max-height: 400px; overflow-y: auto;">
                            <li><a href="./inbox" class="btn form-control btn-button">সবগুলো দেখুন</a></li>
                        </ul>
                    </div>
                    <div class="img dropdown">
                        <a>
                            <img src="<?php
                                        if (isset($_SESSION['auth']['user_img'])) {
                                            echo baseurl('/') . "img/" . $_SESSION['auth']['user_img'];
                                        } else {
                                            echo "https://avatars.dicebear.com/api/avataaars/" . $_SESSION['auth']['user_name'] . ".svg";
                                        }
                                        ?>" alt="">
                        </a>
                        <ul>
                            <li><?= $_SESSION['auth']['user_name'] ?></li>
                            <li><a href=" ./officer-profile.php">প্রোফাইল</a></li>
                            <li><a href="#">ইতিহাস</a></li>
                            <li><a href="./chenge-password.php">পাসওয়ার্ড পরিবর্তন করুন</a></li>
                            <li>
                                <form action="codes/authentication.php" method="post"><button type="submit" style="background:transparent;color: var(--text-color);border: none; outline: none;" name="logout">সাইন আউট</button></form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>