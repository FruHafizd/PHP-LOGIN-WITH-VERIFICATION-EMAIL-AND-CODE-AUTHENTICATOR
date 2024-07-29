<?php 
include('../controllers/authentication.php');
include('../includes/header.php');
?>


<h1>YOU SUCCES LOGIN</h1>
<hr>
<h5>Username: <?= $_SESSION['auth_user']['username']; ?></h5>
<h5>Phone: <?= $_SESSION['auth_user']['phone']; ?></h5>
<h5>Email: <?= $_SESSION['auth_user']['email']; ?></h5>
<a href="../controllers/logout.php">Click Here For Logout</a>

<?php include('../includes/footer.php')?>