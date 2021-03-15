<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Car extends Icyamunara {

     public function carList($categories,$pages,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*10)-10;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM car H
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
        WHERE H. categories_car ='$categories' ORDER BY rand(), H. created_on3 Desc Limit $showpages,10");
        ?>
        <div class="card card-primary mb-3 ">
         <div class="card-header main-active p-1">
            <!-- <form class="form-inline float-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <input type="text" class="form-control search0"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                </div>
            </form> -->
            <h5 class="card-title text-center"><i> Car to Search</i></h5>

            <div class="nav-scroller  py-0" style="clear:right;height:2rem;">
                <nav class="nav d-flex justify-content-between pb-0">
                <a class="p-2" href="javascript:void(0)" onclick="carCategories('car_For_sale',1,<?php echo $user_id ; ?>);">Car For sale<span class="badge badge-primary"><?php echo $this->carcountPOSTS('car_For_sale');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="carCategories('car_For_rent',1,<?php echo $user_id ; ?>);">Car For rent<span class="badge badge-primary"><?php echo $this->carcountPOSTS('car_For_rent');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="carCategories('camion_For_sale',1,<?php echo $user_id ; ?>);">Camion For sale<span class="badge badge-primary"><?php echo $this->carcountPOSTS('camion_For_sale');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="carCategories('motor_For_sale',1,<?php echo $user_id ; ?>);">Motor-cyle<span class="badge badge-primary"><?php echo $this->carcountPOSTS('motor_For_sale');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="carCategories('bicycle_For_sale',1,<?php echo $user_id ; ?>);">Bicycle For sale<span class="badge badge-primary"><?php echo $this->carcountPOSTS('bicycle_For_sale');?></span></a>
                </nav>
            </div> <!-- nav-scroller -->
        </div> <!-- card-header -->

        <div class="card-body">
        <span class="job-show"></span>
        <div class="job-hide">
        
        <?php 
            if ($query->num_rows > 0) { ?>

            <ul class="timeline timeline-inverse">  
                <li class="time-label" style="margin-bottom: 0px;">
                        <span style="margin-left: -10px;"> <img src="<?php echo BASE_URL_LINK.'image/banner/discount.png' ;?>" width="80px"> </span>
                      
                        <?php echo $this->bannerPublishcar($categories); ?>
                </li>
                <?php while($car= $query->fetch_array()) { ?>
                
                    <li class="time-label">
                        <?php echo $this->buychangesColor($car['buy']); ?>
                        
                         <?php if($car['discount'] != 0){ ?>
                            <?php echo $this->PercentageDiscount($car['discount']); ?>
                        <?php }else {  echo '';?>
                            <!-- <span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> 0% </span>  -->
                        <?php } ?>

                        <div class="timeline-item card flex-md-row shadow-sm h-md-100 border-0">
                        <!-- <img class="card-img-left flex-auto d-none d-lg-block" height="100px" width="100px" src="< ?php echo BASE_URL_PUBLIC.'uploads/car/'.$car['photo'] ;?>" alt="Card image cap"> -->
                        <div class='col-md-4 px-0 card-img-left more' id="car-readmore" data-car="<?php echo $car['car_id']; ?>">
                            <!-- <div class='card-img-left' style="background: url('< ?php echo BASE_URL_PUBLIC.'uploads/car/'.$car['photo']; ?>')no-repeat;background-size:contain;"> -->
                            <!-- height:100px;width:100px -->
                            <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC.'uploads/car/'.$car['photo']; ?>">
                            
                        <!-- banner -->
                         <?php echo $this->bannerDiscount($car['banner']); ?>
                         <!-- banner -->
                          
                        </div>
                        <div class="col-md-8 card-body pt-0">
                        <span id="response<?php echo $car['car_id']; ?>"></span>
                           <div class="text-primary mb-0">
                              <a class="text-primary float-left" href="javascript:void(0)" id="car-readmore" data-car="<?php echo $car['car_id']; ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <!-- < ?php echo $house['provincename']; ?> /  -->
                                <?php echo $car['namedistrict']; ?> / 
                                <?php echo $car['namesector']; ?> /
                                <?php echo $car['nameCell']; ?> 
                                <!-- < ?php echo $house['nameCell']; ?> Cell  -->
                               
                               </a>
                                <!-- delete -->

                                <?php
                                if(isset($_SESSION['key']) && $user_id == $car['user_id3'] ){ 
                                    
                                    echo $this->EditdeletePostcar($user_id,$car['user_id3'],$car); 
                                    
                                } ?>
                                <!-- delete -->

                               <span class="float-right"> <?php if($car['price_discount'] != 0){ ?><span class="mr-2 text-danger " style="text-decoration: line-through;"><?php echo number_format($car['price_discount']); ?> Frw</span> <?php } ?><span class="text-primary" > <?php echo number_format($car['price']); ?> Frw</span></span>
                            </div> 
                            <div class="text-muted clear-float">
                                <span class="float-left"><i class="fa fa-car" aria-hidden="true"></i>  
                                <?php 
                                        $subect = $categories;
                                        $replace = " ";
                                        $searching = "_";
                                        echo str_replace($searching,$replace, $subect);
                                        ?>
                                <!-- < ?php echo $categories; ?> -->
                                </span>
                                <span class="float-right mr-5"><i class="fa fa-heart" aria-hidden="true"></i></span></div>
                            <div class="text-muted clear-float">
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> Created on <?php echo $this->timeAgo($car['created_on3'])." By ".$car['authors']; ?></span>
                            </div>
                            <p class="card-text clear-float">
                                <?php if (strlen($car["text"]) > 98) {
                                            echo $car["text"] = substr($car["text"],0,98).'...
                                            <span class="mb-0"><a href="javascript:void(0)" id="car-readmore" data-car="'.$car['car_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">Read more...</a></span>';
                                            }else{
                                            echo $car["text"];
                                            } ?> 
                                <!-- 200 m square feet Garden,4 bedroom,2 bathroom, kitchen and cabinet, car parking dapibuseget quame... Continue reading...  -->
                            </p>

                        </div><!-- card-body -->
                        </div><!-- card -->
                    </li>
                    <!-- END timeline item -->
                    <?php }
                    
                   ?>    
                    <li>
                        <i class="fa fa-clock-o bg-info text-light"></i>
                    </li>
                  </ul>
                  <?php }else{
                     echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                                <button class="close" data-dismiss="alert" type="button">
                                    <span>&times;</span>
                                </button>
                                <strong>No Record</strong>
                            </div></div>'; 
                }?>
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

        <?php 
         $query1= $mysqli->query("SELECT COUNT(*) FROM car WHERE categories_car ='$categories' ");
         $row_Paginaion = $query1->fetch_array();
         $total_Paginaion = array_shift($row_Paginaion);
         $post_Perpages = $total_Paginaion/10;
         $post_Perpage = ceil($post_Perpages); 
        
        if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="carCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="carCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="carCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="carCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 
    }

     
      public function carcountPOSTS($categories)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM car WHERE categories_car ='$categories' ");
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }


      public function carReadmore($car_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN car C ON C. user_id3 = U. user_id 
            Left JOIN provinces P ON C. province = P. provincecode
            Left JOIN districts M ON C. districts = M. districtcode
            Left JOIN sectors T ON C. sector = T. sectorcode
            Left JOIN cells L ON C. cell = L. codecell
            Left JOIN vilages V ON C. village = V. CodeVillage 
        WHERE C. car_id = '$car_id' ");
        $row= $query->fetch_array();
        return $row;
    }

     
    public function car_getPopupTweet($user_id,$car_id,$car_user_id)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN car B ON B. user_id3 = U. user_id WHERE B. car_id = $car_id AND B. user_id3 = $car_user_id ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      
    public function deleteLikescar($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE FROM car WHERE car_id = '{$tweet_id}' and user_id3 = '{$user_id}' ";

        $query1="SELECT * FROM car WHERE car_id = $tweet_id and user_id3 = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'].'='.$rows['other_photo'];
            $expodefile = explode("=",$photo);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$photo);
                $uploadDir = DOCUMENT_ROOT.'/uploads/car/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/car/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/car/';
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

    public function update_car($banner,$available,$discount_change,$discount_price,$price,$car_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE car SET banner= '$banner', buy = '$available', discount = $discount_change ,price_discount = $discount_price, price = $price WHERE car_id= $car_id ";
        $mysqli->query($query);

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center" style="font-size:12px;padding:2px;">
                    <button class="close" data-dismiss="alert" type="button" style="top:-6px;">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:12px;padding:2px;">
                    <button class="close" data-dismiss="alert" type="button"  style="top:-6px;">
                        <span>&times;</span>
                    </button>
                    <strong>Fail to Edit !!!</strong>
                </div>');
        }
    }

    public function EditdeletePostcar($user_id,$car_id3,$car){
        
            // $mysqli= $this->database;
            // $query= $mysqli->query("SELECT * FROM car WHERE car_id ='$car_id3'");
            // $car= $query->fetch_array();
            ?>

            <ul class="list-inline ml-2  float-right" style="list-style-type: none;">  

                    <li  class=" list-inline-item">
                        <ul class="showcartButt" style="list-style-type: none; margin:0px;" >
                            <li>
                                <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <ul style="list-style-type: none; margin:0px; margin:0px;width:250px;text-align:center;" >
                                    <li style="list-style-type: none; margin:0px;"> 
                                    <label class="deletecar"  data-car="<?php echo $car["car_id"];?>"  data-user="<?php echo $car["user_id3"];?>">Delete </label>
                                    </li>

                                    <li style="list-style-type: none; margin:0px;"> 
                                    <label for="">
                                    <div class="form-row">
                                        <div class="col">
                                                Banner
                                                <div class="input-group">
                                                      <select class="form-control" name="banner" id="banner<?php echo $car["car_id"];?>">
                                                        <option value="<?php echo $car['banner']; ?>" selected><?php echo $car['banner']; ?></option>
                                                        <option value="new">New</option>
                                                        <option value="new_arrival">New arrival</option>
                                                        <option value="great_deal">Great deal</option>
                                                        <option value="empty">empty</option>
                                                      </select>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >banner</span>
                                                    </div>
                                                </div> <!-- input-group -->
                                        </div>
                                    </div>
                                    </label>
                                    </li>

                                  <li style="list-style-type: none; margin:0px;"> 
                                    <label for="">
                                    <div class="form-row">
                                        <div class="col">
                                                Sale
                                                <div class="input-group">
                                                      <select class="form-control" name="available" id="available<?php echo $car["car_id"];?>">
                                                      <?php if ($car['buy'] == 'available') { ?>
                                                        <option value="available" selected>Available</option>
                                                        <option value="sold">Sold</option>
                                                        <option value="empty">empty</option>
                                                      <?php }else { ?>
                                                        <option value="sold" selected>Sold</option>
                                                        <option value="available">Available</option>
                                                        <option value="empty">empty</option>
                                                      <?php } ?>
                                                      </select>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >sale</span>
                                                    </div>
                                                </div> <!-- input-group -->
                                            </label>
                                        </div>
                                        <div class="col">
                                            discount %
                                            <div class="input-group">
                                                <input  type="number" class="form-control form-control-sm" name="discount_change" id="discount_change<?php echo $car["car_id"];?>" value="<?php echo $car["discount"];?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >%</span>
                                                </div>
                                            </div> <!-- input-group -->
                                        </div>
                                    </div>
                                    </label>
                                    </li>
                                    
                                    <li style="list-style-type: none;"> 
                                    <label for="discount">
                                    <div class="form-row">
                                        <div class="col">
                                            discount price
                                            <div class="input-group">
                                                <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price<?php echo $car["car_id"];?>" value="<?php echo $car["price_discount"];?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1">$</span>
                                                </div>
                                            </div> <!-- input-group -->
                                        </div>
                                        <div class="col">
                                                Price
                                            <div class="col">
                                                </div>
                                            <div class="input-group">
                                                <input  type="number" class="form-control form-control-sm" name="price" id="price<?php echo $car["car_id"];?>" value="<?php echo $car["price"];?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0px 10px;"
                                                        aria-label="Username" aria-describedby="basic-addon1" >$</span>
                                                </div>
                                            </div> <!-- input-group -->
                                        </div>
                                    </div>
                                    </label>
                                    </li>

                                    <li style="list-style-type: none;"> 
                                    <label for="discount" class="update-car-btn" data-car="<?php echo $car["car_id"];?>" data-user="<?php echo $car["user_id3"];?>">submit</label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
            </ul>
        <?php 

    }

    public function carData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM car WHERE user_id3 ='$user_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function carListActivities($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM car H
        Left JOIN provinces P ON H. province = P. provincecode
        Left JOIN districts M ON H. districts = M. districtcode
        Left JOIN sectors T ON H. sector = T. sectorcode
        Left JOIN cells C ON H. cell = C. codecell
        Left JOIN vilages V ON H. village = V. CodeVillage 
        
        WHERE H. user_id3 ='$user_id' ORDER BY H. created_on3 Desc");
        
        $categories = "car_For_sale"; ?>
        <div class="card card-primary mb-3 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title text-center"><i> Car </i></h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
          <ul class="timeline timeline-inverse">  
                <li class="time-label" style="margin-bottom: 0px;">
                        <span style="margin-left: -10px;"> <img src="<?php echo BASE_URL_LINK.'image/banner/discount.png' ;?>" width="80px"> </span>
                      
                        <?php echo $this->bannerPublishcar('car_For_sale'); ?>
                </li>
          <?php while($car= $query->fetch_array()) { ?>
                    <li class="time-label">
                        <?php echo $this->buychangesColor($car['buy']); ?>
                        
                         <?php if($car['discount'] != 0){ ?>
                            <?php echo $this->PercentageDiscount($car['discount']); ?>
                        <?php }else {  echo '';?>
                            <!-- <span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> 0% </span>  -->
                        <?php } ?>

                        <div class="timeline-item card flex-md-row shadow-sm h-md-100 border-0">
                        <!-- <img class="card-img-left flex-auto d-none d-lg-block" height="100px" width="100px" src="< ?php echo BASE_URL_PUBLIC.'uploads/car/'.$car['photo'] ;?>" alt="Card image cap"> -->
                        <div class='col-md-4 px-0 card-img-left' >
                            <!-- <div class='card-img-left' style="background: url('< ?php echo BASE_URL_PUBLIC.'uploads/car/'.$car['photo']; ?>')no-repeat;background-size:contain;"> -->
                            <!-- height:100px;width:100px -->
                            <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC.'uploads/car/'.$car['photo']; ?>">
                            
                        <!-- banner -->
                         <?php echo $this->bannerDiscount($car['banner']); ?>
                         <!-- banner -->
                          
                        </div>
                        <div class="col-md-8 card-body pt-0">
                        <span id="response<?php echo $car['car_id']; ?>"></span>
                           <div class="text-primary mb-0">
                              <a class="text-primary float-left" href="javascript:void(0)" id="car-readmore" data-car="<?php echo $car['car_id']; ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <!-- < ?php echo $house['provincename']; ?> /  -->
                                <?php echo $car['namedistrict']; ?> / 
                                <?php echo $car['namesector']; ?>
                                <!-- < ?php echo $house['nameCell']; ?> Cell  -->
                               
                               </a>
                                <!-- delete -->
                                <?php
                                if(isset($_SESSION['key']) && $user_id == $car['user_id3'] ){ 
                                    
                                    echo $this->EditdeletePostcar($user_id,$car['user_id3'],$car); 
                                    
                                } ?>
                                <!-- delete -->

                               <span class="float-right"> <?php if($car['price_discount'] != 0){ ?><span class="mr-2 text-danger " style="text-decoration: line-through;"><?php echo number_format($car['price_discount']); ?> Frw</span> <?php } ?><span class="text-primary" > <?php echo number_format($car['price']); ?> Frw</span></span>
                            </div> 
                            <div class="text-muted clear-float">
                                <span class="float-left"><i class="fa fa-car" aria-hidden="true"></i>  
                                <?php 
                                        $subect = $car['categories_car'];
                                        $replace = " ";
                                        $searching = "_";
                                        echo str_replace($searching,$replace, $subect);
                                        ?>
                                <!-- < ?php echo $categories; ?> -->
                                </span>
                                <span class="float-right mr-5"><i class="fa fa-heart" aria-hidden="true"></i></span></div>
                            <div class="text-muted clear-float">
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> Created on <?php echo $this->timeAgo($car['created_on3'])." By ".$car['authors']; ?></span>
                            </div>
                            <p class="card-text clear-float">
                                <?php if (strlen($car["text"]) > 98) {
                                            echo $car["text"] = substr($car["text"],0,98).'...
                                            <span class="mb-0"><a href="javascript:void(0)" id="car-readmore" data-car="'.$car['car_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">Read more...</a></span>';
                                            }else{
                                            echo $car["text"];
                                            } ?> 
                                <!-- 200 m square feet Garden,4 bedroom,2 bathroom, kitchen and cabinet, car parking dapibuseget quame... Continue reading...  -->
                            </p>

                        </div><!-- card-body -->
                        </div><!-- card -->
                    </li>
                    <!-- END timeline item -->
                    <?php }
                    
                    ?>    
                    <li>
                        <i class="fa fa-clock-o bg-info text-light"></i>
                    </li>
                  </ul>
            </div> <!-- row -->
           </div> <!-- card-body -->
        </div> <!-- card -->
     
    <?php }



}

$car = new Car();
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