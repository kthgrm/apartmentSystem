<?php
    require 'config/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($pageTitle)){ echo $pageTitle; }else{ echo 'Estrella Apartment';}?></title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="icon" href="assets/image/logo-w.png" type="image/png">
</head>
<body>

    <?php include('navbar.php'); ?>