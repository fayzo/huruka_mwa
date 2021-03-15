
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title>Jobs</title>
<?php include "header_navbar_footer/header.php"?>
      <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
          <?php if (isset($_SESSION['job_user'])) { ?>
            <button type="button" class="btn btn-light" id="addPostsjobs" > + Add jobs </button>
           <?php } ?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Job</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">

          </div>
        </div>
      </header>

      <section class="content container">
      
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <h4><i>Jobs</i></h4>
            </div>
            <div class="col-sm-12 col-md-10">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <?php if (isset($_SESSION['key'])){ ?>
                    <?php if ($user['user_id'] === $_SESSION['key']) { ?>
                    <li class="breadcrumb-item"><span id="messagePopup" class="more" data-user="<?php echo $user['user_id'];?>"><a href="javascript:void(0);" ><i class="fa fa-envelope-o"></i> Message </a></span></li>
                    <?php } } ?>
                    <li class="breadcrumb-item active"><i><a href="javascript:void(0);" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'">Profile</a></i></li>
                    <li class="breadcrumb-item active"><i><a href="javascript:void(0);" <?php echo (isset($_SESSION['key']))?'class="post_as" data-post_as="1"':'id="login-please" data-login="1"';?>> Post a jobs</a></i></li>
                    <!-- <li class="breadcrumb-item active"><i><a href="javascript:void(0);" class="price-jobs" data-pricejob="1"> Post a jobs</a></i></li> -->
                </ol>
            </div>
        </div>

        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block">

            <?php echo $home->userProfile($user_id); ?>
            <?php echo $trending->trends(); ?>
            <!-- Profile Image -->

          </div>
          <div class="col-md-6 mb-4">
                <div class="row">
                    <div class="col-md-12 mb-4"  id="jobs-hides">
                        <!-- jobs -->
                            <?php echo $job->jobsfetchALL('Featured',1) ;?>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
          </div>
          <!-- col -->

          <div class="col-md-3 d-none d-md-block">
            <!-- whoTofollow: user whoTofollow style 1 -->
            <?php echo $follow->whoTofollow($user_id,$user_id) ;?>

            <div class="sticky-top" style="top: 52px;z-index:1000;">
               <?php echo $home->options(); ?>
            </div>
          
          </div>
          <!-- col -->
        </div>
        <!-- row -->

      </section>
      <!-- /.content -->


      <div id="addPostjobs" class="modal fade">
              <!-- <div style="max-width: 800px;margin: 1.75rem auto;position: relative;"> -->
              <div class="modal-dialog" style="max-width: 800px;margin: 1.75rem auto;position: relative;">
                <div class="modal-content">
                    <!-- <form method="post" id="form1" action='< ?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' enctype="multipart/form-data" > -->
                  <form method="post" id="form1" >
                    <div class="modal-header text-center">
                      <h4><i>Jobs To Posts</i> </h4>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body">
                         <span id="responseBusinessJobs1"></span>
                             <!-- <input type="hidden" name="key" value="create"> -->
                             <input type="hidden" id="id_posts1" name="id_posts1" value="0">
                             <input type="hidden" id="businessID_posts1" name="businessID_posts1" value="<?php echo $_SESSION['key'] ;?>">
                                   
                              <div class="form-group">
                                    <select class="form-control" name="categories_jobs1" id="categories_jobs1">
                                      <option value="">Select what types of Posts</option>
                                      <option value="Featured">Jobs</option>
                                      <option value="Tenders">Tenders</option>
                                      <option value="Consultancy">Consultancy</option>
                                      <option value="Internships">Internships</option>
                                      <option value="Public">Public job as goverment</option>
                                      <option value="Training">To Training</option>
                                    </select>
                              </div>

                              <div class="form-group">
                                   <label for="jobs title">Job Title</label>
                                   <input type="text" name="job-title1" class="form-control job-title1"  placeholder="job title">
                               </div>
                               <div class="form-group">
                                   <label for="Job Summary">Job Summary</label>
                                   <textarea id="editor1" name="editor1" class="job-summary1" rows="10" cols="80">
                                    </textarea>
                               </div>
                               <!-- <div class="form-group">
                                   <label for="Job Summary">Job Summary</label>
                                   <textarea class="form-control textarea  job-summary1" id="editor7"  rows="4"  placeholder="job summary"></textarea>
                               </div> -->
                               <!-- <div class="form-group">
                                   <label for="email">Responsibilities and Duties</label>
                                   <textarea class="form-control textarea  responsibilities-duties1" id="editor8"  rows="4" placeholder="Responsibilities Duties"></textarea>
                               </div>
                               <div class="form-group">
                                   <label for="Pages Body">Qualifications and Skills</label>
                                   <textarea class="form-control textarea  qualifications-skills1" id="editor9" placeholder="Qualifications and Skills"  rows="4"></textarea>
                               </div>
                               <div class="form-group">
                                   <label for="Pages Body">Terms and conditions</label>
                                   <textarea class="form-control textarea terms-conditions1" id="editor10" placeholder="Qualifications and Skills"  rows="4"></textarea>
                               </div> -->
                               <div class="form-group">
                                   <label for="Pages Body">Deadline to submit</label>
                                    <input type="date" name="deadline1" class="form-control deadline1" placeholder="Deadline to submit">
                                   <!-- <textarea class="form-control textarea deadline1" id="editor11" placeholder="Deadline to submit"  rows="4"></textarea> -->
                               </div>
                               <div class="form-group">
                                   <label for="Pages Body">Apply to website or to this site</label>
                                   <textarea name="website1" class="form-control website1" id="editor12" placeholder="website" ></textarea>
                               </div>
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <input type="checkbox" class="form-check-input"   value="checkedValue" checked>
                                       Publish
                                   </label>
                               </div>
                       </div> <!-- THiS IS A MODAL BODY -->
                       <div class="modal-footer">
                           <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                           <input type="button" id="addposts" value="Save" class="btn btn-success">
                       </div><!-- THiS IS A MODAL FOOTER -->
                       </form>  
                  </div><!-- THiS IS A MODAL CONTENT -->
                </div><!-- THiS IS A MODAL DIALOG -->
            </div><!-- THiS IS A MODAL FADE -->



<?php include "header_navbar_footer/footer.php"?>
