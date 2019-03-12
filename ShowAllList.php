<!-- php -->

<?php
session_start();

include "../php/connect.php";

if($_SESSION['status'] != "1" && $_SESSION["StatusUser"] != "user" && $_SESSION["isAdmin"] != "no")
{
   $message = "คุณยังไม่ได้รับการยืนยันจากผู้ดูเเลระบบ";
   echo "<script type='text/javascript'>alert('$message');</script>";
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

$sqlAllshow = "SELECT * FROM tbl_templateALL WHERE user_id={$_SESSION["user_id"]} AND device_id = '$device_ID' ORDER BY template_id DESC";
$queryAllshow  = mysqli_query($conn, $sqlAllshow);
$row_cnt = mysqli_num_rows($queryAllshow);

$sqldevices = "SELECT * FROM tbl_device WHERE user_id = {$_SESSION["user_id"]} AND device_id = $device_ID ";
$querydevices = mysqli_query($conn, $sqldevices);
if($querydevices == true){
$resultdevices = mysqli_fetch_array($querydevices);
}else{
  $resultdevices = null;
}

$shop_ID = $resultdevices['shop_id'];
$sqlshopname = "SELECT * FROM tbl_shop WHERE user_id = {$_SESSION["user_id"]}  ";
$queryshopname = mysqli_query($conn, $sqlshopname);
$resultshopname = mysqli_fetch_array($queryshopname);

if($resultdevices["previewmode"] == 'no'){
//check database
$sqlpublic = "SELECT * FROM tbl_templateALL WHERE user_id = {$_SESSION["user_id"]} AND device_id = '$device_ID' AND public_status = 1";
$querypublic  = mysqli_query($conn, $sqlpublic);
$resultpublic = mysqli_fetch_array($querypublic);

}else{

$sqlpreview = "SELECT * FROM tbl_priview WHERE user_id = {$_SESSION["user_id"]} AND device_id = '$device_ID'";
$querypreview  = mysqli_query($conn, $sqlpreview);
$resultpublic = mysqli_fetch_array($querypreview);

}

?>

<!-- end php -->

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
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">

  <link rel="stylesheet" href="../styles/peachsignagesm.css">
  <link rel="stylesheet" href="../styles/peachsignagemd.css">
  <link rel="stylesheet" href="../styles/peachsignagelg.css">
  <link rel="stylesheet" href="../styles/peachsignagexl.css">

  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css" />

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


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
                <a class="dropdown-item" href="../showdisplay/Template-Vertical.php">เลือกรูปเเบบการเเสดงผลเเบบเเนวตั้ง</a>
                <a class="dropdown-item" href="../contentsmanagement/website.php">เลือกรูปเเบบการเเสดงผลเเบบเว็บไซต์</a>
                <a class="dropdown-item linkactive" href="../showdisplay/ShowAllList.php">รายการการเเสดงผลทั้งหมด</a>
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
        <div class="main-navbar sticky-top">
          <nav class="nav">
            <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
              data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
              <i class="material-icons">&#xE5D2;</i>
            </a>
          </nav>

        </div>
        <div class="main-content-container container-fluid px-4">

        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card card-small">
                                    <div class="card-header" style="background-color: #747476">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <span class="text-mb-2"><i class="fas fa-tv whiteicon iconsize"
                                                        data-toggle="modal" data-target="#adddevice"></i></span>
                                                <span class="text-mb-2">รูปเเบบการเเสดง</span>
                                            </div>
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right">
                                                <a href="Template.php"> <span class="text-mb-2"><span class="text-mb-2"><i
                                                                class="fas fa-plus-circle whiteicon iconsize"
                                                                data-toggle="modal" data-target="#adddevice"></i></span></span></a>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="card-header border-bottom" style="background-color: #2C3034">
                                        <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <?php if($resultpublic['typevalue'] == 'template'){ ?>

                                                    <?php if($resultpublic['template_select_id'] == '11'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-2 col-md-2 col-sm-2" style="background-color: #24282d; border-radius: 25px 0px 0px 25px; position: static; width: 200px; height: 550px;">
                                                                <?php if($resultpublic['image_type_1'] == "image") {
                                                                    $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                    <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                        width='100%' />
                                                                    <?php }else{
                                                                $e = explode("|", $resultpublic['image_slide_1']);
                                                                foreach ($e as $key) {
                                                                    if($key != ''){ ?>
                                                                    <img class='mySlides' src='../<?php echo $key; ?>'
                                                                        class='img-fluid' width='100%' />
                                                                    <?php }
                                                                }
                                                                } ?>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #24282d; border-radius: 0px 25px 0px 0px; position: static; width: 600px; height: 500px;">
                                                                        <video width="100%" height="100%" style="margin-top:10px"
                                                                            controls>
                                                                            <source src="../<?php echo $resultpublic['video']; ?>"
                                                                                type="video/mp4"> </video>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-md-9 col-sm-9" style="background-color: #24282d;">
                                                                        <div class="textsilde">
                                                                            <div class="fontslide">
                                                                                <?php echo $resultpublic['text_content']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-3 col-sm-3" style="background-color: #24282d; border-radius: 0px 0px 25px 0px">
                                                                        <span class="time">12.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        var myIndex = 0;
                                                        carousel();
                                                        function carousel() {
                                                            var i;
                                                            var x = document.getElementsByClassName("mySlides");
                                                            for (i = 0; i < x.length; i++) {
                                                                x[i].style.display = "none";
                                                            }
                                                            myIndex++;
                                                            if (myIndex > x.length) {myIndex = 1}
                                                            x[myIndex-1].style.display = "block";
                                                            setTimeout(carousel, 2000);
                                                        }
                                                    </script>

                                                    <?php }else if($resultpublic['template_select_id'] == '12'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6 col-md-6 col-sm-6" style="background-color: #24282d; border-radius: 25px 0px 0px 25px; position: relative; width: 600px; height: 550px; object-fit:cover;">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
                                                                        <video width="100%" height="100%" controls>
                                                                            <source src="../<?php echo $resultpublic['video']; ?>"
                                                                                type="video/mp4"> </video>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-sm-3 col-2" style="position: static; width: 200px; height: 550px; background-color: #24282d; border-radius: 0px 25px 25px 0px;">

                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='210' height="530px" style="margin-top: 10px" />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='210' height="530px" style="margin-top: 10px" />
                                                                <?php }}}?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                            carousel();
                                                                            function carousel() {
                                                                                var i;
                                                                                var x = document.getElementsByClassName("mySlides");
                                                                                for (i = 0; i < x.length; i++) {
                                                                                    x[i].style.display = "none";
                                                                                }
                                                                                myIndex++;
                                                                                if (myIndex > x.length) {myIndex = 1}
                                                                                x[myIndex-1].style.display = "block";
                                                                                setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                            }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    <?php }else if($resultpublic['template_select_id'] == '13'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="margin: 0;position: static; width: 400px; height: 350px; background-color: #24282d; border-radius: 25px 0px 0px 0px;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='470px' height="350px" style="margin-top: 15px" />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key;?>' class='img-fluid'
                                                                    width='470px' height="350px" style="margin-top: 15px" />
                                                                <?php  } } } ?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                carousel();
                                                                function carousel() {
                                                                    var i;
                                                                    var x = document.getElementsByClassName("mySlides");
                                                                    for (i = 0; i < x.length; i++) {
                                                                        x[i].style.display = "none";
                                                                    }
                                                                    myIndex++;
                                                                    if (myIndex > x.length) {myIndex = 1}
                                                                    x[myIndex-1].style.display = "block";
                                                                    setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                }
                                                                </script>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="margin: 0;position: static; width: 400px; height: 350px; background-color: #24282d; border-radius: 0px 25px 0px 0px;">
                                                                <?php if($resultpublic['image_type_2'] == "image"){ $image2 = explode("|", $resultpublic['image_slide_2']); ?>
                                                                <img src='../<?php echo $image2[1]; ?>' class='img-fluid'
                                                                    width='470px' height="350px" style="margin-top: 15px" />
                                                                <?php }else{ $e2 = explode("|", $resultpublic['image_slide_2']); foreach ($e2 as $key2) { if($key2 != ''){ ?>
                                                                <img class='mySlides2' src='../<? echo $key2; ?>' class='img-fluid'
                                                                    width='470px' height="350px" style="margin-top: 15px" />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex2 = 0;
                                                            carousel2();
                                                            function carousel2() {
                                                                var i;
                                                                var x = document.getElementsByClassName("mySlides2");
                                                                for (i = 0; i < x.length; i++) {
                                                                    x[i].style.display = "none";
                                                                }
                                                                myIndex2++;
                                                                if (myIndex2 > x.length) {myIndex2 = 1}
                                                                x[myIndex2-1].style.display = "block";
                                                                setTimeout(carousel2, 2000); // Change image every 2 seconds
                                                            }
                                                            </script>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8 col-md-8 col-sm-8" style="position: static; width: 800px; height: 200px; background-color: #24282d; border-radius: 0px 0px 25px 25px;">
                                                                <?php if($resultpublic['image_type_3'] == "image"){  $image3 = explode("|", $resultpublic['image_slide_3']); ?>
                                                                <img src='../<?php echo $image3[1]; ?>' class='img-fluid'
                                                                    width='975px' height="170px" style="margin-top: 15px" />
                                                                <?php }else{ $e3 = explode("|", $resultpublic['image_slide_3']); foreach ($e3 as $key3) { if($key3 != ''){ ?>
                                                                <img class='mySlides3' src='../<?php echo $key3; ?>'
                                                                    class='img-fluid' width='975px' height="170px"
                                                                    style="margin-top: 15px" />
                                                                <?php }}} ?>
                                                                <script>
                                                                    var myIndex3 = 0;
                                                                carousel3();
                                                                function carousel3() {
                                                                    var i;
                                                                    var x = document.getElementsByClassName("mySlides3");
                                                                    for (i = 0; i < x.length; i++) {
                                                                        x[i].style.display = "none";
                                                                    }
                                                                    myIndex3++;
                                                                    if (myIndex3 > x.length) {myIndex3 = 1}
                                                                    x[myIndex3-1].style.display = "block";
                                                                    setTimeout(carousel3, 2000); // Change image every 2 seconds
                                                                }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div> 


                                                    <?php }else if($resultpublic['template_select_id'] == '14'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b; border-radius:25px 0px 0px 0px;"></div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-md-9 col-sm-9" style="background-color: #24282d;">
                                                                        <div class="textsilde">
                                                                            <div class="fontslide">
                                                                                <?php echo $resultpublic['text_content']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-3 col-sm-3" style="background-color: #24282d;">
                                                                        <span class="time">12.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b; border-radius: 0px 25px 0px 0px"></div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b;"></div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6" style="background-color: #24282d;">
                                                                <video width="100%" style="margin-top:10px" controls>
                                                                    <source src="../<?php echo $resultpublic['video']; ?>"
                                                                        type="video/mp4">
                                                                </video>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b;">
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b; border-radius: 0px 0px 0px 25px">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6" style="background-color: #24282d;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='730px' height="100px" style='margin-top: 5px;margin-bottom: 5px' />
                                                                <?php }else{  $e = explode("|", $resultpublic['image_slide_1']);  foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='730px' height="100px"
                                                                    style='margin-top: 5px;margin-bottom: 5px' />
                                                                <?php } } } ?>

                                                                <script>
                                                                    var myIndex = 0;
                                                                        carousel();
                                                                        function carousel() {
                                                                            var i;
                                                                            var x = document.getElementsByClassName("mySlides");
                                                                            for (i = 0; i < x.length; i++) {
                                                                                x[i].style.display = "none";
                                                                            }
                                                                            myIndex++;
                                                                            if (myIndex > x.length) {myIndex = 1}
                                                                            x[myIndex-1].style.display = "block";
                                                                            setTimeout(carousel, 2000); 
                                                                        }
                                                            </script>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b; border-radius: 0px 0px 25px 0px"></div>
                                                        </div>
                                                    </div>  

                                                    <?php }else if($resultpublic['template_select_id'] == '15'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6 col-md-6 col-sm-6" style="margin: 0;position: static; width: 600px; height: 500px; background-color: #24282d; border-radius: 25px 0px 0px 0px;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='730px' height="530px" style='margin-top: 5px' />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='730px' height="530px"
                                                                    style='margin-top: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                        carousel();
                                                                        function carousel() {
                                                                            var i;
                                                                            var x = document.getElementsByClassName("mySlides");
                                                                            for (i = 0; i < x.length; i++) {
                                                                                x[i].style.display = "none";
                                                                            }
                                                                            myIndex++;
                                                                            if (myIndex > x.length) {myIndex = 1}
                                                                            x[myIndex-1].style.display = "block";
                                                                            setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                    }
                                                                    </script>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-sm-2" style="margin: 0;position: static; width: 200px; height: 500px; background-color: #24282d; border-radius: 0px 25px 0px 0px;">
                                                                <?php if($resultpublic['image_type_2'] == "image"){ $image2 = explode("|", $resultpublic['image_slide_2']); ?>
                                                                <img src='../<?php echo $image2[1]; ?>' class='img-fluid'
                                                                    width='210px' height="530px" style='margin-top: 5px' />
                                                                <?php }else{  $e2 = explode("|", $resultpublic['image_slide_2']); foreach ($e2 as $key2) { if($key2 != ''){ ?>
                                                                <img class='mySlides2' src='../<?php echo $key2; ?>'
                                                                    class='img-fluid' width='210px' height="530px"
                                                                    style='margin-top: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex2 = 0;
                                                                carousel2();
                                                                    function carousel2() {
                                                                        var i;
                                                                        var x = document.getElementsByClassName("mySlides2");
                                                                        for (i = 0; i < x.length; i++) {
                                                                            x[i].style.display = "none";
                                                                        }
                                                                        myIndex2++;
                                                                        if (myIndex2 > x.length) {myIndex2 = 1}
                                                                        x[myIndex2-1].style.display = "block";
                                                                        setTimeout(carousel2, 2000); // Change image every 2 seconds
                                                                }
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8 col-md-8 col-sm-8" style="background-color: #24282d; border-radius: 0px 0px 25px 25px;">
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                                        <div class="textsilde">
                                                                            <div class="fontslide">
                                                                                <?php echo $resultpublic['text_content']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                                        <span class="time">12.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    

                                                    <?php }else if($resultpublic['template_select_id'] == '21'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 25px 25px 0px 0px;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='100%' height='730px' style='margin-top: 5px' />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='100%' height='730px' style='margin-top: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                            carousel();
                                                                            function carousel() {
                                                                                var i;
                                                                                var x = document.getElementsByClassName("mySlides");
                                                                                for (i = 0; i < x.length; i++) {
                                                                                x[i].style.display = "none";
                                                                                }
                                                                                myIndex++;
                                                                                if (myIndex > x.length) {myIndex = 1}
                                                                                x[myIndex-1].style.display = "block";
                                                                                setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                            }
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 0px 0px 25px 25px;">
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                                        <div class="textsilde">
                                                                            <div class="fontslide">
                                                                                <?php echo $resultpublic['text_content']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                                        <span class="time">12.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  

                                                    <?php }else if($resultpublic['template_select_id'] == '22'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 25px 25px 0px 0px;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='100%' height='220px' style='margin-top: 5px' />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='100%' height='220px' style='margin-top: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                carousel();
                                                                function carousel() {
                                                                    var i;
                                                                    var x = document.getElementsByClassName("mySlides");
                                                                    for (i = 0; i < x.length; i++) {
                                                                        x[i].style.display = "none";
                                                                    }
                                                                    myIndex++;
                                                                    if (myIndex > x.length) {myIndex = 1}
                                                                    x[myIndex-1].style.display = "block";
                                                                    setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                }
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d">
                                                                <video width="100%" style="margin-top:10px" controls>
                                                                    <source src="../<?php echo $resultpublic['video']; ?>"
                                                                        type="video/mp4">
                                                                </video>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="textsilde">
                                                                            <div class="fontslide">
                                                                                <?php echo $resultpublic['text_content']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 0px 0px 25px 25px;">
                                                                <?php if($resultpublic['image_type_2'] == "image"){ $image2 = explode("|", $resultpublic['image_slide_2']); ?>
                                                                <img src='../<?php echo $image2[1]; ?>' class='img-fluid'
                                                                    width='100%' height='220px' style='margin-bottom: 10px' />
                                                                <?php }else{ $e2 = explode("|", $resultpublic['image_slide_2']); foreach ($e2 as $key2) { if($key2 != ''){ ?>
                                                                <img class='mySlides2' src='../<?php echo $key2; ?>'
                                                                    class='img-fluid' width='100%' height='220px' style='margin-bottom: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex2 = 0;
                                                                carousel2();
                                                                function carousel2() {
                                                                    var i;
                                                                    var x = document.getElementsByClassName("mySlides2");
                                                                    for (i = 0; i < x.length; i++) {
                                                                        x[i].style.display = "none";
                                                                    }
                                                                    myIndex2++;
                                                                    if (myIndex2 > x.length) {myIndex2 = 1}
                                                                    x[myIndex2-1].style.display = "block";
                                                                    setTimeout(carousel2, 2000); // Change image every 2 seconds
                                                                }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>  

                                                    <?php }else if($resultpublic['template_select_id'] == '23'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 25px 25px 0px 0px;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='100%' height="240" style='margin-top: 5px' />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='100%' height="240" style='margin-top: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                carousel();
                                                                function carousel() {
                                                                    var i;
                                                                    var x = document.getElementsByClassName("mySlides");
                                                                    for (i = 0; i < x.length; i++) {
                                                                        x[i].style.display = "none";
                                                                    }
                                                                    myIndex++;
                                                                    if (myIndex > x.length) {myIndex = 1}
                                                                    x[myIndex-1].style.display = "block";
                                                                    setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                }
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d">
                                                                <?php if($resultpublic['image_type_2'] == "image"){ $image2 = explode("|", $resultpublic['image_slide_2']); ?>
                                                                <img src='../<?php echo $image2[1]; ?>' class='img-fluid'
                                                                    width='100%' height="240" style='margin-top: 5px' />
                                                                <?php }else{ $e2 = explode("|", $resultpublic['image_slide_2']); foreach ($e2 as $key2) { if($key2 != ''){ ?>
                                                                <img class='mySlides2' src='../<?php echo $key2; ?>'
                                                                    class='img-fluid' width='100%' height="240" style='margin-top: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex2 = 0;
                                                                carousel2();
                                                                function carousel2() {
                                                                    var i;
                                                                    var x = document.getElementsByClassName("mySlides2");
                                                                    for (i = 0; i < x.length; i++) {
                                                                    x[i].style.display = "none";
                                                                    }
                                                                    myIndex2++;
                                                                    if (myIndex2 > x.length) {myIndex2 = 1}
                                                                    x[myIndex2-1].style.display = "block";
                                                                    setTimeout(carousel2, 2000);
                                                                }
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 0px 0px 25px 25px;">
                                                                <?php if($resultpublic['image_type_3'] == "image"){ $image3 = explode("|", $resultpublic['image_slide_3']); ?>
                                                                <img src='../<? echo $image3[1]; ?>' class='img-fluid'
                                                                    width='100%' height="240" style='margin-top: 10px; margin-bottom: 10px' />
                                                                <?php }else{ $e3 = explode("|", $resultpublic['image_slide_3']); foreach ($e3 as $key3) { if($key3 != ''){ ?>
                                                                <img class='mySlides3' src='../<?php echo $key3; ?>'
                                                                    class='img-fluid' width='100%' height="240" style='margin-top: 10px; margin-bottom: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex3 = 0;
                                                                    carousel3();
                                                                    function carousel3() {
                                                                        var i;
                                                                        var x = document.getElementsByClassName("mySlides3");
                                                                        for (i = 0; i < x.length; i++) {
                                                                        x[i].style.display = "none";
                                                                        }
                                                                        myIndex3++;
                                                                        if (myIndex3 > x.length) {myIndex3 = 1}
                                                                        x[myIndex3-1].style.display = "block";
                                                                        setTimeout(carousel3, 2000);
                                                                    }
                                                                    </script>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php }else if($resultpublic['template_select_id'] == '24'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 25px 25px 25px 25px;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='100%' height="780px" style='margin-top: 10px; margin-bottom: 10px' />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='100%' height="780px" style='margin-top: 10px; margin-bottom: 10px' />
                                                                <?php }  } } ?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                carousel();
                                                                function carousel() {
                                                                    var i;
                                                                    var x = document.getElementsByClassName("mySlides");
                                                                    for (i = 0; i < x.length; i++) {
                                                                        x[i].style.display = "none";
                                                                    }
                                                                    myIndex++;
                                                                    if (myIndex > x.length) {myIndex = 1}
                                                                    x[myIndex-1].style.display = "block";
                                                                    setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                }
                                                                </script>
                                                            </div>
                                                        </div>   
                                                    </div>


                                                    <?php }else if($resultpublic['template_select_id'] == '25'){ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 25px 25px 0px 0px;">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="textsilde">
                                                                            <div class="fontslide">
                                                                                <?php echo $resultpublic['text_content']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d">
                                                                <video width="100%" style="margin-top:10px" controls>
                                                                    <source src="../<?php echo $resultpublic['video']; ?>"
                                                                        type="video/mp4">
                                                                </video>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-4 col-md-4 col-sm-4" style="background-color: #24282d; border-radius: 0px 0px 25px 25px;">
                                                                <?php if($resultpublic['image_type_1'] == "image"){ $image = explode("|", $resultpublic['image_slide_1']); ?>
                                                                <img src='../<?php echo $image[1]; ?>' class='img-fluid'
                                                                    width='100%' height="450px" style='margin-top: 10px; margin-bottom: 10px' />
                                                                <?php }else{ $e = explode("|", $resultpublic['image_slide_1']); foreach ($e as $key) { if($key != ''){ ?>
                                                                <img class='mySlides' src='../<?php echo $key; ?>'
                                                                    class='img-fluid' width='100%' height="450px" style='margin-top: 10px; margin-bottom: 10px' />
                                                                <?php } } } ?>
                                                                <script>
                                                                    var myIndex = 0;
                                                                    carousel();
                                                                    function carousel() {
                                                                        var i;
                                                                        var x = document.getElementsByClassName("mySlides");
                                                                        for (i = 0; i < x.length; i++) {
                                                                            x[i].style.display = "none";
                                                                        }
                                                                        myIndex++;
                                                                        if (myIndex > x.length) {myIndex = 1}
                                                                        x[myIndex-1].style.display = "block";
                                                                        setTimeout(carousel, 2000); // Change image every 2 seconds
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>  

                                                    <?php }else{ ?>

                                                    <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="alert" role="alert">
                                                                    <span class="not-foundtemplate">ไม่พบการเเสดงของรูปเเบบนี้!!</span>
                                                                    <span class="not-foundtemplate">โปรดเลือกการเเสดงด้านล่าง</span>
                                                                    <br><br>
                                                                    <a href="./Template.php">
                                                                        <button type="button" class="btn btn-info">เพิ่มรูปเเบบ</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php }}else if($resultpublic['typevalue'] == 'website'){  ?>

                                                    <div class="container-fluid">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <iframe src="<?php echo $resultdevices['link']?>" width="100%"
                                                                    height="500px"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php }else{?>

                                                        <div class="container-fluid margintopdisplay">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="alert" role="alert">
                                                                    <span class="not-foundtemplate">ไม่พบการเเสดงของรูปเเบบนี้!!</span>
                                                                    <span class="not-foundtemplate">โปรดเลือกการเเสดงด้านล่าง</span>
                                                                    <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php } ?>
                                                </div>
                                            </div>          
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>

                        <div class="row top20">
                        <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12"></div>
                        <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                        <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center top20">
                            <a href="./Template-Vertical.php"><button type="button" class="btn btn-light">เพิ่มรูปเเบบการเเสดงผลเเนวตั้ง</button></a>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center top20">
                            <a href="./Template-Horizontal.php"><button type="button" class="btn btn-light">เพิ่มรูปเเบบการเเสดงผลเเนวนอน</button></a>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center top20">
                        <a href="../contentsmanagement/website.php"><button type="button" class="btn btn-light">เพิ่มรูปเเบบการเเสดงผลเว็บไซต์</button></a>
                        </div>
                        </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12"></div>
                        </div>

  <div class="row top20nobottom">
                  <div class="col-lg-12 col-md-12 col-sm-12 paddingtable">

                  <?php
                  if(1 == 1){ ?>

                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="table-head">
                          <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <!-- <th scope="col">สถานะ</th> -->
                            <th scope="col">วันที่เริ่มเผยเเพร่</th>
                            <th scope="col">วันที่หยุดเผยเเพร่</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">บันทึก</th>
                            <th scope="col">พรีวิว</th>
                            <th scope="col" class="table-listshow">เเสดงบนจอ Signage</th>
                            <th scope="col" class="table-listshow">ยกเลิก</th>
                            <th scope="col" class="table-listdelete">ลบ</th>
                          </tr>
                        </thead>
                        <tbody class="table-body">

                          <?php $listloop = 1;  if($queryAllshow == true){ while ($resultAllshow = mysqli_fetch_array($queryAllshow, MYSQLI_ASSOC)) { ?>
                          <tr>
                            <th scope="row">
                              <?php echo $listloop; ?>
                            </th>
                            <td>
                              <?php echo $resultAllshow['namesave']; ?>
                            </td>
                            <td>
                            <form action="../php/update/updatetime.php" method="post">
                            <input type="text" class="form-control" value="<?php echo $resultAllshow['start_time']; ?>" name="starttime" placeholder="วันที่เริ่มการเผยเเพร่" />
                            </td>
                            <td>
                            <input type="text" class="form-control" value="<?php echo $resultAllshow['end_time']; ?>" name="endtime" placeholder="วันที่เริ่มการเผยเเพร่" />
                            </td>
                            <td>
                            <!-- <form action="../php/update/updatetime.php" method="post"> -->
                                    <input type="hidden" id="template_id" name="template_id" value="<?php echo $resultAllshow['template_id']?>" />
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["user_id"]; ?>" />
                              <button type="submit" class="btn btn-info"> บันทึก  </button>
                            </form>
                            </td>
                            <td>
                              <?php echo $resultAllshow['typevalue']; ?>
                            </td>
                            <td>
                              <?php echo $resultAllshow['orientation']; ?>
                            </td>
                            <td>
                            <form name="previewform" action="../php/update/updatepreview.php" method="post">
                              <input type="hidden" class="form-control" id="template_id" name="template_id" value="<?php echo $resultAllshow['template_id']?>" />
                                <input type="hidden" id="namesave" name="namesave" value="<?php echo $resultAllshow['namesave']?>" />
                                <input type="hidden" id="template_select_id" name="template_select_id" value="<?php echo $resultAllshow['template_select_id']?>" />
                                <input type="hidden" id="video" name="video" value="<?php echo $resultAllshow['video']?>" />
                                <input type="hidden" id="text_content" name="text_content" value="<?php echo $resultAllshow['text_content']?>" />
                                <input type="hidden" id="image_slide_1" name="image_slide_1" value="<?php echo $resultAllshow['image_slide_1']?>" />
                                <input type="hidden" id="image_type_1" name="image_type_1" value="<?php echo $resultAllshow['image_type_1']?>" />
                                <input type="hidden" id="image_slide_2" name="image_slide_2" value="<?php echo $resultAllshow['image_slide_2']?>" />
                                <input type="hidden" id="image_type_2" name="image_type_2" value="<?php echo $resultAllshow['image_type_2']?>" />
                                <input type="hidden" id="image_slide_3" name="image_slide_3" value="<?php echo $resultAllshow['image_slide_3']?>" />
                                <input type="hidden" id="image_type_3" name="image_type_3" value="<?php echo $resultAllshow['image_type_3']?>" />
                                <input type="hidden" id="typevalue" name="typevalue" value="<?php echo $resultAllshow['typevalue']?>" />
                                <input type="hidden" id="web_content" name="web_content" value="<?php echo $resultAllshow['web_content']?>" />
                                <input type="hidden" id="shownow" name="shownow" value="<?php echo $resultAllshow['shownow']?>" />
                                <input type="hidden" id="shop_id" name="shop_id" value="<?php echo $resultAllshow['shop_id']?>" />
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $resultAllshow['user_id']?>" />
                                <input type="hidden" id="device_id" name="device_id" value="<?php echo $resultAllshow['device_id']?>" />
                                <input type="hidden" id="upload_on" name="upload_on" value="<?php echo $resultAllshow['upload_on']?>" />
                                <input type="hidden" id="public_status" name="public_status" value="<?php echo $resultAllshow['public_status']?>" />
                                <input type="hidden" id="orientation" name="orientation" value="<?php echo $resultAllshow['orientation']?>" />

                                <button type="submit"  <?php if($resultAllshow['preview'] == 'yes'){ echo 'class="btn btn-success"'; }else{ echo 'class="btn btn-info"'; } ?>> พรีวิว </button>

                              </form>
                            </td>
                            <td>
                              <form action="../php/select_template/select_template_hor_1.php" method="post">
                                    <input type="hidden" id="template_id" name="template_id" value="<?php echo $resultAllshow['template_id']?>" />
                                    <input type="hidden" id="shop_id" name="shop_id" value="<?php echo $resultAllshow['shop_id']?>" />
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $resultAllshow['user_id']?>" />
                                    <input type="hidden" id="device_id" name="device_id" value="<?php echo $resultAllshow['device_id']?>" />
                                    <input type="hidden" id="typevalue" name="typevalue" value="<?php echo $resultAllshow['typevalue']?>" />
                                    <input type="hidden" id="urllink" name="urllink" value="<?php echo $resultAllshow['web_content']?>" />
                              <button type="submit" class="close" aria-label="Close"> 
                                 <i class="fas fa-eye" id="showtheme<?php echo $listloop; ?>" style="color: #5B838D; font-size: 30px"></i> 
                              </button>
                              </form>
                            </td>
                            <td>
                              <form name="delete_form" action="../php/unselect_template/unselect_template_hor_1.php" method="post">
                                <input type="hidden" class="form-control" id="template_id" name="template_id" value="<?php echo $resultAllshow['template_id']?>" />
                                <input type="hidden" class="form-control" id="device_id" name="device_id" value="<?php echo $resultAllshow['device_id']?>" />
                                <button type="submit" class="close" aria-label="Close">
                                  <?php if($resultAllshow['public_status'] == 1){ echo '<i class="fas fa-ban" style="color: #5B838D; font-size: 30px"></i>'; } ?>
                                </button>
                              </form>
                            </td>
                            <td>
                              <form name="delete_form" action="../php/delete/delete_tem_hor1.php" method="post">
                                <input type="hidden" id="template_id" name="template_id" value="<?php echo $resultAllshow['template_id']?>" />
                                <button type="submit" class="close" aria-label="Close" style="padding-right: 10px">
                                  <?php if($resultAllshow['public_status'] == 0){ echo '<i class="fas fa-trash-alt" style="color: #5B838D; font-size: 30px"></i>'; } ?>
                                </button>
                              </form>
                            </td>
                          </tr>
                          <?php $listloop++;} }; mysqli_close($conn);?>
                        </tbody>
                      </table>
                    </div>

                             <?php }else{ ?>

                                <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="table-head">
                          <tr>
                          </tr>
                        </thead>
                        <tbody class="table-body">
                          <tr>
                            <td>

                            <div class="container-fluid margintopdisplay">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="alert" role="alert">
                                            <span class="not-listitem">ไม่พบรายการเเสดงผลของอุปกรณ์นี้!!</span>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            </td>

                        </tbody>
                      </table>
                    </div>
                            <?php } ?>

                  </div>
                </div>
            </div>
            </main>
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
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
  <!-- <script src="../../imgCheckbox-master/jquery.imgcheckbox.js"></script> -->

  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>
    $(document).ready(function (e) {

        moment.locale('th');
          $("#showtime").html(moment().format('HH:mm'));
          $("#showdate").html(moment().format('YYYY-MM-DD'));

          $('input[name="starttime"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            showDropdowns: true,
            drops: 'up',
            locale: {
                format: 'DD-MM-YY H:mm'
            }

          });

          $('input[name="endtime"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            showDropdowns: true,
            drops: 'up',
            locale: {
                format: 'DD-MM-YY H:mm'
            }

          });


      function uploadFormData(formData) {
        $.ajax({
          url: "../php/select_template/select_template_hor_1.php",
          type: "POST",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            alertify.alert('Peach Signage System', data, function () {
              alertify.success('Ok');
            });
            setTimeout(() => location.reload(), 4000);
          }
        });
      }

    });
  </script>

</body>

</html>