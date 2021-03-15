<?php

require_once 'HTTP/Request2.php';

$request = new HTTP_Request2();
$request->setUrl('https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));

$request->setHeader(array(
  'Ocp-Apim-Subscription-Key' => '5f5f6695f0e74eff8ac0c528a71985ce',
  'X-Reference-Id' => '96a086a1-4bd4-4b36-9aec-4f2f433de202',
  'X-Target-Environment' => 'sandbox',
  'X-Callback-Url' => 'https://webhook.site/d25e9104-1162-47e7-afc3-025fcc01b047',
  'Authorization' => 'Basic OTZhMDg2YTEtNGJkNC00YjM2LTlhZWMtNGYyZjQzM2RlMjAyOjgzZDk3YmIxZGQ4NjQxZDQ5NDgxNDZkMjA2MTAyYzBi',
  'Content-Type' => 'application/json'
));

$request->setBody('{
   "amount": "500",
   "currency": "EUR",
   "externalId": "fg453b",
   "payer": {
     "partyIdType": "MSISDN",
     "partyId": "250787384312"
   },
   "payerMessage": "pay for product",
   "payeeNote": "payer note"
}');

try {
  $response = $request->send();
  if ($response->getStatus() == 200) {
    echo $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}


?>
