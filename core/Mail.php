<?php
namespace App\Core;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class Mail {
   
   public static function sendMail($to, $subject, $content) {
      //Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);
    
      try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tamtt1512@gmail.com';                     //SMTP username
        $mail->Password   = 'kctt nfxn qipj mnry';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('tamtt1512@gmail.com', 'Tôn Thành Tâm');
        $mail->addAddress($to);     //Add a recipient
        // $mail->addReplyTo($to, $content_mail); // Xác định email sẽ được thêm vào phần trả lời
    
        //Content
        $mail->isHTML(true);     
        $mail->CharSet = 'utf8';                             //Set email format to HTML
        $mail->Subject = $subject; // Tiêu đề email
        $mail->Body    = $content; // Nội dung email
    
        return $mail->send();
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
}