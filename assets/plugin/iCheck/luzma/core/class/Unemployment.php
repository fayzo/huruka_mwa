<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Unemployment extends Home {

    public function unemplyomentfetchALL($categories,$pages)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*10)-10;
        }
        $mysqli= $this->database;
        if($categories == 'Featured'){
            $query= $mysqli->query("SELECT * FROM users WHERE unemployment ='yes' ORDER BY rand() Desc Limit $showpages,10");
        }else{
            $query= $mysqli->query("SELECT * FROM users WHERE unemployment ='yes' AND categories_fields='$categories' ORDER BY rand() Desc Limit $showpages,10");
        }
        ?>
        <div class="card card-primary mb-1 ">
        <div class="card-header main-active p-1">
            <h5 class="card-title float-left pl-2"><i> Search Any Fields  </i></h5>
             <div class="dropdown float-right " style="clear:right;height:2rem;float:right;">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                              Fields
                          </button>
                  <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="#">Select any field</a>
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="javascript:void(0)" onclick="unemploymentCategories('Featured',1);" >Featured<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('Featured');?></span></a>
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="javascript:void(0)" onclick="unemploymentCategories('accountant',1);" >accountant<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('accountant');?></span></a>
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="javascript:void(0)" onclick="unemploymentCategories('finance',1);" >finace<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('finance');?></span></a>
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="javascript:void(0)" onclick="unemploymentCategories('management',1);" >management<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('management');?></span></a>
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="javascript:void(0)" onclick="unemploymentCategories('computer_enginnering',1);" >computer_enginnering<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('computer_enginnering');?></span></a>
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="javascript:void(0)" onclick="unemploymentCategories('mechanical_enginnering',1);" >mechanical_enginnering<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('mechanical_enginnering');?></span></a>
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="javascript:void(0)" onclick="unemploymentCategories('electrical_enginnering',1);" >electrical_enginnering<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('electrical_enginnering');?></span></a>
                  </div>
              </div> 
             <form class="form-inline float-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <input type="text" class="form-control searchUnemployment"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                </div>
              </form>

            <div class="nav-scroller py-0" style="clear:right;height:3.4rem;"> 
                <nav class="nav d-flex justify-content-between pb-0  horizontal-large-2"  >
                <a class="p-2" href="javascript:void(0)" onclick="unemploymentCategories('Featured',1);" >Featured<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('Featured');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="unemploymentCategories('accountant',1);" >accountant<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('accountant');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="unemploymentCategories('finance',1);" >finance<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('finance');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="unemploymentCategories('management',1);" >management<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('management');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="unemploymentCategories('computer_enginnering',1);" >computer_enginnering<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('computer_enginnering');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="unemploymentCategories('mechanical_enginnering',1);" >mechanical_enginnering<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('mechanical_enginnering');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="unemploymentCategories('electrical_enginnering',1);" >electrical_enginnering<span class="badge badge-primary"><?php echo $this->unemplyomentcountPOSTS('electrical_enginnering');?></span></a>
                </nav>
            </div> 
            <!-- nav-scroller -->
        </div> <!-- /.card-header -->

        <div class="card-body">
        <span class="job-show"></span>
        <div class="job-hide">
          <?php while($row= $query->fetch_array()) { ?>

            <div class="col-12 px-0 py-2 jobHover more" data-user="<?php echo $row['user_id'];?>" >
            <div class="user-block mb-2" >
                   <div class="user-jobImgall" id="unemployment" data-user="<?php echo $row['user_id'];?>">
                         <?php if (!empty($row['profile_img'])) {?>
                         <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $row['profile_img'] ;?>" alt="User Image">
                         <?php  }else{ ?>
                           <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                         <?php } ?>
                   </div>
                   <div class='float-left' style='display: flow-root;'>
                        <div class="clear-float">
                            <span class='float-left'>Names: <?php echo $row['firstname']." ".$row['lastname']; ?> </span>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="float-right people-message more"'; }else{ echo 'class="float-right more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['user_id'];?>"><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </span>
                        </div>
                        <div class="clear-float">
                            <span class='float-left'>education: <?php echo $row['education']; ?> </span>
                            <span  <?php if(isset($_SESSION['key'])){ echo 'class="float-right emailSent more"'; }else{ echo 'class="float-right more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $row['user_id'];?>"><?php echo $row['email']; ?></span>
                        </div>
                        <div class="clear-float">
                            <span class='float-left'>diploma: <?php echo $row['diploma']; ?> </span>
                            <span class='float-right'><?php echo $row['phone']; ?> </span>
                            </div>
                        <div class="clear-float">
                            <span class='float-left'>Fields study: <?php echo $row['categories_fields']; ?> </span>
                            <span class='float-right'>Unemployment: <?php echo $row['unemployment']; ?> </span>
                        </div>
                    </div>
          </div> <!-- user-block -->
          </div> <!-- col-12 -->
          <hr class="bg-info mt-0 mb-1" style="width:70%;">

        <?php }

        if($categories == 'Featured'){
            $query1= $mysqli->query("SELECT COUNT(*) FROM users WHERE unemployment ='yes' ");
        }else{
            $query1= $mysqli->query("SELECT COUNT(*) FROM users WHERE unemployment ='yes' AND categories_fields='$categories' ");
        }

        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/10;
        $post_Perpage = ceil($post_Perpages); ?>
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="unemploymentCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="unemploymentCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="unemploymentCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="unemploymentCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 
        } 

      public function unemplyomentcountPOSTS($categories)
    {
        $mysqli =$this->database;
          if($categories == 'Featured'){
            $sql= $mysqli->query("SELECT COUNT(*) FROM users WHERE unemployment ='yes' ");
        }else{
            $sql= $mysqli->query("SELECT COUNT(*) FROM users WHERE unemployment ='yes' AND categories_fields='$categories' ");
        }
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

     public function searchUnemployment($search)
    {
        $mysqli= $this->database;
        $param= '%'.$search.'%';
        $query = "SELECT * FROM users WHERE unemployment ='yes' AND categories_fields LIKE '{$param}' ";
        $result= $mysqli->query($query);
        $contacts = array();
        while ($row= $result->fetch_array()) {
            $contacts[] = array(
            'user_id' => $row['user_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'education' => $row['education'],
            'diploma' => $row['diploma'],
            'phone' => $row['phone'],
            'categories_fields' => $row['categories_fields'],
            'email' => $row['email'],
            'unemployment' => $row['unemployment'],
            'profile_img' => $row['profile_img']
           );
        }
        return $contacts; // Return the $contacts array
    }
}

$unemployment = new Unemployment();


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