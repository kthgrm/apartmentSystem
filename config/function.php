<?php

    session_start();
    require 'dbcon.php';

    function validate($inputData){
        global $conn;
        $validatedData = mysqli_real_escape_string($conn, $inputData);
        return trim($validatedData);
    }

    function redirect($location, $status, $alertType) {
        $_SESSION['status'] = $status;
        $_SESSION['alertType'] = $alertType;
        header("location: $location");
        exit(0);
    }

    function alertMessage() {
        if (isset($_SESSION['status']) && isset($_SESSION['alertType'])) {
            $alertType = $_SESSION['alertType'] == 'error' ? 'alert-danger' : 'alert-success';
            echo '<div class="alert ' . $alertType . '">
                <h4>' . $_SESSION['status'] . '</h4>
            </div>';
            unset($_SESSION['status']);
            unset($_SESSION['alertType']);
        }
    }

    function fetchAll($tableName){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function fetchUserAdmin($id){
        global $conn;
        $vID = validate($id);
        $query = "SELECT * FROM user JOIN admin ON user.userID = admin.adminID WHERE userID = '$vID' LIMIT 1";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function fetchUserTenant($id) {
        global $conn;
        $vID = validate($id);
        $query = "SELECT * FROM user JOIN tenant ON user.userID = tenant.tenantID WHERE userID = '$vID' LIMIT 1";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function fetchUnitTenant($id){
        global $conn;
        $vID = validate($id);
        $query = "SELECT * FROM tenant WHERE unitID = '$vID'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function fetchPaymentJoinTenant($tableName){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table JOIN tenant ON $table.tenantID = tenant.tenantID";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function fetchLeaseTenant($tableName){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT l.*, t.fname, t.lname FROM $table l JOIN tenant t ON l.tenantID = t.tenantID";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function checkParamID($paramType){
        if(isset($_GET[$paramType])){
            if($_GET[$paramType] != ''){
                return $_GET[$paramType];
            }else{
                return 'No id found';
            }
            return validate($_GET[$paramType]);
        }else{
            return 'No id given';
        }
    }

    function getByID($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table JOIN user ON $table.tenantID = user.userID WHERE tenantID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }

    function getProfile($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table JOIN user ON $table.tenantID = user.userID WHERE tenantID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }

    function getByIdMaintenance($tenantID){
        global $conn;
        $tenant = validate($tenantID);
        $query = "SELECT * FROM maintenance JOIN tenant ON maintenance.tenantID = tenant.tenantID WHERE maintenance.tenantID = '$tenant'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getByIdComplaint($tenantID){
        global $conn;
        $tenant = validate($tenantID);
        $query = "SELECT * FROM complaint JOIN tenant ON complaint.tenantID = tenant.tenantID WHERE complaint.tenantID = '$tenant'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function getByIdInvoicePayment($unitID){
        global $conn;
        $unit = validate($unitID);
        $query = "SELECT paymentID, paymentAmount, paymentDate FROM payment JOIN invoice ON payment.invoiceID = invoice.invoiceID WHERE unitID = '$unit'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getByIdComplaintJoinTenant($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table JOIN tenant ON $table.tenantID = tenant.tenantID WHERE complaintID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }

    function getByIdMaintenanceJoinTenant($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table JOIN tenant ON $table.tenantID = tenant.tenantID WHERE requestID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }
    
    function getByIdInvoice($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table WHERE invoiceID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }

    function getByIdLease($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table JOIN tenant on $table.tenantID = tenant.tenantID WHERE leaseID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }

    function getByIdUnit($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table WHERE unitID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }

    function getByIdPaymentJoinTenant($tableName,$paramResult){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table JOIN tenant ON $table.tenantID = tenant.tenantID WHERE paymentID = '$paramResult'";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'message' => 'Data Record',
                    'data' => $row
                ];
                return $response;
            }else{
                $response = [
                    'status' => '404',
                    'message' => 'No Data Record'
                ];
                return $response;
            }
        }else{
            $response = [
                'status' => '500',
                'message' => 'Something went wrong'
            ];
            return $response;
        }
        return $result;
    }

    function getUserLog($tableName){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table 
                  LEFT JOIN admin ON $table.userID = admin.adminID 
                  LEFT JOIN tenant ON $table.userID = tenant.tenantID";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getCount($tableName){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $query);
        $totalCount = mysqli_num_rows($result);
        return $totalCount;
    }

    function deleteQuery($tablename, $id){
        global $conn;
        $table = validate($tablename);
        $id = validate($id);
        
        $query = "DELETE FROM $table WHERE tenantID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        // Delete from the user table
        $userQuery = "DELETE FROM user WHERE userID = '$id' LIMIT 1";
        $userResult = mysqli_query($conn, $userQuery);
        
        return $result && $userResult;
    }

    function deleteQueryUnit($tablename, $id){
        global $conn;
        $table = validate($tablename);
        $id = validate($id);
        
        try {
            // Start a transaction
            mysqli_begin_transaction($conn);
    
            // Delete the row in the unit table
            $query = "DELETE FROM $table WHERE unitID = '$id' LIMIT 1";
            $result = mysqli_query($conn, $query);
    
            // Commit the transaction
            mysqli_commit($conn);
    
            return $result;
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            mysqli_rollback($conn);
            return false;
        }
    }

    function logoutSession(){
        unset($_SESSION['auth']);
        unset($_SESSION['userType']);
        unset($_SESSION['loggedInUser']);
        unset($_SESSION['refNum']);
        unset($_SESSION['unitID']);
    }
?>