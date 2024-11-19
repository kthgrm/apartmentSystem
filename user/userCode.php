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

    if(isset($_POST['btnComplain'])){
        $id = validate($_SESSION['loggedInUser']['userID']);
        $unit = validate($_SESSION['unit']);
        $compSubject = validate($_POST['compSubject']);
        $compDesc = validate($_POST['compDesc']);

        if(empty($compSubject)||empty($compDesc)){
            redirect("complaint.php", "Please fill all the input fields.", 'error');
        }else{
            $query = "INSERT INTO complaint (tenantID, unitID, complaintSubject, complaintDescription)
                        VALUES ('$id', '$unit', '$compSubject', '$compDesc')";
            $result = mysqli_query($conn, $query);

            if($result){
                redirect("complaint.php", "Request submitted successfully." , 'success');
            }else{
                redirect("complaint.php", "Failed to submit request.", 'error');
            }
        }
    }


    if(isset($_POST['btnUpdateProfile'])){
        $id = validate($_SESSION['loggedInUser']['userID']);
        $fname = validate($_POST['fname']);
        $mname = validate($_POST['mname']);
        $lname = validate($_POST['lname']);
        $contact = validate($_POST['contact']);
        $email = validate($_POST['email']);
        
        // Retrieve the current tenant data
        $tenant = getByID('tenant', $id);
        if($tenant['status'] != 200){
            redirect("profile-edit.php", "User not found.", 'error');
        }

        if($_FILES['tenantImage']['size'] > 0){
            $tenantImage = $_FILES['tenantImage']['name'];

            $imgFileTypes = strtolower(pathinfo($tenantImage, PATHINFO_EXTENSION));
            if($imgFileTypes != 'jpg' && $imgFileTypes != 'png' && $imgFileTypes != 'jpeg'){
                redirect("profile-edit.php", "Invalid image format. Please upload a jpg, jpeg, or png image.", 'error');
            }
            
            $path = "../assets/uploads/profile/";
            $imgExt = pathinfo($tenantImage, PATHINFO_EXTENSION);
            $filename = time().'.'.$imgExt;

            $finalImage = 'assets/uploads/profile/'.$filename;

            $query = "UPDATE tenant SET fname = '$fname', mname = '$mname', lname = '$lname', contact = '$contact', email = '$email', tenantImage = '$finalImage' WHERE tenantID = '$id'";
        } else {
            $query = "UPDATE tenant SET fname = '$fname', mname = '$mname', lname = '$lname', contact = '$contact', email = '$email' WHERE tenantID = '$id'";
        }

        $result = mysqli_query($conn, $query);
        if($result){
            if($_FILES['tenantImage']['size'] > 0){
                // Delete the old image
                $oldImagePath = '../'.$tenant['data']['tenantImage'];
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
                
                move_uploaded_file($_FILES['tenantImage']['tmp_name'], $path.$filename);
            }
            redirect("profile.php", "Profile updated successfully." , 'success');
        } else {
            redirect("profile-edit.php", "Failed to update profile.", 'error');
        }
    }
?>