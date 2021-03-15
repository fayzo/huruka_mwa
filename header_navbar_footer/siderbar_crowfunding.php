        <header class="blog-header py-2 mb-3 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
          <?php if (isset($_SESSION['key'])) { ?>
            <button type="button" class="btn btn-light" id="add_crowfund" data-crowfund="<?php echo $_SESSION['key']; ?>" > + Add Startup </button>
           <?php } ?>
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
    <div class="col-4 col-md-2 col-lg-2 py-3 px-2" >
      <div class="list-group sticky-top" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="tab" href="#list-Agriculture" role="tab" aria-controls="list-home">Agriculture</a>
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


    <div class="col-8 col-md-10 col-lg-10 ">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-Agriculture" role="tabpanel" aria-labelledby="list-home-list">
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