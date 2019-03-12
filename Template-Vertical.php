<!-- php -->

<?php
session_start();

include "../php/connect.php";

if($_SESSION['status'] != "1" && $_SESSION["StatusUser"] != "user" && $_SESSION["isAdmin"] != "no")
{
   echo "This page for User only!";
   echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
   exit();
}

$sqluser = "SELECT * FROM tbl_user WHERE user_id={$_SESSION["user_id"]}";
$queryuser  = mysqli_query($conn, $sqluser);
$resultuser = mysqli_fetch_array($queryuser);

$sqlselectdevice = "SELECT * FROM tbl_device WHERE user_id = {$_SESSION["user_id"]}";
$queryselectdevice  = mysqli_query($conn, $sqlselectdevice);
if($queryselectdevice == true){
$resultselectdevice = mysqli_fetch_array($queryselectdevice);
}else{
  $resultselectdevice = null;
}


$sqlselectdevices = "SELECT * FROM tbl_select_devices WHERE user_id = {$_SESSION["user_id"]}";
$queryselectdevices  = mysqli_query($conn, $sqlselectdevices );
if($queryselectdevices == true){
  $resultselectdevices  = mysqli_fetch_array($queryselectdevices);
}else{
  $resultselectdevices = null;
}

$device_ID = $resultselectdevices['device_id'];

$sqldevices = "SELECT * FROM tbl_device WHERE user_id = {$_SESSION["user_id"]} AND device_id = $device_ID ";
$querydevices = mysqli_query($conn, $sqldevices);
if($querydevices == true){
$resultdevices = mysqli_fetch_array($querydevices);
}else{
  $resultdevices = null;
}

$shop_ID = $resultdevices['shop_id'];
//echo "<script>console.log('$shop_ID')</script>";

$sqlshopname = "SELECT * FROM tbl_shop WHERE user_id = {$_SESSION["user_id"]} AND shop_id = '$shop_ID' ";
$queryshopname = mysqli_query($conn, $sqlshopname);
$resultshopname = mysqli_fetch_array($queryshopname);

?>
<!doctype html>
<html class="no-js h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PeachSignage</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/icon/48x48.png">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0" href="../styles/shards-dashboards.1.0.0.min.css">
    <link rel="stylesheet" href="../styles/extras.1.0.0.min.css">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link rel="stylesheet" href="../styles/hoverimage.css">

    <link rel="stylesheet" href="../styles/peachsignagesm.css">
    <link rel="stylesheet" href="../styles/peachsignagemd.css">
    <link rel="stylesheet" href="../styles/peachsignagelg.css">
    <link rel="stylesheet" href="../styles/peachsignagexl.css">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css" />
</head>

<body class="h-100 indexbackgroundpage">
    <div class="container-fluid">
        <div class="row">
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <div class="main-navbar">
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons">&#xE5C4;</i>
                    </a>
                    <!-- </nav> -->
                </div>
                <div class="nav-wrapper">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active">
                                <i class="fas fa-home"></i>
                                <span class="menu-item">หน้าหลัก</span>
                                <a class="dropdown-item" href="../showdisplay/Deshbroad.php">หน้าหลัก</a>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active">
                                <i class="fas fa-desktop"></i>
                                <span class="menu-item">การเเสดงผลบนอุปกรณ์</span>
                                <a class="dropdown-item" href="../showdisplay/Template-Horizontal.php">เลือกรูปเเบบการเเสดงผลเเบบเเนวนอน</a>
                                <a class="dropdown-item linkactive" href="../showdisplay/Template-Vertical.php">เลือกรูปเเบบการเเสดงผลเเบบเเนวตั้ง</a>
                                <a class="dropdown-item" href="../contentsmanagement/website.php">เลือกรูปเเบบการเเสดงผลเเบบเว็บไซต์</a>
                                <a class="dropdown-item" href="../showdisplay/ShowAllList.php">รายการการเเสดงผลทั้งหมด</a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active">
                                <i class="fas fa-sliders-h"></i>
                                <span class="menu-item">การจัดการอุปกรณ์</span>
                                <a class="dropdown-item" href="../showdisplay/selectshop.php">จัดการร้านค้า</a>
                                <a class="dropdown-item" href="../statusdeviece/selectdevice.php">จัดการอุปกรณ์</a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active">
                                <i class="fas fa-file"></i>
                                <span class="menu-item">การจัดการสื่อ</span>
                                <a class="dropdown-item" href="../contentsmanagement/video.php">การจัดการวีดีโอ</a>
                                <a class="dropdown-item" href="../contentsmanagement/pic.php">การจัดการภาพ</a>
                                <a class="dropdown-item" href="../contentsmanagement/text.php">การจัดการข้อความ</a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active">
                                <i class="fas fa-cog"></i>
                                <span class="menu-item">การจัดการข้อมูลผู้ใช้งาน</span>
                                <a class="dropdown-item" href="../profile/datachange.php">เเก้ไขข้อมูลส่วนตัว</a>
                                <a class="dropdown-item" href="../profile/changepassword.php">เปลี่ยนรหัสผ่าน</a>
                                <a class="dropdown-item" href="../php/logout.php">ออกจากระบบ</a>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top" style="background-color: #24282d">
                    <nav class="nav">
                        <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                            data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                            <i class="material-icons">&#xE5D2;</i>
                        </a>
                    </nav>
                </div>
                <div class="main-content-container container-fluid px-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="card card-small">
                                <div class="card-header border-bottom">
                                    <span class="name-template">
                                        <i class="fas fa-tablet whiteicon"></i>
                                        <span class="text-mb-2">รูปเเบบเเนวตั้ง</span>
                                    </span>
                                </div>
                                <div class="card-header border-bottom">
                                    <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="container">
                                                        <img src="../images/pic/vertical/ver1.png" height="390" class="image" />
                                                        <div class="middle">
                                                            <div class="text" data-toggle="modal" data-target="#imagemodal6"><i
                                                                    class="fas fa-search-plus"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-success">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 7px; margin-top: 5px">
                                                                <a href="vertical/ver1.php" class="card-link"><button
                                                                        type="button" class="btn btn-info">เลือกรูปเเบบนี้</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="container">
                                                        <img src="../images/pic/vertical/ver2.png" height="390" class="image" />
                                                        <div class="middle">
                                                            <div class="text" data-toggle="modal" data-target="#imagemodal7"><i
                                                                    class="fas fa-search-plus"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-success">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 7px; margin-top: 5px">
                                                                <a href="vertical/ver2.php" class="card-link"><button
                                                                        type="button" class="btn btn-info">เลือกรูปเเบบนี้</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="container">
                                                        <img src="../images/pic/vertical/ver3.png" height="390" class="image" />
                                                        <div class="middle">
                                                            <div class="text" data-toggle="modal" data-target="#imagemodal8"><i
                                                                    class="fas fa-search-plus"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-success">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 7px; margin-top: 5px">
                                                                <a href="vertical/ver3.php" class="card-link"><button
                                                                        type="button" class="btn btn-info">เลือกรูปเเบบนี้</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="container">
                                                        <img src="../images/pic/vertical/ver4.png" height="390" class="image" />
                                                        <div class="middle">
                                                            <div class="text" data-toggle="modal" data-target="#imagemodal9"><i
                                                                    class="fas fa-search-plus"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-success">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 7px; margin-top: 5px">
                                                                <a href="vertical/ver4.php" class="card-link"><button
                                                                        type="button" class="btn btn-info">เลือกรูปเเบบนี้</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="container">
                                                        <img src="../images/pic/vertical/ver5.png" height="390" class="image" />
                                                        <div class="middle">
                                                            <div class="text" data-toggle="modal" data-target="#imagemodal10"><i
                                                                    class="fas fa-search-plus"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-success">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 7px; margin-top: 5px">
                                                                <a href="vertical/ver5.php" class="card-link"><button
                                                                        type="button" class="btn btn-info">เลือกรูปเเบบนี้</button>
                                                                </a>
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

    <div class="modal fade bd-example-modal-lg" id="imagemodal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/horizontal/hor1.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/horizontal/hor2.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/horizontal/hor3.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/horizontal/hor4.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/horizontal/hor5.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal6" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/vertical/ver1.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal7" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/vertical/ver2.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal8" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/vertical/ver3.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal9" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/vertical/ver4.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="imagemodal10" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: rgba(42,47,52,0)">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 15px; margin-top: 5px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center">
                                <img src="../images/pic/vertical/ver5.png" style="border-radius: 5px 5px 5px 5px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="promo-popup animated bounceIn">
        <div class="pp-intro-bar" style="font-size: 25px"> เเสดงการเลือกของคุณ
            <span class="close">
                <i class="material-icons">close</i>
            </span>
            <span class="up">
                <i class="material-icons">keyboard_arrow_up</i>
            </span>
        </div>

        <div class="extra-action">
            <?php if($resultuser['pic'] == null){ ?>
            <img src="<?php echo '../php/profile/main.png'; ?>" class="showselectwithprofile">
            <?php }else{ ?>
            <img src="<?php echo '../php/profile/'.$resultuser['pic']; ?>" class="showselectwithprofile">
            <?php } ?>
        </div>

        <div class="pp-inner-content" style="text-align: left; padding-top: 22px !important;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <i class="fas fa-shopping-cart iconsizesmall" data-toggle="modal" data-target="#adddevice"></i>
                    <span style="font-size: 20px">ร้านค้า: <span>
                            <?php if($resultshopname['shop_name'] != null) {
                        echo $resultshopname['shop_name']; }else{ ?>
                            โปรดเลือกร้านค้า
                            <?php }?>
                        </span>
                    </span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 5px">
                    <i class="fas fa-tv iconsizesmall" data-toggle="modal" data-target="#adddevice"></i>
                    <span style="font-size: 20px">อุปกรณ์: <span>
                            <?php if($resultselectdevices['device_name'] != null) {
                         echo $resultselectdevices['device_name']; }else{ ?>โปรดเลือกอุปกรณ์
                            <?php }?>
                        </span>
                    </span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 5px">
                    <i class="fas fa-eye iconsizesmall" data-toggle="modal" data-target="#adddevice"></i>
                    <span style="font-size: 20px">การเเสดงผล: <span>
                            <?php 
                    if($resultdevices['showtype'] == 'close'){
                      echo $resultdevices['table_name'];
                    }else{
                      echo $resultdevices['link'];
                    } ?>
                        </span>
                    </span>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="../scripts/extras.1.0.0.min.js"></script>
    <script src="../scripts/shards-dashboards.1.0.0.min.js"></script>
    <script src="../scripts/app/app-blog-overview.1.0.0.js"></script>
</body>

</html>