<?php
session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mobnum = $_POST['phone'];
    $email = $_POST['email'];
    $appdate = $_POST['date'];
    $aaptime = $_POST['time'];
    $specialization = $_POST['specialization'];
    $doctorlist = $_POST['doctorlist'];
    $message = $_POST['message'];
    $aptnumber = mt_rand(100000000, 999999999);
    $cdate = date('Y-m-d');

    if ($appdate <= $cdate) {
        echo '<script>alert("Ngày hẹn phải lớn hơn ngày hôm nay")</script>';
    } else {
        $sql = "insert into tblappointment(AppointmentNumber,Name,MobileNumber,Email,AppointmentDate,AppointmentTime,Specialization,Doctor,Message)values(:aptnumber,:name,:mobnum,:email,:appdate,:aaptime,:specialization,:doctorlist,:message)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aptnumber', $aptnumber, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':appdate', $appdate, PDO::PARAM_STR);
        $query->bindParam(':aaptime', $aaptime, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        $query->bindParam(':doctorlist', $doctorlist, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);

        $query->execute();
        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Yêu cầu đặt lịch của bạn đã được gửi. Chúng tôi sẽ liên hệ lại với bạn sớm")</script>';
            echo "<script>window.location.href ='index.php'</script>";
        } else {
            echo '<script>alert("Đã xảy ra lỗi. Vui lòng thử lại")</script>';
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Trang Chủ </title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/owl.theme.default.min.css" rel="stylesheet">

    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <script>
        function getdoctors(val) {
            //  alert(val);
            $.ajax({

                type: "POST",
                url: "get_doctors.php",
                data: 'sp_id=' + val,
                success: function(data) {
                    $("#doctorlist").html(data);
                }
            });
        }
    </script>
</head>

<body id="top">

    <main>

        <?php include_once('includes/header.php'); ?>

        <section class="hero" id="hero">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/slider/portrait-successful-mid-adult-doctor-with-crossed-arms.jpg" class="img-fluid" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/young-asian-female-dentist-white-coat-posing-clinic-equipment.jpg" class="img-fluid" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/doctor-s-hand-holding-stethoscope-closeup.jpg" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding" id="about">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-12">
                        <?php
                        $sql = "SELECT * from tblpage where PageType='aboutus'";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) {               ?>
                                <h2 class="mb-lg-3 mb-3"><?php echo "Về Chúng Tôi" ?></h2>

                                <p><?php echo "
Sứ mệnh của chúng tôi tuyên bố mục đích tồn tại của chúng tôi với tư cách là một công ty và các mục tiêu của chúng tôi.
Mang đến cho mọi khách hàng nhiều hơn những gì họ yêu cầu về chất lượng, sự lựa chọn, giá trị đồng tiền và dịch vụ khách hàng, bằng cách hiểu thị hiếu và sở thích địa phương, đồng thời không ngừng đổi mới để cuối cùng mang đến trải nghiệm mua sắm trang sức chưa từng có."; ?>.</p>

                        <?php $cnt = $cnt + 1;
                            }
                        } ?>
                    </div>

                    <div class="col-lg-4 col-md-5 col-12 mx-auto">
                        <div class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
                            <p class="featured-text"><span class="featured-number">10</span> Năm<br> Kinh Nghiệm</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="gallery">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-6 ps-0">
                        <img src="images/gallery/medium-shot-man-getting-vaccine.jpg" class="img-fluid galleryImage" alt="get a vaccine" title="get a vaccine for yourself">
                    </div>

                    <div class="col-lg-6 col-6 pe-0">
                        <img src="images/gallery/female-doctor-with-presenting-hand-gesture.jpg" class="img-fluid galleryImage" alt="wear a mask" title="wear a mask to protect yourself">
                    </div>

                </div>
            </div>
        </section>





        <section class="section-padding" id="booking">
        <div class="rts-team-area rts-section-gapBottom appoinment-team team-two">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rts-title-area team text-center">
                    
                        <h2 class="title">Đội Ngũ Bác Sĩ</h2>
                    </div>
                </div>
            </div>
            <div class="row g-6" style="margin-left: 100px;text-align: center;" >
                <!-- single team -->
                <div class="col-xl-4 " >
                    <!-- single team inner -->

                                <a href="team-details.html">
                                    <h5 class="title">Phạm Văn Mạnh</h5>
                                </a>
                                <span>Bác Sĩ</span>
                     
                    <!-- single team inner End -->
                </div>
                <div class="col-xl-4 ">
                    <!-- single team inner -->

                                <a href="team-details.html">
                                    <h5 class="title">Phạm Văn Mạnh</h5>
                                </a>
                                <span>Bác Sĩ</span>
                     
                    <!-- single team inner End -->
                </div><div class="col-xl-4 ">
                    <!-- single team inner -->

                                <a href="team-details.html">
                                    <h5 class="title">Phạm Văn Mạnh</h5>
                                </a>
                                <span>Bác Sĩ</span>
                     
                    <!-- single team inner End -->
                </div>
              
                <!-- single team End -->
            </div>
            <div class="image"style="padding-top: 50px;">
                <div class="row g-6 " style="margin-left: 100px;">
                    <div class="col-md-4" style="padding-left: 30px;">
                        <img src="images/avatar/bacsi1.png" width="302px" height="300">
                        <br><br><br>
                        <div class="col-md-4 mx-auto">
                            <button type="submit" class="form-control" name="submit" id="submit-button"><a class="nav-link " href="index.php?id:#booking">Đặt Lịch</a></button>
                        </div>
                        
                    </div>
                    <div class="col-md-4" style="padding-left: 30px;">
                        <img src="images/avatar/bacsi1.png" width="302px" height="300">
                        <br><br><br>
                        <div class="col-lg-4 mx-auto">
                            <button type="submit" class="form-control" name="submit" id="submit-button"><a class="nav-link " href="index.php?id:#booking">Đặt Lịch</a></button>
                        </div>
               

                     </div>
                     <div class="col-md-4" style="padding-left: 30px;">
                        <img src="images/avatar/bacsi1.png" width="302px" height="300">
                        <br><br><br>
                        <div class="col-lg-4 mx-auto">
                            <button type="submit" class="form-control" name="submit" id="submit-button"><a class="nav-link " href="index.php?id:#booking">Đặt Lịch</a></button>
                        </div>
                      
                     </div>
               

              

            </div>
        </div>
    </div>
        </section>
    </main>

    <?php include_once('includes/footer.php'); ?>
    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scrollspy.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>