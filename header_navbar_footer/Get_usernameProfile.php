<?php 
include "core/init.php";

if (isset($_GET['username']) == true && empty($_GET['username']) == false) {
    # code...
    $username= $users->test_input($_GET['username']);
    $uprofileId= $home->usersNameId($username);
	$profileData= $home->userData($uprofileId['user_id']);

   	if ($users->loggedin() == true) {
        $user_id= $_SESSION['key'];
        
        $jobs= $job->jobsData($_SESSION['key']);
        $fundraisingV= $fundraising->fundraisingData($_SESSION['key']);
        $crowfundV= $crowfund->crowfundraisingData($_SESSION['key']);
        $houseV= $house->houseData($_SESSION['key']);
        $carV= $car->carData($_SESSION['key']);
        $icyamunaraV= $icyamunara->icyamunaraData($_SESSION['key']);

		$notific= $notification->getNotificationCount($user_id);
		$notification->notificationsView($user_id);
	}else{
        $user_id= $profileData['user_id'];
        // $jobs= $home->jobsData($user_id);

	}

	$user= $home->userData($user_id);
	
    if (!isset($profileData['user_id'])) {
        # code...
        header('Location: '.LOGIN.'');
    }

}

else{

        # code...
        $username= $users->test_input('irangiro');
        $uprofileId= $home->usersNameId($username);
        $profileData= $home->userData($uprofileId['user_id']);

        if ($users->loggedin() == true) {
            $user_id= $_SESSION['key'];

            $jobs= $job->jobsData($_SESSION['key']);
            $fundraisingV= $fundraising->fundraisingData($_SESSION['key']);
            $crowfundV= $crowfund->crowfundraisingData($_SESSION['key']);
            $houseV= $house->houseData($_SESSION['key']);
            $carV= $car->carData($_SESSION['key']);
            $icyamunaraV= $icyamunara->icyamunaraData($_SESSION['key']);
            $saleV= $sale->saleData($_SESSION['key']);

            // $eventV= $home->eventsData($_SESSION['key']);
            // $blogV= $home->blogData($_SESSION['key']);

            $notific= $notification->getNotificationCount($user_id);
            $notification->notificationsView($user_id);

            if(empty($_SESSION["cart_item"])) {
                $productByCode = $users->runQuery("SELECT * FROM sale_watchlist WHERE user_id3_list= $user_id ");
                if (!empty($productByCode[0]["code_watchlist"])) {
                    # code...
                    $itemArray=[];
                    foreach($productByCode as $k => $v) {
                        # code...
                        $itemArray += array($productByCode[$k]["code_watchlist"]=>array(
                        'name'=>$productByCode[$k]["photo_Title_main_list"],
                        'code'=>$productByCode[$k]["code_watchlist"], 
                        'user_id'=>$productByCode[$k]["user_id3_list"],
                        'quantity'=>$productByCode[$k]["quantitys"], 
                        'price'=> $productByCode[$k]["price_watchlist"]/$productByCode[$k]["quantitys"],
                        'image'=>$productByCode[$k]["photo_list"],
                        'sale_id'=>$productByCode[$k]["sale_id_list"], 
                        'user_id01'=>$productByCode[$k]["user_id_owner_sale_list"], 
                        'categories'=>$productByCode[$k]["categories"],
                        'phone'=>$productByCode[$k]["phone"],
                        'seller_name'=>$productByCode[$k]["seller_name"],
                        ));
                    }
                    $_SESSION["cart_item"] = $itemArray;
                    // var_dump($itemArray);
                    // var_dump($_SESSION["like_cart_item"]);
                }
            }

        }else{
            $user_id= $profileData['user_id'];
        }

        $_SESSION['irangiro_key'] = 1;

        $user= $home->userData($user_id);
        
        if (!isset($profileData['user_id'])) {
            # code...
            header('Location: '.LOGIN.'');
        }

}

echo $sale->cart_item(); 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    