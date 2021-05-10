
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title><?php echo $profileData['username'].' your profile'; ?></title>
<?php include "header_navbar_footer/header.php"?>

<?php $users->CountViewIn_profile('users',
array('countViewin_profile' => 'countViewin_profile +1', ),$profileData['user_id']); ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fuild">
          <div class="row">
              <div class="col-12">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <?php if (!empty($profileData['cover_img'])) { ?>
                        <div class="widget-user-header text-white"
                            style="background: url('<?php echo BASE_URL_LINK."image/users_cover_profile/".$profileData['cover_img'] ;?>')no-repeat center center;background-size:cover;">
                    <?php }else{ ?>
                        <div class="widget-user-header text-white"
                            style="background: url('<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>')no-repeat center center;background-size:cover;">
                  <?php  } ?>
                        <div class="widget-user-desc"><i class="fas fa-coins text-warning"></i> 35 Coins</div>
                        <h3 class="widget-user-username"><?php echo $profileData['username'] ;?></h3> <!-- Elizabeth Pierce -->
                        <?php $workname = $profileData['workname']; echo (!empty($workname)?'<h5 class="widget-user-desc">'.$workname.'</h5>
                                 ':'<h5 class="widget-user-desc">Member</h5>');?>
                    </div>
                    <div class="widget-user-image">
                        <?php if (!empty($profileData['profile_img'])) {?>
                        <img class="rounded-circle" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $profileData['profile_img'];?>"
                            alt="User Avatar">
                        <?php  }else{ ?>
                        <img class="rounded-circle" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Avatar">
                        <?php } ?>
                    </div>

                    <div class="widget-user-image-under">
                    </div>
                    <div class="card-footer">
                        <div class="description">
                            <h5 class="description-header count-followers">0</h5>
                            <span class="description-text"><a href="javascript:void()">FOLLOWERS</a></span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description ">
                            <h5 class="description-header count-following">0</h5>
                            <span class="description-text"><a href="javascript:void()"> FOLLOWING</a></span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description">
                            <h5 class="description-header"> 0</h5>
                            <span class="description-text"><a href="javascript:void()"> POSTS</a></span>
                        </div>
                        <!-- /.description-block -->
                        <!-- /.description-block -->
                        <div class="description">
                            <h5 class="description-header"> 0</h5>
                            <span class="description-text">LIKES</span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description">
                            <h5 class="description-header">0</h5>
                            <span class="description-text">VIEWS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.footer -->
                </div>
                <!-- /. card widget-user -->
            </div>
            <!-- column -->
          </div>
          <!-- row -->
      </div>
      </section>
      <section class="content-header">
        <div class="row">
          <div class="col-3">
                <h5><i>Profile</i></h5>
          </div>
          <div class="col-9">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                    <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on'){ ?>
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])) { echo BASE_URL_PUBLIC.$profileData['username'].'.album' ; }else{ echo LOGIN; } ?>">Photo</i></a></li>
                    <?php } 
                    
                    if (isset($_SESSION['key'])){ ?>
                      <?php if ($profileData['user_id'] != $_SESSION['key']) { ?>
                    <li class="breadcrumb-item"><span class="people-message more" data-user="<?php echo $profileData['user_id'];?>"><a href="javascript:void(0);" ><i class="fa fa-envelope-o"></i> Message </a></span></li>
                    <?php } } ?>
                    <li class="breadcrumb-item"><i> <?php echo $follow->followBtn($profileData['user_id'],$user_id,$profileData['user_id']) ;?></i></li>
                    <li class="breadcrumb-item "><i>
                    <span class="username tooltips" style="display:inline-block">
                    <!-- < ?php if($user_id == $_SESSION['key']) { ?>  -->
                    <?php if($user_id) { ?> 
                            <ul><li>
                                <a href="#" >Send Reward <i class="fas fa-coins text-warning"></i> Coins</a>
                                <ul style="left: -100px;right: -80px;"><li><?php echo Follow::coins_recharge($profileData['user_id'],$user_id,$user['username'],$profileData['username']); ?></li></ul>
                                </li>
                            </ul>
                    <?php } ?> 
                    </span>
                    </i>
                    </li>
                </ol>
          </div>
      </div>
      </section>
      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block">
                <div class="sticky-top" style="top: 52px;">
                  <?php echo $trending->trends(); ?>
                </div>
          </div>
          <div class="col-md-6">
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <!-- Box Comment -->
                        <?php echo $home->isClosed($_SESSION['key']); ?>
                        
                        <div class="card borders-tops mb-3"> 
                            <div class="card-body message-color">
                            <div class="post">

                            <!-- <div class="user-block">
                                <div class="user-blockImgBorder">
                                <div class="user-blockImg">
                                    <img src="< ?php echo BASE_URL_LINK."image/users_profile_cover/irangiro.png" ;?>" alt="User Image">
                                </div>
                                </div>
                                <span class="username">
                                    <a href="< ?php echo PROFILE ;?>">Irangiro </a>
                                    <span><img src="< ?php echo BASE_URL_LINK.'image/img/verified-light.png' ; ?>" width="15px"></span>
                                    < ?php echo self::followBtns(1,$user_id,1); ?>
                                </span>
                                <span class="description">Public Figure | Content Creator</span>
                            </div> -->
                            <!-- /.user-block -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h3 >Welcome To irangiro</h3>
                                            <div>Meet People <br> & <br> Explore new connection</div>
                                        </div>
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
                            <!-- <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i>
                                    Share</a>
                                <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i>
                                    Like</a>
                                <span class="float-right">
                                    <a href="#" class="link-black text-sm">
                                        <i class="fa fa-comments-o mr-1"></i> Comments ()
                                    </a>
                                </span>
                            </p>

                            <div class="input-group">
                                <input class="form-control form-control-sm" type="text"
                                    placeholder="Type a comment">
                                <div class="input-group-append">
                                    <span class="input-group-text btn" onclick="#" aria-label="Username"
                                        aria-describedby="basic-addon1"><i
                                            class="fa fa-arrow-right text-muted"></i></span>
                                </div>
                            </div> -->

                            </div>
                        </div>
                        </div>
                        <!-- /.post -->

                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-md-6 -->

          <div class="col-md-3">
            <div class="sticky-top" style="top: 52px;z-index:1000;">
               <?php echo $home->options(); ?>
            </div>
          </div>
          <!-- col -->
          
        </div>
        <!-- row -->

      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>