<?php
    $mail->SMTPDebug = 4;                               // Enable verbose debug output
    //$mail->isMail();
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Port = 587;
    //$mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS=true;                                    // TCP port to connect to
    $mail->Username = "diaboliccancer6969@gmail.com";
    $mail->Password = "9175229lapaz";
?>