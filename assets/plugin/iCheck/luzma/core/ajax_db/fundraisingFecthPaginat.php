<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

     if(isset($_REQUEST['categories'])) {  
        echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories'],$_SESSION['key']); 
      }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'animals' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'community' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'competition' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'creative' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'education' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'emergency' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'faith' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'medical' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'memorial' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }

    //  if(isset($_REQUEST['categories']) && $_REQUEST['categories'] === 'nonprofit' ) {  
    //     echo $fundraising->fundraisings($_REQUEST['pages'],$_REQUEST['categories']); 
    //   }
?>