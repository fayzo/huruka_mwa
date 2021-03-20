<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Home extends Comment {

     public function usersNameId($username)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT user_id FROM users WHERE username= '$username'");
        $row= $query->fetch_array();
        return $row;
    }

        public function userData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users WHERE user_id= '{$user_id}' ");
        $row= $query->fetch_array();
        return $row;
    }
        
        function htmlspecialcharss($string)
    {
        return strip_tags(html_entity_decode($string));
    }


    public function siderbar_option() { ?>

        <?php if (isset($_SESSION['key'])) { ?>

                <li><a href="jobs"><i class="fa fa-circle-o text-yellow"></i> Job</a></li>
                <li><a href="career_profession"><i class="fa fa-circle-o text-aqua"></i>Professional</a></li>
                <li><a href="unemployment"><i class="fa fa-circle-o text-aqua"></i>unemployment</a></li>
                <li><a href="sale"><i class="fa fa-shopping-basket "></i>Marketplace</a></li>
                <!-- <li><a href="blog"><i class="fa fa-circle-o text-red"></i>Blog</a></li> -->
                <!-- <li><a href="events"><i class="fa fa-circle-o text-red"></i>Events</a></li> -->
                <li><a href="crowfund"><i class="fa fa-money "></i> gushoraStartUp</a></li>
                <li><a href="fundraising"><i class="fa fa-heartbeat"></i>Fundraising</a></li>
                <!-- <li><a href="food"><i class="fa fa-cutlery"></i>Foodzana</a></li> -->
                <!-- <li><a href="sale"><i class="fa fa-shopping-cart"></i>Sale</a></li> -->
                <li><a href="icyamunara"><i class="fa fa-shopping-basket"></i>Cyamunara</a></li>
                <li><a href="house"><i class="fa fa-home"></i>House</a></li>
                <li><a href="car"><i class="fa fa-car"></i>Car</a></li>
                <li><a href="school"><i class="fa fa-building"></i>School</a></li>
                
        <?php }else { ?>

                <li><a href="irangiro.jobs"><i class="fa fa-circle-o text-yellow"></i> Job</a></li>
                <li><a href="irangiro.career_profession"><i class="fa fa-circle-o text-aqua"></i>Professional</a></li>
                <li><a href="irangiro.unemployment"><i class="fa fa-circle-o text-aqua"></i>unemployment</a></li>
                <li><a href="irangiro.sale"><i class="fa fa-shopping-basket text-red"></i>Marketplace</a></li>
                <!-- <li><a href="irangiro.blog"><i class="fas fa-edit text-aqua"></i>Blog</a></li> -->
                <!-- <li><a href="irangiro.events"><i class="fa fa-circle-o text-red"></i>Events</a></li> -->
                <li><a href="irangiro.crowfund"><i class="fa fa-money text-aqua"></i> gushoraStartUp</a></li>
                <li><a href="irangiro.fundraising"><i class="fa fa-heartbeat text-red"></i>Fundraising</a></li>
                <!-- <li><a href="irangiro.food"><i class="fa fa-cutlery"></i>Foodzana</a></li> -->
                <!-- <li><a href="irangiro.sale"><i class="fa fa-shopping-cart text-red"></i>Sale</a></li> -->
                <li><a href="irangiro.icyamunara"><i class="fa fa-shopping-basket"></i>Cyamunara</a></li>
                <li><a href="irangiro.house"><i class="fa fa-home"></i>House</a></li>
                <li><a href="irangiro.car"><i class="fa fa-car "></i>Car</a></li>
                <li><a href="irangiro.school"><i class="fa fa-building "></i>School</a></li>

        <?php } ?>
    <?php }
    

    public function options(){ ?>

    <div class="card text-center">
        <div class="card-header main-active p-1">
        <h5 class="card-title"><i> Options</i></h5>
        </div>
        <div class="card-body options-list message-color">

        <?php if (isset($_SESSION['key'])) { ?>
            <ul>
                <li class="col-12 d-sm-block d-md-none d-lg-none"><h5><a class="alink" href="jobs">Jobs</a></h5></li>
                <li class="col-12 d-none d-md-block"><h5><a class="alink" href="jobs0">Jobs</a></h5></li>
                <li><h5><a class="alink" href="career_profession">Professional</a></h5> </li>
                <li><h5><a class="alink" href="crowfund">GushoraStartUp</a></h5> </li>
                <li><h5><a class="alink" href="fundraising"> Fundraising</a></h5></li>
                <!-- < ?php if($_SESSION['approval'] === 'on'){ ?> -->
                <li><h5><a class="alink" href="unemployment"> Unemployment</a></h5> </li>
                <!-- < ?php } ?> -->
                <!-- <li><h5><a class="alink" href="blog">Blog</a></h5></li> -->
                <!-- <li><h5><a class="alink" href="sale">Sale</a></h5></li> -->
                <!-- <li><h5><a class="alink" href="events">Events</a></h5></li> -->
                <li><h5><a class="alink" href="school">School</a></h5> </li>
                <li><h5><a class="alink" href="house">House</a></h5></li>
                <li><h5><a class="alink" href="icyamunara">Cyamunara</a></h5></li>
                <!-- <li><h5><a class="alink" href="food">Foodzana</a></h5></li> -->
                <li><h5><a class="alink" href="car">Car</a></h5></li>
                <li><h5><a class="alink" href="sale">Marketplace</a></h5></li>
            </ul>
        
        <?php }else { ?>
        <ul>
                <li class="col-12 d-sm-block d-md-none d-lg-none"><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.jobs">Jobs</a></h5></li>
                <li class="col-12 d-none d-md-block"><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.jobs0">Jobs</a></h5></li>
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.career_profession"> Professional</a></h5> </li>
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.crowfund">GushoraStartUp</a></h5> </li>
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.fundraising"> Fundraising</a></h5></li>
                <!-- <li><h5><a class="alink" href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.blog">Blog</a></h5> -->
                <!-- <li><h5><a class="alink" href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.events">Events</a></h5> -->
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.school">School</a></h5> </li>
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.house">House</a></h5>
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.icyamunara">icyamunara</a></h5>
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.car">Car</a></h5>
                <!-- <li><h5><a class="alink" href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.sale">Sale</a></h5></li> -->
                <!-- <li><h5><a class="alink" href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.food">Foodzana</a></h5> -->
                <li><h5><a class="alink" href="<?php echo BASE_URL_PUBLIC; ?>irangiro.sale">Marketplace</a></h5>
            
            </ul>
            <?php } ?>
        </div>
    </div>

    <?php }

    
public function links(){ ?>
    <?php if (isset($_SESSION['key'])) { ?>
 <ul class="list-inline link-view">
      <li class="list-inline-item"><a href="crowfund"><i class="fa fa-money" aria-hidden="true"></i> GushoraStartUp</a></li>
      <li class="list-inline-item"><a href="fundraising"><i class="fa fa-heartbeat" aria-hidden="true"></i> Fundraising</a></li>
            <?php if($_SESSION['approval'] === 'on'){ ?>
      <li class="list-inline-item"><a href="unemployment"><i class="fa fa-briefcase"></i> Unemployment</a></li>
            <?php } ?>
      <li class="list-inline-item"><a href="career_profession"><i class="fa fa-briefcase"></i>  Professional</a></li>
      <!-- <li class="list-inline-item"><a href="sale"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Sale</a></li> -->
      <!-- <li class="list-inline-item"><a href="blog"><i class="fas fa-edit"></i> Blog</a></li> -->
      <li class="list-inline-item"><a href="jobs"><i class="fas fa-newspaper    "></i> Jobs</a></li>
      <li class="list-inline-item"><a href="school"><i class="fas fa-school    "></i> School</a></li>
      <!-- <li class="list-inline-item"><a href="events"><i class="fas fa-envelope-open-text    "></i> Events</a></li> -->
      <li class="list-inline-item"><a href="house"><i class="fas fa-house-damage    "></i> House</a></li>
      <li class="list-inline-item"><a href="icyamunara"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Cyamunara</a></li>
      <li class="list-inline-item"><a href="car"><i class="fa fa-car" aria-hidden="true"></i> Car</a></li>
      <!-- <li class="list-inline-item"><a href="food"><i class="fa fa-cutlery" aria-hidden="true"></i> Foodzana</a></li> -->
      <li class="list-inline-item"><a href="sale"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Marketplace</a></li>

    </ul>
    <?php }else { ?>
    <ul  class="list-inline link-view">
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.crowfund">GushoraStartUp</a> </li>
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.fundraising"> Fundraising</a></li>
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.career_profession"> Professional</a> </li>
        <!-- <li class="list-inline-item"><a href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.sale">Sale</a></li> -->
        <!-- <li class="list-inline-item"><a href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.blog">Blog</a></li> -->
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.jobs">Jobs</a></li>
        <!-- <li class="list-inline-item"><a href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.events">Events</a></li> -->
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.school">School</a> </li>
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.house">House</a></li>
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.icyamunara">Cyamunara</a></li>
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.car">Car</a></li>
        <!-- <li class="list-inline-item"><a href="< ?php echo BASE_URL_PUBLIC; ?>irangiro.food">Foodzana</a></li> -->
        <li class="list-inline-item"><a href="<?php echo BASE_URL_PUBLIC; ?>irangiro.sale">Marketplace</a></li>

    </ul>
<?php } ?>

<?php }

      public function eventsData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM events WHERE user_id3 ='$user_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function eventsListActivities($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM events WHERE user_id3 ='$user_id' ORDER BY created_on3 Desc");
        ?>
        <div class="card card-primary mb-3 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title text-center"><i> Events</i></h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">

           <?php while($row= $query->fetch_array()){ ?>

          <div class="col-md-3 mb-3">
             <div class="card">
                 <img class="card-img-top" src="<?php echo BASE_URL_PUBLIC.'uploads/events/'.$row['photo']; ?>" width="296px" height="296px" >
                 <div class="card-body py-1 ">
                     <div>Avenue: <?php echo $row['location_events']; ?> at <?php echo $row['name_place']; ?> </div>
                     <div>date: <?php echo $row['date0']; ?> || start events: <?php echo $row['start_events']; ?> </div>
                     <div>Posted on <?php echo $row['created_on3']; ?> </div>
                 </div>
             </div>
           </div><!-- col -->

            <?php   } ?>
            </div> <!-- row -->
           </div> <!-- card-body -->
        </div> <!-- card -->
     
    <?php }

      public function blogData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM blog WHERE user_id3 ='$user_id' ");
        $row= $query->fetch_array();
        return $row;
    }
    
    public function blogsActivities($user_id){
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM blog WHERE user_id3 ='$user_id' ORDER BY created_on3 Desc ");
        ?>
       <div class="card card-primary mb-3 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title text-center"><i> Blogs</i></h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="row">
        <?php while($row= $query->fetch_array()) { ?>

        <div class="col-md-4">
          <div class="card flex-md-row mb-4 border-0 h-md-250" style="box-shadow:0 0 0.5ch 0.5ch rgba(35, 35, 32, 0.15);">
            <img class="card-img-left flex-auto d-none d-lg-block" width="200px" height="250px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/Blog/<?php echo $row['photo'] ;?>" alt="Card image cap">
            <div class="card-body d-flex flex-column align-items-start">
              <h4 style="font-family: Playfair Display, Georgia, Times New Roman, serif;text-align:left;">
               <a class="text-primary" href="javascript:void(0)" id="blog-readmore" data-blog="<?php echo $row['blog_id'] ;?>"> <?php echo  $row['title']; ?></a>
              </h4>
              <div class="mb-1 text-muted">Created on <?php echo $this->timeAgo($row['created_on3']) ;?> By <?php echo $row['authors'] ;?> </div>
              <p class="mb-auto"> 
                <?php 
                    if (strlen($row["text"]) > 125) {
                      echo $row["text"] = substr($row["text"],0,125).'...<br><span class="mb-0"><a href="javascript:void(0)" id="blog-readmore" data-blog="'.$row['blog_id'].'" class="text-muted" style"font-weight: 500 !important;">Continue reading...</a></span>';
                    }else{
                      echo $row["text"];
                    } ?> 
              </p>
            </div>
          </div>
        </div>

        <?php } ?>
             </div> <!-- row -->
           </div> <!-- card-body -->
        </div> <!-- card -->
   <?php }

   
    public function search($search)
    {
        $mysqli= $this->database;
        $param= '%'.$search.'%';
        $query = "SELECT user_id, username, email, career,hobbys, profile_img,chat FROM users Where username LIKE '{$param}' OR firstname LIKE '{$param}' OR lastname LIKE '{$param}' ";
        $result= $mysqli->query($query);
        $contacts = array();
        while ($row= $result->fetch_array()) {
            $contacts[] = array(
            'user_id' => $row['user_id'],
            'username' => $row['username'],
            'email' => $row['email'],
            'career' => $row['career'],
            'hobbys' => $row['hobbys'],
            'profile_img' => $row['profile_img'],
            'chat' => $row['chat']
           );
        }
        return $contacts; // Return the $contacts array
    }


    public function searchSchool($search)
    {
        $mysqli= $this->database;
        $param= '%'.$search.'%';
        // $query = "SELECT * FROM school WHERE title_ LIKE '{$param}' ";
        $query="SELECT * FROM school S 
						Left JOIN provinces P ON S. location_province = P. provincecode
						Left JOIN districts D ON S. location_districts = D. districtcode
						Left JOIN sectors T ON S. location_Sector = T. sectorcode
						Left JOIN cells C ON S. location_cell = C. codecell
						Left JOIN vilages V ON S. location_village = V. CodeVillage
	    WHERE title_ LIKE '{$param}' ";

        $result= $mysqli->query($query);
        $contacts = array();
        while ($row= $result->fetch_array()) {
            $contacts[] = $row;
        }
        return $contacts; // Return the $contacts array
    }

    public function userProfile($user_id)
    {
        $user= $this->userData($user_id);
    ?>
       <div class="info-box mb-3">
                    <div class="info-inner message-color">
                        <div class="info-in-head">
                            <!-- PROFILE-COVER-IMAGE -->
                             <?php if (!empty($user['cover_img'])) {?>
                              <img src="<?php echo BASE_URL_LINK ;?>image/users_cover_profile/<?php echo $user['cover_img'] ;?>" alt="User Image">
                              <?php  }else{ ?>
                                <img src="<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>"  alt="User Image">
                              <?php } ?>
                        </div>
                        <!-- info in head end -->
                        <div class="info-in-body">
                            <div class="in-b-box">
                                <div class="in-b-img">
                                    <!-- PROFILE-IMAGE -->
                                     <?php if (!empty($user['profile_img'])) {?>
                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>"  alt="User Image">
                                      <?php  }else{ ?>
                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                      <?php } ?>
                                </div>
                            </div><!--  in b box end-->
                            <div class="info-body-name">
                                <div class="in-b-name">
                                    <div><a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo $user['username'] ;?></a></div> <!-- Nina Mcintire -->
                                    <span><small><a href="<?php echo BASE_URL_PUBLIC.$user['username'] ;?>"><?php echo (!empty($user['career']))? $user['career']: 'Member';?></a></small></span>
                                </div><!-- in b name end-->
                            </div><!-- info body name end-->
                        </div><!-- info in body end-->
                        <div class="info-in-footer">
                            <div class="number-wrapper">
                                <div class="num-box">
                                    <div class="num-head">
                                            <a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.posts' ;?>"> POSTS</a>
                                    </div>
                                    <div class="num-body">
                                       <?php echo $this->countsPosts($user_id);?>
                                    </div>
                                </div>
                                <div class="num-box">
                                    <div class="num-head">
                                          <a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.following' ;?>"> FOLLOWING</a>
                                    </div>
                                    <div class="num-body">
                                        <span class="count-following"><?php echo $user['following'] ;?></span>
                                    </div>
                                </div>
                                <div class="num-box">
                                    <div class="num-head">
                                          <a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.followers' ;?>">FOLLOWERS</a>
                                    </div>
                                    <div class="num-body">
                                        <span class="count-followers"><?php echo $user['followers'] ;?></span>
                                    </div>
                                </div>
                            </div><!-- mumber wrapper-->
                        </div><!-- info in footer -->
                    </div><!-- info inner end -->
                </div><!-- info box -->
<?php }

     public function uploadImageProfiles($files)
    {
        $mysqli= $this->database;
        $filename= basename($files['name']);
        $fileTmpName= $files['tmp_name'];
        $filesize= $files['size'];
        $error= $files['error'];

        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));
        $allower_ext = array('jpeg','peg','jpg', 'png'); // valid extensions

        if (in_array($fileActualExt,$allower_ext) == true) {
            # code...
             if ($error == 0) {
                 if ($filesize <= 100*1024) {
                     # code...
                     $filename= basename($files['name']);
                     $filenames = (strlen($filename) > 10)? 
                     strtolower(rand(100,1000).substr($filename,0,4).".".$fileActualExt):
                     strtolower(rand(100,1000).$filename);
   		             $fileTmpName = $files['tmp_name'];
                    //  $file_dest= 'uploads/posts/'.$filenames;
                     $file_dest= DOCUMENT_ROOT.'/uploads/posts/'.$filenames;
                     move_uploaded_file($fileTmpName,$file_dest);
                   
                    return substr($file_dest,42);

                 }else {
                      switch ($files['error']) {

                        case 2:
                            exit( $files['name'].' <span style = "color:red";>is too big</span>');
                            break;
                         case 4:
                             exit( $files['name'].' <span style = "color:red";>No file selected</span>');
                            break;
                        default:
                             exit( $files['name'].' <span style = "color:red";>sorry that type of file is not allowed</span>');
                            break;
                       }
                 }
             }

        }else {
                exit( "the extension is not allowed");
        }
    }

    public function uploadPostsImage($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/posts/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            $size  = $file['size'][$key];
            $type  = $file['type'][$key];
            $error = $file['error'][$key];
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            // $fileExt = pathinfo($fileName)['filename'];
            // $fileActualExt = pathinfo($fileName)['extension'];

            // $filenames = $fileName;
            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,100).".".$fileActualExt);
            // $filenames = str_replace($searching,$replace, $fileExt).strtolower(date('Y').'_'.rand(10,100).".".$fileActualExt);

            $valued[] = $filenames;
            $fileSize[] = $size;


            $targetFilePath = $targetDir.$filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(in_array($fileType, $allowTypes)){
                
                // Upload file to server
                $fileTmpName = $file["tmp_name"];

                $allowTypes_img = array('jpg','png','jpeg');
                $fileType_img = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                if(in_array($fileType_img, $allowTypes_img)){
                    # code...
                    // $fileTmp = $this->resize_image($fileTmpName[$key], 500, 500);
                    // $d=move_uploaded_file($fileTmp, $targetFilePath);

                    $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                    move_uploaded_file($fileTmpName[$key], $targetFilePath);
                    // Var_dump($dz);

                }else {
                    # code...
                    move_uploaded_file($fileTmpName[$key], $targetFilePath);
                }

            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        // var_dump($filenamedb);
        // $fileSizex = implode("=", $fileSize);

        return  $filenamedb;

    }

    public function resize_image($file, $width, $height) {

        list($w, $h) = getimagesize($file);
        /* calculate new image size with ratio */
        $ratio = max($width/$w, $height/$h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);
        /* read binary data from image file */
        $imgString = file_get_contents($file);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image,
        0, 0,
        $x, 0,
        $width, $height,
        $w, $h);
        imagejpeg($tmp, $file, 100);
        return $file;
        /* cleanup memory */
        imagedestroy($image);
        imagedestroy($tmp);
    
    }

    public function thumbnail( $img, $source, $dest, $maxw, $maxh ,$type ) {      
        $jpg = $img;
    
        if( $jpg ) {
            list( $width, $height  ) = getimagesize( $jpg ); //$type will return the type of the image
            // $source = imagecreatefromjpeg( $jpg );

            if ($type == 'image/gif')
            {
                // header ('Content-Type: image/gif');
                $source = imagecreatefromgif($jpg);
            }
            elseif ($type == 'image/jpeg')
            {
                // header ('Content-Type: image/jpeg');
                $source  = imagecreatefromjpeg($jpg);
            }
            elseif ($type == 'image/png')
            {
                // header ('Content-Type: image/png');
                $source = imagecreatefrompng($jpg);
            }
        
            if( $maxw >= $width && $maxh >= $height ) {
                $ratio = 1;
            }elseif( $width > $height ) {
                $ratio = $maxw / $width;
            }else {
                $ratio = $maxh / $height;
            }
    
            $thumb_width = round( $width * $ratio ); //get the smaller value from cal # floor()
            $thumb_height = round( $height * $ratio );
    
            $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
            imagecopyresampled( $thumb, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height );
    
            $path = $img;

            if ($type == 'image/gif')
                imagegif ( $thumb, $path, 75);
            elseif ($type == 'image/jpeg')
                imagejpeg ( $thumb, $path, 75);
            elseif ($type == 'image/png')
                imagepng ( $thumb, $path, 9);
        }
        imagedestroy( $thumb );
        imagedestroy( $source );
    }

    public function compress($source, $destination, $quality) {

        $info = getimagesize($source);
    
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
    
        imagejpeg($image, $destination, $quality);
    
        return $destination;
    }

    public function uploadSize($file)
    {
        foreach($file['name'] as $key => $value){
            $size  = $file['size'][$key];
            // $type  = $file['type'][$key];
            // $error = $file['error'][$key];
            $fileSize[] = $size;
        }
        
        # Build the values
        $fileSizex= implode("=", $fileSize);
        return  $fileSizex;
    }

    public function uploadAlbumImage($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/album/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            $size  = $file['size'][$key];
            $type  = $file['type'][$key];
            $error = $file['error'][$key];
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadJobsFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/jobs/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            $size  = $file['size'][$key];
            $type  = $file['type'][$key];
            $error = $file['error'][$key];

            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            //  $filenames = (strlen($fileName) > 10)? 
            //          strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
            //          strtolower(date('Y').'_'.rand(10,100).$fileName);

            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,1000).".".$fileActualExt);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadFundraisingFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/fundraising/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                $dz= $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                Var_dump($dz);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadSaleFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/sale/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,1000).".".$fileActualExt);

            //  $filenames = (strlen($fileName) > 10)? 
            //          strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
            //          strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                
                $dz= $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                Var_dump($dz);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadSaleGurishaFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/sale-gurisha/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadHouseFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/house/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,1000).".".$fileActualExt);

            //  $filenames = (strlen($fileName) > 10)? 
            //          strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
            //          strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                  
                $dz= $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                Var_dump($dz);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadRwandaicymunaraFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/icyamunara/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,1000).".".$fileActualExt);

            //  $filenames = (strlen($fileName) > 10)? 
            //          strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
            //          strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                  
                $dz= $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                Var_dump($dz);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadcarFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/car/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,1000).".".$fileActualExt);

            //  $filenames = (strlen($fileName) > 10)? 
            //          strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
            //          strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                
                $dz= $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                Var_dump($dz);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploaddomesticsFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/domestics/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadfoodFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/food/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadRwandaschoolFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/school/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,1000).".".$fileActualExt);

            //  $filenames = (strlen($fileName) > 10)? 
            //          strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
            //          strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                
                $dz= $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                Var_dump($dz);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadBasketballFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/sports/basketball/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadcrowfundraisingFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/crowfund/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $searching = " ";
            $replace = "_";
            $filenames = str_replace($searching,$replace, $fileExt[0]).strtolower(date('Y').'_'.rand(10,1000).".".$fileActualExt);

            //  $filenames = (strlen($fileName) > 10)? 
            //          strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
            //          strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                $this->thumbnail($fileTmpName[$key],$targetDir,$targetDir, 480, 400 , $file['type'][$key]);
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                
                // var_dump($dz,$fileTmpName[$key],$file['type'][$key]);
                // var_dump($filenames,strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt));
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function uploadComposerFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/emailComposer/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,100).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,100).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;

    }

    public function getTrendshashtag($trend)
    {
        $mysqli= $this->database;
        $param= '%'.$trend.'%';
        // $query = "SELECT * , COUNT(*) AS trendscounts FROM trends WHERE hashtag LIKE '{$param}' GROUP BY hashtag LIMIT 5";
        $query = "SELECT * , COUNT(*) AS trendscounts FROM trends WHERE hashtag LIKE '{$param}' 
        GROUP BY hashtag HAVING COUNT(DISTINCT hashtag)=1";
        $result= $mysqli->query($query);

        $trendshash = array();
        while ($row= $result->fetch_assoc()) {
            $trendshash[] = array(
            'trend_id' => $row['trend_id'],
            'hashtag' => $row['hashtag'],
            'created_on' => $row['created_on'],
           );
        }
        return $trendshash; // Return the $contacts array
        $mysqli->close();
    }

     public function getmention($mention)
    {
        $mysqli= $this->database;
        $param= '%'.$mention.'%';
        $query = "SELECT user_id, username , career, profile_img FROM users WHERE username LIKE '{$param}' OR lastname LIKE '{$param}' GROUP BY username ";
        $result= $mysqli->query($query);
        $trendMention = array();
        while ($row=$result->fetch_assoc()) {
            $trendMention[] = array(
            'user_id' => $row['user_id'],
            'username' => $row['username'],
            'career' => $row['career'],
            'profile_img' => $row['profile_img']
           );
        }
        return $trendMention; // Return the $contacts array
        $mysqli->close();
    }

     public function addTrends($hashtag,$tweet_id)
    {
        $mysqli= $this->database;
        preg_match_all('/#+([a-zA-Z0-9_]+)/i',$hashtag, $matches);
        if ($matches) {
            # code...
            $resuslt= array_values($matches[1]);
        }
        $date= date('Y-m-d H-i-s');
        // CURRENT_TIMESTAMP
        foreach ($resuslt as $trend) {
            # code...
            $query = "INSERT INTO trends (hashtag,created_on,target) VALUES('$trend', '$date','$tweet_id')";
            $mysqli->query($query);
        }
        // var_dump($resuslt);
      
    }

     public function addmention($status,$user_id,$tweet_id)
    {
        $mysqli= $this->database;
        preg_match_all('/@+([a-zA-Z0-9_]+)/i',$status, $matches);
        if ($matches) {
            # code...
            $resuslt= array_values($matches[1]);
        }
        $date= date('Y-m-d H-i-s');
        // CURRENT_TIMESTAMP
        foreach ($resuslt as $username) {
            # code...
            $query = "SELECT * FROM users WHERE username ='$username' ";
            $resul = $mysqli->query($query);
            $data= $resul->fetch_assoc();
        }
        if (!empty($data)) {
            if ($data['user_id'] != $user_id ) {
                Notification::SendNotifications($data['user_id'],$user_id,$tweet_id,'mention');
            }
        }
      
    }

      public function jobsRemoveDiv($tweet)
    { 
        // $tweet= preg_replace('/<[^<]+? >/si','',$tweet);
        //   $tweet= preg_replace('/<(\w+)\b.*? >.*?<\/(\w+)>/','',$tweet);
        //   $tags= array('p','i','h4');
        //   foreach($tags as $tag){
        //        $tweet= preg_replace('/<(\w+)\b.*? >.*?<\/(\w+)>/','',$tweet);
        //   }
        // $tweet= preg_replace('/[\r\n\t]+/','',$tweet);
        $tweet= strip_tags($tweet);
        $tweet= trim($tweet);
        return  $tweet;
    }

      public function getTweetLink($tweet)

      {
        $tweet= preg_replace('/(http:\/\/)([\w+.])([\w.]+)/','<a  style="color:green;" href="$0" target="_blink">$0</a>',$tweet);
        $tweet= preg_replace('/(https:\/\/)([\w+.])([\w.]+)/','<a  style="color:green;" href="$0" target="_blink">$0</a>',$tweet);
        // $tweet= preg_replace('/(https:\/\/)([\w+.])([\w.]+)/','<a style="color:green;" href="$0" target="_blink">$0</a>',$tweet);
        $tweet= preg_replace('/#([\w]+)/','<a style="color:green;" href="'.BASE_URL_PUBLIC.'$1.hashtag" >$0</a>',$tweet);
        $tweet= preg_replace('/@([\w]+)/','<a style="color:green;" href="'.BASE_URL_PUBLIC.'$1">$0</a>',$tweet);
        $search = '/((https:\/\/)www\.youtube\.com\/embed\/\w+)/';
        $tweet= preg_replace($search,'<section class="content iframe-container">
                                            <iframe width="500" height="280" src="$0" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                            </iframe>
                                            </section>',$tweet);
        $search0 = '/((https:\/\/)www\.youtube\.com\/watch\?v=\w+)/';
        $tweet= preg_replace($search0,'<a style="color:green;" href="$0" target="_blink">$0</a>',$tweet);
        // $search0 = '/((https:\/\/)www\.youtube\.com\/watch\?v=\w+)/';
        // $tweet= preg_replace($search0,'<section class="content iframe-container">
        //                                     <iframe width="500" height="280" src="$0" frameborder="0"
        //                                         allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        //                                     </iframe>
        //                                     </section>',$tweet);
                                          
        return  htmlspecialchars_decode($tweet);
        // var_dump($tweet);

    }

     public function addLike($user_id,$tweet_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE tweets SET likes_counts = likes_counts +1 WHERE tweet_id= $tweet_id ";
        $mysqli->query($query);
        $this->creates('likes',array('like_by' => $user_id ,'like_on' => $tweet_id));
        if ($get_id != $user_id) {
            Notification::SendNotifications($get_id,$user_id,$tweet_id,'likes');
        }
    }

      public function unLike( $user_id,$tweet_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE tweets SET likes_counts = likes_counts -1 WHERE tweet_id= $tweet_id ";
        $mysqli->query($query);

        $query= "DELETE FROM likes WHERE like_by = $user_id AND like_on = $tweet_id";
        $mysqli->query($query);

    }

      public function likes($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM likes WHERE like_by = $user_id AND like_on = $tweet_id";
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

     public function getPopupTweet($user_id,$tweet_id,$tweet_by)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM tweets, users WHERE tweet_id = $tweet_id AND tweetBy = user_id";
        $result= $mysqli->query($query);
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

     public function getPopupDeleteComPost($comment_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM comment, users WHERE comment_id = $comment_id AND comment_by = user_id";
        $result= $mysqli->query($query);
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

    public function retweet($retweet_id,$user_id,$tweet_by,$comments)
    {
        $mysqli= $this->database;
        $stmt = $mysqli->stmt_init();
        $query= "UPDATE tweets SET retweet_counts = retweet_counts +1  WHERE tweet_id= ? ";
        $stmt->prepare($query);
        $stmt->bind_param('i',$retweet_id);
        $stmt->execute();

        $query= "INSERT INTO tweets (status,title_name,photo_Title_main,photo_Title, tweetBy, retweet_id, retweet_by,donation_payment, tweet_image,tweet_image_size, likes_counts, retweet_counts, posted_on, retweet_Msg) 
        SELECT status,title_name,photo_Title_main,photo_Title, tweetBy, ?, ?,donation_payment, tweet_image,tweet_image_size, likes_counts, retweet_counts, ? , ?  FROM tweets WHERE tweet_id= ? ";
        $stmt->prepare($query);
        $time = date('Y-m-d H-i-s');
        $stmt->bind_param('iissi', $retweet_id, $user_id,$time,$comments, $retweet_id);
        $stmt->execute();  
        $query= "DELETE FROM tweets WHERE tweet_id= ?";
        $stmt->prepare($query);
        $stmt->bind_param('i',$stmt->insert_id);

        if ($retweet_id != $user_id) {
            // var_dump($tweet_by,$user_id, $retweet_id,'retweet');
            Notification::SendNotifications($tweet_by,$user_id,$retweet_id,'retweet');
            // var_dump(Notification::SendNotifications($tweet_by,$user_id,$retweet_id,'retweet'));
        }
        
        return $stmt->execute();
    }

     public function checkRetweet($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="SELECT * FROM tweets WHERE retweet_id= '$tweet_id'  AND retweet_by= '$user_id' OR tweet_id= '$tweet_id' AND retweet_by= '$user_id' ";
        $result= $mysqli->query($query);
        $CountRetweet= array();
        while ($row= $result->fetch_array()) {
             $CountRetweet[] = $row;
        }
        
        foreach ($CountRetweet as $countsRetweet) {
            # code...
            return $countsRetweet; // Return the $contacts array
        }

    }

    public function delete($table,$array)
    {
        $mysqli= $this->database;
        $query= "DELETE FROM $table";
        $where= " WHERE"; 
        foreach ($array as $name => $value) {
            # code...
             $query .= "{$where} {$name} = {$value}";
             $where= " AND"; 
        }

        $row= $mysqli->query($query);

        // if($row){
        //         exit('<div class="alert alert-success alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>SUCCESS</strong> </div>');
        //     }else{
        //         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>Fail to delete !!!</strong>
        //         </div>');
        // }

    }

    public function countsPosts($user_id)
    {
        $mysqli= $this->database;
        $query= "SELECT COUNT('tweet_id') AS TotalPosts FROM tweets WHERE tweetBy = $user_id AND retweet_id = 0 OR retweet_by= $user_id";
        $sql =$mysqli->query($query);
        $row = $sql->fetch_array();
        $total= array_shift($row);
        $array= array(0,$total);
        $totals= array_sum($array);
        return $totals;
    }

    static public function countsPostss($user_id)
    {
        $mysqli= self::$databases;
        $query= "SELECT COUNT('tweet_id') AS TotalPosts FROM tweets WHERE tweetBy = $user_id AND retweet_id = 0 OR retweet_by= $user_id";
        $sql =$mysqli->query($query);
        $row = $sql->fetch_array();
        $total= array_shift($row);
        $array= array(0,$total);
        $totals= array_sum($array);
        return $totals;
    }

     public function countsLike($user_id)
    {
        $mysqli= $this->database;
        $query= "SELECT COUNT('like_id') AS TotalLikes FROM likes WHERE like_by = $user_id";
        $sql =$mysqli->query($query);
        $row = $sql->fetch_array();
        $total= array_shift($row);
        $array= array(0,$total);
        $totals= array_sum($array);
        return $totals;
    }

    public function albumPhoto($user_id)
    { 
            $mysqli= $this->database;
            $rowx=[];
            $query= $mysqli->query("SELECT * FROM album WHERE target = $user_id AND album_id= album_id ORDER BY created_on Desc");
            while ($rows = $query->fetch_assoc()) {
                # code...
                $rowx[] = $rows;
            }
             $i = 0;
             $file='';
            foreach($rowx as $key => $value){
                $pre = ($i > 0)?'=':'';
                $file .= $pre.$rowx[$key]['album_image'];
                $i++;
            }

            $expode = explode("=",$file);
            $fileActualExt= array();
            for ($i=0; $i < count($expode); ++$i) { 
                $fileActualExt[]= strtolower(substr($expode[$i],-3));
               }
            
            $fileActualExt[]= 'docx';
            $fileActualExt[]= 'xlsx';
            $allower_ext = array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip'); // valid extensions
        
        if (array_diff($fileActualExt,$allower_ext) == false) { ?>
            <div class="row mb-1">
        <?php   for ($i=0; $i < count($expode); ++$i) { 

            if(pathinfo($expode[$i])['extension'] == 'jpg' || pathinfo($expode[$i])['extension'] == 'jpeg'|| pathinfo($expode[$i])['extension'] == 'png') { 
             ?>
               <div class="col-3 more">
                   <img class="img-fluid imagePopup"
                       src="<?php echo BASE_URL_PUBLIC."uploads/album/".$expode[$i] ;?>"
                       alt="Photo"  data-album="<?php echo $rowx[0]['album_id'] ;?>">
               </div>

         <?php }else if(pathinfo($expode[$i])['extension'] == 'docx'|| pathinfo($expode[$i])['extension'] == 'xls'||
                pathinfo($expode[$i])['extension'] == 'doc'|| pathinfo($expode[$i])['extension'] == 'xlsx') { ?>
             <div class="col-3 more">
                 <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                  <div class="mailbox-attachment-info main-active">
                     <a class='colorlightLINK' href="<?php echo BASE_URL_PUBLIC."uploads/album/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                        <?php  echo pathinfo($expode[$i])['basename'] ;?></a>
                     <span class="mailbox-attachment-size colorlightLINK">
                         1,245 KB
                         <a href="#" class="btn btn-default btn-sm "><i
                                 class="fa fa-cloud-download"></i></a>
                     </span>
                 </div>
             </div>
        <?php }else if(pathinfo($expode[$i])['extension'] == 'pdf' ) { ?>
        <div class="col-3 more">
           <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
           <div class="mailbox-attachment-info main-active">
               <a class='colorlightLINK' href="<?php echo BASE_URL_PUBLIC."uploads/album/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                   <?php  echo pathinfo($expode[$i])['basename'] ;?></a>
               <span class="mailbox-attachment-size colorlightLINK">
                   1,245 KB
                   <a href="#" class="btn btn-default btn-sm float-right "><i class="fa fa-cloud-download"></i></a>
               </span>
           </div>
        </div>
        <?php } } ?>
        </div>
      <?php  }  
    } 

    public function albumPhotoTimeline($user_id)
    { 
            $mysqli= $this->database;
            $query= $mysqli->query("SELECT * FROM album WHERE target = $user_id AND album_id= album_id ORDER BY created_on Desc");
            ?>
            <ul class="timeline timeline-inverse">
            <?php while ($row = $query->fetch_assoc()) {
            ?>
            <?php 
                $file = $row['album_image'];
                $expode = explode("=",$file);
                $fileActualExt= array();
                for ($i=0; $i < count($expode); ++$i) { 
                    $fileActualExt[]= strtolower(substr($expode[$i],-3));
                }
                $allower_ext = array('peg','jpeg', 'jpg', 'png','pdf' , 'doc','docx','ocx', 'lsx','xlsx','xls','zip'); // valid extensions
                                
                if (array_diff($fileActualExt,$allower_ext) == false) { ?>

            <li class="time-label">
                <span class="bg-success text-light" style="position: absolute;left: 10px;"><?php echo $this->timeAgo($row['created_on']); ?></span>
                <?php
                $docx= array('jpg','jpeg','peg','png','gif','pdf');
                $pdf= array('jpg','jpeg','peg','png','gif');
                $image= array('pdf','doc','ocx','lsx'); ?>

                <?php if(array_diff($fileActualExt,$image)) { ?>
                        <i class="fa fa-photo bg-primary text-light" style="top:50px;"></i>
                <?php }
                if (array_diff($fileActualExt,$pdf)) { ?>
                        <i class="fa fa-file-pdf-o bg-primary text-light" style="top:50px;"></i>
                <?php }
                if (array_diff($fileActualExt,$docx)) { ?>
                        <i class="fa fa-file-word-o bg-primary text-light" style="top:50px;"></i>
                <?php } ?>

            <ul class="timeline-item mailbox-attachments clearfix list-inline mb-2">

                   <?php  for ($i=0; $i < count($expode); ++$i) { ?>

                             <li  class="list-inline-item">

                       <?php if(pathinfo($expode[$i])['extension'] == 'docx'|| pathinfo($expode[$i])['extension'] == 'xls'||
                                pathinfo($expode[$i])['extension'] == 'doc'|| pathinfo($expode[$i])['extension'] == 'xlsx') { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                  <div class="mailbox-attachment-info main-active">
                                     <a class="colorlightLINK" href="<?php echo BASE_URL_PUBLIC."uploads/album/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        <?php  echo pathinfo($expode[$i])['basename'] ;?></a>
                                     <span class="mailbox-attachment-size colorlightLINK">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>


                    <?php }else if(pathinfo($expode[$i])['extension'] == 'pdf' ) { ?>

                                 <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                 <div class="mailbox-attachment-info main-active">
                                     <a class="colorlightLINK" href="<?php echo BASE_URL_PUBLIC."uploads/album/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                         <?php  echo pathinfo($expode[$i])['basename'] ;?></a>
                                     <span class="mailbox-attachment-size colorlightLINK">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>

                     <?php }else if(pathinfo($expode[$i])['extension'] == 'jpg' || pathinfo($expode[$i])['extension'] == 'jpeg'|| pathinfo($expode[$i])['extension'] == 'png') { ?>

                                  <span class="mailbox-attachment-icon has-img"><img 
                                    src="<?php echo BASE_URL_PUBLIC."uploads/album/".pathinfo($expode[$i])['basename'] ;?>" ></span>
                                
                                 <div class="mailbox-attachment-info main-active">
                                     <a class="colorlightLINK" href="<?php echo BASE_URL_PUBLIC."uploads/album/".pathinfo($expode[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($expode[$i])['basename'] ;?></a>
                                     <span class="mailbox-attachment-size colorlightLINK">
                                         1,245 KB
                                         <a href="#" class="btn btn-default btn-sm float-right"><i
                                                 class="fa fa-cloud-download"></i></a>
                                     </span>
                                 </div>
                     <?php } ?>
                          </li>
                    <?php }  ?>

                </ul>
                <hr class="main-active" style="width:80%" >
                </li> <!-- END timeline item -->
                    <?php } 
               } ?>
                <li >
                    <i class="fa fa-clock-o bg-info text-light"></i>
                </li>
            </ul>
  <?php  }

}
$home= new Home();
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