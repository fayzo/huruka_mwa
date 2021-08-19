<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['sendMessage']) && !empty($_POST['sendMessage'])) {
    $user_id= $_SESSION['key'];
	$message= $users->test_input($_POST['sendMessage']);
	$get_id=$_POST['get_idd'];
	if (!empty($message)) {
		# code...
		$home->creates('message',array('message_to' => $get_id,'message_from' => $user_id,'message' => $message,'message_on' => date('Y-m-d H:i:s')));
    }
}

if (isset($_POST['showChatMessage']) && !empty($_POST['showChatMessage'])) {
    $user_id= $_SESSION['key'];
    $message_from= $_POST['showChatMessage'];
	$message->getChatMessage($message_from,$user_id); 
}

if (isset($_POST['showChat0']) && !empty($_POST['showChat0'])) {
    $user_id= $_SESSION['key'];
    $message_from= $_POST['showChat0'];
    $user= $home->userData($message_from);
    $notific= $notification->getNotificationCount($user_id);

    ?>
     <!-- DIRECT CHAT PRIMARY -->

<div class="MessageResponsive">

<div class="wrap6"  id="disabler">
    <div class="wrap6Pophide" onclick="togglePopup( )"></div>
    <span class="colose">
        <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
    </span>
    <div class="img-popup-wrap" id="popupEnd">
    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

   <div class="row">
       <div class="col-md-12">
           <div class="card direct-chats direct-chat direct-chat-primary" style="position:relative;left:0px">
               <div class="card-header main-active py-2">
                   <h5 class="card-title pb-0"><i> Message Chat</i></h5>

                   <div class="card-tools">
                       <span id="tooltipsmessages1" data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"><?php if( $notific['totalmessage'] > 0){echo '<span>'.$notific['totalmessage'].'</span>'; } ?></span>
                       <button type="button" class="btn btn-tool btn-sm collapse-minus" data-toggle="collapse"
                           data-target="#collapseExample4">
                           <i class="fa fa-minus"></i>
                       </button>
                       <button type="button" class="btn btn-tool btn-sm" data-toggle="tooltip" id="direct-chat-contacts-view-responsive" title="Contacts"
                           data-widget="chat-pane-toggle">
                           <i class="fa fa-comments"></i>
                       </button>
                        <button type="button" class="btn btn-box-tool close-chat" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                       </button>
                   </div>
               </div>
               <!-- /.card-header -->
               <div class="collapse show" id="collapseExample4">

                <div class="card-body" id="black" style="background:#222d32">
                <div class="bg-dark pl-2" style="width:280px;position:fixed;z-index:1;color: #999;"><?php echo $user['username'].(($user['chat'] == 'on')?' <img src="'.BASE_URL_LINK.'image/color/green.png" class="img-rounded" width="9px"> online':' <img src="'.BASE_URL_LINK.'image/color/rose.png" class="img-rounded" width="9px"> offline '.$home->timeAgo($user['last_login'])) ;?></div>

                    <span id="message-del"></span>
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages  large-2" id="messages0" style="padding-top:20px;">
                        <!-- Message. Default to the left -->
                        <div id="chats"> </div>
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts  large-2" id="contacts0" style="z-index: 3;">
                    </div> 
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer main-active">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" id="msg0" name="msg" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-append">
                            <button type="button" id="send0" data-user="<?php echo  $message_from ;?>"  class="btn btn-primary btn-flat">Send</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /.box-footer-->

                </div>
               <!-- collapse -->
           </div>
           <!-- /.direct-chat -->
       </div>
       <!-- /.col -->
   </div>
   <!-- /.row -->

        </div><!-- img-popup-wrap -->
       </div> <!-- wrap6 -->
       </div> <!-- MessageResponsive -->
   <!-- END DIRECT CHAT PRIMARY -->
<?php } 

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
    $result= $home->search($search);
     echo '<h4 style="padding: 0px 10px;">People</h4>
          <div class="message-recent"> 
           <ul class="contacts-list" > ';

     foreach ($result as $user) {
         if ($user['user_id'] != $user_id) { ?>
              <li class="people-message3 people-message1 more" data-user="<?php echo $user['user_id'];?>" >
                        <div class="contacts-list-box">
                            <?php if (!empty($user['profile_img'])) { ?>
                                    <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'];?>" class="contacts-list-img" />
                            <?php }else {?>
        						     <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="contacts-list-img" />
                            <?php } ?>

                            <?php if ($user['chat'] == 'on') { ?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/color/green.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
                            <?php }else {?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/color/rose.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
                            <?php } ?>
                        </div>
                         <div class="contacts-list-info">
                             <span class="contacts-list-name">
                                 <?php echo $user['username'];?>
                             </span>
                         </div>
                         <!-- /.contacts-list-info -->
                 </li>
                 <!-- End Contact Item -->
        <?php } 
      }
      echo ' </ul>
      </div>';
}

if (isset($_POST['showListMessage0']) && !empty($_POST['showListMessage0'])) {
    $user_id= $_SESSION['key'];
    // $tweet_id= $_POST['showMessage'];
	$Msg= $message->recentMessage($user_id); 
	$notification->messagesView($user_id);
    ?>
      <div id="black" class="card-body" style="background:#222d32">
        <span id="message-del"></span>
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages large-2" id="messages0" >
            <span id="responseMess"></span>

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

          <ul class="contacts-list" >

         <?php foreach ($Msg as $Message ) {?>
                    <!--Direct Messages-->
                  <li class="people-message3 more" id="messageID<?php echo $Message['user_id'];?>">
                        <div style="position:absolute;">
                            <?php if (!empty($Message['profile_img'])) { ?>
                                    <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$Message['profile_img'];?>"  class="contacts-list-img" />
                            <?php }else {?>
                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="contacts-list-img" />
                            <?php } ?>
                                    
                            <?php if ($Message['chat'] == 'on') { ?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/color/green.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
                            <?php }else {?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/color/rose.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
                            <?php } ?>
                        </div>
                         <div class="contacts-list-info">
                             <span class="contacts-list-name">
                                  <span class="people-message1" data-user="<?php echo $Message['user_id'];?>" > <?php echo $Message['username'];?> </span>
                                 <small class="contacts-list-date float-right" ><span class="deleteMessage more" data-user="<?php echo $_SESSION["key"]; ?>" data-message="<?php echo $Message["user_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span> <i class="fa fa-clock-o"></i> <?php echo $users->timeAgo($Message['message_on']);?></small>
                             </span>
                             <span class="contacts-list-msg"><?php echo $Message['message'];?></span>
                         </div>
                         <!-- /.contacts-list-info -->
                 </li>
                 <!-- End Contact Item -->

        <?php  }?>
             </ul >
         </div><!--/.direct-chat-messages-->
          <!-- Contacts are loaded here -->
          <div class="direct-chat-contacts large-2" id="contacts0">
          </div><!-- /.direct-chat-pane -->
        </div> <!-- /.card-body -->
<?php }


if (isset($_POST['showListMessage']) && !empty($_POST['showListMessage'])) {
    $user_id= $_SESSION['key'];
    // $tweet_id= $_POST['showMessage'];
	$Msg= $message->recentMessage($user_id); 
	$notification->messagesView($user_id);
    ?>
        <div style="padding: 10px 10px;">
        	<h4>Send message to:</h4>
          	<input type="text" placeholder="Search people" class="form-control search-user0 py-4"/>
		</div>
		<div class="message-body">
        	<h4  style="padding: 0px 10px;">Recent</h4>
				<div class="message-recent">
                 <ul class="contacts-list" >

         <?php foreach ($Msg as $Message ) {?>
                    <!--Direct Messages-->
                  <li class="people-message3 people-message1 more" data-user="<?php echo $Message['user_id'];?>">
                        <div style="position:absolute;border-radius:50%;">
                            <?php if (!empty($Message['profile_img'])) { ?>
        						     <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$Message['profile_img'];?>"  class="contacts-list-img" />
                            <?php }else {?>
                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"  class="contacts-list-img" />
                            <?php } ?>

                            <?php if ($Message['chat'] == 'on') { ?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/color/green.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
                            <?php }else {?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/color/rose.png" width="15px" style="position:absolute;bottom:0px;right:0px;">
                            <?php } ?>
                        </div>
                         <div class="contacts-list-info">
                             <span class="contacts-list-name">
                                 <?php echo $Message['username'];?>
                                 <small class="contacts-list-date float-right"><i class="fa fa-clock-o"></i> <?php echo $users->timeAgo($Message['message_on']);?></small>
                             </span>
                             <span class="contacts-list-msg"><?php echo $Message['message'];?></span>
                         </div>
                         <!-- /.contacts-list-info -->
                 </li>
                 <!-- End Contact Item -->

        <?php  } ?>
                </ul >
             </div><!-- message-recent END-->
		</div><!-- message-body END-->
<?php }

if (isset($_POST['deleteMessage']) && !empty($_POST['deleteMessage'])) {
    $user_id= $_SESSION['key'];
	$message_id= $users->test_input($_POST['deleteMessage']);
	$message->deleteMsg($message_id,$user_id);
}

if (isset($_POST['DeleteChatpopup']) && !empty($_POST['DeleteChatpopup'])) {
    $user_id= $_SESSION['key'];
    $message_from= $_POST['DeleteChatpopup'];
    ?>
    <div class="alert alert-success alert-dismissible fade show text-center" style="margin-top: 20px;">
         <button class="close" data-dismiss="alert" type="button">
             <span>&times;</span>
         </button>

          	<div class="message-delt">
          		<strong>Are you sure you want to delete this message? </strong>
          		<div class="float-right">
          				<button class="cancel btn btn-dark btn-sm" value="Cancel">Cancel</button>
          				<button class="delete btn btn-danger btn-sm" value="Delete">Delete</button>
          		</div>
          	</div>
    </div>
<?php } ?>