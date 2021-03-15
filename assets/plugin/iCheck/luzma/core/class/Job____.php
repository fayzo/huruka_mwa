<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 } 

class Job extends Home {

      public function jobsData($user_id)
      {
          $mysqli= $this->database;
          $query= $mysqli->query("SELECT * FROM users Left JOIN jobs ON business_id = '{$user_id}' WHERE business_id = '{$user_id}' and user_id= '{$user_id}' ");
          $row= $query->fetch_array();
          return $row;
      }
  
          public function jobsviewData($business_id,$job_id)
      {
          $mysqli= $this->database;
          $query= $mysqli->query("SELECT * FROM users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J. business_id = '{$business_id}' and J. job_id= '{$job_id}' ");
          $row= $query->fetch_array();
          return $row;
      }
  
          public function jobsactivities($user_id)
      {
          $mysqli= $this->database;
          $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.turn = 'on' and J. business_id = '{$user_id}' ");
          ?>
          <div class="card">
              <div class="card-header main-active">
               <h5 class="text-center">jobs</h5>
              </div>
              <div class="card-body">
                <div class="row ">
             
            <?php while($jobs= $query->fetch_array()) { ?>
              <div class="col-8 offset-2 px-0 jobHovers more" data-job="<?php echo $jobs['job_id'];?>"  data-business="<?php echo $jobs['business_id'];?>">
                 <div class="user-block mb-2 jobHover" >
                     <div class="user-jobImgBorder">
                     <div class="user-jobImg">
                           <?php if (!empty($jobs['profile_img'])) {?>
                           <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                           <?php  }else{ ?>
                             <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                           <?php } ?>
                     </div>
                     </div>
                     <span class="username">
                         <a style="padding-right:3px;" href="#"> <!-- Job Title: --> <?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></a> 
                     </span>
                     <span class="description"><?php echo $this->htmlspecialcharss($jobs['companyname']); ?> || <i class="flag-icon flag-icon-<?php echo strtolower( $jobs['location']) ;?> h4 mb-0"
                              id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i></span>
                     <span class="description">Shared public - <?php echo $this->timeAgo($jobs['created_on']); ?></span>
                     <span class="description">Deadline -  <?php echo $this->htmlspecialcharss($jobs['deadline']); ?></span>
                 </div>
                 <hr class="main-active" style="width:100%">
              </div>
            <?php } ?>
             </div> <!-- row -->
             </div> <!-- card-body -->
          </div> <!-- card -->
      <?php }
  
          public function jobsfetch()
      {
          $mysqli= $this->database;
          $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.turn = 'on' ORDER BY rand() LIMIT 6 ");
          if ($query->num_rows > 0) {
          ?>
          <div class="card card-primary mb-3 ">
          <div class="card-header main-active p-1">
              <h5 class="card-title text-center"><i> Jobs</i></h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body message-color pt-0 pb-0">
          <div class="row">
            <?php while($jobs= $query->fetch_array()) { ?>
  
              <div class="col-12 px-0 border-bottom jobHovers mt-2 more" data-job="<?php echo $jobs['job_id'];?>"  data-business="<?php echo $jobs['business_id'];?>">
                 <div class="user-block mb-2 jobHover" >
                     <div class="user-jobImgBorder">
                     <div class="user-jobImg">
                           <?php if (!empty($jobs['profile_img'])) {?>
                           <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                           <?php  }else{ ?>
                             <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                           <?php } ?>
                     </div>
                     </div>
                     <span class="username">
                     <!-- Job Title:  -->
                         <a style="padding-right:3px;" href="#"><?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></a> 
                     </span>
                     <!-- <span class="description">< ?php echo $this->htmlspecialcharss($jobs['companyname']); ?> || <i class="flag-icon flag-icon-<?php echo strtolower($jobs['location']) ;?> h4 mb-0"
                              id="< ?php echo strtolower( $jobs['location']) ;?>" title="us"></i></span> -->
                     <span class="description">Publish - <?php echo $this->timeAgo($jobs['created_on']); ?></span>
                     <span class="description">Deadline -  <?php echo $this->htmlspecialcharss($jobs['deadline']); ?></span>
                 </div>
              </div>
              <hr >
  
            <?php } ?>
          </div>
            </div> <!-- /.card-body -->
             <div class="card-footer text-center">
              <a href="<?php echo JOBS;?>">View all Jobs</a>
             </div> <!-- /.card-footer -->
         </div>
         <?php } ?>
  
         <!-- /.card -->
         <!-- <div class="card card-primary mb-3 ">
                  <div class="card-header main-active p-1">
                    <h5 class="card-title text-center"><i> Jobs</i></h5>
                  </div>
                  /.card-header
                  <div class="card-body message-color pt-0 pb-0">
                    <div class="row">
  
                      <div class="col-12 px-0 border-bottom jobHovers mt-2 more" data-job="34" data-business="61">
                        <div class="user-block mb-2 jobHover">
                          <div class="user-jobImgBorder">
                            <div class="user-jobImg">
                              <img
                                src="http://localhost:80/Blog_nyarwanda_CMS/assets/image/users_profile_cover/112baby3.png"
                                alt="User Image">
                            </div>
                          </div>
                          <span class="username">
                            Job Title: 
                            <a style="padding-right:3px;" href="#">Clinical Data Analyst</a>
                          </span>
                          <span class="description">publish - Sep 12, 2019</span>
                          <span class="description">Deadline - 2019-09-12</span>
                        </div>
                      </div>
                      <hr>
                    </div>
                  </div> /.card-body
                  <div class="card-footer text-center">
                    <a href="http://localhost:80/Blog_nyarwanda_CMS/jobs0">View all Jobs</a>
                  </div> /.card-footer
                </div>
                /.card -->
      <?php }
          
          function htmlspecialcharss($string)
      {
          return strip_tags(html_entity_decode($string));
      }
  
          function jobsfetchALL($categories,$pages)
      {
          $pages= $pages;
          $categories= $categories;
          
          if($pages === 0 || $pages < 1){
              $showpages = 0 ;
          }else{
              $showpages = ($pages*10)-10;
          }
          $mysqli= $this->database;
          if ($categories == 'Featured') {
              # code...
               $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J. turn = 'on' ORDER BY rand() Desc Limit $showpages,10");
          } else {
              # code...
               $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.categories_jobs ='$categories' AND J. turn = 'on' ORDER BY rand() Desc Limit $showpages,10");
          }
          
          ?>
          <div class="card card-primary mb-1 ">
          <div class="card-header main-active p-1">
              <h5 class="card-title float-left pl-2"><i> Jobs to Search</i></h5>
               <form class="form-inline float-right">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                      </div>
                      <input type="text" class="form-control search0"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                  </div>
                </form>
  
              <div class="nav-scroller py-0" style="clear:right;height:2rem;">
                  <nav class="nav d-flex justify-content-between pb-0"  >
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories('Featured',1);" >Featured<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Featured');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories('Tenders',1);" >Tenders<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Tenders');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories('Consultancy',1);" >Consultancy<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Consultancy');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories('Internships',1);" >Internships<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Internships');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories('Public',1);" >Public<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Public');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories('Training',1);" >Training<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Training');?></span></a>
                  </nav>
              </div> <!-- nav-scroller -->
          </div> <!-- /.card-header -->
  
          <div class="card-body message-color">
          <span class="job-show"></span>
          <div class="job-hide">
            <?php while($jobs= $query->fetch_array()) { ?>
  
              <div class="col-12 px-0 py-2 jobHover jobHovers more" data-job="<?php echo $jobs['job_id'];?>" data-business="<?php echo $jobs['business_id'];?>">
              <div class="user-block mb-2" >
                     <div class="user-jobImgall">
                           <?php if (!empty($jobs['profile_img'])) {?>
                           <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                           <?php  }else{ ?>
                             <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                           <?php } ?>
                     </div>
                     <span><a href="#"> <!-- Job Title: --> <?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></a></span><br>
                     <span><?php echo $this->htmlspecialcharss($jobs['companyname']); ?></span> || 
                         <i style="font-size:12px" class="flag-icon flag-icon-<?php echo strtolower( $jobs['location']) ;?> h4 mb-0"
                              id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i><br>
                     <span>Shared public - <?php echo $this->timeAgo($jobs['created_on']); ?></span><br>
                     <span>Deadline - <?php echo $this->htmlspecialcharss($jobs['deadline']); ?></span>
            </div> <!-- user-block -->
            </div> <!-- col-12 -->
            <hr class="bg-info mt-0 mb-1" style="width:95%;">
            
            <!-- <div class="col-12 px-0 border-bottom jobHover jobHovers more" data-job="< ?php echo $jobs['job_id'];?>" data-business=" < ?php echo $jobs['business_id'];?>">
                  <div class="user-block mb-2 jobHover">
                  <div class="user-jobImgBorder">
                      <div class="user-jobImg">
                          < ?php if (!empty($jobs['profile_img'])) {?>
                          <img src="< ?php echo BASE_URL_LINK ;?>image/users_profile_cover/< ?php echo $jobs['profile_img'] ;?>" alt="User Image">
                          < ?php  }else{ ?>
                          <img src="< ?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                          < ?php } ?>
                      </div>
                  </div>
                  <span class="username">
                      <a style="padding-right:3px;" href="#"> Job Title: < ?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></a>
                  </span>
                  <span class="description">Shared public - < ?php echo $this->timeAgo($jobs['created_on']); ?></span>
                  <span class="description">Deadline - < ?php echo $this->htmlspecialcharss($jobs['deadline']); ?></span>
                  </div>
              </div> col-10 -->
          <?php }
  
          $query1= $mysqli->query("SELECT COUNT(*) FROM jobs WHERE categories_jobs ='$categories' AND turn = 'on' ");
          $row_Paginaion = $query1->fetch_array();
          $total_Paginaion = array_shift($row_Paginaion);
          $post_Perpages = $total_Paginaion/10;
          $post_Perpage = ceil($post_Perpages); ?>
             </div>
            </div> <!-- /.card-body -->
         </div> <!-- /.card -->
  
          <?php if($post_Perpage > 1){ ?>
           <nav>
               <ul class="pagination justify-content-center mt-3">
                   <?php if ($pages > 1) { ?>
                       <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="jobsCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                   <?php } ?>
                   <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                           if ($i == $pages) { ?>
                        <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="jobsCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                        <?php }else{ ?>
                       <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="jobsCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                   <?php } } ?>
                   <?php if ($pages+1 <= $post_Perpage) { ?>
                       <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="jobsCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                   <?php } ?>
               </ul>
           </nav>
          <?php } ?>
  
      <?php } 
  
          function jobsfetchALL0($categories,$pages)
      {
          $pages= $pages;
          $categories= $categories;
          
          if($pages === 0 || $pages < 1){
              $showpages = 0 ;
          }else{
              $showpages = ($pages*10)-10;
          }
          $mysqli= $this->database;
  
          if ($categories == 'Featured') {
              # code...
               $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J. turn = 'on' ORDER BY rand() Desc Limit $showpages,10");
          } else {
              # code...
               $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.categories_jobs ='$categories' AND J. turn = 'on' ORDER BY rand() Desc Limit $showpages,10");
          }
  
          ?>
          <div class="card card-primary mb-1 ">
          <div class="card-header main-active p-1">
              <h5 class="card-title float-left pl-2"><i> Jobs to Search</i></h5>
               <form class="form-inline float-right">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                      </div>
                      <input type="text" class="form-control search0"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                  </div>
                </form>
  
              <div class="nav-scroller py-0" style="clear:right;height:2rem;">
                  <nav class="nav d-flex justify-content-between pb-0"  >
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories0('Featured',1);" >Featured<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Featured');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories0('Tenders',1);" >Tenders<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Tenders');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories0('Consultancy',1);" >Consultancy<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Consultancy');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories0('Internships',1);" >Internships<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Internships');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories0('Public',1);" >Public<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Public');?></span></a>
                  <a class="p-2" href="javascript:void(0)" onclick="jobsCategories0('Training',1);" >Training<span class="badge badge-primary"><?php echo $this->jobscountPOSTS('Training');?></span></a>
                  </nav>
              </div> <!-- nav-scroller -->
          </div> <!-- /.card-header -->
  
          <div class="card-body message-color">
          <span class="job-show"></span>
          <div class="job-hide row">
              <div class="col-md-6 large-2 ">
            <?php while($jobs= $query->fetch_array()) { ?>
  
              <div class="px-0 py-2 jobHover jobHovers0 more" data-job="<?php echo $jobs['job_id'];?>" data-business="<?php echo $jobs['business_id'];?>">
              <div class="user-block mb-2" >
               <div class="row">
                <div class="col-2">
                     <div class="user-jobImgall">
                           <?php if (!empty($jobs['profile_img'])) {?>
                           <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                           <?php  }else{ ?>
                             <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                           <?php } ?>
                     </div>
                </div>
                <div class="col-10 pl-4">
                     <span> <!-- Job Title: --> <?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></span><br>
                     <span><?php echo $this->htmlspecialcharss($jobs['companyname']); ?></span> || 
                         <i class="flag-icon flag-icon-<?php echo strtolower( $jobs['location']) ;?> h4 mb-0"
                              id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i><br>
                     <span>Shared public - <?php echo $this->timeAgo($jobs['created_on']); ?></span><br>
                     <span>Deadline - <?php echo $this->htmlspecialcharss($jobs['deadline']); ?></span>
                 </div> <!-- col-10 -->
              </div> <!-- row -->
            </div> <!-- user-block -->
            </div> <!-- col-12 -->
            <hr class="bg-info mt-0 mb-1" style="width:95%;">
          <?php }
  
          $query1= $mysqli->query("SELECT COUNT(*) FROM jobs WHERE categories_jobs ='$categories' AND turn = 'on' ");
          $row_Paginaion = $query1->fetch_array();
          $total_Paginaion = array_shift($row_Paginaion);
          $post_Perpages = $total_Paginaion/10;
          $post_Perpage = ceil($post_Perpages); ?>
              </div>
              <div class="col-md-6 large-2 jobslarge">
                  
              </div>
             </div><!-- row -->
            </div> <!-- /.card-body -->
         </div> <!-- /.card -->
  
          <?php if($post_Perpage > 1){ ?>
           <nav>
               <ul class="pagination justify-content-center mt-3">
                   <?php if ($pages > 1) { ?>
                       <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="jobsCategories0('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                   <?php } ?>
                   <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                           if ($i == $pages) { ?>
                        <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="jobsCategories0('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                        <?php }else{ ?>
                       <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="jobsCategories0('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                   <?php } } ?>
                   <?php if ($pages+1 <= $post_Perpage) { ?>
                       <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="jobsCategories0('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                   <?php } ?>
               </ul>
           </nav>
          <?php } ?>
  
      <?php } 
  
        public function jobscountPOSTS($categories)
      {
          $db =$this->database;
          if ($categories == 'Featured') {
              # code...
                $sql= $db->query("SELECT COUNT(*) FROM jobs WHERE turn = 'on'");
          } else {
              # code...
              $sql= $db->query("SELECT COUNT(*) FROM jobs WHERE categories_jobs ='$categories' AND turn = 'on'");
          }
          
          $row_post = $sql->fetch_array();
          $total_post= array_shift($row_post);
          $array= array(0,$total_post);
          $total_posts= array_sum($array);
          echo $total_posts;
      }
  
        public function Post_Jobs($categories,$user_id)
      {
          $mysqli= $this->database;
          $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.turn = 'on' ORDER BY rand() LIMIT 6");
          //Columns must be a factor of 12 (1,2,3,4,6,12)
          $numOfCols = 2;
          $rowCount = 0;
          $bootstrapColWidth = 12 / $numOfCols;
         ?>
         <div class="slide-text card retweetcolor borders-tops">
          <div class="slideshow-container">
  
          <div class="dot-container h5">
            <a href="<?php echo JOBS; ?>">View more Jobs >>>></a> 
          </div>
  
          <div class="row mySlidesx mySlidesx2">
  
          <?php while($jobs= $query->fetch_array()) { ?>
  
          <div class="col-md-6">
            <div class="card border-bottom jobHovers more borders-bottoms shadow-lg" data-job="<?php echo $jobs['job_id'];?>"  data-business="<?php echo $jobs['business_id'];?>">
            
              <div class="card-body px-0">
                 <div class="user-block mb-2 jobHover" >
                     <div class="user-jobImgBorder">
                     <div class="user-jobImg">
                           <?php if (!empty($jobs['profile_img'])) {?>
                           <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                           <?php  }else{ ?>
                             <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                           <?php } ?>
                     </div>
                     </div>
                     <span class="username mt-2">
                     <!-- Job Title:  -->
                         <a style="padding-right:3px;" href="#"><?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></a> 
                     </span>
                     <span class="description"><?php echo $this->htmlspecialcharss($jobs['companyname']); ?> || <i class="flag-icon flag-icon-<?php echo strtolower($jobs['location']) ;?> h4 mb-0"
                              id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i></span>
                 </div>
                 <div class="px-3 clear-float">
                     <div class="description">Shared public - <?php echo $this->timeAgo($jobs['created_on']); ?></div>
                     <div class="description">Deadline -  <?php echo $this->htmlspecialcharss($jobs['deadline']); ?></div>
                  </div>
              </div>
  
            </div>
          </div> <!-- col -->
  
         <?php     $rowCount++;
                  if($rowCount % $numOfCols == 0) echo '</div><div class="row mySlidesx mySlidesx2">';
           } ?>
  
          </div>
          <!-- Next/prev buttons -->
          <a class="prev" onclick="plusSlides2(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides2(1)">&#10095;</a>
        </div>
          <!-- Dots/bullets/indicators -->
          <div class="dot-container">
              <span class="dot dot2" onclick="currentSlide2(1)"></span>
              <span class="dot dot2" onclick="currentSlide2(2)"></span>
              <span class="dot dot2" onclick="currentSlide2(3)"></span>
          </div>
      </div>
  
     <?php  }
  

      public function inbox($sessions)
      {
          $mysqli = $this->database;
          $query= $mysqli->query("SELECT * FROM users U Left JOIN apply_job A ON A. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = A. job_id0  WHERE A. email_sent_to= '$sessions' AND A. type_of_email = 'inbox' ORDER BY created_on0 DESC ");
          while($apply = $query->fetch_array()) { 
              # code...
         echo '
               <tr class="inbox-view more" data-cv_id="'.$apply['cv_id'].'" data-business="'.$apply['business_id'].'" >
                     <td><input type="checkbox" name="a'.$apply['cv_id'].'" value="'.$apply['cv_id'].'"></td>
                     <td class="mailbox-star"><a href="#"><i class="fa fa-star text-warning"></i></a></td>
                     <td class="mailbox-name inbox-view more"><a href="#">'.$apply['firstname0']." ".$apply['lastname0'].'</a></td>
                     <td class="mailbox-subject"><b>'.$apply['job_title'].'</b> - '.$apply['addition_information'].'
                     </td>
                     <td class="mailbox-attachment">'.((!empty($apply['uploadfilecv']))? '<i class="fa fa-paperclip"></i>':'' ).'</td>
                     <td class="mailbox-date">'.$this->timeAgo($apply['created_on0']).'</td>
                </tr>';
  
          }
      }
  
      public function sentInbox($sessions)
      {
          $mysqli = $this->database;
          
          $query= $mysqli->query("SELECT * FROM users U Left JOIN apply_job A ON A. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = A. job_id0  WHERE A. email_sent_for= '$sessions' AND A. type_of_email = 'sent' ORDER BY created_on0 DESC ");
          while($apply = $query->fetch_array()) { 
              # code...
         echo '
               <tr class="inbox-view more" data-cv_id="'.$apply['cv_id'].'" data-business="'.$apply['business_id'].'" >
                     <td><input type="checkbox" name="a'.$apply['cv_id'].'" value="'.$apply['cv_id'].'"></td>
                     <td class="mailbox-star"><a href="#"><i class="fa fa-star text-warning"></i></a></td>
                     <td class="mailbox-name inbox-view more"><a href="#">'.$apply['firstname0']." ".$apply['lastname0'].'</a></td>
                     <td class="mailbox-subject"><b>'.$apply['job_title'].'</b> - '.$apply['addition_information'].'
                     </td>
                     <td class="mailbox-attachment">'.((!empty($apply['uploadfilecv']))? '<i class="fa fa-paperclip"></i>':'' ).'</td>
                     <td class="mailbox-date">'.$this->timeAgo($apply['created_on0']).'</td>
                </tr>';
  
          }
      }
  
      public function trash($sessions)
      {
          $mysqli = $this->database;
          $query= $mysqli->query("SELECT * FROM users U Left JOIN trash T ON T. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = T. job_id0  WHERE T. business_id0= '$sessions' ORDER BY created_on0 DESC ");
          while($trash = $query->fetch_array()) { 
              # code...
         echo '
               <tr class="trash-view more" data-trash_id="'.$trash['trash_id'].'" data-business="'.$trash['business_id'].'" >
                     <td><input type="checkbox"></td>
                     <td class="mailbox-star"><a href="#"><i class="fa fa-star text-warning"></i></a></td>
                     <td class="mailbox-name trash-view more"><a href="#">'.$trash['firstname0']." ".$trash['lastname0'].'</a></td>
                     <td class="mailbox-subject"><b>'.$trash['job_title'].'</b> - '.$trash['addition_information'].'
                     </td>
                     <td class="mailbox-attachment">'.((!empty($trash['uploadfilecv']))? '<i class="fa fa-paperclip"></i>':'' ).'</td>
                     <td class="mailbox-date">'.$this->timeAgo($trash['created_on0']).'</td>
                </tr>';
          }
      }
  

      public function searchJobs($search)
      {
          $mysqli= $this->database;
          $param= '%'.$search.'%';
          $query = "SELECT * FROM users Left JOIN jobs ON business_id= user_id WHERE turn = 'on' AND job_title LIKE '{$param}' ";
          $result= $mysqli->query($query);
          $contacts = array();
          while ($row= $result->fetch_array()) {
              $contacts[] = array(
              'user_id' => $row['user_id'],
              'job_id' => $row['job_id'],
              'job_title' => $row['job_title'],
              'companyname' => $row['companyname'],
              'created_on' => $row['created_on'],
              'location' => $row['location'],
              'business_id' => $row['business_id'],
              'deadline' => $row['deadline'],
              'profile_img' => $row['profile_img']
             );
          }
          return $contacts; // Return the $contacts array
      }
  
      public function search_email_composer($search)
      {
          $mysqli= $this->database;
          $param= '%'.$search.'%';
          $query = "SELECT email,user_id FROM users WHERE email LIKE '{$param}' ";
          $result= $mysqli->query($query);
          $contacts = array();
          while ($row= $result->fetch_array()) {
              $contacts[] = $row;
          }
          return $contacts; // Return the $contacts array
      }
  
      
    public function InboxDelete($table,$id,$datetime)
    {
        $mysqli= $this->database;
        $sql = "INSERT INTO $table (cv_id, firstname0, middlename0, lastname0, email0, address0, telephone, degree,
        field, uploadfilecv, uploadfilecertificates, addition_information, user_id0, job_id0, business_id0, 
        email_sent_for, email_sent_to, subject_composer, type_of_email, email_status,
        created_on0) SELECT cv_id, firstname0, middlename0, lastname0, email0, address0, 
        telephone, degree, field, uploadfilecv, uploadfilecertificates, addition_information, user_id0, job_id0, business_id0,
        email_sent_for, email_sent_to, subject_composer, type_of_email, email_status, created_on0 FROM apply_job WHERE cv_id= $id";
        
        // $sql = "INSERT INTO $table  (SELECT * FROM apply_job WHERE cv_id= $id )";
        $query= $mysqli->query($sql);
        var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

    public function TrashDelete($table,$id,$datetime)
    {
        $mysqli= $this->database;
        $sql = "DELETE FROM $table WHERE trash_id= $id ";
        
        $query= $mysqli->query($sql);
        var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

    
    public function TrashAllDelete($table,$id,$datetime)
    {
        $mysqli= $this->database;
        $i=1;
        while ($i < count($id)) { 

            $id_= $id[$i];
        $sql = "DELETE FROM $table WHERE cv_id= $id_";

        $query1= "SELECT * FROM $table  WHERE cv_id= $id_ ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['uploadfilecertificates'])){
            $file=$rows['uploadfilecv'].'='.$rows['uploadfilecertificates'];
            $expodefile = explode("=",$file);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','ocx','lsx'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$file);
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                      unlink($uploadDir.$file);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                      unlink($uploadDir.$file);
            }
        }
        
        $query= $mysqli->query($sql);
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
            $i++ ;

       }
    }


}


?>