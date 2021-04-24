<?php 
$data = [
    'token' => 'flw-t1nf-0f7efa041fcc65af48cec24d6be3cec1-m03k',
    'currency' => 'NGN',
    'country' => 'NG',
    'amount' => 700,
    'tx_ref' => time(),
    'email' => 'seunexseun@gmail.com'
];

    //* Ca;; f;iterwave emdpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/tokenized-charges',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK_TEST-eee25be1b44ef9a132a872075b3a0910-X',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $res = json_decode($response);
    echo '<pre>';
    print_r($res);
    echo '</pre>';
    exit();
    if($res->status == 'success')
    {
        $link = $res->data->link;
        header('Location: '.$link);
    }
    else
    {
        echo 'We can not process your payment';
    }

?>