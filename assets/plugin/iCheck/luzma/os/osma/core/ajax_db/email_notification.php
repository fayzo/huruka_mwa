<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['email_notificationDrpdown']) && !empty($_POST['email_notificationDrpdown'])) {
    $email= $_SESSION['email'];
    // $tweet_id= $_POST['showMessage'];
	$Msg= $email_notification->recentEmail($email); 
	$MsgUnread= $email_notification->recentEmailUnread($email); 
	$email_notification->emailView($email);
	?>
		<!-- email UNREAD IN NOTIFICATION -->
		<li id="responseMess"></li>

		 <?php foreach ($MsgUnread as $Message ) {
			   $message = htmlspecialchars_decode($Message['addition_information']);

			   if(strlen($message) > 10) {
			   $message = substr($message,0,10).' read more ...';
			   }else{
			   $message;
			   }
			 ?>
					<!--Direct Messages-->
				
				<li class="hovernotication inbox-view more" <?php echo ' data-cv_id="'.$Message['cv_id'].'" '; ?> id="messageID<?php echo $Message['cv_id'];?>" > <!-- start message -->
                    <a href="#">
                      <div class="pull-left" style="position:relative;">
							<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="rounded-circle img" />
                      </div>
                      <h4>
						<span><?php echo $Message['email_sent_from'];?></span> 
                        <small style="margin-top: -9px;"><i class="fa fa-clock-o "></i> <?php echo $users->timeAgo($Message['created_on0']);?></small>
                      </h4>
                      <p><?php echo $message;?></p>
                    </a>
				</li> <!-- end message -->

		<?php  } ?>

		<!-- MESSAGE READ IN NOTIFICATION -->

         <?php foreach ($Msg as $Message ) {
					// <!--Direct Messages-->
				    $message = htmlspecialchars_decode($Message['addition_information']);

                    if(strlen($message) > 10) {
                    $message = substr($message,0,10).' read more ...';
                    }else{
                    $message;
                    }
				?>

				<li id="messageID<?php echo $Message['cv_id'];?>" class="inbox-view more" <?php echo ' data-cv_id="'.$Message['cv_id'].'" '; ?>  > <!-- start message -->
                    <a href="#">
                      <div class="pull-left" style="position:relative;">
							<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="rounded-circle img" />
                      </div>
                      <h4>
						<span> <?php echo $Message['email_sent_from'];?> </span>
                        <small style="margin-top: -9px;"><i class="fa fa-clock-o "></i> <?php echo $users->timeAgo($Message['created_on0']);?></small>
                        <!-- <small><span class="deleteMessage more" data-user="< ?php echo $_SESSION["key"]; ?>" data-message="< ?php echo $Message["user_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span> <i class="fa fa-clock-o"></i> < ?php echo $users->timeAgo($Message['message_on']);?></small> -->
                      </h4>
                      <p><?php echo $message ;?></p>
                    </a>
				</li> <!-- end message -->
		<?php  } ?>
   					
<?php }

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
	$result= $home->search_email_composer($search);
	// echo '<pre>';
	// var_dump($result);
	// echo '<pre>';

	 foreach ($result as $user) {
         if ($user['user_id'] != $user_id) {
			 # code...
			$jsonArrays = array(
        		'email' => array(
						$user['email' ] => $user['email'],
				),
        		'form' => ' <input  type="hidden" id="email-send-to" class="email-send-to" name="email-send-to" value="'.$user['user_id'].'">' ,
			);
           exit(json_encode($jsonArrays));
			// $count= count($search);
			// $strpos_countsTo = strpos($user['email'], $search);
			// $path_replace= substr_replace($email,'', 0,$search);
			// echo $search.$path_replace; 
		} 
	}
	
    // echo '<div id="black" class="nav-right-down-wrap main-active">
	// 		 <ul '.((count($result) > 6 )?'class="large-2" style="height:400px;"':'').' > ';
			 
	// foreach ($result as $user) {
    //      if ($user['user_id'] != $user_id) {
	// 		 # code...
	// 		echo ' <li>
  	//             	<div class="nav-right-down-inner">
	// 					 '.$user['email'].'
	// 				</div> 
	//            	  </li> ';
	// 	} 
	// }

	// echo 	'</ul>
	// 	 </div> ';
		 
}

if (isset($_POST['key']) == 'textarea'){

	$user_id= $_POST['user_id'];
    $datetime= date('Y-m-d H-i-s');

    $emailcomposer = $users->test_input($_POST['emailcomposer']);
    $subjectcomposer = $users->test_input($_POST['subjectcomposer']);
    $textcomposer =  $users->test_input($_POST['textcomposer']);
	$photo_="";

	if (!empty($emailcomposer) ) {

		if (strlen($textcomposer ) > 1000000) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

		$email= $_SESSION['email'];
		require '../../job_message_email_thank.php';

		$type_of_email = array('inbox','sent'); 
		$cv_id_radom = rand(10,1000); 

		for ($i=0; $i < count($type_of_email); ++$i) { 

			$result= $users->creates('email_apply_job',array( 
			'cv_id_radom'=> $cv_id_radom, 
			'email_sent_to'=> $emailcomposer,
			'email_sent_from'=> $_SESSION['email'],
			'email_sent_from_id'=>  $user_id,
			'subject_composer'=> $subjectcomposer,
			'addition_information'=> $textcomposer,
			'uploadfilecv'=> 'no file', 
			'user_id0'=> $user_id,
			'business_id0'=> $user_id,
			'type_of_email'=> $type_of_email[$i],
			'created_on0'=> $datetime ));
		}

		if($result){

			exit('<div class="alert alert-success alert-dismissible fade show text-center">
				<button class="close" data-dismiss="alert" type="button">
					<span>&times;</span>
				</button>
				<strong>SUCCESS</strong> </div>');
		}else{
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
				<button class="close" data-dismiss="alert" type="button">
					<span>&times;</span>
				</button>
				<strong>Fail input try again !!!</strong>
			</div>');
		}

    }

}else if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id= $_POST['user_id'];
    $datetime= date('Y-m-d H-i-s');

	$photo= $_FILES['file'];

    $emailcomposer = $users->test_input($_POST['emailcomposer']);
    $subjectcomposer = $users->test_input($_POST['subjectcomposer']);
    $textcomposer =  $users->test_input($_POST['textcomposer']);

	if (!empty($emailcomposer) || !empty(array_filter($photo['name'])) ) {
		if (!empty($photo['name'][0])) {
			# code...
			$email= $_SESSION['email'];
			require '../../job_message_email_thank.php';

			$photo_ = $home->uploadComposerFile($photo);
			$cv_file_size= $home->uploadSize($photo);

		}

		if (strlen($textcomposer ) > 1000000) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

		$type_of_email = array('inbox','sent'); 
		$cv_id_radom = rand(10,1000); 

		for ($i=0; $i < count($type_of_email); ++$i) { 

			$result= $users->creates('email_apply_job',array( 
			'cv_id_radom'=> $cv_id_radom, 
			'email_sent_to'=> $emailcomposer,
			'email_sent_from'=> $_SESSION['email'],
			'email_sent_from_id'=>  $user_id,
			'subject_composer'=> $subjectcomposer,
			'addition_information'=> $textcomposer,
			'uploadfilecv'=> $photo_, 
			'cv_file_size'=> $cv_file_size, 
			'user_id0'=> $user_id,
			'business_id0'=> $user_id,
			'type_of_email'=> $type_of_email[$i],
			'created_on0'=> $datetime ));
		}

		if($result){

			exit('<div class="alert alert-success alert-dismissible fade show text-center">
				<button class="close" data-dismiss="alert" type="button">
					<span>&times;</span>
				</button>
				<strong>SUCCESS</strong> </div>');
		}else{
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
				<button class="close" data-dismiss="alert" type="button">
					<span>&times;</span>
				</button>
				<strong>Fail input try again !!!</strong>
			</div>');
		}
    }
} 

?> 
