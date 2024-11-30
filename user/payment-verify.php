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
            $invoiceID = $_SESSION['invoiceID'];
            $tenantID = $_SESSION['loggedInUser']['userID'];
            $paymentMethod = $payment['attributes']['payments'][0]['data']['attributes']['source']['type'];
            $amount = $payment['attributes']['amount'] / 100;
            $datePaid = date('Y-m-d');
            
            // Insert payment record
            $query = "INSERT INTO payment (invoiceID, tenantID, paymentDate, paymentAmount, paymentMethod, referenceNum) VALUES ('$invoiceID', '$tenantID', '$datePaid', '$amount', '$paymentMethod', '$paymentRefNum')";
            $result = mysqli_query($conn, $query);
            
            if($result){
                // Update invoice status
                $queryUpdate = "UPDATE invoice SET paymentStatus = 'paid' WHERE invoiceID = $invoiceID";
                if (mysqli_query($conn, $queryUpdate)) {
                    redirect('payment.php', 'Payment Successful.', 'success');
                } else {
                    echo "Error updating payment status: " . mysqli_error($conn);
                }
            } else {
                echo "Error inserting payment record: " . mysqli_error($conn);
                redirect('payment.php', 'Something Went Wrong.', 'error');
            }
        } else {
            redirect('payment.php', 'Payment Failed.', 'error');
        }
    } else {
        redirect('payment.php', 'Something Went Wrong.', 'error');

    }

?>