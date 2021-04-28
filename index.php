
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title>Home</title>
<?php include "header_navbar_footer/header.php"?>

      <!-- Main content -->
      <section class="content container">

        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block">

          <?php if (isset($_SESSION['key'])){
                  echo $home->userProfile($user_id);

                  echo $trending->trends();
            } ?>
            
            <!-- Profile Image -->
            
            <div class="sticky-top">
              <?php echo $job->jobsfetch() ;?>
            </div>

          </div>
          <div class="col-md-6 mb-4">
          <?php if (isset($_SESSION['key'])){ ?>

            <div id="response-posts"></div>
            <div class="card  borders-tops mb-4">
              <div class="card-body message-color" style="padding-bottom: 0rem;">
                <form method="post" id="post_form" enctype="multipart/form-data">
                  <input type="hidden" name="id_posts" id="id_posts" value="<?php echo $_SESSION['key'];?>">
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
                    <span class="username" style="margin-left: 50px">
                      <textarea class="status" name="status" id="status" placeholder="Type Something here!" rows="4"
                        cols="50"></textarea>
                      <div class="hash-box">
                        <ul>
                        </ul>
                      </div>
                    </span>
                  </div>

                  <div class="message-footer text-muted mb-2">
                    <div class="t-fo-left">
                          <!-- accept="image/*" 
                          accept=".png,.jpg,.jpeg"
                          accept="audio/*| video/* |image/* | MIME_type"
                          accept="audio/*,video/*,image/*"
                          accept="image/png, image/jpg, image/jepg, image/gif" -->
                      <ul>
                        <!-- <input type="file" name="files[]" id="file" accept="image/*" onChange="displayImage(this)" multiple > -->
                        <input type="file" name="files[]" id="file" accept="image/*" onChange="displayImageNameSize(this)" multiple >
                        <?php if(isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?>
                        <li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
                          <span class="tweet-error">
                            <span style="color: red;" id="empty-posts"></span>
                          </span>
                        </li>
                        <?php } ?>
                      </ul>

                    </div>
                    <div class="t-fo-right">
                      <span id="count">10000</span>
                      <input <?php echo (isset($_SESSION['key']))?'type="submit"':'type="button" id="login-please" data-login="1"';?> class="btn main-active" name="tweet" value="Post">
                    </div>
                    <!--  progress-xs -->
                    <div id="add-photo0" class="row">
                    </div>
                    <span class="progress progress-hide" style="display: none;">
                      <span class="progress-bar bg-danger" role="progressbar" style="width:0%;" id="pro"
                        aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><span> completed <span
                            class="fa fa-check"></span></span></span>
                    </span>
                  </div>
                </form>
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          <?php } ?>

          <?php if (!isset($_SESSION['key'])) { ?>
              <div class="card mb-3">
                <div class="card-body main-active">
                  <a class="text-light" href="https://flutterwave.com/pay/irangirogtxt" target='_blank'>>>> CLICK HERE TO SUPPORT US TO KEEP WORKING THIS SITE IRANGIRO</a>
                </div>
              </div>
            <?php } ?>

          <?php if(isset($_SESSION['key']) && $home->isClosed($_SESSION['key']) == true) { ?>
              <div class="card borders-tops card-profile card1 mb-3">
                  <div class="card-body">
                      <h4>Your Closed This Account </h4>
                      <p> No one can see your posts if you don't deactive your account</p>
                      <a href="<?php echo SETTINGS;?>"> Click here to go back.</a>
                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          <?php  } ?>

          <?php if (isset($_SESSION['key'])) { ?>

            <div class="posted">
            <!-- Box Comment -->
              <div class="card  borders-tops card-profile card1">
                  <div class="card-body message-color">
                    <?php echo $posts_home->tweets($user_id,15); ?> 
                    <!-- Post -->
                  </div>
              </div>
            </div>
            
            <div class="loading-div text-center mt-2">
                <img id="loader" src="<?php echo BASE_URL_LINK."image/img/"?>loading.svg" style="display: none;"/> 
            </div>
        
          <?php }else{ ?>
          
          
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

          <?php } ?>

          </div>
          <!-- col -->

          <div class="col-md-3 d-none d-md-block">
            <!-- whoTofollow: user whoTofollow style 1 -->
            <?php if (isset($_SESSION['key'])){
                    echo  $follow->whoTofollow($user_id,$user_id); ?>

                    <?php echo $home->options(); ?>
            <?php  } ?>
                 

            <div class="sticky-top">
               <?php echo $newsfeeds->newsfeedsmall(); ?>
            </div>
          
          </div>
          <!-- col -->
        </div>
        <!-- row -->

      </section>
      <!-- /.content -->


<?php include "header_navbar_footer/footer.php"?>
