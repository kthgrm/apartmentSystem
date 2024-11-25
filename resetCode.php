<?php

use GuzzleHttp\Psr7\Query;

    include('config/function.php');
    require_once 'vendor/autoload.php';

    if(isset($_POST['btnSendCode'])) {
        $email = $_POST['email'];

        $host = "smtp.gmail.com";
        $port = "587";
        $sslOrTls = "tls";

        $setUsername = "estrellaapartment110@gmail.com";
        $setPassword = "plhy cynt zwbk gohn";

        $emailAddress = "estrellaapartment110@gmail.com";
        $subject = "Forgot Password Code";

        $query = "SELECT * FROM tenant WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $code = rand(100000, 999999);

            $query = "UPDATE tenant SET reset_code = '$code' WHERE email = '$email'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                redirect('forgotPassword.php','Something went wrong. Please try again.','error');
            }else{
                $bodyContent = '<div>
                    <p>Your reset code is: '.$code.'</p>
                </div>';

                try{
                    // Create the Transport
                    $transport = (new Swift_SmtpTransport($host,$port,$sslOrTls))
                        ->setUsername($setUsername)
                        ->setPassword($setPassword)
                    ;
        
                    // Create the Mailer using your created Transport
                    $mailer = new Swift_Mailer($transport);
        
                    // Create a message
                    $message = (new Swift_Message($subject))
                        ->setFrom([$emailAddress => 'Estrella Apartment'])
                        ->setTo([$email])
                        ->setBody($bodyContent, 'text/html')
                    ;
        
                    // Send the message
                    $result = $mailer->send($message);
                    if($result){
                        redirect('verifyCode.php?email='.$email,'Reset code sent successfully.','success');
                    }else{
                        redirect('forgotPassword.php','Something went wrong. Please try again.','error');
                    }
                }catch(\Exception $e){
                    redirect('forgotPassword.php','Something went wrong: '. $e->getMessage(),'error');
                }
            }
        }else{
            redirect('forgotPassword.php', 'Email not found.', 'error');
        }
    }

    if(isset($_POST['btnVerifyCode'])) {
        $email = $_POST['email'];
        $resetCode = $_POST['resetCode'];

        $query = "SELECT * FROM tenant WHERE email = '$email' AND reset_code = '$resetCode'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            redirect('resetPassword.php?email='.$email, 'Code verified successfully.', 'success');
        }else{
            redirect('verifyCode.php?email='.$email, 'Invalid code.', 'error');
        }
    }

    if(isset($_POST['btnResetPassword'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if($password != $confirmPassword) {
            redirect('resetPassword.php?email='.$email, 'Password does not match.', 'error');
        }else{
            $query = "SELECT tenantID FROM tenant WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $tenantID = $row['tenantID'];

                $query = "UPDATE user SET password = '$password' WHERE userID = '$tenantID'";
                $result = mysqli_query($conn, $query);

                if($result) {
                    $query = "UPDATE tenant SET reset_code = NULL WHERE email = '$email'";
                    $result = mysqli_query($conn, $query);
                    redirect('login.php', 'Password reset successfully.', 'success');
                }else{
                    redirect('resetPassword.php?email='.$email, 'Something went wrong. Please try again.', 'error');
                }
            }else{
                redirect('resetPassword.php?email='.$email, 'Invalid request.', 'error');
            }
        }
    }
?>