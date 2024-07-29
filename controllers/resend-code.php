<?php
session_start();
include 'dbcon.php';
require_once "verifyUser.php";


if (isset($_POST['resend_email_verify_btn'])) 
{
    if (!empty(trim($_POST['email']))) {
        $email = mysqli_real_escape_string($con,$_POST['email']);

        $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1 ";
        $checkemail_query_run = mysqli_query($con,$checkemail_query);
        
        if (mysqli_num_rows($checkemail_query_run) > 0) 
        {
            $row = mysqli_fetch_assoc($checkemail_query_run);
            if ($row['verify_status'] == "0") {

                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                resend_email_verify($name,$email,$verify_token);
                $_SESSION['status'] = "Verification email has been sent to you email addres";
                header("Location: ../public/login.php");
                exit(0);
            }else {
                $_SESSION['status'] = "Email Already Verified. Please Log In";
                header("Location: ../public/resend-email-verification.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Email Is not Registred. Please Registred Now";
            header("Location: ../public/register.php");
            exit(0);
        }
        

    }else {
        $_SESSION['status'] = "Please Enter the Email field";
        header("Location: ../public/resend-email-verification.php");
        exit(0);
    }
} else {
    # code...
}
