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
// if($queryselectdevice == true){
// $resultselectdevice = mysqli_fetch_array($queryselectdevice);
// }else{
//   $resultselectdevice = null;
// }


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

$template_ID = $resultdevices['template_id'];

// $table_name = $resultdevices['table_name'];

$show = $resultdevices['showtype'];

$sqlpublic = "SELECT * FROM tbl_templateALL WHERE user_id = {$_SESSION["user_id"]} AND device_id = '$device_ID' AND public_status = 1";
$querypublic  = mysqli_query($conn, $sqlpublic);
$resultpublic = mysqli_fetch_array($querypublic);

$sqlshopname = "SELECT * FROM tbl_shop WHERE user_id = {$_SESSION["user_id"]} AND shop_id = '$shop_ID' ";
$queryshopname = mysqli_query($conn, $sqlshopname);
$resultshopname = mysqli_fetch_array($queryshopname);

?>

<!-- end php -->

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
                                <a class="dropdown-item linkactive" href="../showdisplay/Deshbroad.php">หน้าหลัก</a>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active">
                                <i class="fas fa-desktop"></i>
                                <span class="menu-item">การเเสดงผลบนอุปกรณ์</span>
                                    <a class="dropdown-item" href="../showdisplay/Template-Horizontal.php">เลือกรูปเเบบการเเสดงผลเเบบเเนวนอน</a>
                                    <a class="dropdown-item" href="../showdisplay/Template-Vertical.php">เลือกรูปเเบบการเเสดงผลเเบบเเนวตั้ง</a>
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
                <div class="main-navbar sticky-top">
                    <nav class="nav">
                        <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                            data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                            <i class="material-icons">&#xE5D2;</i>
                        </a>
                    </nav>
                    <div class="main-content-container container-fluid px-4">
                        <div class="row">

                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="card card-small">
                                    <div class="card-header" style="background-color: #747476">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <span class="text-mb-2"><i class="fas fa-tv whiteicon iconsize"></i></span>
                                                <span class="text-mb-2">อุปกรณ์</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right">
                                                <button type="button" id="changedevices" class="btn btn-light"
                                                    data-dismiss="modal">เปลี่ยนอุปกรณ์</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header border-bottom" style="background-color: #2C3034">
                                        <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card">
                                                            <!-- <div class="card-header bg-transparent border-success">
                                                                <button type="submit" class="close">
                                                                    <span aria-hidden="true"></span></button>
                                                            </div> -->
                                                            <div class="card-body " style="border-radius: 5px 5px 5px 5px; padding-top: 0;">
                                                                        <div class="row">
                                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                                                        <div class="row top20 tablecol-header" style="text-align: center">
                                                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">ชื่ออุปกรณ์</div>
                                                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">เลือกอุปกรณ์</div>
                                                                        </div>

                                                                            <div class="table-responsive scroll-bar_table">
                                                                            <table class="table table-hover">
                                                                                <thead class="table-head">
                                                                                <tr>
                                                                                    <!-- <th scope="col">ชื่อ</th>
                                                                                    <th scope="col" class="table-listshow">เลือกอุปกรณ์</th> -->
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody class="table-body" >
                                                                                <?php $listloop = 1; 
                                                                                if($querydevices == true){ while ($resultdevicesLoop = mysqli_fetch_array($queryselectdevice, MYSQLI_ASSOC)) { ?>
                                                                                <tr style="text-align: center">
                                                                                    <th scope="row">
                                                                                    <?php echo $resultdevicesLoop['device_name']; ?>
                                                                                    </th>
                                                                                    <td>
                                                                                    <form action="../php/select_devices.php" method="post" enctype="multipart/form-data">
                                                                                            <input type="hidden" name="upload_device_id" value="<?php echo $resultdevicesLoop['device_id']; ?>" />
                                                                                            <input type="hidden" name="upload_device_name" value="<?php echo $resultdevicesLoop['device_name']; ?>" />
                                                                                            <input type="hidden" name="upload_device_detail" value="<?php echo $resultdevicesLoop['device_detail']; ?>" />
                                                                                            <input type="hidden" name="upload_user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                                                                                            <input type="hidden" name="upload_shop_id" value="<?php echo $shop_ID ?>" />
                                                                                    <button type="submit" class="btn btn-info" <?php if($resultselectdevices['device_id'] == $resultdevicesLoop['device_id'])
                                                                                        { echo 'style="background-color: green"' ; } ?> >
                                                                                        <?php if($resultselectdevices['device_id'] == $resultdevicesLoop['device_id']) { echo 'กำลังใช้งาน'; }else { echo 'เลือกอุปกรณ์'; } ?>
                                                                                    </button>
                                                                                    </form>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php $listloop++;} }; mysqli_close($conn);?>
                                                                                </tbody>
                                                                            </table>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        <!-- <?php if($resultselectdevices['device_name'] != null){
                                                                echo $resultselectdevices['device_name']; 
                                                            }else{
                                                                echo 'ไม่พบอุปกรณ์ที่เลือก'; 
                                                                } ?> -->
                                                                    <!-- </span> -->
                                                                <!-- </div> -->
                                                            </div>
                                                            <div class="card-footer bg-transparent border-success">


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>          
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <!-- <div class="col-lg-4 col-md-12 col-sm-12">


                            </div> -->

                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="card card-small" id="showalertisshop">
                                    <div class="card-header" style="background-color: #747476">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <span class="text-mb-2"><i class="fas fa-shopping-cart whiteicon iconsize"></i></span>
                                                <span class="text-mb-2">ร้านค้า</span>
                                            </div>
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right">
                                                <span class="text-mb-2"><span class="text-mb-2"><i class="fas fa-plus-circle whiteicon iconsize"
                                                            data-toggle="modal" data-target="#selectshop"></i></span></span>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="card-header border-bottom" style="background-color: #2C3034">
                                        <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card">
                                                            <div class="card-header bg-transparent border-success">
                                                                <button type="submit" class="close">
                                                                    <span aria-hidden="true"></span></button>
                                                            </div>
                                                            <div class="card-body" style="text-align: center">
                                                                <div style="padding-top: 30px">
                                                                    <span class="shop-name">
                                                                        <?php if($resultshopname['shop_name'] != null){
                                                                            echo $resultshopname['shop_name']; 
                                                                        }else{
                                                                            echo 'ไม่พบร้านค้าที่เลือก'; 
                                                                        }?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-transparent border-success">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 40px">

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
                            </div>
                        </div>

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
                                            <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: right">
                                                <a href="ShowAllList.php"> <span class="text-mb-2"><span class="text-mb-2"><button type="button" class="btn btn-light">ตรวจสอบการเเสดงผลทั้งหมด</button></a>
                                            </div>
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
                                                                    <span class="not-foundtemplate">ไม่พบการเเสดงของอุปกรณ์นี้!!</span>
                                                                    <br><br>
                                                                    <div class="row top20">
                                                                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12"></div>
                                                                    <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                                                    <!-- <div class="row">
                                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center">
                                                                    <i class="fas fa-arrows-alt-v whiteicon buttoniconsize"></i> 
                                                                    </div>
                                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center">
                                                                    <i class="fas fa-arrows-alt-h whiteicon buttoniconsize"></i> 
                                                                    </div>
                                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center">
                                                                    <i class="fas fa-desktop whiteicon buttoniconsize"></i> 
                                                                    </div>
                                                                    </div> -->
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
                                                                    <span class="not-foundtemplate">ไม่พบการเเสดงของอุปกรณ์นี้!!</span>
                                                                    <br><br>
                                                                    <div class="row top20">
                                                                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12"></div>
                                                                    <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                                                    <!-- <div class="row">
                                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center">
                                                                    <i class="fas fa-arrows-alt-v whiteicon buttoniconsize"></i> 
                                                                    </div>
                                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center">
                                                                    <i class="fas fa-arrows-alt-h whiteicon buttoniconsize"></i> 
                                                                    </div>
                                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 center">
                                                                    <i class="fas fa-desktop whiteicon buttoniconsize"></i> 
                                                                    </div>
                                                                    </div> -->
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

            </main>

            <div class="modal fade" id="adddevice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #24282d">
                            <h6 class="modal-title whitetext" id="exampleModalLabel">เพิ่มอุปกรณ์ประจำร้านค้า</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../php/insert_devices.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                        <input type="text" class="form-control" id="upload_device_name" name="upload_device_name"
                                            placeholder="ชื่ออุปกรณ์" required style="font-size: 20px !important;" />
                                        <br>
                                        <input type="text" class="form-control" id="id-device" name="id-device"
                                            placeholder="รหัสประจำอุปกรณ์" required style="font-size: 20px !important;" />
                                        <input type="hidden" class="form-control" id="upload_shop_id" name="upload_shop_id"
                                            value="<?php echo $resultselectshop['shop_id']?>">
                                        <input type="hidden" class="form-control" id="upload_user_id" name="upload_user_id"
                                            value="<?php echo $_SESSION['user_id']?>">
                                        <input type="hidden" class="form-control" id="upload_device_status" name="upload_device_status"
                                            value="0">
                                        <input type="hidden" class="form-control" id="upload_device_confirm" name="upload_device_confirm"
                                            value="1">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" style="background-color: #eeeeee; color: #24282d"
                                data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-secondary" style="background-color: #eeeeee; color: #24282d">บันทึก</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end popup -->

            <!-- popup -->
            <form action="../php/insert_shop.php" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="selectshop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title whitetext" id="exampleModalLabel">เพิ่มร้านค้า</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding-top: 10px; text-align: left; background-color: #24272b; margin-bottom: 40px; padding-bottom: 10px;">
                                        <span style="color: #fff; font-size: 19px; margin-left: 20px" data-toggle="modal"
                                            data-target="#sendpassfromemail">
                                            !! หากไม่ผู้ใช้งานไม่สร้างร้านค้า
                                            จะไม่สามารถใช้งานอุปกรณ์ได้
                                        </span>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">

                                        <!-- <label class="indexfontsizedefult" for="upload_name" style="text-align: left">ชื่อร้าน :</label> -->
                                        <input class="form-control" type="text" id="upload_name" name="upload_name"
                                            required placeholder="ร้านค้า" style="font-size: 20px !important;" />

                                        <input type="hidden" id="upload_user_id" name="upload_user_id" value="<?php echo $_SESSION['user_id']?>" />

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" style="background-color: #eeeeee; color: #24282d"
                                    data-dismiss="modal">ยกเลิก</button>
                                <button type="submit" id="uploadprofilebutton" class="btn btn-secondary" style="background-color: #eeeeee; color: #24282d">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <!-- <div class="promo-popup animated bounceIn">
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

            </div> -->


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
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

            <script>
                $(document).ready(function (e) {

                    // $("#showalertisshop").click(function (e) {
                    //     var data = "ขออภัยตรง"
                    //             alertify.alert('Peach Signage System', data, function () {
                    //               alertify.success('Ok');
                    //             });
                    //       });

                    $("#changedevices").click(function () {
                        location.href="../statusdeviece/selectdevice.php";
                    });

                });
            </script>

</body>

</html>