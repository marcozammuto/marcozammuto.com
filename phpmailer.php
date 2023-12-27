<?php
   require 'vendor/autoload.php';
   use PHPMailer\PHPMailer\PHPMailer;
   $mail = new PHPMailer;
   $mail->isSMTP();
   $mail->SMTPDebug = 2;
   $mail->Host = 'smtp.hostinger.com';
   $mail->Port = 587;
   $mail->SMTPAuth = true;
   $mail->Username = 'info@marcozammuto.com';
   $mail->Password = '!Psppsp1';
   $mail->setFrom('mymail@myawesomedomain.tld', 'Your Name');
   $mail->addReplyTo('mymail@myawesomedomain.tld', 'Your Name');
   $mail->addAddress('recipient@domain.tld', 'Receiver Name');
   $mail->Subject = 'Checking if PHPMailer works';
   $mail->msgHTML(file_get_contents('message.html'), __DIR__);
   $mail->Body = 'This is just a plain text message body';
   //$mail->addAttachment('attachment.txt');
   if (!$mail->send()) {
       echo 'Mailer Error: ' . $mail->ErrorInfo;
   } else {
       echo 'The email message was sent.';
   }
?>