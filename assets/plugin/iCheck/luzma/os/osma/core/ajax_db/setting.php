   <?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_POST['key'])){
      if($_POST['key'] == 'userchangename'){

         $username= $users->test_input($_POST['username']);
         $email= $users->test_input($_POST['email']);
         $id= $users->test_input($_POST['id']);
         $link = array('Jobs','Professional','Fundraising','School','House','icyamunara','Car','GushoraStartUp','Marketplace');
     
         if(!preg_match("/^[a-zA-Z ]*$/", $username)){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Only letters and white space allowed</strong> </div>');
         }else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Email invalid format</strong> </div>');
         }else if (strlen($username) > 20) {
              exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username must be between 3-20 character</strong> </div>');
        }else if (in_array($username,$link)) {
            exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                        <button class="close" data-dismiss="alert" type="button">
                            <span>&times;</span>
                        </button>
                        <strong>Username already in used </strong> </div>');
         }else if (strlen($username) < 3) {
              exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button> <strong> Username is too short</strong> </div>');
         }else{
          $users->UserEmailalreadyTookenSettings('users',array(
                'username' => $username,
                'email' => $email
          ),array(
                'username' => $username,
                'email' => $email
          ));

      }
   }

   if ($_POST['key'] == 'settingspassword') {
    
     $currentpassword =  $users->test_input($_POST['currentpassword']);
     $password =  $users->test_input($_POST['newpassword']);
     $verifypassword =  $users->test_input($_POST['verifypassword']);
     $id= $users->test_input($_POST['id']);

     if (strlen($password) > 8) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Password must be between 4-8 character</strong> </div>');
     }else if (strlen($password) < 3) {
         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Password is too short</strong> </div>');
    }else if ($password != $verifypassword) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Password Must eqaul to verification</strong> </div>');
    }else{
        if($users->checkPassword($currentpassword) === true){
            
           $users->update('users',array( 'password' => $password),array('user_id' => $id));
       
          $users->forgotUsernameCountsTimesHeCreatespassword('users',
          array('forgotUsernameCountsTimesHeCreatespassword' => 'forgotUsernameCountsTimesHeCreatespassword + 1'),$id);

          exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
        }else{
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong> Your Current password is Incorrect </strong> </div>');
        }
    } 
 } 
 } 

if (isset($_POST['close_account'])) {
    
    $id= $_POST['close_account'];
    $result= $users->update('users',array( 'close_account' => $_POST['value'] ),array('user_id' => $id));
    
    if ($result) {
        exit('<div class="alert alert-success alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>SUCCESS</strong> </div>');
    }else{
            exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong> Fail </strong> </div>');
    }
} 

if (isset($_POST['delete_account'])) {
    
    $id= $_POST['delete_account'];
    $result= $users->update('users',array( 'delete_account' => 'yes' ),array('user_id' => $id));
    
    if ($result) {
        exit('<div class="alert alert-success alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>SUCCESS</strong> </div>');
    }else{
            exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong> Fail </strong> </div>');
    }
} 
?>