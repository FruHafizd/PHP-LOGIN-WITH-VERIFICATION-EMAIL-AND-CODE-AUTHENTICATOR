<?php 
session_start();
include('../includes/header.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Registration Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="../controllers/code.php" method="post">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="number" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Addres </label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php') ?> 