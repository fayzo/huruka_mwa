<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

     if(isset($_REQUEST['categories'])) {  
        echo $job->jobsfetchALL($_REQUEST['categories'],$_REQUEST['pages']); 
      }

     if(isset($_REQUEST['categoriess']) && $_REQUEST['jobs0'] == 'jobs0') {  
        echo $job->jobsfetchALL0($_REQUEST['categoriess'],$_REQUEST['pages']); 
      }

?>