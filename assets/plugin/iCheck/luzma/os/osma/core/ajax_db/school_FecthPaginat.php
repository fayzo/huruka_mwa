<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_REQUEST['school'])) {  
  echo $school->schoolList0($_REQUEST['pages'],$_REQUEST['categories']); 
}

if(isset($_REQUEST['school_location'])) {  
  echo $school->schoolList($_REQUEST['pages'],$_REQUEST['categories']); 
}

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
    $result= $home->searchSchool($search);
    // echo '<h4 style="padding: 0px 10px;">'.$_POST['search'].'</h4> ';

  if (!empty($result)){
    if (is_array($result) || is_object($result)){
      // var_dump($result);
      // var_dump(is_array($result));
      echo '<h5 class="card-title text-center"  style="background:#faebd7;padding:10px;"><i>'.$result[0]['title_'].' / '.$result[0]['type_of_school'].'</i></h5>';
      
     foreach ($result as $row) { ?>

           <div class="card flex-md-row shadow-sm h-md-100 border-0 mb-3">
                    <img class="card-img-left flex-auto d-none d-lg-block" height="150px" width="150px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/schoolFile/<?php echo $row['photo_']; ?>" alt="Card image cap">
                <div class="card-body d-flex flex-column align-items-start pt-0">
                    <h5 class="text-primary mb-0">
                    <a class="text-primary" href="javascript:void(0)"  id="districts-view" data-districts="<?php echo $row['location_districts'] ;?>"><?php echo $row['title_'] ;?></a>
                    </h5>
                    <div class="text-muted">Created on <?php echo $home->timeAgo($row['created_on_']) ;?> By <?php echo $row['author_'] ;?> </div>
                    <div class="text-muted"><?php 	echo ''.$row['provincename'].' Province/ '.$row['namedistrict'].' district/ '.$row['namesector'].' Sector' ;?></div>
                    <div class="text-muted"><?php 	echo ''.$row['nameCell'].' Cell/ '.$row['VillageName'].' Village' ;?></div>
                    <p class="card-text mb-1">vIEW Different Landscapes of <?php echo $row['location_districts'] ;?> Districts</p>
                </div><!-- card-body -->
            </div><!-- card -->
          <hr class="bg-info mt-0 mb-1" style="width:95%;">
          
        <?php } 
        }
   }else{
      echo '<h5 class="card-title text-center"  style="background:#faebd7;padding:10px;"><i>No School Found</i></h5>';
   }
} 
?>