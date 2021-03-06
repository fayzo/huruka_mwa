<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Fundraising extends Events
{
    public function fundraisings($pages,$categories,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*8)-8;
        }
        $mysqli= $this->database;

        if ($categories == 'Feature') {
            # code...
            $query= $mysqli->query("SELECT * FROM users U Left JOIN fundraising F ON F. user_id2 = U. user_id WHERE F. categories_fundraising = F. categories_fundraising ORDER BY F. created_on2 Desc Limit $showpages,8");
        }else {
            # code...
            $query= $mysqli->query("SELECT * FROM users U Left JOIN fundraising F ON F. user_id2 = U. user_id WHERE F. categories_fundraising ='$categories' ORDER BY created_on2 Desc Limit $showpages,8");
        }
        ?>
            <div class="row mt-3">
          <?php
            if ($query->num_rows > 0) { ?>

        <?php while($row= $query->fetch_array()) { 
              $likes= $this->Fundraisinglikes($user_id,$row['fund_id']); ?>
        
                <div class="col-md-3 mb-3" >

                    <div class="card borders-bottoms more" >
                        <img class="card-img-top" width="242px" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" height="160px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/fundraising/<?php echo $row['photo'] ;?>" >
                        <div class="card-body">
                            <div class="p-0"> <span class="font-weight-bold"> Fundraising </span>

                                <?php if(isset($_SESSION['key']) && $user_id == $row['user_id2']){ ?>
                                <ul class="list-inline mb-0  float-right" style="list-style-type: none;">  

                                    <li  class="list-inline-item"><button class="comments-btn text-sm" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" >
                                        <i class="fa fa-comments-o mr-1"></i> (<?php echo $this->count_fund($row['fund_id']) ;?>)
                                        <!-- Comments -->
                                    </button>
                                    </li>

                                    <li  class=" list-inline-item">
                                        <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                            <li>
                                                <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <ul style="list-style-type: none; margin:0px;" >
                                                    <li style="list-style-type: none; margin:0px;"> 
                                                    <label class="deleteFundraising"  data-fund="<?php echo $row["fund_id"];?>"  data-user="<?php echo $row["user_id2"];?>">Delete </label>
                                                    </li>
                                                    <li style="list-style-type: none; margin:0px;"> 
                                                    <?php $details= '\'day\',\''.$row['firstname'].'\',\''.$row['lastname'].'\',\''.$row['email'].'\','.$row['fund_id'].','.$row['user_id'].',\'fundraising withdraw\'' ;?>
                                                    <label onclick="withdraw_money(<?php echo $row['money_raising'].','.$details ;?>)" >Withdrawal This Donation</label>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                                <?php } ?>

                                <?php if($likes['like_on'] == $row['fund_id']){ ?>
                                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraising-btn more float-right text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right text-sm  mr-2" data-login="1" '; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>"> <i class="fa fa-heart"></i> <span class="likescounter "><?php echo $row['likes_counts'] ;?></span> Like</span>
                                <?php }else{ ?>
                                    <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraising-btn more float-right text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right text-sm  mr-2"  data-login="1" '; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>" ><i class="fa fa-heart-o" ></i> <span class="likescounter"> <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span>  Like</span>
                                <?php } ?>
                            </div>

                            <hr>
                            <div style="height:115px;" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>">
                                <a href="javascript:void(0);"  class="card-text h5">
                                     Helps <?php echo $row['lastname1'] ;?> 
                                </a>
                                <!-- Kogera umusaruro muguhinga -->
                                <p class="mt-2">
                            <?php if (strlen($row["text"]) > 80) {
                                        $tweettext = substr($row["text"], 0, 80);
                                        $tatus = substr($row["text"], 0, strrpos($tweettext, ' ')).'
                                        <span class="mb-0"><a href="javascript:void(0)" id="fund-readmore" data-fund="'.$row['fund_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">read more...</a></span>';
                                        echo $tatus;
                                        }else{
                                        echo $row["text"];
                                        } ?> 
                                </p>
                                <button type="button" class="btn btn-success btn-sm mb-2 float-right">Support</button>            
                                <!-- 117 -->
                                <!-- turashaka kongera umusaruro mu buhinzi tukabona ubufasha buhagije no kubona imbuto -->
                            </div>          
                            <div class="text-muted mt-2 clear-float"><?php echo $categories; ?>
                                <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                            </div>
                            <div class="card-text">
                            <!-- 40,000 -->
                                <span class="font-weight-bold"><?php echo number_format($row['money_raising']); ?> Frw</span>
                                Raised
                                <span class="float-right"><?php echo $this->donationPercetangeMoneyRaimaing($row['money_raising'],$row['money_to_target']); ?> %</span>
                                <!-- 40 -->
                            </div>
                            <div class="progress clear-float " style="height: 10px;">
                                <?php echo $this->Users_donationMoneyRaising($row['money_raising'],$row['money_to_target']); ?>
                            </div>
                            
                            <div class="clear-float">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span class="text-muted"><?php echo $this->timeAgo($row['created_on2']); ?></span>
                                <span class="text-muted float-right text-right">out of <?php echo number_format($row['money_to_target']).' Frw'; ?></span>
                                <!-- 13 days Left -->
                            </div>
                        </div>
                    </div> <!-- card -->

                </div>

        <?php } 
        
        }else{
            echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>No Record</strong>
                </div></div>'; 
        } 
        if ($categories == 'Feature') {

            $query1= $mysqli->query("SELECT COUNT(*) FROM users U Left JOIN fundraising F ON F. user_id2 = U. user_id WHERE F. categories_fundraising = F. categories_fundraising ORDER BY created_on2 Desc ");
        }else {
            # code...
            $query1= $mysqli->query("SELECT COUNT(*) FROM users U Left JOIN fundraising F ON F. user_id2 = U. user_id WHERE F. categories_fundraising ='$categories'  ORDER BY created_on2 Desc ");
        }

        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/8;
        $post_Perpage = ceil($post_Perpages); ?>

    </div>
    <?php if($post_Perpage > 1){ ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($pages > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
            <?php } ?>
            <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                    if ($i == $pages) { ?>
                 <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php }else{ ?>
                <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
            <?php } } ?>
            <?php if ($pages+1 <= $post_Perpage) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
            <?php } ?>
        </ul>
    </nav>
   <?php } ?>
   
   <?php }

    public function fundFecthReadmore($fund_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U 
        Left JOIN fundraising F ON F. user_id2 = U. user_id 
        Left JOIN fund_like L ON L. like_on= F. fund_id 
        
        Left JOIN provinces P ON F. province = P. provincecode
        Left JOIN districts M ON F. districts = M. districtcode
        Left JOIN sectors T ON F. sector = T. sectorcode
        Left JOIN cells S ON F. cell = S. codecell
        Left JOIN vilages V ON F. village = V. CodeVillage 

        WHERE F. fund_id = '$fund_id' ");
        $row= $query->fetch_array();
        return $row;
    }

      public function Fundraising_comments($tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM comment_funding LEFT JOIN users ON comment_by=user_id LEFT JOIN fundraising ON comment_on=fund_id Left JOIN fundraising_comment_like ON comment_id =like_on_  WHERE comment_on = $tweet_id ORDER BY comment_at DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

       public function addLikeFundraising($user_id,$fund_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE fundraising SET likes_counts = likes_counts +1 WHERE fund_id= $fund_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$fund_id,'likes');
        // }
        $this->creates('fund_like',array('like_by' => $user_id ,'like_on' => $fund_id));
    }

      public function unLikeFundraising( $user_id,$fund_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE fundraising SET likes_counts = likes_counts -1 WHERE fund_id= $fund_id ";
        $mysqli->query($query);

        $query= "DELETE FROM fund_like WHERE like_by = $user_id AND like_on = $fund_id ";
        $mysqli->query($query);

    }

       public function addLikeFundraisingUsercomment($user_id,$comment_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment_funding SET likes_counts_ = likes_counts_ +1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$fund_id,'likes');
        // }
        $this->creates('fundraising_comment_like',array('like_by_' => $user_id ,'like_on_' => $comment_id));
    }

      public function unLikeFundraisingUsercomment($user_id,$comment_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment_funding SET likes_counts_ = likes_counts_ -1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);

        $query= "DELETE FROM fundraising_comment_like WHERE like_by_ = $user_id AND like_on_ = $comment_id ";
        $mysqli->query($query);

    }
     
      public function Fundraisinglikes($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM fund_like WHERE like_by = $user_id AND like_on = $tweet_id";
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

      public function Fundraising_comment_like($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM fundraising_comment_like WHERE like_by_ = $user_id AND like_on_ = $tweet_id";
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

    public function CountFundraisingComment($fund_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM comment_funding WHERE comment_on= $fund_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

    
    public function fund_getPopupTweet($user_id,$tweet_id,$tweet_by)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN fundraising F ON F. user_id2 = U. user_id Left JOIN fund_like L ON L. like_on = F. fund_id WHERE F. fund_id = $tweet_id AND F. user_id2 = $tweet_by ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }
    
    public function deleteLikesfund($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE C , L , F ,R ,D FROM fundraising C 
                        LEFT JOIN fund_like L ON L. like_on = C. fund_id 
                        LEFT JOIN comment_funding R ON R. comment_on = C. fund_id 
                        LEFT JOIN fundraising_comment_like F ON F. like_on_ = R. comment_id 
                        LEFT JOIN fundraising_donation D ON D. fund_id0 = C. fund_id 
                        WHERE C. fund_id = '{$tweet_id}' and C. user_id2 = '{$user_id}' ";

        $query1="SELECT * FROM fundraising WHERE fund_id = $tweet_id and user_id2 = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'].'='.$rows['other_photo'];
            $expode = explode("=",$photo);
            $uploadDir = DOCUMENT_ROOT.'/uploads/fundraising/';
            for ($i=0; $i < count($expode); ++$i) { 
                    unlink($uploadDir.$expode[$i]);
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

    public function fundraising_donateUpdate($donate,$fund_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE fundraising SET donate_counts = donate_counts +1, money_raising = money_raising + $donate  WHERE fund_id= $fund_id ";
        $mysqli->query($query);
    }

    public function recentFundraisingDonate($fund_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM fundraising_donation F LEFT JOIN users U ON F. sentby_user_id= U. user_id WHERE F. fund_id0 = $fund_id ORDER BY F. created_on3 DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

    public function CountFundraisingRaising($fund_id)
    {
      $db =$this->database;
      $query="SELECT COUNT(*) FROM fundraising_donation WHERE fund_id0= $fund_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

    
    public function count_fund($fund_id)
    {
        $db =$this->database;
        $query= "SELECT COUNT(*) FROM comment_funding C LEFT JOIN fundraising F ON C. comment_on= F.fund_id  WHERE C. comment_on = $fund_id ";
        $sql= $db->query($query);
        $row_unapproval = $sql->fetch_array();
        $total_unapprovalcomm= array_shift($row_unapproval);
        $array= array(0,$total_unapprovalcomm);
        $total_unapproval= array_sum($array);
        return $total_unapproval;
    }

    public function fundraisingcountPOSTS($categories)
    {
      $db =$this->database;

      if ($categories == 'Feature') {
          $query="SELECT COUNT(*) FROM fundraising WHERE categories_fundraising = categories_fundraising ";
      }else {
          $query="SELECT COUNT(*) FROM fundraising WHERE categories_fundraising= '$categories' ";
      }

      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

    public function fundraisingData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM fundraising WHERE user_id2 = '$user_id' ");
        $row= $query->fetch_array();
        return $row;
    }

        public function fundraisingsActivities($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN fundraising F ON F. user_id2 = U. user_id WHERE F. user_id2 = '$user_id'  ORDER BY created_on2 Desc ");
        ?>
        <div class="card card-primary mb-3 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title text-center"><i> Fundraising</i></h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="row mt-3">
        <?php while($row= $query->fetch_array()) { 
              $likes= $this->Fundraisinglikes($user_id,$row['fund_id']); ?>
        
                <div class="col-md-6 col-sm-12 mb-3" >

                <div class="card borders-bottoms more" >
                        <img class="card-img-top" width="242px" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" height="160px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/fundraising/<?php echo $row['photo'] ;?>" >
                        <div class="card-body">
                        <div class="p-0"> <span class="font-weight-bold"> Fundraising </span>

                                <?php if(isset($_SESSION['key']) && $user_id == $row['user_id2']){ ?>
                                
                                <ul class="list-inline mb-0  float-right" style="list-style-type: none;">  

                                    <li  class="list-inline-item"><button class="comments-btn text-sm" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" >
                                        <i class="fa fa-comments-o mr-1"></i> (<?php echo $this->count_fund($row['fund_id']) ;?>)
                                        <!-- Comments -->
                                    </button>
                                    </li>

                                    <li  class=" list-inline-item">
                                        <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                            <li>
                                                <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <ul style="list-style-type: none; margin:0px;" >
                                                    <li style="list-style-type: none; margin:0px;"> 
                                                    <label class="deleteFundraising"  data-fund="<?php echo $row["fund_id"];?>"  data-user="<?php echo $row["user_id2"];?>">Delete </label>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                                <?php } ?>

                                <?php if($likes['like_on'] == $row['fund_id']){ ?>
                                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraising-btn more float-right text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right text-sm  mr-2" data-login="1" '; } ?> style="font-size:16px;" data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>"><span class="likescounter "><?php echo $row['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                <?php }else{ ?>
                                    <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraising-btn more float-right text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right text-sm  mr-2"  data-login="1" '; } ?> style="font-size:16px;" data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>" ><span class="likescounter"> <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                <?php } ?>
                            
                            </div>

                            <hr>
                            <div style="height:115px;">
                                <a href="javascript:void(0);" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" class="card-text h5">
                                     Helps <?php echo $row['lastname'] ;?> 
                                </a>
                                <!-- Kogera umusaruro muguhinga -->
                                <p class="mt-2">
                            <?php if (strlen($row["text"]) > 80) {
                                        echo $row["text"] = substr($row["text"],0,80).'...
                                        <br><span class="mb-0"><a href="javascript:void(0)" id="fund-readmore" data-fund="'.$row['fund_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">read more...</a></span>';
                                        }else{
                                        echo $row["text"];
                                        } ?> 
                                </p>
                                <!-- 117 -->
                                <!-- turashaka kongera umusaruro mu buhinzi tukabona ubufasha buhagije no kubona imbuto -->
                            </div>                      
                            <div class="text-muted mb-1"><?php echo $categories; ?>
                                <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                            </div>
                            <div class="card-text">
                            <!-- 40,000 -->
                                <span class="font-weight-bold"><?php echo number_format($row['money_raising']); ?> Frw</span>
                                Raised
                                <span class="float-right"><?php echo $this->donationPercetangeMoneyRaimaing($row['money_raising'],$row['money_to_target']); ?> %</span>
                                <!-- 40 -->
                            </div>
                            <div class="progress clear-float " style="height: 10px;">
                                <?php echo $this->Users_donationMoneyRaising($row['money_raising'],$row['money_to_target']); ?>
                            </div>
                            
                            <div class="clear-float">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span class="text-muted"><?php echo $this->timeAgo($row['created_on2']); ?></span>
                                <span class="text-muted float-right text-right">out of <?php echo number_format($row['money_to_target']).' Frw'; ?></span>
                                <!-- 13 days Left -->
                            </div>
                        </div>
                    </div> <!-- card -->


                </div> <!-- col -->

        <?php } ?>
             </div> <!-- row -->
           </div> <!-- card-body -->
        </div> <!-- card -->
   <?php }




}

$fundraising = new Fundraising();
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