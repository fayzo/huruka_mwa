<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Email_notification extends Home 
{
    
public function recentEmail($email)
    {
       $mysqli= $this->database;
    //    $query="SELECT * FROM message LEFT JOIN users ON message_from= user_id WHERE message_to= $user_id ORDER BY message_on Desc ;";
       $query="SELECT * FROM apply_job WHERE email_sent_to_= '$email' AND email_status= 1 AND type_of_email = 'inbox' ORDER BY created_on0 Desc ;";
             
       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }
       return $data;

    }

    public function recentEmailUnread($email)
    {
       $mysqli= $this->database;
      //  $query="SELECT * FROM apply_job M LEFT JOIN users U ON M. email_sent_for= U. user_id WHERE M. email_sent_to= $user_id AND M. email_status= 0 GROUP BY M. email_sent_for, M. email_sent_to HAVING  COUNT(DISTINCT M. email_sent_to) AND COUNT(DISTINCT M. email_sent_for) ORDER BY M. created_on0 Desc ;";
       $query="SELECT * FROM apply_job WHERE email_sent_to_= '$email' AND email_status= 0 AND type_of_email = 'inbox' ORDER BY created_on0 Desc ;";

       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }
       return $data;

    }

}

$email_notification= new Email_notification();

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