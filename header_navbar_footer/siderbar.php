<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <?php if(isset($_SESSION['key'])) { ?>

        <div class="user-panel">
          <div class="pull-left image">
            <!-- <img src="user2-160x160.jpg" class="rounded-circle" alt="User Image"> -->
            <?php if (!empty($user['profile_img'])) {?>
            <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="rounded-circle" alt="User Image">
            <?php  }else{ ?>
              <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image" class="rounded-circle">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <!-- <p>Alexander Pierce</p> -->
            <p><a href="<?php echo $user['username']; ?>"><?php echo $user['username'];?></a></p>
            <a href="#">
              <?php if ($user['chat'] == 'on') { ?>
                      <i class="fa fa-circle text-success"></i>  Online</a>
							<?php }else {?>
                      <i class="fa fa-circle text-danger"></i>  0ffline</a>
							<?php } ?>
          </div>
        </div>
        <!-- search form -->
        <div class="search-result-siderbar"></div>
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control search-siderbar formnsider" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat formnsider"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <?php } ?>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

        <?php if(!isset($_SESSION['key'])) { ?>
          <!-- <li class="treeview"> -->
          <li>
            <a data-login="1" href="<?php echo LOGIN;?>">
              <i class="fa fa-user"></i> <span>Login</span>
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"><i class="fa fa-lock"></i></small>
              </span>
            </a>
          </li>
        <?php } ?>
        
          <!-- <li class="header">MAIN NAVIGATION</li> -->
          <?php if(isset($_SESSION['key']) && isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dashboard.php"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
              <li><a href="dashboard_monetize.php"><i class="fa fa-circle-o"></i> Monetize v2</a></li>
            </ul>
          </li>

          <li>
            <a href="<?php echo NEWSFEED; ?>">
              <i class="fas fa-globe"></i><span class="more">
                 News-Feeds </span> 
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"> <i class="fa fa-level-up"></i></small>
              </span>
            </a>
          </li>

          <li>
            <a href="<?php echo PROMOTE_ADS; ?>">
              <!-- <i class="fas fa-dollar-sign"></i><span class="more"> -->
              <i class="fas fa-bullhorn"></i><span class="more">
                 <!-- Marketing Ads -->
                 Campaign Ads
                 </span> 
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"> <i class="fa fa-level-up"></i></small>
              </span>
            </a>
          </li>

          <li>
            <a href="<?php echo EVENTS; ?>">
              <!-- <i class="fas fa-dollar-sign"></i><span class="more"> -->
              <i class="fa fa-calendar"></i><span class="more">
                 <!-- Marketing Ads -->
                 Events
                 </span> 
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"> <i class="fa fa-level-up"></i></small>
              </span>
            </a>
          </li>

          <li class="treeview">
            <a href="<?php echo BALANCE; ?>">
              <i class="fas fa-coins"></i> <span>Balance</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo BALANCE; ?>"><i class="fa fa-circle-o"></i>Your Balance : 15,000 coins</a></li>
              <li><a href="<?php echo BALANCE; ?>"><i class="fa fa-circle-o"></i>Check Your Balance</a></li>
            </ul>
          </li>

          <?php } ?>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-hashtag"></i> <span>Hashtag</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <!-- <small class="label pull-right bg-green">new</small> -->
              </span>
            </a>
            <ul class="treeview-menu">
              <?php echo $trending->trends_hashtag(); ?>
              <!-- <li><a href="hashtag.php"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li> -->
            </ul>
          </li>
          <?php if(isset($_SESSION['key'])) { ?>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Profile</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <!-- <small class="label pull-right bg-green">new</small> -->
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="profile.php"><i class="fa fa-circle-o text-yellow"></i>Profile</a></li>
              <li><a href="profileEdit.php"><i class="fa fa-circle-o text-yellow"></i> Profile Edit</a></li>
            </ul>
          </li>

          <?php } ?>

          <li>
            <a class="d-none d-md-block" href="<?php echo NETWORK; ?>">
              <i class="fa fa-users"></i> <span>Network</span>
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"><i class="fa fa-search"></i></small>
              </span>
            </a>
            <a class="d-sm-block d-md-none d-lg-none" href="<?php echo NETWORK_RESPONSIVE; ?>">
              <i class="fa fa-users"></i> <span>Network</span>
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"><i class="fa fa-search"></i></small>
              </span>
            </a>
          </li>
          <!-- <li class="treeview active"> -->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Options</span>
              <span class="pull-right-container">
                <span class="badge badge-primary pull-right">10</span>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php echo $home->siderbar_option(); ?>
              <!-- <li><a href="top-nav.php"><i class="fa fa-circle-o text-yellow"></i> Job</a></li>
              <li><a href="fixed.php"><i class="fa fa-circle-o text-aqua"></i>Professional</a></li>
              <li><a href="boxed.php"><i class="fa fa-shopping-basket "></i>Marketplace</a></li>
              <li><a href="boxed.php"><i class="fa fa-money "></i> gushoraStartUp</a></li>
              <li><a href="fixed.php"><i class="fa fa-circle-o text-red"></i>Events</a></li>
              <li><a href="fixed.php"><i class="fa fa-heartbeat"></i>Fundraising</a></li>
              <li><a href="fixed.php"><i class="fa fa-microphone"></i>Entertainment</a></li>
              <li><a href="fixed.php"><i class="fa fa-cutlery"></i>Foodzana</a></li>
              <li><a href="fixed.php"><i class="fa fa-shopping-basket"></i>Cyamunara</a></li>
              <li><a href="fixed.php"><i class="fa fa-home"></i>House</a></li>
              <li><a href="fixed.php"><i class="fa fa-car"></i>Car</a></li>
              <li><a href="fixed.php"><i class="fa fa-building"></i>School</a></li> -->
            </ul>
        </li>
        <?php if (isset($_SESSION['key'])) { ?>
          <li>
            <a href="<?php echo SETTINGS; ?>">
              <i class="fa fa-gear"></i> <span>Setting</span>
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"><i class="fa fa-files-o"></i></small>
              </span>
            </a>
          </li>
          <li>
            <a href="javascript:void()">
              <i class="fab fa-facebook-messenger mr-1"></i><span class="people-message more" data-user="1">
                 Service Center </span> 
              <span class="pull-right-container" style="margin-right: 10px;">
                <small class="label pull-right"> <i class="fa fa-envelope-o"></i></small>
              </span>
            </a>
          </li>
         
        <?php } ?>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>