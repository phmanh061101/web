<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/vendor/autoload.php'; 

class Mailer {}

    
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
        $mail->Body    = 'Xác Nhận Đặt Lịch';
        $mail->send($thoigian,$ngay);
        
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    
    ?>