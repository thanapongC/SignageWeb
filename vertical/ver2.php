<!-- php -->
<?php
session_start();
include "../../php/connect.php";
if($_SESSION['status'] != "1" && $_SESSION["StatusUser"] != "user" && $_SESSION["isAdmin"] != "no")
{
   echo "This page for User only!";
   echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
   exit();
}

$sqlpic = "SELECT * FROM tbl_image WHERE user_id = {$_SESSION["user_id"]}";
$querypic  = mysqli_query($conn, $sqlpic);

$sqlpic2 = "SELECT * FROM tbl_image WHERE user_id = {$_SESSION["user_id"]}";
$querypic2  = mysqli_query($conn, $sqlpic2);

$sqlvideo = "SELECT * FROM tbl_video WHERE user_id = {$_SESSION["user_id"]}";
$queryvideo  = mysqli_query($conn, $sqlvideo);

$sqltext = "SELECT * FROM tbl_text WHERE user_id = {$_SESSION["user_id"]}";
$querytext  = mysqli_query($conn, $sqltext);

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

<!-- end php -->
<!doctype html>
<html class="no-js h-100" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>PeachSignage</title>
  <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="../../images/icon/48x48.png">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0" href="../../styles/shards-dashboards.1.0.0.min.css">
  <link rel="stylesheet" href="../../styles/extras.1.0.0.min.css">
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <link rel="stylesheet" href="../../styles/switch.css">

  <!-- <link rel="stylesheet" href="../../styles/peachsignage.css"> -->
  <link rel="stylesheet" href="../../styles/peachsignagesm.css">
  <link rel="stylesheet" href="../../styles/peachsignagemd.css">
  <link rel="stylesheet" href="../../styles/peachsignagelg.css">
  <link rel="stylesheet" href="../../styles/peachsignagexl.css">

  <link rel="stylesheet" href="../../styles/upload_style.css">
  <link rel="stylesheet" href="../../styles/imageslide.css">
  <link rel="stylesheet" href="../../styles/hoverimage.css">
  <link rel="stylesheet" href="../../styles/radio.css">
  <link rel="stylesheet" href="../../styles/dropzone/dropzone.min.css">
  <link rel="stylesheet" href="../../styles/sweetalert2.min.css">
  <link rel="stylesheet" href="../../styles/sweetalert2.css">

  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css" />
  <script src="../../styles/dropzone/dropzone.min.js"></script>

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
                <a class="dropdown-item" href="../../showdisplay/Deshbroad.php">หน้าหลัก</a>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link active">
                <i class="fas fa-desktop"></i>
                <span class="menu-item">การเเสดงผลบนอุปกรณ์</span>
                <a class="dropdown-item" href="../../showdisplay/Template-Horizontal.php">เลือกรูปเเบบการเเสดงผลเเบบเเนวนอน</a>
                <a class="dropdown-item linkactive" href="../../showdisplay/Template-Vertical.php">เลือกรูปเเบบการเเสดงผลเเบบเเนวตั้ง</a>
                <a class="dropdown-item" href="../../contentsmanagement/website.php">เลือกรูปเเบบการเเสดงผลเเบบเว็บไซต์</a>
                <a class="dropdown-item" href="../../showdisplay/ShowAllList.php">รายการการเเสดงผลทั้งหมด</a>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="fas fa-sliders-h"></i>
                <span class="menu-item">การจัดการอุปกรณ์</span>
                <a class="dropdown-item" href="../../showdisplay/selectshop.php">จัดการร้านค้า</a>
                <a class="dropdown-item" href="../../statusdeviece/selectdevice.php">จัดการอุปกรณ์</a>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="fas fa-file"></i>
                <span class="menu-item">การจัดการสื่อ</span>
                <a class="dropdown-item" href="../../contentsmanagement/video.php">การจัดการวีดีโอ</a>
                <a class="dropdown-item" href="../../contentsmanagement/pic.php">การจัดการภาพ</a>
                <a class="dropdown-item" href="../../contentsmanagement/text.php">การจัดการข้อความ</a>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="fas fa-cog"></i>
                <span class="menu-item">การจัดการข้อมูลผู้ใช้งาน</span>
                <a class="dropdown-item" href="../../profile/datachange.php">เเก้ไขข้อมูลส่วนตัว</a>
                <a class="dropdown-item" href="../../profile/changepassword.php">เปลี่ยนรหัสผ่าน</a>
                <a class="dropdown-item" href="../../php/logout.php">ออกจากระบบ</a>
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
          <!-- <form action="../../php/template/insert_template_ver_2.php" method="post" enctype="multipart/form-data"> -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                  <div class="card-header">
                  <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 20px">
                      <span style="font-size: 30px; color: #fff">ตั้งค่ารูปเเบบการเเสดงผลเเนวตั้ง รูปเเบบที่ 2</span>
                    </div>
                  </div>
                  </div>
                  <div class="card-header">
                    <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                      <div class="container-fluid">
                        <div class="row justify-content-center">
                          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 backgroundcolorver2image" data-toggle="modal" data-target="#picture">

                          <div class="containerselecttheme" id="showslidelayoutone" >
                        
                            <!-- picture jqury -->

                          </div>

                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 backgroundcolorver2video" data-toggle="modal" data-target="#video">

                          <div class="containerselectthemevideo" id="showslidelayouttwo" >

                            <!-- video jqury -->

                          </div>

                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 backgroundcolorver2text">
                            <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12" style=" text-align: center; ">
                                <select class="form-control" name="sendtext" id="sendtext" style="margin-top: 5px; margin-bottom: 5px" required>
                                  <?php $textloop = 0; while ($resulttext = mysqli_fetch_array($querytext, MYSQLI_ASSOC)) { ?>
                                  <option value="<?php echo $resulttext['text_content']; ?>">
                                    <?php echo $resulttext['text_name']; ?>
                                  </option>
                                  <?php $textloop++; };?>
                                </select>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12" style=" margin-bottom: 10px;  color: white; text-align: center">
                                    <button data-toggle="modal" data-target="#addtext" class="btn btn-primary"><span style="font-size: 20px;">เพิ่มข้อความ</span></button>
                              </div>
                            </div>
                          </div>
                          <br>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 backgroundcolorver2image2" data-toggle="modal" data-target="#picture2">

                          <div class="containerselecttheme" id="showslidelayoutthree" >
                        
                             <!-- picture jqury -->

                          </div>


                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="send_shop_id" value="<?php echo $shop_ID; ?>">
                      <input type="hidden" name="send_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                      <input type="hidden" name="send_device_id" value="<?php echo $resultselectdevices['device_id']; ?>">
                    </div>  
                    <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 backgroundsettingtemplate">
                      <div class="row">
                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 top20nobottom">
                          <span class="nameoftemplate">ชื่อเทมเพลต</span>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 top20nobottom">
                          <input type="text" class="form-control" id="template_name" name="template_name" placeholder="ชื่อรูปเเบบ" require style="color: black; font-size: 19px;" />
                        </div>
                      </div>


                      <div class="row top20"> 
                      <div class="col-xl-2 col-lg-6 col-md-12 col-sm-12">
                      <span class="nameoftemplate">เริ่มเผยเเพร่</span>
                        </div>                      
                       <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                          <input type="text" class="form-control" value="" name="starttime" placeholder="วันที่เริ่มการเผยเเพร่" />
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-12 col-sm-12">
                        <span class="nameoftemplate">หยุดเผยเเพร่</span>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                          <input type="text" class="form-control" value="" name="endtime" placeholder="วันที่หยุดการเผยเเพร่" />
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6 backgroundsettingtemplate">

                    <div class="row top20 ">
                    <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12">
                    <button style="width: 100%" id="sendform" type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 top20nobottom"> 
                    <button style="width: 100%" type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                    </div>

                    </div>
                  </div>   
                  </div>
                </div>
              </div>
      </main>
    </div>
  </div>


  <div class="modal fade bd-example-modal-lg " id="picture" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title whitetext" id="exampleModalLongTitle">รูปภาพทั้งหมด</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 centerlistitem">
              <button type="button" class="addvideoshowlist" data-toggle="modal" data-target="#addPic">
                  <i class="fas fa-plus addmediapluslgwhitecolor"></i>
                </button>
              </div>
              <?php $picloop = 0; while ($resultpic= mysqli_fetch_array($querypic, MYSQLI_ASSOC)) { 
              $imageURL = '../../php/pic/'.$resultpic["user_id"].'/'.$resultpic["file_name"];
              $imageURL2nd = 'php/pic/'.$resultpic["user_id"].'/'.$resultpic["file_name"]; ?>
              <div class="col-lg-3 col-md-3 col-sm-12 centerlistitem">
              <img id="pic1" src="<?php echo $imageURL; ?>" class="videoshowlist" alt="<?php echo $imageURL2nd; ?>">
              </div>
              <?php $picloop++; }; ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="selectpicture" class="btn btn-light" data-dismiss="modal">เลือก</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg " id="picture2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title whitetext" id="exampleModalLongTitle">รูปภาพทั้งหมด</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 centerlistitem">
              <button type="button" class="addvideoshowlist" data-toggle="modal" data-target="#addPic">
                  <i class="fas fa-plus addmediapluslgwhitecolor"></i>
                </button>
              </div>
              <?php $picloop2 = 0; while ($resultpic2 = mysqli_fetch_array($querypic2, MYSQLI_ASSOC)) { 
              $imageURL2 = '../../php/pic/'.$resultpic2["user_id"].'/'.$resultpic2["file_name"];
              $imageURL2nd2 = 'php/pic/'.$resultpic2["user_id"].'/'.$resultpic2["file_name"]; ?>
              <div class="col-lg-3 col-md-3 col-sm-12" style="margin-top: 10px; margin-bottom: 10px; text-align: center">
              <img id="pic2" src="<?php echo $imageURL2; ?>" class="videoshowlist" alt="<?php echo $imageURL2nd2; ?>">
              </div>
              <?php $picloop2++; };?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="selectpicture2" class="btn btn-light" data-dismiss="modal">เลือก</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg " id="video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title whitetext" id="exampleModalLongTitle">วีดีโอทั้งหมด</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 centerlistitem">
              <button type="button" class="addvideoshowlist" data-toggle="modal" data-target="#addVideo">
                  <i class="fas fa-plus addmediapluslgwhitecolor"></i>
                </button>
              </div>
              <?php $videoloop = 0; while ($resultvideo = mysqli_fetch_array($queryvideo, MYSQLI_ASSOC)) { 
                $videoURL = '../../php/video/'.$resultvideo["user_id"].'/'.$resultvideo["file_name"];
                $videoURL2nd = 'php/video/'.$resultvideo["user_id"].'/'.$resultvideo["file_name"]; ?>
              <div class="col-lg-3 col-md-3 col-sm-12 centerlistitem">
                <video src="<?php echo $videoURL; ?>" class="videoshowlist"></video>
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 centerlistitem">
                      <input id="videovalue" type="radio" name="sendvideo" value="<?php echo $videoURL2nd ?>">
                    </label>
                  </div>
                </div>
              </div>
              <?php $videoloop++; }; ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="selectvideo" class="btn btn-light" data-dismiss="modal">เลือก</button>
        </div>
      </div>
    </div>
  </div>

  <!-- </form> -->

  <div class="modal fade" id="addtext" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #24282d">
          <h6 class="modal-title" id="exampleModalLabel" style="color: #eeeeee">เพิ่มข้อความใหม่</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../../php/insert_text.php" method="post">
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding-top: 10px; text-align: left; background-color: #24272b; margin-top: 40px; padding-bottom: 10px;">
                <span style="color: #fff; font-size: 19px; margin-left: 20px">กรุณาใส่ข้อความที่จะเเสดงในช่อง ข้อความ :
                </span>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4" style="padding-top: 20px; text-align: left;">
                <label for="password" class="indexfontsizedefult">ชื่อข้อความ :</label>
                <input type="text" class="form-control" id="upload_textname" name="upload_textname" style="font-size: 20px !important;" />
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4" style="padding-top: 20px; text-align: left;">
                <label for="password" class="indexfontsizedefult">ข้อความ :</label>
                <input type="text" class="form-control" id="upload_text" name="upload_text" style="font-size: 20px !important;" />
              </div>
            </div>
            <input type="hidden" class="form-control" id="upload_user_id" name="upload_user_id" value="<?php echo $_SESSION['user_id']?>" />
            <input type="hidden" class="form-control" id="page_id" name="page_id" value="ver2" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i></button>
          <button type="submit" class="btn btn-light"><i class="fas fa-check"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="addPic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title whitetext" id="exampleModalLabel">เพิ่มสื่อ</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
              <div id="content">
                <div id="my-dropzone" class="dropzone">
                  <div class="dz-message">
                    <h3>วางไฟล์ที่นี่</h3> หรือ <strong>กดที่นี่</strong> เพื่ออัพโหลด
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php mysqli_close($conn); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
  <script src="../../scripts/extras.1.0.0.min.js"></script>
  <script src="../../scripts/shards-dashboards.1.0.0.min.js"></script>
  <script src="../../scripts/app/app-blog-overview.1.0.0.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
  <script src="../../imgCheckbox-master/jquery.imgcheckbox.js"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <script src="../../styles/sweetalert2.min.js"></script>
      <script src="../../styles/sweetalert2.js"></script>

  <script type="text/javascript">
    $(document).ready(function (e) {

      const swalWithBootstrapButtons = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
          })

          swalWithBootstrapButtons.fire({
            title: 'คุณต้องการเพิ่มสื่อการเเสดงหรือไม่?',
            text: "หากมี คลิก อัพโหลด",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'อัพโหลด',
            cancelButtonText: 'ข้าม',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
              $('#addPic').modal('show');
            } else if (
              // Read more about handling dismissals
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'ยกเลิกการอัพโหลด',
                'กรุณาเพิ่มสื่อการเเสดงก่อนการปรับตั้งค่า',
                'error'
              )
            }
          })

          $('input[name="starttime"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            showDropdowns: true,
            drops: 'up',
            locale: {
              format: 'DD-MM-Y H:mm'
            }

          });

          $('input[name="endtime"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,
            showDropdowns: true,
            drops: 'up',
            locale: {
              format: 'DD-MM-Y H:mm'
            }

          });

      var picArray = [];
      var picArray2 = [];
      var userid = "<?php echo $_SESSION['user_id']?>";
      var send_shop_id = "<?php echo $shop_ID; ?>";
      var send_device_id = "<?php echo $resultselectdevices['device_id']; ?>";

      $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', true);
        alertify.success('เลือกรูปเเบบทั้งหมดเเล้ว');
      });

      $("#UncheckAll").click(function () {
        $('input:checkbox').not(this).prop('checked', false);
        alertify.success('ยกเลิกการเลือกรูปเเบบทั้งหมดเเล้ว');
      });

      $("#drop-area").on('dragenter', function (e) {
        e.preventDefault();
        $(this).css('background', '#BBD5B8');
      });

      $("#drop-area").on('dragover', function (e) {
        e.preventDefault();
      });


      $("#drop-areavideo").on('dragenter', function (e) {
        e.preventDefault();
        $(this).css('background', '#BBD5B8');
      });

      $("#drop-areavideo").on('dragover', function (e) {
        e.preventDefault();
      });

      $("#drop-area").on('drop', function (e) {
        $(this).css('background', '#D8F9D3');
        e.preventDefault();
        var image = e.originalEvent.dataTransfer.files;
        createImageData(image);
      });

      $("#drop-areavideo").on('drop', function (e) {
        $(this).css('background', '#D8F9D3');
        e.preventDefault();
        var video = e.originalEvent.dataTransfer.files;
        createVideoData(video);
      });


      $("img#pic1").imgCheckbox({
        onload: function () {
          // Do something fantastic!
        },
        onclick: function (el) {
          var isChecked = el.hasClass("imgChked"),
            imgEl = el.children()[0];

          if (isChecked == true) {
            var test = picArray.length + 1;
            picArray.splice(test, 1, imgEl.alt);
          }
          if (isChecked == false) {
            for (i = 0; i <= picArray.length - 1; i++) {
              if (picArray[i] == imgEl.alt) {
                picArray.splice(i, 1);
              }
            }
          }
          console.log(picArray)
        }
      });

      $("img#pic2").imgCheckbox({
        onload: function () {
          // Do something fantastic!
        },
        onclick: function (el2) {
          var isChecked = el2.hasClass("imgChked"),
            imgEl2 = el2.children()[0];

          if (isChecked == true) {
            var test2 = picArray2.length + 1;
            picArray2.splice(test2, 1, imgEl2.alt);
          }
          if (isChecked == false) {
            for (i = 0; i <= picArray2.length - 1; i++) {
              if (picArray2[i] == imgEl2.alt) {
                picArray2.splice(i, 1);
              }
            }
          }
          console.log(picArray2)
        }
      });

      $("#selectvideo").click(function () {

      var sendvideo = $("#videovalue").val();
      console.log(sendvideo)

        $("#showslidelayouttwo").append("<video src='../../"+sendvideo+"' width='100%' height='100%'></video>");

      });

      $("#selectpicture").click(function () {

      for (var pici = 0; pici < picArray.length; pici++) {
        // themeform.append('sendpic[]', picArray[pici]);
        $("#showslidelayoutone").append("<img class='mySlides' src='../../"+picArray[pici]+"' width='475' height='270'/>");
      }

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

      });

      $("#selectpicture2").click(function () {

      for (var pici2 = 0; pici2 < picArray2.length; pici2++) {
        // themeform.append('sendpic[]', picArray[pici]);
        $("#showslidelayoutthree").append("<img class='mySlides2' src='../../" + picArray2[pici2] + "' width='475' height='260'/>");
      }

      var myIndex2 = 0;
      carousel2();

      function carousel2() {
        var i;
        var x = document.getElementsByClassName("mySlides2");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        myIndex2++;
        if (myIndex2 > x.length) {
          myIndex2 = 1
        }
        x[myIndex2 - 1].style.display = "block";
        setTimeout(carousel2, 2000); // Change image every 2 seconds
      }

      });

      $("#sendform").click(function () {
        var startfulltime = $('input[name="starttime"]').val()
        var endfulltime =$('input[name="endtime"]').val()
        var nametheme = $("#template_name").val();
        var sendtext = $("#sendtext").val();
        var sendvideo = $("#videovalue").val();
        var themeform = new FormData();
        var sendpic = [];
        var sendpic2 = [];
        for (var pici = 0; pici < picArray.length; pici++) {
          themeform.append('sendpic[]', picArray[pici]);
        }
        for (var pici2 = 0; pici2 < picArray2.length; pici2++) {
          themeform.append('sendpic2[]', picArray2[pici2]);
        }
        themeform.append('send_user_id', userid);
        themeform.append('template_name', nametheme);
        themeform.append('send_device_id', send_device_id);
        themeform.append('send_shop_id', send_shop_id);
        themeform.append('sendtext', sendtext);
        themeform.append('sendvideo', sendvideo);
        themeform.append('startdate', startfulltime);
        themeform.append('enddate', endfulltime);
        Sendtheme(themeform);
      });


      function Sendtheme(formData) {
        $.ajax({
          url: "../../php/template/insert_template_ver_2.php",
          type: "POST",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            alertify.alert('Peach Signage System', data, function () {
              alertify.success('Ok');
            });
            setTimeout(() => location.reload(), 1000);
          }
        });
      }

    });

    Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#my-dropzone", {
          url: "../../php/upload_pic.php",
          acceptedFiles: "image/*",
          method: "post",
          addRemoveLinks: true,
          sending: function (file, xhr, formData) {
            var userid = "<?php echo $_SESSION['user_id']?>";
            formData.append('upload_user_id', userid);
            formData.append('page_id', 'null');
          },
          success: function () {
            setTimeout(() => location.reload(), 1000);
          }
        });


        var myDropzone = new Dropzone("#my-dropzonevideo", {
          url: "../../php/upload_video.php",
          acceptedFiles: "video/*",
          method: "post",
          addRemoveLinks: true,
          sending: function (file, xhr, formData) {
            var userid = "<?php echo $_SESSION['user_id']?>";
            formData.append('upload_user_id', userid);
            formData.append('page_id', 'null');
          },
          success: function () {
            setTimeout(() => location.reload(), 1000);
          }
        });
  </script>
</body>

</html>