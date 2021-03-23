<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['cv_id']) ) {
    $user_id= $_SESSION['key'];
    $cv_id= $_POST['cv_id'];
    $mysqli = $db;
    // $query= $mysqli->query("SELECT * FROM users U Left JOIN trash T ON T. business_id0= U. user_id LEFT JOIN jobs J ON J. job_id = T. job_id0  WHERE T. cv_id = $cv_id ");
    $query= $mysqli->query("SELECT * FROM email_trash T LEFT JOIN jobs J ON J. job_id = T. job_id0  WHERE T. cv_id = $cv_id ");
    $row = $query->fetch_array();
    ?>
<div class="trash-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap" id="popupEnd">
        	<div class="img-popup-body">

                <div class="card">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

                    <span id="responseSubmitdelete"></span>
                     <div class="card-body p-0">
                         <div class="mailbox-read-info">
                             <h5>Message Subject Is Placed Here</h5>
                             <h6>From: <?php echo $row['email_sent_from'] ;?></h6>
                             <h6>To: <?php echo $row['email_sent_to'] ;?>
                                <span class="mailbox-read-time float-right"><?php echo $home->timeAgo($row['created_on0']) ;?></span>
                            </h6>
                             <div>Subject: <?php echo $row['subject_composer'] ;?></div>
                         </div>
                         <!-- /.mailbox-read-info -->
                         <div class="mailbox-controls with-border text-center">
                             <div class="btn-group">
                                 <button type="button" class="btn btn-default btn-sm deleteTrashinbox" data-delete="delete" data-trashid="<?php echo $row['cv_id']; ?>" data-id_radom="<?php echo $row['cv_id_radom']; ?>" data-toggle="tooltip"
                                     data-container="body" title="Delete">
                                     <i class="fa fa-trash-o"></i></button>
                                 <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                     data-container="body" title="Reply">
                                     <i class="fa fa-reply"></i></button>
                                 <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                     data-container="body" title="Forward">
                                     <i class="fa fa-share"></i></button>
                             </div>
                             <!-- /.btn-group -->
                             <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                                 <i class="fa fa-print"></i></button>
                         </div>
                         <!-- /.mailbox-controls -->
                         <div class="mailbox-read-message">
                            <!-- MAIL BOX HERE GOES -->
                             <!-- MAIL BOX HERE GOES -->

                             <?php echo htmlspecialchars_decode($row['addition_information']); ?>

                             <!-- MAIL BOX HERE GOES -->
                             <!-- MAIL BOX HERE GOES -->
                         </div>
                         <!-- /.mailbox-read-message -->
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                         <ul class="mailbox-attachments clearfix list-inline">
                         <?php 
                                if (!empty($row['uploadfilecertificates'])) {
                                    # code...
                                    $file = $row['uploadfilecv']."=".$row['uploadfilecertificates'];
                                    $file_size = $row['cv_file_size']."=".$row['certificates_file_size'];
                                }else{
                                    $file = $row['uploadfilecv'];
                                    $file_size = $row['cv_file_size'];
                                }

                                 $expode = explode("=",$file);
                                 $file_sizes = explode("=",$file_size);

                                 $fileActualExt= array();
                                 for ($i=0; $i < count($expode); ++$i) { 
                                    $fileActualExt[]= strtolower(substr($expode[$i],strrpos($expode[$i],'.')+1));
                                }

                                 $image= array('jpg','jpeg','png','gif');
                                 $pdf= array('pdf');
                                 $coins= array('coins');
                                 $docx= array('doc','docx','lsx');
                                 $mp3= array('mp3','ogg');
                                 $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');
                                 $allower_ext= array_merge($image,$pdf,$coins,$docx,$mp3,$mp4);
          
                                
                 if (array_diff($fileActualExt,$allower_ext) == false) {

                     for ($i=0; $i < count($expode); ++$i) {  ?>
                     
                     <li  class="list-inline-item">

                     <?php if(in_array(pathinfo($expode[$i])['extension'],$docx)) { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                  <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                        <!-- ||Sep2014-report.pdf -->
                                    </a>
                                     <span class="mailbox-attachment-size">
                                         <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                         <!-- 1,245 KB -->
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>

                    <?php }else if(in_array(pathinfo($expode[$i])['extension'],$pdf)) { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                 <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                         <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                          <!-- || Sep2014-report.pdf -->
                                        </a>
                                     <span class="mailbox-attachment-size">
                                     <?php echo $home->formatSizeUnits($file_sizes[$i]) ;?>
                                         <!-- 1,245 KB -->
                                         <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>

                    <?php }else if(in_array(pathinfo($expode[$i])['extension'],$image)) { ?>
                    
                                  <span class="mailbox-attachment-icon has-img"><img 
                                    src="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                
                                 <div class="mailbox-attachment-info main-active">
                                     <a href="<?php echo BASE_URL_PUBLIC."uploads/jobs/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>|| Sep2014-report.pdf</a>
                                     <span class="mailbox-attachment-size">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>
                     <?php } ?>
                          </li>

                    <?php } } ?>
                         
                         </ul>
                     </div>
                 </div>
              </form>
            </div><!-- img-popup-body -->
        </div><!-- tweet-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- inbox-popup" -->

<?php } 

if (isset($_POST['delete'])) {

    if ($_POST['delete'] == 'delete') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id = $_POST[ $id];
        $id = $_POST['trashid'];
        $id_radom = $_POST['id_radom'];
        // var_dump($_POST);
        // var_dump($id);
        // var_dump(array_keys($_POST)[1]);

        $job->TrashDelete('email_trash',$id,$id_radom,$datetime);
  }
}


if (isset($_POST['deleteCheck'])) {

    if ($_POST['deleteCheck'] == 'deleteCheck') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id= array();
        foreach ($_POST as $key => $value) {
            $id[]= $_POST[$key];
        }
        $deleteCheck = array('deleteCheck');
        $id= array_diff($id,$deleteCheck);
        $id= array_values(array_filter($id)); // start to 0 index
        // var_dump($_POST);
        // var_dump($id);
        for ($i=0; $i < count($id) ; $i++) { 
            $query= $job->InboxDelete('email_trash',$id[$i],$datetime);
        }

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
}

if (isset($_POST['deleteChecksent'])) {

    if ($_POST['deleteChecksent'] == 'deleteChecksent') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id= array();
        foreach ($_POST as $key => $value) {
            $id[]= $_POST[$key];
        }
        
        $deleteCheck = array('deleteChecksent');
        $id= array_diff($id,$deleteCheck);
        $id= array_values(array_filter($id)); // start to 0 index

        for ($i=0; $i < count($id) ; $i++) { 
            # code...
            $query= $job->SentDelete('email_apply_job',$id[$i],$datetime);
        }

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
}

if (isset($_POST['deleteCheck_Trash'])) {

    if ($_POST['deleteCheck_Trash'] == 'deleteCheck_Trash') {

        $datetime= date('Y-m-d H-i-s');
        // $id = array_keys($_POST)[1];
        // $id= array();
        foreach ($_POST as $key => $value) {
            $id[]= $_POST[$key];
        }

        $deleteCheck = array('deleteCheck_Trash');
        $id= array_diff($id,$deleteCheck);
        $id= array_values(array_filter($id)); // start to 0 index
        
        for ($i=0; $i < count($id) ; $i++) { 
            # code...
            $query=$job->TrashAllDelete('email_trash',$id[$i],$datetime);
        }
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
}

?>