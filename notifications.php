<?php include "header_navbar_footer/header_if_login.php"?>
<title>Notifications</title>
<?php include "header_navbar_footer/header.php"?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-6">
                <h1><i>Notification</i></h1>
            </div>
            <div class="col-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'"> User Profile</a></i></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            
            <div class="col-md-3 mb-3 d-none d-md-block">
                <div class="mb-2">
                    <?php echo $home->userProfile($user_id); ?>
                </div>
                <?php echo $trending->trends(); ?>
                <!-- Profile Image -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <div class="cards">
                    <div class="card-header borders-tops text-center p-2 message-color">
                        <h3><i> Notification</i></h3>
                    </div><!-- /.card-header -->
                    <div class="card-body mb-2">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                    
                            <li class="time-label">
                                <span class="bg-danger text-light">
                                Your Timeline
                                    <!-- 10 Feb. 2014 -->
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                        <?php 
                              $notif= $notification->notifications($user_id);
                              // var_dump($notif);
                              foreach ($notif as $data): 
                                      if ($data['type'] == 'message'):
                        ?>
                            <li>
                                <i class="fa fa-envelope bg-primary text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                  <div class="card-body">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                        email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                  </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                           if ($data['type'] == 'follow'):
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-info text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                  <div class="card-body">
                                     <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['follow_on']) ;?></span>
                                    <div class="user-block">
                                        <div class="user-blockImgBorder">
                                            <div class="user-blockImg">
                                                 <?php if (!empty($data['profile_img'])) {?>
                                                  <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                  <?php  }else{ ?>
                                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                  <?php } ?>
                                            </div>
                                        </div> 
                                       <span class="username">
                                            <a
                                                href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description"> <div >Followed you on <!-- accepted your friend request --> </div></span>
                                    </div><!-- /.user-block -->
                                   
                                  </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                           if ($data['type'] == 'likes'):  ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-heart bg-danger text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                    <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a
                                                    href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <div>Likes your Post <!-- accepted your friend request --> </div></span>
                                        </div><!-- /.user-block -->
                                  </div><!-- /.card-header -->
                                  <div class="card-body">
                                    <?php echo $Notification_body->Notification_body_users($user_id,$data); ?>
                                  </div> <!-- /.card-body-->
                                </div> <!-- /.card  -->

                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                              if ($data['type'] == 'retweet'):  ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-retweet bg-success text-light"></i>

                                <div class="timeline-item card shadow-sm" style="background:white;">
                                    <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <div>Shares your Post <!-- accepted your friend request --> </div></span>
                                        </div><!-- /.user-block -->
                                    </div><!-- /.card-header -->

                             <div class="card-body">
                                <?php echo $Notification_body->Notification_body_users($user_id,$data); ?>
                            </div> <!-- /.card-body-->
                            </div> <!-- /.card  -->
                            </li>

                            <!-- END timeline item -->
                         <?php  endif; 
      
                              if ($data['type'] == 'mention'):  ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-at bg-purple text-dark "></i>
                                <!-- <i class="fa fa-at bg-warning text-light">@</i> -->
                              <div class="timeline-item card shadow-sm" style="background:white;">
                                <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a
                                                    href="<?php echo PROFILE ;?>"><?php echo $data['username'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <div>Mention Your name <!-- accepted your friend request --> </div></span>
                                        </div><!-- /.user-block -->
                                  </div><!-- /.card-header -->
                                  <div class="card-body">
                                  <?php echo $Notification_body->Notification_body_users($user_id,$data); ?>
                                  </div> <!-- /.card-body-->
                                </div> <!-- /.card  -->
                               
                            </li>
                            <!-- END timeline item -->
                        <?php  endif; 
      
                              if ($data['type'] == 'tweets_photo'):
                          ?>
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-success text-light">
                                    3 Jan. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera text-light" style="background-color:#6f42c1"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o text-light"></i> 2 days
                                        ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                    </h3>

                                    <div class="timeline-body">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <?php    endif; 
                             endforeach; ?>
                            <li >
                                <i class="fa fa-clock-o bg-info text-light"></i>
                            </li>
                        </ul>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
           
            <div class="col-md-3 d-none d-md-block">
                <?php echo $follow->whoTofollow($user_id,$user_id) ;?>
                
                <div class="sticky-top" style="top: 52px;">
                    <?php echo $home->options(); ?>
                </div>
            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>