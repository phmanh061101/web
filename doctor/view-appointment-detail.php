<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/vendor/autoload.php'; 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
  header('location:logout.php');
  } else{

 if(isset($_POST['submit']))
  { 
    $eid=$_GET['editid'];
    $aptid=$_GET['aptid'];
    $status=$_POST['status'];
    $remark=$_POST['remark'];
      $sql= "update tblappointment set Status=:status,Remark=:remark where ID=:eid";
    $query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
 echo '<script>alert("Cập Nhật Thành Công")</script>';
 echo "<script>window.location.href ='all-appointment.php'</script>";
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title> Chi Tiết Lịch Sử Đặt Lịch</title>
	
	<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
	<!-- build:css assets/css/app.min.css -->
	<link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
	<link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/core.css">
	<link rel="stylesheet" href="assets/css/app.css">
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
	<script>
		Breakpoints();
	</script>
	
</head>
	
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->



<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>



<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<!-- DOM dataTable -->
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title" style="color: blue">Chi Tiết Đặt Lịch</h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<?php
                  $eid=$_GET['editid'];
$sql="SELECT * from tblappointment  where ID=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
							<table border="1" class="table table-bordered mg-b-0">
    <tr>
    <th>Mã Đặt Lịch</th>
    <td><?php  echo $aptno=($row->AppointmentNumber);?></td>
    <th>Tên Khách Hàng</th>
    <td><?php  echo $row->Name;?></td>
  </tr>
  
  <tr>
    <th>Số Điện Thoại</th>
    <td><?php  echo $row->MobileNumber;?></td>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
  </tr>
   <tr>
    <th>Ngày Hẹn</th>
    <td><?php  echo $row->AppointmentDate;?></td>
    <th>Thời Gian</th>
    <td><?php  echo $row->AppointmentTime;?></td>
  </tr>
   
  <tr>
    <th>Ngày Đăng Kí</th>
    <td><?php  echo $row->ApplyDate;?></td>
     <th>Tình Trạng</th>

    <td colspan="4"> <?php  $status=$row->Status;
    
if($row->Status=="")
{
  echo "Chưa Cập Nhật";
}

if($row->Status=="Approved")
{
    $mail = new PHPMailer(TRUE);
    $mail ->CharSet ="UTF-8";
    try {
      //Enable verbose debug output
      $mail->SMTPDebug = SMTP::DEBUG_OFF;//SMTP::DEBUG_SERVER;
      
      //Send using SMTP
      $mail->isSMTP();
      
      //Set the SMTP server to send through
      $mail->Host = 'smtp.gmail.com';
      
      //Enable SMTP authentication
      $mail->SMTPAuth = true;
      
      //SMTP username
      $mail->Username = 'manhc3dth@gmail.com';
      
      //SMTP password
      $mail->Password = 'kspd riow ylzl jtcj';
      
      //Enable TLS encryption;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      
      //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
      $mail->Port = 587;
      
      //Recipients
      $mail->setFrom('your_email@gmail.com', 'phongkham_tanthanh.com');
      
      //Add a recipient
      $mail->addAddress($email, $tendangnhap);
      
      //Set email format to HTML
      $mail->isHTML(true);
      
      $mail->Subject = 'Xác Nhận Đặt Lịch';
      $mail->Body    = '<p>Chi Tiết Đặt Lịch</p>
                        <p>Mã Đặt Lịch: <b style="font-size: 13px;">' .$row->AppointmentNumber . '</b></p>
                        <p>Tên Khách Hàng: <b style="font-size: 13px;">' .$row->Name . '</b></p>
                        <p>Số Điện Thoại: <b style="font-size: 13px;">' .$row->MobileNumber . '</b></p>
                        <p>Ngày: <b style="font-size: 13px;">' .$row->AppointmentDate . '</b></p>
                        <p>Thời Gian: <b style="font-size: 13px;">' .$row->AppointmentTime . '</b></p>
                        <p>Yêu Cầu Đặt Lịch Thành Công .Vui Lòng Đến Đúng Giờ</p>
      ';
 
      $mail->send();
      header("Location:http://localhost:8080/dams/doctor/dashboard.php");
      exit();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    {
      echo "Đặt Lịch Thành Công";
    }
    
  }
    
 



if($row->Status=="Cancelled")
{
  echo "Đặt Lịch Thất Bại";
}



     ;?></td>
  </tr>
   <tr>
    
<th >Ghi Chú</th>
 <?php if($row->Remark==""){ ?>

                     <td colspan="3"><?php echo "Thất Bại"; ?></td>
<?php } else { ?>                  <td colspan="3"> <?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>
   
  </tr>
 
<?php $cnt=$cnt+1;}} ?>

</table> 
<br>

 
<?php 

if ($status=="" ){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Chỉnh Sửa</button></p>  

<?php } ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh Sửa</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                 <form method="post" name="submit">

                                
                               
     <tr>
    <th>Ghi Chú :</th>
    <td>
    <textarea name="remark" placeholder="Nhập Ghi Chú" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr> 
     
  <tr>
    <th>Trạng Thái :</th>
    <td>

   <select name="status" class="form-control wd-450" required="true" >
     <option value="Approved" selected="true">Thành Công</option>
     <option value="Cancelled">Thất Bại</option>
     
   </select></td>
  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Update</button>
  
  </form>
  

</div>

                      
                        </div>
                    </div>

						</div>

					</div><!-- .widget-body -->
					
   
				</div><!-- .widget -->
			</div><!-- END column -->
			
			
		</div><!-- .row -->
	</section><!-- .app-content -->
</div><!-- .wrap -->
  <!-- APP FOOTER -->
  <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

	<!-- APP CUSTOMIZER -->
<?php include_once('includes/customizer.php');?>

	
		<!-- build:js assets/js/core.min.js -->
	<script src="libs/bower/jquery/dist/jquery.js"></script>
	<script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
	<script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
	<script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
	<script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="libs/bower/PACE/pace.min.js"></script>
	<!-- endbuild -->

	<!-- build:js assets/js/app.min.js -->
	<script src="assets/js/library.js"></script>
	<script src="assets/js/plugins.js"></script>
	<script src="assets/js/app.js"></script>
	<!-- endbuild -->
	<script src="libs/bower/moment/moment.js"></script>
	<script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="assets/js/fullcalendar.js"></script>
</body>
</html>
<?php }  ?>