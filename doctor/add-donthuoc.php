<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
	header('location:logout.php');
	} else{
  
  if (isset($_POST["submitbtn"])) 
  {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $namemedicine = $_POST["namemedicine"];
    $ghichu = $_POST["ghichu"];
	

    // Chèn dữ liệu vào database
	if ($name==null ||$namemedicine== null ||$ghichu== null||$id== null)
	{
		echo '<script>alert(" Vui lòng nhập đầy đủ thông tin");</script>';
		echo header("refresh:0; url='http://localhost:8080/dams/doctor/add-medicine.php'");
	}

		$sql="INSERT INTO donthuoc(hosobenhan_id,tenkhachhang,tendonthuoc,ghichu)VALUES (:id,:name,:namemedicine,:ghichu)";
		$query=$dbh->prepare($sql);
		$query->bindParam(':id',$id,PDO::PARAM_STR);
		$query->bindParam(':name',$name,PDO::PARAM_STR);
		$query->bindParam(':namemedicine',$namemedicine,PDO::PARAM_STR);
		$query->bindParam(':ghichu',$ghichu,PDO::PARAM_STR);
		$query->execute();
	 
		 echo '<script>alert("Thêm Thành Công")</script>';
         echo header("refresh:0; url='donthuoc.php'");
	
    
   
	
    
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
						<h4 class="widget-title">Tạo Đơn Thuốc</h4>    
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
                    <?php
                  $eid=$_GET['editid'];
                  $sql="SELECT * from hosobenhan  where id = :eid";
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
						<label for="">Mã Khách Hàng</label>
						<input type="text" class="form-control" value="<?php echo $row->id?> " name="id" >
					</div>
					<div class="form-group">
						<label for="">Tên Khách Hàng </label>
						<input type="text" class="form-control" value="<?php echo $row->hoten?> " name="name" >
					</div>
					<div class="form-group">
						<label for="">Tên Đơn Thuốc</label>
						<input type="text" class="form-control" name="namemedicine" >
					</div>

					<div class="form-group">
						<label for="">Ghi Chú</label>
						<input type="text" class="form-control" name="ghichu" >
					</div>
					
					<button type="submit" class="btn btn-primary" name="submitbtn">Thêm</button>
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