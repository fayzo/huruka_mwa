<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['confirm_friendrequest']) && !empty($_POST['confirm_friendrequest'])) {
    $user_id= $_SESSION['key'];
	$home->updateReal("follow",array('status_request' => 1),
	array( 
	'sender' => $_POST['following_id'] ,
	'receiver' => $_POST['user_id']
	));
}

if (isset($_POST['delete_friendrequest']) && !empty($_POST['delete_friendrequest'])) {
    $user_id= $_SESSION['key'];
	$home->delete_("notification",array('type' => 'follow','notification_from' => $_POST['following_id'],'notification_for' => $_POST['user_id']));
	$home->delete_("follow",array('sender' => $_POST['following_id'] ,'receiver' => $_POST['user_id']));
}

if (isset($_POST['deleteMessage']) && !empty($_POST['deleteMessage'])) {
    $user_id= $_SESSION['key'];
	$message_id= $users->test_input($_POST['deleteMessage']);
	$message->deleteMsg($message_id,$user_id);
}
if (isset($_POST['deleteMessageAll']) && !empty($_POST['deleteMessageAll'])) {
	$user_id= $_SESSION['key'];
	$message_from= $users->test_input($_POST['deleteMessageAll']);
	$message_to= $users->test_input($_POST['user_id']);
	$message->deleteMsgAll($message_to,$message_from);
	// echo $_POST['deleteMessageAll'];
	// echo $_POST['user_id'];
}

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
}


if (isset($_POST['showChatMessage']) && !empty($_POST['showChatMessage'])) {
    $user_id= $_SESSION['key'];
    $message_from= $_POST['showChatMessage'];
    $message->getMessage($message_from,$user_id);
}

if (isset($_POST['showMessage']) && !empty($_POST['showMessage'])) {
    $user_id= $_SESSION['key'];
    // $tweet_id= $_POST['showMessage'];
	$Msg= $message->recentMessage($user_id); 
	$notification->messagesView($user_id);
    ?>

    <div class="popup-message-wrap">
        <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
      <div class="wrap2">
        <div class="message-send large-2">
		  <div class="card ">
			<div class="card-body main-active text-center py-0">
				<label class="float-right" for="popup-message-tweet" ><i class="fa fa-times" aria-hidden="true"></i></label>
				<label class="float-left" for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
				<div class="h4 pt-3">New message</div>
			</div>
		  </div>
		  <div class="pl-2">
			    <div class="message-input">
        	    	<h4>Send message to:</h4>
        	      	<input type="text" placeholder="Search people" class="search-user py-4"/>
        	    	<ul class="search-result down">
        	    			
					</ul>
				</div>
				<div class="message-body">
        		<h4>Recent</h4>
				<div class="message-recent">
                <?php foreach ($Msg as $Message ) {?>
        			<!--Direct Messages-->
        			<div class="people-message p-3 people-messageM" data-user="<?php echo $Message['user_id'];?>">
        				<div class="people-inner">
        					<div class="people-img">
								<?php if (!empty($Message['profile_img'])) { ?>
										<img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$Message['profile_img'];?>" class="img" />
								<?php }else {?>
										<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="img" />
								<?php } ?>
        					</div>
        					<div class="name-right2">
        						<span><a href="#"><?php echo $Message['username'];?></a>
								<?php echo $home->bot_light($Message['bot'],$Message['followers']) ;?>
								</span>
								<div><?php echo $Message['message'];?></div>
        					</div>
        					
        					<span> 
        						<?php echo $users->timeAgo($Message['message_on']);?>
        					</span>
        				</div>
        			</div>
        			<!--Direct Messages-->

			   <?php  }?>
			   </div><!-- message-recent END-->
			   </div><!-- message-body END-->
			</div><!-- card-body END-->
				<!-- <div class="border-top-0 bg-white">
        	        	<span class="float-right btn btn-primary m-2"> Next </span>
				</div>card FOOTER END -->
        </div><!-- MESSGAE send ENDS-->
         
         
        	<input id="mass" type="checkbox" checked="unchecked" />
        	<div class="back large-2">
				<div class="card  border-bottom-0">
					<div class="card-body main-active py-2">
					    <span class="float-left ">
							<div class="h4 pt-3"> Direct message </div>
						</span>
        			    <span class="float-right">
        			    	<label for="mass"  class="btn btn-primary  mr-2 py-2 new-message-btn">New messages</label>
        			    	<label for="popup-message-tweet"><i class="fa fa-times" aria-hidden="true"></i></label>
        			    </span>
					</div>
				</div>
				<div>
	              		<div id="responseMess"></div>
						<div class="message-del">
							<div class="message-del-inner">
								<h4>Are you sure you want to delete this message? </h4>
								<div class="message-del-box">
									<span>
										<button class="cancel btn btn-dark btn-sm" value="Cancel">Cancel</button>
									</span>
									<span>	
										<button class="deleteAll btn btn-danger btn-sm" value="Delete">Delete</button>
									</span>
								</div>
							</div>
						</div>	

                        <?php foreach ( $Msg as $Message ) { 
                            ?>   
        			        <!--Direct Messages-->
        			        	<div class="p-3 people-messageM" id="messageID<?php echo $Message['user_id'];?>">
        			        		<div class="people-inner">
        			        			<div class="people-img" style="position:relative;">		
					        				<?php if (!empty($Message['profile_img'])) { ?>
        			        			     <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$Message['profile_img'];?>" class="img" />
					        		        <?php }else {?>
        			        		        	     <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="img"/>
					        		        <?php } ?>

											<?php if ($Message['chat'] == 'on') { ?>
														<img src="<?php echo BASE_URL_LINK ;?>image/color/green.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
											<?php }else {?>
														<img src="<?php echo BASE_URL_LINK ;?>image/color/rose.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
											<?php } ?>
        			        			</div>
        			        			<div class="name-right2 people-message" data-user="<?php echo $Message['user_id'];?>">
        			        				<span><a href="#"><?php echo $Message['username'];?></a>
											<?php echo $home->bot_light($Message['bot'],$Message['followers']) ;?>
											</span>
        			        			</div>
        			        			<div class="msg-box">
        			        			   <?php echo $Message['message'];?>
        			        			</div>
        		        				<span>
        		        				     <?php echo $users->timeAgo($Message['message_on']);?>
        		        				</span>
											<span class="deleteMessage more" data-user="<?php echo $user_id; ?>" data-message="<?php echo $Message["user_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span> 
        		        			</div>
        		        		</div>
        		        		<!--Direct Messages-->
                       <?php  } ?>

					</div><!--card-body-->
        	</div><!--back -->
	  </div>
	   <!-- Wrap 2 -->
    </div>
        <!-- POPUP MESSAGES END HERE -->
<?php }


if (isset($_POST['notificationDrpdown']) && !empty($_POST['notificationDrpdown'])) {
	$user_id= $_SESSION['key'];
	$user= $home->userData($user_id);
	$notif= $notification->notifications($user_id);
	$notificatUnread= $notification->notificationsUnread($user_id);

	// var_dump($notif)
	# code..READ IN NOTIFICATION
	# code...
	foreach ($notificatUnread as $data): 
				$notification->notificationsView($user_id);
			  if ($data['type'] == 'follow'):
    ?>

		<li class="hovernotication" >
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?> <?php echo $data['username']; ?> 
				Followed <i class="fa fa-user-plus text-primary"></i>you on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    
	   endif; 
	  if ($data['type'] == 'mention' && $data['status'] == 0): ?>
		<li class="hovernotication">
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?> <?php echo $data['username']; ?> 
				mention <span  class="text-success">@<?php echo $user['username']; ?> </span> on post on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    endif; 
	  if ($data['type'] == 'retweet' && $data['status'] == 0): ?>
		<li class="hovernotication">
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?>
				<?php echo $data['username']; ?>
				 Shared <i class="fa fa-share-alt-square" aria-hidden="true"></i>your post on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    endif; 
	if ($data['type'] == 'likes' && $data['status'] == 0): ?>
		<li class="hovernotication">
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?>
				<?php echo $data['username']; ?>
				liked <i class="fa fa-heart text-danger"></i>  your post on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    
	        endif; 
			endforeach; 
	
	# code..READ IN NOTIFICATION
	# if notification > 1

	foreach ($notif as $data): 
			    if ($data['type'] == 'follow'):
    ?>

		<li>
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?> <?php echo $data['username']; ?> 
				Followed <i class="fa fa-user-plus text-primary"></i>you on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    
	   endif; 
	  if ($data['type'] == 'mention'): ?>
		<li>
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?> <?php echo $data['username']; ?> 
				mention <span  class="text-success">@<?php echo $user['username']; ?> </span> on post on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    endif; 
	  if ($data['type'] == 'retweet'): ?>
		<li >
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?>
				<?php echo $data['username']; ?>
				 Shared <i class="fa fa-share-alt-square" aria-hidden="true"></i>your post on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    endif; 
	if ($data['type'] == 'likes'): ?>
		<li>
			<a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications">
				<!-- <i class="fa fa-users text-info"></i>  -->
				<?php if (!empty($data['profile_img'])) { ?>
				<img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php  }else{ ?>
				<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  height="25px" width='25px' class=" rounded-circle" alt="User Image">
				<?php } ?>
				<?php echo $data['username']; ?>
				liked <i class="fa fa-heart text-danger"></i>  your post on 
				<?php echo $users->timeAgo($data['time']) ;?>
				<!-- <i class=" fa fa-clock-o"></i>  -->
			</a>
		</li>
	<?php    
			endif; 
			endforeach; 
	?>
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-warning text-warning"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-danger"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-success"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-danger"></i> You changed your username
                    </a>
                  </li> -->

<?php }


if (isset($_POST['showMessage1']) && !empty($_POST['showMessage1'])) {
    $user_id= $_SESSION['key'];
    // $tweet_id= $_POST['showMessage'];
	$Msg= $message->recentMessage($user_id); 
	$MsgUnread= $message->recentMessageUnread($user_id); 
	$notification->messagesView($user_id);
	?>
		<li class="message-del">
			<div class="message-del-inner">
				<h4>Are you sure you want to delete this message? </h4>
				<div class="message-del-box">
					<span>
						<button class="cancel btn btn-dark btn-sm" value="Cancel">Cancel</button>
					</span>
					<span>	
						<button class="deleteAll btn btn-danger btn-sm" value="Delete">Delete</button>
					</span>
				</div>
			</div>
		</li>		
		<!-- MESSAGE UNREAD IN NOTIFICATION -->
		<li id="responseMess"></li>


		 <?php foreach ($MsgUnread as $Message ) {
			 ?>
					<!--Direct Messages-->
				
				<li class="hovernotication people-message" id="messageID<?php echo $Message['user_id'];?>" > <!-- start message -->
                    <a href="#">
                      <div class="pull-left" style="position:relative;">
						  	<?php if (!empty($Message['profile_img'])) { ?>
        						     <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$Message['profile_img'];?>"  class="rounded-circle img"  />
							<?php }else {?>
        						     <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="rounded-circle img" />
							<?php } ?>

							<?php if ($Message['chat'] == 'on') { ?>
									<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-success"></div>
							<?php }else {?>
									<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-danger"></div>
							<?php } ?>
                      </div>
                      <h4>
						<span class="people-message" data-user="<?php echo $Message['user_id'];?>" ><?php echo $Message['username'];?>
						<?php echo $home->bot_light($Message['bot'],$Message['followers']) ;?>
						</span> 
                        <small><i class="fa fa-clock-o"></i> <?php echo $users->timeAgo($Message['message_on']);?></small>
                      </h4>
                      <p><?php echo $Message['message'];?></p>
                    </a>
				</li> <!-- end message -->

		<?php  } ?>

		<!-- MESSAGE READ IN NOTIFICATION -->

         <?php foreach ($Msg as $Message ) {?>
					<!--Direct Messages-->
				
				<!-- <li id="messageID< ?php echo $Message['user_id'];?>" class="people-messageResponsive1" data-user="< ?php echo $Message['user_id'];?>">  -->
				<li id="messageID<?php echo $Message['user_id'];?>" class="people-message" data-user="<?php echo $Message['user_id'];?>"> 
				<!-- start message -->
                    <a href="#">
                      <div class="pull-left" style="position:relative;">
						  	<?php if (!empty($Message['profile_img'])) { ?>
        						     <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$Message['profile_img'];?>"  class="rounded-circle img"  />
							<?php }else {?>
        						     <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="rounded-circle img" />
							<?php } ?>

							<?php if ($Message['chat'] == 'on') { ?>
										<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-success"></div>
							<?php }else {?>
										<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-danger"></div>
							<?php } ?>
                      </div>
                      <h4>
						<span> <?php echo $Message['username'];?> <?php echo (!empty($Message['bot']))?'<span><img src="'.BASE_URL_LINK.'image/img/verified-light.png" width="15px"></span>':"" ;?></span> 
                        <small><span><i class="fa fa-trash" aria-hidden="true"></i></span> <i class="fa fa-clock-o"></i> <?php echo $users->timeAgo($Message['message_on']);?></small>
                        <!-- <small><span class="deleteMessage more" data-user="< ?php echo $_SESSION["key"]; ?>" data-message="< ?php echo $Message["user_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span> <i class="fa fa-clock-o"></i> < ?php echo $users->timeAgo($Message['message_on']);?></small> -->
                      </h4>
                      <p><?php echo $Message['message'];?></p>
                    </a>
				</li> <!-- end message -->
		<?php  } ?>
   					
<?php }

if (isset($_POST['showJobs1']) && !empty($_POST['showJobs1'])) {
    $user_id= $_SESSION['key'];
    // $tweet_id= $_POST['showMessage'];
	$mysqli= $db;
	$query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.turn = 'on' and J. deadline > CURDATE() ORDER BY rand() LIMIT 10");
	?>
          <?php while($jobs= $query->fetch_array()) { ?>
					<!--Direct Messages-->
				
				<li class="jobHovers more" data-job="<?php echo $jobs['job_id'];?>"  data-business="<?php echo $jobs['business_id'];?>"> <!-- start message -->
                    <a href="#">
                      <div class="pull-left" style="position:relative;">
						  	<?php if (!empty($jobs['profile_img'])) { ?>
        						     <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$jobs['profile_img'];?>"  class="rounded-circle img"  />
							<?php }else {?>
        						     <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="rounded-circle img" />
							<?php } ?>
                      </div>
					<h4>
						<span style="font-size:13px"><?php echo $home->htmlspecialcharss($jobs['job_title']);?>
                   		</span>
					</h4>
						<!-- < ?php echo !($jobs['companyname'])? '<p>'.$jobs['companyname'].'<p>' :''; ?> -->
						<p>Publish - <?php echo $home->timeAgo($jobs['created_on']); ?></p>
						<p>Deadline -  <?php echo $home->timeDeadiline($jobs['deadline']).''.$home->dayRemain($jobs['deadline']); ?></p>
                    </a>
				</li> <!-- end message -->

		<?php  } ?>

<?php }

if (isset($_POST['showcoins']) && !empty($_POST['showcoins'])) {
    $user_id= $_SESSION['key'];
    // $tweet_id= $_POST['showMessage'];
	$mysqli= $db;
	$query= $mysqli->query("SELECT * FROM  users U Left JOIN transaction_coins C  ON C. user_id_coins_from = U. user_id WHERE C. user_id_coins_to = $user_id ORDER BY C. coins_id Desc LIMIT 10");
	?>
          <?php while($jobs= $query->fetch_array()) { ?>
					<!--Direct Messages-->
				
				<li class="jobHovers more" data-coins="<?php echo $jobs['coins_id'];?>" > <!-- start message -->
                    <a href="#">
                      <div class="pull-left" style="position:relative;">
						  	<?php if (!empty($jobs['profile_img'])) { ?>
        						     <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$jobs['profile_img'];?>"  class="rounded-circle img"  />
							<?php }else {?>
        						     <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="rounded-circle img" />
							<?php } ?>
                      </div>
						<!-- < ?php echo !($jobs['companyname'])? '<p>'.$jobs['companyname'].'<p>' :''; ?> -->
						<p><i class="fas fa-coins"></i> <?php echo number_format($jobs['amount_coins']); ?> coins</p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i> sent on - <?php echo $home->timeAgo($jobs['datetime']); ?></p>
                    </a>
				</li> <!-- end message -->

		<?php  } ?>

<?php }

if (isset($_POST['showFriendRequest']) && !empty($_POST['showFriendRequest'])) {
	
	$user_id= $_SESSION['key'];
    // $tweet_id= $_POST['showMessage'];
	$mysqli= $db;
	$query= $mysqli->query("SELECT * FROM  users U Left JOIN  follow F ON F. sender = U. user_id WHERE F. receiver = $user_id and F. status_request = 0  ORDER BY rand() ");
	?>
          <?php while($whoTofollow = $query->fetch_array()) {  
			  $workname = (strlen($whoTofollow["workname"]) > 50)? substr($whoTofollow["workname"],0,50).'..' : $whoTofollow["workname"];

echo '      <li class="jobHovers more friendrequest_id'.$whoTofollow['sender'].'">
				<div class="whoTofollow-list-img">
						'.((!empty($whoTofollow['profile_img'])?'
						<img src="'.BASE_URL_LINK."image/users_profile_cover/".$whoTofollow['profile_img'].'">
						':'
						<img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'">
					')).'

					'.$follow->lengthsOfWhoNewCome($whoTofollow['date_registry']).'
				</div>
				<ul class="whoTofollow-list-info">
					<li><a href="'.BASE_URL_PUBLIC.$whoTofollow['username'].'" id="'.$whoTofollow["user_id"].'" >'.$whoTofollow['username'].'
					'.($home->bot_light($whoTofollow['bot'],$whoTofollow['followers'])).'
					</a>
					</li>
					<li>'.((!empty($workname)?'
					<small class="my-0" style="font-size: 12px;">'.$workname.'</small>
					':'
					<small class="my-0" style="font-size: 12px;">Member</small>
					')).'</li>
				</ul>
				<div class="whoTofollow-btn">
					  <div class="my-0 ml-2">'.$follow->FriendRequestBtns($whoTofollow['user_id'],$user_id,$user_id).'</div>
					<!-- <a href="#" type="button" class="btn main-active btn-sm">Follow</a> -->
				</div>
			</li> ';
				// '.((!empty($whoTofollow['bot']) && $whoTofollow['bot'] == 'bot')?'<span><img src="'.BASE_URL_LINK.'image/img/verified-light.png" width="15px"></span>':"").'
				
		} ?>

<?php }


if (isset($_POST['showChatPopup']) && !empty($_POST['showChatPopup'])) {
    $user_id= $_SESSION['key'];
    $message_from= $_POST['showChatPopup'];
    $Msg= $message->recentMessage($user_id); 
    $user= $home->userData($message_from);
    ?>
    
    <!-- MESSAGE CHAT START -->
    <div class="popup-message-body-wrap">
    <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
    <input id="message-body" type="checkbox" checked="unchecked"/>
    <div class="wrap3">
    <div class="message-send2">
	            <div class="card" >
				<div class="card-body main-active message-header2">
    		            <label class="back-messages float-left" for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
    		            <label class="close-msgPopup float-right" for="message-body" ><i class="fa fa-times" aria-hidden="true"></i></label> 
						<div class="float-center">
    		            	<div class="message-head-img">
							<?php if (!empty($user['profile_img'])) { ?>
								<div style="position:relative;float: left;">		
    		            	       <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'];?>" class="img" />
									<?php if ($user['chat'] == 'on') { ?>
											<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-success"></div>
									<?php }else {?>
											<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-danger"></div>
									<?php } ?>
								</div>
								 <div class="d-inline-block pt-1 pl-3">
								   <div>
                                    <?php echo $user['username']; ?>
									<?php echo $home->bot_dark($user['bot'],$user['followers']) ;?>
									<?php echo ($user['chat'] == 'on')?' online':' offline '.$home->timeAgo($user['last_login']);?>
                                    <!-- < ?php echo $user['username'].(($user['chat'] == 'on')?' <img src="'.BASE_URL_LINK.'image/color/green.png" class="img-rounded" width="9px"> online':' <img src="'.BASE_URL_LINK.'image/color/rose.png" class="img-rounded" width="9px"> offline '.$home->timeAgo($user['last_login'])) ;?> -->
								   </div>
								   <div><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Messages</div>
								 </div>
							<?php }else { ?>
								<div  style="position:relative;float: left;">		

									<img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="img" />
									<?php if ($user['chat'] == 'on') { ?>
												<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-success"></div>
									<?php }else {?>
												<div style="position:absolute;bottom:0px;right: 10px;width:15px;padding: 7px;" class="rounded-circle bg-danger"></div>
									<?php } ?>
								</div>
								 <div class="d-inline-block pt-1 pl-3">
								   <!-- <div>< ?php echo $user['username']; ?></div> -->
								   <div>
                                    <?php echo $user['username'].(($user['chat'] == 'on')?' online':' offline '.$home->timeAgo($user['last_login'])) ;?>
                                    <!-- < ?php echo $user['username'].(($user['chat'] == 'on')?' <img src="'.BASE_URL_LINK.'image/color/green.png" class="img-rounded" width="9px"> online':' <img src="'.BASE_URL_LINK.'image/color/rose.png" class="img-rounded" width="9px"> offline '.$home->timeAgo($user['last_login'])) ;?> -->
								   </div>
								   <div><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Messages</div>
								 </div>
			            	<?php } ?>
    		            	</div>
			            </div>
			
    		            <div class="message-del">
    		            	<div class="message-del-inner">
    		            		<h4>Are you sure you want to delete this message? </h4>
    		            		<div class="message-del-box">
    		            			<span>
    		            				<button class="cancel btn btn-dark btn-sm" value="Cancel">Cancel</button>
    		            			</span>
    		            			<span>	
    		            				<button class="delete btn btn-danger btn-sm" value="Delete">Delete</button>
    		            			</span>
    		            		</div>
    		            	</div>
			            </div>

				</div><!--card-header ENDS-->
				</div><!--card ENDS-->
				  <div class="main-msg-wrap large-2">
                     <div id="chat" class="main-msg-inner">
                    
     	             </div>
     	          </div>
				<!-- <div class="card-footer"> -->
				  <div class="main-msg-footer bottom-0">
					<form method="post" id="messageForm" enctype="multipart/form-data">

    		       	  <div class="main-msg-footer-inner">
						<span id="User_response-posts"></span>
						<ul>
							<li><textarea id="msg" name="msg" placeholder="Write some thing!"></textarea></li>
							<li><input name="files[]" id="msg-upload" type="file" value="upload" onChange="displayImageNameSizecv(this)" multiple/><label for="msg-upload"><i class="fa fa-camera" aria-hidden="true"></i></label></li>
							<li><input name="get_idd" data-user="<?php echo  $message_from ;?>" value="<?php echo  $message_from ;?>" type="hidden"/> </li>
							<li><input id="send" data-user="<?php echo  $message_from ;?>" type="submit" value="Send"/> </li>
						</ul>
						<div>
							<!--  progress-xs -->
							<div id="add-photo00" class="row">
							</div>
							<span class="progress progress-hide" style="display: none;">
							<span class="progress-bar bg-danger" role="progressbar" style="width:0%;" id="pro"
								aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
								<span> completed <span class="fa fa-check"></span></span></span>
							</span>
						</div>

					</form>
				   </div><!--main-msg-footer-inner-->
				  </div><!--main-msg-footer-->
				<!--card-footer ENDS-->

    </div> <!--MASSGAE send ENDS-->
    </div> <!--wrap 3 end-->
    </div><!--POP UP message WRAP END-->
    
    <!-- message Chat popup end -->
<?php }
  ?>