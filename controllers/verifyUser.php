<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function sendVerifyEmail($name,$email,$verify_token)
{
    $mail = new PHPMailer(true);
    
    try {
        // Pengaturan server
        $mail->isSMTP();
        $mail->Host       = 'localhost'; // Mailpit berjalan di localhost
        $mail->SMTPAuth   = false; // Mailpit tidak membutuhkan autentikasi
        $mail->Port       = 1025; // Port default Mailpit untuk SMTP
    
        // Penerima
        $mail->setFrom('your_email@example.com', $name);
        $mail->addAddress($email);
    
        // Konten
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from LOGINOOP';

        $email_template = "
            <h2>You Have Registerd with email verification</h2>
            <h5>Verify your email addres to login with the below given link</h5>
            <br>
            <a href='http://localhost:8237/public/verify.php?token=$verify_token'>Click Here</a>
        ";


        $mail->Body    = $email_template;
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}