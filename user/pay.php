<?php

require_once('../vendor/autoload.php');
require_once('../config/function.php');
use GuzzleHttp\Exception\ClientException;

$client = new \GuzzleHttp\Client();

try {
    if (isset($_POST['btnPay'])) {
        $unit = $_POST['unitID'];
        if (isset($_POST['unitRate']) && !empty($_POST['unitRate'])) {
            $amount = (int)validate($_POST['unitRate']) * 100;

            $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
                'body' => json_encode([
                    'data' => [
                        'attributes' => [
                            'amount' => $amount,
                            'description' => 'Monthly Rent',
                            'remarks' => 'Payment for Unit ' . $unit,
                            'currency' => 'PHP',
                        ]
                    ]
                ]),
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9wOWZIUGlzNHFOa0ZFUHkyb3FHb3Z6YUo6',
                    'content-type' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            $redirect = $data['data']['attributes']['checkout_url'];
            $refNum = $data['data']['attributes']['reference_number'];
            $_SESSION['refNum'] = $refNum;
            $_SESSION['unitID'] = $unit;
            echo "<script>alert('Open Payment link in a new tab.');</script>";
            echo "<script>window.open('$redirect', '_blank');</script>";
            echo "<a href='payment-verify.php'>Verify Payment</a>";
        } else {
            redirect('payment.php', 'Something Went Wrong.', 'error');
        }
    } else {
        redirect('payment.php', 'Something Went Wrong.', 'error');
    }
} catch (ClientException $e) {
    $response = $e->getResponse();
    $responseBodyAsString = $response->getBody()->getContents();
    $error = json_decode($responseBodyAsString, true);
    redirect('payment.php', $error['errors'][0]['detail'] . ' ' . $amount, 'error');
}

?>