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
          <div class="col-4 pt-1">
            <!-- <button type="button" class="btn btn-light" id="add_for_help" data-fund="'.$_SESSION['key'].'" value=""> + Add for help </button> -->
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">job</a>
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
            // $user_id= $_SESSION['key'];
            $job_id= $_GET['id']; 
            $business_id= $_GET['business']; 
            $user = $job->jobsviewData($business_id,$job_id);
        
            $users->CountViewIn_job_post('jobs',
            array('total_view_post' => 'total_view_post +1', ),
            array('job_id' => $user['job_id'], )); ?>
            
            <div class="card">
                    <div class="card-header">
                        <a class="btn btn-success btn-sm  float-right" href="<?php echo BASE_URL_PUBLIC.'jobs' ;?>" >Back</a>

                        <div class="user-block">
                             <div class="user-blockImgBorder" style="top:20px;">
                             <div class="user-blockImg">
                                   <?php if (!empty($user['profile_img'])) {?>
                                   <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                   <?php  }else{ ?>
                                     <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                   <?php } ?>
                             </div>
                             </div>
                             <span class="username">
                                 <a style="padding-right:3px;" class="h5" href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $home->htmlspecialcharss($user['job_title']) ;?></a>
                             </span>
                                 <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $home->htmlspecialcharss($user['companyname']).' || '.$user['country'];?> <i style="font-size:12px" class="flag-icon flag-icon-<?php echo strtolower($user['country']) ;?> h4 mb-0"
                            id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i></a>
                              <span class="description">Shared public - <?php echo $home->timeAgo($user['created_on']); ?>  . <span>Views: <?php echo number_format($user['total_view_post']); ?> times</span></span>
                         </div>
                         <!-- <h2>job title <s?php echo $user['job_title']; ?></h2> -->
                    </div> <!-- card-header -->
                    <div class="card-body">

                    <?php if (!empty($user['overview']) && $user['job_user_'] == 'SME') {?>

                      <div class="card mt-2 mb-2 retweetcolor">
                        <div class="card-body">
                            <div class="user-jobImgall img_size">
                                    <?php if (!empty($user['profile_img'])) {?>
                                    <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                    <?php  }else{ ?>
                                      <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                    <?php } ?>
                              </div>
                               <span><strong><?php echo $user['companyname']; ?></strong></span>
                               <div>Company Overview</div>
                               <span>
                               <div id="link_" class="show-read-more">
                                    <?php 
                                      if (strlen($user['overview']) > 200) {
                                        // $tweetstatus = substr($user['overview'],0, strpos($user['overview'], ' ', 200)).'
                                        $tweettext = substr($user['overview'], 0, 200);
                                        $tweetstatus = substr($user['overview'], 0, 200).'
                                        <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmores" data-tweettext="'.$user['job_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                        echo $home->getTweetLink($tweetstatus);

                                        $tweettext = substr($user['overview'], 0, 200);
                                        $tweetstatus = substr($user['overview'], 200,strlen($user['overview']));
                                        echo '<span style="display: none;" class="more-text view-more-text'.$user["job_id"].'">'.$home->getTweetLink($tweetstatus).'</span>';
                                        }else{
                                        echo $home->getTweetLink($user['overview']);
                                        }  
            
                                    ?>
                                </div>
                                <div>website: <a href="<?php echo $user['website'] ;?>" target="_blank"><?php echo $user['website'] ;?></a></div>
                              </span>
                           </div>
                      </div>
                      <?php } ?>

                        <!-- <p class="card-text">job-id -< ?php echo $job_id ;?></p>
                        <p class="card-text">business-id -< ?php echo $business_id ;?></p> -->
                        <h4 >Job Title: <?php echo $user['job_title'] ;?> </h4>
                          <hr>
                             <!-- <h4 >Job Summary: </h4> -->
                             <div><?php echo htmlspecialchars_decode($user['job_summary']) ;?></div>
                           <hr>
                      
                            <h4 class="card-title">Deadline to submit: </h4>
                           <div><?php echo date("M j, Y",strtotime($user['deadline'])) ;?></div>
                          <hr>
                          
                          <?php if (!empty($user['website'])) { ?>
                            <h4 class="card-title">Apply to website: <a href="<?php echo $user['website'] ;?>"><?php echo $user['website'] ;?></a></h4>
                          <hr>
                          <?php } ?>
                          <?php if (empty($user['website'])) { ?>
                            <!-- # code... -->
                            <input type="button" value="Apply"  <?php  if(isset($_SESSION['key'])){ echo '  class="btn btn-success" id="Apply" data-applyjob="'.$job_id.'" data-business="'.$business_id.'"' ; }else{ echo 'class="btn btn-success" id="login-please"  data-login="1"'; } ?> >
                          <?php } ?>

                          <div class="p-2">
                              <div class="input-group ">
                                  <div class="input-group-prepend">
                                      <button type="button" class="input-group-text btn btn-default" onclick="copyText()" data-toggle="tooltip" title="Contacts" data-original-title="Contacts" id="basic-addon2">Copy Link</button>
                                  </div>
                                  <input type="text" id="mycopyText" style="width:1px" class="form-control" value="<?php echo BASE_URL_PUBLIC."job?id=".$_GET['id']."&business=".$_GET['business'] ;?>" readonly>
                              </div>
          
                              <!-- <a class="btn btn-sm btn-primary mt-2" href="< ?php echo BASE_URL_PUBLIC."job?id=".$_GET['id']."&business=".$_GET['business'] ;?>"> Redirect to link</a> -->
          
                              <script>
                                  function copyText() {
                                      var copyText = document.getElementById('mycopyText');
                                      copyText.select();
                                      copyText.setSelectionRange(0,99999);
                                      document.execCommand('copy');
                                      alert('Copied a Url link: ' + copyText.value);
                                      // alert('Copied a Url link: ' + copyText.innerHTML);
                                      // alert('Copied a Url link: ' + copyText.childNodes[0].nodeValue);
                                  }
                              </script>
          
                          </div>
                  </div>
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
