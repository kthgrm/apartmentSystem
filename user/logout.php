<?php

    require '../config/function.php';

    if(isset($_SESSION['auth'])){
        $userID = $_SESSION['loggedInUser']['userID'];
        $userType = $_SESSION['userType'];
        $logType = 'logout';
        $logQuery = "INSERT INTO log (userID, type, logType) VALUES ('$userID', '$userType', '$logType')";
        mysqli_query($conn, $logQuery);
        
        logoutSession();
        redirect('../login.php', 'Logged out successfully.', 'success');
    }

?>