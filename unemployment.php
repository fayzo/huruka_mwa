
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title>unemplyoment</title>
<?php include "header_navbar_footer/header.php"?>

<!-- container-fuild -->
      <header class="blog-header py-2 bg-light">
        <div class="row flex-nowrap justify-content-between align-items-center border-navbar">
          <div class="col-12 text-center">
           <?php echo $home->links(); ?>
          </div>
        </div>
           <!-- <div> 
           <img style="height:60px;" src="<?php echo BASE_URL_LINK;?>image/image_default/border-bottom.png" />
          </div> -->
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 ">
          <?php if (isset($_SESSION['key'])) { ?>
          <?php if ($user['unemployment'] === '') { ?>
            <button type="button" class="btn btn-light" id="addPostsjobs" > + Add Career </button>
           <?php }else{ ?>
            <button type="button" onclick="unemploymentEdits(<?php echo $_SESSION['key']; ?>)" class="btn btn-light" > + Edit Career </button>
           <?php } }?>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Unemployment</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
          </div>
        </div>
      </header>

<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i>Unemployment</i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                      <?php if (isset($_SESSION['key'])){ ?>
                      <?php if ($user['user_id'] === $_SESSION['key']) { ?>
                    <li class="breadcrumb-item"><span id="messagePopup" class="more" data-user="<?php echo $user['user_id'];?>"><a href="javascript:void(0);" ><i class="fa fa-envelope-o"></i> Message </a></span></li>
                    <li class="breadcrumb-item active"><i><a href="<?php echo PROFILE ;?>"> Profile</a></i></li>
                    <?php } } ?>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
   <?php if (isset($_SESSION['key'])){ ?>
            <div class="col-md-3 mb-3 d-none d-md-block">
                <!-- Profile Image -->
                <?php echo $home->userProfile($user_id); ?>
                <!-- hastTag Me Box -->
                 <?php echo $trending->trends(); ?>
            </div>
            <!-- /.col -->
<?php }else{ ?>
    <div class="col-md-3 mb-3 d-none d-md-block">
          <?php echo $job->jobsfetch() ;?>
    </div>
<?php } ?>

            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-12 mb-4"  id="jobs-hides">
                        <!-- jobs -->
                               <?php echo $unemployment->unemplyomentfetchALL('Featured',1) ;?>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-md-6 -->

            <div class="col-md-3">
                <div class="row">
                    <!-- <div class="col-md-12 mb-3 d-none d-md-block">
                       < ?php echo $follow->whoTofollow($user_id,$user_id) ;?>
                    </div> -->
                    <!-- /.col -->
                    <div class="col-md-12 mb-3">
                       <?php echo $home->options(); ?>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->




        <div id="addPostjobs" class="modal fade">
              <!-- <div style="max-width: 800px;margin: 1.75rem auto;position: relative;"> -->
              <div class="modal-dialog" style="max-width: 800px;margin: 1.75rem auto;position: relative;">
                <div class="modal-content">
                    <!-- <form method="post" id="form1" action='< ?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' enctype="multipart/form-data" > -->
                  <form method="post" id="form1" >
                    <div class="modal-header text-center">
                      <h4><i>Add & Edit</i> </h4>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body" id="edit-body">
                             <!-- <input type="hidden" name="key" value="create"> -->
                             <input type="hidden" id="id_posts1" name="id_posts1" value="0">
                             <input type="hidden" id="user_id1" name="user_id1" value="<?php echo $_SESSION['key'] ;?>">
                                   
                              <div class="form-group">
                                    <select class="form-control" name="Career" id="Career">
                                      <option value="">Select Career</option>
                                      <option value="unemployment">Unemployment</option>
                                      <option value="Professional">Professional</option>
                                    </select>
                              </div>
                              
                              <div class="form-group">
                                    <select class="form-control" name="years" id="years">
                                      <option value="">Select How many Year you been This in above ur selection</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10+</option>
                                    </select>
                              </div>

                              <div class="form-group">
                                  <label for="education"><i class="fa fa-book mr-1"></i> Education:</label>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon2"><i class="fa fa-book"></i>
                                          </span>
                                      </div>
                                      <input type="text" class="form-control" name="education" id="education"
                                          aria-describedby="helpId" 
                                          placeholder="High school or College or University ">
                                  </div>
                              </div>

                              <div class="form-group">
                                    <label>Field study or Experience in it </label>
                                    <!-- <input type="text" name="field" class="form-control field" id="field" placeholder="Accountant,electrician,nursery..."> -->
                                    <div class="form-group">
                                      <select class="custom-select form-control field" name="field"  id="field">
                                        <option value="">Select one</option>
                                        <option value="Business_Administration">Business Administration</option>
                                        <option value="Tourism">Tourism</option>
                                        <option value="Hospitality">Hospitality</option>
                                        <option value="Construction">Construction</option>
                                        <option value="Management">Management</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Creative_Design">Creative Design</option>
                                        <option value="Human_Resources">Human Resources</option>
                                        <option value="Health_Science">Health Science</option>
                                        <option value="Data_Analysts">Data Analysts</option>
                                        <option value="Data_Science">Data Science</option>
                                        <option value="Software_Developers">Software Developers</option>
                                        <option value="Cybersecurity_Experts">Cybersecurity Experts</option>
                                        <option value="Education">Education</option>
                                        <option value="Creative_Writing">Creative Writing</option>
                                        <option value="Nurses">Nurses</option>
                                        <option value="Computer_Enginnering">Computer Enginnering</option>
                                        <option value="Mechanical_Enginnering">Mechanical Enginnering</option>
                                        <option value="Electrical_Enginnering">Electrical Enginnering</option>
                                        <option value="Medical_Professionals">Medical Professionals</option>
                                        <option value="Plumbers">Plumbers</option>
                                        <option value="Electricians">Electricians</option>
                                        <option value="Dentists">Dentists</option>
                                        <option value="Dental">Dental</option>
                                        <option value="Technicians">Technicians</option>
                                        <option value="Mental_Health_Professional">Mental Health Professional</option>
                                      </select>
                                    </div>
                              </div>

                              <div class="form-group">
                                    <select class="form-control" name="diploma" id="diploma">
                                      <option value="">Select Diploma you obtain</option>
                                      <option value="High Diploma">High School Diploma</option>
                                      <option value="Certificate">Certificate</option>
                                      <option value="Advance Diploma">Advance diploma</option>
                                      <option value="Degree">Degree</option>
                                      <option value="Master">Master</option>
                                      <option value="Phd">Phd</option>
                                    </select>
                              </div>

                              <div class="form-group">
                                   <label for="jobs title">Your Age</label>
                                   <input type="text" name="age" class="form-control age" id="age" placeholder="Ex: 19,20,24,39,57....">
                               </div>

                               <div class="form-group">
                                    <select class="form-control" name="status" id="status">
                                      <option value="">Select Status</option>
                                      <option value="Single">Single</option>
                                      <option value="Married">Married</option>
                                    </select>
                              </div>

                              <div class="form-group">
                                   <label for="jobs title">Phone</label>
                                   <input type="text" name="phone" class="form-control phone" id="phone"  placeholder="phone number +(250)">
                                </div>
                              <div class="form-group">
                                    <label for="">Course you learn in each word add coma</label>
                                    <input type="text" name="course" class="form-control course" id="course" placeholder="Ex: Finance,Account,Computer system,Fine Arts,....">
                             </div>
                            <div class="form-group">
                                <label for="Job Summary">Brief About you as Cv</label>
                                <textarea id="editor1" name="editor1" class="job-summary1" rows="10" cols="80">
                                </textarea>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"   value="checkedValue" checked>
                                    Publish
                                </label>
                            </div>
                               
                            <div id="responseBusinessJobs1"></div>
                       </div> <!-- THiS IS A MODAL BODY -->
                       <div class="modal-footer">
                           <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                           <input type="button" id="addposts_career" value="Save" class="btn btn-success">
                       </div><!-- THiS IS A MODAL FOOTER -->
                       </form>  
                  </div><!-- THiS IS A MODAL CONTENT -->
                </div><!-- THiS IS A MODAL DIALOG -->
            </div><!-- THiS IS A MODAL FADE -->


<?php include "header_navbar_footer/footer.php"?>
