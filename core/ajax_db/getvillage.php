<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

$get_village = mysqli_query($db,"SELECT * FROM  vilages WHERE codecell ='".$_POST['codecell']."'");

	echo "<select name=\"CodeVillage\" id=\"CodeVillage\">";
	if(mysqli_fetch_array($get_village)==0){
		echo "<option value=\"No village Available\">No village Available</option>";
	}else{
	
	echo "<option value=\"\">------Select village------</option>";
		while($row=mysqli_fetch_array($get_village)){
			echo "<option value=\"".$row['CodeVillage']."\">".$row['VillageName']."</option>";
		}
	}
	echo "</select><br>";
	?>
	
