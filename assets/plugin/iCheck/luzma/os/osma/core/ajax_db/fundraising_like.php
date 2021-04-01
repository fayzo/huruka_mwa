<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['like']) && !empty($_POST['like'])) {
    $user_id= $_SESSION['key'];
    $fund_id= $_POST['like'];
    $get_id= $_POST['user_id'];
    $fundraising->addLikeFundraising($user_id,$fund_id, $get_id);
}

if (isset($_POST['unlike']) && !empty($_POST['unlike'])) {
    $user_id= $_SESSION['key'];
    $fund_id= $_POST['unlike'];
    $get_id= $_POST['user_id'];
    $fundraising->unLikeFundraising($user_id,$fund_id, $get_id);
}

?>
