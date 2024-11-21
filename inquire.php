<?php

    $pageTitle = 'Inquire';
    include('includes/header.php'); 

?>

<style>
    body {
        background-image: url('assets/image/wall.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

    <div class="container py-3">
        <div class="row">
            <div class="col-md-10 col-lg-6 mx-auto">
                <div class="card card-body p-5">
                    <?= alertMessage(); ?>
                    <form action="sendmail.php" method="POST">
                        <h3 class="text-center">Inquiry</h3>
                        <div class="mb-md-3 mb-lg-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-md-3 mb-lg-4">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-md-3 mb-lg-4">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-md-3 mb-lg-4">
                            <label>Inquiry Message</label>
                            <textarea name="message" class="form-control" rows="6" required></textarea>
                        </div>
                        <button type="submit" name="btnInquire" class="btn w-100 text-white" style="background-color: orange;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>