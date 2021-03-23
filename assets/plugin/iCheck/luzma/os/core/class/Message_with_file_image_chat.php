<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Message extends Home 
{
    public function recentMessage($user_id)
    {
       $mysqli= $this->database;
    //    $query="SELECT * FROM message M LEFT JOIN users U ON M. message_from= U. user_id WHERE M. message_to= $user_id AND M. status= 1 GROUP BY M. message_from, M. message_to HAVING  COUNT(DISTINCT M. message_to)=1 AND COUNT(DISTINCT M. message_from)=1 ORDER BY M. message_on Desc";

    // THIS ONE MAKE MODAL TO WORK BAD
    //    $query="SELECT * FROM message M 
    //    LEFT JOIN users U ON M. message_from= U. user_id 
    //    JOIN (
    //         SELECT MAX(message_on) AS max_date
    //         FROM message WHERE message_to = $user_id  
    //         GROUP BY message_from, message_to
    //     ) AS lm ON m. message_on = lm .max_date
    //    WHERE M. message_to= $user_id AND M. status= 1 GROUP BY M. message_from, M. message_to ORDER BY M. message_on Desc";
    
       $query ="SELECT * FROM message m
                JOIN users U ON m. message_from = U. user_id 
                JOIN (
                    SELECT message_from, message_to, MAX(message_on) AS max_date
                    FROM message
                    WHERE message_to = $user_id  
                    GROUP BY message_from, message_to
                ) AS lm ON m. message_on = lm .max_date AND 
                m. message_from= lm. message_from AND
                m. message_to=lm. message_to 
                WHERE m. message_to= $user_id AND m. status= 1 ";

        $result=$mysqli->query($query);
        // var_dump('ERROR: Could not able to execute'. $result.mysqli_error($mysqli));
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }
       return $data;

    }

    public function recentMessageUnread($user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM message M LEFT JOIN users U ON M. message_from= U. user_id WHERE M. message_to= $user_id AND M. status= 0 GROUP BY M. message_from, M. message_to HAVING  COUNT(DISTINCT M. message_to)=1 AND COUNT(DISTINCT M. message_from)=1 ORDER BY M. message_on Desc";

       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }
       return $data;

    }

     public function getMessage($messagefrom,$user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM message LEFT JOIN users ON message_from= user_id WHERE message_from= $messagefrom AND message_to= $user_id OR message_to= $messagefrom AND message_from= $user_id";
       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }

       foreach ($data as $message) {
           # code...
            $expodefile = explode("=",$message['file_image']);
            $file_size = $message['file_size'];
            $file_sizes = explode("=",$file_size);

            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],strrpos($expodefile[$i],'.')+1));
            }

            $image= array('jpg','jpeg','png','gif');
            $pdf= array('pdf');
            $coins= array('coins');
            $docx= array('doc','docx','lsx');
            $mp3= array('mp3','ogg');
            $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');
            $allower_ext= array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip','coins','mp4'); // valid extensions
            // $allower_ext= $mp4;

            $expode = $expodefile;
            $count = count($expodefile);

            if ($count == 1 ) {
                $count_divide = "md-12 col-sm-12";
            }else if ($count == 2 ){
                $count_divide = "md-6 col-sm-12";
            }else if ($count > 2 ){
                $count_divide = "md-6 col-sm-12";
            }
            // var_dump($expode,$count);


           if ($message['message_from'] == $user_id) { ?>
                 <!-- Main message BODY RIGHT START -->
                 
                   <div class="main-msg-body-right">
                		<div class="main-msg">
                            <div class="msg-img">
                            <?php if (!empty($message['profile_img'])) { ?>
                                    <a href="#"><img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'] ;?>"/></a>
                            <?php }else{ ?>
                                    <a href="#"><img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"/></a>
                            <?php } ?>
                			</div>
                			<div class="msg"> 
                                <?php echo $message['message']; ?>
                				<div class="msg-time">
                                    <?php echo $this->timeAgo($message['message_on']); ?>
                				</div>

                                <!-- START FILE IMAGE -->
                                <!-- START FILE IMAGE -->
                             <?php   
                             
                             if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                                    <div class="row">
                                    <?php  

                                    for ($i=0; $i < count($expode); ++$i) { ?>

                                        <?php if(in_array(pathinfo($expode[$i])['extension'],$docx)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                        <!-- ||Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$pdf)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                            <!-- || Sep2014-report.pdf -->
                                                        </a>
                                                    <span class="mailbox-attachment-size">
                                                    <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$image)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                    <span class="mailbox-attachment-icon has-img"><img 
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                                
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp3)) { ?>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <audio controls>
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                        <!-- fallback content here -->
                                                </audio>
                                            </div>
                                        </div>
                                    <?php } 

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp4)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                        <div class="row">
                                        
                                        <div class="col-12">
                                                <video controls preload="auto" width="100px"  height="auto" >
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                </video>
                                                
                                        </div>
                                        <div class="col-12">

                                                <div class="mailbox-attachment-info main-active" style="width:100%">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                        </div>
                                        </div>
                                    <?php } 
                                
                                    } ?> 
                                    </div>
                                    <?php } ?>

                                <!-- END FILE IMAGE -->
                                <!-- END FILE IMAGE -->

                			</div>
                			<div class="msg-btn">
                				<a><i class="fa fa-ban" aria-hidden="true"></i></a>
                				<a class="deleteMsg more" data-message="<?php echo $message['message_id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                			</div>
                		</div>
                	</div>

                	<!--Main message BODY RIGHT END--> 

           <?php }else { ?>

               <!--Main message BODY LEFT START-->

                		<div class="main-msg-body-left">
                			<div class="main-msg-l">
                                <div class="msg-img-l">
                                <?php if (!empty($message['profile_img'])) { ?>
                                    <a href="#"><img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'] ;?>"/></a>
                                <?php }else{ ?>
                                        <a href="#"><img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"/></a>
                                <?php } ?>
                                </div>
                                <div class="msg-l"> <?php echo $message['message']; ?>
                                    <div class="msg-time-l">
                                    <?php echo $this->timeAgo($message['message_on']); ?>
                                    </div>
                                    
                                <!-- START FILE IMAGE -->
                                <!-- START FILE IMAGE -->
                             <?php   
                             
                             if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                                    <div class="row">
                                    <?php  

                                    for ($i=0; $i < count($expode); ++$i) { ?>

                                        <?php if(in_array(pathinfo($expode[$i])['extension'],$docx)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                        <!-- ||Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$pdf)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                            <!-- || Sep2014-report.pdf -->
                                                        </a>
                                                    <span class="mailbox-attachment-size">
                                                    <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$image)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                    <span class="mailbox-attachment-icon has-img"><img 
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                                
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp3)) { ?>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <audio controls>
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                        <!-- fallback content here -->
                                                </audio>
                                            </div>
                                        </div>
                                    <?php } 

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp4)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                        <div class="row">
                                        
                                        <div class="col-12">
                                                <video controls preload="auto" width="100px"  height="auto" >
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                </video>
                                                
                                        </div>
                                        <div class="col-12">

                                                <div class="mailbox-attachment-info main-active" style="width:100%">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                        </div>
                                        </div>
                                    <?php } 
                                
                                    } ?> 
                                    </div>
                                    <?php } ?>

                                <!-- END FILE IMAGE -->
                                <!-- END FILE IMAGE -->

                                </div>
                                <div class="msg-btn-l">
                                    <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                    <a class="deleteMsg more" data-message="<?php echo $message['message_id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                			</div>
                		</div> 


                	<!--Main message BODY LEFT END-->
                <!-- Chat  --> 
         <?php  } 
       }
    }
    
     public function getChatMessage($messagefrom,$user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM message LEFT JOIN users ON message_from= user_id WHERE message_from= $messagefrom AND message_to= $user_id OR message_to= $messagefrom AND message_from= $user_id";
       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }

        foreach ($data as $message) {
           # code...
         $expodefile = explode("=",$message['file_image']);
         $file_size = $message['file_size'];
         $file_sizes = explode("=",$file_size);

         $fileActualExt= array();
         for ($i=0; $i < count($expodefile); ++$i) { 
             $fileActualExt[]= strtolower(substr($expodefile[$i],strrpos($expodefile[$i],'.')+1));
         }

         $image= array('jpg','jpeg','png','gif');
         $pdf= array('pdf');
         $coins= array('coins');
         $docx= array('doc','docx','lsx');
         $mp3= array('mp3','ogg');
         $mp4= array('mp4','mov','vob','mpeg','3gp','avi','wmv','mov','amv','svi','flv','mkv','webm','asf');
         $allower_ext= array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip','coins','mp4'); // valid extensions
         // $allower_ext= $mp4;

         $expode = $expodefile;
         $count = count($expodefile);

         if ($count == 1 ) {
             $count_divide = "col-12";
         }else if ($count == 2 ){
             $count_divide = "col-12";
         }else if ($count > 2 ){
             $count_divide = "col-12";
         }
         // var_dump($expode,$count);

           if ($message['message_from'] == $user_id) { ?>
                <!-- Message to the right -->

                           <div class="direct-chat-msg right">
                               <div class="direct-chat-info clearfix">
                                   <span class="direct-chat-name float-right" style="color: #999;"><?php echo $message['username'] ;?> </span>
                                   <span class="direct-chat-timestamp float-left">
                                   <?php echo $this->timeAgo($message['message_on']); ?>
                                          <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                          <a class="deleteMsg more" data-message="<?php echo $message['message_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   </span>
                               </div>
                               <!-- /.direct-chat-info -->
                               <?php if(!empty($message['profile_img'])){ ?>
                                    <a href="#"><img class="direct-chat-img" src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'];?>"/></a>
                                <?php }else { ?>
                                    <a href="#"> <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL;?>"/></a>
                                <?php } ?>

                               <!-- /.direct-chat-img -->
                               <div class="direct-chat-text">
                               <?php echo $message['message']; ?>
                                    
                                <!-- START FILE IMAGE -->
                                <!-- START FILE IMAGE -->
                             <?php   
                             
                             if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                                    <div class="row">
                                    <?php  

                                    for ($i=0; $i < count($expode); ++$i) { ?>

                                        <?php if(in_array(pathinfo($expode[$i])['extension'],$docx)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                        <!-- ||Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$pdf)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                            <!-- || Sep2014-report.pdf -->
                                                        </a>
                                                    <span class="mailbox-attachment-size">
                                                    <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$image)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                    <span class="mailbox-attachment-icon has-img"><img 
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                                
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp3)) { ?>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <audio controls>
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                        <!-- fallback content here -->
                                                </audio>
                                            </div>
                                        </div>
                                    <?php } 

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp4)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                        <div class="row">
                                        
                                        <div class="col-12">
                                                <video controls preload="auto" width="100px"  height="auto" >
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                </video>
                                                
                                        </div>
                                        <div class="col-12">

                                                <div class="mailbox-attachment-info main-active" style="width:100%">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                        </div>
                                        </div>
                                    <?php } 
                                
                                    } ?> 
                                    </div>
                                    <?php } ?>

                                <!-- END FILE IMAGE -->
                                <!-- END FILE IMAGE -->

                               </div>
                               <!-- /.direct-chat-text -->
                           </div>
                           <!-- /.direct-chat-msg -->

          <?php  }else { ?>
            
                <!-- Message to the left -->

                           <div class="direct-chat-msg">
                               <div class="direct-chat-info clearfix">
                               <span class="direct-chat-name float-right" style="color: #999;"><?php echo $message['username'] ;?> </span>
                                   <span class="direct-chat-timestamp float-left">
                                   <?php echo $this->timeAgo($message['message_on']); ?>
                                          <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                          <a class="deleteMsg more" data-message="<?php echo $message['message_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   </span>
                               </div>
                               <!-- /.direct-chat-info -->
                               <?php if(!empty($message['profile_img'])){ ?>
                                    <a href="#"><img class="direct-chat-img" src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'];?>"/></a>
                                <?php }else { ?>
                                    <a href="#"> <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL;?>"/></a>
                                <?php } ?>

                               <!-- /.direct-chat-img -->
                               <div class="direct-chat-text">
                               <?php echo $message['message']; ?>
                                    
                                <!-- START FILE IMAGE -->
                                <!-- START FILE IMAGE -->
                             <?php   
                             
                             if (array_diff($fileActualExt,$allower_ext) == false) { ?>
                                    <div class="row">
                                    <?php  

                                    for ($i=0; $i < count($expode); ++$i) { ?>

                                        <?php if(in_array(pathinfo($expode[$i])['extension'],$docx)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                                    <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                        <!-- ||Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$pdf)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                        <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                            <!-- || Sep2014-report.pdf -->
                                                        </a>
                                                    <span class="mailbox-attachment-size">
                                                    <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$image)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">

                                                    <span class="mailbox-attachment-icon has-img"><img 
                                                    src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                                
                                                <div class="mailbox-attachment-info main-active">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                    <?php }

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp3)) { ?>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <audio controls>
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="audio/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                        <!-- fallback content here -->
                                                </audio>
                                            </div>
                                        </div>
                                    <?php } 

                                    if(in_array(pathinfo($expode[$i])['extension'],$mp4)) { ?>
                                        <div class="col-<?php echo $count_divide ;?>  my-2">
                                        <div class="row">
                                        
                                        <div class="col-12">
                                                <video controls preload="auto" width="100px"  height="auto" >
                                                    <source src="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename']; ?>" type="video/<?php echo pathinfo($expode[$i])['extension']; ?>"> 
                                                </video>
                                                
                                        </div>
                                        <div class="col-12">

                                                <div class="mailbox-attachment-info main-active" style="width:100%">
                                                    <a target="_blank" href="<?php echo BASE_URL_PUBLIC."uploads/postusermessageImage/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                    <?php  echo pathinfo($expode[$i])['basename'] ;?>
                                                    <!-- || Sep2014-report.pdf -->
                                                    </a>
                                                    <span class="mailbox-attachment-size">
                                                        <?php echo $this->formatSizeUnits($file_sizes[$i]) ;?>
                                                        <!-- 1,245 KB -->
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i
                                                                class="fa fa-cloud-download"></i></a>
                                                    </span>
                                                </div>
                                        </div>
                                        </div>
                                        </div>
                                    <?php } 
                                
                                    } ?> 
                                    </div>
                                    <?php } ?>

                                <!-- END FILE IMAGE -->
                                <!-- END FILE IMAGE -->

                               </div>
                               <!-- /.direct-chat-text -->
                           </div>
                           <!-- /.direct-chat-msg -->
         <?php  }
       }
    }
    
     public function deleteMsg($message_id,$user_id)
    {
        $mysqli= $this->database;
        $query= "DELETE FROM message WHERE message_id = $message_id AND message_from = $user_id OR message_id = $message_id AND message_to = $user_id";
        
        $query1= "SELECT file_image FROM message WHERE message_id = $message_id AND message_from = $user_id OR message_id = $message_id AND message_to = $user_id";
        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();
            
        // var_dump($rows);

        if (!empty($rows['file_image'])) {

            $file=$rows['file_image'];
            $expode = explode("=",$file);
            $uploadDir = DOCUMENT_ROOT.'/uploads/postusermessageImage/';
            for ($i=0; $i < count($expode); ++$i) { 
                unlink($uploadDir.$expode[$i]);
            }

        }

        $mysqli->query($query);
        // var_dump($query);
        // var_dump( $mysqli->query($query));

    }

     public function deleteMsgAll($message_to,$user_id)
    {
        $mysqli= $this->database;
        $query= "DELETE FROM message WHERE message_to = $message_to AND message_from = $user_id ";

        $query1= "SELECT file_image FROM message WHERE message_to = $message_to AND message_from = $user_id";
        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();
            
        // var_dump($rows);

        if (!empty($rows['file_image'])) {

            $file=$rows['file_image'];
            $expode = explode("=",$file);
            $uploadDir = DOCUMENT_ROOT.'/uploads/postusermessageImage/';
            for ($i=0; $i < count($expode); ++$i) { 
                unlink($uploadDir.$expode[$i]);
            }

        }

        $sql=$mysqli->query($query);

        if($sql){
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


$message= new Message();

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>