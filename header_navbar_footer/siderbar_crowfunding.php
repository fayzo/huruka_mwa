        <header class="blog-header py-2 mb-3 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
          <button type="button"  
          <?php 
            echo (isset($_SESSION['key']))?
             (!empty($subscription['crowfund_subscription']) && $users->subscription_deadline($subscription['crowfund_date_pay'],$subscription['crowfund_subscription']) == true )?
             'class="btn btn-light" id="add_crowfund" data-crowfund="'.$_SESSION['key'].'"':'class="btn btn-light price-post" data-pricejob="crowfunding"' 
             :' class="btn btn-light" id="login-please" data-login="1"';
            ?> > + Add Startup Fund </button>
            <!-- <button type="button" class="btn btn-light" id="add_crowfund" data-crowfund="<?php echo $_SESSION['key']; ?>" > + Add Startup </button> -->
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Gushora Startup</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
           
          </div>
        </div>
      </header>

<div class="container-fluid">

<div role="tabpanel">
  <div class="row">

    <div class="col-sm-12 col-md-2 col-lg-2 py-3 px-2 d-none d-md-block">
      <div class="list-group sticky-top" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-Feature-list" data-toggle="tab" href="#list-Feature" role="tab" aria-controls="list-Feature">Feature</a>
        <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="tab" href="#list-Agriculture" role="tab" aria-controls="list-home">Agriculture</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#list-ubworonzi" role="tab" aria-controls="list-profile">Ubworonzi</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#list-Arts" role="tab" aria-controls="list-profile">Arts</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-Film" role="tab" aria-controls="list-settings">Film</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-Music" role="tab" aria-controls="list-settings">Music</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-Fashion" role="tab" aria-controls="list-settings">Fashion</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#list-electronics" role="tab" aria-controls="list-profile">Electronics</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#list-web_apps" role="tab" aria-controls="list-profile">Web apps</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="tab" href="#list-phone_app" role="tab" aria-controls="list-messages">Phone apps</a>
      </div>
    </div>

    <div class="col-sm-12 col-md-10 col-lg-10">
      <div class="nav-scroller py-0 d-sm-block d-md-none main-active " style="clear:right;height:3.4rem;"> 
          <nav class="nav d-flex justify-content-between pb-0  horizontal-large-2" id="list-tab" role="tablist">
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Feature">Feature<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('Feature');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Agriculture">Agriculture<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('Agriculture');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Ubworonzi">Ubworonzi<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('Ubworonzi');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Arts">Arts<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('Arts');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Film">Film<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('Film');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Music">Music<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('Music');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Fashion">Fashion<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('Fashion');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Electronics">Electronics<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('electronics');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Web_apps">Web apps<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('web_apps');?></span></a>
            <a class="p-2" data-toggle="tab" role="tab" href="#list-Phone_apps">Phone apps<span class="badge badge-primary"><?php echo $posts_home->crowfundraisingcountPOSTS('phone_apps');?></span></a>
          </nav>
      </div> 

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-Feature" role="tabpanel" aria-labelledby="list-Feature-list">
           <?php include "siderbar_crowfund/Feature.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-Agriculture" role="tabpanel" aria-labelledby="list-home-list">
           <?php include "siderbar_crowfund/Agriculture.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-ubworonzi" role="tabpanel" aria-labelledby="list-profile-list">
            <?php include "siderbar_crowfund/ubworonzi.php"?>
        </div> <!-- END-OF A LINK OF add_post ID=#  -->


        <div class="tab-pane fade" id="list-Arts" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_crowfund/Arts.php"?>
        </div> <!-- END-OF A LINK OF Messages ID=#  -->

        <div class="tab-pane fade" id="list-Film" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_crowfund/Film.php"?>
        </div> 
        <!-- END-OF A LINK OF setting ID=#  -->

        <div class="tab-pane fade" id="list-Music" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_crowfund/Music.php"?>
        </div> 

        <!-- END-OF A LINK OF setting ID=#  -->

        <div class="tab-pane fade" id="list-Fashion" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_crowfund/Fashion.php"?>
        </div> 
        
        <div class="tab-pane fade" id="list-electronics" role="tabpanel" aria-labelledby="list-messages-list">
            <?php include "siderbar_crowfund/electronics.php"?>
         </div> <!-- END-OF A LINK OF Comment ID=#  -->

        <div class="tab-pane fade" id="list-web_apps" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_crowfund/web_apps.php"?>
        </div> <!-- END-OF A LINK OF Comment ID=#  -->

        <div class="tab-pane fade" id="list-phone_app" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_crowfund/phone_app.php"?>
        </div> <!-- END-OF A LINK OF profile ID=#  -->
        <!-- END-OF A LINK OF setting ID=#  -->
      </div>
      
    </div>
  </div>
</div>
</div>
<!-- Use any element to open the sidenav -->
<!-- <span>open</span> -->

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<!-- <div id="main">
  ...
</div> -->