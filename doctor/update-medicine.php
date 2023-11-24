<?php
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
      $name=$_POST['name'];
      $category=$_POST['category'];
      $quantity=$_POST['quantity'];
      $unitprice=$_POST['unitprice' ];
      $uses=$_POST['uses'];
      $status=$_POST['status'];

    $sql= "update tblmedicine set Name=:name,Category=:category,Quantity=:quantity,Unitprice=:unitprice,Uses=:uses,Status=:status where ID=:eid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
    $query->bindParam(':unitprice',$unitprice,PDO::PARAM_STR);
    $query->bindParam(':uses',$uses,PDO::PARAM_STR);    
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
   $query->execute();
   echo '<script>alert("Cập Nhật Thành Công")</script>';
   echo "<script>window.location.href ='medicine.php'</script>";
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
                  $sql="SELECT * from tblmedicine  where ID = :eid";
                  $query = $dbh -> prepare($sql);
                  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);

                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                  foreach($results as $row)
                  {?>
                                <table border="1" class="table table-bordered mg-b-0">
                                                              <tr>
                      <th>Mã Thuốc</th>
                      <td><?php  echo $aptno=($row->ID);?></td>
                      <th>Loại Thuốc</th>
                      <td><?php  echo $row->Category;?></td>
                      <th>Tên Thuốc</th>
                      <td><?php  echo $row->Name;?></td>
                    </tr>
                    
                    <tr>
                      <th>Số Lượng</th>
                      <td><?php  echo $row->Quantity;?></td>
                      <th>Đơn Giá</th>
                      <td><?php  echo $row->UnitPrice;?></td>
                      <th>Công dụng</th>
                      <td><?php  echo $row->Uses;?></td>
                  </tr>
                      <th>Tình Trạng</th>
                      <td><?php  echo $row->Status;?></td>
                  
                  <?php $cnt=$cnt+1;}
                } 
?>
                      
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

                                
                                                  <div class="form-group">
						                        	            <label for="">Tên Thuốc</label>
							                                     <input type="text" name="name" class="form-control wd-450" value="<?php echo $row->Name ?>" ></input>
						                                      </div>

                                                    <div class="form-group">
                                                    <label for="">Loại Thuốc</label>
                                                    <input type="text" name="category" class="form-control wd-450" value="<?php echo $row->Category ?>" ></input>
						                                        </div>

                                                    <div class="form-group">
                                                        <label for="">Số Lượng</label>
                                                        <input type="text" name="quantity" class="form-control wd-450" value="<?php echo $row->Quantity ?>" ></input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Đơn Giá</label>
                                                        <input type="text" name="unitprice" class="form-control wd-450" value="<?php echo $row->UnitPrice ?>" ></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Công Dụng</label>
                                                        <input type="text" name="uses" class="form-control wd-450" value="<?php echo $row->Uses ?>" ></input>
                                                    </div>
                                                                                

                                                    <div class="form-group">
                                                    <label for="">Trạng Thái</label>
                                                    

                                                    <select name="status" class="form-control wd-450" required="true" >
                                                    <option value="Còn Hàng" selected="true">Còn Hàng</option>
                                                    <option value="Hết Hàng">Hết Hàng</option>

                                                    </select></td>
                                                    </div>
                                                    </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                                      </div>

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