<?php 
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;


$mail->isSMTP();        // Set mailer to use SMTP IF UR USING IN LOCOHOST TURN IT ON IF UR USING TURN OFF
// $mail->SMTPDebug = 3;                               // Enable verbose debug output
// $mail->Debugoutput = 'html';
// $mail->Host = 'smtp.gmail.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'irangiroltd@gmail.com';                 // SMTP username
$mail->Password = '';                         // SMTP password$mail->passme()
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
// $mail->SMTPOptions = array(
//     'ssl' => array(
//     'verify_peer' => false,
//     'verify_peer_name' => false,
//     'allow_self_signed' => true
//     ));
// $mail->Host = 'iragiro.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'admin@iragiro.com';                 // SMTP username
// $mail->Password = '';                         // SMTP passwordrwanda1234@zd
// $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 465;    // TCP port to connect to 465 or 587

$mail->setFrom($email, 'Irangiro');
$mail->addAddress($emailcomposer);               // Name is optional
// $mail->addAddress('irangiroltd@gmail.com');     // Add a recipient
$mail->addReplyTo($email);  // TCP port to connect to

// $mail->addCC('cc@example.com'); // may not be interested to show all address
// $mail->addBCC('bcc@example.com'); // may not be interested to show all address

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
if (!empty($photo['name'])) {
    # code...
    for ($i=0; $i < count($photo['tmp_name']); $i++) { 
        $mail->AddAttachment($photo['tmp_name'][$i],$photo['name'][$i]);
    
    }
}

if (!empty($uploadcertificates['name'])) {
    # code...
    for ($i=0; $i < count($uploadcertificates['tmp_name']); $i++) { 
        $mail->AddAttachment($uploadcertificates['tmp_name'][$i],$uploadcertificates['name'][$i]);
    
    }
}

$mail->isHTML(true);                        // Set email format to HTML

$mail->Subject = 'Your account irangiro';

$messsage= htmlspecialchars_decode($textcomposer);
$messsage= str_replace('\r\n', " ", $messsage);
$messsage= str_replace('\n', "", $messsage);
$messsage= nl2br($messsage);

$variables = array (
    "{{email_sent_from}}" => $email,
    "{{email_sent_to}}" => $emailcomposer,
    "{{subject}}" => $subjectcomposer,
    "{{message}}" => $messsage,
);

$message = file_get_contents('job_message_email.html', __DIR__);

foreach ($variables as $key => $value) {
    # code...
    $message = str_replace($key,$value,$message);
}

$mail->msgHTML($message);
// $mail->Body    = $message;
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>