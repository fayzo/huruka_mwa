<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

$url = "http://localhost/irangiro_social_site/curl_response_Http.php";
$authHeader = array('Accept: application/form-data');

  $post_fields =  "name=value1&comment=value2&submit=value3";

  send_curl_request("POST", $authHeader, $url, $post_fields);

function send_curl_request($method, $headers, $url, $post_fields){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  if(count($headers) > 0){
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //echo '<br> HEADER ADDED<br><br>';
  }
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
  if($method == "POST"){
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    //echo '<br> POST FIELDS ADDED<br><br>';
  } 
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_VERBOSE,true);
  $result = curl_exec($ch);
  curl_close($ch);
  echo $result;
}

    // $h = curl_init();

    // curl_setopt($h, CURLOPT_URL, "http://localhost/irangiro_social_site/curl_response_Http.php"); 
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($h, CURLOPT_POST, true);
    // // curl_setopt($h, CURLOPT_POSTFIELDS, array(
    // // 'name' => 'yes',
    // // 'comment' => 'no',
    // // 'submit' => 'submit'
    // // ));
    // curl_setopt($h, CURLOPT_POSTFIELDS, "name=value1&comment=value2&submit=value3");

    // curl_setopt($h, CURLOPT_HEADER, false);
    // curl_setopt($h, CURLOPT_RETURNTRANSFER, 1);

    // if (curl_error($ch)) {
    //     trigger_error('Curl Error:' . curl_error($ch));
    // }
    // $result = curl_exec($h);
    // echo $result;
    // if ($server_output == "OK") { echo 'gud'; } else { echo 'bad'; }

?>