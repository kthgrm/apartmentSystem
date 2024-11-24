<?php

    include('config/function.php');
    require_once 'vendor/autoload.php';

    $host = "smtp.gmail.com";
    $port = "587";
    $sslOrTls = "tls";

    $setUsername = "estrellaapartment110@gmail.com";
    $setPassword = "plhy cynt zwbk gohn";

    $emailAddress = "estrellaapartment110@gmail.com";
    $subject = "Forgot Password Code";

    if(isset($_POST['btnSendCode'])) {
        $email = $_POST['email'];

        $query = "SELECT * FROM tenant WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $code = rand(100000, 999999);

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
                    header('Location: verifyCode.php?email='.$email);
                }else{
                    redirect('forgotPassword.php','Something went wrong. Please try again.','error');
                }
            }catch(\Exception $e){
                redirect('forgotPassword.php','Something went wrong: '. $e->getMessage(),'error');
            }
        }else{
            redirect('forgotPassword.php', 'Email not found.', 'error');
        }
    }
            
?>