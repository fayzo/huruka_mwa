<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title>Career</title>
<?php include "header_navbar_footer/header.php"?>

    <header class="blog-header py-2 mb-3 bg-light">
          <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
            <!-- <button type="button" class="btn btn-light" id="add_for_help" data-fund="'.$_SESSION['key'].'" value=""> + Add for help </button> -->
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Career</a>
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
          <?php 
         
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $user_id= $_GET['id'];
                $user= $home->userData($user_id);
    ?>
            
            <div class="container-fuild">
                <div class="row">

                    <div class="col-12">
                        <div class="card card-widget widget-user" style="height:150px;">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <?php if (!empty($user['cover_img'])) { ?>
                                <div class="widget-user-header text-white"
                                    style="background: url('<?php echo BASE_URL_LINK."image/users_cover_profile/".$user['cover_img'] ;?>')no-repeat center center;background-size:cover;">
                            <?php }else{ ?>
                                <div class="widget-user-header text-white"
                                    style="background: url('<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>')no-repeat center center;background-size:cover;">
                        <?php  } ?>
                                <!-- <h3 class="widget-user-username">Elizabeth Pierce</h3>  -->
                                <h3 class="widget-user-username"><?php echo $user['username']; ?></h3> 
                                <h5 class="widget-user-desc"><?php echo $user['categories_fields']; ?></h5>
                                <!-- web developers -->
                            </div>

                        </div>
                        <!-- /. card widget-user -->
                    </div>
                    <!-- column -->
                </div>
                <!-- row -->
            </div>
            <!-- container-fuild -->
            
        <div class="container bg-light">
            <div class="row mb-3" style="background:#fff">
                <div class="col-md-2 unemploy-profile">
                  <?php if (!empty($user['profile_img'])) {?>
                        <img class="rounded-circle " src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'];?>" alt="User Avatar">
                    <?php  }else{ ?>
                        <img class="rounded-circle" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Avatar">
                    <?php } ?>
                </div>
                <div class="col-md-1-3 mr-3 p-2">
                    <div><?php echo $user['username']; ?></div>
                    <!-- <h4>Elizabeth Pierce</h4> -->
                    <div><?php echo $user['country']; ?>
                    <i class="flag-icon flag-icon-<?php echo strtolower($user["country"]) ;?> h4 mb-0"
                             id="<?php echo strtolower($user["country"]) ;?>" title="us"></i>
                    </div>
                    <!-- <div>Rwanda</div> -->
                </div>
                <div class="col-md-1-3 border-left mr-4 p-2">
                    <div><?php echo $user['career']; ?></div>
                    <!-- Unemployment -->
                    <div><?php echo $user['years']; ?> years</div>
                </div>

                <div class="col-md-1-3 border-left p-2">
                    <div>Resume || CV</div>
                    <div>Cover letter</div>
                </div>
               
                <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
                <div class="col-md-1-3 border-left mr-4 p-2">
                    <div>Age</div>
                    <div><?php echo $user['age']; ?> years</div>
                </div>
                <div class="col-md-1-3 border-left mr-4 p-2">
                    <div>Status</div>
                    <div><?php echo $user['status_career']; ?></div>
                </div>
                <?php  } ?>

                <div class="col-md-1-3 p-2"> 
                    <a class="btn btn-success btn-sm  float-right" href="<?php echo BASE_URL_PUBLIC.'career_profession' ;?>" >Back</a>
                </div>

            </div>

            <section class="content-header" style="background:#e8e1e1">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="float-right text-right pt-3">
                            <ul class="list-inline mb-0">
                                <!-- <li class="list-inline-item h4 btn btn-outline-primary"><i><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Request</i></li> -->
                                <!-- <li class="list-inline-item h4 btn btn-outline-primary emailSent" data-user="< ?php echo $user['user_id'];?>"> <i>< ?php echo $user['email']; ?></i></li> -->
                                <li class="list-inline-item h4" ><a href="javascript:vois(0)" <?php if(isset($_SESSION['key'])){ echo 'class="people-message btn btn-primary"'; }else{ echo 'class="btn btn-primary" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id'];?>" > <i style="font-size: 14px;" class="fa fa-envelope-o"> Message </i></a></li>
                            </ul>
                            <div <?php if(isset($_SESSION['key'])){ echo 'class="h4 btn btn-outline-primary emailSent"'; }else{ echo 'class="h4 btn btn-outline-primary " id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id'];?>"><i>
                            <?php 
                            if (strlen($user["email"]) > 5) {
                            echo substr($user["email"],0,5).'****@***.com';
                            }else{
                            echo $user["email"];
                            } ?> 
                            <!-- < ?php echo $user['email']; ?> -->
                            </i></div>
                            <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
                            <div class="h4 btn btn-outline-primary" ><i class="fa fa-phone" aria-hidden="true"></i> <i><?php echo $user['phone']; ?> </i></div>
                             <?php  } ?>
                        
                        </div>

                        <div class="text-left pt-3">
                            <ul class="list-inline">
                            <?php
                             $course = $user['course'];
                             $expode = explode(",",$course);
                            for ($i=0; $i < 3; ++$i) { ?>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i><?php echo $expode[$i] ;?></i></li>
                            <?php } 
                            for ($i=4; $i < count($expode); ++$i) { ?>
                                <li class="list-inline-item h4 btn btn-outline-primary d-none d-md-inline"><i><?php echo $expode[$i] ;?></i></li>
                            <?php } ?>
                                <!-- <li class="list-inline-item h4 btn btn-outline-primary"><i> project management</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Account</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Business management</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Finance</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> Banking</i></li>
                                <li class="list-inline-item h4 btn btn-outline-primary"><i> purchase & sale</i></li> -->
                            </ul>
                        </div>

                    </div>
                </div>
            </section>

            <section>
                <h3>About Me</h3>
                <p><?php echo htmlspecialchars_decode($user['about']); ?></p>
            </section>

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
