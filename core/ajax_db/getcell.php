<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_REQUEST['sectorcode']) && !empty($_REQUEST['sectorcode'])) {

	$get_cell = mysqli_query($db,"SELECT * FROM  cells WHERE sectorcode ='".$_REQUEST['sectorcode']."'");

	echo "<select name=\"codecell\" id=\"codecell\" class=\"form-control\">" ;
	if(mysqli_fetch_array($get_cell)==0){
		echo "<option value=\"No Cell Available\">No Cell Available</option>";
	}else{
	
	    echo "<option value=\"\">------Select cell------</option>";
		while($row=mysqli_fetch_array($get_cell)){
			echo "<option value=\"".$row['codecell']."\">".$row['nameCell']."</option>";
		}
	}
	echo "</select><br>";

}

if (isset($_POST['sectorResult']) && !empty($_POST['sectorResult'])) {
	if ($_POST['type_of_school'] = 'Featured') {
		# code...
		$query= $db->query("SELECT * FROM school S Left JOIN sectors C ON S. location_Sector = C. sectorcode WHERE S. location_province= '{$_POST['province']}' and S. location_districts= '{$_POST['district']}' and S. location_Sector= '{$_POST['sectorResult']}' ORDER BY S. created_on_ Desc , rand() Limit 0,5");
		$query0= $db->query("SELECT * FROM school S 
							Left JOIN provinces P ON S. location_province = P. provincecode
							Left JOIN districts D ON S. location_districts = D. districtcode
							Left JOIN sectors T ON S. location_Sector = T. sectorcode
							Left JOIN cells C ON S. location_cell = C. codecell
							Left JOIN vilages V ON S. location_village = V. CodeVillage
		WHERE S. location_province= '{$_POST['province']}' and S. location_districts= '{$_POST['district']}' and S. location_Sector= '{$_POST['sectorResult']}' ORDER BY S. created_on_ Desc , rand() Limit 0,5");
		$row0= $query0->fetch_assoc();
	}else {
		# code...
		$query= $db->query("SELECT * FROM school S Left JOIN sectors C ON S. location_Sector = C. sectorcode WHERE S. type_of_school= '{$_POST['type_of_school']}' and S. location_province= '{$_POST['province']}' and S. location_districts= '{$_POST['district']}' and S. location_Sector= '{$_POST['sectorResult']}' ORDER BY S. created_on_ Desc , rand() Limit 0,5");
		$query0= $db->query("SELECT * FROM school S 
							Left JOIN provinces P ON S. location_province = P. provincecode
							Left JOIN districts D ON S. location_districts = D. districtcode
							Left JOIN sectors T ON S. location_Sector = T. sectorcode
							Left JOIN cells C ON S. location_cell = C. codecell
							Left JOIN vilages V ON S. location_village = V. CodeVillage
		 WHERE S. type_of_school= '{$_POST['type_of_school']}' and S. location_province= '{$_POST['province']}' and S. location_districts= '{$_POST['district']}' and S. location_Sector= '{$_POST['sectorResult']}' ORDER BY S. created_on_ Desc , rand() Limit 0,5");
		$row0= $query0->fetch_assoc();
	}
	
	// var_dump($query);
	if ($query->num_rows > 0) {
		echo '<div class="bg-getcell" ><span class="text-success">'.$row0['provincename'].'</span >/ <span class="text-warning">'.$row0['namedistrict'].'</span> district/ <span class="text-info">'.$row0['namesector'].'</span> Sector/ <span class="text-danger">'.$row0['nameCell'].'</span> Cell/ <span class="text-primary">'.$row0['VillageName'].'</span> Village</div>' ;

    while($row= $query->fetch_assoc()) { ?>

			<div class="card flex-md-row shadow-sm h-md-100 border-0 mb-3">
					<!-- <img class="card-img-left flex-auto d-none d-lg-block" height="150px" width="150px" src="< ?php echo BASE_URL_PUBLIC ;?>uploads/schoolFile/< ?php echo $row['photo_']; ?>" alt="Card image cap"> -->
				<div class="col-md-4 px-0 card-img-left">
                    <img class="pic-responsive" src="<?php echo BASE_URL_PUBLIC ;?>uploads/schoolFile/<?php echo $row['photo_']; ?>" alt="Card image cap">
                </div><!-- col -->
                <div class="col-md-8 card-body d-flex flex-column align-items-start pt-0">
                    <h5 class="text-primary mb-0">
                    <a class="text-primary" href="javascript:void(0)"  id="districts-view" data-districts="<?php echo $row['location_districts'] ;?>"><?php echo $row['title_'] ;?></a>
                    </h5>
                    <!-- <div class="text-muted">Created on < ?php echo $home->timeAgo($row['created_on_']) ;?> By < ?php echo $row['author_'] ;?> </div> -->
                    <div class="text-muted"><?php 	echo ''.$row0['provincename'].'/ '.$row0['namedistrict'].' district/ '.$row0['namesector'].' Sector' ;?></div>
                    <div class="text-muted"><?php 	echo ''.$row0['nameCell'].' Cell/ '.$row0['VillageName'].' Village' ;?></div>
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
		  
	<?php } 

	}else {
		echo ' No school found';
	}

}

if (isset($_POST['sector']) && !empty($_POST['sector'])) {
	$categories = $_POST['categories'];
	$province= $_POST['province'];
	$district = $_POST['district'];
	$sector = $_POST['sector'];
	$pages = $_POST['pages'];
	$user_id = $_POST['user_id'];

	$mysqli= $db;
	$query= $mysqli->query("SELECT * FROM house H,provinces P,districts M ,sectors T 
	WHERE  P. provincecode = '{$province}' and
	M. districtcode= '{$district}'and T. sectorcode = '{$sector}' ");
	$houses = $query->fetch_array();
	
	// echo $house->propertyView_SeachSectorNavbar($categories,$province,$district,$sector,$pages,$user_id);
	echo "<div class='text-center h5 text-success'>$houses[provincename] / $houses[namedistrict] district / $houses[namesector] sector </div>";
	echo $house->propertyView_SeachSectorList($categories,$province,$district,$sector,$user_id,$pages);
} 


	?>
	
