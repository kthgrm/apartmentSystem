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

    function deleteQuery($tablename, $id){
        global $conn;
        $table = validate($tablename);
        $id = validate($id);
        
        // Delete from the specified table
        $query = "DELETE FROM $table WHERE tenantID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        // Delete from the user table
        $userQuery = "DELETE FROM user WHERE userID = '$id' LIMIT 1";
        $userResult = mysqli_query($conn, $userQuery);
        
        return $result && $userResult;
    }
?>