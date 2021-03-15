<?php 
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();        // Set mailer to use SMTP IF UR USING IN LOCOHOST TURN IT ON IF UR USING TURN OFF
// $mail->SMTPDebug = 3;                               // Enable verbose debug output
// $mail->Debugoutput = 'html';
// $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
// $mail->SMTPOptions = array(
//     'ssl' => array(
//     'verify_peer' => false,
//     'verify_peer_name' => false,
//     'allow_self_signed' => true
//     )
//     );
// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'irangiroltd@gmail.com';                 // SMTP username
// $mail->Password = $mail->passme();                         // SMTP password
// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 587;                                    // TCP port to connect to
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
$mail->Password = '';                         // SMTP passwordrwanda1234@sds
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('admin@iragiro.com', 'Irangiro Network');
$mail->addAddress($email);               // Name is optional
$mail->addAddress('irangiroltd@gmail.com');     // Add a recipient
$mail->addReplyTo('irangiroltd@gmail.com');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Thank you for the subscription';
// $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$variables = array (
    "{{email}}" => $email,
);
$message = file_get_contents('newsletters_thank_subscribe.html', __DIR__);

foreach ($variables as $key => $value) {
    # code...
    $message = str_replace($key,$value,$message);
}

$mail->msgHTML($message);

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>