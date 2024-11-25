<?php
    $pageTitle = 'Reset Password';
    include('includes/header.php'); 

    if(isset($_SESSION['auth'])) {
        if($_SESSION['userType'] == 'admin') {
            redirect('admin/index.php', 'You are already logged in as admin.', 'info');
        } else {
            redirect('user/index.php', 'You are already logged in.', 'info');
        }
    }
?>

<div class="container py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col col-lg-10 mx-auto">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0 justify-content-center">
                        <div class="col-lg-5 d-none d-lg-block">
                        <img src="assets/image/cozy.jpg"
                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-12 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <?= alertMessage(); ?>
                                <?php
                                    if(isset($_GET['email'])) {
                                        $email = $_GET['email'];
                                    }else{
                                        redirect('forgotPassword.php','Invalid request.','error');
                                    }
                                ?>
                                <form action="resetCode.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-12 mb-3 mb-md-4">
                                            <span class="h1 fw-bold">Reset Password</span>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-md-4">
                                        <input type="email" name="email" value="<?= $email; ?>" hidden>
                                        <h5>Password</h5>
                                        <input type="password" name="password" class="form-control form-control-lg"/>
                                    </div>
                                    <div class="form-outline mb-md-4">
                                        <h5>Confirm Password</h5>
                                        <input type="password" name="confirmPassword" class="form-control form-control-lg"/>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-m mb-0 btn-primary btn-warning float-end" name="btnResetPassword" type="submit" onclick="return confirm('Are you sure you want to reset your password?');">Confirm</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>