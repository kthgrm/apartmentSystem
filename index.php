<?php

    $pageTitle = 'Home';
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

<div class="py-5">
    <div class="container">
        <?= alertMessage(); ?>
        <div class="col">
            <h1 class="display-4 text-center text-white">Welcome to Estrella Apartment</h1>
            <p class="lead text-center text-white">Estrella Apartment offers comfortable and affordable living spaces for families and individuals.</p>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>