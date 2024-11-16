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
                $query2 = "INSERT INTO tenant (tenantID, fname, mname, lname, contact, email, unitID)
                        VALUES ('$userID', '$fname', '$mname', '$lname', '$contact', '$email', '$unit')";
                $result2 = mysqli_query($conn, $query2);
                if($result2){
                    redirect("tenant.php", "Tenant added successfully." , 'success');
                }else{
                    redirect("tenant-add.php", "Username should be unique.", 'error');
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
                $query2 = "UPDATE tenant SET fname = '$fname', mname = '$mname', lname = '$lname', contact = '$contact', email = '$email', unitID = '$unit' WHERE tenantID = '$tenantID'";
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

    $sortOption = isset($_GET['sort']) ? $_GET['sort'] : '';
    $query = "SELECT * FROM maintenance";

    // Modify the query based on the sorting option
    switch ($sortOption) {
        case 'Pending':
            $query .= " WHERE status = 'pending'";
            break;
        case 'Approved':
            $query .= " WHERE status = 'approved'";
            break;
        case 'Declined':
            $query .= " WHERE status = 'declined'";
            break;
        default:
            // Default sorting or no sorting
            $query .= " ORDER BY request_date DESC";
            break;
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check for errors
    if (!$result) {
        die('Query Failed: ' . mysqli_error($conn));
    }

    // Display the sorted data
    while ($row = mysqli_fetch_assoc($result)) {
        // Output your data here, e.g.:
        echo "<div>{$row['request_date']} - {$row['status']}</div>";
    }
?>