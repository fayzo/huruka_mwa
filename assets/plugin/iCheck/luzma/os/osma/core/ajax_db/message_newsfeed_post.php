<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['key']) == 'textarea'){

	$user_id= $users->test_input($_POST['id']);
	$status= $users->test_input($_POST['status']);

    if (!empty($_POST['title_name'])) {
        $title_name= $users->test_input($_POST['title_name']);
    }else {
        $title_name= '';
    }

    if (!empty($_POST['youtube'])) {
        $tweet = $_POST['youtube'];
        if (strpos($tweet,'www.youtube.com/embed/') !== false) {

            $search = '/((https:\/\/)www\.youtube\.com\/embed\/\w+)/';
            $tweet= preg_replace($search,'<iframe width="100%" height="280" src="$0" frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                                </iframe><br>',$tweet);
        }

        if (strpos($tweet,'www.youtube.com/watch?v=') !== false) {

            $link = preg_split("!&!", $tweet);
            $tweet= preg_replace("!watch\?v=!", "embed/", $link[0]);
            $tweet= "<iframe width='100%' height='280' frameborder='0' src='" . $tweet ."'
            allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen>
            </iframe><br>";
        }

        // $youtube= htmlentities($tweet);
        $youtube= $tweet;
        // var_dump($tweet);
    }else {
        $youtube= '';
    }

    if (!empty($_POST['donation_payment'])) {
        $money_to_target= $users->test_input($_POST['money_to_target']);
        $donation_payment=  $users->test_input($_POST['donation_payment']);
    }else {
        $donation_payment='';
        $money_to_target= '';
    }

    if (!empty($status)) {

		if (strlen($status) > 100000) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

	    preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status,$hashtag);
		
		 $tweet_id= $users->creates('tweets',array(
                        'status' => $status, 
                        'title_name' => $title_name, 
                        'tweet_image' => $donation_payment, 
                        'money_to_target' => $money_to_target, 
                        'youtube' => $youtube, 
                        'newsfeeds' => 'yes', 
                        'tweetBy' => $user_id, 
                        'posted_on' => date('Y-m-d H-i-s'),
                    ));

        if (!empty($hashtag)) {
			$home->addTrends($status,$tweet_id);
        }
        
        $home->addmention($status,$user_id,$tweet_id);
        
		if($tweet_id){
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
                    <strong>Fail input try again !!!</strong>
                </div>');
        }

  }

}else{
	# code...
	$user_id= $users->test_input($_POST['id_posts']);
	// $title_name= $users->test_input($_POST['title_name']);

    if (!empty($_POST['title_name'])) {
        $title_name= $users->test_input($_POST['title_name']);
    }else {
        $title_name= '';
    }

    if (!empty($_POST['youtube'])) {
        $tweet = $_POST['youtube'];
        if (strpos($tweet,'www.youtube.com/embed/') !== false) {

            $search = '/((https:\/\/)www\.youtube\.com\/embed\/\w+)/';
            $tweet= preg_replace($search,'<iframe width="100%" height="280" src="$0" frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                                </iframe><br>',$tweet);
        }

        if (strpos($tweet,'www.youtube.com/watch?v=') !== false) {

            $link = preg_split("!&!", $tweet);
            $tweet= preg_replace("!watch\?v=!", "embed/", $link[0]);
            $tweet= "<iframe width='100%' height='280' frameborder='0' src='" . $tweet ."'
            allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen>
            </iframe><br>";
        }

        $youtube= $tweet;
    
    }else {
        $youtube= '';
    }
    
	$status= $users->test_input($_POST['status']);
    $files= $_FILES['files'];

if (!empty($_POST['photo-Titleo0'])) {
        $photo_Titleo=  $users->test_input($_POST['photo-Titleo0']);
}else {
         $photo_Titleo='';
}
if (!empty($_POST['photo-Title0'])) {
        $photo_Title0=  $users->test_input($_POST['photo-Title0']);
}else {
         $photo_Title0='';
}
if (!empty($_POST['photo-Title1'])) {
        $photo_Title1=  $users->test_input($_POST['photo-Title1']);
}else {
         $photo_Title1='';
}
if (!empty($_POST['photo-Title2'])) {
        $photo_Title2=  $users->test_input($_POST['photo-Title2']);
}else {
         $photo_Title2='';
}
if (!empty($_POST['photo-Title3'])) {
        $photo_Title3=  $users->test_input($_POST['photo-Title3']);
}else {
         $photo_Title3='';
}
if (!empty($_POST['photo-Title4'])) {
       $photo_Title4=  $users->test_input($_POST['photo-Title4']);
}else {
         $photo_Title4='';
}
if (!empty($_POST['photo-Title5'])) {
       $photo_Title5=  $users->test_input($_POST['photo-Title5']);
}else {
         $photo_Title5='';
}
if (!empty($_POST['donation_payment'])) {
       $donation_payment=  $users->test_input($_POST['donation_payment']);
        $money_to_target= $users->test_input($_POST['money_to_target']);
}else {
        $donation_payment='';
        $money_to_target= '';
}

	if (!empty($status) || !empty(array_filter($files['name'])) ) {
		if (!empty($files['name'][0])) {
			# code...
			$tweetimages = $home->uploadPostsImage($files);
			$tweetSize = $home->uploadSize($files);
		}

		if (strlen($status) > 100000) {
			exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>The text is too long !!!</strong> </div>');
		}

        if (!empty($donation_payment) && !empty($tweetimages) ) {
            $equal=  '=';
        }else {
            $equal='';
        }
		preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag);
		
	 $tweet_id= $users->creates('tweets',array(
                        'status' => $status, 
                        'title_name' => $title_name, 
                        'tweetBy' => $user_id, 
                        'photo_Title_main'=> $photo_Titleo,
                        'photo_Title'=> $photo_Title0.'='.$photo_Title1.'='.$photo_Title2.'='.$photo_Title3.'='.$photo_Title4.'='.$photo_Title5,
                        'tweet_image' => $tweetimages, 
                        'tweet_image' => $tweetimages.$equal.$donation_payment, 
                        'youtube' => $youtube, 
                        'newsfeeds' => 'yes', 
                        'donation_payment' => $donation_payment, 
                        'money_to_target' => $money_to_target, 
                        'tweet_image_size' => $tweetSize, 
                        'posted_on' => date('Y-m-d H-i-s')
                    ));

        if (!empty($hashtag)) {
			# code...
			$home->addTrends($status,$tweet_id);
		}

		$home->addmention($status,$user_id,$tweet_id);

		if($tweet_id){
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
                    <strong>Fail input try again !!!</strong>
                </div>');
        }

	}

}

?>