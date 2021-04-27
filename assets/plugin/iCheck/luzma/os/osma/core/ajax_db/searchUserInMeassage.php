<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
    $result= $home->search($search);
    echo '<h4>People</h4>
          <div class="message-recent"> 
          ';
     foreach ($result as $user) {
         if ($user['user_id'] != $user_id) {
            $workname = (strlen($user["workname"]) > 60)? substr($user["workname"],0,60).'..' : $user["workname"];
             # code...
             echo '<div class="people-message p-3 people-messageM" data-user="'.$user['user_id'].'">
                    	<div class="people-inner">
                    		<div class="people-img">
                    			 '.((!empty($user['profile_img']))?'
                                    <a href="#"><img src="'.BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'].'"  class="img"/></a>
                                    ':'
                                    <a href="#"><img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"  class="img" /></a>
                                ').'
                    		</div>
                    		<span class="name-right2">
                                '.$user['username'].((!empty($user['bot']))?'<span><img src="'.BASE_URL_LINK.'image/img/verified-light.png" width="15px"></span>':"").'
                                <div>'.((!empty($workname)?'
                                        <small class="my-0" style="font-size: 12px;">'.$workname.'</small>
                                        ':'
                                        <small class="my-0" style="font-size: 12px;">Member</small>
                                        ')).'</div>
                            </span >
                    	</div>
                     </div> ';
         }
      }
      echo '</div>';
}
?>