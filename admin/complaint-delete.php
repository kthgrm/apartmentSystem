<?php 

    require '../config/function.php';

    if (isset($_GET['id'])) {
        $complaintID = $_GET['id'];

        // Validate the request ID
        $complaintID = mysqli_real_escape_string($conn, $complaintID);

        // Delete the request
        $query = "DELETE FROM complaint WHERE complaintID = '$complaintID'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status'] = "Request deleted successfully.";
            $_SESSION['alertType'] = "success";
        } else {
            $_SESSION['status'] = "Failed to delete the request.";
            $_SESSION['alertType'] = "error";
        }
    } else {
        $_SESSION['status'] = "No request ID provided.";
        $_SESSION['alertType'] = "error";
    }

    header("Location: complaint.php");
    exit();
?>