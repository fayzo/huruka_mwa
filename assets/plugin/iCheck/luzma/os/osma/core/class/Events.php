<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Events extends Follow{

    public function eventsList($pages,$categories,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*8)-8;
        }
        $mysqli= $this->database;
         $query= $mysqli->query("SELECT * FROM events LEFT JOIN users ON user_id= user_id3 WHERE categories_events ='$categories' AND events_post != 'posted' ORDER BY created_on3 Desc Limit $showpages,8");
        ?>
          <div class="row">
           <?php while($row= $query->fetch_array()){ 
             
              $retweet= $this->checkEventsRetweet($row['events_id'],$user_id);
              $likes= $this->Eventslikes($user_id,$row['events_id']);
             ?>
            <div class="col-md-3 mb-3" >

            <div class="card borders-bottoms more" >
                <img class="pic-responsive card-img-top" width="242px" height="160px"  id="events-readmore" data-events="<?php echo $row['events_id']; ?>" src="<?php echo BASE_URL_PUBLIC ;?>uploads/events/<?php echo $row['photo'] ;?>" alt="Card image cap">
                <div class="card-body">
                    <div class="p-0 font-weight-bold">Events 

                        <ul class="list-inline mb-0  float-right" style="list-style-type: none;">  

                            <?php if($likes['like_on'] == $row['events_id']){ ?>
                                <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="unlike-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please"  data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                                <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter"><?php echo $row['likes_counts'] ;?> </span> </i> Like</button></li>
                            <?php }else{ ?>
                                <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="like-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please" data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                                <i class="fa fa-heart-o mr-1" > <span class="likescounter">  <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> </i> Like</button></li>
                            <?php } ?>

                                <span class='text-right float-right'>
                            
                                    <li  class="list-inline-item"><button class="comments-btn text-sm"  id="events-readmore" data-events="<?php echo $row['events_id']; ?>"  >
                                        <i class="fa fa-comments-o mr-1"></i> (<?php echo $this->count_Events($row['events_id']) ;?>)
                                        <!-- Comments -->
                                    </button></li>

                            <?php if($user_id == $row['user_id3']){ ?>

                                    <li  class=" list-inline-item">
                                        <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                            <li>
                                                <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <ul style="list-style-type: none; margin:0px;" >
                                                    <li style="list-style-type: none; margin:0px;"> 
                                                        <label class="deleteEvents"  data-events="<?php echo $row["events_id"];?>"  data-user="<?php echo $row["user_id3"];?>">Delete </label>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                            <?php } ?>
                                    </span>
                            </ul>
                                    
                    </div>

                    <hr>
                    <div style="height:115px;"  id="events-readmore" data-events="<?php echo $row['events_id']; ?>" >
                        
                        <!-- <div class="mb-3 text-muted">Posted on < ?php echo $this->timeAgo($row['created_on3']) ;?> By < ?php echo $row['authors'] ;?> </div> -->
                    
                        <h4 style="font-family: Playfair Display, Georgia, Times New Roman, serif;text-align:left;">
                            <a class="text-primary text-left" href="javascript:void(0)" id="events-readmore" data-events="<?php echo $row['events_id'] ;?>">
                            <?php echo $row["name_place"]; ?>
                            </a>
                        </h4>

                        <p class="mb-auto"> 
                            <?php 
                                if (strlen($row["additioninformation"]) > 113) {
                                echo $row["additioninformation"] = substr($row["additioninformation"],0,113).'... <span class="mb-0"><a href="javascript:void(0)" id="events-readmore" data-events="'.$row['events_id'].'" style"font-weight: 500 !important;">Read more >>> </a></span>';
                                }else{
                                echo $row["additioninformation"];
                                } ?> 
                        </p>

                        
                    </div>          
                    <div class="black-bg" style="padding:4px;border-radius:3px">
                        ------------------------
                            <div><i class="fa fa-map-marker" aria-hidden="true"></i> Avenue: <?php echo $row['location_events']; ?> </div>
                            ------------------------
                            <div><i class="fa fa-calendar text-success" aria-hidden="true"></i> Start event: <?php echo date('M j, Y', strtotime($row['start_events'])); ?> 
                            <!-- <i class="fa fa-clock-o" aria-hidden="true"></i> < ?php echo $row['start_time']; ?> -->
                            </div>
                            ------------------------
                            <div><i class="fa fa-calendar text-danger" aria-hidden="true"></i> End event: <?php echo date('M j, Y', strtotime($row['end_events'])); ?> 
                            <!-- <i class="fa fa-clock-o" aria-hidden="true"></i> < ?php echo $row['end_time']; ?> -->
                            </div>
                            ------------------------
                            <div><i class="fa fa-clock-o" aria-hidden="true"></i>  Posted on <?php echo $this->timeAgo($row['created_on3']); ?> </div>
                            ------------------------
                    </div>
                </div>
            </div> <!-- card -->

            </div>
            
        <?php   } 

        $query1= $mysqli->query("SELECT COUNT(*) FROM events WHERE categories_events ='$categories' ORDER BY created_on3 Desc ");
        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/8;
        $post_Perpage = ceil($post_Perpages); ?>

        </div> <!-- row -->

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
     
        <?php } 

    }

    public function eventsActivities($user_id,$ativities)
    {
        $mysqli= $this->database;
        if ($ativities == 'activities') {
            # code...
            $query= $mysqli->query("SELECT * FROM events LEFT JOIN users ON user_id= user_id3 WHERE user_id3 ='$user_id' ORDER BY created_on3 Desc ");
        }else {
            # code...
            $query= $mysqli->query("SELECT * FROM events LEFT JOIN users ON user_id= user_id3 WHERE user_id3 !='' AND events_post != 'posted'  ORDER BY created_on3 Desc ");
        }
       ?>
          <?php while($row= $query->fetch_array()){ 
            
             $retweet= $this->checkEventsRetweet($row['events_id'],$user_id);
             $likes= $this->Eventslikes($user_id,$row['events_id']);
            ?>
           <div class="col-md-6 mb-3" >

           <div class="card borders-bottoms more" >
               <img class="pic-responsive card-img-top" width="242px" height="160px"  id="events-readmore" data-events="<?php echo $row['events_id']; ?>" src="<?php echo BASE_URL_PUBLIC ;?>uploads/events/<?php echo $row['photo'] ;?>" alt="Card image cap">
               <div class="card-body">
                   <div class="p-0 font-weight-bold">Events 

                       <ul class="list-inline mb-0  float-right" style="list-style-type: none;">  

                           <?php if($likes['like_on'] == $row['events_id']){ ?>
                               <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="unlike-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please"  data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                               <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter"><?php echo $row['likes_counts'] ;?> </span> </i> Like</button></li>
                           <?php }else{ ?>
                               <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="like-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please" data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                               <i class="fa fa-heart-o mr-1" > <span class="likescounter">  <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> </i> Like</button></li>
                           <?php } ?>

                               <span class='text-right float-right'>
                           
                                   <li  class="list-inline-item"><button class="comments-btn text-sm"  id="events-readmore" data-events="<?php echo $row['events_id']; ?>">
                                       <i class="fa fa-comments-o mr-1"></i> (<?php echo $this->count_Events($row['events_id']) ;?>)
                                       <!-- Comments -->
                                   </button></li>

                           <?php if($user_id == $row['user_id3']){ ?>

                                   <li  class=" list-inline-item">
                                       <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                           <li>
                                               <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                               <ul style="list-style-type: none; margin:0px;" >
                                                   <li style="list-style-type: none; margin:0px;"> 
                                                       <label class="deleteEvents"  data-events="<?php echo $row["events_id"];?>"  data-user="<?php echo $row["user_id3"];?>">Delete </label>
                                                   </li>
                                               </ul>
                                           </li>
                                       </ul>
                                   </li>
                           <?php } ?>
                                   </span>
                           </ul>
                                   
                   </div>

                   <hr>
                   <div style="height:115px;"  id="events-readmore" data-events="<?php echo $row['events_id']; ?>" >
                       
                       <!-- <div class="mb-3 text-muted">Posted on < ?php echo $this->timeAgo($row['created_on3']) ;?> By < ?php echo $row['authors'] ;?> </div> -->
                   
                       <h4 style="font-family: Playfair Display, Georgia, Times New Roman, serif;text-align:left;">
                           <a class="text-primary text-left" href="javascript:void(0)" id="events-readmore" data-events="<?php echo $row['events_id'] ;?>">
                           <?php echo $row["name_place"]; ?>
                           </a>
                       </h4>

                       <p class="mb-auto"> 
                           <?php 
                               if (strlen($row["additioninformation"]) > 113) {
                               echo $row["additioninformation"] = substr($row["additioninformation"],0,113).'... <span class="mb-0"><a href="javascript:void(0)" id="events-readmore" data-events="'.$row['events_id'].'" style"font-weight: 500 !important;">Read more >>> </a></span>';
                               }else{
                               echo $row["additioninformation"];
                               } ?> 
                       </p>

                       
                   </div>          
                   <div class="black-bg" style="padding:4px;border-radius:3px">
                       ------------------------
                           <div><i class="fa fa-map-marker" aria-hidden="true"></i> Avenue: <?php echo $row['location_events']; ?> </div>
                           ------------------------
                           <div><i class="fa fa-calendar text-success" aria-hidden="true"></i> Start event: <?php echo date('M j, Y', strtotime($row['start_events'])); ?> 
                           <!-- <i class="fa fa-clock-o" aria-hidden="true"></i> < ?php echo $row['start_time']; ?> -->
                           </div>
                           ------------------------
                           <div><i class="fa fa-calendar text-danger" aria-hidden="true"></i> End event: <?php echo date('M j, Y', strtotime($row['end_events'])); ?> 
                           <!-- <i class="fa fa-clock-o" aria-hidden="true"></i> < ?php echo $row['end_time']; ?> -->
                           </div>
                           ------------------------
                           <div><i class="fa fa-clock-o" aria-hidden="true"></i>  Posted on <?php echo $this->timeAgo($row['created_on3']); ?> </div>
                           ------------------------
                   </div>
               </div>
           </div> <!-- card -->

           </div><!-- col -->
   <?php  }
   
    }

    public function EventsReadmore($events_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN events B ON B. user_id3 = u. user_id WHERE B. events_id = '$events_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function Events_comments($tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM events_comment LEFT JOIN users ON comment_by=user_id LEFT JOIN events ON comment_on=events_id  WHERE comment_on = $tweet_id ORDER BY comment_at DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

    public function count_Events($events_id)
    {
        $db =$this->database;
        $query= "SELECT COUNT(*) FROM events_comment C LEFT JOIN events E ON C. comment_on= E. events_id  WHERE C. comment_on = $events_id ";
        $sql= $db->query($query);
        $row_unapproval = $sql->fetch_array();
        $total_unapprovalcomm= array_shift($row_unapproval);
        $array= array(0,$total_unapprovalcomm);
        $total_unapproval= array_sum($array);
        return $total_unapproval;
    }

    public function getPopupEventsTweet($user_id,$events_id,$events_by)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN events B ON B. user_id3 = u. user_id Left JOIN events_like L ON L. like_on = B. events_id Left JOIN events_comment C ON C. comment_on = B. events_id WHERE B. user_id3 =$events_by AND B. events_id = $events_id ");
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      public function Eventsretweet($retweet_id,$user_id,$tweet_by,$comments)
    {
        $mysqli= $this->database;
        $stmt = $mysqli->stmt_init();
        $query= "UPDATE events SET retweet_counts = retweet_counts +1  WHERE events_id= ? ";
        $stmt->prepare($query);
        $stmt->bind_param('i',$retweet_id);
        $stmt->execute();
        
        $query= "INSERT INTO events (retweet_events_id,tweet_events_by,country,title,authors,photo_Title,province,districts,sector,cell,village,name_place,location_events,start_events,date0,categories_events,additioninformation,photo,video,youtube,likes_counts,user_id3,retweet_counts,events_posted_on,events_retweet_Msg,events_post,created_on3)
        SELECT ?,?,country,title,authors,photo_Title,province,districts,sector,cell,village,name_place,location_events,start_events,date0,categories_events,additioninformation,photo,video,youtube,likes_counts,user_id3,retweet_counts, ?, ?,?,created_on3 FROM events WHERE events_id= ? ";

        $stmt->prepare($query);
        $time = date('Y-m-d H-i-s');
        $post = 'posted';
        $stmt->bind_param('iisssi', $retweet_id, $user_id,$time,$comments,$post,$retweet_id);
        $stmt->execute();  
        $query= "DELETE FROM events WHERE events_id= ?";
        $stmt->prepare($query);
        $stmt->bind_param('i',$stmt->insert_id);

        // if ($retweet_id != $user_id) {
        //     var_dump($tweet_by,$user_id, $retweet_id,'retweet');
        //     Notification::SendNotifications($tweet_by,$user_id,$retweet_id,'retweet');
        //     var_dump(Notification::SendNotifications($tweet_by,$user_id,$retweet_id,'retweet'));
        // }

        var_dump($stmt->execute());
        
        return $stmt->execute();
    }
     
     public function checkEventsRetweet($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="SELECT * FROM events WHERE retweet_events_id= $tweet_id  AND tweet_events_by= $user_id OR events_id= $tweet_id AND tweet_events_by= $user_id ";
        $result = $mysqli->query($query);
        $CountRetweet= array();
        while ($row= $result->fetch_assoc()) {
             $CountRetweet[] = $row;
        }
        foreach ($CountRetweet as $countsRetweet) {
            # code...
            return $countsRetweet; // Return the $contacts array
        }

    }

      public function Eventslikes($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM events_like WHERE like_by = $user_id AND like_on = $tweet_id";
        $result= $mysqli->query($query);

        $fetchCountLikes= array();
        while ($row= $result->fetch_assoc()) {
             $fetchCountLikes[] = array(
            'like_id' => $row['like_id'],
            'like_by' => $row['like_by'],
            'like_on' => $row['like_on']
           );
        }
        foreach ($fetchCountLikes as $fetchLikes) {
            # code...
            return $fetchLikes; // Return the $contacts array
        }
    }
    
       public function addLikeEvents($user_id,$events_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events SET likes_counts = likes_counts +1 WHERE events_id= $events_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$events_id,'likes');
        // }
        $this->creates('events_like',array('like_by' => $user_id ,'like_on' => $events_id));
    }

      public function unLikeEvents( $user_id,$events_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events SET likes_counts = likes_counts -1 WHERE events_id= $events_id ";
        $mysqli->query($query);

        $query= "DELETE FROM events_like WHERE like_by = $user_id AND like_on = $events_id ";
        $mysqli->query($query);

    }

       public function addLikeEventsUsercomment($user_id,$comment_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events_comment SET likes_counts_ = likes_counts_ +1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$events_id,'likes');
        // }
        $this->creates('events_comment_like',array('like_by_' => $user_id ,'like_on_' => $comment_id));
    }

      public function unLikeEventsUsercomment($user_id,$comment_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events_comment SET likes_counts_ = likes_counts_ -1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);

        $query= "DELETE FROM events_comment_like WHERE like_by_ = $user_id AND like_on_ = $comment_id ";
        $mysqli->query($query);

    }

      public function events_comment_like($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM events_comment_like WHERE like_by_ = $user_id AND like_on_ = $tweet_id";
        $result= $mysqli->query($query);

        $fetchCountLikes= array();
        while ($row= $result->fetch_assoc()) {
             $fetchCountLikes[] = array(
            'like_id_' => $row['like_id_'],
            'like_by_' => $row['like_by_'],
            'like_on_' => $row['like_on_']
           );
        }
        foreach ($fetchCountLikes as $fetchLikes) {
            # code...
            return $fetchLikes; // Return the $contacts array
        }
    }

    public function CountEventsComment($events_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM events_comment WHERE comment_on= $events_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

     
    public function deleteLikesEvents($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE B , L ,C ,R FROM events B 
                        LEFT JOIN events_like L ON L. like_on = B. events_id 
                        LEFT JOIN events_comment_like C ON C. like_on_ = B. events_id 
                        LEFT JOIN events_comment R ON R. comment_on = B. events_id 
                        WHERE B. events_id = '{$tweet_id}' and B. user_id3 = '{$user_id}' ";

        $query1="SELECT * FROM events WHERE events_id = $tweet_id and user_id3 = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'];
            $expodefile = explode("=",$photo);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$photo);
                $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/Blog_nyarwanda_CMS/uploads/events/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/Blog_nyarwanda_CMS/uploads/events/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/Blog_nyarwanda_CMS/uploads/events/';
                      unlink($uploadDir.$photo);
            }
        }

        $query= $mysqli->query($query);
        // var_dump("ERROR: Could not able to execute $query.".mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS DELETE</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail to delete !!!</strong>
                </div>');
        }
    }

      public function events_getPopupTweet($user_id,$tweet_id,$tweet_by)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN events B ON B. user_id3 = u. user_id Left JOIN events_like L ON L. like_on = B. events_id WHERE B. events_id = $tweet_id AND B. user_id3 = $tweet_by ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

}

$events = new Events();
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