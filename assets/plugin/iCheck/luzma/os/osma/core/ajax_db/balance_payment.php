
<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['recharge_coins']) && !empty($_POST['recharge_coins'])) {
	  $user= $home->userData($_SESSION['key']);
  ?>

  <div class="balance-popup">
    <div class="wrap6" id="disabler">
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrapLogin" id="popupEnd" style="max-width: 439px;">
        	<div class="img-popup-body">

        <div class="card">
        <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>

          <div class="card-body">

          <form class="form-signin">
            <h4 class="h4 mb-3  text-center font-weight-normal">Balance</h4>
            <div class="form-group">
              <label>Your Coins Balance is: </label> <i class="fa fa-money text-success"></i>
              <i class="fas fa-coins text-warning"></i> <?php echo  number_format($user['amount_coins'],2);?> coins
              <a href="<?php echo BALANCE ;?>" class="btn btn-default"><i class="fas fa-money-check"></i>  Deposit</a>
            </div>

              <label for="inputEmail" >Click any coins you wish to deposit in your account</label>
              <div id="recharge-coins" class="m-1"></div>
              <table class="table table-hover table-inverse table-responsive">
                  <thead class="thead-inverse">
                      <tr>
                          <th>N0</th>
                          <th><i class="fas fa-coins"></i> Coins</th>
                          <th width="30%"></th>
                          <th>Price</th>
                      </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>1</td>
                              <td> <i class="fas fa-coins text-warning"></i> 5 coins</td>
                              <td></td>
                              <td>
                              <?php $details= '\'day\',\''.$user['firstname'].'\',\''.$user['lastname'].'\',\''.$user['email'].'\','.$user['user_id'].',\'buy_coins\'' ;?>
                                <button type="button" onclick="coins(500,<?php echo $details ;?>)" class="btn btn-sm btn-danger">500 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>2</td>
                              <td><i class="fas fa-coins text-warning"></i> 10 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins(1000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">1,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>3</td>
                              <td><i class="fas fa-coins text-warning"></i> 50 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins(5000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">5,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>4</td>
                              <td><i class="fas fa-coins text-warning"></i> 150 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins(15000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">15,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>5</td>
                              <td><i class="fas fa-coins text-warning"></i> 250 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins(25000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">25,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>6</td>
                              <td><i class="fas fa-coins text-warning"></i> 500 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins(50000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">50,000 Frw</button>
                              </td>
                          </tr>
                          <tr>
                              <td>7</td>
                              <td><i class="fas fa-coins text-warning"></i> 1500 coins</td>
                              <td></td>
                              <td>
                                 <button type="button" onclick="coins(150000,<?php echo $details ;?>)" class="btn btn-sm btn-danger">150,000 Frw</button>
                              </td>
                          </tr>
                      </tbody>
              </table>
            <div class=" text-center h4" id='response'></div>
            <p class="mt-5 mb-3  text-center  text-muted"><?php echo $users->copyright(2018); ?><a href="https://irangiro.com">Irangiro IRG</a>.</strong> All rights</p>
          </form>

           </div>
           </div>

           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->


<?php }
