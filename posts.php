
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title><?php echo 'Post for '.$profileData['username']; ?></title>

<?php if($home->isClosed($profileData['user_id']) != true) {
    header('location: '.BASE_URL_PUBLIC.$profileData['username'].'.profile_close_account');
    // header('location: '.PROFILE_CLOSE_ACCOUNT.'');
} ?>

<?php include "header_navbar_footer/header.php"?>

      <!-- Main content -->
      <section class="content container">

      <div class="row">
          <div class="col-4">
                <h5><i> Your Post</i></h5>
          </div>
          <div class="col-8">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="< ?php if (isset($_SESSION['key'])){ echo BASE_URL_PUBLIC.$profileData['username'].'.album' ; }else{ echo LOGIN; } ?>">Photo</i></a></li> -->
                    <?php if (isset($_SESSION['key'])){ ?>
                      <?php if ($profileData['user_id'] != $_SESSION['key']) { ?>
                    <li class="breadcrumb-item"><span class="people-message more" data-user="<?php echo $profileData['user_id'];?>"><a href="javascript:void(0);" ><i class="fa fa-envelope-o"></i> Message </a></span></li>
                    <?php } } ?>
                    <li class="breadcrumb-item active"><i> <?php echo $follow->followBtn($profileData['user_id'],$user_id,$profileData['user_id']) ;?></i></li>
                </ol>
          </div>
      </div>

        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block ">
            <?php echo $home->userProfile($user_id); ?>

            <div class="sticky-tops">
                <div class="mb-3">
                  <?php echo $follow->FollowingListsProfile($profileData['user_id'],$user_id,$profileData['user_id']); ?>
                </div>
                <?php echo $job->jobsfetch() ;?>
            </div>
            <div class="sticky-top">
                  <?php echo $trending->trends(); ?>
            </div>
          </div>

          <div class="col-md-6">
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <!-- Box Comment -->
                        <div class="card card-profile card1">
                            <div class="card-body">
                                    <?php echo $Home_GetUsers->getUserTweet($profileData['user_id'],$user_id) ;?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-md-6 -->

          <div class="col-md-3 d-none d-md-block">
            <?php $follow->whoTofollow($profileData['user_id'],$profileData['user_id'])?>

            <div class="sticky-top" >
                <?php echo $home->options(); ?>
            </div>

          </div>
          <!-- col -->
        </div>
        <!-- row -->

      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>