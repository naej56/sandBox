<?php 
require 'lib/PHPmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'kevin.legoff.carreleur@gmail.com';                 // SMTP username
$mail->Password = 'kevinlegoff56';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->CharSet = 'utf-8';

$mail->setFrom('kevin.legoff.carreleur@gmail.com', 'Kevin Le Goff');
$mail->addAddress('naej56@gmail.com', 'NaeJ56');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('kevin.legoff.carreleur@gmail.com', 'Kevin Le Goff');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = '[Devis] Kevin Le Goff vous a envoyé votre devis';
//$mail->Body    = 'Bonjour,<br>Vous trouverez en pièce jointe votre devis.<br><br>Pour toutes demande complémentaire vous pouvez me contacter en réponse de ce mail ou m\'appeler au <b>07 81 23 20 65</b>';
$mail->Body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>PHPMailer Test</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 17px;">
  <p>Bonjour,</p>
  <p></p>
  <p>Vous trouverez en pièce jointe votre devis.</p>
  <p></p>
  <p>Pour toute demande je reste à votre disposition par mail ou au <b>07 81 23 20 65</b></p>
</div>
</body>
</html>';
$mail->AltBody = 'Bonjour,\n..Vous trouverez en pièce jointe votre devis.\n..\n..Pour toutes demande complémentaire vous pouvez me contacter en réponse de ce mail ou m\'appeler au 07 81 23 20 65';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


 ?>