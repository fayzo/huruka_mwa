<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title>Fundraising</title>
<?php include "header_navbar_footer/header.php"?>

    <header class="blog-header py-2 mb-3 bg-light">
          <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
          <button type="button"  
          <?php 
            echo (isset($_SESSION['key']))?
             (!empty($subscription['fundraising_subscription']) && $users->subscription_deadline($subscription['fundraising_date_pay'],$subscription['fundraising_subscription']) == true )?
             'class="btn btn-light" id="add_for_help" data-fund="'.$_SESSION['key'].'"':'class="btn btn-light price-jobs" data-pricejob="fundraising"' 
             :' class="btn btn-light" id="login-please" data-login="1"';
            ?> > + add for help </button>
            <!-- <button type="button" class="btn btn-light" id="add_for_help" data-fund="'.$_SESSION['key'].'" value=""> + Add for help </button> -->
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Fundraising</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
           
          </div>
        </div>
      </header>

      
      <!-- Main content -->
      <section class="content container-fuild">

        <div class="row">
          <div class="col-md-2 mb-3 d-none d-md-block">
            <div class="sticky-top">
                <?php echo $trending->trends(); ?>
            </div>

          </div>

          <div class="col-sm-12 col-md-8 mb-4">
          <?php if (isset($_GET['fund_id']) && !empty($_GET['fund_id'])) {
                    if (isset($_SESSION['key'])) {
                        # code...
                        $user_id= $_SESSION['key'];
                    }else {
                    # code...
                    $username= $users->test_input('irangiro');
                    // $username= $users->test_input('$_REQUEST['username']');
                    $uprofileId= $home->usersNameId($username);
                    $profileData= $home->userData($uprofileId['user_id']);
                    $user_id= $profileData['user_id'];
                    // echo $user_id;
                    }
                    $fund_id = $_GET['fund_id'];
                    $user= $fundraising->fundFecthReadmore($fund_id);
                    $comment= $fundraising->Fundraising_comments($fund_id);
                    $donates= $fundraising->recentFundraisingDonate($fund_id);
                    $likes= $fundraising->Fundraisinglikes($user_id,$user['fund_id']);
                    
    ?>
            <div class="card">
                <div class="card-header">
                <a class="btn btn-success btn-sm  float-right" href="<?php echo BASE_URL_PUBLIC.'fundraising' ;?>" >Back</a>

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
                                 href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?></a>
                             <!-- //Jonathan Burke Jr. -->
                         </span>
                         <!-- <span class="description">Shared publicly - < ?php echo $home->timeAgo($user['posted_on']); ?></span> -->
                         <span class="description">Shared publicly - <?php echo $users->timeAgo($user['created_on2']) ;?></span>
                     </div> <!-- /.user-block -->
                </div> <!-- /.card-header -->

                <div class="card-body">
                   <div class="row reusercolor p-2">
                       <div class="col-md-6">
                       <div class=" pr-5">
                           <div id="jssor_1"  style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:980px;overflow:hidden;visibility:hidden;">
                                <!-- Loading Screen -->
                                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo BASE_URL_LINK;?>image/img/spin.svg" />
                                </div>
                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:980px;overflow:hidden;"> <!--width:980px;height:380px -->
                                      <?php 
                                        $file = $user['photo']."=".$user['other_photo'];
                                        $expode = explode("=",$file);
                                        $splice= array_splice($expode,0,10);
                                        for ($i=0; $i < count($splice); ++$i) { 
                                            ?>
                                      <div style="width: 100%;height: auto;" class="imageFundViewPopup more"  data-fund="<?php echo $user["fund_id"] ;?>">
                                      <img data-u="image" src="<?php echo BASE_URL_PUBLIC."uploads/fundraising/".$splice[$i] ;?>"
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
                          <div id="link_" class="show-read-more">
                            <?php 

                                if (strlen($user["text"]) > 200) {
                                    // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                $tweettext = substr($user["text"], 0, 200);
                                $tweetstatus = substr($user["text"], 0, strrpos($tweettext, ' ')).'
                                <span class="readtext-tweet-readmore"><a class="link_color" href="javascript:void(0)" id="readtext-tweet-readmores" data-tweettext="'.$user["fund_id"].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                echo $home->getTweetLink($tweetstatus);
                                }else{
                                echo $home->getTweetLink($user["text"]);
                                }  

                                if (strlen($user["text"]) > 200) {
                                    // $tweetstatus = substr($tweet['status'],0, strpos($tweet['status'], ' ', 200)).'
                                    $tweettext = substr($user["text"], 0, 200);
                                    $tweetstatus = substr($user["text"], strrpos($tweettext, ' '));
                                    echo '<span style="display: none;" class="more-text view-more-text'.$user["fund_id"].'">'.$home->getTweetLink($tweetstatus).'</span>';
                                }  
                                ?>
                            </div>
                       </div>
                       <?php 
                        $expodefile = explode("=",$user['photo']."=".$user['other_photo']); 
                        $photo_title=  explode("=",$user["photo_Title"]);

                        $fileActualExt= array();
                        for ($i=0; $i < count($expodefile); ++$i) { 
                            $fileActualExt[]= strtolower(substr($expodefile[$i],strrpos($expodefile[$i],'.')+1));
                        }
                        $image= array('jpg','jpeg','png','gif'); // valid extensions
                        $allower_ext= array('jpg','jpeg','png','gif'); // valid extensions

                    if (array_diff($fileActualExt,$allower_ext) == false) { 
                            # code...
                                
                            $fileActualExt_image =array_intersect($fileActualExt,$image);
                            $count_image =count(array_intersect($fileActualExt_image,$image));
                            $filePathinfo_image=array();

                            
                    if(!empty($fileActualExt_image)) { 
                            
                        foreach ($expodefile as $file_image) {
                            # code...
                            $filePathinfo = pathinfo($file_image);

                            if (in_array($filePathinfo['extension'],$fileActualExt_image)) {
                                # code...
                                $filePathinfo_image[]= $filePathinfo['basename'];
                            }
                        }


                    if ($count_image === 1) { ?>

                        <div class="row mb-1">
                                <?php $expode = $filePathinfo_image; ?>
                            <div class="col-12 more">
                                <img style="width: 100%;height: auto;" class="imageFundViewPopup more"  data-fund="<?php echo $user["fund_id"] ;?>"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/fundraising/".$expode[0] ;?>" >
                                    <div class="h5"><i><?php echo $photo_title[0]; ?></i></div>
                            </div>
                        </div>

                    <?php
                        }else if($count_image === 2){?>
                        <div class="row mb-2 more">
                                <?php $expode = $filePathinfo_image;
                                    $splice= array_splice($expode,0,2);
                                    for ($i=0; $i < count($splice); ++$i) { 
                                    ?>
                            <div class="col-12 mb-2">
                                <img style="width: 100%;height: auto;" class="imageFundViewPopup more"  data-fund="<?php echo $user["fund_id"] ;?>"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/fundraising/".$splice[$i] ;?>" >
                                    
                                    <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                            </div>
                                <?php }?>
                        </div>

                    <?php }else if($count_image === 3 || $count_image > 3){?>
                        <div class="row mb-2 more">
                            <?php $expode = $filePathinfo_image;
                                $splice= array_splice($expode,0,1);
                                ?>
                        <div class="col-6">
                            <img style="width: 100%;height: auto;" class="imageFundViewPopup more"  data-fund="<?php echo $user["fund_id"] ;?>"
                                src="<?php echo BASE_URL_PUBLIC."uploads/fundraising/".$splice[0] ;?>" >
                                <div><i><?php echo $photo_title[0]; ?></i></div>
                        </div>
                        <!-- /.col -->

                        <div class="col-6">
                            <div class="row mb-2 more">
                                    <?php 
                                    $expode = $filePathinfo_image;
                                    // var_dump($expode);
                                    $splice= array_splice($expode,1,2);
                                    // var_dump($splice);
                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                <div class="col-6">
                                    <img style="width: 100%;height: auto;" class="imageFundViewPopup more"  data-fund="<?php echo $user["fund_id"] ;?>"
                                        src="<?php echo BASE_URL_PUBLIC."uploads/fundraising/".$splice[$i] ;?>" >
                                     <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                
                                </div>
                                    <?php }?>

                            </div>
                            <!-- /.row -->
                            <div class="row more">
                                    <?php 
                                    $expode = $filePathinfo_image;
                                    $splice= array_splice($expode,3,2);
                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                <div class="col-6">
                                   <img style="width: 100%;height: auto;" class="imageFundViewPopup more"  data-fund="<?php echo $user["fund_id"] ;?>"
                                        src="<?php echo BASE_URL_PUBLIC."uploads/fundraising/".$splice[$i] ;?>" >
                                        
                                        <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                
                                </div>
                                    <?php }?>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    
                        <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <span class="btn btn-primary imageFundViewPopup  float-right" data-fund="<?php echo $user["fund_id"] ;?>" > View More photo  <i class="fa fa-picture-o"></i> >>> </span>
                        </div>
                    </div>
                    <!-- /.row -->
                        
                    <?php }  } } ?>

                     </div> <!-- col-md-6  -->
                     </div> <!-- col-md-6  -->
                     <div class="col-md-6">
                            <span><?php echo number_format($user['money_raising']).' Frw Raised out of<span class="float-right text-right"> '.number_format($user['money_to_target']).' Frw <span class="text-success">Goal </span></span>'; ?>  </span>
                            <div class="progress " style="height: 6px;">
                                  <?php echo $users->Users_donationMoneyRaising($user['money_raising'],$user['money_to_target']); ?>
                                <!-- <div class="progress-bar  bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> -->
                            </div>
                            <!-- 30 months -->
                            <p>Raised by <?php echo $user['donate_counts']; ?> people in <?php echo $users->timeAgo($user['created_on2']);?> <span class="float-right text-right"><?php echo $users->donationPercetangeMoneyRaimaing($user['money_raising'],$user['money_to_target']); ?> /100 %</span></p>
                            <button type="button"  <?php if(isset($_SESSION['key'])){ echo 'class="btn btn-primary donation-fundraising-btn"'; }else{ echo 'class="btn btn-primary" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id']; ?>" data-fund="<?php echo $user['fund_id']; ?>">Donate Now</button><br>
                            
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
                                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?> | Created  on <?php echo $users->timeAgo($user['created_on2']) ;?></a>
                                    <!-- //Jonathan Burke Jr. -->
                                </span>
                                <span class="description" ><span <?php if(isset($_SESSION['key'])){ echo 'class="people-message more"'; }else{ echo 'id="login-please" class="more" data-login="1"'; } ?>  data-user="<?php echo $user['user_id2'];?>"><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </span> | <i class="fa fa-tag mr-1"></i><?php echo $user['categories_fundraising'] ;?></span>
                                <span class="description"><i class="fa fa-map-marker mr-1"></i> <?php echo $user['country1'] ;?> | <?php echo $user['city'] ;?> | <?php echo $user['namedistrict'] ;?>  </span>
                            </div> <!-- /.user-block -->

                            <h5 class="mt-3"> Recent Donation (<?php echo $fundraising->CountFundraisingRaising($user['fund_id']); ?>)</h5>
                            <div class=" row mt-1">

                               <?php if (count($donates) > 6) {  ?>
                                
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
                                            <a href="<?php echo BASE_URL_PUBLIC.$donate['username'] ;?>"><?php echo number_format($donate['price_donate']); ?> Frw </a> <span class="float-right mr-2"><i class="fa fa-heart" ></i></span>
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
                                            <a <?php echo (isset($_SESSION['approval']) && $_SESSION['approval'] === 'on')? 'href="javascript:void(0)"':'href="'.BASE_URL_PUBLIC.$donate['username'].'"';?> ><?php echo number_format($donate['price_donate'],2); ?> Frw <span class="float-right mr-2"><i class="fa fa-heart" ></i></span></a>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description"><?php echo $donate['comment']; ?> </span>
                                        <span class="description">donated on <?php echo $users->timeAgo($donate['created_on3']) ;?></span>
                                    </div> <!-- /.user-block -->
                                    
                                    <?php } ?>
                                </div><!-- /.col --> 

                            <?php  } ?>

                              <div class="col-md-12">
                              <h5 class="mt-3"> Comments (<?php echo $fundraising->CountFundraisingComment($user['fund_id']); ?>)</h5>
                            
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
                                        <?php if($likes['like_on'] == $user['fund_id']){ ?>
                                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraising-btn more float-right text-sm  mr-1"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-fund="<?php echo $user['fund_id']; ?>"  data-user="<?php echo $user['user_id']; ?>"><span class="likescounter "><?php echo $user['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                        <?php }else{ ?>
                                           <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraising-btn more float-right text-sm mr-1"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-fund="<?php echo $user['fund_id']; ?>"  data-user="<?php echo $user['user_id']; ?>" ><span class="likescounter"> <?php if ($user['likes_counts'] > 0){ echo $user['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                        <?php } ?>
                                        <!-- //Jonathan Burke Jr. -->
                                    </span>
                                    <span class="description"> donate </span>
                                </div> <!-- /.user-block -->
                         
                                <div class="input-group mt-2">
                                    <input class="form-control form-control-sm" id="commentField" type="text"
                                        name="comment" data-fund="<?php echo $user['fund_id'];?>"
                                        placeholder="Reply to  <?php echo $user['username'] ;?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                                            aria-label="Username" aria-describedby="basic-addon1" <?php if(isset($_SESSION['key'])){ echo 'id="funding_Comment"'; }else{ echo 'id="login-please" data-login="1"'; } ?> >
                                            <span class="fa fa-arrow-right text-muted" ></span></span>
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
                                         $likes= $fundraising->Fundraising_comment_like($user_id,$user['comment_id']);
                                        ?>
                                            <div class="user-block mt-3"  id="userComment<?php echo $user["comment_id"]; ?>">
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
                                                  <a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"> <?php echo $user['username']; ?> comment on - <?php echo $users->timeAgo($user['comment_at']) ;?>
                                                     <!-- <i class="fa fa-share more" aria-hidden="true"></i> -->
                                                  </a>
                                                <!-- <span class="float-right mr-1">44 <i class="fa fa-heart"></i> -->

                                                    <?php if($likes['like_on_'] == $user['comment_id']){ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraisingUser-btn more float-right text-sm  mr-1"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>"><span class="likescounter "><?php echo $user['likes_counts_'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                                    <?php }else{ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraisingUser-btn more float-right text-sm mr-1"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>" ><span class="likescounter"> <?php if ($user['likes_counts_'] > 0){ echo $user['likes_counts_'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                                    <?php } ?>

                                                    <?php if($user["comment_by"] === $user_id){ ?>
                                                        <span class="deleteFundraisingComment more" data-fund="<?php echo $user["fund_id"]; ?>" data-comment="<?php echo $user["comment_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                    <?php }else { echo ''; } ?>
                                                </span>
                                                    <!-- //Jonathan Burke Jr. -->
                                                </span>
                                                <span class="description"> <?php echo $user['comment']; ?>  </span>
                                            </div> <!-- /.user-block -->
                                    <?php } ?>
                                </div><!-- comments -->

                                <?php  }else{ ?>
                                <div id="comments">
                                        <!--COMMENTS-->
                                      <?php  foreach ($comment as $user) { 
                                               $likes= $fundraising->Fundraising_comment_like($user_id,$user['comment_id']);
                                          ?>
                                            <div class="user-block mt-3" id="userComment<?php echo $user["comment_id"]; ?>">
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
                                                <!-- <span class="float-right mr-1">44 <i class="fa fa-heart"></i> -->
                                                     <?php if($likes['like_on_'] == $user['comment_id']){ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraisingUser-btn more float-right text-sm  mr-1"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>"><span class="likescounter "><?php echo $user['likes_counts_'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                                    <?php }else{ ?>
                                                        <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraisingUser-btn more float-right text-sm mr-1"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-comment="<?php echo $user['comment_id']; ?>"  data-user="<?php echo $user['user_id']; ?>" ><span class="likescounter"> <?php if ($user['likes_counts_'] > 0){ echo $user['likes_counts_'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                                    <?php } ?>

                                                    <?php if($user["comment_by"] === $user_id){ ?>
                                                        <span class="deleteFundraisingComment more" data-fund="<?php echo $user["fund_id"]; ?>" data-comment="<?php echo $user["comment_id"]; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                    <?php }else { echo ''; } ?>
                                                </span>
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


            <?php } ?>

          </div>
          <!-- col -->

          <div class="col-md-2 d-none d-md-block">
            <!-- whoTofollow: user whoTofollow style 1 -->
            <div class="sticky-top">
               <?php echo $home->options(); ?>
            </div>
          
          </div>
          <!-- col -->
        </div>
        <!-- row -->

      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>
