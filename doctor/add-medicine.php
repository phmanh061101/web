<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
	header('location:logout.php');
	} else{
  
  if (isset($_POST["submitbtn"])) 
  {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $status = $_POST["status"];
	$donvi = $_POST["donvi"];
	$unitprice= $_POST["unitprice"];
    $uses = $_POST["use"];

    // Chèn dữ liệu vào database
	if ($name==null ||$category== null ||$quantity== null||$uses== null||$status==null ||$donvi==null)
	{
		echo '<script>alert(" Vui lòng nhập đầy đủ thông tin");</script>';
		echo header("refresh:0; url='http://localhost:8080/dams/doctor/add-medicine.php'");
	}

		$sql="INSERT INTO tblmedicine(Name,Category,Quantity,UnitPrice,donvi,Uses,Status)VALUES (:name,:category,:quantity,:unitprice,:donvi,:use,:status)";
		$query=$dbh->prepare($sql);
		// $query->bindParam(':id',$id,PDO::PARAM_STR);
		$query->bindParam(':name',$name,PDO::PARAM_STR);
		$query->bindParam(':category',$category,PDO::PARAM_STR);
		$query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
		$query->bindParam(':use',$uses,PDO::PARAM_STR);
		$query->bindParam(':unitprice',$unitprice,PDO::PARAM_STR);
		$query->bindParam(':donvi',$donvi,PDO::PARAM_STR);


		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->execute();
	 
		 echo '<script>alert("Thêm Thành Công")</script>';

	
    
   
	
    
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
						<h4 class="widget-title">Thêm Mới Thuốc</h4>    
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
                 
					<form method="post">
					
					<div class="form-group">
						<label for="">Tên Thuốc</label>
						<input type="text" class="form-control" name="name" >
					</div>
					<div class="form-group">
						<label for="">Loại Thuốc</label>
						<input type="text" class="form-control" name="category" >
					</div>
					<div class="form-group">
						<label for="">Số Lượng</label>
						<input type="text" class="form-control" name="quantity" >
					</div>

					<div class="form-group">
						<label for="">Đơn Giá</label>
						<input type="text" class="form-control" name="unitprice" >
					</div>

					<div class="form-group">
						<label for="">Đơn Vị</label>
						<input type="text" class="form-control" name="donvi" >
					</div>
					<div class="form-group">
						<label for="">Công Dụng</label>
						<input type="text" class="form-control" name="use" >
					</div>
					<div class="form-group">
						<label for="">Tình Trạng</label>
				
						<select name="status" type = text class="form-control">
							<option value="Còn Hàng">Còn Hàng</option>
							<option value="Hết Hàng">Hết Hàng</option>
						</select>
					</div>
					
					
					<button type="submit" class="btn btn-primary" name="submitbtn">Thêm</button>
				</form>
					
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