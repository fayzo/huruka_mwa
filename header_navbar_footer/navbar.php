<header class="main-header">

      <div class="progress-container" id="progress-container" style="display:none">
          <div class="progress-top-bar" id="myBar" ></div>
      </div>
    <!-- Content Wrapper. Contains page content -->
      <!-- < ?php if($device_type == 'phone') { ?>
        <div class="ms-header__title main-active">
          < ?php } 
      if($device_type == 'computer') { ?>
        <div class="ms-header__title" style="position:absolute;z-index:1200;text-align: right;">
        < ?php } ?>
          <div class="banner">
            <h2> This is</h2>
            <span></span>
          </div>
          <div class="ms-slider">
            <ul class="ms-slider__words">
              <li class="ms-slider__word">Provide the back story, including date of founding, and who was involved </li>
              <li class="ms-slider__word">easy</li>
              <li class="ms-slider__word">powerful</li>
              <li class="ms-slider__word">simple</li>
            </ul>
          </div>
        </div> -->
      
      <!-- Logo -->
      <a href="<?php echo HOME; ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
        <!-- <img src="< ?php echo BASE_URL_LINK.'image/img/irangiro-blue-light.png'; ?>" > -->
        <img src="<?php echo BASE_URL_LINK.'image/img/irangiro-irg.png'; ?>" >
        <b>IR</b>G</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
        <img src="<?php echo BASE_URL_LINK.'image/img/irangiro-irg.png'; ?>">
        <b>irangiro </b></span>
        <!-- <b>irangiro </b>IRG</span> -->
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-expand navbar-static-top">
        <!-- Sidebar toggle button-->
        <?php  $self= basename($_SERVER['PHP_SELF']); if($self != 'login.php'){ ?>

        <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <?php  } ?>

        <a class="sidebar-toggle_" href="<?php echo HOME; ?>">
          <i class="fa fa-home"> </i>
          <span class="hidden-xs">Home</span>
          </a>

    <?php if (isset($_SESSION['key'])){ ?>
        
        <a class="sidebar-toggle_ addPostBtnNocreditor d-sm-block d-md-none d-lg-none" href="javascript:void(0)">
          <i class="fa fa-pencil"></i>
          <span class="hidden-xs">Post</span>
         </a>
        <a class="sidebar-toggle_ addPostBtn d-none d-md-block" href="javascript:void(0)">
          <i class="fa fa-pencil"></i>
          <span class="hidden-xs">Post</span>
         </a>
         <?php if (isset($_SESSION['job_user']) && $_SESSION['job_user'] === 'SME'){ ?>
        
        <a class="sidebar-toggle_ hidden-xs" href="<?php echo BUSINESS_POST_JOBS; ?>">
          <i class="fa fa-star"> </i>
          <span class="hidden-xs">Post Jobs</span>
        </a>
         <?php }else if (isset($_SESSION['job_user']) && $_SESSION['job_user'] === 'individual'){ ?>
        
        <a class="sidebar-toggle_ hidden-xs" href="<?php echo INDIVIDUAL_POST_JOBS; ?>">
          <i class="fa fa-star"> </i>
          <span class="hidden-xs">Post Jobs</span>
        </a>
        <?php } ?>
        
        <a class="sidebar-toggle_ d-none d-md-block" href="<?php echo NETWORK; ?>">
          <i class="fa fa-users"> </i>
          <span class="hidden-xs">Network</span>
         </a>
        <a class="sidebar-toggle_ d-sm-block d-md-none d-lg-none" href="<?php echo NETWORK_RESPONSIVE; ?>">
          <i class="fa fa-users"> </i>
          <span class="hidden-xs">Network</span>
         </a>

        <?php echo $trending->trends_hashtag_navbar(); ?>
        
         <?php if(isset($_SESSION['key']) && $_SESSION['key'] === $jobs['business_id'] ||
          $_SESSION['key'] === $fundraisingV['user_id2'] ||
          $_SESSION['key'] === $crowfundV['user_id2'] || 
          $_SESSION['key'] === $houseV['user_id3'] || 
          $_SESSION['key'] === $carV['user_id3'] || 
          $_SESSION['key'] === $icyamunaraV['user_id3'])
          { ?>
          <a class="sidebar-toggle_" href="<?php echo ACTIVITIES ;?>">
              <i class="fa fa-briefcase"></i>
            <span class="hidden-xs"> Activities</span>
          </a>

        <?php  } ?>

        <?php if(isset($_SESSION["cart_item"])){ ?>
          <a class="sidebar-toggle_"  style="position:relative" href="<?php echo SHOPPING ;?>">
              <i class="fa fa-shopping-cart"></i>
              <span id="messages1" style="position: absolute;top: 5px;left: 18px;">
              <?php if(count($_SESSION["cart_item"]) > 0){echo '<span  class="badge badge-danger navbar-badge">'.count($_SESSION["cart_item"]).'</span>'; } ?></span>
            <span class="hidden-xs"> Watch-List</span>
          </a>
        <?php  } ?>

        <div class="navbar-custom-menu ml-auto">
          <ul class="nav navbar-nav">

            <!-- coins-receive notification : style can be found in dropdown.less-->
            <!-- coins-receive notification : style can be found in dropdown.less-->
            <?php if($notific['total_coins'] > 0) { ?>

            <li class="dropdown messages-menu">
              <a href="javascript:void(0)" data-toggle="dropdown" id="coins-dropdown-menu">
                <i class="fas fa-coins"></i>
                <span ><?php if( $notific['total_coins'] > 0){echo '<span  class="badge badge-success">'.$notific['total_coins'].'</span>'; } ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header main-active">You have <span><?php if( $notific['total_coins'] > 0){echo '<span>'.$notific['total_coins'].'</span>'; }else{ echo 'no' ;} ?></span> users sent coins</li>
                <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu large-2" id="coins-menu-view" >
                    <!-- SOME TO BE RESPONSE HERE -->
                    <!-- end message -->
                  </ul>
                </li>
                <li class="footer"><a href="<?php echo BASE_URL_PUBLIC ;?>transaction_coins_view" >See All coins</a></li>
              </ul>
            </li>

            <?php } ?>

            <!-- coins-receive notification : style can be found in dropdown.less-->
            <!-- coins-receive notification : style can be found in dropdown.less-->

            <!-- JOBS : style can be found in dropdown.less-->
            <!-- JOBS : style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <a href="javascript:void(0)" data-toggle="dropdown" id="jobs-dropdown-menu">
                <i class="fas fa-edit"></i>
                <span><?php if($notific['total_jobs'] > 0){echo '<span  class="badge badge-success">'.$notific['total_jobs'].'</span>'; } ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header main-active">You have <span><?php if( $notific['total_jobs'] > 0){echo '<span>'.$notific['total_jobs'].'</span>'; }else{ echo 'no' ;} ?></span> jobs</li>
                <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu large-2" id="jobs-menu-view" >
                  </ul>
                </li>
                <li class="footer"><a href="<?php echo JOBS; ?>">See All Jobs</a></li>
              </ul>
            </li>
            <!-- END JOBS : style can be found in dropdown.less-->
            <!-- Messages: style can be found in dropdown.less-->

            <li class="dropdown messages-menu">
              <a href="javascript:void(0)" data-toggle="dropdown" id="messages-dropdown-menu">
                <i class="fa fa-envelope-o"></i>
                <span id="messages1"><?php if( $notific['totalmessage'] > 0){echo '<span  class="badge badge-success">'.$notific['totalmessage'].'</span>'; } ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header main-active">You have <span><?php if( $notific['totalmessage'] > 0){echo '<span>'.$notific['totalmessage'].'</span>'; }else{ echo 'no' ;} ?></span> messages</li>
                <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu large-2" id="messages-menu-view" >
                    <!-- <li>
                      start message
                      <a href="javascript:void(0)">
                        <div class="pull-left">
                          <img src="user2-160x160.jpg" class="rounded-circle" alt="User Image">
                        </div>
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li> -->
                    <!-- end message -->
                  </ul>
                </li>
                <li class="footer"  id='messagePopup'><a href="javascript:void(0)">See All Messages</a></li>
              </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
            <a href="javascript:void(0)" data-toggle="dropdown" id="notification-dropdown-menu">
              <i class="fa fa-bell-o"></i>
             <span id="notification1"><?php if( $notific['totalnotification'] > 0){echo '<span class="badge badge-warning navbar-badge">'.$notific['totalnotification'].'</span>'; } ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header main-active">You have  <span ><?php if($notific['totalnotification'] > 0){echo '<span >'.$notific['totalnotification'].'</span>'; }else{ echo 'no';} ?></span> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu large-2" id="notification-menu-view">
                </ul>
              </li>
              <li class="footer"><a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications" >View all</a></li>
            </ul>
            </li>

          <?php if (isset($_SESSION['key']) && $notific['total_FriendRequest'] > 0){ ?>

            <!-- Email: style can be found in dropdown.less -->
            <li class="dropdown email-menu messages-menu">
            <a href="javascript:void(0)" data-toggle="dropdown" id="FriendRequest-dropdown-menu">
            <i class="fa fa-user"></i>
            <span id="email1"><?php if($notific['total_FriendRequest'] > 0){echo '<span class="badge badge-warning navbar-badge">'.$notific['total_FriendRequest'].'</span>'; } ?></span>
            </a>
            <ul class="dropdown-menu">
            <li class="header main-active">You have  <span ><?php if($notific['total_FriendRequest'] > 0){echo '<span >'.$notific['total_FriendRequest'].'</span>'; }else{ echo 'no';} ?></span> Friend Request</li>
	          <li><span id="friendrequest_respone"></span></li>
            <li class="pl-3">
              <!-- inner menu: contains the actual data -->
              <ul class="whoTofollow-list menu large-2" id="FriendRequest-menu-view">
                <!-- <li>
                  <a href="javascript:void(0)">
                    <i class="fa fa-users text-info"></i> 5 new members joined today
                  </a>
                </li> -->
              </ul>
            </li>
            <li class="footer"><a href="<?php echo FRIEND_REQUEST ;?>" >View all</a></li>
            </ul>
            </li>

          <?php } ?>


         <?php if (isset($_SESSION['job_user']) || $notific['total_email_user_id'] > 0){ ?>

             <!-- Email: style can be found in dropdown.less -->
          <li class="dropdown email-menu messages-menu">
            <a href="javascript:void(0)" data-toggle="dropdown" id="email-dropdown-menu">
              <i class="fa fa-telegram"></i>
             <span id="email1"><?php if($notific['total_email'] > 0){echo '<span class="badge badge-warning navbar-badge">'.$notific['total_email'].'</span>'; } ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header main-active">You have  <span ><?php if($notific['total_email'] > 0){echo '<span >'.$notific['total_email'].'</span>'; }else{ echo 'no';} ?></span> email</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu large-2" id="email-menu-view">
                  <!-- <li>
                    <a href="javascript:void(0)">
                      <i class="fa fa-users text-info"></i> 5 new members joined today
                    </a>
                  </li> -->
                </ul>
              </li>
              <li class="footer"><a href="<?php echo BASE_URL_PUBLIC ;?>i.email" >View all</a></li>
            </ul>
          </li>
         <?php } ?>


            <!-- Tasks: style can be found in dropdown.less -->
            <li class="hidden-xs">
              <form action="#" method="get" class="sidebar-form" style="margin-top: 5px;">
                <div class="input-group input-group-sm">
                  <input type="text" name="search" id="search" class="form-control  search formnnavbar" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="button" name="search" class="btn btn-flat formnnavbar">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
                <div class="search-result"></div>
              </form>
            </li>

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <!-- <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"> -->
              <a href="javascript:void(0)" data-toggle="dropdown">
                <?php if (!empty($user['profile_img'])) { ?>
                <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="user-image rounded-circle" alt="User Image">
                <?php  }else{ ?>
                  <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="user-image rounded-circle" alt="User Image">
                <?php } ?>
                <span class="hidden-xs"><span id="welcome-json"></span> <?php echo $_SESSION['username'];?></span>
                <span class="hidden-xs" style="font-size:10px"><i class="fas fa-coins text-warning"></i>  <?php echo number_format($user['amount_coins'],2); ?> coins</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <?php if (!empty($user['cover_img'])) { ?>
                <li class="user-header" style="background: url('<?php echo BASE_URL_LINK ;?>image/users_cover_profile/<?php echo $user['cover_img'] ;?>') center center;background-size: cover; overflow: hidden; width: 100%;">
                  <?php }else{ ?>
                <li class="user-header" style="background: url('<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>') center center;background-size: cover; overflow: hidden; width: 100%;">
                <?php  } ?>

                <?php if (!empty($user['profile_img'])) { ?>
                  <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="rounded-circle" alt="User Image">
                  <?php }else{ ?>
                  <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="rounded-circle" alt="User Image">
                <?php  } ?>
                
                  <p>
                    <?php echo $user['username'];?>
                        <?php echo $home->bot_dark($user['bot'],$user['followers']) ;?>
                        <?php $workname = (strlen($user["workname"]) > 28)? substr($user["workname"],0,28).'..' : $user["workname"]; ?>
                        <br><?php echo (!empty($workname))? $workname :'Member';?>
                    <!-- - Member -->
                    <!-- <small>Member since Nov. 2012</small> -->
                    <small>Member since <?php echo $users->timeAgo($user['date_registry']); ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-4 text-center">
                      <a href="<?php echo SETTINGS;?>">Settings</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="<?php echo PROFILE_EDIT;?>">Profile Edit</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="<?php echo BASE_URL_PUBLIC.$user['username'];?>">Profile</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer main-active">
                  <div class="pull-left">
                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'];?>" class="btn btn-info btn-sm">Profile</a>
                  </div>
                  <div class="pull-left"style="margin-left:50px">
                    <a href="javascript:void(0)" id="recharge_coins" data-user="<?php echo $_SESSION['key']; ?>" class="btn btn-warning btn-sm text-white">Balance</a>
                  </div>
                  <div class="pull-right">
                    <!-- <a href="< ?php echo LOGOUT;?>" class="btn btn-danger btn-sm ">Sign out</a> -->
                    <a href="javascript:void(0)" id="logout-please" class="btn btn-danger btn-sm ">Sign out</a>
                  </div>
                </li>
                <li class="user-footer main-active d-sm-block d-md-block">
                  <div class="text-center">
                    <a href="<?php echo BALANCE;?>" style="font-size:13px"><i class="fas fa-coins text-warning"></i>  <?php echo number_format($user['amount_coins'],2); ?> coins</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <?php if(isset($_SESSION['approval_user_ui']) && $_SESSION['approval_user_ui'] === 'on' || isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?>
            <!-- < ?php if(isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?> -->

            <li class="hidden-xs">
              <a href="javascript:void(0)" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
            
            <?php } ?>
          </ul>
        </div>
          <?php }else{ ?>
            <!-- <a style="color:white;border: none;" class="btn btn-sm btn-outline-success ml-auto" id="login-please" data-login="1" href="javascript:void(0)"> -->
                <a style="color:white;border: none;" class="btn btn-sm btn-outline-success ml-auto" href="<?php echo LOGOUT ;?>">
                <i class="fa fa-user" aria-hidden="true"></i> login</a>
          <?php } ?>
      </nav>
    </header>
    <div class="progress progress-navbar m-0 fixed-top" style="height: 6px;display:none">
        <span class="progress-bar bg-info" role="progressbar"
            style="width:0%;" id="progress_width" aria-valuenow="" aria-valuemin="0"
            aria-valuemax="100"></span>
    </div>