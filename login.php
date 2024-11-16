<?php

    $pageTitle = 'Login';
    include('includes/header.php'); 

    if(isset($_SESSION['auth'])){
        redirect('index.php', 'You are already logged in.', 'info');
    }
?>

<section class="vh-100" style="background-color: #fff;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="assets/image/cozy.jpg"
                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <?= alertMessage(); ?>
                                <form action="login-code.php" method="post">
                                    <div class="d-flex align-items-center mb-2 pb-1">
                                        <img src="assets/image/logo-b.png" alt="" style="width: 50px;">
                                        <span class="h2 fw-bold mb-0"> Estrella Apartment</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control"/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"/>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <button class="btn btn-m btn-primary" name="btnLogin" type="submit">Login</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>