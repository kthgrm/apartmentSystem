<?php

    require 'config/function.php';

    if(isset($_POST['btnLogin'])){
        $user = validate($_POST['username']);
        $pass = validate($_POST['password']);

        if(empty($user) || empty($pass)){
            redirect("login.php", "Please fill all fields.", 'error');
        }else{
            $query = "SELECT * FROM user WHERE userName = '$user' AND password = '$pass' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if($result && mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                $_SESSION['auth'] = true;
                $_SESSION['userType'] = $row['type'];
                $_SESSION['loggedInUser'] = [
                    'userID' => $row['userID'], 
                    'username' => $row['username']
                ];

                $userID = $row['userID'];
                $userType = $row['type'];
                $logType = 'login';
                $logQuery = "INSERT INTO log (userID, type, logType) VALUES ('$userID', '$userType', '$logType')";
                mysqli_query($conn, $logQuery);
                
                if($row['type'] == 'admin'){
                    header('location: admin/index.php');
                }else{
                    header('location: user/index.php');
                }
            }else{
                redirect("login.php", "Invalid username or password. Please try again.", 'error');
            }
        }
    }

    if(isset($_POST['btnHome'])){
        header('Location: index.php');
    }
?>