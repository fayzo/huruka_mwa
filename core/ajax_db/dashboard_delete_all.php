<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['delete_all']) && !empty($_POST['delete_all'])) {
    $user_id= $_SESSION['key'];
    $comment->delete_all($_POST['delete_all']);
}

if (isset($_POST['key'])) {

    $rowID = $db->real_escape_string($_POST['rowID']);

    if ($_POST['key'] == 'on') {
        $conn =$db;
        $conn->query("UPDATE users SET approval_user_ui='on' WHERE user_id='$rowID'");
        exit('success');
    }


    if ($_POST['key'] == 'off') {
        $conn =$db;
        $conn->query("UPDATE users SET approval_user_ui='off' WHERE user_id='$rowID'");
        exit('success');
    }

    
}

?>