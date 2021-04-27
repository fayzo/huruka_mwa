<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['newslatter_email_client']) && !empty($_POST['newslatter_email_client'])) {
    $email = $users->test_input($_POST['newslatter_email_client']);

    require '../../newsletters_thank_.php';
    $datetime= date('Y-m-d H-i-s');

	$users->Postsjobscreates('client_subscribe_email',array( 
	'email_subscribe'=> $email, 
    'datetime'=> $datetime 
        ));
} ?>

