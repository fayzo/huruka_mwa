<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 } 

class Job extends Follow {

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
        // $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.turn = 'on' and J. business_id = '{$user_id}' and J. deadline > CURDATE()");
        $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J. business_id = '{$user_id}' ");
        ?>
        <div class="card">
            <div class="card-header main-active">
             <h5 class="text-center">jobs</h5>
            </div>
            <div class="card-body">
              <div class="row ">
           
          <?php while($jobs= $query->fetch_array()) { ?>
            <div class="col-12 px-0 ">
               <div class="user-block mb-2 jobHover jobHovers more" data-job="<?php echo $jobs['job_id'];?>"  data-business="<?php echo $jobs['business_id'];?>" >
                    <div class="user-jobImgall">
                        <?php if (!empty($jobs['profile_img'])) {?>
                        <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                        <?php  }else{ ?>
                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                        <?php } ?>
                    </div>
                    <span><a href="#"> <!-- Job Title: --> <?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></a></span>
                     <?php echo ($jobs["turn"] == 'on')?
                     '<span class="bg-success rounded text-white px-1"> Job Online</span>' 
                     :'<span class="bg-danger rounded text-white px-1"> Job Offline</span>' ;?>
                     <br>
                    <span class="description description-job">
                        <?php echo $this->htmlspecialcharss($jobs['companyname']); ?> || 
                        <i style="font-size:12px" class="flag-icon flag-icon-<?php echo strtolower( $jobs['location']) ;?> h4 mb-0"
                            id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i>
                        <div> Shared public - <?php echo $this->timeAgo($jobs['created_on']); ?></div>
                        <div> Deadline - <?php echo date("M j, Y",strtotime($this->htmlspecialcharss($jobs['deadline']))); ?></div>
                    </span>            
                </div> <!-- user-block -->
                <div>
                        <?php echo '
                                <a href="job_apply?job_id='.$jobs["job_id"].'&business_id='.$jobs["business_id"].'" class="btn btn-primary">Show Who applies ('.$this->count_job_apply($jobs["business_id"],$jobs["job_id"]).') </a>
                                <input type="button" onclick="PostsEdits('.$jobs["job_id"].','.$jobs["business_id"].', \'edit\')" value="Edit" class="btn btn-primary">
                                <input type="button" onclick="PostsEdits('.$jobs["job_id"].','.$jobs["business_id"].', \'view\')" value="View" class="btn">
                                <input type="button" onclick="shows('.$jobs["job_id"].',\'on\')" value="turn on" class="btn btn-warning">
                                <input type="button" onclick="shows('.$jobs["job_id"].',\'off\')" value="turn off" class="btn btn-danger">
                                ';?>
                                <!-- <input type="button" onclick="jobsdeleteRow('.$jobs["job_id"].')" value="Delete" class="btn btn-danger"> -->
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
        $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.turn = 'on' and J. deadline > CURDATE() ORDER BY rand() LIMIT 4 ");
        if ($query->num_rows > 0) {
        ?>
        <div class="card card-primary mb-3 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title text-center"><i> Jobs</i></h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body message-color pt-0 pb-0">
        <div class="row">
          <?php while($jobs= $query->fetch_array()) { 

                    $title= $jobs['job_title'];

                    if (strlen($title) > 40) {
                         $title = substr($title,0,40).'...';
                    }else{
                         $title;
                    }
              ?>

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
                       <a style="padding-right:3px;" href="#"><?php echo $title ;?></a> 
                   </span>
                   <span class="description description-job">
                        <?php echo $this->htmlspecialcharss($jobs['companyname']); ?> || 
                        <span style="font-size:12px" class="flag-icon flag-icon-<?php echo strtolower( $jobs['location']) ;?>"
                        id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></span><br>
                        <div>Publish - <?php echo $this->timeAgo($jobs['created_on']); ?></div>
                        <div>Deadline -  <?php echo date("M j, Y",strtotime($this->htmlspecialcharss($jobs['deadline']))); ?></div>
                    </span>
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
       
       <?php }else{
                echo $this->options();
             }
    
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
                $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J. turn = 'on' and J. deadline > CURDATE() ORDER BY rand() Desc Limit $showpages,10");
            } else {
                # code...
                $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.categories_jobs ='$categories' AND J. turn = 'on' and J. deadline > CURDATE() ORDER BY rand() Desc Limit $showpages,10");
            }
            
            ?>
            <div class="card card-primary mb-1 ">
            <div class="card-header main-active p-1">
                <h5 class="card-title float-left pl-2"><i> Jobs to Search</i></h5>
                <form class="form-inline float-right" style="width: 200px;">
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

            <div class="card-body px-1">
            <span class="job-show"></span>
            <div class="job-hide">
            <?php
            if ($query->num_rows > 0) { 
            
            while($jobs= $query->fetch_array()) { ?>

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
                    <span class="description description-job">
                        <?php echo $this->htmlspecialcharss($jobs['companyname']); ?> || 
                        <i style="font-size:12px" class="flag-icon flag-icon-<?php echo strtolower( $jobs['location']) ;?> h4 mb-0"
                            id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i>
                        <div> Shared public - <?php echo $this->timeAgo($jobs['created_on']); ?></div>
                        <div> Deadline - <?php echo date("M j, Y",strtotime($this->htmlspecialcharss($jobs['deadline']))); ?></div>
                    </span>            
                </div> <!-- user-block -->
            </div> <!-- col-12 -->
            <hr class="bg-info mt-0 mb-1" style="width:95%;">
            <?php }

            }else{
                echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                        <button class="close" data-dismiss="alert" type="button">
                            <span>&times;</span>
                        </button>
                        <strong>No Record</strong>
                    </div></div>'; 
            } 

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
                $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J. turn = 'on' and J. deadline > CURDATE() ORDER BY rand() Desc Limit $showpages,10");
            } else {
                # code...
                $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.categories_jobs ='$categories' AND J. turn = 'on' and J. deadline > CURDATE() ORDER BY rand() Desc Limit $showpages,10");
            }

            ?>
            <div class="card card-primary mb-1 ">
            <div class="card-header main-active p-1">
                <h5 class="card-title float-left pl-2"><i> Jobs to Search</i></h5>
                <form class="form-inline float-right" style="width: 200px;">
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

            <div class="card-body">
            <span class="job-show"></span>
            <div class="job-hide row">
                <div class="col-md-6 large-2 px-1">
                <?php 
                if ($query->num_rows > 0) { 

                while($jobs= $query->fetch_array()) { ?>

                <div class="px-0 py-2 jobHover jobHovers0 more" data-job="<?php echo $jobs['job_id'];?>" data-business="<?php echo $jobs['business_id'];?>">
                <div class="user-block mb-2" >
                    <div class="user-jobImgall">
                            <?php if (!empty($jobs['profile_img'])) {?>
                            <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $jobs['profile_img'] ;?>" alt="User Image">
                            <?php  }else{ ?>
                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                            <?php } ?>
                    </div>
                    <span> <a href="#"> <!-- Job Title: --> <?php echo $this->htmlspecialcharss($jobs['job_title']) ;?></a></span><br>
                    <span class="description description-job">
                            <?php echo $this->htmlspecialcharss($jobs['companyname']); ?> || 
                            <i style="font-size:12px" class="flag-icon flag-icon-<?php echo strtolower( $jobs['location']) ;?> h4 mb-0"
                                id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i>
                        <div> Shared public - <?php echo $this->timeAgo($jobs['created_on']); ?></div>
                        <div> Deadline - <?php echo date("M j, Y",strtotime($this->htmlspecialcharss($jobs['deadline']))); ?></div>
                    </span>            
                </div> <!-- user-block -->
            </div> <!-- col-12 -->
            <hr class="bg-info mt-0 mb-1" style="width:95%;">
            <?php } 

            }else{
                echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                        <button class="close" data-dismiss="alert" type="button">
                            <span>&times;</span>
                        </button>
                        <strong>No Record</strong>
                    </div></div>'; 
            } 

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
                $sql= $db->query("SELECT COUNT(*) FROM jobs WHERE turn = 'on' and deadline > CURDATE()");
            } else {
                # code...
                $sql= $db->query("SELECT COUNT(*) FROM jobs WHERE categories_jobs ='$categories' AND turn = 'on' and deadline > CURDATE()");
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
            $query= $mysqli->query("SELECT * FROM  users U Left JOIN  jobs J ON J. business_id = U. user_id WHERE J.turn = 'on' and J. deadline > CURDATE() ORDER BY rand() LIMIT 6");
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
                    <div class="description">Deadline -  <?php echo date("M j, Y",strtotime($this->htmlspecialcharss($jobs['deadline']))); ?></div>
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

        public function inbox($sessions,$email)
        {
            $mysqli = $this->database;
            // $query= $mysqli->query("SELECT * FROM users U Left JOIN email_apply_job A ON A. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = A. job_id0  WHERE A. email_sent_to= '$sessions' AND A. type_of_email = 'inbox' ORDER BY A. created_on0 DESC ");
            $query= $mysqli->query("SELECT * FROM email_apply_job A LEFT JOIN jobs J ON J. job_id = A. job_id0 WHERE A. email_sent_to= '$email' AND A. type_of_email = 'inbox' ORDER BY A. created_on0 DESC ");
            // var_dump($email);

            while($apply = $query->fetch_array()) { 

                    $message = htmlspecialchars_decode($apply['addition_information']);

                    if(strlen($message) > 10) {
                    $message = substr($message,0,10).' read more ...';
                    }else{
                    $message;
                    }

                    $title= $apply['job_title'];

                    if (strlen($title) > 40) {
                         $title = substr($title,0,40).'...';
                    }else{
                         $title;
                    }
        echo '
                <tr class="more" >
                    <td><input type="checkbox" name="a'.$apply['cv_id'].'" value="'.$apply['cv_id'].'"></td>
                    <td class="mailbox-star" ><a href="#"><i class="fa fa-star text-warning"></i></a></td>
                    <td class="mailbox-name inbox-view " data-cv_id="'.$apply['cv_id'].'"  >
                    <a href="#">'.$apply['email_sent_from'].'</a></td>
                    <td class="mailbox-subject inbox-view" data-cv_id="'.$apply['cv_id'].'"  ><b>'.$title.' '.$message.'<b></td>
                    <td class="mailbox-attachment">'.((!empty($apply['uploadfilecv']))? '<i class="fa fa-paperclip"></i>':'' ).'</td>
                    <td class="mailbox-date">'.$this->timeAgo($apply['created_on0']).'</td>
                </tr>';

            }
        }

        public function sentInbox($sessions)
        {
            $mysqli = $this->database;
            
            // $query= $mysqli->query("SELECT * FROM users U Left JOIN email_apply_job A ON A. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = A. job_id0  WHERE A. email_sent_from_id= '$sessions' AND A. type_of_email = 'sent' ORDER BY created_on0 DESC ");
            $query= $mysqli->query("SELECT * FROM email_apply_job A LEFT JOIN jobs J ON J. job_id = A. job_id0 WHERE A. email_sent_from_id= '$sessions' AND A. type_of_email = 'sent' ORDER BY A. created_on0 DESC ");
           
            while($apply = $query->fetch_array()) { 

                    $message = htmlspecialchars_decode($apply['addition_information']);

                    if(strlen($message) > 10) {
                    $message = substr($message,0,10).' read more ...';
                    }else{
                    $message;
                    }

                    $title= $apply['job_title'];

                    if (strlen($title) > 40) {
                         $title = substr($title,0,40).'...';
                    }else{
                         $title;
                    }
                # code...
        echo '
                <tr class="more" >
                    <td><input type="checkbox" name="a'.$apply['cv_id'].'" value="'.$apply['cv_id'].'"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-warning"></i></a></td>
                    <td class="mailbox-name sent-view more" data-cv_id="'.$apply['cv_id'].'"  ><a href="#">'.$apply['email_sent_to'].'</a></td>
                    <td class="mailbox-subject sent-view" data-cv_id="'.$apply['cv_id'].'"  ><b>'.$title.' '.$message.'<b></td>
                    <td class="mailbox-attachment">'.((!empty($apply['uploadfilecv']))? '<i class="fa fa-paperclip"></i>':'' ).'</td>
                    <td class="mailbox-date">'.$this->timeAgo($apply['created_on0']).'</td>
                </tr>';

            }
        }

        public function trash($sessions,$email)
        {
            $mysqli = $this->database;
            // $query= $mysqli->query("SELECT * FROM users U Left JOIN trash T ON T. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = T. job_id0  WHERE T. business_id0= '$sessions' ORDER BY created_on0 DESC ");
            $query= $mysqli->query("SELECT * FROM email_trash T LEFT JOIN jobs J ON J. job_id = T. job_id0 WHERE T. email_sent_to= '$email' ORDER BY T.created_on0 DESC ");

            while($trash = $query->fetch_array()) {

                $message = htmlspecialchars_decode($trash['addition_information']);

                if(strlen($message) > 10) {
                $message = substr($message,0,10).' read more ...';
                }else{
                $message;
                }
                
                $title= $trash['job_title'];

                if (strlen($title) > 40) {
                     $title = substr($title,0,40).'...';
                }else{
                     $title;
                }

                # code...
        echo '
                <tr class="more">
                    <td><input type="checkbox" name="a'.$trash['cv_id'].'" value="'.$trash['cv_id'].'"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-warning"></i></a></td>
                    <td class="mailbox-name trash-view" data-cv_id="'.$trash['cv_id'].'"  ><a href="#">'.$trash['email_sent_from'].'</a></td>
                    <td class="mailbox-subject trash-view" data-cv_id="'.$trash['cv_id'].'"><b>'.$title.' '.$message.'<b></td>
                    <td class="mailbox-attachment">'.((!empty($trash['uploadfilecv']))? '<i class="fa fa-paperclip"></i>':'' ).'</td>
                    <td class="mailbox-date">'.$this->timeAgo($trash['created_on0']).'</td>
                </tr>';
            }
        }

        public function searchJobs($search)
        {
            $mysqli= $this->database;
            $param= '%'.$search.'%';
            $query = "SELECT * FROM users U Left JOIN jobs J ON J. business_id= U. user_id WHERE J. turn = 'on' AND J. job_title LIKE '{$param}' AND J. deadline > CURDATE() ";
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

            $sql = "INSERT INTO $table (cv_id,cv_id_radom, firstname0, middlename0, lastname0, email0, address0, telephone,
            uploadfilecv, uploadfilecertificates,cv_file_size,certificates_file_size,addition_information, user_id0, job_id0, business_id0, 
            email_sent_from,email_sent_to,email_sent_from_id, email_sent_to_id, subject_composer, type_of_email, email_status,
            created_on0) SELECT cv_id,cv_id_radom, firstname0, middlename0, lastname0, email0, address0, telephone,
            uploadfilecv, uploadfilecertificates,cv_file_size,certificates_file_size,addition_information, user_id0, job_id0, business_id0, 
            email_sent_from,email_sent_to,email_sent_from_id, email_sent_to_id, subject_composer, type_of_email, email_status,
            created_on0 FROM email_apply_job WHERE cv_id= $id";
            
            // $sql = "INSERT INTO $table  (SELECT * FROM email_apply_job WHERE cv_id= $id )";
            $query= $mysqli->query($sql);

            $sql_ = "DELETE FROM email_apply_job WHERE cv_id= $id ";
            return $query_= $mysqli->query($sql_);

            // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

            // if($query){
            //         exit('<div class="alert alert-success alert-dismissible fade show text-center">
            //             <button class="close" data-dismiss="alert" type="button">
            //                 <span>&times;</span>
            //             </button>
            //             <strong>SUCCESS</strong> </div>');
            //     }else{
            //         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
            //             <button class="close" data-dismiss="alert" type="button">
            //                 <span>&times;</span>
            //             </button>
            //             <strong>Fail input try again !!!</strong>
            //         </div>');
            // }
        }

        public function SentDelete($table,$id,$datetime)
        {
            $mysqli= $this->database;
            $sql = "DELETE FROM $table WHERE cv_id= $id ";

            $query0= "SELECT * FROM $table  WHERE cv_id= $id";
            $result= $mysqli->query($query0);
            $rows0= $result->fetch_assoc();

            // $query1= "SELECT * FROM $table  WHERE cv_id= $id ";
            $query1= "SELECT COUNT(*) as total_count, uploadfilecv,uploadfilecertificates  FROM $table WHERE cv_id_radom= $rows0[cv_id_radom]";
            $result= $mysqli->query($query1);
            $rows= $result->fetch_assoc();
            
            // var_dump('ERROR: Could not able to execute'. $result.mysqli_error($mysqli));
            // var_dump($query1);
            // var_dump($rows);

            if ($rows['total_count'] === '1' && $rows['uploadfilecv'] != '' && $rows['uploadfilecv'] != 'no file') {
                if (!empty($rows['uploadfilecertificates'])) {
                    # code...
                    $file=$rows['uploadfilecv'].'='.$rows['uploadfilecertificates'];
                }else{
                    $file=$rows['uploadfilecv'];
                }
                $expode = explode("=",$file);
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                for ($i=0; $i < count($expode); ++$i) { 
                    unlink($uploadDir.$expode[$i]);
                }

            }
            
            return $query= $mysqli->query($sql);
            // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

            // if($query){
            //         exit('<div class="alert alert-success alert-dismissible fade show text-center">
            //             <button class="close" data-dismiss="alert" type="button">
            //                 <span>&times;</span>
            //             </button>
            //             <strong>SUCCESS</strong> </div>');
            //     }else{
            //         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
            //             <button class="close" data-dismiss="alert" type="button">
            //                 <span>&times;</span>
            //             </button>
            //             <strong>Fail input try again !!!</strong>
            //         </div>');
            // }

        }

        public function TrashDelete($table,$id,$id_radom,$datetime)
        {
            $mysqli= $this->database;
            $sql = "DELETE FROM $table WHERE cv_id= $id ";

            // $query1= "SELECT * FROM $table  WHERE cv_id= $id ";

            $query1= "SELECT COUNT(*) as total_count, T. uploadfilecv,T. uploadfilecertificates FROM $table T LEFT JOIN email_apply_job A ON A. cv_id_radom = $id_radom  WHERE T. cv_id_radom= $id_radom";
            // var_dump($query1);

            $result= $mysqli->query($query1);
            $rows= $result->fetch_assoc();
            // var_dump($rows,$rows['total_count']);

            # code...
            if ($rows['total_count'] === '1' && $rows['uploadfilecv'] != '' && $rows['uploadfilecv'] != 'no file') {
                if (!empty($rows['uploadfilecertificates'])) {
                    # code...
                    $file=$rows['uploadfilecv'].'='.$rows['uploadfilecertificates'];
                }else{
                    $file=$rows['uploadfilecv'];
                }
                $expode = explode("=",$file);
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                for ($i=0; $i < count($expode); ++$i) { 
                    unlink($uploadDir.$expode[$i]);
                }
                
                var_dump('gud');
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
        }


        public function TrashAllDelete($table,$id,$datetime)
        {
            $mysqli= $this->database;
            $sql = "DELETE FROM $table WHERE cv_id= $id";
            // var_dump($id_,$table);

            $query0= "SELECT * FROM $table  WHERE cv_id= $id";
            $result= $mysqli->query($query0);
            $rows0= $result->fetch_assoc();

            $query1= "SELECT COUNT(*) as total_count, T. uploadfilecv,T. uploadfilecertificates FROM $table T LEFT JOIN email_apply_job A ON A. cv_id_radom = '$rows0[cv_id_radom]'  WHERE T. cv_id_radom= '$rows0[cv_id_radom]' ";

            $result= $mysqli->query($query1);
            $rows= $result->fetch_assoc();
            // var_dump($rows,$rows['total_count']);

            if ($rows['total_count'] === '1' && $rows['uploadfilecv'] != '' && $rows['uploadfilecv'] != 'no file') {
                if (!empty($rows['uploadfilecertificates'])) {
                    # code...
                    $file=$rows['uploadfilecv'].'='.$rows['uploadfilecertificates'];
                }else{
                    $file=$rows['uploadfilecv'];
                }
                $expode = explode("=",$file);
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                for ($i=0; $i < count($expode); ++$i) { 
                    unlink($uploadDir.$expode[$i]);
                }

            }
            
            return $query= $mysqli->query($sql);
            // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

            // if($query){
            //             exit('<div class="alert alert-success alert-dismissible fade show text-center">
            //                 <button class="close" data-dismiss="alert" type="button">
            //                     <span>&times;</span>
            //                 </button>
            //                 <strong>SUCCESS</strong> </div>');
            // }else{
            //             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
            //                 <button class="close" data-dismiss="alert" type="button">
            //                     <span>&times;</span>
            //                 </button>
            //                 <strong>Fail input try again !!!</strong>
            //             </div>');
            // }

        }

        
    public function count_job_apply($business_id,$job_id)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM email_apply_job WHERE job_id0= '$job_id' and business_id0= '$business_id' AND type_of_email = 'inbox' ");
        $row_unapproval = $sql->fetch_array();
        $total_unapprovalcomm= array_shift($row_unapproval);
        $array= array(0,$total_unapprovalcomm);
        $total_unapproval= array_sum($array);
        return $total_unapproval;
    }
        
    public function count_inbox_job($email)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM email_apply_job WHERE email_sent_to= '$email' AND type_of_email = 'inbox' ");
        $row_unapproval = $sql->fetch_array();
        $total_unapprovalcomm= array_shift($row_unapproval);
        $array= array(0,$total_unapprovalcomm);
        $total_unapproval= array_sum($array);
        echo $total_unapproval;
    }

        
    public function count_sent_job($user_id)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM email_apply_job WHERE email_sent_from_id= '$user_id' AND type_of_email = 'sent' ");
        $row_unapproval = $sql->fetch_array();
        $total_unapprovalcomm= array_shift($row_unapproval);
        $array= array(0,$total_unapprovalcomm);
        $total_unapproval= array_sum($array);
        echo $total_unapproval;
    }

    public function count_trash_job($email)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM email_trash WHERE email_sent_to= '$email' ");
        $row_unapproval = $sql->fetch_array();
        $total_unapprovalcomm= array_shift($row_unapproval);
        $array= array(0,$total_unapprovalcomm);
        $total_unapproval= array_sum($array);
        echo $total_unapproval;
    }


}

$job= new Job();

?>
