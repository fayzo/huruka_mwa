<?php 
include('../init.php');
// $users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['fetchPost']) && !empty($_POST['fetchPost'])) {
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    }else {
        # code...
        $user_id= $_SESSION['irangiro_key'];
    }
    $limit= (int) trim($_POST['fetchPost']);
    // echo  $limit;
    // $posts->tweets($user_id,$limit);
    // $posts_copy->tweets($user_id,$limit);
    $Posts_copyDraft->tweets($user_id,$limit);
}
?>
<script>
  $(document).ready(function(){

$(".regular").slick({
    dots: true,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
   {
     breakpoint: 1024,
     settings: {
      slidesToShow: 3,
      slidesToScroll: 3,
     }
   },
   {
     breakpoint: 700,
     settings: {
       slidesToShow: 2,
       slidesToScroll: 2
     }
   },
   {
     breakpoint: 480,
     settings: {
       slidesToShow: 2,
       slidesToScroll: 2
     }
   }
   ]
  });
  
$(".regular0").slick({
    dots: true,
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 2,
    responsive: [
   {
     breakpoint: 1024,
     settings: {
      slidesToShow: 2,
       slidesToScroll: 2,
     }
   },
   {
     breakpoint: 700,
     settings: {
       slidesToShow: 2,
       slidesToScroll: 2
     }
   },
   {
     breakpoint: 480,
     settings: {
       slidesToShow: 1,
       slidesToScroll: 1
     }
   }
   ]
  });
});
</script>