<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
  header('location:logout.php');
  } else{

 if(isset($_POST['submitbtn']))
  { 
    // $eid=$_GET['editid'];
    // $aptid=$_GET['aptid'];
    $id=$_POST['id'];
    $tenkhachhang = $_POST['tenkhachhang'];
    $medicinename = $_POST['medicinename'];
    $ghichu=$_POST['ghichu'];
    $sql="INSERT INTO donthuoc(hosobenhan_id,tenkhachhang,tenduonthuoc,ghichu) VALUES (:id,:tenkhachhang,:medicinename,:ghichu)";
    $query=$dbh->prepare($sql);
    // $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':tenkhachhang',$tenkhachhang,PDO::PARAM_STR);
    $query->bindParam(':medicinename',$medicinename,PDO::PARAM_STR);
    $query->bindParam(':ghichu',$ghichu,PDO::PARAM_STR);
    $query->execute();
 echo '<script>alert("Thành Công")</script>';
 echo "<script>window.location.href ='donthuoc.php'</script>";
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
						<h4 class="widget-title" style="color: blue">Thông Tin Chi Tiết</h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<?php
                  $eid=$_GET['editid'];
$sql="SELECT * from hosobenhan  where ID=:eid";
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
    <th>Mã Khách Hàng</th>
    <td><?php  echo $aptno=($row->id);?></td>
    <th>Họ Tên</th>
    <td><?php  echo $aptno=($row->hoten);?></td>
    <th>Ngày Sinh</th>
    <td><?php  echo $row->ngaysinh;?></td>
  </tr>
  <tr>
    <th>Giới Tính</th>
    <td><?php  echo $row->gioitinh;?></td>
    <th>Địa Chỉ</th>
    <td><?php  echo $row->diachi;?></td>
    <th>Ngày Khám </th>
    <td><?php  echo $row->ngaykham;?></td>
  </tr>

  <tr>
    <th>Khoa Điều Trị</th>
    <td><?php  echo $row->khoaphongdieutri;?></td>
    <th>Chẩn Đoán</th>
    <td><?php  echo $row->chandoan;?></td>
    <th>Phương   Pháp Điều Trị </th>
    <td><?php  echo $row->phuongphapdieutri;?></td>
  </tr>

  <tr>
    <th>Kết Quả Điều Trị</th>
    <td><?php  echo $row->ketquadieutri;?></td>
    
  </tr>

    


 
<?php $cnt=$cnt+1;}} ?>

</table> 
<br>

 
<?php 

if ($status=="" ){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button   > 
<a class="btn btn-primary waves-effect waves-light w-lg" href="add-donthuoc.php?editid=<?php echo htmlentities ($row->id)?>">Tạo Đơn Thuốc</a>

 </button></p>  

<?php } ?>


                      
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