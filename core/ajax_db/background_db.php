<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if ($_REQUEST['key']) {

 if ($_REQUEST['key'] == 'background') {
			$id = $db->real_escape_string($_REQUEST['id']);
			$background = $db->real_escape_string($_REQUEST['background']);
            $db->query("UPDATE users SET background='$background' WHERE user_id='$id'");
            $sql= $db->query("SELECT user_id,background FROM users WHERE user_id = '$id' ");
            // echo ($db)? 'good':"ERROR: Could not able to execute $sql.".mysqli_error($db);
        	$data = $sql->fetch_array();
        	$jsonArrays = array(
        		'user_id' => $data['user_id'],
        		'background' => $data['background'],
        	);
           exit(json_encode($jsonArrays));
      }
}
?>