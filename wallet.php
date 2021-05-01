<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' Your Balance'; ?></title>
<?php include "header_navbar_footer/header.php"?>

<section class="content-header">

<div class="row">
	<div class="col-md-4">
                   
        <nav class="ads-navbar-wrapper" role="navigation">

            <div class="ads_mini_wallet">
                <p>Current balance</p>
                <h3>$0.00</h3>
            </div>

            <ul class="ads-nav list-unstyled">
                <li>
                    <a href="http://localhost/facebook//ads" data-ajax="?link1=ads" class=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12,8H4A2,2 0 0,0 2,10V14A2,2 0 0,0 4,16H5V20A1,1 0 0,0 6,21H8A1,1 0 0,0 9,20V16H12L17,20V4L12,8M21.5,12C21.5,13.71 20.54,15.26 19,16V8C20.53,8.75 21.5,10.3 21.5,12Z"></path></svg> Campaigns</a>
                </li>
                <li>
                    <a href="http://localhost/facebook//wallet/" data-ajax="?link1=wallet" class="active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21,18V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H19A2,2 0 0,1 21,5V6H12C10.89,6 10,6.9 10,8V16A2,2 0 0,0 12,18M12,16H22V8H12M16,13.5A1.5,1.5 0 0,1 14.5,12A1.5,1.5 0 0,1 16,10.5A1.5,1.5 0 0,1 17.5,12A1.5,1.5 0 0,1 16,13.5Z"></path></svg> Wallet &amp; Credits</a>
                </li>
                <li><hr></li>
                <li>
                    <a href="http://localhost/facebook//ads/create/" data-ajax="?link1=create-ads" class=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg> New campaign</a>
                </li>
            </ul>
            <div class="clear"></div>
        </nav>

    </div>

	<div class="col-md-8 ads_col_8">
		<div class="page-margin wowonder-well">
			<div class="wo_page_hdng pag_neg_padd pag_alone">
				<div class="wo_page_hdng_innr">
					<span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M21,18V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H19A2,2 0 0,1 21,5V6H12C10.89,6 10,6.9 10,8V16A2,2 0 0,0 12,18M12,16H22V8H12M16,13.5A1.5,1.5 0 0,1 14.5,12A1.5,1.5 0 0,1 16,10.5A1.5,1.5 0 0,1 17.5,12A1.5,1.5 0 0,1 16,13.5Z"></path></svg></span> Wallet &amp; Credits				</div>
			</div>
		</div>
		<div class="page-margin wowonder-well">
                <div id="replenish-user-account-alert-warning"></div>
			<!-- <div class="alert alert-danger hidden please-check">Please check your details.</div> -->
				
			<p class="bold">Current balance</p>
			<div class="my_wallet wow_mini_wallets">
				<div>
					<h5>$0.00</h5>
				</div>
				<div class="wow_mini_wallets_btns">
					<button data-toggle="modal" data-target="#send_money_modal" class="btn btn-default btn-mat">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path></svg> Send money					</button>
					<button class="btn btn-main btn-mat btn-mat-raised" onclick="$('.wow_add_money_hid_form').slideToggle();">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 0V3H0V5H3V8H5V5H8V3H5V0H3M9 3V6H6V9H3V19C3 20.1 3.89 21 5 21H19C20.11 21 21 20.11 21 19V18H12C10.9 18 10 17.11 10 16V8C10 6.9 10.89 6 12 6H21V5C21 3.9 20.11 3 19 3H9M12 8V16H22V8H12M16 10.5C16.83 10.5 17.5 11.17 17.5 12C17.5 12.83 16.83 13.5 16 13.5C15.17 13.5 14.5 12.83 14.5 12C14.5 11.17 15.17 10.5 16 10.5Z"></path></svg> Add Funds					</button>
				</div>
			</div>
			<div class="wow_add_money_hid_form text-center">
				<form class="form" id="replenish-user-account">
					<p class="bold">Replenish my balance</p>
					<div class="add-amount">
						<h5>$<input type="number" placeholder="0.00" min="1.00" max="1000" name="amount" id="amount"></h5>
					</div>
					<button type="submit" class="btn btn-main btn-mat btn-mat-raised">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M0.41,13.41L6,19L7.41,17.58L1.83,12M22.24,5.58L11.66,16.17L7.5,12L6.07,13.41L11.66,19L23.66,7M18,7L16.59,5.58L10.24,11.93L11.66,13.34L18,7Z"></path></svg> Continue					</button>
				</form>
			</div>
		</div>
		
		<div class="page-margin wowonder-well">
						<div class="wallet_transactions">
				<p class="bold">Transactions</p>
				<div class="tabbable">
					<div class="ads-cont-wrapper">
			<div class="empty_state">
			<img class="empty_state_img" src="http://localhost/facebook//themes/wowonder/img/no_transaction.svg"> Looks like you don't have any transaction yet!		</div>
	</div>				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade wow_mat_pops in" id="send_money_modal" >
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="wow_pops_head">
				<svg height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" xmlns="http://www.w3.org/2000/svg"><path d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729 c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="currentColor" opacity="0.6"></path> <path d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729 c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="currentColor" opacity="0.6"></path> <path d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428 c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="currentColor"></path></svg>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"></path></svg></button>
				<h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path></svg> Send money to friends</h4>
			</div>
			<div class="modal-body">
				<form class="form" id="send-money-form" autocomplete="off">
					<div id="send-money-form-alert">
                            <div class="alert alert-warnings" style="background:#fcf8e3;">
								Your current wallet balance is: 0, please top up your wallet to continue. <br>
                                <a style="color:black;" href="http://localhost/facebook//wallet/">Top up</a>
							</div>
											</div>-
					<div class="wow_snd_money_form text-center">
						<p class="bold">Amount</p>
						<div class="add-amount">
							<h5>$<input type="number" placeholder="0.00" min="1.00" max="1000" name="amount" id="amount"></h5>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="wow_form_fields">
								<label for="search">To who you want to send?</label>
								<input id="search" type="text" placeholder="Search by username or email">
								<div class="dropdown">
									<ul class="dropdown-menu money-recipients-list"></ul>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<p></p>
					<div class="text-center">
						<button type="submit" class="btn btn-main btn-mat btn-mat-raised add_wow_loader" disabled="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M0.41,13.41L6,19L7.41,17.58L1.83,12M22.24,5.58L11.66,16.17L7.5,12L6.07,13.41L11.66,19L23.66,7M18,7L16.59,5.58L10.24,11.93L11.66,13.34L18,7Z"></path></svg> Continue						</button>
					</div>
					<input type="hidden" id="recipient_user_id" name="user_id">
				</form>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade wow_mat_pops in" id="pay-go-pro" >
	<div class="modal-dialog payment_box">
	<div class="modal-content">
		<div class="wow_pops_head">
			<svg height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" xmlns="http://www.w3.org/2000/svg"><path d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729 c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="currentColor" opacity="0.6"></path> <path d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729 c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="currentColor" opacity="0.6"></path> <path d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428 c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="currentColor"></path></svg>
			<h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"></path></svg> Choose a payment method</h4>
		</div>
		<div class="modal-body">
			<!-- PayPal -->
							
			<!-- Alipay -->
			<button class="bank_payment btn" onclick="Wo_CheckOutCard(1, 'Star package', 300, 'bank_payment');">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="47.001px" height="47.001px" viewBox="0 0 47.001 47.001" xml:space="preserve"><path fill="currentColor" d="M44.845,42.718H2.136C0.956,42.718,0,43.674,0,44.855c0,1.179,0.956,2.135,2.136,2.135h42.708c1.18,0,2.136-0.956,2.136-2.135C46.979,43.674,46.023,42.718,44.845,42.718z"></path><path fill="currentColor" d="M4.805,37.165c-1.18,0-2.136,0.956-2.136,2.136s0.956,2.137,2.136,2.137h37.37c1.18,0,2.136-0.957,2.136-2.137s-0.956-2.136-2.136-2.136h-0.533V17.945h0.533c0.591,0,1.067-0.478,1.067-1.067s-0.478-1.067-1.067-1.067H4.805c-0.59,0-1.067,0.478-1.067,1.067s0.478,1.067,1.067,1.067h0.534v19.219H4.805z M37.37,17.945v19.219h-6.406V17.945H37.37zM26.692,17.945v19.219h-6.406V17.945H26.692z M9.609,17.945h6.406v19.219H9.609V17.945z"></path><path fill="currentColor" d="M2.136,13.891h42.708c0.007,0,0.015,0,0.021,0c1.181,0,2.136-0.956,2.136-2.136c0-0.938-0.604-1.733-1.443-2.021l-21.19-9.535c-0.557-0.25-1.194-0.25-1.752,0L1.26,9.808c-0.919,0.414-1.424,1.412-1.212,2.396C0.259,13.188,1.129,13.891,2.136,13.891z"></path></svg>
				Bank transfer					
			</button>
		</div>
	</div>
	</div>
</div>



</section>
<!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>
