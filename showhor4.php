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

$sqlshopname = "SELECT * FROM tbl_shop WHERE user_id = {$_SESSION["user_id"]}  ";
$queryshopname = mysqli_query($conn, $sqlshopname);
$resultshopname = mysqli_fetch_array($queryshopname);

$sqlhor4 = "SELECT * FROM tbl_template_hor_4 WHERE user_id = {$_SESSION["user_id"]} AND device_id = $device_ID ";
$queryhor4  = mysqli_query($conn, $sqlhor4);
// if($queryhor4 == true){
// $resulthor4 = mysqli_fetch_array($queryhor4);
// }

$sqlhor4_public = "SELECT * FROM tbl_template_hor_4 WHERE user_id = {$_SESSION["user_id"]} AND device_id = $device_ID AND public_status = 1";
$queryhor4_public  = mysqli_query($conn, $sqlhor4_public);
if($queryhor4_public == true){
$resulthor4_public = mysqli_fetch_array($queryhor4_public);
}else{
  $resulthor4_public = null;
}

$sqlhor4_publicforjs = "SELECT * FROM tbl_template_hor_4 WHERE user_id = {$_SESSION["user_id"]} AND device_id = '$device_ID'";
$queryhor4_publicforjs  = mysqli_query($conn, $sqlhor4_publicforjs);

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
  <link rel="stylesheet" href="../styles/peachsignage.css">
  <link rel="stylesheet" media="(max-width: 575.98px)" href="../styles/peachsignagesm.css">
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
                <i class="fas fa-desktop"></i>
                <span class="menu-item">การเเสดงผลบนอุปกรณ์</span>
                <a class="dropdown-item" href="../showdisplay/Deshbroad.php">การควบคุม</a>
                <a class="dropdown-item" style="background-color: #f5f6f8; color: #000000" href="../showdisplay/showhor.php">เเนวนอน</a>
                <a class="dropdown-item" href="../showdisplay/showver.php">เเนวตั้ง</a>
                <a class="dropdown-item" href="../showdisplay/selectshop.php">เลือกร้านค้า</a>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="fas fa-sliders-h"></i>
                <span class="menu-item">การจัดการอุปกรณ์</span>
                <!-- <a class="dropdown-item" href="../statusdeviece/devicestatus.php">สถานะอุปกรณ์</a> -->
                <a class="dropdown-item" href="../statusdeviece/selectdevice.php">เลือกอุปกรณ์</a>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="fas fa-file"></i>
                <span class="menu-item">การจัดการไฟล์</span>
                <a class="dropdown-item" href="../contentsmanagement/video.php">การจัดการวีดีโอ</a>
                <a class="dropdown-item" href="../contentsmanagement/pic.php">การจัดการภาพ</a>
                <a class="dropdown-item" href="../contentsmanagement/text.php">การจัดการข้อความ</a>
                <a class="dropdown-item" href="../contentsmanagement/website.php">การจัดการเว็บไซต์</a>
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
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
              <div class="card card-small">
                <div class="card-header border-bottom">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                      <br />
                      <span class="name-template">
                        <i class="fas fa-desktop whiteicon"></i>
                        <span class="text-mb-2">เเนวนอน รูปเเบบที่ 4</span>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">

                  <?php if($resulthor4_public == null){ ?>
                  <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="alert" role="alert">
                        <span class="not-foundtemplate">ไม่พบการเเสดงของรูปเเบบนี้!!</span>
                        <span class="not-foundtemplate">โปรดเลือกการเเสดงด้านล่าง</span> <br><br>
                        <a href="./Template.php">
                          <button type="button" class="btn btn-info">เพิ่มรูปเเบบ</button></a>
                      </div>
                    </div>
                  </div>
                  <?  }else{  ?>
                  <div class="container-fluid margintopdisplay">
                    <div class="row justify-content-center">
                      <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b; border-radius:25px 0px 0px 0px;"></div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                          <div class="col-lg-9 col-md-9 col-sm-9" style="background-color: #24282d;">
                            <div class="textsilde">
                              <div class="fontslide">
                                <?php echo $resulthor4_public['text_content']; ?>
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
                          <source src="../<?php echo $resulthor4_public['video']; ?>" type="video/mp4">
                        </video>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b;"> </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-1 col-md-1 col-sm-1" style="background-color: #60656b; border-radius: 0px 0px 0px 25px">
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6" style="background-color: #24282d;">
                        <?php if($resulthor4_public['image_type'] == "image"){ $image = explode("|", $resulthor4_public['image_slide']); ?>
                        <img src='../<?php echo $image[1]; ?>' class='img-fluid' width='730px' height="100px" style='margin-top: 5px;margin-bottom: 5px' />
                        <?php }else{  $e = explode("|", $resulthor4_public['image_slide']);  foreach ($e as $key) { if($key != ''){ ?>
                        <img class='mySlides' src='../<?php echo $key; ?>' class='img-fluid' width='730px' height="100px"
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

                  <?php } ?>


                  <div class="container">
                    <div class="row align-items-center">
                      <div class="col justify-content-center">
                        <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="showhor3.php">
                                <</a> </li> <li class="page-item"><a class="page-link" href="showhor.php">1</a></li>
                            <li class="page-item"><a class="page-link" href="showhor2.php">2</a></li>
                            <li class="page-item"><a class="page-link" href="showhor3.php">3</a></li>
                            <li class="page-item active">
                            <li class="page-item"><a class="page-link" href="showhor4.php" style="background-color: #24282d; color: white">4</a></li>
                            </li>
                            <li class="page-item"><a class="page-link" href="showhor5.php">5</a></li>
                            <li class="page-item"><a class="page-link" href="showhor5.php">></a></li>
                          </ul>
                        </nav>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead class="table-head">
                            <tr>
                              <th scope="col">ลำดับ</th>
                              <th scope="col">ชื่อ</th>
                              <th scope="col">บันทึก</th>
                              <th scope="col">สถานะ</th>
                              <th scope="col" class="table-listshow">เเสดง</th>
                              <th scope="col" class="table-listshow">ยกเลิก</th>
                              <th scope="col" class="table-listdelete">ลบ</th>
                            </tr>
                          </thead>
                          <tbody class="table-body">
                            <?php $listloop = 0; 
                            if($queryhor4 == true){
                            while ($resulthor4 = mysqli_fetch_array($queryhor4, MYSQLI_ASSOC)) { 
                            ?>
                            <tr>
                              <th scope="row">
                                <?php echo $listloop; ?>
                              </th>
                              <td>
                                <?php echo $resulthor4['template_name']; ?>
                              </td>
                              <td>
                                <?php echo $resulthor4['upload_on']; ?>
                              </td>
                              <td>
                                <?php if($resulthor4['public_status'] == 0){ echo "ไม่เผยเเผร่"; }else{ echo "เผยเเผร่";} ?>
                              </td>
                              <td>
                                <!-- <form action="../php/select_template/select_template_hor_4.php" method="post"> -->
                                  <input type="hidden" class="form-control" id="template_id" name="template_id" value="<?php echo $resulthor4['template_id']?>" />
                                  <input type="hidden" class="form-control" id="template_select_id" name="template_select_id"
                                    value="<?php echo $resulthor4['template_select_id']?>" />
                                  <input type="hidden" class="form-control" id="template_name" name="template_name"
                                    value="<?php echo $resulthor4['template_name']?>" />
                                  <input type="hidden" class="form-control" id="image_slide" name="image_slide" value="<?php echo $resulthor4['image_slide']?>" />
                                  <input type="hidden" class="form-control" id="video" name="video" value="<?php echo $resulthor4['video']?>" />
                                  <input type="hidden" class="form-control" id="text_content" name="text_content" value="<?php echo $resulthor4['text_content']?>" />
                                  <input type="hidden" class="form-control" id="shop_id" name="shop_id" value="<?php echo $resulthor4['shop_id']?>" />
                                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $resulthor4['user_id']?>" />
                                  <input type="hidden" class="form-control" id="device_id" name="device_id" value="<?php echo $resulthor4['device_id']?>" />
                                  <input type="hidden" class="form-control" id="public_status" name="public_status"
                                    value="<?php echo $resulthor4['public_status']?>" />
                                    <button type="submit" class="close" aria-label="Close"> <i class="fas fa-eye" id="showtheme<?php echo $listloop; ?>" style="color: #5B838D; font-size: 30px"></i> </button>
                                <!-- </form> -->
                              </td>
                              <td>
                                <form name="delete_form" action="../php/unselect_template/unselect_template_hor_4.php"
                                  method="post">
                                  <input type="hidden" class="form-control" id="template_id" name="template_id" value="<?php echo $resulthor4['template_id']?>" />
                                  <input type="hidden" class="form-control" id="device_id" name="device_id" value="<?php echo $resulthor4['device_id']?>" />
                                  <input type="hidden" class="form-control" id="public_status" name="public_status"
                                    value="<?php echo $resulthor4['public_status']?>" />
                                  <button type="submit" class="close" aria-label="Close">
                                    <?php if($resulthor4['public_status'] == 1){ echo '<i class="fas fa-ban" style="color: #5B838D; font-size: 30px"></i>'; } ?>
                                  </button>
                                </form>
                              </td>
                              <td>
                                <form name="delete_form" action="../php/delete/delete_tem_hor4.php" method="post">
                                  <input type="hidden" class="form-control" id="template_id" name="template_id" value="<?php echo $resulthor4['template_id']?>" />
                                  <input type="hidden" class="form-control" id="public_status" name="public_status"
                                    value="<?php echo $resulthor4['public_status']?>" />
                                  <button type="submit" class="close" aria-label="Close" style="padding-right: 10px">
                                    <?php if($resulthor4['public_status'] == 0){ echo '<i class="fas fa-trash-alt" style="color: #5B838D; font-size: 30px"></i>'; } ?>
                                  </button>
                                </form>
                              </td>
                            </tr>
                            <?php $listloop++;} };  mysqli_close($conn);?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
      </main>
    </div>
  </div>
  </div>
  </main>
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
                        echo $resultshopname['shop_name']; }else{ ?> โปรดเลือกร้านค้า
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
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
  <!-- <script src="../../imgCheckbox-master/jquery.imgcheckbox.js"></script> -->

  <script>
        $(document).ready(function (e) {

          <?php $listloopforjs = 0;  if($queryhor4_publicforjs == true){ while ($resulthor4_publicforjs = mysqli_fetch_array($queryhor4_publicforjs, MYSQLI_ASSOC)) { ?>


          $("#showtheme<?php echo $listloopforjs; ?>").click(function () {
            
            console.log('<?php echo $listloopforjs; ?>')
            var template_id = '<?php echo $resulthor4_publicforjs['template_id']; ?>'
            var template_select_id = '<?php echo $resulthor4_publicforjs['template_select_id']; ?>'
            var device_id = '<?php echo $resulthor4_publicforjs['device_id']; ?>'
            var userid = '<?php echo $_SESSION['user_id']; ?>'

            alertify.confirm('Peach Signage System', 'ระบบตรวจพบการเเสดงผล กดยืนยันเพื่อยกเลิกการเเสดงผลก่อนหน้า',
              function () {

                var arraypicform = new FormData();
                arraypicform.append('template_id', template_id);
                arraypicform.append('template_select_id', template_select_id);
                arraypicform.append('device_id', device_id);
                arraypicform.append('userid', userid);
                uploadFormData(arraypicform);
                alertify.success('เเสดงผลที่เลือกปัจจุบันเเล้ว');

              },
              function () {

                setTimeout(() => location.reload(), 3000);
                alertify.error('ยกเลิกการเเสดงผลการเเสดงนี้')

              });
            
          });


          <?php $listloopforjs++;} }; ?>

          function uploadFormData(formData) {
            $.ajax({
              url: "../php/select_template/select_template_hor_4.php",
              type: "POST",
              data: formData,
              contentType: false,
              cache: false,
              processData: false,
              success: function (data) {
                alertify.alert('Peach Signage System', data, function(){ alertify.success('Ok'); });
                setTimeout(() => location.reload(), 4000);
              }
            });
          }

        });

      </script>
</body>

</html>