<?php

use Google\Service\CloudSearch\Id;

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
	header('location:logout.php');
	} else{
  
  if (isset($_POST["submitbtn"])) 
  {
    $id = $_POST["id"];
    $doctor= $_POST["doctor"];
    $khoa = $_POST["khoa"];
    $name = $_POST["name"];
    // $dob = $_POST["dob"];
    $dayin = $_POST["dayin"];
    $sex= $_POST["sex"];
    $address = $_POST["address"];
    $kqchandoan = $_POST["chandoan"];
    $phuongphap = $_POST["phuongphap"];
    $kqdieutri = $_POST["ketquadieutri"];

    // Chèn dữ liệu vào database
	if ($id ==null || $name == null || $sex == null || $address == null || $khoa == null || $kqchandoan == null || $kqdieutri == null || $phuongphap == null)
	{
		echo '<script>alert(" Vui lòng nhập đầy đủ thông tin");</script>';
		echo header("refresh:0; url='http://localhost:8080/dams/doctor/add-medicalrecord.php'");
	}
   

        
    $sql="INSERT INTO hosobenhan(appoiment_id,doctor_id,specialization_id,hoten,gioitinh,diachi,ngaykham,chandoan,phuongphapdieutri,ketquadieutri)
    VALUES (:id,:doctor,:khoa,:name,:sex,:address,:dayin,:kqchandoan,:phuongphap,:kqdieutri)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':doctor',$doctor,PDO::PARAM_STR);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    // $query->bindParam(':dob',$dob,PDO::PARAM_STR);
    $query->bindParam(':sex',$sex,PDO::PARAM_STR);
    $query->bindParam(':dayin',$dayin,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':khoa',$khoa,PDO::PARAM_STR);
    $query->bindParam(':kqchandoan',$kqchandoan,PDO::PARAM_STR);
    $query->bindParam(':phuongphap',$phuongphap,PDO::PARAM_STR);
    $query->bindParam(':kqdieutri',$kqdieutri,PDO::PARAM_STR);
    
    
    $query->execute();
    
    echo '<script>alert("Thêm Thành Công")</script>';
	echo header("refresh:0; url='http://localhost:8080/dams/doctor/medicalrecord.php'");
    
    
  }




  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
	
	<title> Dashboard</title>
	
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

<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<!-- DOM dataTable -->
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">Kết Quả Thăm Khám</h4>    
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
			<?php
                  $eid=$_GET['editid'];
                  $sql="SELECT * from tblappointment  where appoiment_id = :eid";
                  $query = $dbh -> prepare($sql);
                  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);

                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                  foreach($results as $row)
                  {?>                    
				<form method="post">
					<div class="form-group">
						<label for="">Mã Đặt Lịch</label>
						<input type="text" class="form-control" name="id"  value="<?php  echo $eid=($row->appoiment_id);?>"  placeholder="ID">
						
					</div>
					<div class="form-group">
						<label for="">Tên Khách Hàng</label>
						<input type="text" class="form-control" name="name" value="<?php echo $row->Name ?>" placeholder="Tên Khách Hàng">
					</div>
					<div class="form-group">
						<label for="">Giới Tính</label>
						<input type="text" class="form-control" name="sex" placeholder="Giới Tính">
					</div>
					<div class="form-group">
						<label for="">Địa Chỉ</label>
						<input type="text" class="form-control" name="address" placeholder="Địa Chỉ">
					</div>

					<div class="form-group">
						<label for="">Khoa Điều Trị</label>
						<input type="text" class="form-control" name="khoa" value="<?php echo $row->Specialization ?>" >
					</div>
					<div class="form-group">
						<label for="">Bác Sĩ Điều Trị</label>
						<input type="text" class="form-control" name="doctor" value="<?php echo $row->Doctor ?>" >
					</div>
					<div class="form-group">
						<label for="">Ngày Khám</label>
						<input type="text" class="form-control" name="dayin" value="<?php echo $row->AppointmentDate ?>" >
					</div>

					<div class="form-group">
						<label for="">Kết Quả Chẩn Đoán</label>
						<input type="text" class="form-control" name="chandoan" placeholder="Kết Quả Chẩn Đoán">
					</div>
					<div class="form-group">
						<label for="">Phương Pháp Điều Trị</label>
						<input type="text" class="form-control" name="phuongphap" placeholder="Phương Pháp Điều Trị">
					</div>
					<div class="form-group">
						<label for="">Kết Quả Điều Trị </label>
						<input type="text" class="form-control" name="ketquadieutri" placeholder="Kết Quả Điều Trị">
					</div>

					
					<button type="submit" class="btn btn-primary" name="submitbtn">Submit</button>
				</form>
                  <?php $cnt=$cnt+1;}
                } 
?>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
        </div>




 <?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>



<!-- APP MAIN ==========-->

  <!-- APP FOOTER -->
 <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

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