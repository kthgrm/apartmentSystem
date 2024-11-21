<?php
    require('config/function.php');
    require_once 'vendor/autoload.php';

    $host = "smtp.gmail.com";
    $port = "587";
    $sslOrTls = "tls";

    $setUsername = "estrellaapartment110@gmail.com";
    $setPassword = "plhy cynt zwbk gohn";

    $emailAddress = "estrellaapartment110@gmail.com";
    $sendEmailAddress = "estrellaapartment110@gmail.com";
    $subject = "You got new Inquiry";

    if(isset($_POST['btnInquire'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        $bodyContent = '<div>
            <p>Name: '.$name.'</p>
            <p>Email: '.$email.'</p>
            <p>Phone Number: '.$phone.'</p>
            <p>Message: '.$message.'</p>
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
                ->setTo([$sendEmailAddress])
                ->setBody($bodyContent, 'text/html')
            ;

            // Send the message
            $result = $mailer->send($message);
            if($result){
                redirect('inquire.php','Inquiry Sent Successfully. We will get back to you asap.','success');
            }else{
                redirect('inquire.php','Something went wrong. Please try again.','error');
            }
        }catch(\Exception $e){
            redirect('inquire.php','Something went wrong: '. $e->getMessage(),'error');
        }
    }

?>