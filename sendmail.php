<?php
    require('config/function.php');
    require_once 'vendor/autoload.php';

    use Symfony\Component\Mailer\Transport;
    use Symfony\Component\Mailer\Mailer;
    use Symfony\Component\Mime\Email;

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
            $transport = Transport::fromDsn('smtp://estrellaapartment110@gmail.com:plhycyntzwbkgohn@smtp.gmail.com:587');
            $mailer = new Mailer($transport);
            $message = (new Email())
                ->from('estrellaapartment110@gmail.com')
                ->to('estrellaapartment110@gmail.com')
                ->subject($subject)
                ->html($bodyContent)
            ;
            $mailer->send($message);
            redirect('inquire.php','Inquiry Sent Successfully. We will get back to you asap.','success');
        }catch(\Exception $e){
            redirect('inquire.php','Something went wrong: '. $e->getMessage(),'error');
        }
    }
?>