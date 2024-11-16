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
        <h4>Home Page</h4>
    </div>
</div>

<?php include('includes/footer.php'); ?>