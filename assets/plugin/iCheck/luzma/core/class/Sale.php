<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Sale extends Home{

    public function cart_item(){

        $mysqli= $this->database;
        $db_handle = $mysqli;
        if(!empty($_REQUEST["action"])) {
        switch($_REQUEST["action"]) {
        	case "add":
        		if(!empty($_REQUEST["quantity"])) {
        			$productByCode = $this->runQuery("SELECT * FROM sale WHERE code='" . $_REQUEST["code"] . "'");
        			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["title"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_REQUEST["quantity"],
                     'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["photo"] ,'sale_id'=>$productByCode[0]["sale_id"] ,'seller_name'=>$productByCode[0]["seller_name"],
                    'phone'=>$productByCode[0]["phone"],'user_id'=>$_REQUEST["user_id"],'user_id01'=>$productByCode[0]["user_id01"],'categories'=>$productByCode[0]["categories_sale"]));
        			
        			if(!empty($_SESSION["cart_item"])) {    
        				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
        					foreach($_SESSION["cart_item"] as $k => $v) {
        							if($productByCode[0]["code"] == $k) {
        								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
        									$_SESSION["cart_item"][$k]["quantity"] = 0;
        								}
        								$_SESSION["cart_item"][$k]["quantity"] += $_REQUEST["quantity"];
        							}
        					}
        				} else {
                            foreach($itemArray as $k => $v) {
                                // var_dump($itemArray[$k]["food_id"],$itemArray[$k]["code"]);
                                $this->insertQuery('sale_watchlist',array(
                                    'sale_id_list' => $itemArray[$k]["sale_id"], 
                                    'user_id_owner_sale_list' => $itemArray[$k]["user_id01"], // owner of sale
                                    'user_id3_list' => $itemArray[$k]["user_id"],  // user of watchlist
                                    'code_watchlist' => $itemArray[$k]["code"],  
                                    'categories'=> $itemArray[$k]["categories"],  
                                    'phone'=>$itemArray[$k]["phone"],
                                    'seller_name'=>$itemArray[$k]["seller_name"],

                                    'photo_Title_main_list'=> $itemArray[$k]["name"],  
                                    'photo_list'=> $itemArray[$k]["image"],  
                                    'quantitys'=> $itemArray[$k]["quantity"],  
                                    'unit_price'=> $itemArray[$k]["price"],  
    
                                    'price_watchlist'=> $itemArray[$k]["price"],  
                                    'status_sale' => '0',
    
                                ));  
                            }
        					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        				}
        			} else {
                        foreach($itemArray as $k => $v) {
                            // var_dump($itemArray[$k]["food_id"],$itemArray[$k]["code"]);
                            $this->insertQuery('sale_watchlist',array(
                                'sale_id_list' => $itemArray[$k]["sale_id"], 
                                'user_id_owner_sale_list' => $itemArray[$k]["user_id01"], // owner of sale
                                'user_id3_list' => $itemArray[$k]["user_id"],  // user of watchlist
                                'code_watchlist' => $itemArray[$k]["code"],  
                                'categories'=> $itemArray[$k]["categories"],  
                                'phone'=>$itemArray[$k]["phone"],
                                'seller_name'=>$itemArray[$k]["seller_name"],
                                
                                'photo_Title_main_list'=> $itemArray[$k]["name"],  
                                'photo_list'=> $itemArray[$k]["image"],  
                                'quantitys'=> $itemArray[$k]["quantity"],  
                                'unit_price'=> $itemArray[$k]["price"],  

                                'price_watchlist'=> $itemArray[$k]["price"],  
                                'status_sale' => '0',

                            ));  
                        }
        				$_SESSION["cart_item"] = $itemArray;

        			}
            }
             exit($this->showCart_itemSale());
        	break;
        	case "remove":
                $productByCode = $this->runQuery("SELECT * FROM sale_watchlist WHERE code_watchlist='" . $_REQUEST["code"] . "' AND user_id3_list='" . $_REQUEST["user_id"] . "'");
                $itemArray = array($productByCode[0]["code_watchlist"]=>array('sale_watchlist_id'=>$productByCode[0]["sale_watchlist_id"], 'code'=>$productByCode[0]["code_watchlist"]));

        		if(!empty($_SESSION["cart_item"])) {
        			foreach($itemArray as $k => $v) {

                            $this->delete('sale_watchlist',array(
                                'sale_watchlist_id' =>  $itemArray[$k]["sale_watchlist_id"], 
                            ));

        					if($_REQUEST["code"] == $k)
        						unset($_SESSION["cart_item"][$k]);				
        					if(empty($_SESSION["cart_item"]))
        						unset($_SESSION["cart_item"]);
        			}
                }

            exit($this->showCart_itemSale());
        	break;

        	case "empty":
        		unset($_SESSION["cart_item"]);
        	break;	
        }
        }
        if(!empty($_REQUEST["action0"])) {
            switch($_REQUEST["action0"]) {
                case "remove":
                    $productByCode = $this->runQuery("SELECT * FROM sale_watchlist WHERE code_watchlist='" . $_REQUEST["code"] . "' AND user_id3_list='" . $_REQUEST["user_id"] . "'");
                    $itemArray = array($productByCode[0]["code_watchlist"]=>array('sale_watchlist_id'=>$productByCode[0]["sale_watchlist_id"], 'code'=>$productByCode[0]["code_watchlist"]));

                    if(!empty($_SESSION["cart_item"])) {
                        foreach($itemArray as $k => $v) {

                                $this->delete('sale_watchlist',array(
                                    'sale_watchlist_id' =>  $itemArray[$k]["sale_watchlist_id"], 
                                ));

                                if($_REQUEST["code"] == $k)
                                    unset($_SESSION["cart_item"][$k]);				
                                if(empty($_SESSION["cart_item"]))
                                    unset($_SESSION["cart_item"]);
                        }
                    }
                exit($this->showCart_item());
                break;
                case "empty":
                    $this->delete('sale_watchlist',array(
                         'user_id3_list' => $_REQUEST["user_id"]
                    ));
                    unset($_SESSION["cart_item"]);
                exit($this->showCart_item());
                break;	
            }
        }
    }

    public function checkout(){ 
     
    }

    public function categories_sale($categories_sale)
    {
        $mysqli= $this->database;
        $query = $mysqli->query("SELECT * FROM users U Left JOIN sale S ON S. user_id01 = U. user_id WHERE S. categories_sale = '{$categories_sale}' ORDER BY created_on01 Desc ");
        
        while($row=$query->fetch_assoc()) {
        ?>
                <div class="ml-1 mb-3 float-left" style="width: 252px;">

                  <div class="card">
                    <div width="252px" height="178px"><img src="<?php echo BASE_URL_PUBLIC."uploads/sale/".$row["photo"]; ?>" width="252px" height="178px" ></div>
                      <div class="card-body">
                          <div class="card-title"><?php echo $row["title"]; ?></div> <!-- product-title -->
                          <p class="card-text product-price"><?php echo "$".$row["price"]; ?></p>
                          <form method="post" action="sale.php?action=add&code=<?php echo $row["code"]; ?>">
               	      	  <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" readonly/><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                          </form>
                      </div><!-- card-body -->
                  </div><!-- card -->

                </div><!-- col -->
    <?php }
    }

// background-image:url('../images/bg.png');
// background-repeat:no-repeat;
// background-size:contain;
// background-position:center;
// background-size: 100%;
// background-size:cover;

     public function cartList($categories,$pages,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*9)-9;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U 
        Left JOIN sale S ON S. user_id01 = U. user_id 
        Left JOIN sale_watchlist W ON S. sale_id = W. sale_id_list 
        WHERE S. categories_sale = '{$categories}' 
        ORDER BY created_on01 Desc Limit $showpages,9");
        ?>
        <div class="mb-3 ">
          <?php 
        		// unset($_SESSION["foodcart_item"]);
               //    echo var_dump($_SESSION["foodcart_item"]);
           ?>

         <div class="card-header main-active p-1">
            <h5 class="card-title text-center"><i> Items to Search</i></h5>

            <div class="nav-scroller  py-0" style="clear:right;height:2rem;">
                <nav class="nav d-flex justify-content-between pb-0">
                <a class="p-2 text-light active" href="javascript:void(0)" data-toggle="tab" role="tab" onclick="cartItemsCategories('electronics',1,<?php echo $user_id ;?>);">Electronics<span class="badge badge-primary"><?php echo $this->cartcountPOSTS('electronics');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cartItemsCategories('arts',1,<?php echo $user_id ;?>);">Arts<span class="badge badge-primary"><?php echo $this->cartcountPOSTS('arts');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cartItemsCategories('clothes',1,<?php echo $user_id ;?>);">Clothes<span class="badge badge-primary"><?php echo $this->cartcountPOSTS('clothes');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cartItemsCategories('sports',<?php echo $user_id ;?>);">Sports<span class="badge badge-primary"><?php echo $this->cartcountPOSTS('sports');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cartItemsCategories('health_beauty',<?php echo $user_id ;?>);">Health Beauty<span class="badge badge-primary"><?php echo $this->cartcountPOSTS('health_beauty');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cartItemsCategories('home_garden',<?php echo $user_id ;?>);">Home Garden<span class="badge badge-primary"><?php echo $this->cartcountPOSTS('home_garden');?></span></a>
                </nav>
            </div> <!-- nav-scroller -->
        </div> <!-- card-header -->

        <div>
        <span class="job-show"></span>
        <div class="job-hide">
            
        <?php if ($query->num_rows > 0) { ?>

                <div>
                    <span> <img src="<?php echo BASE_URL_LINK.'image/banner/discount.png' ;?>" width="80px"> </span>
                    <?php switch ($categories) {
                        case $categories :
                            # code...
                            echo '
                            <img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                            ';
                            // <img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                            break;
                        
                    } ?>
                </div>

            <div class="row">
                
                <?php while($row= $query->fetch_array()) { ?>
                    <div class="col-6 col-md-3 col-lg-3 mb-3 pr-0">
                         <!-- <div class="mr-3 mb-3 float-left" style="width: 260px;height:276px;"> -->
                        <!-- //   width: 252px;height:178px -->
                         <!-- <div class="col-md-3"> -->

                          <div class="card">
                             <!-- <div class="card-img-top img-fuild" id="sale_gurishaPreview< ?php echo $row['sale_id']; ?>" style="background: url('< ?php echo BASE_URL_PUBLIC ;?>uploads/sale/< ?php echo $row["photo"]; ?>')no-repeat center center;background-size:contain;height:178px;width:260px;position:relative" > -->
                                <div class="card-img-top img-fuild" id="sale_gurishaPreview<?php echo $row['sale_id']; ?>" >
                                    <?php echo $this->bannerDiscountSale($row['banner']); ?>
                                    <img class="sale-pic-responsive" src="<?php echo BASE_URL_PUBLIC."uploads/sale/".$row["photo"]; ?>">
                                </div>
                              <div class="card-body">
                                 <div id="response<?php echo $row['sale_id']; ?>"></div>

                                  <div class="card-title">
                                   <?php 
                                    if (strlen($row["title"]) > 30) {
                                    echo $row["title"] = substr($row["title"],0,30).'... ';
                                    }else{
                                    echo $row["title"];
                                    } ?>

                                    <!-- delete -->
                                    <?php 
                                    if(isset($_SESSION['key']) && $user_id == $row['user_id01']){ 
                                        echo $this->Edit_sale($user_id,$row['user_id01'],$row); 
                                    } ?>
                                    <!-- delete -->

                                     <?php if($row['discount'] != 0){ ?>
                                          <span class="float-right text-danger"><?php echo $row["discount"]; ?>%</span>
                                     <?php } ?>

                                  </div> <!-- product-title -->
                                  <div class="card-text product-price d-inline-block"> 
                                    <?php if($row['price_discount'] != 0){ ?><span class="text-danger " style="text-decoration: line-through;"><?php echo number_format($row['price_discount']); ?> Frw</span> <?php } ?> 
                                   <div> <?php echo number_format($row["price"])." Frw"; ?> </div>
                                  </div>

                                  <?php if(isset($_SESSION['key'])){ if($row['user_id3_list'] != $user_id && $row['sale_id_list'] != $row['sale_id']  ){ ;?>

                                   <form method="post" id="form-cartitem<?php echo $row['code']; ?>add" class="float-right">
                                      <div class="cart-action">
                                          <input type="hidden" style="width:30px;" name="action" value="add" />
                                          <input type="hidden" style="width:30px;" name="code" value="<?php echo $row['code']; ?>" />
                                          <input type="text" class="product-quantity" style="width:30px;" name="quantity" value="1" size="2" readonly/>
                                          <input type="button" value="Add to Cart" class="btnAddAction offer-price-sale" data-sale="<?php echo $row['sale_id']; ?>"/>
                                          <!-- <input type="button" onclick="cart_add('add','< ?php echo 'form-cartitem'.$row['code'].'add'; ?>','< ?php echo $row['code']; ?>');" value="Add to Cart" class="btnAddAction" /> -->
                                      </div>
                                  </form>

                                    <?php }else{ ;?>

                                    <form method="post" id="form-cartitem<?php echo $row['code']; ?>add" class="float-right">
                                        <div class="cart-action">
                                            <input type="button" value="Remove" class="btn btn-danger"  onclick="cart_add('remove','<?php echo 'form-cartitem'.$row['code'].'remove'; ?>','<?php echo $row['code']; ?>',<?php echo $row['user_id']; ?>);" />
                                        </div>
                                    </form>

                                    <?php } }else{ ?>

                                   <form method="post" id="form-cartitem<?php echo $row['code']; ?>add" class="float-right">
                                      <div class="cart-action">
                                          <input type="hidden" style="width:30px;" name="action" value="add" />
                                          <input type="hidden" style="width:30px;" name="code" value="<?php echo $row['code']; ?>" />
                                          <input type="text" class="product-quantity" style="width:30px;" name="quantity" value="1" size="2" readonly/>
                                          <input type="button" value="Add to Cart" class="btnAddAction offer-price-sale" data-sale="<?php echo $row['sale_id']; ?>"/>
                                          <!-- <input type="button" onclick="cart_add('add','< ?php echo 'form-cartitem'.$row['code'].'add'; ?>','< ?php echo $row['code']; ?>');" value="Add to Cart" class="btnAddAction" /> -->
                                      </div>
                                    </form>

                                    <?php } ;?>

                              </div><!-- card-body -->
                          </div><!-- card -->

                         <!-- </div> -->
                         <!-- float-left -->
                           <!-- </div> -->
                        </div>

                    <?php } ?>    
                    
                </div>
                <?php }else{

                     echo ' <div class="col-md-12 col-lg-12 mt-2"><div class="alert alert-danger alert-dismissible fade show text-center">
                                <button class="close" data-dismiss="alert" type="button">
                                    <span>&times;</span>
                                </button>
                                <strong>No Record</strong>
                            </div></div>'; 
                } ?>
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

        <?php 
                    
        $query1= $mysqli->query("SELECT COUNT(*) FROM sale WHERE categories_sale ='$categories' ");
        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/9;
        $post_Perpage = ceil($post_Perpages);

        if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>,<?php echo $user_id; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>,<?php echo $user_id; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 
    }

      public function cartcountPOSTS($categories)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM sale WHERE categories_sale ='$categories' ");
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

    public function showCart_item(){

        if(isset($_SESSION["cart_item"])){
                $total_quantity = 0;
                $total_price = 0;
            ?>	
            <table class="tbl-cart table table-responsive-sm table-hover table-bordered"  cellpadding="10" cellspacing="1">
            <thead class="main-active">
            <tr>
            <th style="text-align:left;">Name</th>
            <th style="text-align:left;">Items</th>
            <th style="text-align:left;">view</th>
            <th style="text-align:left;">Seller Details</th>
            <th style="text-align:right;" width="5%">Quantity</th>
            <th style="text-align:right;" width="10%">Unit Price</th>
            <th style="text-align:right;" width="10%">Price</th>
            <th style="text-align:center;" width="5%">Remove</th>
            </tr>	
             </thead>
            <tbody class="bg-light">
            <?php		
                foreach ($_SESSION["cart_item"] as $item){
                    $item_price = $item["quantity"]*$item["price"];
            		?>
            				<tr>
                            <td style="background: url('<?php echo BASE_URL_PUBLIC ;?>uploads/sale/<?php echo $item["image"]; ?>')no-repeat center center;background-size:contain;height:80px;width:80px;position:relative">
                            </td>
            				<!-- <td><img src="< ?php echo BASE_URL_PUBLIC ;?>uploads/sale/< ?php echo $item["image"]; ?>" class="cart-item-image" />< ?php echo $item["name"]; ?></td> -->
            				<td><?php echo $item["name"]; ?></td>
            				<td><button type="button" class="btn btn-primary offer-price-sale" data-sale="<?php echo $item['sale_id']; ?>">view</button></td>
            				<td>
                                <div>Seller: <?php echo $item["seller_name"]; ?></div>
                                <div>Phone: <?php echo $item["phone"]; ?></div>
                                <div>
                                <span class="btn-sm btn-success people-message more" data-user="<?php echo $item['user_id01'];?>">
                                    <i class="fa fa-envelope-o"></i> Message 
                                </span>
                                </div>

                            </td>
            				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
            				<td  style="text-align:right;"><?php echo "Frw ".number_format($item["price"]); ?></td>
            				<td  style="text-align:right;"><?php echo "Frw ". number_format($item_price); ?></td>
            				<td style="text-align:center;"><a href="javascript:void(0);" onclick="cart_sale_add('remove','<?php echo $item['code']; ?>',<?php echo $item['user_id']; ?>);" class="btnRemoveAction"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a></td>
            				<!-- <td style="text-align:center;"><a href="sale.php?action=remove&code=< ?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="< ?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a></td> -->
            				</tr>
            				<?php
            				$total_quantity += $item["quantity"];
            				$total_price += ($item["price"]*$item["quantity"]);
            		}
            		?>
            
            <tr>
            <td colspan="3" align="left">Total:</td>
            <td colspan="2" align="right"><?php echo $total_quantity; ?></td>
            <td align="right" colspan="3"><strong><?php echo "Frw ".number_format($total_price); ?></strong></td>
            <!-- <td></td> -->
            </tr>
            </tbody>
            </table>	
              <?php
            } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
            } 
	}
	
    public function showCart_itemSale(){

        if(isset($_SESSION["cart_item"])){
                $total_quantity = 0;
                $total_price = 0;
            ?>	
            <table class="table table-responsive-sm table-hover table-bordered" >
             <thead class="main-active">
               <tr>
               <th style="text-align:center;">Products</th>
               <th style="text-align:center;">Price</th>
               <th style="text-align:center;">Remove</th>
			   </tr>	
			 </thead>
             <tbody class="bg-light">
            <?php		
                foreach ($_SESSION["cart_item"] as $item){
                    $item_price = $item["quantity"]*$item["price"];
            		?>
                     <tr>
                     <!-- <td style="position:relative;text-align:center;">
                     <img src="< ?php echo BASE_URL_PUBLIC ;?>uploads/sale/< ?php echo $item["image"]; ?>" height='80px' > -->
                     <td style="background: url('<?php echo BASE_URL_PUBLIC ;?>uploads/sale/<?php echo $item["image"]; ?>')no-repeat center center;background-size:contain;height:80px;width:80px;position:relative">
                    <div style="position:absolute;bottom:0px;left:0px;background-color:#0000006e;color:white;width: 100%;"><?php
                    if (strlen($item["name"]) > 12) {
                      echo $item["name"] = substr($item["name"],0,12).'..';
                    }else{
                      echo $item["name"];
                    } ?></div>
                    </td>
            				<td align="right"><?php echo "Frw ". number_format($item_price); ?></td>
            				<td align="center">
                               <form method="post" id="form-cartitem<?php echo $item['code']; ?>remove" >
                                        <input type="hidden" style="width:30px;" name="action" value="remove" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $item['code']; ?>" />
                                        <a href="javascript:void(0);" onclick="cart_add('remove','<?php echo 'form-cartitem'.$item['code'].'remove'; ?>','<?php echo $item['code']; ?>',<?php echo $item['user_id']; ?>);"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> 
                                </form>
                    </td>
            				
                    </tr>
            				<?php
            				$total_quantity += $item["quantity"];
            				$total_price += ($item["price"]*$item["quantity"]);
            		}
            		?>
            
            <tr>
            <td>Total:</td>
            <td align="left" colspan="2" ><strong><?php echo "Frw ".number_format($total_price); ?></strong></td>
            </tr>
            </tbody>
            </table>	
            <div id="responseCheckout">
              <!-- <input type="button" name="checkout" id="checkout" onclick="checkout('checkout');" value="Go To Checkout" class="btnRemoveAction btn-primary float-right" >	 -->
              <input type="button" name="checkout" id="checkout" onclick="paymentSale('payment');" value="Go To Checkout" class="btnRemoveAction btn-primary float-right" >	
            </div>
            <?php
            } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
            } 
    }

     public function update_sale($banner,$title,$available,$discount_change,$discount_price,$price,$sale_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE sale SET title= '$title', banner= '$banner', buy = '$available', discount = $discount_change ,price_discount = $discount_price, price = $price WHERE sale_id= $sale_id ";
        $mysqli->query($query);

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center" style="font-size:12px;padding:2px;">
                    <button class="close" data-dismiss="alert" type="button" style="top:-6px;">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:12px;padding:2px;">
                    <button class="close" data-dismiss="alert" type="button"  style="top:-6px;">
                        <span>&times;</span>
                    </button>
                    <strong>Fail to Edit !!!</strong>
                </div>');
        }
    }

      public function sale_getPopupTweet($user_id,$sale_id,$car_user_id)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN sale B ON B. user_id01 = U. user_id WHERE B. sale_id = $sale_id AND B. user_id01 = $car_user_id ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }
      
    public function deleteLikesSale($sale_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE FROM sale WHERE sale_id = $sale_id and user_id01= '{$user_id}' ";

        $query1="SELECT * FROM sale WHERE sale_id = $sale_id and user_id01= '{$user_id}' ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'].'='.$rows['other_photo'];
            $expodefile = explode("=",$photo);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$photo);
                $uploadDir = DOCUMENT_ROOT.'/uploads/sale/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/sale/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/sale/';
                      unlink($uploadDir.$photo);
            }
        }

        $query= $mysqli->query($query);
        // var_dump("ERROR: Could not able to execute $query.".mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS DELETE</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail to delete !!!</strong>
                </div>');
        }
    }

    
       public function saleReadmore($sale_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN sale H ON H. user_id01 = U. user_id 
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
        WHERE H. sale_id = '$sale_id' ");
        $row= $query->fetch_array();
        return $row;
    }
    
       public function Edit_sale($user_id,$sale_id3,$row)
    {
        ?>
            <ul class="list-inline ml-2  float-right" style="list-style-type: none;">  

                    <li  class=" list-inline-item">
                        <ul class="showcartButt" style="list-style-type: none; margin:0px;" >
                            <li>
                                <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <ul style="list-style-type: none; margin:0px; margin:0px;width:250px;text-align:center;" >
                                    <li style="list-style-type: none; margin:0px;"> 
                                        <label class="delete-sale"  data-sale="<?php echo $row["sale_id"];?>"  data-user="<?php echo $row["user_id01"];?>">Delete </label>
                                    </li>

                                    <li style="list-style-type: none;"> 
                                    <label for="title">
                                    <div class="form-row">
                                        <div class="col">
                                                title
                                            <div class="input-group">
                                                <input  type="text" class="form-control form-control-sm" name="title" id="title<?php echo $row["sale_id"];?>" value="<?php echo $row["title"];?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0px 10px;"
                                                        aria-label="Username" aria-describedby="basic-addon1" ><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                                </div>
                                            </div> <!-- input-group -->
                                        </div>
                                    </div>
                                    </label>
                                    </li>
                                    
                                    <li style="list-style-type: none; margin:0px;"> 
                                    <label >photo
                                        <form action="<?php echo BASE_URL_PUBLIC;?>core/ajax_db/sale_delete.php" method="post" id="form-photo<?php echo $row["sale_id"];?>" enctype="multipart/form-data">
                                            <input type="hidden" name="sale_id" value="<?php echo $row["sale_id"];?>">
                                            <input type="file" class="form-control-file" name="update-form-sale" id="update-form-sale" data-sale="<?php echo $row["sale_id"];?>"> <br>
                                        </form>
                                    </label>
                                    </li>

                                    <li style="list-style-type: none; margin:0px;"> 
                                    <label for="">
                                    <div class="form-row">
                                        <div class="col">
                                                Banner
                                                <div class="input-group">
                                                        <select class="form-control" name="banner" id="banner<?php echo $row["sale_id"];?>">
                                                        <option value="<?php echo $row['banner']; ?>" selected><?php echo $row['banner']; ?></option>
                                                        <option value="new">New</option>
                                                        <option value="new_arrival">New arrival</option>
                                                        <option value="great_deal">Great deal</option>
                                                        <option value="empty">empty</option>
                                                        </select>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >banner</span>
                                                    </div>
                                                </div> <!-- input-group -->
                                        </div>
                                    </div>
                                    </label>
                                    </li>

                                    <li style="list-style-type: none; margin:0px;"> 
                                    <label for="">
                                    <div class="form-row">
                                        <div class="col">
                                                Sale
                                                <div class="input-group">
                                                        <select class="form-control" name="available" id="available<?php echo $row["sale_id"];?>">
                                                        <?php if ($row['buy'] == 'available') { ?>
                                                        <option value="available" selected>Available</option>
                                                        <option value="sold">Sold</option>
                                                        <option value="empty">empty</option>
                                                        <?php }else { ?>
                                                        <option value="sold" selected>Sold</option>
                                                        <option value="available">Available</option>
                                                        <option value="empty">empty</option>
                                                        <?php } ?>
                                                        </select>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >sale</span>
                                                    </div>
                                                </div> <!-- input-group -->
                                            </label>
                                        </div>
                                        <div class="col">
                                            discount %
                                            <div class="input-group">
                                                <input  type="number" class="form-control form-control-sm" name="discount_change" id="discount_change<?php echo $row["sale_id"];?>" value="<?php echo $row["discount"];?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >%</span>
                                                </div>
                                            </div> <!-- input-group -->
                                        </div>
                                    </div>
                                    </label>
                                    </li>
                                    
                                    <li style="list-style-type: none;"> 
                                    <label for="discount">
                                    <div class="form-row">
                                        <div class="col">
                                            discount price
                                            <div class="input-group">
                                                <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price<?php echo $row["sale_id"];?>" value="<?php echo $row["price_discount"];?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1">$</span>
                                                </div>
                                            </div> <!-- input-group -->
                                        </div>
                                        <div class="col">
                                                Price
                                            <div class="col">
                                                </div>
                                            <div class="input-group">
                                                <input  type="number" class="form-control form-control-sm" name="price" id="price<?php echo $row["sale_id"];?>" value="<?php echo $row["price"];?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0px 10px;"
                                                        aria-label="Username" aria-describedby="basic-addon1" >$</span>
                                                </div>
                                            </div> <!-- input-group -->
                                        </div>
                                    </div>
                                    </label>
                                    </li>

                                    <li style="list-style-type: none;"> 
                                    <label for="discount" class="update-sale-btn" data-sale="<?php echo $row["sale_id"];?>" data-user="<?php echo $row["user_id01"];?>">submit</label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
            </ul>

            <?php

    }
    
    public function bannerDiscountSale($banner)
    {
        switch ($banner) {
            case $banner == 'new':
                # code...
                echo '<img style="margin-left: -10px;position: absolute;" src="'.BASE_URL_LINK.'image/banner/new.png"  width="80px"  >';
                break;
            case $banner == 'great_deal':
                # code...
                echo '<img style="position: absolute; right: 0;top: 0;" src="'.BASE_URL_LINK.'image/banner/great-deal.png"  width="120px" >';
                break;
            case $banner == 'new_arrival':
                # code...
                echo '<img style="margin-right: -10px;position: absolute;" src="'.BASE_URL_LINK.'image/banner/new-arrival.png"  width="120px" >';
                break;
           default:
                  # code...
                  echo '';
                  break;  
        }
    }
    
    public function saleData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM sale WHERE user_id01 ='$user_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function saleActivities($user_id)
    {
        $mysqli= $this->database;
        $query = $mysqli->query("SELECT * FROM sale S
        Left JOIN sale_watchlist W ON S. sale_id = W. sale_id_list and W. user_id3_list = '$user_id'
        WHERE S. user_id01 = '$user_id' 
        ORDER BY S. created_on01 Desc "); ?>

        <div class="card card-primary mb-3 ">
            <div class="card-header main-active p-1">
                <h5 class="card-title text-center"><i> Sales</i></h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             
                <?php if ($query->num_rows > 0) { ?>
                <div class="row">
                <div class="col-md-12 pr-0">
                    
                <?php while($row= $query->fetch_array()) { ?>

                        <div class="mr-3 mb-3 float-left" style="width: 260px;height:276px;">
                        <div class="card">
                            <div class="card-img-top img-fuild" id="sale_gurishaPreview<?php echo $row['sale_id']; ?>" style="background: url('<?php echo BASE_URL_PUBLIC ;?>uploads/sale/<?php echo $row["photo"]; ?>')no-repeat center center;background-size:contain;height:178px;width:260px;position:relative" >
                   
                                <?php $banner = $row['banner'];
                                    switch ($banner) {
                                        case $banner == 'new':
                                            # code...
                                            echo '<img style="margin-left: -10px;" src="'.BASE_URL_LINK.'image/banner/new.png"  width="80px"  >';
                                            break;
                                        case $banner == 'great_deal':
                                            # code...
                                            echo '<img style="float:right;" src="'.BASE_URL_LINK.'image/banner/great-deal.png"  width="120px" >';
                                            break;
                                        case $banner == 'new_arrival':
                                            # code...
                                            echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival.png"  width="120px" >';
                                            break;
                                        default:
                                                # code...
                                                echo '';
                                                break;  
                                    } ?>
                            </div>
                            <div class="card-body">
                                <div id="response<?php echo $row['sale_id']; ?>"></div>

                                <div class="card-title">
                                <?php 
                                    if (strlen($row["title"]) > 30) {
                                    echo $row["title"] = substr($row["title"],0,30).'... ';
                                    }else{
                                    echo $row["title"];
                                    } ?>

                                    <!-- delete -->
                                    <?php 
                                    if(isset($_SESSION['key']) && $user_id == $row['user_id01']){ 
                                        echo $this->Edit_sale($user_id,$row['user_id01'],$row); 
                                    } ?>
                                    <!-- delete -->

                                    <?php if($row['discount'] != 0){ ?>
                                        <span class="float-right text-danger"><?php echo $row["discount"]; ?>%</span>
                                    <?php } ?>

                                </div> <!-- product-title -->
                                <div class="card-text product-price d-inline-block"> 
                                    <?php if($row['price_discount'] != 0){ ?><span class="text-danger " style="text-decoration: line-through;"><?php echo number_format($row['price_discount']); ?> Frw</span> <?php } ?> 
                                <div> <?php echo number_format($row["price"])." Frw"; ?> </div>
                                </div>

                                <?php if(isset($_SESSION['key'])){ if($row['user_id3_list'] != $user_id && $row['sale_id_list'] != $row['sale_id']  ){ ;?>

                                <form method="post" id="form-cartitem<?php echo $row['code']; ?>add" class="float-right">
                                    <div class="cart-action">
                                        <input type="hidden" style="width:30px;" name="action" value="add" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $row['code']; ?>" />
                                        <input type="text" class="product-quantity" style="width:30px;" name="quantity" value="1" size="2" readonly/>
                                        <input type="button" value="Add to Cart" class="btnAddAction offer-price-sale" data-sale="<?php echo $row['sale_id']; ?>"/>
                                        <!-- <input type="button" onclick="cart_add('add','< ?php echo 'form-cartitem'.$row['code'].'add'; ?>','< ?php echo $row['code']; ?>');" value="Add to Cart" class="btnAddAction" /> -->
                                    </div>
                                </form>

                                    <?php }else{ ;?>

                                    <form method="post" id="form-cartitem<?php echo $row['code']; ?>add" class="float-right">
                                        <div class="cart-action">
                                            <input type="button" value="Remove" class="btn btn-danger"  onclick="cart_add('remove','<?php echo 'form-cartitem'.$row['code'].'remove'; ?>','<?php echo $row['code']; ?>',<?php echo $row['user_id']; ?>);" />
                                        </div>
                                    </form>

                                    <?php } }else{ ?>

                                <form method="post" id="form-cartitem<?php echo $row['code']; ?>add" class="float-right">
                                    <div class="cart-action">
                                        <input type="hidden" style="width:30px;" name="action" value="add" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $row['code']; ?>" />
                                        <input type="text" class="product-quantity" style="width:30px;" name="quantity" value="1" size="2" readonly/>
                                        <input type="button" value="Add to Cart" class="btnAddAction offer-price-sale" data-sale="<?php echo $row['sale_id']; ?>"/>
                                        <!-- <input type="button" onclick="cart_add('add','< ?php echo 'form-cartitem'.$row['code'].'add'; ?>','< ?php echo $row['code']; ?>');" value="Add to Cart" class="btnAddAction" /> -->
                                    </div>
                                    </form>

                                    <?php } ;?>

                            </div><!-- card-body -->
                        </div><!-- card -->

                        </div><!-- float-left -->
                        <!-- </div> -->

                    <?php } ?>    
                </div>
                </div>

                <?php }else{

                    echo ' <div class="col-md-12 col-lg-12 mt-2"><div class="alert alert-danger alert-dismissible fade show text-center">
                                <button class="close" data-dismiss="alert" type="button">
                                    <span>&times;</span>
                                </button>
                                <strong>No Record</strong>
                            </div></div>'; 
                } ?>
           </div> <!-- card-body -->
        </div> <!-- card -->
   <?php }


}

$sale = new Sale();

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