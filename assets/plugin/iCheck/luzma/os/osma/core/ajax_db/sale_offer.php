<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['sale']) && !empty($_POST['sale'])) {
      if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    }else {
        # code...
        $username= $users->test_input('irangiro');
        $uprofileId= $home->usersNameId($username);
        $profileData= $home->userData($uprofileId['user_id']);
        $user_id= $profileData['user_id'];
    }
    
    $sale_id = $_POST['sale'];
    $user= $sale->saleReadmore($sale_id);
     ?>
<style>
    	
        .demo .item{
            margin-bottom: 60px;
        }
		.content-slider li{
		    background-color: #ed3020;
		    text-align: center;
		    color: #FFF;
		}
		.content-slider h3 {
		    margin: 0;
		    padding: 70px 0;
		}
		.demo{
			width: 800px;
		}
</style>
<div class="sale-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
           <div class="img-popup-wrap"  id="popupEnd">

        	<div class="img-popup-body">

            <div class="card">
                <div class="card-header">
                   <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                </div>
                <div class="card-body">
                 <div class="row reusercolor p-2 mb-2">

                        <div class="col-md-6 mb-2">
                         <h2 class='text-center'><?php echo $user['title']; ?></h2>
                            <div class="clearfix" style="max-width:474px;">
                                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                <?php 
                                        $file = $user['photo']."=".$user['other_photo'];
                                        $expode = explode("=",$file);
                                        // $splice = array_expode ($expode,0,10);
                                        for ($i=0; $i < count($expode); ++$i) { 
                                            ?>
                                            <li data-thumb="<?php echo BASE_URL_PUBLIC.'uploads/sale/'.$expode [$i]; ?>" > 
                                               <img src="<?php echo BASE_URL_PUBLIC.'uploads/sale/'.$expode [$i]; ?>" />
                                            </li>
                                      <?php } ?>
                                </ul>
                            </div>  

                               
                       </div> <!-- col-md-6  -->
                       <div class="col-md-6 mb-2">

                            <h4 class="mt-2"><i>Personal Info</i></h4>

                            <div><i class="h5"> Seller: <?php echo $user['seller_name']; ?></i>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="btn-sm btn-primary people-message more"'; }else{ echo 'class="more" id="login-please"  data-login="1"'; } ?> data-user="<?php echo $user['user_id'];?>"><i class="fa fa-envelope-o"></i> Message </span><br>
                            </div>

                            <div class="b">
                            Location: 
                            <?php echo $user['provincename']."/".$user['namedistrict']."/".$user['namesector']."/".$user['nameCell']; ?></div>
                            <div class="mb-2">
                                <span>Phone: <?php echo $user['phone']; ?></span><br>
                                <span>Price: <?php echo number_format($user['price'])." Frw"; ?></span><br>
                            </div>
                         
                            <h4 class="mt-2 text-center"><i>Details of Items</i></h4>
                             <div>
                                    <?php echo $user['text']; ?>
                             </div>
                            <form action="" method="post" class="retweetcolor">
                            <table class="table table-hover table-inverse" style="background-color:#0000000d;">
                                    <tbody>
                                        <tr>
                                            <td>Price: </td>
                                            <td class="float-right">  <?php if($user['price_discount'] != 0){ ?><span class="text-danger " style="text-decoration: line-through;"><?php echo number_format($user['price_discount']); ?> Frw</span> <?php } ?> <span class="ml-3 text-primary"><?php echo number_format($user['price']) ." Frw"; ?></span></td>
                                        </tr>
                                       
                                        <tr>
                                            <td></td>
                                            <td><button type="button" class="btn btn-primary float-right" <?php if(isset($_SESSION['key'])){ echo ' onclick="cart_add(\'add\',\'form-cartitem'.$user['code'].'add\',\''.$user['code'].'\',\''.$user_id.'\');" '; }else{ echo 'id="login-please"  data-login="1"'; } ?> >add to cart</button></td>
                                        </tr>
                                    </tbody>
                            </table>
                            </form>

                            <div><span class="font-weight-bold"> Shipping:</span> 
                            <ul>
                                <li>it depend your location and agreement between seller and buyer</li> 
                                <!-- <li>it depend your location mininmun shipping 3000 Frw only in Rwanda</li>  -->
                             </ul></div>
                            <div><span class="font-weight-bold">Payments:</span> 
                             <ul>
                                <li>you pay after receive items </li>
                                <!-- <li>Mtn money | Airtel money</li> -->
                             </ul></div>
                            <div><span class="font-weight-bold">Returns:</span> Sellers accept returns items if it has problem within 3 days used</div>
                           
                           
                            <div class="p-2">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text btn btn-default" onclick="copyText()" data-toggle="tooltip" title="Contacts" data-original-title="Contacts" id="basic-addon2">Copy Link</button>
                                    </div>
                                    <input type="text" id="mycopyText" style="width:1px" class="form-control" value="<?php echo BASE_URL_PUBLIC."sales?id=".$_POST['sale'];?>" readonly>
                                </div>
            
                                <a class="btn btn-sm btn-primary mt-2" href="<?php echo BASE_URL_PUBLIC."sales?id=".$_POST['sale'];?>"> Redirect to link</a>
            
                                <script>
                                    function copyText() {
                                        var copyText = document.getElementById('mycopyText');
                                        copyText.select();
                                        copyText.setSelectionRange(0,99999);
                                        document.execCommand('copy');
                                        alert('Copied a Url link: ' + copyText.value);
                                        // alert('Copied a Url link: ' + copyText.innerHTML);
                                        // alert('Copied a Url link: ' + copyText.childNodes[0].nodeValue);
                                    }
                                </script>
            
                            </div>

                       </div><!-- /.col -->

                                 
                <?php 
                        $expodefile = explode("=",$user['photo']."=".$user['other_photo']); 
                        $title= $user['photo_Title_main']."=".$user["photo_Title"];
                        $photo_title=  explode("=",$title);

                        $fileActualExt= array();
                        for ($i=0; $i < count($expodefile); ++$i) { 
                            $fileActualExt[]= strtolower(substr($expodefile[$i],strrpos($expodefile[$i],'.')+1));
                        }
                        $image= array('jpg','jpeg','png','gif'); // valid extensions
                        $allower_ext= array('jpg','jpeg','png','gif'); // valid extensions

                    if (array_diff($fileActualExt,$allower_ext) == false) { 
                            # code...
                                
                            $fileActualExt_image =array_intersect($fileActualExt,$image);
                            $count_image =count(array_intersect($fileActualExt_image,$image));
                            $filePathinfo_image=array();

                            
                    if(!empty($fileActualExt_image)) { 
                            
                        foreach ($expodefile as $file_image) {
                            # code...
                            $filePathinfo = pathinfo($file_image);

                            if (in_array($filePathinfo['extension'],$fileActualExt_image)) {
                                # code...
                                $filePathinfo_image[]= $filePathinfo['basename'];
                            }
                        }

                    if ($count_image === 1) { ?>

                        <div class="row mb-1">
                                <?php $expode = $filePathinfo_image; ?>
                            <div class="col-12 more">
                                <img style="width: 100%;height: auto;" class="imagesaleViewPopup more"  data-sale="<?php echo $user["sale_id"] ;?>"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/sale/".$expode[0] ;?>" >
                                    <div class="h5"><i><?php echo $photo_title[0]; ?></i></div>
                            </div>
                        </div>

                    <?php
                        }else if($count_image === 2){?>
                        <div class="row mb-2 more">
                                <?php $expode = $filePathinfo_image;
                                    $splice= array_splice($expode,0,2);
                                    for ($i=0; $i < count($splice); ++$i) { 
                                    ?>
                            <div class="col-sm-12 col-md-6">
                                <img style="width: 100%;height: auto;" class="imagesaleViewPopup more"  data-sale="<?php echo $user["sale_id"] ;?>"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/sale/".$splice[$i] ;?>" >
                                    
                                    <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                            </div>
                                <?php }?>
                        </div>

                    <?php }else if($count_image === 3 || $count_image > 3){?>
                        <div class="row mb-2 more">
                            <?php $expode = $filePathinfo_image;
                                $splice= array_splice($expode,0,1);
                                ?>
                        <div class="col-6">
                            <img style="width: 100%;height: auto;" class="imagesaleViewPopup more"  data-sale="<?php echo $user["sale_id"] ;?>"
                                src="<?php echo BASE_URL_PUBLIC."uploads/sale/".$splice[0] ;?>" >
                                <div><i><?php echo $photo_title[0]; ?></i></div>
                        </div>
                        <!-- /.col -->

                        <div class="col-6">
                            <div class="row mb-2 more">
                                    <?php 
                                    $expode = $filePathinfo_image;
                                    // var_dump($expode);
                                    $splice= array_splice($expode,1,2);
                                    // var_dump($splice);
                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                <div class="col-6">
                                    <img style="width: 100%;height: auto;" class="imagesaleViewPopup more"  data-sale="<?php echo $user["sale_id"] ;?>"
                                        src="<?php echo BASE_URL_PUBLIC."uploads/sale/".$splice[$i] ;?>" >
                                     <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                
                                </div>
                                    <?php }?>

                            </div>
                            <!-- /.row -->
                            <div class="row more">
                                    <?php 
                                    $expode = $filePathinfo_image;
                                    $splice= array_splice($expode,3,2);
                                        for ($i=0; $i < count($splice); ++$i) { ?>
                                <div class="col-6">
                                   <img style="width: 100%;height: auto;" class="imagesaleViewPopup more"  data-sale="<?php echo $user["sale_id"] ;?>"
                                        src="<?php echo BASE_URL_PUBLIC."uploads/sale/".$splice[$i] ;?>" >
                                        
                                        <div class="h5"><i><?php echo $photo_title[$i]; ?></i></div>
                                
                                </div>
                                    <?php }?>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    
                        <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <span class="btn btn-primary imagesaleViewPopup  float-right" data-sale="<?php echo $user["sale_id"] ;?>" > View More photo  <i class="fa fa-picture-o"></i> >>> </span>
                        </div>
                    </div>
                    <!-- /.row -->
                        
                    <?php }  } } ?>
                    

                </div><!-- card-body -->
                <div class="card-footer text-center">
                      <p class="mb-1"><?php echo $users->copyright(2018); ?></p>
                </div>
            </div>

           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

  <script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
		});
    </script>
<?php } 

if (!empty($_REQUEST['checkout'])) {
     $get_province = mysqli_query($db,"SELECT * FROM provinces");   
    ?>
    <div class="container bg-light">
        <div class="row mb-3 pt-3">
            <div class="col-md-12">
                <input type="text" class="form-control" placeholder="name">
            </div>
        </div>
        <div class="row mb-2 pb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="address">
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" placeholder="phone">
            </div>
        </div>
        <button type="button" name="proceed-of-payment" onclick="paymentSale('payment');" class="btnRemoveAction btn-primary float-right">proceed of payment</button>
    </div>
<?php } 

if (!empty($_REQUEST['payment'])) {
    ?>
    <div class="container bg-light">
    <h4 class="mb-3" style="text-decoration: underline;">Billing address</h4>
        <hr class="mb-2">
        <div class="row mb-2 p-3">

            <div>
                <span class="font-weight-bold"> Shipping:</span> 
            <ul>
                <li>it depend your location and agreement between seller and buyer</li> 
                </ul></div>
            <div><span class="font-weight-bold">By pick your items by yoursef :</span>
                <!-- <ul>
                <li> Gasabo districts</li>
                </ul> -->
                </div> 
            <div><span class="font-weight-bold">Payments:</span> 
                <ul>
                <li>you pay after receive items </li>
                <li>Mtn money | Airtel money </li>
                </ul></div> 
            <div><span class="font-weight-bold">Returns:</span> Sellers accept returns items within 3 days only </div>

        </div>
        <a href="<?php echo WATCHLIST ;?>" class="btnRemoveAction btn btn-primary float-right">GO TO Watchlist</a>
        <!-- <button type="button" name="submit-of-payment" id="submit-of-payment" class="btnRemoveAction btn-primary float-right">submit of payment</button> -->
    </div>
<?php } 