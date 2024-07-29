<?php
session_start();
include 'dbcon.php';

if (isset($_POST['login_now_btn'])) 
{

    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) 
    {
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con,$login_query);

        if (mysqli_num_rows($login_query_run) > 0) 
        {
            $row = mysqli_fetch_assoc($login_query_run);
            // echo ;
            if ($row["verify_status"] == "1") 
            {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'username' => $row['name'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                ];
                $_SESSION['status'] = "You Are Logged In Succesfully";
                header("Location: ../public/index.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Please Verify Your Email Addres To Log in";
                header("Location: ../public/login.php");
                exit(0);
            }
            
        } else 
        {
            $_SESSION['status'] = "Invalid Email Or Password";
            header("Location: ../public/login.php");
            exit(0);
        }
    } else 
    {
        $_SESSION['status'] = "All fields are Mandetory";
        header("Location: ../public/login.php");
        exit(0);
    }
    
}