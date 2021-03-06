<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 } 

class Icyamunara extends House {

     public function icyamunaraList($pages,$user_id)
    {
  $pages= $pages;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*10)-10;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM icyamunara H
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
         ORDER BY rand(), H. created_on3 Desc Limit $showpages,10");
        //  ORDER BY H. buy='sold' ,rand() Desc Limit $showpages,10");
        ?>
        <div class="card card-primary mb-3 ">
         <div class="card-header main-active p-1">
            <h5 class="card-title text-center"><i> icyamunara to Search</i></h5>
        </div> <!-- card-header -->

        <div class="card-body">
        <span class="job-show"></span>
        <div class="job-hide">
         
        <?php 
            if ($query->num_rows > 0) { ?>

            <ul class="timeline timeline-inverse">  
               <li class="time-label" style="margin-bottom: 0px;">
                        <span style="margin-left: -10px;"> <img src="<?php echo BASE_URL_LINK.'image/banner/discount.png' ;?>" width="80px"> </span>
                        <?php 
                                    //   <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                echo '<img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                            ';
                        ?>
                </li>
                <?php while($icyamunara= $query->fetch_array()) { ?>
                    <li class="time-label">
                        <?php echo $this->buychangesColor($icyamunara['buy']); ?>
                     
                         <?php if($icyamunara['discount'] != 0){ ?>
                            <?php echo $this->PercentageDiscount($icyamunara['discount']); ?>
                        <?php }else { echo ''; ?>
                            <!-- <span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> 0% </span>  -->
                        <?php } ?>

                        <div class="timeline-item card flex-md-row shadow-sm h-md-100 border-0">
                        <!-- <img class="card-img-left flex-auto d-none d-lg-block" height="100px" width="100px" src="< ?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$icyamunara['photo'] ;?>" alt="Card image cap"> -->
                        <div class='col-md-4 px-0 card-img-left more' id="icyamunara-readmore" data-icyamunara="<?php echo $icyamunara['house_id']; ?>" >
                        <!-- <div class='card-img-left' style="background: url('< ?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$icyamunara['photo']; ?>')no-repeat;background-size:cover;"> -->
                            <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$icyamunara['photo']; ?>">
                        
                            <?php echo $this->bannerDiscount($icyamunara['banner']); ?>
                        </div>
                        <div class="col-md-8 card-body pt-0">
                        <span id="response<?php echo $icyamunara['house_id']; ?>"></span>
                           <div class="text-primary mb-0">
                              <a class="text-primary float-left" href="javascript:void(0)" id="icyamunara-readmore" data-icyamunara="<?php echo $icyamunara['house_id']; ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <!-- < ?php echo $icyamunara['provincename']; ?> /  -->
                                <?php echo $icyamunara['namedistrict']; ?> / 
                                <?php echo $icyamunara['namesector']; ?> 
                                <!-- < ?php echo $icyamunara['nameCell']; ?> Cell  -->
                               </a>
                                
                                <?php if(isset($_SESSION['key']) && $user_id == $icyamunara['user_id3']){ ?>
                                    <ul class="list-inline ml-2  float-right" style="list-style-type: none;">  

                                            <li  class=" list-inline-item">
                                                <ul class="showcartButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px; margin:0px;width:250px;text-align:center;" >
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label class="delete-cyamunara"  data-cyamunara="<?php echo $icyamunara["house_id"];?>"  data-user="<?php echo $icyamunara["user_id3"];?>">Delete </label>
                                                            </li>

                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label for="">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                        Banner
                                                                        <div class="input-group">
                                                                              <select class="form-control" name="banner" id="banner<?php echo $icyamunara["house_id"];?>">
                                                                                <option value="<?php echo $icyamunara['banner']; ?>" selected><?php echo $icyamunara['banner']; ?></option>
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
                                                                              <select class="form-control" name="available" id="available<?php echo $icyamunara["house_id"];?>">
                                                                              <?php if ($icyamunara['buy'] == 'available') { ?>
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
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_change" id="discount_change<?php echo $icyamunara["house_id"];?>" value="<?php echo $icyamunara["discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price<?php echo $icyamunara["house_id"];?>" value="<?php echo $icyamunara["price_discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="price" id="price<?php echo $icyamunara["house_id"];?>" value="<?php echo $icyamunara["price"];?>">
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
                                                            <label for="discount" class="update-cyamunara-btn" data-cyamunara="<?php echo $icyamunara["house_id"];?>" data-user="<?php echo $icyamunara["user_id3"];?>">submit</label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                    </ul>
                                <?php } ?>
                                <span class="float-right"> 
                                     <?php if($icyamunara['discount'] != 0){ ?><span class="mr-2 text-danger " style="text-decoration: line-through;"><?php echo number_format($icyamunara['price_discount']); ?> Frw</span> <?php } ?><span class="text-primary" > <?php echo number_format($icyamunara['price']); ?> Frw</span>
                               </span>
                               <!-- <span class="float-right"> < ?php echo $icyamunara['price']; ?> Frw</span> -->
                            </div> 
                            <div class="text-muted clear-float">
                                <span class="float-left"><i class="fa fa-home" aria-hidden="true"></i>icyamunara</span>
                                <span class="float-right mr-5"><i class="fa fa-heart" aria-hidden="true"></i></span></div>
                            <div class="text-muted clear-float">
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> Created on <?php echo $this->timeAgo($icyamunara['created_on3'])." By ".$icyamunara['authors']; ?></span>
                            </div>
                            <p class="card-text clear-float">
                                <?php if (strlen($icyamunara["text"]) > 98) {
                                            echo $icyamunara["text"] = substr($icyamunara["text"],0,98).'...
                                            <span class="mb-0"><a href="javascript:void(0)" id="icyamunara-readmore" data-icyamunara="'.$icyamunara['house_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">Read more...</a></span>';
                                            }else{
                                            echo $icyamunara["text"];
                                            } ?> 
                                <!-- 200 m square feet Garden,4 bedroom,2 bathroom, kitchen and cabinet, car parking dapibuseget quame... Continue reading...  -->
                            </p>

                        </div><!-- card-body -->
                        </div><!-- card -->
                    </li>
                    <!-- END timeline item -->
                    <?php } ?>    
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
                } ?>
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

        <?php
                    
        $query1= $mysqli->query("SELECT COUNT(*) FROM icyamunara  ");
        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/10;
        $post_Perpage = ceil($post_Perpages); 

        if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="icyamunaraCategories(<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="icyamunaraCategories(<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="icyamunaraCategories(<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="icyamunaraCategories(<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 
    }
    
      public function icyamunaraReadmore($house_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN icyamunara H ON H. user_id3 = U. user_id 
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
        WHERE H. house_id = '$house_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    
    public function cyamunara_getPopupTweet($user_id,$house_id,$house_user_id)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN icyamunara H ON H. user_id3 = U. user_id
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
         WHERE H. house_id = $house_id AND H. user_id3 = $house_user_id ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      
    public function deleteLikesCyamunara($house_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE FROM icyamunara WHERE house_id = '{$house_id}' and user_id3 = '{$user_id}' ";

        $query1="SELECT * FROM icyamunara WHERE house_id = $house_id and user_id3 = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'].'='.$rows['other_photo'];
            $expode = explode("=",$photo);
            $uploadDir = DOCUMENT_ROOT.'/uploads/icyamunara/';
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

    public function update_cyamunara($banner,$available,$discount_change,$user_id,$house_id,$price,$price_discount)
    {
        $mysqli= $this->database;
        $query= "UPDATE icyamunara SET banner= '$banner', buy = '$available', discount = '$discount_change', price_discount = '$price_discount', price = '$price' WHERE house_id= '$house_id' ";
        $result= $mysqli->query($query);

        // var_dump($user_id,$house_id);
        // var_dump('ERROR: Could not able to execute'. $result.mysqli_error($mysqli));


        if($result){
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

       
      public function icyamunaraData($user_id)
      {
          $mysqli= $this->database;
          $query= $mysqli->query("SELECT * FROM icyamunara WHERE user_id3 ='$user_id' ");
          $row= $query->fetch_array();
          return $row;
      }
  
      public function icyamunaraListActivities($user_id)
      {
          $mysqli= $this->database;
          $query= $mysqli->query("SELECT * FROM icyamunara H
          Left JOIN provinces P ON H. province = P. provincecode
          Left JOIN districts M ON H. districts = M. districtcode
          Left JOIN sectors T ON H. sector = T. sectorcode
          Left JOIN cells C ON H. cell = C. codecell
          Left JOIN vilages V ON H. village = V. CodeVillage

           WHERE H. user_id3 ='$user_id' ORDER BY H. created_on3 Desc");
          ?>
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
                          <?php 
                                      //   <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                  echo '<img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                              ';
                          ?>
                  </li>
                  <?php while($icyamunara= $query->fetch_array()) { ?>
                      <li class="time-label">
                          <?php echo $this->buychangesColor($icyamunara['buy']); ?>
                       
                           <?php if($icyamunara['discount'] != 0){ ?>
                              <?php echo $this->PercentageDiscount($icyamunara['discount']); ?>
                          <?php }else { echo ''; ?>
                              <!-- <span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> 0% </span>  -->
                          <?php } ?>
  
                          <div class="timeline-item card flex-md-row shadow-sm h-md-100 border-0">
                          <!-- <img class="card-img-left flex-auto d-none d-lg-block" height="100px" width="100px" src="< ?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$icyamunara['photo'] ;?>" alt="Card image cap"> -->
                          <div class='col-md-4 px-0 card-img-left'>
                          <!-- <div class='card-img-left' style="background: url('< ?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$icyamunara['photo']; ?>')no-repeat;background-size:cover;"> -->
                              <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC.'uploads/icyamunara/'.$icyamunara['photo']; ?>">
                          
                              <?php echo $this->bannerDiscount($icyamunara['banner']); ?>
                          </div>
                          <div class="col-md-8 card-body pt-0">
                          <span id="response<?php echo $icyamunara['house_id']; ?>"></span>
                             <div class="text-primary mb-0">
                                <a class="text-primary float-left" href="javascript:void(0)" id="icyamunara-readmore" data-icyamunara="<?php echo $icyamunara['house_id']; ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i>
                                  <!-- < ?php echo $icyamunara['provincename']; ?> /  -->
                                  <?php echo $icyamunara['namedistrict']; ?> / 
                                  <?php echo $icyamunara['namesector']; ?> 
                                  <!-- < ?php echo $icyamunara['nameCell']; ?> Cell  -->
                                 </a>
                                  
                                  <?php if(isset($_SESSION['key']) && $user_id == $icyamunara['user_id3']){ ?>
                                      <ul class="list-inline ml-2  float-right" style="list-style-type: none;">  
  
                                              <li  class=" list-inline-item">
                                                  <ul class="showcartButt" style="list-style-type: none; margin:0px;" >
                                                      <li>
                                                          <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                          <ul style="list-style-type: none; margin:0px; margin:0px;width:250px;text-align:center;" >
                                                              <li style="list-style-type: none; margin:0px;"> 
                                                              <label class="delete-cyamunara"  data-cyamunara="<?php echo $icyamunara["house_id"];?>"  data-user="<?php echo $icyamunara["user_id3"];?>">Delete </label>
                                                              </li>
  
                                                              <li style="list-style-type: none; margin:0px;"> 
                                                              <label for="">
                                                              <div class="form-row">
                                                                  <div class="col">
                                                                          Banner
                                                                          <div class="input-group">
                                                                                <select class="form-control" name="banner" id="banner<?php echo $icyamunara["house_id"];?>">
                                                                                  <option value="<?php echo $icyamunara['banner']; ?>" selected><?php echo $icyamunara['banner']; ?></option>
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
                                                                                <select class="form-control" name="available" id="available<?php echo $icyamunara["house_id"];?>">
                                                                                <?php if ($icyamunara['buy'] == 'available') { ?>
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
                                                                          <input  type="number" class="form-control form-control-sm" name="discount_change" id="discount_change<?php echo $icyamunara["house_id"];?>" value="<?php echo $icyamunara["discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price<?php echo $icyamunara["house_id"];?>" value="<?php echo $icyamunara["price_discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="price" id="price<?php echo $icyamunara["house_id"];?>" value="<?php echo $icyamunara["price"];?>">
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
                                                              <label for="discount" class="update-cyamunara-btn" data-cyamunara="<?php echo $icyamunara["house_id"];?>" data-user="<?php echo $icyamunara["user_id3"];?>">submit</label>
                                                              </li>
                                                          </ul>
                                                      </li>
                                                  </ul>
                                              </li>
                                      </ul>
                                  <?php } ?>
                                  <span class="float-right"> 
                                       <?php if($icyamunara['discount'] != 0){ ?><span class="mr-2 text-danger " style="text-decoration: line-through;"><?php echo number_format($icyamunara['discount']); ?> Frw</span> <?php } ?><span class="text-primary" > <?php echo number_format($icyamunara['price']); ?> Frw</span>
                                 </span>
                                 <!-- <span class="float-right"> < ?php echo $icyamunara['price']; ?> Frw</span> -->
                              </div> 
                              <div class="text-muted clear-float">
                                  <span class="float-left"><i class="fa fa-home" aria-hidden="true"></i>icyamunara</span>
                                  <span class="float-right mr-5"><i class="fa fa-heart" aria-hidden="true"></i></span></div>
                              <div class="text-muted clear-float">
                                  <span><i class="fa fa-clock-o" aria-hidden="true"></i> Created on <?php echo $this->timeAgo($icyamunara['created_on3'])." By ".$icyamunara['authors']; ?></span>
                              </div>
                              <p class="card-text clear-float">
                                  <?php if (strlen($icyamunara["text"]) > 98) {
                                              echo $icyamunara["text"] = substr($icyamunara["text"],0,98).'...
                                              <span class="mb-0"><a href="javascript:void(0)" id="icyamunara-readmore" data-icyamunara="'.$icyamunara['house_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">Read more...</a></span>';
                                              }else{
                                              echo $icyamunara["text"];
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

$icyamunara = new Icyamunara();

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