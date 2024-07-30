<?php
session_start();
include "dbcon.php";
require_once "verifyUser.php";

if (isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1 ";
    $check_email_run = mysqli_query($con,$check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_assoc($check_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run =mysqli_query($con,$update_token);

        if ($update_token_run) {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status'] = "We E-mail you a password reset link";
            header("Location: ../public/password-reset.php");
            exit(0);

        } else {
            $_SESSION['status'] = "Something went Wrong. #1";
            header("Location: ../public/password-reset.php");
            exit(0);
        }
        
    }
    else {
        $_SESSION['status'] = "No Email Found";
        header("Location: ../public/password-reset.php");
        exit(0);
    }
    
}


if (isset($_POST['password_update'])) 
{
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $new_password = mysqli_real_escape_string($con,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con,$_POST['confirm_password']);
    
    $token = mysqli_real_escape_string($con,$_POST['password_token']);

    if (!empty($token)) {
        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            // CHECK TOKEN VALID OR NOT
            $check_token =  "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1 ";
            $check_token_run = mysqli_query($con,$check_token);

            if (mysqli_num_rows($check_token_run) > 0) 
            {
                if ($new_password == $confirm_password) 
                {
                    $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($con,$update_password);

                    if ($update_password_run) {
                        $new_token = md5(rand());
                        $update_to_new_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token'";
                        $update_to_new_token_run = mysqli_query($con,$update_to_new_token);

                        $_SESSION['status'] = "New Password Succesfully Updated!";
                        header("Location: ../public/login.php");
                        exit(0);
                    }else {
                        $_SESSION['status'] = "Did not update password something went wrong";
                        header("Location: ../public/password-change.php?token=$token&email=$email");
                        exit(0);
                    }

                }else {
                    $_SESSION['status'] = "Password And confirm password does not match";
                    header("Location: ../public/password-change.php?token=$token&email=$email");
                    exit(0);
                }
            }else {
                $_SESSION['status'] = "Invalid Token";
                header("Location: ../public/password-change.php?token=$token&email=$email");
                exit(0);
            }

        }
        else {
            $_SESSION['status'] = "All filed are mendetory";
            header("Location: ../public/password-change.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No Token Available";
        header("Location: ../public/password-reset.php");
        exit(0);
    }
    
}