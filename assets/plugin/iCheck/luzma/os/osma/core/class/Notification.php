<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Notification extends Home 
{
    public function getNotificationCount($user_id,$email)
    {
       $mysqli= $this->database;
       $query="SELECT COUNT(message_id) AS totalmessage, (SELECT COUNT(notification_id) FROM notification WHERE notification_for = $user_id AND status ='0') AS totalnotification , (SELECT COUNT(cv_id) FROM email_apply_job WHERE email_sent_to = '$email' AND email_status=0 AND type_of_email = 'inbox') AS total_email,(SELECT COUNT(cv_id) FROM email_apply_job WHERE email_sent_to= '$email' AND type_of_email = 'inbox' ) AS total_email_user_id,(SELECT COUNT(job_id) FROM jobs WHERE turn = 'on' and deadline > CURDATE()) AS total_jobs, (SELECT COUNT(follow_id) FROM follow WHERE receiver = $user_id and status_request = 0) AS total_FriendRequest  FROM message WHERE message_to= $user_id AND status= '0' ";
       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_assoc()) {
                $data[]= $row;
       }
    //    var_dump($data);
       foreach ($data as $notifiCount) {
           # code...
           return $notifiCount;
       }
    }

    public function messagesView($user_id)
    {
       $mysqli= $this->database;
       $query="UPDATE message SET status = '1' WHERE message_to = $user_id AND status= '0'";
       $result=$mysqli->query($query);
    }

    public function notificationsView($user_id)
    {
       $mysqli= $this->database;
       $query="UPDATE notification SET status = '1' WHERE notification_for = $user_id AND status= '0'";
       $result=$mysqli->query($query);
    }

    public function notifications($user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM notification N 
                        LEFT JOIN users U ON N. notification_from = U. user_id 
                        LEFT JOIN tweets T ON N. target = T. tweet_id and N. type != 'follow'
                        -- LEFT JOIN likes L ON N. target = L. like_on and N. type != 'follow' and N. type = 'likes'
                        LEFT JOIN follow F ON N. notification_from = F. sender AND N. notification_for = F. receiver and N. type = 'follow'  
                        WHERE N. notification_for = $user_id AND N. notification_from != $user_id OR
                        N. notification_for = $user_id AND N. notification_from = $user_id 
                        AND DATE_SUB(CURDATE(),INTERVAL 30 WEEK) <= N. time 
                        ORDER BY time Desc";

       $result=$mysqli->query($query);
       $data=array();
        while ($row = $result->fetch_assoc()) {
                 $data[]= $row;
               }
       return $data;
    }

    public function notificationsUnread($user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM notification N 
                        LEFT JOIN users U ON N. notification_from = U. user_id 
                        LEFT JOIN tweets T ON N. target = T. tweet_id
                        LEFT JOIN likes L ON N. target = L. like_on
                        LEFT JOIN follow F ON N. notification_from = F. sender AND N. notification_for = F. receiver 
                        WHERE N. notification_for = $user_id AND N. notification_from != $user_id AND N. status = 0 AND DATE_SUB(CURDATE(),INTERVAL 30 WEEK) <= N. time ORDER BY time Desc";
       $result=$mysqli->query($query);
       $data=array();
        while ($row = $result->fetch_assoc()) {
                 $data[]= $row;
               }
       return $data;
    }

    static public function SendNotifications($get_id,$user_id,$target,$type)
    {
       $mysqli= self::$databases;
       self::createss('notification',array('notification_for' => $get_id, 'notification_from' => $user_id, 'target' => $target, 'type' => $type ,'time' => date('Y-m-d H-i-s')));
    }


}

$notification = new Notification();

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