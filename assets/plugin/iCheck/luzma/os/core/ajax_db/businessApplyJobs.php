<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['apply_id']) && !empty($_POST['business_id'])) {
  if (isset($_SESSION['key'])) {
    # code...
    $user_id= $_SESSION['key'];
  }else {
    # code...
    $user_id= $_SESSION['irangiro_key'];
  }
    $job_id= $_POST['apply_id'];
    $business_id= $_POST['business_id'];
    $user = $job->jobsviewData($business_id,$job_id);
     ?>

<div class="apply-popup">
<div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap" id="popupEnd">
        	<div class="img-popup-body">

            
            <div class="card">
              <div class="card-header">
                <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                  <div class="user-block">
                       <div class="user-blockImgBorder">
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
                              <a style="padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $home->htmlspecialcharss($user['companyname']).' || '.$user['country'];?> <i class="flag-icon flag-icon-<?php echo strtolower($user['country']) ;?> h4 mb-0"
                          id="<?php echo strtolower( $jobs['location']) ;?>" title="us"></i></a>
                            <span class="description">Shared public - <?php echo $home->timeAgo($user['created_on']); ?> </span>
                    </div>
                    <h4 class="card-title text-center">CV Submission</h4>
                    <p class="card-text text-center">Do you want to work with us ? Please fill in your details below.</p>
                </div>
                <form method="post" id="form-cv"  enctype="multipart/form-data" >
                <div class="card-body">
                       <input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
                       <input type="hidden" name="job_id" value="<?php echo $job_id ;?>">
                       <input type="hidden" name="business_id" value="<?php echo $business_id ;?>">
                       <input type="hidden" name="email_to" value="<?php echo $user['email'] ;?>">
                       <!-- <input type="text" class="form-control" name="deadline" value="< ?php echo $deadline ;?>"> -->
                      <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control" name="firstname" id="first-name" placeholder="First name">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="middlename"  id="middle-name" placeholder="Middle name if any ">
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <input type="text" class="form-control" name="lastname" id="last-name" placeholder="Lastname">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Contact Number">
                        </div>
                      </div>

                      <div class="form-group mt-2">
                          <label class="text-muted">Subject <span style="color:red">*</span></label>
                          <input class="form-control subjectcomposer" name="subjectcomposer" placeholder="Subject:">
                      </div>

                      <div class="form-group mt-2">
                        <label class="text-muted">Message <span style="color:red">*</span></label>
                        <textarea class="form-control additioninformation" id="editor1" name="additioninformation" placeholder="Addition informaton" rows="3"></textarea>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <div class="form-group">
                               <div class="btn btn-defaults btn-file">
                                   <i class="fa fa-paperclip"></i> Attachment
                                   <input type="file" name="uploadcv[]" id="upload-cv" onChange="displayImageNameSizecv(this)" multiple>
                                </div>
                                <span>Upload your CV Here</span><br>
                                <span class="progress progress-hidex mt-1">
                                        <span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                                            style="width:0%;" id="prox" aria-valuenow="" aria-valuemin="0"
                                            aria-valuemax="100"></span>
                                </span>
                               <small class="help-block">Max. 10MB</small>
                           </div> 
                        </div>

                        <div class="col">
                             <div class="form-group">
                               <div class="btn btn-defaults btn-file">
                                   <i class="fa fa-paperclip"></i> Attachment
                                   <input type="file" name="uploadcertificates[]" onChange="displayImageNameSize0(this)" id="upload-certificates"multiple>
                               </div>
                               <span>Other Testmonials</span>
                               <small class="help-block">(e.g Certificates, etc...) </small><br>
                                <span class="progress progress-hidec mt-1">
                                        <span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                                            style="width:0%;" id="proc" aria-valuenow="" aria-valuemin="0"
                                            aria-valuemax="100"></span>
                                </span>
                               <small class="help-block">Max. 10MB</small>
                           </div> 
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6" id="add-photo00">
                        </div>
                        <div class="col-6" id="add-photo1">
                        </div>
                      </div>
                 </div><!-- card-body end-->
                <div class="card-footer text-center">
                    <span id="responseSubmit"></span> <br>
                    <button type="button" id="submit-form-cv" class="btn btn-primary text-center">Submit CV</button>
                </div><!-- card-footer -->
               </form>
            </div><!-- card end-->

          </div><!-- img-popup-body -->
        </div><!-- tweet-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
<script type="text/javascript">
    $('.progress-hidex').hide();
    $('.progress-hidec').hide();
</script>
<script>
    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
   
  });

</script>
<?php } 

if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id= $_POST['user_id'];
    $job_id= $_POST['job_id'];
    $business_id= $_POST['business_id'];
    $datetime= date('Y-m-d H-i-s');
    $email_to_business = $users->test_input($_POST['email_to']);

    $uploadcv= $_FILES['uploadcv'];
    $uploadcertificates= $_FILES['uploadcertificates'];

    $subject_composer = $users->test_input($_POST['subjectcomposer']);
    $firstname = $users->test_input($_POST['firstname']);
    $middlename = $users->test_input($_POST['middlename']);
    $lastname = $users->test_input($_POST['lastname']);
    $email = $users->test_input($_POST['email']);
    $address = $users->test_input($_POST['address']);
    $telephone = $users->test_input($_POST['telephone']);
    // $degree = $users->test_input($_POST['degree']);
    // $field = $users->test_input($_POST['field']);
    $additioninformation = $users->test_input($_POST['additioninformation']);
    // $deadline = $users->test_input($_POST['deadline']);


	if (!empty($telephone) || !empty(array_filter($uploadcv['name'])) || !empty(array_filter($uploadcertificates['name'])) ) {
		if (!empty($uploadcv['name'][0])) {
			# code...
			$uploadcv_ = $home->uploadJobsFile($uploadcv);
			$fileSize_uploadcv = $home->uploadSize($uploadcv);

			$uploadcertificates_ = $home->uploadJobsFile($uploadcertificates);
			$fileSize_certificates = $home->uploadSize($uploadcertificates);

		}

		if (strlen($additioninformation ) > 100000) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

	$users->Postsjobscreates('email_apply_job',array( 
	'cv_id_radom'=> rand(10,1000), 
	'firstname0'=> $firstname, 
	'middlename0'=> $middlename, 
	'lastname0'=> $lastname,
	'email0'=> $email, 
	'address0'=> $address,
  'telephone'=> $telephone, 
	'uploadfilecv'=> $uploadcv_, 
	'uploadfilecertificates'=> $uploadcertificates_, 
  'addition_information'=> $additioninformation,
  'cv_file_size'=> $fileSize_uploadcv,
  'certificates_file_size'=> $fileSize_certificates,
  'user_id0'=> $user_id,
  'job_id0'=> $job_id,
  'business_id0'=> $business_id,
  'subject_composer' => $subject_composer,
	'email_sent_from'=> $email, 
  'email_sent_to'=>  $email_to_business,
  'email_sent_from_id'=> $user_id,
  'email_sent_to_id'=> $business_id,
  'type_of_email' => 'inbox',
  'created_on0'=> $datetime ));

    // 'deadline'=> $deadline,
    }
} ?> 
 