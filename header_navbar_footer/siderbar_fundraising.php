        <header class="blog-header py-2 mb-3 bg-light">
          <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
          <?php if (isset($_SESSION['key'])) { ?>
            <button type="button" class="btn btn-light" id="add_for_help" data-fund="<?php echo $_SESSION['key']; ?>" value="add_for_help"> + Add for help </button>
           <?php } ?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Fundraising</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
           
          </div>
        </div>
      </header>

 <div class="container-fluid">

<div role="tabpanel">
  <div class="row">
    <div class="col-4 col-md-2 col-lg-2 py-3 px-2">
      <div class="list-group sticky-top" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-Business-list" data-toggle="tab" href="#list-Business" role="tab" aria-controls="list-Business">Business</a>
        <a class="list-group-item list-group-item-action" id="list-Community-list" data-toggle="tab" href="#list-Community" role="tab" aria-controls="list-Community">Community</a>
        <a class="list-group-item list-group-item-action" id="list-Competition-list" data-toggle="tab" href="#list-Competition" role="tab" aria-controls="list-Competition">Competition</a>
        <a class="list-group-item list-group-item-action" id="list-Creative-list" data-toggle="tab" href="#list-Creative" role="tab" aria-controls="list-Creative">Creative</a>
        <a class="list-group-item list-group-item-action" id="list-Medical-list" data-toggle="tab" href="#list-Medical" role="tab" aria-controls="list-Medical">Medical</a>
        <a class="list-group-item list-group-item-action" id="list-Faith-list" data-toggle="tab" href="#list-Faith" role="tab" aria-controls="list-Faith">Faith</a>
        <a class="list-group-item list-group-item-action" id="list-Memorial-list" data-toggle="tab" href="#list-Memorial" role="tab" aria-controls="list-Memorial">Memorial</a>
        <a class="list-group-item list-group-item-action" id="list-Education-list" data-toggle="tab" href="#list-Education" role="tab" aria-controls="list-Education">Education</a>
        <a class="list-group-item list-group-item-action" id="list-Emergency-list" data-toggle="tab" href="#list-Emergency" role="tab" aria-controls="list-Emergency">Emergency</a>
        <a class="list-group-item list-group-item-action" id="list-Nonprofit-list" data-toggle="tab" href="#list-Nonprofit" role="tab" aria-controls="list-Nonprofit">Nonprofit</a>
        <a class="list-group-item list-group-item-action" id="list-Animals-list" data-toggle="tab" href="#list-Animals" role="tab" aria-controls="list-Animals">Animals</a>
      </div>
    </div>

    <div class="col-8 col-md-10 col-lg-10 ">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-Business" role="tabpanel" aria-labelledby="list-Business-list">
           <?php include "siderbar_fundraising/Business.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-Community" role="tabpanel" aria-labelledby="list-Community-list">
            <?php include "siderbar_fundraising/Community.php"?>
        </div> <!-- END-OF A LINK OF add_post ID=#  -->

        <div class="tab-pane fade" id="list-Competition" role="tabpanel" aria-labelledby="list-Competition-list">
            <?php include "siderbar_fundraising/Competition.php"?>
         </div> <!-- END-OF A LINK OF Comment ID=#  -->

        <div class="tab-pane fade" id="list-Creative" role="tabpanel" aria-labelledby="list-Creative-list">
           <?php include "siderbar_fundraising/Creative.php"?>
        </div> <!-- END-OF A LINK OF Comment ID=#  -->

        <div class="tab-pane fade" id="list-Medical" role="tabpanel" aria-labelledby="list-Medical-list">
           <?php include "siderbar_fundraising/Medical.php"?>
        </div> <!-- END-OF A LINK OF profile ID=#  -->

        <div class="tab-pane fade" id="list-Faith" role="tabpanel" aria-labelledby="list-Faith-list">
           <?php include "siderbar_fundraising/Faith.php"?>
        </div> <!-- END-OF A LINK OF Messages ID=#  -->

        <div class="tab-pane fade" id="list-Memorial" role="tabpanel" aria-labelledby="list-Memorial-list">
           <?php include "siderbar_fundraising/Memorial.php"?>
        </div> 
        <!-- END-OF A LINK OF setting ID=#  -->
        <div class="tab-pane fade" id="list-Education" role="tabpanel" aria-labelledby="list-Education-list">
            <?php include "siderbar_fundraising/Education.php"?>
        </div> <!-- END-OF A LINK OF logout ID=#  -->

        <div class="tab-pane fade" id="list-Emergency" role="tabpanel" aria-labelledby="list-Emergency-list">
            <?php include "siderbar_fundraising/Emergency.php"?>
        </div> <!-- END-OF A LINK OF logout ID=#  -->

        <div class="tab-pane fade" id="list-Nonprofit" role="tabpanel" aria-labelledby="list-Nonprofit-list">
            <?php include "siderbar_fundraising/Nonprofit.php"?>
        </div> <!-- END-OF A LINK OF logout ID=#  -->

        <div class="tab-pane fade" id="list-Animals" role="tabpanel" aria-labelledby="list-Animals-list">
            <?php include "siderbar_fundraising/Animals.php"?>
        </div> <!-- END-OF A LINK OF logout ID=#  -->
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