<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['crowfund_view']) && !empty($_POST['crowfund_view'])) {
    $user_id= $_SESSION['key'];
    $get_province = mysqli_query($db,"SELECT * FROM provinces");   
     ?>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/country_login_ajax-db.js"></script>

<div class="crowfund-popup">
      <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
           <div class="img-popup-wrap"  id="popupEnd">
        	<div class="img-popup-body">

            <div class="card">
                <span id="responseSubmithelp"></span>
                <div class="card-header">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                    <h5 class="card-text">crowfundraiser</h5>
                    <p class="card-text">Do you want helps Or to helps someone ? Please fill details below.</p>
                </div>
                <form method="post" id="form-crowfund"  enctype="multipart/form-data" >
                <div class="card-body">
                      <input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
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
                      <div class="form-row mt-2">
                        <!-- <div class="col">
                          <input type="text" class="form-control" name="country" id="country" placeholder="Country">
                        </div> -->
                         <div class="col">
                            <!-- <div id="myCountry"></div> -->
                            <div id="myDiv"></div>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="city" id="city" placeholder="City">
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <!-- <div class="col">
                          <input type="text" class="form-control" name="province" id="province" placeholder="Province">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="districts" id="districts" placeholder="districts">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="sector" id="sector" placeholder="sector">
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <input type="text" class="form-control" name="cell" id="cell" placeholder="cell">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="village" id="village" placeholder="village">
                        </div> -->

                          <div class="col">
                                <label for="">Province</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                    <select name="provincecode"  id="provincecode" onchange="showResult();" class="form-control provincecode">
                                        <option value="">----Select province----</option>
                                        <?php while($show_province = mysqli_fetch_array($get_province)) { ?>
                                        <option value="<?php echo $show_province['provincecode'] ?>"><?php echo $show_province['provincename'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for=""> District</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                    <select class="form-control districtcode" name="districtcode" id="districtcode" onchange="showResult2();" >
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="Sector">Sector</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                    <select class="form-control sectorcode" name="sectorcode" id="sectorcode"  onchange="showResult3();">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="Cell">Cell</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                    <select name="codecell" id="codecell" class="form-control codecell" onchange="showResult4();">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="form-row mt-2">
                             <div class="col">
                                <label for="Village">Village</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                      <select name="CodeVillage" id="CodeVillage" class="form-control CodeVillage">
                                          <option> </option>
                                      </select>
                                </div>
                            </div>

                        <div class="col">
                            <div class="form-group">
                            <label for="">Categories of fund</label>
                              <select class="form-control" name="categories_crowfundraising" id="categories_crowfundraising">
                                <option value="">Select what types of categories of fund</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="ubworonzi">ubworonzi</option>
                                <option value="electronics">electronics</option>
                                <option value="web_apps">web_apps</option>
                                <option value="phone_app">phone_app</option>
                                <option value="Arts">Arts</option>
                                <option value="Film">Film</option>
                                <option value="Music">Music</option>
                                <option value="Fashion">Fashion</option>
                              </select>
                            </div>
                        </div>

                        <div class="col">
                          <label for="">Goal to raised money</label>
                            <input type="text" class="form-control" name="money_raising" id="money_raising" placeholder="money raising">
                        </div>
                      </div>

                      <div class="form-group mt-2">
                        <textarea class="form-control" name="additioninformation" id="addition-information" placeholder="tell us who are you and what help you need and Try to summarize People can understand what helps you need" rows="3"></textarea>
                      </div>

                      <div class="form-row mt-2">
                        <div class="col">
                          <div class="form-group">
                               <div class="btn btn-defaults btn-file" >
                                   <i class="fa fa-paperclip"></i> Attachment
                                   <input type="file" onChange="displayImage0(this)" name="photo[]" id="photo" multiple>
                                </div>
                                <span>Upload one photo of proof</span><br>
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
                               <div class="btn btn-defaults btn-file" >
                                   <i class="fa fa-paperclip"></i> Attachment
                                   <input type="file" onChange="displayImage(this)" name="otherphoto[]" id="other-photo"  multiple>
                               </div>
                               <span>Other photo</span>
                               <small class="help-block">(e.g show us many photo.) </small><br>
                                <span class="progress progress-hidec mt-1">
                                        <span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                                            style="width:0%;" id="proc" aria-valuenow="" aria-valuemin="0"
                                            aria-valuemax="100"></span>
                                </span>
                               <small class="help-block">Max. 10MB</small>
                           </div> 
                        </div>
                      </div>
                      <span onclick="crowfundAddmoreVideo()" id="add-more" class="btn btn-primary btn-md d-none ">+ add more</span>

                    <div id="add-videohelp">
                    </div>
                     <div id="add-photo0" class="row">
                    </div>
                    <!-- collapse addmore-->

                 </div><!-- card-body end-->
                <div class="card-footer text-center">
                    <button type="button" id="submit-help-crowfund" class="btn btn-primary btn-lg btn-block text-center">Submit</button>
                </div><!-- card-footer -->
               </form>
            </div><!-- card end-->

          </div><!-- img-popup-body -->
        </div><!-- tweet-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
<!-- <script src="< ?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script> -->
<script type="text/javascript">
    $('.progress-hidex').hide();
    $('.progress-hidec').hide();
    $('.progress-hidez').hide();
    $('#add-videohelp').hide();
</script>
<?php } 

if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id= $_POST['user_id'];
    $datetime= date('Y-m-d H-i-s');

    $photo= $_FILES['photo'];
    $other_photo= $_FILES['otherphoto'];

    if (!empty($_FILES['video']['name'][0])) {
      $video= $_FILES['video'];
      $video_ = $home->uploadcrowfundraisingFile($video);
      $youtube=  $users->test_input($_POST['youtube']);
    }else{
      $video_= "";
      $youtube=  "";
    }
 if (!empty($_POST['photo-Titleo0'])) {
          $photo_Titleo=  $users->test_input($_POST['photo-Titleo0']);
  }else {
           $photo_Titleo='';
  }
  if (!empty($_POST['photo-Title0'])) {
          $photo_Title0=  $users->test_input($_POST['photo-Title0']);
  }else {
           $photo_Title0='';
  }
  if (!empty($_POST['photo-Title1'])) {
          $photo_Title1=  $users->test_input($_POST['photo-Title1']);
  }else {
           $photo_Title1='';
  }
  if (!empty($_POST['photo-Title2'])) {
          $photo_Title2=  $users->test_input($_POST['photo-Title2']);
  }else {
           $photo_Title2='';
  }
  if (!empty($_POST['photo-Title3'])) {
          $photo_Title3=  $users->test_input($_POST['photo-Title3']);
  }else {
           $photo_Title3='';
  }
  if (!empty($_POST['photo-Title4'])) {
         $photo_Title4=  $users->test_input($_POST['photo-Title4']);
  }else {
           $photo_Title4='';
  }
  if (!empty($_POST['photo-Title5'])) {
         $photo_Title5=  $users->test_input($_POST['photo-Title5']);
  }else {
           $photo_Title5='';
  }

    $firstname = $users->test_input($_POST['firstname']);
    $middlename = $users->test_input($_POST['middlename']);
    $lastname = $users->test_input($_POST['lastname']);
    $email = $users->test_input($_POST['email']);
    $address = $users->test_input($_POST['address']);
    $telephone = $users->test_input($_POST['telephone']);
    $country = $users->test_input($_POST['country']);
    $city = $users->test_input($_POST['city']);
    // $province = $users->test_input($_POST['province']);
    // $districts = $users->test_input($_POST['districts']);
    // $cell = $users->test_input($_POST['cell']);
    // $sector = $users->test_input($_POST['sector']);
    // $village = $users->test_input($_POST['village']);
        $province=  $users->test_input($_POST['provincecode']);
        $districts=  $users->test_input($_POST['districtcode']);
        $cell=  $users->test_input($_POST['sectorcode']);
        $sector=  $users->test_input($_POST['codecell']);
        $village=  $users->test_input($_POST['CodeVillage']);

    $additioninformation = $users->test_input($_POST['additioninformation']);
    $categories_crowfundraising=  $users->test_input($_POST['categories_crowfundraising']);
    $money_raising=  $users->test_input($_POST['money_raising']);
    // $deadline = $users->test_input($_POST['deadline']);


	if (!empty($telephone) || !empty(array_filter($photo['name'])) || !empty(array_filter($other_photo['name'])) ) {
		if (!empty($photo['name'][0])) {
			# code...
			$photo_ = $home->uploadcrowfundraisingFile($photo);
      $other_photo_ = $home->uploadcrowfundraisingFile($other_photo);
		}

		if (strlen($additioninformation ) > 400) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

	$users->Postsjobscreates('crowfundraising',array( 
	'firstname1'=> $firstname, 
	'middlename1'=> $middlename, 
	'money_to_target'=> $money_raising, 
	'lastname1'=> $lastname,
	'email1'=> $email, 
	'address1'=> $address,
	'country1'=> $country,
	'city'=> $city,
	'province'=> $province,
	'districts'=> $districts,
	'sector'=> $sector,
	'cell'=> $cell,
	'village'=> $village,
  'telephone1'=> $telephone, 
	'photo'=> $photo_, 
	'other_photo'=> $other_photo_, 
	'video'=> $video_, 
	'youtube'=> $youtube, 
  'text'=> $additioninformation,
  'categories_crowfundraising'=> $categories_crowfundraising,
  'photo_Title_main'=> $photo_Titleo,
  'photo_Title'=> $photo_Title0.'='.$photo_Title1.'='.$photo_Title2.'='.$photo_Title3.'='.$photo_Title4.'='.$photo_Title5,
  'user_id2'=> $user_id,
  'created_on2'=> $datetime ));

    // 'deadline'=> $deadline,
    }
} ?> 