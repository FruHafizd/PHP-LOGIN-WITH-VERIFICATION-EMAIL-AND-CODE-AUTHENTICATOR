<?php
require_once "verifyUser.php";
include 'dbcon.php';
session_start();

class Code 
{
    public function Register()
    {   
        $db = new dbcon();
        $con = $db->ConnectionDatabase();
        if (isset($_POST['register_btn'])) 
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passowrd_hashed = password_hash($password,PASSWORD_BCRYPT);
            $phone = $_POST['phone'];
            $name = $_POST['name'];
            $verify_token = md5(rand());


            $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
            $check_email_query =mysqli_query($con,$check_email_query);
            
            if (mysqli_num_rows($check_email_query) > 0) {
                $_SESSION['status'] = "Email Id ALready Exist";
                header("Location: register.php");
            }else {
                $query = "INSERT INTO users(email,password,phone,name,verify_token) VALUES ('$email','$passowrd_hashed ','$phone','$name','$verify_token')";

                $query_run = mysqli_query($con,$query);

                if ($query_run) {
                    $verifyUser = new verifyUser();
                    $verifyUser->sendVerifyEmail("$name","$email","$verify_token");
                    $_SESSION['status'] = "Registration Succesfully, Please Verify Your Account";
                    header("Location: ../public/login.php");
                }else {
                    $_SESSION['status'] = "Registrastion Failed";
                    header("Location: ../public/register.php");
                }
            }
        }
    }

} 

$code = new Code();
$code->Register();
