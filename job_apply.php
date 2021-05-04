<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<?php include "header_navbar_footer/header.php"?>

    <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
           <!-- < ?php if (isset($_SESSION['job_user'])) { ?>
            <button type="button" class="btn btn-light" id="addPostsjobs" > + Add jobs </button>
           < ?php } ?> -->
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Job Apply</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">

          </div>
        </div>
    </header>

<div class="container-fluid mb-3">
   <section class="content-header">
        <div class="row">
            <div class="col-6">
                <h5><i>Your Job offer</i></h5>
            </div>
            <div class="col-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Activities </li>
                    <li class="breadcrumb-item active"><i>Posts</i></li>
                </ol>
            </div>
        </div>
    </section>
    
    <div class="row mt-4">
         <div class="col-md-3 d-none d-md-block">
             <div class="card">
                <div class="card-header">
                   <div class="single-howit-works">
                        <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                        <h4>Search <br> Applicant</h4>
                    </div>
                </div>
            </div> <!-- card -->
         </div> <!-- col -->

         <div class="col-md-6 ">

         <?php 
            if (isset($_GET['job_id']) && !empty($_GET['job_id'])) {
                // $user_id= $_SESSION['key'];
                $job_id= $_GET['job_id']; 
                $business_id= $_GET['business_id']; 
                $email= $_SESSION['email']; 

                $user = $job->jobsviewData($business_id,$job_id); 
                // $query= $mysqli->query("SELECT * FROM users U Left JOIN email_apply_job A ON A. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = A. job_id0  WHERE A. email_sent_to= '$sessions' AND A. type_of_email = 'inbox' ORDER BY A. created_on0 DESC ");
                $query= $db->query("SELECT * FROM email_apply_job A LEFT JOIN jobs J ON J. job_id = A. job_id0 WHERE A. job_id0 = $job_id AND A. email_sent_to= '$email' AND A. type_of_email = 'inbox' ORDER BY A. created_on0 ASC ");
                // var_dump($email);

                ?>

                <div class="card">
                    <div class="card-header">
                        <a href="activities" class="btn btn-success btn-sm  float-right">Back</a>

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
                        <div>People who apply this Title: <?php echo $user['job_title'] ;?> </div>
                        <hr>
                            <?php 
                            //  echo '<pre>';
                            //  var_dump($query);
                            //  echo '</pre>';
             
                            if ($query->num_rows > 0) {
                                
                                while($row = $query->fetch_array()) { 

                                    $message = htmlspecialchars_decode($row['addition_information']);

                                    if(strlen($message) > 300) {
                                    $message = substr($message,0,300).'<a href="javascript:void(0)" class="inbox-view" data-cv_id="'.$row['cv_id'].'"> ... Read more </a>';
                                    }else{
                                    $message.'<a href="javascript:void(0)" class="inbox-view" data-cv_id="'.$row['cv_id'].'"> ... Read more </a>' ;
                                    } 
                                ?>

                                <div class="col-12 px-0 py-2 jobHover" data-user="<?php echo $row['user_id'];?>" >
                                <div class="user-block mb-2" >
                                    <div class="user-jobImgall img_size ml-0 more inbox-view " data-cv_id="<?php echo $row['cv_id'];?>">
                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                    </div>
                                        <div style="display: flow-root;" class="text_size">
                                            <div class='float-left'>
                                                <span><?php echo $row['firstname0']; ?> </span><br> <!-- Names: -->
                                                <span><?php echo $row['lastname0']; ?> </span><br><!-- education:  -->
                                                <span><?php echo $row['address0']; ?> </span><br><!-- diploma:  -->
                                                <span><?php echo $row['email0']; ?> </span><br><!-- study:  -->
                                            </div>
                                            <!-- hidden-xs -->
                                            <div class="float-right text-right ">
                                                <span <?php if(isset($_SESSION['key'])){ echo 'class="people-message more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['email_sent_from_id'];?>"><i class="fa fa-envelope-o text-danger"></i> Message </span><br>
                                                <span <?php if(isset($_SESSION['key'])){ echo 'class=emailSent more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['email_sent_from_id'];?>">@Mail</span><br>
                                                <?php if (isset($_SESSION['key']) && $_SESSION['approval'] === 'on') { ?>
                                                 <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $row['telephone']; ?> </span><br>
                                                <?php  }else{ ?>
                                                <div>RW <i class="flag-icon flag-icon-rw h4 mb-0" id="rw" title="us"></i></div>
                                                <?php  } ?>
                                                <div><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $home->timeAgo($row['created_on0']); ?></div>
                                                <!-- <span  < ?php if(isset($_SESSION['key'])){ echo 'class=emailSent more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="< ?php echo $row['user_id'];?>">< ?php echo $row['email']; ?></span><br> -->
                                            </div>
                                        </div>
                            </div> <!-- user-block -->
                            <div class="card-header">
                                <strong >Description: <?php echo $row['subject_composer']; ?></strong>
                                <?php echo $message; ?>
                            </div>
                            </div> <!-- col-12 -->

                            <hr class="bg-info mt-0 mb-1" style="width:70%;">
                        <?php } }else {
                                    echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                                    <button class="close" data-dismiss="alert" type="button">
                                        <span>&times;</span>
                                    </button>
                                    <strong>No Record</strong>
                                </div></div>'; 
                                } 
                        ?>

                    </div>
                </div>

                <?php } ?>

            </div> <!-- col -->

            <div class="col-md-3 d-none d-md-block">
                <div class="card">
                    <div class="card-header">
                        <div class="single-howit-works">
                            <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                            <h4>Search <br> Applicant</h4>
                        </div>
                    </div>
                </div> <!-- card -->
                    
            </div> <!-- col -->

        </div>

</div>

<?php include "header_navbar_footer/footer.php"?>