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
            <h1 class="display-4 text-center text-white">Welcome to our website</h1>
            <p class="lead text-center text-white">This is a simple website that allows you to manage your tasks.</p>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>