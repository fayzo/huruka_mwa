<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Trending extends Home 
{
     public function trends()
    {
       $mysqli= $this->database;
      //  $query= "SELECT *, COUNT(tweet_id) AS tweetycounts  FROM  trends INNER JOIN tweets ON status LIKE CONCAT('%#',hashtag,'%') OR retweet_Msg LIKE CONCAT('%#',hashtag,'%') GROUP BY hashtag HAVING COUNT(DISTINCT hashtag)=1 ORDER BY tweet_id Desc LIMIT 10";
       $query= "SELECT *, COUNT(trend_id) AS tweetycounts  FROM  trends
        WHERE hashtag = hashtag GROUP BY hashtag HAVING COUNT(DISTINCT hashtag)=1 ORDER BY trend_id Desc LIMIT 10";
       $result=$mysqli->query($query); 

       if ($result->num_rows > 0 ) {
          # code...
       ?>
             <div class="card card-primary mb-3">
                  <div class="card-header main-active p-1">
                        <h5 class="card-title text-center"><i> HashTags</i></h5>
                  </div>
                    <div class="card-body text-center message-color">
      <?php  while ($trend= $result->fetch_array()) { 
         //  echo print_r($trend,$trend['tweetycounts']).'<br>';
         ?>
                    <!-- /.card-header -->
                        <strong><a href="<?php echo BASE_URL_PUBLIC.$trend['hashtag'].'.hashtag' ;?>" >#<?php echo $trend['hashtag'] ;?></a></strong>

                        <p class="text-muted">
                           <?php echo $trend['tweetycounts']." Posts" ; ?>
                        </p>

                        <!-- <hr> -->
      <?php  }  ?>
                  </div> <!-- /.card-body -->
            </div> <!-- /.card -->
   <?php } 
   
   }

     public function trends_hashtag()
    {
       $mysqli= $this->database;
       $query= "SELECT *, COUNT(trend_id) AS tweetycounts FROM trends INNER JOIN tweets ON status LIKE CONCAT('%#',hashtag,'%') OR retweet_Msg LIKE CONCAT('%#',hashtag,'%') GROUP BY hashtag ORDER BY trend_id";
       $result=$mysqli->query($query); 

       if ($result->num_rows > 0 ) {
          # code...
       ?>
      <?php  while ($trend= $result->fetch_array()) { ?>
                    <!-- /.card-header -->
                    <li><a href="<?php echo BASE_URL_PUBLIC.$trend['hashtag'].'.hashtag' ;?>"><i class="fa fa-circle-o"></i>#<?php echo $trend['hashtag'] ;?></a></li>
      <?php  }  ?>
   <?php } 
   
   }

     public function trends_hashtag_navbar()
    {
       $mysqli= $this->database;
       $query= "SELECT *, COUNT(trend_id) AS tweetycounts FROM trends INNER JOIN tweets ON status LIKE CONCAT('%#',hashtag,'%') OR retweet_Msg LIKE CONCAT('%#',hashtag,'%') GROUP BY hashtag ORDER BY trend_id Limit 1";
       $result=$mysqli->query($query); 

       if ($result->num_rows > 0 ) {
          # code...
       ?>
      <?php  while ($trend= $result->fetch_array()) { ?>
                    <!-- /.card-header -->
                  <a class="sidebar-toggle_" href="<?php echo BASE_URL_PUBLIC.$trend['hashtag'].'.hashtag' ;?>">
                     <i class="fa fa-hashtag"> </i>
                     <span class="hidden-xs"> HashTag</span>
                  </a>
      <?php  }  ?>
   <?php } 
   
   }

    public function getTweetsTrendbyhastag($hashtag)
    {
       $mysqli= $this->database;
      //  $query= "SELECT * FROM tweets T LEFT JOIN users U ON T. tweetBy= U. user_id WHERE T. status LIKE '%#". $hashtag ."%' OR T. retweet_Msg LIKE '%#". $hashtag ."%' ORDER BY T. posted_on DESC";
       $query= "SELECT * FROM tweets T LEFT JOIN users U ON T. tweetBy= U. user_id WHERE T. status LIKE '%#". $hashtag ."%' AND  T. retweet_by = 0 ORDER BY T. posted_on DESC";
       $result= $mysqli->query($query);
      //   var_dump('ERROR: Could not able to execute '. $result.mysqli_error($mysqli));
       $tweets_hashtag = array();
       while ($row = $result->fetch_assoc()) {
            /* TABLE OF tweety */
         $tweets_hashtag[] = $row;
      }
       return $tweets_hashtag;

    } 
    
    public function getTweetsTrendbyhastag_not_empty($hashtag)
    {
       $mysqli= $this->database;
      //  $query= "SELECT * FROM tweets T LEFT JOIN users U ON T. tweetBy= U. user_id WHERE T. status LIKE '%#". $hashtag ."%' AND T. tweet_image != '' OR T. retweet_Msg LIKE '%#". $hashtag ."%' AND T. tweet_image != '' ORDER BY T. posted_on DESC";
       $query= "SELECT * FROM tweets T LEFT JOIN users U ON T. tweetBy= U. user_id WHERE T. status LIKE '%#". $hashtag ."%' AND T. tweet_image != '' AND  T. retweet_by = 0 ORDER BY T. posted_on DESC";
       $result= $mysqli->query($query);
      //   var_dump('ERROR: Could not able to execute '. $result.mysqli_error($mysqli));
       $tweets_hashtag = array();
       while ($row = $result->fetch_assoc()) {
            /* TABLE OF tweety */
         $tweets_hashtag[] = $row;
      }
       return $tweets_hashtag;

    } 

    public function getUsersHashtag($hashtag)
    {
      $mysqli = $this->database;
      $query = "SELECT DISTINCT * FROM tweets T 
      LEFT JOIN users U ON T. tweetBy= U. user_id AND  U. close_account != 'yes' AND U. delete_account != 'yes'
      WHERE T. status LIKE '%#" . $hashtag . "%' OR T. retweet_Msg LIKE '%#" . $hashtag . "%' GROUP BY U. user_id";
      $result = $mysqli->query($query);
      $users_hashtag = array();
      while ($row = $result->fetch_assoc()) {
            /* TABLE OF tweety */
         $users_hashtag[] = $row;
      }
      return $users_hashtag;
    }
}

$trending = new Trending();

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