<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You Logout Succesfully";
header("Location: ../public/login.php");