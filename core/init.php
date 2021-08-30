<?php 
header('Access-Control-Allow-Origin: *');
session_start();

include 'Mobile_Detect.php';

// https://www.developer.com/mobile/creating-a-mobile-friendly-website-in-php/
$detect = new Mobile_Detect;
$device_type = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
// $script_version = $detect->getScriptVersion();
global $device_type;

include('database/db.php');
include('class/Users.php');
include('class/Post_like.php');
include('class/Comment.php');
include('class/Home.php');
include('class/Follow.php');
include('class/Job.php');
// include('class/Message.php');

include('class/Message_with_file_image_chat.php');
include('class/Trending.php');
include('class/Notification.php');
include('class/Events.php');
include('class/Fundraising.php');
include('class/Crowfund.php');
include('class/Promote_home_post.php');

include('class/Hashtag_GetUsers.php');
include('class/Notification_body.php');
include('class/Posts_home.php');
include('class/Home_GetUsers.php');
include('class/post_home_copyDraft.php');
include('class/Newsfeeds.php');
// include('class/pathinfo_docx_Post_home.php');
// include('class/pathinfo_docx_Posts_copyDraft.php');
// include('class/pathinfo_with_foreach_pdf_posts_home.php');
include('class/Unemployment.php');
include('class/professional.php');
include('class/Sale.php');
include('class/House.php');
include('class/Icyamunara.php');
include('class/Car.php');
include('class/School.php');
include('class/Email_notification.php');

define('BASE_URL_PUBLIC', 'http://localhost/irangiro_social_site/');
define('BASE_URL_LINK', 'http://localhost/irangiro_social_site/assets/');

// define('BASE_URL','https://irangiro.com/');
// define('BASE_URL_PUBLIC', 'https://irangiro.com/');
// define('BASE_URL_LINK', 'https://irangiro.com/assets/');

// UPLOAD PHOTO
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'/irangiro_social_site');
// define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
$irangiro = $home->irangiroData();
$_SESSION['approval_user_ui'] = $irangiro['approval_user_ui'];
// UI

define('F_INDEX', BASE_URL_PUBLIC.'irangiro.home');
define('HOME', BASE_URL_PUBLIC);
// SETTING FILE
define('LOGIN', BASE_URL_PUBLIC.'include/login');
define('LOGOUT', BASE_URL_PUBLIC.'include/logout');
define('LOCKSCREEN_LOGIN', BASE_URL_PUBLIC.'include/lockscreen');
define('LOCKSCREEN_LOGINCORE', BASE_URL_PUBLIC.'core/ajax_db/lockscreen.php?login_id=1');
define('FORGET_PASSPOWRD', BASE_URL_PUBLIC.'include/forgotpassword');
define('CREATE_PASSPOWRD', BASE_URL_PUBLIC.'include/createpassword');
define('EMAIL_VERIFIED', BASE_URL_PUBLIC.'include/email_verified');

// END SETTING FILE
define('ACTIVITIES', BASE_URL_PUBLIC.'activities.php');
define('BALANCE', BASE_URL_PUBLIC.'balance');
define('NETWORK', BASE_URL_PUBLIC.'network');
define('INDEXX', BASE_URL_PUBLIC.'indexx');
define('SHOPPING', BASE_URL_PUBLIC.'shopping');
define('FOLLOWERS', BASE_URL_PUBLIC.'followers');
define('FOLLOWING', BASE_URL_PUBLIC.'following');
define('PROFILE', BASE_URL_PUBLIC.'profile');
define('PROFILE_EDIT', BASE_URL_PUBLIC.'profileEdit');
define('PROFILE_CLOSE_ACCOUNT', BASE_URL_PUBLIC.'profile_close_account');

// define('HASHTAG', BASE_URL_PUBLIC.'hashtag');
// define('JOBS', BASE_URL_PUBLIC.'jobs0.php');
define('JOBS', BASE_URL_PUBLIC.'jobs');
define('NOTIFICATION', BASE_URL_PUBLIC.'NOTIFICATION');
define('EVENTS', BASE_URL_PUBLIC.'events');
define('SALE', BASE_URL_PUBLIC.'sale');
define('SPORTS', BASE_URL_PUBLIC.'sports');
define('SETTINGS', BASE_URL_PUBLIC.'setting');
define('WATCHLIST', BASE_URL_PUBLIC.'shopping');
define('NETWORK_RESPONSIVE', BASE_URL_PUBLIC.'network_responsive');
define('BUSINESS_POST_JOBS', BASE_URL_PUBLIC.'business_jobPost');
define('INDIVIDUAL_POST_JOBS', BASE_URL_PUBLIC.'individual_jobPost');
define('FRIEND_REQUEST', BASE_URL_PUBLIC.'friend_request');
define('PROMOTE_ADS', BASE_URL_PUBLIC.'marketing_ads');
define('NEWSFEED', BASE_URL_PUBLIC.'newsfeeds');
define('DONATION', BASE_URL_PUBLIC.'donation');


// TWITTER SOCIAL MEDIA 
define('TWITTER', 'https://twitter.com/');
define('INSTAGRAM', 'https://www.instagram.com/');
define('FACEBOOK', 'https://www.facebook.com/');
define('GOOGLE_PLUS', 'https://www.google.com/');
define('MAIL', 'https://www.mail.com/');

// TWITTER SOCIAL MEDIA 

// DEFAULT IMAGE USERS 
define( 'PROFILE_IMAGE', BASE_URL_LINK.'image/users_profile_cover/');
define( 'NO_PROFILE_IMAGE', 'image/users_profile_cover/empty-profile.png');
define( 'NO_PROFILE_IMAGE_URL', 'image/users_profile_cover/empty-profile.png');
define( 'NO_COVER_IMAGE_URL', 'image/users_cover_profile/defaultCoverImage.png');
define( 'NO_PHOTO', 'image/users_cover_profile/empty-photo.png');



// SEARCH ANYTHING IN GITHUB 
// SELECT * FROM tweets T LEFT JOIN users U
// U LL FND WAT U SERCH 4R


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

// return true or false
// 	Expression      | empty($x)
// ----------------+--------
// $x = "";        | true    
// $x = null       | true    
// var $x;         | true    
// $x is undefined | true    
// $x = array();   | true    
// $x = false;     | true    
// $x = true;      | false   
// $x = 1;         | false   
// $x = 42;        | false   
// $x = 0;         | true    
// $x = -1;        | false   
// $x = "1";       | false   
// $x = "0";       | true    
// $x = "-1";      | false   
// $x = "php";     | false   
// $x = "true";    | false   
// $x = "false";   | false   



?>