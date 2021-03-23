<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['sendMessage']) && !empty($_POST['sendMessage'])) {
    $user_id= $_SESSION['key'];
	$message= $users->test_input($_POST['sendMessage']);
	$get_id=$_POST['get_idd'];

	if (!empty($message)) {
		# code...
		$home->creates('message',array(
			'message_to' => $get_id,
			'message_from' => $user_id,
			'message' => $message,
			'message_on' => date('Y-m-d H:i:s')
		));
		
	}

}else{
    $user_id= $_SESSION['key'];
	$get_id=$_POST['get_idd'];
	$message= $users->test_input($_POST['msg']);
    
    // var_dump($_FILES,$_POST);

    $files= $_FILES['files'];

    if (!empty(array_filter($files))) {

        if (!empty($files['name'][0])) {
            # code...
            $tweetimages = $home->uploadPostusermessageImage($files);
            $tweetSize = $home->uploadSize($files);
        }
        
        $home->creates('message',array(
            'message_to' => $get_id,
            'message_from' => $user_id,
            'message' => $message,
            'file_image' => $tweetimages, 
            'file_size' => $tweetSize, 
            'message_on' => date('Y-m-d H:i:s')
        ));

    }
}

?>