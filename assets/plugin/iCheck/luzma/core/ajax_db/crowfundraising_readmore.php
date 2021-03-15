<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
ini_set('display_errors', 1); 
error_reporting(E_ALL);

if (isset($_POST['crowfund_id']) && !empty($_POST['crowfund_id'])) {
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    }else {
        # code...
        $username= $users->test_input('irangiro');
        $uprofileId= $home->usersNameId($username);
        $profileData= $home->userData($uprofileId['user_id']);
        $user_id= $profileData['user_id'];
    }
    
    $crowfund_id = $_POST['crowfund_id'];
    $user= $crowfund->crowfundFecthReadmore($crowfund_id,$user_id);
    $donates= $crowfund->recentDonate($crowfund_id);
    $comment= $crowfund->Crownfund_comments($crowfund_id);
    $likes= $crowfund->Crowfundraisinglikes($user_id,$user['fund_id']);

?>

<div class="crowfund-popup">
<div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap"  id="popupEnd">

        	<div class="img-popup-body">

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

                   <div class="user-block">
                        <div class="user-blockImgBorder">
                         <div class="user-blockImg">
                               <?php if (!empty($user['profile_img'])) {?>
                               <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                               <?php  }else{ ?>
                                 <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                               <?php } ?>
                         </div>
                         </div>
                         <span class="username">
                             <a
                                 href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['firstname']." ".$user['lastname'] ;?></a>
                             <!-- //Jonathan Burke Jr. -->
                         </span>
                         <!-- <span class="description">Shared publicly - < ?php echo $home->timeAgo($user['posted_on']); ?></span> -->
                         <span class="description">Shared publicly - <?php echo $users->timeAgo($user['created_on2']) ;?></span>
                     </div> <!-- /.user-block -->
                </div> <!-- /.card-header -->

                <div class="card-body">
                   <div class="row reusercolor p-2">
                       <div class="col-md-6">
                           <div id="jssor_1"  style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:980px;overflow:hidden;visibility:hidden;">
                                <!-- Loading Screen -->
                                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo BASE_URL_LINK;?>image/users_profile_cover/spin.svg" />
                                </div>
                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:980px;overflow:hidden;"> <!--width:980px;height:380px -->
                                      <?php 
                                        $file = $user['photo']."=".$user['other_photo'];
                                        $expode = explode("=",$file);
                                        $splice= array_splice($expode,0,10);
                                        for ($i=0; $i < count($splice); ++$i) { 
                                            ?>
                                      <div class="imagecrowfundViewPopup more"  data-crowfund="<?php echo $user["fund_id"] ;?>">
                                      <img data-u="image" src="<?php echo BASE_URL_PUBLIC."uploads/crowfund/".$splice[$i] ;?>"
                                          alt="Photo" >
                                      </div>
                                      <?php } ?>
                                   
                                </div>
                                <!-- Bullet Navigator -->
                                <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <!-- Arrow Navigator -->
                                <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                        <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                        <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                                    </svg>
                                </div>
                                <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                        <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                        <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                                    </svg>
                                </div>
                           </div>
                           <script type="text/javascript">jssor_1_slider_init();</script>
                      
                       <h4 class="mt-2"><i>
                          Helps <?php echo $user['lastname1']." ". $user['photo_Title_main']; ?>
                       </i></h4>
                       <div class="mt-2">
                           <?php echo $user['text']; ?>
                       </div>
                       <?php 
                        $expodefile = explode("=",$user['other_photo']); 
                        $fileActualExt= array();
                         for ($i=0; $i < count($expodefile); ++$i) { 
                             $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                         }
                         $allower_ext = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
             if (array_diff($fileActualExt,$allower_ext) == false) {

                        $expode = explode("=",$user['other_photo']); 
                        $count = count($expode); ?>

               <?php if ($count === 1) { ?>

                       <div class="mt-2">
                            <?php 
                               $file = $user['other_photo'];
                               $photo_title=  explode("=",$user["photo_Title"]);
                               $expode = explode("=",$file); ?>
                             <div class="imagecrowfundViewPopup more"  data-crowfund="<?php echo $user["fund_id"] ;?>">
                                <img src="<?php echo BASE_URL_PUBLIC."uploads/crowfund/".$expode[0] ;?>"
                                    alt="Photo" >
                             </div>
                             <div class="h5"><i><?php echo $photo_title[0]; ?></i></div>
                       </div>

               <?php }else if ($count === 2) { ?>

                         <?php 
                               $file = $user['other_photo'];
                               $photo_title=  explode("=",$user["photo_Title"]);
                               $explode = explode("=",$file);
                               $splice= array_splice($explode,0,2);
                               for ($i=0; $i < count($splice); ++$i) { 
                                   ?>
                                   <div class="mt-2">
                                         <div class="imagecrowfundViewPopup more"  data-crowfund="<?php echo $user["fund_id"] ;?>">
                                            <img src="<?php echo BASE_URL_PUBLIC."uploads/crowfund/".$expode[0] ;?>"
                                                alt="Photo" >
                                        </div>
                                        <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                   </div>
                             <?php } ?>

               <?php }else if ($count === 3) { ?>

                         <?php 
                               $file = $user['other_photo'];
                               $photo_title=  explode("=",$user["photo_Title"]);
                               $explode = explode("=",$file);
                               $splice= array_splice($explode,0,3);
                               for ($i=0; $i < count($splice); ++$i) { 
                                   ?>
                                   <div class="mt-2">
                                          <div class="imagecrowfundViewPopup more"  data-crowfund="<?php echo $user["fund_id"] ;?>">
                                            <img src="<?php echo BASE_URL_PUBLIC."uploads/crowfund/".$expode[0] ;?>"
                                                alt="Photo" >
                                        </div>
                                        <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                   </div>
                             <?php } ?>

                  <?php }else if ($count > 3) { ?>

                            <?php 
                               $file = $user['other_photo'];
                               $photo_title=  explode("=",$user["photo_Title"]);
                               $explode = explode("=",$file);
                               $splice= array_splice($explode,0,4);
                               for ($i=0; $i < count($splice); ++$i) { 
                                   ?>
                                   <div class="mt-2">
                                         <div class="imagecrowfundViewPopup more"  data-crowfund="<?php echo $user["fund_id"] ;?>">
                                            <img src="<?php echo BASE_URL_PUBLIC."uploads/crowfund/".$expode[0] ;?>"
                                                alt="Photo" >
                                        </div>
                                        <div class="h5"><i><?php if(!empty($user["photo_Title"])){ echo $photo_title[$i];} ?></i></div>
                                   </div>
                             <?php } ?>

                            <span class="btn btn-primary imageFundViewPopup  float-right" data-crowfund="<?php echo $user["crowfund_id"] ;?>" > View More photo  <i class="fa fa-picture-o"></i> >>> </span>

                  <?php } ?>
                  
               <?php } ?>

                     </div> <!-- col-md-6  -->
                     <div class="col-md-6 pl-5">
                            <span><?php echo number_format($user['money_raising']).' Frw Raised out of<span class="float-right text-right"> '.number_format($user['money_to_target']).' Frw <span class="text-success">Goal </span></span>'; ?>  </span>
                            <div class="progress " style="height: 10px;">
                                <?php echo $users->Users_donationMoneyRaising($user['money_raising'],$user['money_to_target']); ?>
                                <!-- <div class="progress-bar  bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> -->
                            </div>
                            <p>Raised by <?php echo $user['donate_counts']; ?> people in 30 months <span class="float-right text-right"><?php echo $users->donationPercetangeMoneyRaimaing($user['money_raising'],$user['money_to_target']); ?> /100 %</span></p>
                            <button type="button" <?php if(isset($_SESSION['key'])){ echo 'class="btn btn-primary donation-crowfund-btn"'; }else{ echo 'class="btn btn-primary" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id']; ?>" data-fund="<?php echo $user['fund_id']; ?>">Invest Now</button><br>
                            
                            <div class="user-block mt-3">
                               <div class="user-blockImgBorder">
                                <div class="user-blockImg">
                                      <?php if (!empty($user['profile_img'])) {?>
                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                      <?php  }else{ ?>
                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                      <?php } ?>
                                </div>
                                </div>
                                <span class="username">
                                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['lastname'] ;?> | Created  on <?php echo $users->timeAgo($user['created_on2']) ;?></a>
                                    <!-- //Jonathan Burke Jr. -->
                                </span>
                                <span class="description" ><span <?php if(isset($_SESSION['key'])){ echo 'class="people-message more"'; }else{ echo 'id="login-please" class="more" data-login="1"'; } ?> data-user="<?php echo $user['user_id2'];?>"><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </span> | <i class="fa fa-tag mr-1"></i><?php echo $user['categories_crowfundraising'] ;?></span>
                                <span class="description"><i class="fa fa-map-marker mr-1"></i> <?php echo $user['country1'] ;?> | <?php echo $user['city'] ;?> | <?php echo $user['namedistrict'] ;?>  </span>
                            </div> <!-- /.user-block -->

                            <h5 class="mt-3"> Recent Donation (<?php echo $crowfund->CountcrowFundraisingRaising($user['fund_id']); ?>)</h5>
                            <div class=" row mt-1">
                            <?php if (count($donates) > 6) { ?>
                                
                                <div class="col-md-12">
                                <div style="height:380px;" class="large-2">
                                    <?php  foreach ($donates as $donate) { ?> 
                                
                                    <div class="user-block mt-3">
                                    <div class="user-blockImgBorder">
                                        <div class="user-blockImg">
                                            <?php if (!empty($donate['profile_img'])) {?>
                                            <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $donate['profile_img'] ;?>" alt="User Image">
                                            <?php  }else{ ?>
                                                <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                            <?php } ?>
                                        </div>
                                        </div>
                                        <span class="username">
                                            <a href="<?php echo BASE_URL_PUBLIC.$donate['username'] ;?>"><?php echo number_format($donate['money_donate']); ?> Frw </a> <span class="float-right mr-2"><i class="fa fa-heart" ></i></span>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description"><?php echo $donate['comment']; ?> </span>
                                        <span class="description">donated on <?php echo $users->timeAgo($donate['created_on3']) ;?></span>
                                    </div> <!-- /.user-block -->
                                    
                                    <?php } ?>
                                  </div><!-- /.col --> 
                                </div><!-- /.col --> 
                            <?php  }else{ ?>

                             <div class="col-md-12">
                            <?php  foreach ($donates as $donate) { ?> 
                                
                                <div class="user-block mt-3">
                                    <div class="user-blockImgBorder">
                                        <div class="user-blockImg">
                                            <?php if (!empty($donate['profile_img'])) {?>
                                            <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $donate['profile_img'] ;?>" alt="User Image">
                                            <?php  }else{ ?>
                                                <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                            <?php } ?>
                                        </div>
                                        </div>
                                        <span class="username">
                                            <a href="<?php echo BASE_URL_PUBLIC.$donate['username'] ;?>"><?php echo number_format($donate['money_donate'],2); ?> Frw <span class="float-right mr-2"><i class="fa fa-heart" ></i></span></a>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description"><?php echo $donate['comment']; ?> </span>
                                        <span class="description">donated on <?php echo $users->timeAgo($donate['created_on3']) ;?></span>
                                    </div> <!-- /.user-block -->
                                    
                                    <?php } ?>
                                </div><!-- /.col --> 

                            <?php  } ?>

                              <div class="col-md-12">
                              <h5 class="mt-3"> Comments</h5>
                            
                                <div class="user-block mt-3">
                                   <div class="user-blockImgBorder">
                                    <div class="user-blockImg">
                                          <?php if (!empty($user['profile_img'])) {?>
                                          <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                          <?php  }else{ ?>
                                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                          <?php } ?>
                                    </div>
                                    </div>
                                    <span class="username">
                                        <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"> <?php echo $user['username']; ?> comment on - <?php echo $users->timeAgo($user['created_on2']) ;?></a>
                                        <!-- <span class="float-right">44 <i class="fa fa-heart"></i></span> -->
                                        <?php if($likes['like_on'] == $user['fund_id']){ ?>
                                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-crowfundraising-btn more float-right text-sm  mr-1"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-fund="<?php echo $user['fund_id']; ?>"  data-user="<?php echo $user['user_id']; ?>"><span class="likescounter "><?php echo $user['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                        <?php }else{ ?>
                                           <span <?php if(isset($_SESSION['key'])){ echo 'class="like-crowfundraising-btn more float-right text-sm mr-1"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-fund="<?php echo $user['fund_id']; ?>"  data-user="<?php echo $user['user_id']; ?>" ><span class="likescounter"> <?php if ($user['likes_counts'] > 0){ echo $user['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                        <?php } ?>
                                        <!-- //Jonathan Burke Jr. -->
                                    </span>
                                    <span class="description"> nice to donate keep up </span>
                                </div> <!-- /.user-block -->

                                <div class="input-group mt-2">
                                    <input class="form-control form-control-sm" id="commentField" type="text"
                                        name="comment" data-crowfund="<?php echo $user['fund_id'];?>"
                                        placeholder="Reply to  <?php echo $user['username'].$user['fund_id'] ;?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                                            aria-label="Username" aria-describedby="basic-addon1"  <?php if(isset($_SESSION['key'])){ echo 'id="CrowfundpostComment"'; }else{ echo 'id="login-please" data-login="1"'; } ?>>
                                            <span class="fa fa-arrow-right text-muted"></span></span>
                                    </div>
                                </div> <!-- input-group -->
                                 
                              </div><!-- /.col -->
                              <div class="col-md-12">
                                <span id="responseComment"></span>
                                 <?php if (count($comment) > 5) { ?>
                                <!-- <div class="tweet-show-popup-comment-wrap"> -->
                                <div id="comments" style="height:300px;" class="large-2">
                                        <!--COMMENTS-->
                                      <?php  foreach ($comment as $user) { 
                                            $likes= $crowfund->Crowfundraising_comment_like($user_id,$user['comment_id']);
                                          ?>
                                            <div class="user-block mt-3" id="userComment<?php echo $user['comment_id']; ?>">
                                                <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                        <?php if (!empty($user['profile_img'])) {?>
                                                        <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                                        <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                        <?php } ?>
                                                </div>
                                                </div>
                                                <span class="username">
                                                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"> <?php echo $user['username']; ?> comment on - <?php echo $users->timeAgo($user['comment_at']) ;?></a>
                                                    <!-- <span class="float-right">44 <i class="fa fa-heart"></i></span> -->
                                                     <!-- <span class="float-right">44 <i class="fa fa-heart"></i></span> -->
                                                    <?php if($likes['like_on_'] == $user['comment_id']){ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-crowfundraisingUser-btn more float-right text-sm  mr-1"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>"><span class="likescounter "><?php echo $user['likes_counts_'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                                    <?php }else{ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="like-crowfundraisingUser-btn more float-right text-sm mr-1"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>" ><span class="likescounter"> <?php if ($user['likes_counts_'] > 0){ echo $user['likes_counts_'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                                    <?php } ?>

                                                    <?php if($user["comment_by"] === $user_id){ ?>
                                                        <span class="deleteCrowFundraisingComment more" data-fund="<?php echo $user["fund_id"]; ?>" data-comment="<?php echo $user["comment_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                    <?php }else { echo ''; } ?>
                                                    <!-- //Jonathan Burke Jr. -->
                                                </span>
                                                <span class="description"> <?php echo $user['comment']; ?>  </span>
                                            </div> <!-- /.user-block -->
                                    <?php } ?>
                                </div><!-- comments -->

                                <?php  }else{ ?>

                                <!-- <div class="tweet-show-popup-comment-wrap"> -->
                                <div id="comments">
                                        <!--COMMENTS-->
                                      <?php  foreach ($comment as $user) { 
                                            $likes= $crowfund->Crowfundraising_comment_like($user_id,$user['comment_id']);
                                          ?>
                                            <div class="user-block mt-3" id="userComment<?php echo $user['comment_id']; ?>">
                                                <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                        <?php if (!empty($user['profile_img'])) {?>
                                                        <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                                        <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                        <?php } ?>
                                                </div>
                                                </div>
                                                <span class="username">
                                                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"> <?php echo $user['username']; ?> comment on - <?php echo $users->timeAgo($user['comment_at']) ;?></a>
                                                    <!-- <span class="float-right">44 <i class="fa fa-heart"></i></span> -->
                                                     <!-- <span class="float-right">44 <i class="fa fa-heart"></i></span> -->
                                                    <?php if($likes['like_on_'] == $user['comment_id']){ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-crowfundraisingUser-btn more float-right text-sm  mr-1"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>"><span class="likescounter "><?php echo $user['likes_counts_'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                                    <?php }else{ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="like-crowfundraisingUser-btn more float-right text-sm mr-1"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>" ><span class="likescounter"> <?php if ($user['likes_counts_'] > 0){ echo $user['likes_counts_'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                                    <?php } ?>

                                                    <?php if($user["comment_by"] === $user_id){ ?>
                                                        <span class="deleteCrowFundraisingComment more" data-fund="<?php echo $user["fund_id"]; ?>" data-comment="<?php echo $user["comment_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                    <?php }else { echo ''; } ?>
                                                    <!-- //Jonathan Burke Jr. -->
                                                </span>
                                                <span class="description"> <?php echo $user['comment']; ?>  </span>
                                            </div> <!-- /.user-block -->
                                    <?php } ?>
                                </div><!-- comments -->

                                <?php  } ?>

                              </div><!-- col -->
                            </div><!-- /.row -->

                       </div><!-- /.col -->
                   </div><!-- /.row -->
                </div><!-- /.card-body -->
                <div class="card-footer text-muted">
                    Footer
                </div><!-- /.card-footer -->
            </div>


           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<?php } 