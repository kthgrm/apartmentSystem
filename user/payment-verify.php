<?php

    require_once('../vendor/autoload.php');
    require_once('../config/function.php');
    use GuzzleHttp\Exception\ClientException;

    $client = new \GuzzleHttp\Client();

    if(isset($_SESSION['refNum'])){
        $refNum = $_SESSION['refNum'];
        $response = $client->request('GET', 'https://api.paymongo.com/v1/links/'.$refNum, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfdGVzdF9wOWZIUGlzNHFOa0ZFUHkyb3FHb3Z6YUo6',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $payment = $data['data'];
        $paymentStatus = $payment['attributes']['status'];
        $paymentRefNum = $payment['attributes']['reference_number'];

        if($paymentStatus == 'paid' && $paymentRefNum == $refNum){
            $unitID = $_SESSION['unitID'];
            $tenantID = $_SESSION['loggedInUser']['userID'];
            $paymentMethod = $payment['attributes']['payments'][0]['data']['attributes']['source']['type'];
            $amount = $payment['attributes']['amount'] / 100;
            $datePaid = date('Y-m-d');
            $query = "INSERT INTO payment (unitID, tenantID, paymentDate, paymentAmount, paymentMethod, referenceNum) VALUES ('$unitID', '$tenantID', '$datePaid', '$amount', '$paymentMethod', '$paymentRefNum')";
            $result = mysqli_query($conn, $query);
            if($result){
                redirect('payment.php', 'Payment Successful.', 'success');
            } else {
                redirect('payment.php', 'Something Went Wrong.', 'error');
            }
        } else {
            redirect('payment.php', 'Payment Failed.', 'error');
        }
    } else {
        redirect('payment.php', 'Something Went Wrong.', 'error');

    }

?>