<?php 

    require '../config/function.php';

    if (isset($_GET['id'])) {
        $requestID = $_GET['id'];
    
        // Validate the request ID
        $requestID = mysqli_real_escape_string($conn, $requestID);
    
        // Update the request status to 'approved'
        $query = "UPDATE maintenance SET requestStatus = 'declined' WHERE requestID = '$requestID'";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            $_SESSION['status'] = "Request declined successfully.";
            $_SESSION['alertType'] = "success";
        } else {
            $_SESSION['status'] = "Failed to decline the request.";
            $_SESSION['alertType'] = "error";
        }
    } else {
        $_SESSION['status'] = "No request ID provided.";
        $_SESSION['alertType'] = "error";
    }
    
    header("Location: maintenance.php");
    exit();
?>