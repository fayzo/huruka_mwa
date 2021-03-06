<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Follow extends Home
{
    public function checkfollow($follow_id,$user_id)
    {
       $mysqli= $this->database;
       $query= "SELECT * FROM follow WHERE sender = $user_id AND receiver = $follow_id";
       $result=$mysqli->query($query);
       while ($follow= $result->fetch_array()) {
           # code...
           return $follow;
       }
    }

    static public function checkfollows($follow_id,$user_id)
    {
       $mysqli= self::$databases;
       $query= "SELECT * FROM follow WHERE sender = $user_id AND receiver = $follow_id";
       $result=$mysqli->query($query);
       while ($follow= $result->fetch_array()) {
           # code...
           return $follow;
       }
    }

      public function followBtn($profile_id,$user_id,$follow_id)
    {
       $data= $this->checkfollow($profile_id,$user_id);

       if ($this->loggedin() == true) {
           # code...
           if ($profile_id != $user_id) {
               # code...
               if ($data['receiver'] == $profile_id) {
                   # code...followin Btn
                   return '
                   <button type="button" class="btn btn-primary btn-sm following-btn follow-btn" data-follow="'.$profile_id.'" data-profile="'.$follow_id.'" >Following</button>
                   ';
               }else {
                   # code...follow btn
                    return '
                   <button type="button" class="btn btn-secondary btn-sm follow-btn" data-follow="'.$profile_id.'" data-profile="'.$follow_id.'" ><span  class="fa fa-user-plus"></span> Follow</button>
                   ';
               }
           }else {
               # code...
               return ' 
                <button type="button" class="btn btn-primary btn-sm" onclick=location.href="'.BASE_URL_PUBLIC.'profileEdit.php" >Edit Profile</i></button>
                ';
           }

       }else {
           # code...
          return ' 
           <button type="button" class="btn btn-primary btn-sm main-active " onclick=location.href="'.LOGIN.'" ><i class="fa fa-user-plus main-active"></i> Follow</button>
           ';
       }

    }

    static public function followBtns($profile_id,$user_id,$follow_id)
    {
       $data= self::checkfollows($profile_id,$user_id);

       if (self::loggedins() == true) {
           # code...
           if ($profile_id != $user_id) {
               # code...
               if ($data['receiver'] == $profile_id) {
                   # code...followin Btn
                   return '
                   <button type="button" class="btn btn-primary btn-sm following-btn follow-btn" data-follow="'.$profile_id.'" data-profile="'.$follow_id.'" >Following</button>
                   ';
               }else {
                   # code...follow btn
                    return '
                   <button type="button" class="btn btn-secondary btn-sm follow-btn" data-follow="'.$profile_id.'" data-profile="'.$follow_id.'" ><span  class="fa fa-user-plus"></span> Follow</button>
                   ';
               }
           }else {
               # code...
               return ' 
                <button type="button" class="btn btn-primary btn-sm" onclick=location.href="'.BASE_URL_PUBLIC.'profileEdit.php" >Edit Profile</i></button>
                ';
           }

       }else {
           # code...
          return ' 
           <button type="button" class="btn btn-primary btn-sm main-active " onclick=location.href="'.LOGIN.'" ><i class="fa fa-user-plus main-active"></i> Follow</button>
           ';
       }

    }
    
    public function FriendRequestBtns($profile_id,$user_id,$follow_id)
    {
        return '
        <button type="button" class="btn btn-primary confirm_friendrequest btn-sm float-left mr-2" data-follow="'.$profile_id.'" data-profile="'.$follow_id.'" >Confirm</button>
        <button type="button" class="btn btn-secondary delete_friendrequest btn-sm" data-follow="'.$profile_id.'" data-profile="'.$follow_id.'" > Delete</button>
        ';
    }

     public function follows($follow_id,$user_id,$profile_id)
    {
       $mysqli= $this->database;
       $this->addFollowCounts($follow_id,$user_id);
       $this->creates("follow",array('sender' => $user_id ,'receiver' => $follow_id,'follow_on' => date('Y-m-d H:i:s') , 'status_request' => 0 ));
    //    $query="SELECT * FROM users WHERE user_id= $follow_id LEFT JOIN follow ON sender= $user_id AND CASE WHEN receiver= $user_id THEN sender= user_id END WHERE user_id=$profile_id ";
       $query="SELECT * FROM users WHERE user_id= $follow_id";
       $result= $mysqli->query($query);
       $row= $result->fetch_assoc();
       echo json_encode($row);
       Notification::SendNotifications($follow_id,$user_id,$follow_id,'follow');

    }

    public function unfollow($follow_id,$user_id,$profile_id)
    {
       $mysqli= $this->database;
          // $query="SELECT * FROM users WHERE user_id= $follow_id LEFT JOIN follow ON sender= $user_id AND CASE WHEN receiver= $user_id THEN sender= user_id END WHERE user_id=$profile_id ";
       $query="SELECT * FROM users WHERE user_id= $follow_id";
       $result= $mysqli->query($query);
       $row = $result->fetch_assoc();
       
       $this->removeFollowCounts($follow_id,$user_id);
       $this->delete_("notification",array('type' => 'follow','notification_from' => $user_id ,'notification_for' => $follow_id ));
       $this->delete_("follow",array('sender' => $user_id ,'receiver' => $follow_id));

       echo json_encode($row);
    }

    public function addFollowCounts($follow_id,$user_id)  
    {
        $mysqli= $this->database;
        $query="UPDATE users SET following = CASE user_id 
                                             WHEN $user_id THEN following +1 
                                             ELSE following 
                                           END, 
                                followers = CASE user_id 
                                            WHEN $follow_id THEN followers +1
                                            ELSE followers 
                                          END
                WHERE user_id IN ($user_id, $follow_id)";
                
       $mysqli->query($query);
    }

     public function removeFollowCounts($follow_id,$user_id)
    {
        $mysqli= $this->database;
        $query="UPDATE users SET following = CASE user_id 
                                             WHEN $user_id THEN following -1 
                                             ELSE following 
                                           END, 
                                followers = CASE user_id 
                                            WHEN $follow_id THEN followers -1
                                            ELSE followers 
                                          END
                WHERE user_id IN ($user_id, $follow_id)";
        $mysqli->query($query);
    }

    public function FollowingLists($profile_id,$user_id,$follow_id)
    {
       $mysqli= $this->database;
       $query= "SELECT * FROM users LEFT JOIN follow ON receiver= user_id AND CASE WHEN sender = $profile_id THEN receiver = user_id END WHERE sender IS NOT NULL";
       $result=$mysqli->query($query);

       if ($result->num_rows > 0) { 

       while ($following=$result->fetch_array()) {
            $workname = (strlen($following["workname"]) > 18)? substr($following["workname"],0,18).'..' : $following["workname"];

           # code...
           echo '
                <div class="col-md-4 mb-3">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-follow user-follow">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                         '.((!empty($following['cover_img']))?
                           '<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK."image/users_cover_profile/".$following['cover_img'].') center center;background-size: cover; overflow: hidden; width: 100%;">'
                          :'<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK.NO_COVER_IMAGE_URL.') center center;background-size: cover; overflow: hidden; width: 100%;">' ).'
                        </div>
                        <div class="user-image-follow">
                          '.((!empty($following['profile_img']))?
                               ' <img class="rounded-circle elevation-2"
                                    src="'.BASE_URL_LINK."image/users_profile_cover/".$following['profile_img'].'">'
                              :' <img class="rounded-circle elevation-2" src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'" />' ).'
                             <span> '.$this->lengthsOfusers($following['date_registry']).'</span>
                        </div>
                        <div class="card-footer">
                            <h5 class="user-username-follow m-1 "><a href="'.BASE_URL_PUBLIC.$following['username'].'">'.$following['username'].'</a></h5>
                            <h5 class="user-username-follow m-1"><small>'.((!empty($workname))? $workname:'Member').'</small></h5>
                            <span>'.$this->followBtn($following['user_id'],$user_id,$profile_id,$follow_id).'</span>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /. card widget-user -->
                </div>
                <!-- col --> ';
       }

    }else { ?>
        <div class="card borders-tops mb-3"> 
            <div class="card-body message-color">

            <div class="post">
                <div class="user-block">
                    <div class="user-blockImgBorder">
                   <div class="user-blockImg">
                        <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/irangiro.png" ;?>" alt="User Image">
                   </div>
                   </div>
                    <span class="username">
                        <a href="<?php echo PROFILE ;?>">Irangiro</a><?php echo self::followBtns(1,$user_id,1); ?>
                    </span>
                    <span class="description">Public Figure | Content Creator</span>
                </div>
                <!-- /.user-block -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <img class="img-fluid"
                                    src="<?php echo BASE_URL_LINK."image/users_cover_profile/coming-soon.png" ;?>" alt="Photo">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
           </div>
           <!-- /.post -->
           </div>
           </div>
    <?php }

    }

       public function FollowersLists($profile_id,$user_id,$follow_id)
    {
       $mysqli= $this->database;
       $query= "SELECT * FROM users LEFT JOIN follow ON sender= user_id AND CASE WHEN receiver = $profile_id THEN sender = user_id END WHERE receiver IS NOT NULL";
       $result=$mysqli->query($query);

       if ($result->num_rows > 0) { 

       while ($following=$result->fetch_array()) {
            $workname = (strlen($following["workname"]) > 18)? substr($following["workname"],0,18).'..' : $following["workname"];

           # code...
           echo '
                <div class="col-md-4 mb-3">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-follow user-follow">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                         '.((!empty($following['cover_img']))?
                           '<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK."image/users_cover_profile/".$following['cover_img'].') center center;background-size: cover; overflow: hidden; width: 100%;">'
                          :'<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK.NO_COVER_IMAGE_URL.') center center;background-size: cover; overflow: hidden; width: 100%;">').'
                        </div>
                        <div class="user-image-follow">
                          '.((!empty($following['profile_img']))?
                               ' <img class="rounded-circle elevation-2"
                                    src="'.BASE_URL_LINK."image/users_profile_cover/".$following['profile_img'].'">'
                              :' <img class="rounded-circle elevation-2" src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"  /> ').'
                               <span>'.$this->lengthsOfusers($following['date_registry']).'</span>
                        </div>
                        <div class="card-footer">
                            <h5 class="user-username-follow m-1"><a href="'.BASE_URL_PUBLIC.$following['username'].'">'.$following['username'].'</a></h5>
                            <h5 class="user-username-follow m-1"><small>'.((!empty($workname))? $workname:'Member').'</small></h5>
                            <span>'.$this->followBtn($following['user_id'],$user_id,$profile_id,$follow_id).'</span>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /. card widget-user -->
                </div>
                <!-- col --> ';
       }
        
        }else { ?>
         <div class="card borders-tops mb-3"> 
            <div class="card-body message-color">

            <div class="post">
                <div class="user-block">
                    <div class="user-blockImgBorder">
                <div class="user-blockImg">
                        <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/irangiro.png" ;?>" alt="User Image">
                </div>
                </div>
                    <span class="username">
                        <a href="<?php echo PROFILE ;?>">Irangiro</a><?php echo self::followBtns(1,$user_id,1); ?>
                    </span>
                    <span class="description">Public Figure | Content Creator</span>
                </div>
                <!-- /.user-block -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <img class="img-fluid"
                                    src="<?php echo BASE_URL_LINK."image/users_cover_profile/coming-soon.png" ;?>" alt="Photo">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </div>
        <!-- /.post -->
        </div>
        </div>
    <?php }

    }

    public function FollowingListsProfile($profile_id,$user_id,$follow_id)
    {
       $mysqli= $this->database;
       $query= "SELECT * FROM users LEFT JOIN follow ON receiver= user_id AND CASE WHEN sender = $profile_id THEN receiver = user_id END WHERE sender IS NOT NULL ORDER BY rand() LIMIT 8 ";
       $result=$mysqli->query($query); 
       $followings= $this->userData($profile_id);
       ?>
        <div class="card card2">
            <div class="card-header text-center main-active">
               <h5><span class="badge badge-danger"><?php echo $followings['following'] ;?></span> Following</h5>
               <!-- <div class="card-tools">
                <span><span class="badge badge-danger">< ?php echo $row['following'] ;?></span>Following</span>
                 <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-tool" onclick='remove2();'><i class="fa fa-times"></i>
                 </button>
               </div> -->
             </div>
             <!-- /.card-header -->
             <div class="card-body p-0">
               <ul class="users-list clearfix">

      <?php while ($following=$result->fetch_array()) { 
           # code...
           echo '
                <li>
                     '.((!empty($following['profile_img']))?
                     ' <img class="rounded-circle" src="'.BASE_URL_LINK."image/users_profile_cover/".$following['profile_img'].'">'
                    :' <img class="rounded-circle" src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'" />' ).'
                     <a class="users-list-name" href="'.BASE_URL_PUBLIC.$following['username'].'">'.$following['username'].'</a>
                     <!-- <span class="users-list-date">Today</span> -->
                </li> ';
         } ?>
                 </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?php echo  BASE_URL_PUBLIC.$followings['username'].'.following' ;?>">View All Following</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!--/.card -->

   <?php }

    public function whoTofollow($user_id,$follow_id)
    {
       $mysqli= $this->database;
       $query= "SELECT * FROM users WHERE user_id != $user_id AND user_id NOT IN (SELECT receiver FROM follow WHERE sender = $user_id ) ORDER BY rand() LIMIT 4";
       $result=$mysqli->query($query);

        if ($result->num_rows > 0) {

        # code...
        echo ' <div class="card mb-3">
                     <div class="card-header main-active text-center">
                           <i> WHO TO FOLLOW </i>
                     </div>
                     <div class="card-body message-color  whoTofollow  py-0">
                     <ul class="whoTofollow-list row">
                     ';
                    //  var_dump(Users::$device_type,self::$device_type);

                     while ($whoTofollow=$result->fetch_array()) {
                        $workname = (strlen($whoTofollow["workname"]) > 18)? substr($whoTofollow["workname"],0,18).'..' : $whoTofollow["workname"];

            echo '      
                    '.((Users::$device_type == 'computer')?'<li class="px-0 more col-12">':'<li class="px-0 more col-6">').'
                            <div class="whoTofollow-list-img">
                                    '.((!empty($whoTofollow['profile_img'])?'
                                    <img src="'.BASE_URL_LINK."image/users_profile_cover/".$whoTofollow['profile_img'].'">
                                    ':'
                                    <img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'">
                                ')).'

                                '.$this->lengthsOfWhoNewCome($whoTofollow['date_registry']).'
                            </div>
                            <ul class="whoTofollow-list-info">
                                <li><a href="'.BASE_URL_PUBLIC.$whoTofollow['username'].'" id="'.$whoTofollow["user_id"].'" >'.$whoTofollow['username'].'</a>
                                '.($this->bot_light($whoTofollow['bot'],$whoTofollow['followers'])).'
                                </li>
                                <li>'.((!empty($workname)?'
                                <small class="my-0" style="font-size: 12px;">'.$workname.'</small>
                                ':'
                                <small class="my-0" style="font-size: 12px;">Member</small>
                                ')).'</li>
                            </ul>
                            <div class="whoTofollow-btn">
                                  <div class="my-0 ml-2">'.$this->followBtn($whoTofollow['user_id'],$user_id,$follow_id).'</div>
                                <!-- <a href="#" type="button" class="btn main-active btn-sm">Follow</a> -->
                            </div>
                        </li> ';
                      }
                    // '.((!empty($whoTofollow['bot']) && $whoTofollow['bot'] == 'bot')?'<span><img src="'.BASE_URL_LINK.'image/img/verified-light.png" width="15px"></span>':"").'
                      
            echo ' 
                     </ul>
                     </div>
                     <div class="card-footer text-center">
                         <a href="'.NETWORK.'">View more >>></a>
                     </div>
                 </div>';
                 
            }

    }

    // static public function tooltipProfile($whoTofollow,$user_id,$follow_id)
    static public function tooltipProfile($whoTofollow,$user_id,$follow_id,$user_key_coins,$username_keycoins,$tweet_id,$tweet)
    {
        $mysqli= self::$databases;
        $sql="SELECT * FROM users WHERE user_id = '{$follow_id}' ";
        $query= $mysqli->query($sql);
        $user= $query->fetch_assoc(); ?>

         <div  class="row" style="width:362px;">
            <div class="col-md-12">

                <!-- Profile Image -->
                <div class="info-box">
                    <div class="info-inner">
                        <div class="info-in-head">
                            <!-- PROFILE-COVER-IMAGE -->
                             <?php if (!empty($user['cover_img'])) {?>
                              <img src="<?php echo BASE_URL_LINK ;?>image/users_cover_profile/<?php echo $user['cover_img'] ;?>" alt="User Image">
                              <?php  }else{ ?>
                                <img src="<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>"  alt="User Image">
                              <?php } ?>
                        </div>
                        <!-- info in head end -->
                        <div class="info-in-body">
                            <div class="in-b-box">
                                <div class="in-b-img">
                                    <!-- PROFILE-IMAGE -->
                                     <?php if (!empty($user['profile_img'])) {?>
                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>"  alt="User Image">
                                      <?php  }else{ ?>
                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                      <?php } ?>
                                </div>
                            </div><!--  in b box end-->
                            <div class="info-body-name">
                                <div class="in-b-name">
                                    <div><a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?></a>
                                    <?php echo self::bot_light_($user['bot'],$user['followers']) ;?>
                                    
                                    <span><?php echo self::followBtns($whoTofollow,$user_id,$follow_id); ?></span>
                                    </div>
                                    <small class="my-0" style="font-size: 12px;"><?php 
                                    $workname = (strlen($user["workname"]) > 18)? substr($user["workname"],0,18).'..' : $user["workname"];
                                    echo $workname;?></small>
                                    <!-- <span><small><a href="< ?php echo BASE_URL_PUBLIC.$user['username'] ;?>">< ?php if(!empty($user['career'])){ echo $user['career'] ;}else{ echo 'Member' ;} ?></a></small></span> -->
                                </div><!-- in b name end-->
                            </div><!-- info body name end-->
                        </div><!-- info in body end-->
                        <div class="info-in-footer">
                        <!-- false -->
                        <!-- < ?php echo self::coins_recharge($user['user_id'],$user_key_coins,$username_keycoins,$user['username']); ?> -->
                        <!-- true -->
                        <!-- < ?php echo self::coins_recharge_tweet_tooltip($user['user_id'],$user_key_coins,$username_keycoins,$user['username'],$tweet_id,$tweet); ?> -->
                                
                            <div class="number-wrapper">
                                <div class="num-box">
                                    <div class="num-head">
                                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.posts';?>"> POSTS</a>
                                    </div>
                                    <div class="num-body">
                                       <?php echo self::countsPostss($user['user_id']);?>
                                    </div>
                                </div>
                                <div class="num-box">
                                    <div class="num-head">
                                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.followers';?>"> FOLLOWING </a>
                                    </div>
                                    <div class="num-body">
                                        <span class="count-following"><?php echo $user['following'] ;?></span>
                                    </div>
                                </div>
                                <div class="num-box">
                                    <div class="num-head">
                                        <a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.followers';?>"> FOLLOWERS</a>
                                    </div>
                                    <div class="num-body">
                                        <span class="count-followers"><?php echo $user['followers'] ;?></span>
                                    </div>
                                </div>
                            </div><!-- mumber wrapper-->
                        </div><!-- info in footer -->
                    </div><!-- info inner end -->
                </div><!-- info box -->

            </div><!-- col -->
        </div><!-- row -->
        
    <?php }

    static public function coins_recharge($user_id,$user_key,$username_key,$username)
    {
        $mysqli= self::$databases;
        $sql="SELECT * FROM users WHERE user_id = '{$user_id}' ";
        $query= $mysqli->query($sql);
        $user= $query->fetch_assoc(); ?>

         <div class="container retweetcolor p-4 shadow-sm border">
         <div class="row">
            <div class="col-md-12">
            <form method="post" class="form-coins<?php echo $user_id;?>">

            <input type="hidden" name="user_id" id="user_key<?php echo $user_id?>" value="<?php echo $user_key; ?>">
            <input type="hidden" name="user_id_coins_to" value="<?php echo $user_id; ?>">
            <input type="hidden" name="username_coins_to" value="<?php echo $username; ?>">
            <input type="hidden" name="user_id_coins_from" value="<?php echo $user_key; ?>">
            <input type="hidden" name="username_coins_from" value="<?php echo $username_key; ?>">

                <label for="exampleFormControlInput1">Send Reward <i class="fas fa-coins text-warning"></i> Coins to <?php echo $username;?></label>
                <div class="form-group">
                    <select class="form-control amount_coins" id="amount_coins<?php echo $user_id?>" name="amount_coins">
                    <option value="">Select Coins</option>
                        <option value='0.5=>50'>0.5 coins    =>    50 Frw</option>
                        <option value='1=>100'>1 coins    =>    100 Frw</option>
                        <option value='5=>500'>5 coins    =>    500 Frw</option>
                        <option value='10=>1000'>10 coins    =>    1,000 Frw</option>
                        <option value='50=>5000'>50 coins    =>    5,000 Frw</option>
                        <option value='100=>10000'>100 coins    =>    10,000 Frw</option>
                        <option value='250=>25000'>250 coins    =>    25,000 Frw</option>
                        <option value='500=>50000'>500 coins   =>    50,000 Frw </option>
                        <option value='1000=>100000'>1000 coins  =>    100,000 Frw </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control comment_coins" name="comment_coins" id="comment_coins<?php echo $user_id;?>" placeholder="Comment to <?php echo $username ;?>">
                </div>
                <span class="response_coins"></span>
                <input type="button" name="reward_coins" value="Send Donation" <?php echo (!empty($_SESSION['key']))?'data-user_id="'.$user_id.'" class="btn btn-primary btn-lg btn-block reward_coins_user_id mt-2 main-active" ':'id="login-please" data-login="1" class="btn btn-primary btn-lg btn-block main-active"' ;?> >
            </form>
            </div><!-- col -->
        </div><!-- row -->
        </div><!-- container -->
        
    <?php }

    static public function coins_recharge_tweet_tooltip($user_id,$user_key,$username_key,$username,$tweet_id,$tweet)
    {
        $mysqli= self::$databases;
        $sql="SELECT * FROM users WHERE user_id = '{$user_id}' ";
        $query= $mysqli->query($sql);
        $user= $query->fetch_assoc(); ?>

         <div  class="container retweetcolor p-4 shadow-sm border">
            <div class="">
                <img class="img-donate-coins" src="<?php echo BASE_URL_LINK; ?>image/background_image/donate_coins.png">
            </div>
         
            <div  class="row">
            <div class="col-md-12">
            <form method="post" class="form-coins<?php echo $tweet_id;?>">

            <input type="hidden" name="user_id" id="user_key<?php echo $tweet_id ?>" value="<?php echo $user_key; ?>">
            <!-- <input type="hidden" name="coins" value="< ?php echo $tweet['coins']; ?>"> -->
            <input type="hidden" name="tweet_id" value="<?php echo ($tweet['retweet_id'] != 0)?$tweet['retweet_id']:$tweet['tweet_id']; ?>">
            <input type="hidden" name="user_id_coins_to" value="<?php echo $user_id; ?>">
            <input type="hidden" name="username_coins_to" value="<?php echo $username; ?>">
            <input type="hidden" name="user_id_coins_from" value="<?php echo $user_key; ?>">
            <input type="hidden" name="username_coins_from" value="<?php echo $username_key; ?>">

                <label for="exampleFormControlInput1">Send Reward <i class="fas fa-coins text-warning"></i> Coins to <?php echo $username;?>
                    <!-- <img class="img-donate-coins" src="< ?php echo BASE_URL_LINK; ?>image/background_image/coinsAsset.png"> -->
                </label>
                <div class="form-group">
                    <select class="form-control amount_coins" id="amount_coins<?php echo $tweet_id;?>" name="amount_coins" style="background:none">
                    <option value="">Select Coins</option>
                        <option value='0.5=>50'>0.5 coins    =>    50 Frw</option>
                        <option value='1=>100'>1 coins    =>    100 Frw</option>
                        <option value='5=>500'>5 coins    =>    500 Frw</option>
                        <option value='10=>1000'>10 coins    =>    1,000 Frw</option>
                        <option value='50=>5000'>50 coins    =>    5,000 Frw</option>
                        <option value='100=>10000'>100 coins    =>    10,000 Frw</option>
                        <option value='250=>25000'>250 coins    =>    25,000 Frw</option>
                        <option value='500=>50000'>500 coins   =>    50,000 Frw </option>
                        <option value='1000=>100000'>1000 coins  =>    100,000 Frw </option>
                    <!-- <option value='35=>500'>35 coins    =>    500 Frw</option>
                    <option value='70=>1000'>70 coins    =>    1,000 Frw</option>
                    <option value='350=>5000'>350 coins   =>    5,000 Frw </option>
                    <option value='1400=>21000'>1400 coins  =>    21,000 Frw </option>
                    <option value='3500=>54000'>3500 coins  =>    54,000 Frw </option> -->
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control comment_coins" name="comment_coins" id="comment_coins<?php echo $tweet_id;?>" placeholder="Comment to <?php echo $username ;?>" style="background:none">
                </div>
                <span class="response_coins"></span>
                <input type="button" name="reward_coins" value="Send Reward" <?php echo (!empty($_SESSION['key']))?' data-tweet_id="'.$tweet_id.'" data-user_id="'.$user_id.'" class="btn btn-primary btn-lg btn-block reward_coins_tweet_id_user_id main-active" ':'id="login-please" data-login="1" class="btn btn-primary btn-lg btn-block main-active"' ;?> >
            </form>
            </div><!-- col -->
        </div><!-- row -->
        </div><!-- container -->
        
    <?php }

    static public function coins_recharge_tweet($user_id,$user_key,$username_key,$username,$tweet_id,$tweet)
    {
        $mysqli= self::$databases;
        $sql="SELECT * FROM users WHERE user_id = '{$user_id}' ";
        $query= $mysqli->query($sql);
        $user= $query->fetch_assoc(); ?>

         <div  class="container retweetcolor p-4 shadow-sm border">
            <div class="">
                <img class="img-donate-coins" src="<?php echo BASE_URL_LINK; ?>image/background_image/donate_coins.png">
            </div>
         
            <form method="post" class="form-coins<?php echo $tweet_id;?>">
            <div  class="row">
            <div class="col-md-12">

            <input type="hidden" name="user_id"  id="user_key<?php echo $tweet_id ?>" value="<?php echo $user_key; ?>">
            <!-- <input type="hidden" name="coins" value="< ?php echo $tweet['coins']; ?>"> -->
            <input type="hidden" name="tweet_id" value="<?php echo ($tweet['retweet_id'] != 0)?$tweet['retweet_id']:$tweet['tweet_id']; ?>">
            <input type="hidden" name="user_id_coins_to" value="<?php echo $user_id; ?>">
            <input type="hidden" name="username_coins_to" value="<?php echo $username; ?>">
            <input type="hidden" name="user_id_coins_from" value="<?php echo $user_key; ?>">
            <input type="hidden" name="username_coins_from" value="<?php echo $username_key; ?>">

                <label for="exampleFormControlInput1">Send Reward <i class="fas fa-coins text-warning"></i> Coins to <?php echo $username;?>
                    <!-- <img class="img-donate-coins" src="< ?php echo BASE_URL_LINK; ?>image/background_image/coinsAsset.png"> -->
                </label>
                <div class="form-group">
                    <select class="form-control amount_coins" id="amount_coins<?php echo $tweet_id;?>" name="amount_coins" style="background:none">
                    <option value="">Select Coins</option>
                        <option value='0.5=>50'>0.5 coins    =>    50 Frw</option>
                        <option value='1=>100'>1 coins    =>    100 Frw</option>
                        <option value='5=>500'>5 coins    =>    500 Frw</option>
                        <option value='10=>1000'>10 coins    =>    1,000 Frw</option>
                        <option value='50=>5000'>50 coins    =>    5,000 Frw</option>
                        <option value='100=>10000'>100 coins    =>    10,000 Frw</option>
                        <option value='250=>25000'>250 coins    =>    25,000 Frw</option>
                        <option value='500=>50000'>500 coins   =>    50,000 Frw </option>
                        <option value='1000=>100000'>1000 coins  =>    100,000 Frw </option>
                        <!-- <option value='35=>500'>35 coins    =>    500 Frw</option>
                        <option value='70=>1000'>70 coins    =>    1,000 Frw</option>
                        <option value='350=>5000'>350 coins   =>    5,000 Frw </option>
                        <option value='1400=>21000'>1400 coins  =>    21,000 Frw </option>
                        <option value='3500=>54000'>3500 coins  =>    54,000 Frw </option> -->
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control comment_coins" name="comment_coins" id="comment_coins<?php echo $tweet_id;?>" placeholder="Comment to <?php echo $username ;?>" style="background:none">
                </div>

                <span class="response_coins"></span>
                <input type="button" name="reward_coins" value="Send Donation" <?php echo (!empty($_SESSION['key']))?'data-tweet_id="'.$tweet['tweet_id'].'"  data-user_id="'.$user_id.'" class="btn btn-primary btn-lg btn-block reward_coins_tweet_id_user_id mt-2 main-active" ':'id="login-please" data-login="1" class="btn btn-primary btn-lg btn-block main-active"' ;?> >

            </div><!-- col -->

            <!-- <div class="col-12 mb-2">
                
                <div class="text-muted mb-1">Donation
                    <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                </div>
                <div class="card-text">
                < !-- 40,000 -- >
                    <span class="font-weight-bold">< ?php echo number_format($tweet['money_raising']); ?> Frw</span>
                    Raised by < ?php echo $tweet['donate_counts']; ?> people in < ?php echo self::timeAgo($tweet['posted_on']);?> 
                    <span class="float-right">< ?php echo self::donationPercetangeMoneyRaimaing($tweet['money_raising'],$tweet['money_to_target']); ?> %</span>
                    < !-- 40 -- >
                </div>
                <div class="progress clear-float " style="height: 10px;">
                    < ?php echo self::Users_donationMoneyRaising($tweet['money_raising'],$tweet['money_to_target']); ?>
                </div>
                
                <div class="clear-float">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <span class="text-muted">< ?php echo self::timeAgo($tweet['posted_on']); ?></span>
                    <span class="text-muted float-right text-right">out of < ?php echo number_format($tweet['money_to_target']).' Frw'; ?></span>
                    < !-- 13 days Left -- >
                </div>

            </div>< !-- col -- //>  
            -->
             
        </div><!-- row -->
        </form>

        </div><!-- container -->
        
    <?php }

    static public function donate_recharge_tweet($user_id,$user_key,$username_key,$tweet)
    {
        $mysqli= self::$databases;
        $sql="SELECT * FROM users WHERE user_id = '{$user_id}' ";
        $query= $mysqli->query($sql);
        $user= $query->fetch_assoc(); ?>

         <div  class="container retweetcolor p-4 shadow-sm border">
            <div class="">
                <img class="img-donate-coins" src="<?php echo BASE_URL_LINK; ?>image/background_image/donate_coins.png">
            </div>
         
            <form method="post" class="form-coins<?php echo $tweet['tweet_id'];?>">

            <div  class="row">
            <div class="col-12">

            <input type="hidden" name="user_id" value="<?php echo $user_key; ?>">
            <input type="hidden" name="coins" value="<?php echo $tweet['coins']; ?>">
            <input type="hidden" name="tweet_id" value="<?php echo ($tweet['retweet_id'] != 0)?$tweet['retweet_id']:$tweet['tweet_id']; ?>">
            <input type="hidden" name="user_id_coins_to" value="<?php echo $user_id; ?>">
            <input type="hidden" name="username_coins_to" value="<?php echo $tweet['username']; ?>">
            <input type="hidden" name="user_id_coins_from" value="<?php echo $user_key; ?>">
            <input type="hidden" name="username_coins_from" value="<?php echo $username_key; ?>">

                <label for="exampleFormControlInput1">Send Donation <i class="fas fa-coins text-warning"></i> Coins to <?php echo $tweet['username'];?>
                    <!-- <img class="img-donate-coins" src="< ?php echo BASE_URL_LINK; ?>image/background_image/coinsAsset.png"> -->
                </label>
                <div class="form-group">
                    <select class="form-control amount_coins" id="amount_coins<?php echo $tweet['tweet_id'];?>" name="amount_coins" style="background:none">
                    <option value="">Select Coins</option>
                        <option value='0.5=>50'>0.5 coins    =>    50 Frw</option>
                        <option value='1=>100'>1 coins    =>    100 Frw</option>
                        <option value='5=>500'>5 coins    =>    500 Frw</option>
                        <option value='10=>1000'>10 coins    =>    1,000 Frw</option>
                        <option value='50=>5000'>50 coins    =>    5,000 Frw</option>
                        <option value='100=>10000'>100 coins    =>    10,000 Frw</option>
                        <option value='250=>25000'>250 coins    =>    25,000 Frw</option>
                        <option value='500=>50000'>500 coins   =>    50,000 Frw </option>
                        <option value='1000=>100000'>1000 coins  =>    100,000 Frw </option>
                    <!-- <option value='35=>500'>35 coins    =>    500 Frw</option>
                    <option value='70=>1000'>70 coins    =>    1,000 Frw</option>
                    <option value='350=>5000'>350 coins   =>    5,000 Frw </option>
                    <option value='1400=>21000'>1400 coins  =>    21,000 Frw </option>
                    <option value='3500=>54000'>3500 coins  =>    54,000 Frw </option> -->
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control comment_coins" name="comment_coins" id="comment_coins<?php echo $tweet['tweet_id'];?>" placeholder="Comment to <?php echo $tweet['username'] ;?>" style="background:none">
                </div>
            </div>

            <div class="col-12 mb-2">
                
                <div class="text-muted mb-1">Donation
                    <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                </div>
                <div class="card-text">
                <!-- 40,000 -->
                    <span class="font-weight-bold"><?php echo number_format($tweet['money_raising']); ?> Frw</span>
                    Raised by <?php echo $tweet['donate_counts']; ?> people in <?php echo self::timeAgo($tweet['posted_on']);?> 
                    <span class="float-right"><?php echo self::donationPercetangeMoneyRaimaing($tweet['money_raising'],$tweet['money_to_target']); ?> %</span>
                    <!-- 40 -->
                </div>
                <div class="progress clear-float " style="height: 10px;">
                    <?php echo self::Users_donationMoneyRaising($tweet['money_raising'],$tweet['money_to_target']); ?>
                </div>
                
                <div class="clear-float">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <span class="text-muted"><?php echo self::timeAgo($tweet['posted_on']); ?></span>
                    <span class="text-muted float-right text-right">out of <?php echo number_format($tweet['money_to_target']).' Frw'; ?></span>
                    <!-- 13 days Left -->
                </div>

                <span class="response_coins"></span>
                <input type="button" name="reward_coins" value="Send Donation" <?php echo (!empty($_SESSION['key']))?'data-tweet_id="'.$tweet['tweet_id'].'"  data-user_id="'.$user_id.'" class="btn btn-primary btn-lg btn-block reward_coins_tweet_id mt-2 main-active" ':'id="login-please" data-login="1" class="btn btn-primary btn-lg btn-block main-active"' ;?> >
            </div><!-- col -->
            </div><!-- row -->
        </form>
        </div><!-- container -->
        
    <?php }

     public function Post_FollowingLists($user_id,$follow_id)
    {
       $mysqli= $this->database;
       $query= "SELECT * FROM users WHERE user_id != $user_id AND user_id NOT IN (SELECT receiver FROM follow WHERE sender = $user_id ) ORDER BY rand() LIMIT 9";
       $result=$mysqli->query($query); 
        //Columns must be a factor of 12 (1,2,3,4,6,12)
        $numOfCols = 3;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
       ?>
       <div class="slide-text">
        <div class="slideshow-container">

        <div class="dot-container h5">
          <a href="<?php echo NETWORK; ?>">View more to Follows >>>></a> 
        </div>

        <div class="row mySlidesx mySlidesx_">
     <?php  while ($following=$result->fetch_array()) {
           # code...
           echo '
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-follow user-follow">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                         '.((!empty($following['cover_img']))?
                           '<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK."image/users_cover_profile/".$following['cover_img'].') center center;background-size: cover; overflow: hidden; width: 100%;">'
                          :'<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK.NO_COVER_IMAGE_URL.') center center;background-size: cover; overflow: hidden; width: 100%;">' ).'
                        </div>
                        <div class="user-image-follow">
                          '.((!empty($following['profile_img']))?
                               ' <img class="rounded-circle elevation-2"
                                    src="'.BASE_URL_LINK."image/users_profile_cover/".$following['profile_img'].'">'
                              :' <img class="rounded-circle elevation-2" src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'" />' ).'
                             <span> '.$this->lengthsOfusers($following['date_registry']).'</span>
                        </div>
                        <div class="card-footer">
                            <h5 class="user-username-follow m-1 "><a href="'.BASE_URL_PUBLIC.$following['username'].'">'.$following['username'].'</a></h5>
                            <h5 class="user-username-follow m-1"><small>'.((!empty($following['workname']))? $this->getTweetLink($following['workname']):'Member').'</small></h5>
                            <span>'.$this->followBtn($following['user_id'],$user_id,$follow_id).'</span>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /. card widget-user -->
                </div>
                <!-- col --> ';
                $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div><div class="row mySlidesx mySlidesx_">';
       } ?>
        </div>
        <!-- Next/prev buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
        <!-- Dots/bullets/indicators -->
        <div class="dot-container">
            <span class="dot dot_" onclick="currentSlide(1)"></span>
            <span class="dot dot_" onclick="currentSlide(2)"></span>
            <span class="dot dot_" onclick="currentSlide(3)"></span>
        </div>
    </div>
 <?php }

     public function Network_FollowingLists($pages,$user_id,$follow_id)
    {
        $pages= $pages;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*12)-12;
        }
       $mysqli= $this->database;
       $query= "SELECT * FROM users WHERE user_id != $user_id AND user_id NOT IN (SELECT receiver FROM follow WHERE sender = $user_id ) ORDER BY rand() LIMIT $showpages,12";
       $result=$mysqli->query($query); 
        //Columns must be a factor of 12 (1,2,3,4,6,12)
        $numOfCols = 4;
        $rowCount = 0;
       ?>
        <div class="card mb-3">
          <div class="card-header">
              <h5>More suggestions for you</h5>
              <!-- <hr> -->
               <ul class="nav nav-pills d-none" >
                    <li class="nav-item"><a class="nav-link  active" href="#people"
                        data-toggle="tab">people</a> </li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#groups"
                        data-toggle="tab">Groups</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pages"
                        data-toggle="tab">Pages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#business"
                        data-toggle="tab">Firms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hashtag"
                        data-toggle="tab">#hashtag</a></li> -->
                </ul>
          </div>
    </div>
    <!-- card -->
    <div class="tab-content">
        <div class="tab-pane active " id="people">
        <div class="row mb-3">
     <?php  while ($following=$result->fetch_array()) {
           # code...
            $workname = (strlen($following["workname"]) > 30)? substr($following["workname"],0,30).'..' : $following["workname"];

           echo '
                <div class="col-md-3 mb-2">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-follow user-follow">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                         '.((!empty($following['cover_img']))?
                           '<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK."image/users_cover_profile/".$following['cover_img'].') center center;background-size: cover; overflow: hidden; width: 100%;">'
                          :'<div class="user-header-follow text-white" style="background: url('.BASE_URL_LINK.NO_COVER_IMAGE_URL.') center center;background-size: cover; overflow: hidden; width: 100%;">' ).'
                        </div>
                        <div class="user-image-follow">
                          '.((!empty($following['profile_img']))?
                               ' <img class="rounded-circle elevation-2"
                                    src="'.BASE_URL_LINK."image/users_profile_cover/".$following['profile_img'].'">'
                              :' <img class="rounded-circle elevation-2" src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'" />' ).'
                             <span> '.$this->lengthsOfusers($following['date_registry']).'</span>
                        </div>
                        <div class="card-footer">
                            <h5 class="user-username-follow m-1 "><a href="'.BASE_URL_PUBLIC.$following['username'].'">'.$following['username'].'</a>
                            '.($this->bot_light($following['bot'],$following['followers'])).'
                            
                            </h5>
                            <h5 class="user-username-follow m-1"><small>'.((!empty($workname))? $workname :'Member').'</small></h5>
                            <span>'.$this->followBtn($following['user_id'],$user_id,$follow_id).'</span>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /. card widget-user -->
                </div>
                <!-- col --> ';
                $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div><div class="row mb-3">';
       } ?>
             </div>
             <!-- row -->
        <?php 
        $query1= $mysqli->query("SELECT COUNT(*) FROM users WHERE user_id != $user_id AND user_id NOT IN (SELECT receiver FROM follow WHERE sender = $user_id )");
        // var_dump('Error'.$query1.mysqli_error($mysqli));
        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/12;
        $post_Perpage = ceil($post_Perpages); ?>

    <?php if($post_Perpage > 1){ ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($pages > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="follow_FecthRequest(<?php echo $pages-1; ?>,<?php echo $user_id; ?>,<?php  echo $follow_id; ?>)">Previous</a></li>
            <?php } ?>
            <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                    if ($i == $pages) { ?>
                 <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="follow_FecthRequest(<?php echo $i; ?>,<?php echo $user_id; ?>,<?php  echo $follow_id; ?>)" ><?php echo $i; ?> </a></li>
                 <?php }else{ ?>
                <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="follow_FecthRequest(<?php echo $i; ?>,<?php echo $user_id; ?>,<?php  echo $follow_id; ?>)" ><?php echo $i; ?> </a></li>
            <?php } } ?>
            <?php if ($pages+1 <= $post_Perpage) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="follow_FecthRequest(<?php echo $pages+1; ?>,<?php echo $user_id; ?>,<?php  echo $follow_id; ?>)">Next</a></li>
            <?php } ?>
        </ul>
    </nav>

       <?php } ?>

        </div> 
        <!-- <div class="tab-pane" id="groups">
           Groups
        </div> 
        <div class="tab-pane" id="pages">
           pages
        </div> 
        <div class="tab-pane" id="business">
           firms
        </div> 
        <div class="tab-pane" id="hashtag">
           hashtag
        </div>  -->
        <!-- tab-panel -->
        </div> 
        <!-- tab-panel -->

 <?php }

     public function Network_FollowingLists_Responsive($limit,$user_id,$follow_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM users WHERE user_id != $user_id AND user_id NOT IN (SELECT receiver FROM follow WHERE sender = $user_id ) ORDER BY user_id ASC LIMIT $limit";
        $result=$mysqli->query($query);
 
         if ($result->num_rows > 0) {
 
         # code...
         echo ' <div class="card">
                      <div class="card-header main-active text-center">
                            <i> WHO TO FOLLOW </i>
                      </div>
                      <div class="card-body message-color  whoTofollow  py-0">
                      <ul class="whoTofollow-list row">
                      ';
                      while ($whoTofollow=$result->fetch_array()) {
                        $workname = (strlen($whoTofollow["workname"]) > 10)? substr($whoTofollow["workname"],0,10).'..' : $whoTofollow["workname"];

             echo '      <li class="px-0 more col-6">
                             <div class="whoTofollow-list-img">
                                     '.((!empty($whoTofollow['profile_img'])?'
                                     <img src="'.BASE_URL_LINK."image/users_profile_cover/".$whoTofollow['profile_img'].'">
                                     ':'
                                     <img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'">
                                 ')).'
 
                                 '.$this->lengthsOfWhoNewCome($whoTofollow['date_registry']).'
                             </div>
                             <ul class="whoTofollow-list-info">
                                 <li><a href="'.BASE_URL_PUBLIC.$whoTofollow['username'].'" id="'.$whoTofollow["user_id"].'" >'.$whoTofollow['username'].'</a>
                                '.($this->bot_light($whoTofollow['bot'],$whoTofollow['followers'])).'
                                
                                </li>
                                 <li>'.((!empty($workname)?'
                                 <small class="my-0" style="font-size: 12px;">'.$workname.'</small>
                                 ':'
                                 <small class="my-0" style="font-size: 12px;">Member</small>
                                 ')).'</li>
                             </ul>
                             <div class="whoTofollow-btn">
                                   <div class="my-0 ml-2">'.$this->followBtn($whoTofollow['user_id'],$user_id,$follow_id).'</div>
                                 <!-- <a href="#" type="button" class="btn main-active btn-sm">Follow</a> -->
                             </div>
                         </li> ';
                       }
                       
             echo ' 
                      </ul>
                      </div>
                      <div class="card-footer text-center">
                          Suggestion People >>>
                      </div>
                  </div>';
                  
             }
 
    }

}

$follow = new follow();
/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>