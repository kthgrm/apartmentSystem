<?php

    require '../config/function.php';

    if(isset($_POST['btnReqMaintenance'])){
        $id = validate($_SESSION['loggedInUser']['userID']);
        $unit = validate($_SESSION['unit']);
        $reqDesc = validate($_POST['reqDesc']);

        if(empty($reqDesc)){
            redirect("maintenance.php", "Please fill all the input fields.", 'error');
        }else{
            $query = "INSERT INTO maintenance (tenantID, unitID, requestDescription)
                        VALUES ('$id', '$unit', '$reqDesc')";
            $result = mysqli_query($conn, $query);

            if($result){
                redirect("maintenance.php", "Request submitted successfully." , 'success');
            }else{
                redirect("maintenance.php", "Failed to submit request.", 'error');
            }
        }
    }

?>