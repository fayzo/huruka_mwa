<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['job_id']) && !empty($_POST['job_id'])) {
    // $user_id= $_SESSION['key'];
    $job_id= $_POST['job_id']; 
    $business_id= $_POST['business_id']; 
    $user = $job->jobsviewData($business_id,$job_id);

    $users->CountViewIn_job_post('jobs',
    array('total_view_post' => 'total_view_post +1', ),
    array('job_id' => $user['job_id'], )); ?>

                <div class="card">
                    <div class="card-header">
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
                                 <a  style="padding-right:3px;" class="h5" href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $home->htmlspecialcharss($user['job_title']) ;?></a>
                             </span>
                                 <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $home->htmlspecialcharss($user['companyname']).' || '.$user['country'];?> <i class="flag-icon flag-icon-<?php echo strtolower($user['country']) ;?> h4 mb-0"
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
                                <span><?php echo $user['companyname']; ?></span>
                                <div>Company Overview</div>
                                <span>
                                <div id="link_" class="show-read-more">
                                    <?php 
                                          if (strlen($user['overview']) > 200) {
                                            // $tweetstatus = substr($user['overview'],0, strpos($user['overview'], ' ', 200)).'
                                            $tweettext = substr($user['overview'], 0, 200);
                                            $tweetstatus = substr($user['overview'], 0, strrpos($tweettext, ' ')).'
                                            <span class="readtext-tweet-readmore"><a href="javascript:void(0)" id="readtext-tweet-readmores" data-tweettext="'.$user['job_id'].'" style"font-weight: 500 !important;font-size:8px">... read more...</a></span>';
                                            echo $home->getTweetLink($tweetstatus);

                                            $tweettextz = substr($user['overview'], 0, 200);
                                            $tweetstatusz = substr($user['overview'], strrpos($tweettextz, ' '));
                                            echo '<span style="display: none;" class="more-text view-more-text'.$user["job_id"].'">'.$home->getTweetLink($tweetstatusz).'</span>';
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
                            <input type="button" value="Apply"  <?php echo 'id="Apply" data-applyjob="'.$job_id.'" data-business="'.$business_id.'"';?>  class="btn btn-success">
                          <?php } ?>
                    </div>
                </div>

<?php } 

if (isset($_POST['search']) && !empty($_POST['search'])) {
    // $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
    $result= $job->searchJobs($search);
    echo '<h4 style="padding: 0px 10px;">'.$_POST['search'].'</h4> ';

     if (is_array($result) || is_object($result)){

     foreach ($result as $jobs) { ?>

          <div class="col-12 px-0 py-2 jobHover border-bottom jobHovers more" data-job="<?php echo $jobs['job_id'];?>"  data-business="<?php echo $jobs['business_id'];?>">
            <div class="user-block mb-2" >
                   <div class="user-jobImgall">
                         <?php if (!empty($jobs['profile_img'])) { ?>
                         <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                         <?php  }else{ ?>
                           <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                         <?php } ?>
                   </div>
                   <span><a href="#"><?php echo htmlspecialchars($jobs['job_title']); ?></a></span><br>
                   <span>
                       <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC ;?>"><?php echo htmlspecialchars($jobs['companyname']); ?></a> || 
                       <i class="flag-icon flag-icon-<?php echo strtolower($jobs['location']) ;?> h4 mb-0"
                            id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i>
                   </span><br>
                   <span>Job Title: <?php echo htmlspecialchars($jobs['job_title']); ?></span><br>
                   <span>Shared public -<?php echo $home->timeAgo($jobs['created_on']); ?></span><br>
                   <span>Deadline to submit - <?php echo date("M j, Y",strtotime($user['deadline'])); ?></span>
               </div>
             </div>
            <hr>
            <!-- <p><div><ul><li>Perform monthly, quarterly and annual accounting activities including reconciliations of bank and credit card accounts, coordination and completion of annual audits, and reviewing financial reports/support as necessary</li>
            <li><div><p>Perform monthly, quarterly and annual accounting activities including reconciliations of bank and credit card accounts, coordination and completion of annual audits, and reviewing financial reports/support as necessaryï»¿</p></div></li>
            </ul></div></p> -->
        <?php } 
        }
} 
// return true or false
// 	Expression      | empty($x)
// ----------------+--------
// $x = "";        | true    
// $x = null       | true    
// var $x;         | true    
// $x is undefined | true    
// $x = array();   | true    
// $x = false;     | true    
// $x = true;      | false   
// $x = 1;         | false   
// $x = 42;        | false   
// $x = 0;         | true    
// $x = -1;        | false   
// $x = "1";       | false   
// $x = "0";       | true    
// $x = "-1";      | false   
// $x = "php";     | false   
// $x = "true";    | false   
// $x = "false";   | false 

?>
