
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' Marketing Place'; ?></title>
<?php include "header_navbar_footer/header.php"?>

      <!-- Main content -->
      <section class="content ">

        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block">

          <?php if (isset($_SESSION['key'])){
                  echo $home->userProfile($user_id);

                  echo $trending->trends();
            } ?>
            
        </div>
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="main-active dot-container promote-posts promote_forms more mb-3" data-promote="payment">
              <a href="javascript:void(0)"> >>> CLICK HERE TO START <<< </a>
               <h6>Promote Anything Here To Boost Your Post  !!!</br> 
               Get more people to see and engage with your posts</h6>
            </div>

            <div class="row mb-4" > 
                <?php echo $posts_home->promote_post($user_id,15); ?>
            </div>
            
        </div>
        <!-- /.col-md-6 -->

        <div class="col-md-3">
            <div class="sticky-top" style="top: 52px;z-index:1000;">
                <?php echo $home->options(); ?>
            </div>
        </div>
        <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>