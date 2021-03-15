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
$mail->Host = 'iragiro.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'admin@iragiro.com';                 // SMTP username
$mail->Password = '';                         // SMTP passwordrwanda1234@z
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;    // TCP port to connect to 465 or 587

$mail->setFrom('admin@iragiro.com', 'Irangiro');
$mail->addAddress($email);               // Name is optional
$mail->addAddress('irangiroltd@gmail.com');     // Add a recipient
$mail->addReplyTo('irangiroltd@gmail.com');  // TCP port to connect to

// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->isHTML(true);                        // Set email format to HTML

$mail->Subject = 'Your account irangiro';

$variables = array (
    "{{name}}" => $firstname." ".$lastname,
    "{{email}}" => $email,
    "{{username}}" =>  $username,
    "{{password}}" => $password,
);

$message = file_get_contents('signup.html', __DIR__);

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