    <?php 
        if (basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'forgotPassword.php' && basename($_SERVER['PHP_SELF']) != 'resetPassword.php' && basename($_SERVER['PHP_SELF']) != 'verifyCode.php') {
            include('footer-content.php');
        } 
    ?>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>