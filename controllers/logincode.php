<?php
session_start();
include 'dbcon.php';

if (isset($_POST['login_now_btn'])) 
{
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) 
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = $_POST['password']; // Tidak perlu escaping karena tidak dimasukkan langsung ke query SQL

        // Cari pengguna berdasarkan email
        $login_query = "SELECT * FROM users WHERE email=? LIMIT 1";
        $stmt = $con->prepare($login_query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verifikasi password
            if (password_verify($password, $hashed_password)) 
            {
                if ($row["verify_status"] == "1") 
                {
                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'username' => $row['name'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                    ];
                    $_SESSION['status'] = "You Are Logged In Successfully";
                    header("Location: ../public/index.php");
                    exit(0);
                } 
                else 
                {
                    $_SESSION['status'] = "Please Verify Your Email Address To Log In";
                    header("Location: ../public/login.php");
                    exit(0);
                }
            } 
            else 
            {
                $_SESSION['status'] = "Invalid Email Or Password";
                header("Location: ../public/login.php");
                exit(0);
            }
        } 
        else 
        {
            $_SESSION['status'] = "Invalid Email Or Password";
            header("Location: ../public/login.php");
            exit(0);
        }
    } 
    else 
    {
        $_SESSION['status'] = "All fields are Mandatory";
        header("Location: ../public/login.php");
        exit(0);
    }
}
