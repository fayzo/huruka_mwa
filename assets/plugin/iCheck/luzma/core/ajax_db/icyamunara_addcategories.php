<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['icyamunara_view']) && !empty($_POST['icyamunara_view'])) {
    $user_id= $_SESSION['key'];
    $get_province = mysqli_query($db,"SELECT * FROM provinces"); ?>

<div class="icyamunara-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
           <div class="img-popup-wrap"  id="popupEnd">
        	<div class="img-popup-body">

            <div class="card">
                <span id="responseSubmithouse"></span>
                <div class="card-header">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                    <h5 class="card-text">Rwanda icyamunara</h5>
                    <p class="card-text">Do you want to add icyamunara ? Please fill details below.</p>
                </div>
                <form method="post" id="form-icyamunara"  enctype="multipart/form-data" >
                <div class="card-body">
                    <div>Choose your location and categories </div>
                      <input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
                       <div class="form-row mt-2">
                        <!-- <div class="col">
                          <label for="" class="text-dark">Country</label>
                            <div id="myCountry"></div>
                            <div id="myDiv"></div>
                        </div> -->
                          <div class="col-md-4 col-sm-12">
                                <label for="" class="text-dark">Province</label>
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
                            <div class="col-md-4 col-sm-12">
                                <label for="" class="text-dark"> District</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                    <select class="form-control districtcode" name="districtcode" id="districtcode" onchange="showResult2();" >
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="Sector" class="text-dark">Sector</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                    <select class="form-control sectorcode" name="sectorcode" id="sectorcode"  onchange="showResult3();">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="form-row mt-2">
                            <div class="col-md-6 col-sm-12">
                                <label for="Cell" class="text-dark">Cell</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                    </div>
                                    <select name="codecell" id="codecell" class="form-control codecell" onchange="showResult4();">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                             <div class="col-md-6 col-sm-12">
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

                      </div>

                      <div class="form-group mt-2">
                        <textarea class="form-control" name="additioninformation" id="addition-information" placeholder="Tell us more details and Try to summarize People can understand what products you try to sale" rows="3"></textarea>
                      </div>

                      <div class="form-row mt-2">
                       
                        <div class="col-md-4 col-sm-12 mb-2">
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">Seller</span>
                            </div>
                            <input type="text" class="form-control" name="author" id="author" placeholder="name">
                          </div>
                        </div>

                        <div class="col-md-4 col-sm-12 mb-2">
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">Frw</span>
                            </div>
                            <input type="text" class="form-control" name="price" id="price" placeholder="Price ">
                          </div>
                        </div>
                      
                        <div class="col-md-4 col-sm-12">
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">phone</span>
                            </div>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="phone number">
                          </div>
                        </div>
                      
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
                      <span onclick="fundAddmoreVideo()" id="add-more" class="btn btn-primary btn-md d-none">+ add more</span>

                    <div id="add-videohelp">
                    </div>
                    <!-- collapse addmore-->
                    
                     <div id="add-photo0" class="row">
                    </div>

                 </div><!-- card-body end-->
                <div class="card-footer text-center">
                    <button type="button" id="submit-form-icyamunara" class="btn btn-primary btn-lg btn-block text-center">Submit</button>
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
      $video_ = $home->uploadRwandahotelFile($video);
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

  
    $authors = $users->test_input($_POST['author']);
    $price_ = $users->test_input($_POST['price']);
    $additioninformation = $users->test_input($_POST['additioninformation']);
    $phone = $users->test_input($_POST['phone']);
    $province =  $users->test_input($_POST['provincecode']);
    $districts =  $users->test_input($_POST['districtcode']);
    $cell=  $users->test_input($_POST['codecell']);
    $sector =  $users->test_input($_POST['sectorcode']);
    $village =  $users->test_input($_POST['CodeVillage']);


	if (!empty($phone) || !empty(array_filter($photo['name'])) || !empty(array_filter($other_photo['name'])) ) {
		if (!empty($photo['name'][0])) {
			# code...
			$photo_ = $home->uploadRwandaicymunaraFile($photo);
            $other_photo_ = $home->uploadRwandaicymunaraFile($other_photo);
		}

		if (strlen($additioninformation ) > 400) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

	$users->Postsjobscreates('icyamunara',array( 
	'authors'=> $authors,
	'price'=> $price_, 
	'photo'=> $photo_, 
	'other_photo'=> $other_photo_, 
	'video'=> $video_, 
    'youtube'=> $youtube, 
	'phone'=> $phone,
    'photo_Title_main'=> $photo_Titleo,
    'photo_Title'=> $photo_Title0.'='.$photo_Title1.'='.$photo_Title2.'='.$photo_Title3.'='.$photo_Title4.'='.$photo_Title5,
	'province'=> $province,
	'districts'=> $districts,
	'sector'=> $sector,
	'cell'=> $cell,
	'village'=> $village,
  'text'=> $additioninformation,
  'buy'=> 'available',
  'user_id3'=> $user_id,
  'created_on3'=> $datetime ));

    }
} ?> 