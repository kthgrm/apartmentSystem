<?php

    require '../config/function.php';
 
    if(isset($_POST['addTenant'])){
        $fname = validate($_POST['fname']);
        $mname = validate($_POST['mname']);
        $lname = validate($_POST['lname']);
        $contact = validate($_POST['contact']);
        $email = validate($_POST['email']);
        $unit = validate($_POST['unit']);
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);

        if(empty($fname) || empty($lname) || empty($contact) || empty($email) || empty($unit) || empty($username) || empty($password)){
            redirect("tenant-add.php", "Please fill all the input fields.", 'error');
        }else{
            $query1 = "INSERT INTO user (username, password, type)
                        VALUES ('$username', '$password', 'tenant')";
            $result1 = mysqli_query($conn, $query1);
            

            if($result1){
                $userID = mysqli_insert_id($conn);
                $finalImage = '';

                if($_FILES['tenantImage']['size'] > 0){
                    $tenantImage = $_FILES['tenantImage']['name'];
                    $imgFileTypes = strtolower(pathinfo($tenantImage, PATHINFO_EXTENSION));
                    if($imgFileTypes != 'jpg' && $imgFileTypes != 'png' && $imgFileTypes != 'jpeg'){
                        redirect("tenant-add.php", "Invalid image format. Please upload a jpg, jpeg, or png image.", 'error');
                    }
                    
                    $path = "../assets/uploads/profile/";
                    $imgExt = pathinfo($tenantImage, PATHINFO_EXTENSION);
                    $filename = time().'.'.$imgExt;
                    $finalImage = 'assets/uploads/profile/'.$filename;

                    // Move the uploaded file
                    move_uploaded_file($_FILES['tenantImage']['tmp_name'], $path.$filename);
                }

                $query2 = "INSERT INTO tenant (tenantID, fname, mname, lname, contact, email, unitID, tenantImage)
                        VALUES ('$userID', '$fname', '$mname', '$lname', '$contact', '$email', '$unit' ,'$finalImage')";
                $result2 = mysqli_query($conn, $query2);

                if($result2){
                    $query3 = "UPDATE unit SET status = 'occupied' WHERE unitID = '$unit'";
                    $result3 = mysqli_query($conn, $query3);
                    
                    if($result3){
                        redirect("tenant.php", "Tenant added successfully." , 'success');
                    }else{
                        redirect("tenant-add.php", "Tenant added but failed to update unit status.", 'error');
                    }
                }else{
                    redirect("tenant-add.php", "Failed to add tenant.", 'error');
                }
            }else{
                redirect("tenant-add.php", "Failed to add tenant.", 'error');
            }
        }
    }

    if(isset($_POST['updateTenant'])){
        $fname = validate($_POST['fname']);
        $mname = validate($_POST['mname']);
        $lname = validate($_POST['lname']);
        $contact = validate($_POST['contact']);
        $email = validate($_POST['email']);
        $unit = validate($_POST['unit']);
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);

        $tenantID = validate($_POST['tenantID']);
        
        $tenant = getByID('tenant', $tenantID);
        if($tenant['status'] != 200){
            redirect("tenant-edit.php?id=".$tenantID, "Tenant not found.", 'error');
        }


        if(empty($fname) || empty($lname) || empty($contact) || empty($email) || empty($unit) || empty($username) || empty($password)){
            redirect("tenant-edit.php?id=$id", "Please fill all the input fields.", 'error');
        }else{
            $query1 = "UPDATE user SET username = '$username', password = '$password' WHERE userID = '$tenantID'";
            $result1 = mysqli_query($conn, $query1);

            if($result1){
                $finalImage = $tenant['data']['tenantImage'];

                if($_FILES['tenantImage']['size'] > 0){
                    $tenantImage = $_FILES['tenantImage']['name'];
                    $imgFileTypes = strtolower(pathinfo($tenantImage, PATHINFO_EXTENSION));
                    if($imgFileTypes != 'jpg' && $imgFileTypes != 'png' && $imgFileTypes != 'jpeg'){
                        redirect("tenant-edit.php?id=$tenantID", "Invalid image format. Please upload a jpg, jpeg, or png image.", 'error');
                    }
                    
                    $path = "../assets/uploads/profile/";
                    $imgExt = pathinfo($tenantImage, PATHINFO_EXTENSION);
                    $filename = time().'.'.$imgExt;
                    $finalImage = 'assets/uploads/profile/'.$filename;

                    if(file_exists('../'.$tenant['data']['tenantImage'])){
                        unlink('../'.$tenant['data']['tenantImage']);
                    }

                    move_uploaded_file($_FILES['tenantImage']['tmp_name'], $path.$filename);
                }
                
                $query2 = "UPDATE tenant SET fname = '$fname', mname = '$mname', lname = '$lname', contact = '$contact', email = '$email', unitID = '$unit', tenantImage = '$finalImage' WHERE tenantID = '$tenantID'";
                $result2 = mysqli_query($conn, $query2);
                if($result2){
                    redirect("tenant.php", "Tenant updated successfully." , 'success');
                }else{
                    redirect("tenant-edit.php?id=$tenantID", "Something went wrong.", 'error');
                }
            }else{
                $error = mysqli_error($conn);
                redirect("tenant-edit.php?id=$tenantID", "Failed to update user credentials.", 'error');
            }
        }
    }

    if(isset($_POST['updateRequestStatus'])){
        $status = validate($_POST['status']);
        $requestID = validate($_POST['requestID']);
        
        $query = "UPDATE maintenance SET requestStatus = '$status' WHERE requestID = '$requestID'";
        $result = mysqli_query($conn, $query);

        if($result){
            redirect("maintenance-view.php?id=".$requestID, "Request updated successfully." , 'success');
        }else{
            redirect("maintenance-view.php?id=".$requestID, "Failed to update request.", 'error');
        }
    }

    if(isset($_POST['updateComplaintStatus'])){
        $status = validate($_POST['status']);
        $complaintID = validate($_POST['complaintID']);
        
        $query = "UPDATE complaint SET complaintStatus = '$status' WHERE complaintID = '$complaintID'";
        $result = mysqli_query($conn, $query);

        if($result){
            redirect("complaint-view.php?id=".$complaintID, "Request updated successfully." , 'success');
        }else{
            redirect("complaint-view.php?id=".$complaintID, "Failed to update request.", 'error');
        }
    }
?>