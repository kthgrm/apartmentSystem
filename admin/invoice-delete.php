<?php 

    require '../config/function.php';

    if (isset($_GET['id'])) {
        $invoiceID = $_GET['id'];

        // Validate the invoice ID
        $invoiceID = mysqli_real_escape_string($conn, $invoiceID);

        // Delete the invoice
        $query = "DELETE FROM invoice WHERE invoiceID = '$invoiceID'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status'] = "Invoice deleted successfully.";
            $_SESSION['alertType'] = "success";
        } else {
            $_SESSION['status'] = "Failed to delete the invoice.";
            $_SESSION['alertType'] = "error";
        }
    } else {
        $_SESSION['status'] = "No invoice ID provided.";
        $_SESSION['alertType'] = "error";
    }

    header("Location: invoice.php");
    exit();
?>