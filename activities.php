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
            <a class="blog-header-logo text-dark" href="#">Activities</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">

          </div>
        </div>
    </header>

<div class="container-fluid mb-3">
   <section class="content-header">
        <div class="row">
            <div class="col-6">
                <h5><i>Your Activities</i></h5>
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
                        <h4>Search <br> Edit & Delete</h4>
                    </div>
                </div>
            </div> <!-- card -->
         </div> <!-- col -->

         <div class="col-md-6 ">

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link  active" href="#jobs"
                                data-toggle="tab">Jobs</a> </li>
                            <li class="nav-item"><a class="nav-link" href="#fundraisings"
                                data-toggle="tab">Fundraisings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#Crowfundraising"
                                data-toggle="tab">Crowfundraising</a></li>
                            <li class="nav-item"><a class="nav-link" href="#House"
                                data-toggle="tab">House</a></li>
                            <li class="nav-item"><a class="nav-link" href="#car"
                                data-toggle="tab">Car</a></li>
                            <li class="nav-item"><a class="nav-link" href="#icyamunara"
                                data-toggle="tab">icyamunara</a></li>
                            <li class="nav-item"><a class="nav-link" href="#sale"
                                data-toggle="tab">Sale</a></li>
                        </ul>
                </div>
                <div class="card-body">
                <div class="tab-content">
                        <div class="tab-pane active " id="jobs">
                            <?php echo $job->jobsactivities($_SESSION['key']); ?>
                        </div> 
                        <div class="tab-pane" id="fundraisings">
                            <?php echo $fundraising->fundraisingsActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="Crowfundraising">
                        <!-- < ?php echo $home->eventsListActivities($_SESSION['key']); ?> -->
                        <?php echo $crowfund->crowfundraisingsActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="House">
                            <!-- < ?php echo $home->blogsActivities($_SESSION['key']); ?> -->
                            <?php echo $car->houseListActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="car">
                        <?php echo $car->carListActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="icyamunara">
                        <?php echo $car->icyamunaraListActivities($_SESSION['key']); ?>
                        </div>
                        <div class="tab-pane" id="sale">
                            <?php echo $sale->saleActivities($_SESSION['key']); ?>
                        </div>
                    </div> <!-- /.tab-content -->
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>

            </div> <!-- col -->

            <div class="col-md-3 d-none d-md-block">

                <div class="card">
                    <div class="card-header">
                        <div class="single-howit-works">
                            <img src="<?php echo  BASE_URL_LINK ;?>image/img/howit-works/howit-works-1.png" alt="">
                            <h4>Search <br> Edit & Delete</h4>
                        </div>
                    </div>
                </div> <!-- card -->
                    
            </div> <!-- col -->

        </div>

</div>

        <div id="Postjobs" class="modal fade">
             <div class="modal-dialog" style="max-width: 800px;margin: 1.75rem auto;position: relative;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                      <h4><i>Jobs To Posts</i> </h4>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                       <div class="modal-body">
                         <div class="edit-body">
                           <span id="responseBusinessJobs"></span>
                           <form method="post">
                             <!-- <input type="hidden" id="editor1" value="0"> -->
                             <input type="hidden" id="id_posts" value="0">
                             <input type="hidden" id="businessID_posts" value="<?php echo $_SESSION['key'] ;?>">
                               
                              <div class="form-group">
                                    <select class="form-control" name="categories_jobs" id="categories_jobs">
                                      <option class="categories_jobsx" value="">Select what types of jobs</option>
                                      <option value="Featured">Featured</option>
                                      <option value="Tenders">Tenders</option>
                                      <option value="Consultancy">Consultancy</option>
                                      <option value="Internships">Internships</option>
                                      <option value="Public">Public</option>
                                      <option value="Training">Training</option>
                                    </select>
                              </div>

                               <div class="form-group">
                                   <label for="jobs title">Job Title</label>
                                   <input type="text" class="form-control  job-title" placeholder="job-title">
                               </div>
                               <div class="form-group">
                                   <label for="Job Summary">Job Summary</label>
                                   <textarea class="form-control job-summary" id="editor4" rows="4"  placeholder="job summary"></textarea>
                               </div>
                               <div class="form-group">
                                    <label for="Pages Body">Deadline to submit</label>
                                    <input type="date" class="form-control deadline" placeholder="Deadline to submit">
                               </div>
                               <div class="form-group">
                                   <label for="Pages Body">Apply to website</label>
                                   <input class="form-control website" id="editor6" placeholder="website" >
                               </div>
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <input type="checkbox" class="form-check-input"   value="checkedValue" checked>
                                       Publish
                                   </label>
                               </div>
                          </form>  
                          </div> <!-- edit-body END -->

                          <div class="view-body">

                          <div style="float:right">
                              <h4>categories_jobs: </h4>
                              <p class="categories_jobs0">Examples of an Accountant Responsibilities. </p>
                          </div>

                           <h4 >Job Title: </h4>
                            <label class="job-title0">Examples of Accountant job titles </label>
                          <hr>
                      
                             <h4 >Job Summary: </h4>
                             <p class="job-summary0"> Example of an Accountant job summary. </p>
                           <hr>
                      
                            <h4 class="card-title">Deadline to submit: </h4>
                            <p class="card-title deadlin0e">Explaination of Deadline to submit: </p>
                          <hr>
                  
                            <h4 class="card-title">Apply to website: </h4>
                            <p class="card-title website0">Explaination of Apply to website: </p>
                          <hr>
                         </div><!-- THiS IS A vIew body --> 
                       </div> <!-- THiS IS A MODAL BODY -->
                       <div class="modal-footer">
                           <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                           <input type="button" id="posts" value="Save" onclick="ajax_requestsPosts('create');" class="btn btn-success">
                       </div><!-- THiS IS A MODAL FOOTER -->
                  </div><!-- THiS IS A MODAL CONTENT -->
                </div><!-- THiS IS A MODAL DIALOG -->
            </div><!-- THiS IS A MODAL FADE -->


<?php include "header_navbar_footer/footer.php"?>