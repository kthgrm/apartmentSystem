<?php 

    require '../config/function.php';

    if (isset($_GET['id'])) {
        $leaseID = $_GET['id'];

        // Validate the lease ID
        $leaseID = mysqli_real_escape_string($conn, $leaseID);

        // Delete the lease
        $query = "DELETE FROM lease WHERE leaseID = '$leaseID'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status'] = "Lease deleted successfully.";
            $_SESSION['alertType'] = "success";
        } else {
            $_SESSION['status'] = "Failed to delete the lease.";
            $_SESSION['alertType'] = "error";
        }
    } else {
        $_SESSION['status'] = "No lease ID provided.";
        $_SESSION['alertType'] = "error";
    }

    header("Location: lease.php");
    exit();
?>