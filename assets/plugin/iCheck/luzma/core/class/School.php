<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class School extends Home {

    public function schoolList0($pages,$categories){
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*5)-5;
        }

        $mysqli= $this->database;
        // $query= $mysqli->query("SELECT * FROM school WHERE type_of_school= '{$categories}' ORDER BY created_on_ Desc , rand() Limit $showpages,5");
        if($categories == 'Featured'){

        $query= $mysqli->query("SELECT * FROM school S 
						Left JOIN provinces P ON S. location_province = P. provincecode
						Left JOIN districts D ON S. location_districts = D. districtcode
						Left JOIN sectors T ON S. location_Sector = T. sectorcode
						Left JOIN cells C ON S. location_cell = C. codecell
						Left JOIN vilages V ON S. location_village = V. CodeVillage
        ORDER BY created_on_ Desc , rand() Limit $showpages,5 ");

        }else {
            
        $query= $mysqli->query("SELECT * FROM school S 
						Left JOIN provinces P ON S. location_province = P. provincecode
						Left JOIN districts D ON S. location_districts = D. districtcode
						Left JOIN sectors T ON S. location_Sector = T. sectorcode
						Left JOIN cells C ON S. location_cell = C. codecell
						Left JOIN vilages V ON S. location_village = V. CodeVillage
        WHERE type_of_school= '{$categories}' ORDER BY created_on_ Desc , rand() Limit $showpages,5 ");
        }

        $query1= $mysqli->query("SELECT COUNT(*) FROM school WHERE type_of_school= '{$categories}' ");

        $get_province = mysqli_query($mysqli,"SELECT * FROM provinces");   
        ?>
        <div class="card card-primary mb-1 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title float-left pl-2"><i> School to Search</i></h5>
             <div class="dropdown  float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                            school province
                        </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories(1,1);" >kigali city<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(1);?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories(4,1);" >Northern province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(4);?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories(5,1);" >East province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(5);?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories(3,1);" >West province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(3);?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories(2,1);" >Southern province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(2);?></span></a>

                </div>
            </div>
             <!-- <form class="form-inline  float-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <input type="text" class="form-control searchSchool"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                </div>
              </form> -->

            <div class="nav-scroller py-0" style="clear:right;height:2rem;">
                <nav class="nav d-flex justify-content-between pb-0"  >
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories0('kindergarden School',1);" >kindergarden<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('kindergarden School');?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories0('Primary School',1);" >Primary School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('Primary School');?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories0('Secondary School',1);" >Secondary School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('Secondary School');?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories0('College School',1);" >College School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('College School');?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories0('University',1);" >University School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('University');?></span></a>
                </nav>
            </div> <!-- nav-scroller -->
        </div> <!-- /.card-header -->

        <div class="card-body">
        <span class="school-show"></span>
        <div class="school-hide">
        <h5 class="card-title text-center bg-getcell" ><i><?php echo $categories;?></i></h5>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form" id="form" >
        <input type="hidden" name="type_of_school" id="type_of_school" value="<?php echo $categories;?>">
        <div class="form-row mb-3 bg-getcell">
            <div class="col-sm-12 col-md-4">
                <label for="">Province</label>
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                    </div>
                    <select name="provincecode"  id="provincecode" onchange="showResult();" class="form-control">
                        <option value="">Province</option>
                        <?php while($show_province = mysqli_fetch_array($get_province)) { ?>
                        <option value="<?php echo $show_province['provincecode'] ?>"><?php echo $show_province['provincename'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label for=""> District</label>
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                    </div>
                    <select class="form-control" name="districtcode" id="districtcode" onchange="showResult2();" >
                        <option value="">District</option>
                        <!-- <option></option> -->
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label for="Sector">Sector</label>
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                    </div>
                    <select class="form-control" name="sectorcode" id="sectorcode"  onchange="showResultCSector();">
                        <option value="">Sector</option>
                        <!-- <option></option> -->
                    </select>
                </div>
            </div>
            <!-- <div class="col-sm-12 col-md-3">
                <label for="Cell">Cell</label>
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                    </div>
                    <select name="codecell" id="codecell" class="form-control" onchange="showResultCell();">
                        <option value="">Cell</option>
                    </select>
                </div>
            </div> -->
        </div>
        </form>

        <div id="cell-hide">
        <?php 
            if ($query->num_rows > 0) { ?>

          <?php while($row= $query->fetch_array()) { ?>

            <div class="card flex-md-row shadow-sm h-md-100 border-0 mb-3">
                <div class="col-md-4 px-0 card-img-left more"   id="school-readmore" data-school="<?php echo $row['school_id'] ;?>">
                    <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC ;?>uploads/school/<?php echo $row['photo_']; ?>" alt="Card image cap">
                </div><!-- col -->
                <div class="col-md-8 card-body pt-0">
                    <h5 class="text-primary mb-3">
                    <a class="text-primary;" style="text-transform: capitalize;" href="javascript:void(0)"  id="school-readmore" data-school="<?php echo $row['school_id'] ;?>"><?php echo $row['title_'] ;?></a>
                    </h5>
                    <ul class="mt-2 list-inline" style="float:right"> 
                    <?php if (isset($_SESSION['key']) && $row["user_id_"] == $_SESSION['key']){ ?>
                        <li  class=" list-inline-item">
                            <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                <li>
                                    <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                    <ul style="list-style-type: none; margin:0px;" >
                                        <li style="list-style-type: none; margin:0px;"> 
                                            <label class="deleteTweetSchool" data-school="<?php echo  $row["school_id"];?>"  data-user="<?php echo $row["user_id_"];?>" >Delete </label>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    </ul>
                    <!-- <div class="text-muted">Created on < ?php echo $this->timeAgo($row['created_on_']) ;?> By < ?php echo $row['author_'] ;?> </div> -->
                    <div class="text-muted"><?php 	echo ''.$row['provincename'].'/ '.$row['namedistrict'].' district/ '.$row['namesector'].' Sector' ;?>
                        <?php 	echo '/'.$row['nameCell'].' Cell/ '.$row['VillageName'].' Village' ;?>
                    </div>
                   <p class="card-text mt-2 mb-1">
                        <?php if (strlen($row["text_"]) > 98) {
                                    echo $row["text_"] = substr($row["text_"],0,98).'...
                                    <span class="mb-0"><a href="javascript:void(0)" id="school-readmore" data-school="'.$row['school_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">Read more...</a></span>';
                                    }else{
                                    echo $row["text_"];
                                    } ?>    
                    </p>
                </div><!-- card-body -->
            </div><!-- card -->
          <hr class="bg-info mt-0 mb-1" style="width:95%;">
        <?php } ?>
        
        <?php }else{
                     echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                                <button class="close" data-dismiss="alert" type="button">
                                    <span>&times;</span>
                                </button>
                                <strong>No Record</strong>
                            </div></div>'; 
                } ?>
        </div>
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

          <?php
        if($categories == 'Featured'){
            # code...
            $query2= $mysqli->query("SELECT COUNT(*) FROM school ");
        }else {
            # code...
            $query2= $mysqli->query("SELECT COUNT(*) FROM school WHERE type_of_school= '{$categories}' ");
        }
        $row_Paginaion = $query2->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/5;
        $post_Perpage = ceil($post_Perpages);

    if($post_Perpage > 1){ ?>

    <nav id="landscape-paginat">
        <ul class="pagination justify-content-center mt-3">
            <?php if ($pages > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="schoolCategories0('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
            <?php } ?>
            <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                    if ($i == $pages) { ?>
                 <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="schoolCategories0('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php }else{ ?>
                <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="schoolCategories0('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
            <?php } } ?>
            <?php if ($pages+1 <= $post_Perpage) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="schoolCategories0('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
            <?php } ?>
        </ul>
    </nav>

    <?php } 

    }

    public function schoolList($pages,$categories){
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*5)-5;
        }

        $mysqli= $this->database;
        // $query= $mysqli->query("SELECT * FROM school WHERE location_province= '{$categories}' ORDER BY created_on_ Desc , rand() Limit $showpages,5");
      
      $query= $mysqli->query("SELECT * FROM school S 
						Left JOIN provinces P ON S. location_province = P. provincecode
						Left JOIN districts D ON S. location_districts = D. districtcode
						Left JOIN sectors T ON S. location_Sector = T. sectorcode
						Left JOIN cells C ON S. location_cell = C. codecell
						Left JOIN vilages V ON S. location_village = V. CodeVillage
        WHERE location_province= '{$categories}' ORDER BY created_on_ Desc , rand() Limit $showpages,5 ");

        $query_province= $mysqli->query("SELECT * FROM provinces WHERE provincecode = '{$categories}' ");
        $row_province= $query_province->fetch_assoc();
        
        $query1= $mysqli->query("SELECT COUNT(*) FROM school WHERE location_province= '{$categories}' ");
        $get_province = mysqli_query($mysqli,"SELECT * FROM provinces");   
        ?>
        <div class="card card-primary mb-1 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title float-left pl-2"><i> School to Search</i></h5>
             <div class="dropdown  float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                            school province
                        </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories0('kindergarden School',1);" >kindergarden<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('kindergarden School');?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories0('Primary School',1);" >Primary School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('Primary School');?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories0('Secondary School',1);" >Secondary School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('Secondary School');?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories0('College School',1);" >College School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('College School');?></span></a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="schoolCategories0('University',1);" >University School<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS0('University');?></span></a>

                </div>
            </div>
             <form class="form-inline  float-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <input type="text" class="form-control searchSchool"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                </div>
              </form>

            <div class="nav-scroller py-0" style="clear:right;height:2rem;">
                <nav class="nav d-flex justify-content-between pb-0"  >
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories(1,1);" >kigali city<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(1);?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories(4,1);" >Northern province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(4);?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories(5,1);" >East province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(5);?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories(3,1);" >West province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(3);?></span></a>
                    <a class="p-2" href="javascript:void(0)" onclick="schoolCategories(2,1);" >Southern province<span class="badge badge-primary"><?php echo $this->schoolcountPOSTS(2);?></span></a>
                </nav>
            </div> <!-- nav-scroller -->
        </div> <!-- /.card-header -->

        <div class="card-body">
        <span class="school-show"></span>
        <div class="school-hide">
        <h5 class="card-title text-center bg-getcell"><i><?php echo $row_province['provincename'];?></i></h5>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form" id="form" >
            <input type="hidden" name="location_province" id="location_province" value="<?php echo $categories;?>">
            <div class="form-row mb-3 bg-getcell">
                <div class="col-sm-12 col-md-4">
                    <label for="">Province</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                        </div>
                        <select name="provincecode"  id="provincecode" onchange="showResult();" class="form-control">
                            <option value="">----Select province----</option>
                            <?php while($show_province = mysqli_fetch_array($get_province)) { ?>
                            <option value="<?php echo $show_province['provincecode'] ?>"><?php echo $show_province['provincename'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for=""> District</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                        </div>
                        <select class="form-control" name="districtcode" id="districtcode" onchange="showResult2();" >
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="Sector">Sector</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                        </div>
                        <select class="form-control" name="sectorcode" id="sectorcode"  onchange="showResultSector_province();">
                            <option></option>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-sm-12 col-md-3">
                    <label for="Cell">Cell</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i></span>
                        </div>
                        <select name="codecell" id="codecell" class="form-control" onchange="showResultCell_province();">
                            <option></option>
                        </select>
                    </div>
                </div> -->
            </div>
            </form>

        <div id="cell-hide">
        <?php 
            if ($query->num_rows > 0) { ?>

          <?php while($row= $query->fetch_array()) { ?>

            <div class="card flex-md-row shadow-sm h-md-100 border-0 mb-3">
                <div class="col-md-4 px-0 card-img-left more" id="school-readmore" data-school="<?php echo $row['school_id'] ;?>">
                    <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC ;?>uploads/school/<?php echo $row['photo_']; ?>" alt="Card image cap">
                </div><!-- col -->
                <div class="col-md-8 card-body pt-0">
                    <h5 class="text-primary mb-3">
                    <a class="text-primary;" style="text-transform: capitalize;" href="javascript:void(0)"  id="school-readmore" data-school="<?php echo $row['school_id'] ;?>"><?php echo $row['title_'] ;?></a>
                    </h5>
                    <ul class="mt-2 list-inline" style="float:right"> 
                    <?php if (isset($_SESSION['key']) && $row["user_id_"] == $_SESSION['key']){ ?>
                        <li  class=" list-inline-item">
                            <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                <li>
                                    <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                    <ul style="list-style-type: none; margin:0px;" >
                                        <li style="list-style-type: none; margin:0px;"> 
                                            <label class="deleteTweetSchool" data-school="<?php echo  $row["school_id"];?>"  data-user="<?php echo $row["user_id_"];?>" >Delete </label>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    </ul>
                    <!-- <div class="text-muted">Created on < ?php echo $this->timeAgo($row['created_on_']) ;?> By < ?php echo $row['author_'] ;?> </div> -->
                    <div class="text-muted"><?php 	echo ''.$row['provincename'].'/ '.$row['namedistrict'].' / '.$row['namesector'].'' ;?></div>
                    <div class="text-muted"><?php 	echo ''.$row['nameCell'].'/ '.$row['VillageName'].'' ;?></div>
                    <p class="card-text mt-2 mb-1">
                        <?php if (strlen($row["text_"]) > 98) {
                                    echo $row["text_"] = substr($row["text_"],0,98).'...
                                    <span class="mb-0"><a href="javascript:void(0)" id="school-readmore" data-school="'.$row['school_id'].'" class="text-muted" style"font-weight: 500 !important;font-size:8px">Read more...</a></span>';
                                    }else{
                                    echo $row["text_"];
                                    } ?>    
                    </p>
                </div><!-- card-body -->
            </div><!-- card -->
          <hr class="bg-info mt-0 mb-1" style="width:95%;">
        <?php } ?>
        <?php }else{
                     echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                                <button class="close" data-dismiss="alert" type="button">
                                    <span>&times;</span>
                                </button>
                                <strong>No Record</strong>
                            </div></div>'; 
                } ?>
                
           </div><!-- cell-hide -->
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

          <?php
        $query2= $mysqli->query("SELECT COUNT(*) FROM school WHERE location_province= '{$categories}' ");
        $row_Paginaion = $query2->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/5;
        $post_Perpage = ceil($post_Perpages);

    if($post_Perpage > 1){ ?>

    <nav id="landscape-paginat">
        <ul class="pagination justify-content-center mt-3">
            <?php if ($pages > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="schoolCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
            <?php } ?>
            <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                    if ($i == $pages) { ?>
                 <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="schoolCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php }else{ ?>
                <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="schoolCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
            <?php } } ?>
            <?php if ($pages+1 <= $post_Perpage) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="schoolCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
            <?php } ?>
        </ul>
    </nav>

    <?php } 

    }

    
      public function schoolReadmore($school_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN school S ON S. user_id_ = U. user_id 
            	Left JOIN provinces P ON S. location_province = P. provincecode
                Left JOIN districts D ON S. location_districts = D. districtcode
                Left JOIN sectors T ON S. location_Sector = T. sectorcode
                Left JOIN cells C ON S. location_cell = C. codecell
                Left JOIN vilages V ON S. location_village = V. CodeVillage
        WHERE S. school_id = '$school_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function school_getPopupTweet($user_id,$school_id,$school_user_id)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN school B ON B. user_id_ = U. user_id WHERE B. school_id = $school_id AND B. user_id_ = $school_user_id ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      
    public function deleteLikesSchool($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE FROM school WHERE school_id = '{$tweet_id}' and user_id_ = '{$user_id}' ";

        $query1="SELECT * FROM school WHERE school_id = $tweet_id and user_id_ = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo_'])){
            $photo=$rows['photo_'].'='.$rows['other_photo_'];
            // .'='.$rows['video_'].'='.$rows['youtube_']
            $expodefile = explode("=",$photo);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$photo);
                $uploadDir = DOCUMENT_ROOT.'/uploads/school/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/school/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/school/';
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

       public function schoolcountPOSTS($categories)
    {
        $mysqli =$this->database;
        $sql= $mysqli->query("SELECT COUNT(*) FROM school WHERE location_province= '{$categories}' ");
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

       public function schoolcountPOSTS0($categories)
    {
        $mysqli =$this->database;
        $sql= $mysqli->query("SELECT COUNT(*) FROM school WHERE type_of_school= '{$categories}' ");
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

    public function recentArticle(){

    }

}

$school = new School();

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
