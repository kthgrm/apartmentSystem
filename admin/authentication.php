<?php
    if(isset($_SESSION['auth'])){
        if($_SESSION['userType']){
            $role = validate($_SESSION['userType']);
            $user = validate($_SESSION['loggedInUser']['username']);
            
            $query = "SELECT * FROM user WHERE username = '$user' AND type = '$role' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if($result){
                if(mysqli_num_rows($result) == 0){
                    logoutSession();
                    redirect('../login.php', 'Access Denied.HAHA', 'error');
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if($row['type'] != 'admin'){
                        // logoutSession();
                        redirect('../user/index.php', 'Access Denied.', 'error');
                    }
                }
            }else{
                logoutSession();
                redirect('../login.php', 'Something Went Wrong.', 'error');
            }
        }
    }else{
        redirect('../login.php', 'Login to continue.', 'info');
    }
?>