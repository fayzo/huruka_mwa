<div role="tabpanel">
  <div class="row">
    <div class="col-4 col-md-2 col-lg-2 py-3 px-2" >
      <div class="list-group sticky-top" id="list-tab" role="tablist" style="top: 50px;">
      <?php if ($users->jobloggedin() == 'SME' && $users->loggedin() == true) { ?>
        <a class="list-group-item list-group-item-action  active viewBusiness" id="list-profile-list" data-toggle="tab" href="#list-Live_Blog" role="tab" aria-controls="list-profile">Business Profile</a>
      <?php } ?>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#list-Add_Post" role="tab" aria-controls="list-profile">Posts Jobs</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="tab" href="#list-messages" role="tab" aria-controls="list-messages">Inbox Messages</a>
        <a class="list-group-item list-group-item-action hidden-xs" id="list-profile-list" data-toggle="tab" href="#list-profile" role="tab" aria-controls="list-profile">Social Profile</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-settings" role="tab" aria-controls="list-settings">Settings</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-Logout" role="tab" aria-controls="list-settings">Logout</a>
      </div>
    </div>

    <div class="col-8 col-md-10 col-lg-10 ">
      <div class="tab-content" id="nav-tabContent">
         <?php if ($users->jobloggedin() == 'SME' && $users->loggedin() == true) { ?>

        <div class="tab-pane fade show active" id="list-Live_Blog" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_jobs_post/pages.php"?>
        </div> <!-- END-OF A LINK OF Comment ID=#  -->

        <div class="tab-pane fade" id="list-Add_Post" role="tabpanel" aria-labelledby="list-profile-list">
            <?php include "siderbar_jobs_post/posts_jobs.php"?>
        </div> 
        <!-- END-OF A LINK OF add_post ID=#  -->
        <?php }else{ ?>

        <div class="tab-pane fade show active" id="list-Add_Post" role="tabpanel" aria-labelledby="list-profile-list">
            <?php include "siderbar_jobs_post/posts_jobs.php"?>
        </div> 
        <!-- END-OF A LINK OF add_post ID=#  -->
        <?php } ?>

        <div class="tab-pane fade  hidden-xs" id="list-profile" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_jobs_post/profile.php"?>
        </div> <!-- END-OF A LINK OF profile ID=#  -->

        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-settings-list">
             <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="row mb-2">
                    <div class="col-3">
                        <h4>Inbox</h4>
                    </div>
                    <div class="col-9">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Inbox</li>
                        </ol>
                    </div>
                </div>
            </section>
           <?php include "siderbar_jobs_post/messages.php"?>
        </div> <!-- END-OF A LINK OF Messages ID=#  -->
<?php
        $user= $home->userData($_SESSION['key']);
 ?>

        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_jobs_post/setting.php"?>
        </div> 
        <!-- END-OF A LINK OF setting ID=#  -->

        <div class="tab-pane fade" id="list-Logout" role="tabpanel" aria-labelledby="list-settings-list">
            <?php include "siderbar_jobs_post/logout.php"?>
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
