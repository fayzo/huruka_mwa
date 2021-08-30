<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['events_view']) && !empty($_POST['events_view'])) {
    $user_id= $_SESSION['key'];
    $get_province = mysqli_query($db,"SELECT * FROM provinces");   
     ?>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/country_login_ajax-db.js"></script>

<div class="events-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap"  id="popupEnd">
        	<div class="img-popup-bodys">

            <div class="card">
                <span id="responseSubmitevents"></span>
                <div class="card-header">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

                    <h5 class="card-text">Create New Events</h5>
                    <p class="card-text">Please Fill Details Below.</p>
                </div>
                <form method="post" id="form-events"  enctype="multipart/form-data" >
                <div class="card-body">
                      <input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
                     
                      <div class="form-row">

                          <div class="col-sm-12 col-md-4">
                              <label for="Name">Name Of Events</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar mr-1" aria-hidden="true"></i></span>
                                  </div>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Name Of Events">
                              </div>
                          </div>

                          <div class="col-sm-6 col-md-4">
                            <label for="Country">Country</label>
                            <!-- <div id="myCountry"></div> -->
                            <div id="myDiv"></div>
                          </div>

                            <div class="col-sm-6 col-md-4">
                              <label for="Location">Location</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                                  </div>
                                    <input type="text" class="form-control" name="Location" id="Location" placeholder="Location">
                              </div>
                          </div>

                      </div>

                      <div class="form-row  mt-2">
                          <div class="col-6">
                             <label for="event-start">When this event will start?</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar mr-1" aria-hidden="true"></i></span>
                                  </div>
                                  <input type="date" class="date hasDatepicker form-control" id="event-start" name="event-start-date">
                              </div>
                          </div>
                          
                          <div class="col-6">
                             <label for="event-start">start time?</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-clock-o mr-1" aria-hidden="true"></i></span>
                                  </div>
                                  <input type="time" id="event-start-time" class="time1 hasDatepicker form-control" name="event-start-time">
                              </div>
                          </div>
                      </div>

                        <div class="form-row mt-2">
                          <div class="col-6">
                              <label for="event-end-date">When this event will end?</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar mr-1" aria-hidden="true"></i></span>
                                  </div>
                                  <input type="date" class="date1 hasDatepicker form-control" name="event-end-date" id="event-end-date">
                              </div>
                          </div>

                          <div class="col-6">
                              <label for="event-start">End time?</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-clock-o mr-1" aria-hidden="true"></i></span>
                                  </div>
                                  <input type="time" id="event-end-time" class="time2 hasDatepicker form-control" name="event-end-time">
                              </div>
                          </div>
                        </div>

                        <div class="form-row mt-2">
                          <div class="col-12">
                            <div class="form-group">
                            <label for="types of Events">Types of Events</label>
                            <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar mr-1" aria-hidden="true"></i></span>
                                  </div>
                                  <select class="form-control" name="categories_events" id="categories_events">
                                    <option value="">Select what types of Events</option>
                                    <option value="Workshops">Workshops</option>
                                    <option value="Networking">Networking </option>
                                    <option value="Trade_Shows">Trade Shows</option>
                                    <option value="Conferences">Conferences</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Party">Party</option>
                                    <option value="Training">Training</option>
                                    <option value="Anime-Series">Education</option>
                                    <option value="Government">Government</option>
                                    <option value="Memorial">Memorial</option>
                                    <option value="Religion">Muslim</option>
                                    <option value="Religion">christian</option>
                                  </select>
                            </div>
                            </div>
                          </div>
                        </div>

                      <div class="form-group mt-2">
                        <label for="Description">Description</label>
                        <textarea class="form-control" name="additioninformation" id="addition-information" placeholder="tell us a liltte bit events is all about and Try to summarize People can understand" rows="3"></textarea>
                      </div>

                      <div class="form-row mt-2">
                        <div class="col">
                          <div class="form-group">
                               <div class="btn btn-defaults btn-file" >
                                   <i class="fa fa-paperclip"></i> Attachment
                                   <input type="file" accept="image/*"  onChange="displayImage(this)" name="photo[]" id="photo" >
                                </div>
                                <span>Upload Photo</span><br>
                                <span class="progress progress-hidex mt-1">
                                        <span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                                            style="width:0%;" id="prox" aria-valuenow="" aria-valuemin="0"
                                            aria-valuemax="100"></span>
                                </span>
                               <small class="help-block">Max. 10MB</small>
                           </div> 
                        </div>

                      <!--    <div class="col">
                            <span onclick="AddVideo()" id="add-more" class="btn btn-primary btn-md ">+ add video</span>
                             <div id="add-video">
                             </div>
                         </div>

                          <div class="col">
                            <span onclick="Addyoutube()" id="add-more1" class="btn btn-primary btn-md ">+ add youtube Link</span>
                             <div id="add-youtube">
                             </div>
                         </div> -->

                      </div>
                    <div id="add-photo0" class="row">
                    </div>
                    <!-- collapse addmore-->

                 </div><!-- card-body end-->
                <div class="card-footer text-center">
                    <button type="button" id="submit-form-events" class="btn btn-primary btn-lg btn-block text-center">Publish</button>
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

    if (!empty($_FILES['video']['name'][0])) {
      $video= $_FILES['video'];
      $video_ = $home->uploadEventsFile($video);
    }else{
      $video_= "";
    }

    if (!empty($_POST['youtube'])) {
      $youtube=  $users->test_input($_POST['youtube']);
    }else{
      $youtube=  "";
    }

    if (!empty($_POST['photo-Title0'])) {
            $photo_Title0=  $users->test_input($_POST['photo-Title0']);
    }else {
            $photo_Title0='';
    }
  
    $title =  $users->test_input($_POST['title']); 
    $authors =  $users->test_input($_SESSION['username']); 
    $country = $users->test_input($_POST['country']);
    $location = $users->test_input($_POST['Location']);
    
    $additioninformation = $users->test_input($_POST['additioninformation']);
    $categories_events =  $users->test_input($_POST['categories_events']);

    $date =   $users->test_input($_POST['event-start-date']);
    $time1 =  $users->test_input($_POST['event-start-time']);
    $date1 =  $users->test_input($_POST['event-end-date']);
    $time2 =  $users->test_input($_POST['event-end-time']);

	if (!empty(array_filter($photo['name'])) ) {
		if (!empty($photo['name'][0])) {
			# code...
			$photo_ = $home->uploadEventsFile($photo);
		}

		if (strlen($additioninformation ) > 10000) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

    $users->Postsjobscreates('events',array( 

        'name_place'=> $title,
        'authors' => $authors,
        'country'=> $country,
        'location_events'=> $location,
        'start_events'=> $date,
        'start_time'=> $time1,
        'end_events'=> $date1,
        'end_time'=> $time2,

        'photo_Title'=> $photo_Title0,
        'additioninformation'=> $additioninformation, 
        'categories_events'=> $categories_events, 
        'photo'=> $photo_, 
        'video'=> $video_, 
        'youtube'=> $youtube, 
        'user_id3'=> $user_id,
        'tweet_events_by'=> $user_id,
        'created_on3'=> $datetime 
        
      ));

    }
} 

?> 