<?php 
include('../core/init.php');
// $users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_POST['pay']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $_SESSION['description'] = $_POST['description'];

    if (isset($_POST['sent_to_user_id'])) {
        # code...
        $_SESSION['sent_to_user_id'] = $_POST['sent_to_user_id'];
        $_SESSION['fund_id'] = $_POST['fund_id'];
        $_SESSION['comment'] = $_POST['comment'];
    }

    //* Prepare our rave request
    $request = [
        'tx_ref' => time(),
        'amount' => $amount,
        'currency' => 'RWF',
        'payment_options' => "card",
        'redirect_url' => ''.BASE_URL_PUBLIC.'flutter/process.php',
        'customer' => [
            'email' => $email,
            'name' => $name
        ],
        'meta' => [
            'price' => $amount
        ],
        'customizations' => [
            'title' => 'Paying to irangiro',
            'description' => $description
        ]
    ];

    //* Ca;; f;iterwave emdpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK-7f609337676e8f929afa61d988c1838c-X',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    
    $res = json_decode($response);
    exit($response);
    // var_dump($response);

    // if($res->status == 'success')
    // {
    //     $link = $res->data->link;
    //     header('Location: '.$link);
    // }
    // else
    // {
    //     echo 'We can not process your payment';
    // }
}

?>