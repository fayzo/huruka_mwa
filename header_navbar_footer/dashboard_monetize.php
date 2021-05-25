<div role="tabpanel">
  <div class="row">
  
    <div class="col-4 col-md-2 col-lg-2 py-3 px-2" >
      <div class="list-group sticky-top" id="list-tab" role="tablist" style="top: 50px;">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="tab" href="#list-Users-coins" role="tab" aria-controls="list-Users-coins">Users coins </a>
        <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="tab" href="#list-irangiro-coins" role="tab" aria-controls="list-irangiro-coins">irangiro coins </a>
        <a class="list-group-item list-group-item-action" id="list-Jobs-list" data-toggle="tab" href="#list-Jobs" role="tab" aria-controls="list-Jobs">Jobs</a>
        <a class="list-group-item list-group-item-action" id="list-Markerting-list" data-toggle="tab" href="#list-Markerting" role="tab" aria-controls="list-Markerting">Markerting ads</a>
        <a class="list-group-item list-group-item-action" id="list-News-list" data-toggle="tab" href="#list-News" role="tab" aria-controls="list-News">News-Feeds</a>
        <a class="list-group-item list-group-item-action" id="list-Fundraising-list" data-toggle="tab" href="#list-Fundraising" role="tab" aria-controls="list-Fundraising">Fundraising</a>
        <a class="list-group-item list-group-item-action" id="list-Crownfund-list" data-toggle="tab" href="#list-Crownfund" role="tab" aria-controls="list-Crownfund">Crownfund</a>
        <a class="list-group-item list-group-item-action" id="list-House-list" data-toggle="tab" href="#list-House" role="tab" aria-controls="list-House">House</a>
        <a class="list-group-item list-group-item-action" id="list-Car-list" data-toggle="tab" href="#list-Car" role="tab" aria-controls="list-Car">Car</a>
        <a class="list-group-item list-group-item-action" id="list-Cyamunara-list" data-toggle="tab" href="#list-Cyamunara" role="tab" aria-controls="list-Cyamunara">Cyamunara</a>
        <a class="list-group-item list-group-item-action" id="list-MarketPlace-list" data-toggle="tab" href="#list-MarketPlace" role="tab" aria-controls="list-MarketPlace">MarketPlace</a>
        <a class="list-group-item list-group-item-action" id="list-School-list" data-toggle="tab" href="#list-School" role="tab" aria-controls="list-School">School</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-Logout" role="tab" aria-controls="list-Logout">Logout</a>
      </div>
    </div>

    <div class="col-8 col-md-10 col-lg-10 ">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-Users-coins" role="tabpanel" aria-labelledby="list-home-list">
           <?php include "siderbar_monetize/Users-coins.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-irangiro-coins" role="tabpanel" aria-labelledby="list-home-list">
           <?php include "siderbar_monetize/irangiro-coins.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-Jobs" role="tabpanel" aria-labelledby="list-Jobs-list">
           <?php include "siderbar_monetize/Jobs.php"?>
        </div> 
        <div class="tab-pane fade" id="list-Markerting" role="tabpanel" aria-labelledby="list-Markerting-list">
           <?php include "siderbar_monetize/Markerting.php"?>
        </div> 
        <div class="tab-pane fade" id="list-News" role="tabpanel" aria-labelledby="list-News-list">
           <?php include "siderbar_monetize/Newsfeed.php"?>
        </div> 
        <div class="tab-pane fade" id="list-Fundraising" role="tabpanel" aria-labelledby="list-Fundraising-list">
           <?php include "siderbar_monetize/Fundraising.php"?>
        </div> 
        <div class="tab-pane fade" id="list-Crownfund" role="tabpanel" aria-labelledby="list-Crownfund-list">
           <?php include "siderbar_monetize/Crownfund.php"?>
        </div> 
        <div class="tab-pane fade" id="list-House" role="tabpanel" aria-labelledby="list-House-list">
           <?php include "siderbar_monetize/House.php"?>
        </div> 
        <div class="tab-pane fade" id="list-Car" role="tabpanel" aria-labelledby="list-Car-list">
           <?php include "siderbar_monetize/Car.php"?>
        </div> 
        <div class="tab-pane fade" id="list-Cyamunara" role="tabpanel" aria-labelledby="list-Cyamunara-list">
           <?php include "siderbar_monetize/Cyamunara.php"?>
        </div> 
        <div class="tab-pane fade" id="list-MarketPlace" role="tabpanel" aria-labelledby="list-MarketPlace-list">
           <?php include "siderbar_monetize/MarketPlace.php"?>
        </div> 
        <div class="tab-pane fade" id="list-School" role="tabpanel" aria-labelledby="list-School-list">
           <?php include "siderbar_monetize/School.php"?>
        </div> 
        <!-- END-OF A LINK OF setting ID=#  -->

        <div class="tab-pane fade" id="list-Logout" role="tabpanel" aria-labelledby="list-settings-list">
            <?php include "siderbar_jobs/logout.php"?>
        </div> <!-- END-OF A LINK OF logout ID=#  -->
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