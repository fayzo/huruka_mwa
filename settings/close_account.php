<div class="card">
    <div class="card-header">
        <h4>Close Account</h4>
    </div>
    <div class="card-body">
        <!-- <p>Are you sure you want to close your account?</p> -->
        <p>Closing your account will hide your profile and all your activity from other users.</p>
        <p>You can re-open your account at any time by simply logging in.</p>
        <div class="form-group">
        <span id="response_close_account"></span>
            <div class="clearfix">
            <?php if ($user['close_account'] == 'yes') { ?>
                <input type="button" name="close_account" onclick="close_account('<?php echo $_SESSION['key'];?>','no');" id="close_account" value="Re-Open it!" class="btn btn-danger btn-sm float-left mr-2">
            <?php } else { ?>
                <input type="button" name="close_account" onclick="close_account('<?php echo $_SESSION['key'];?>','yes');" id="close_account" value="Yes! Close it!" class="btn btn-danger btn-sm float-left mr-2">
            <?php } ?>
            <a href="<?php echo HOME;?>" class="btn btn-primary btn-sm">No way!</a>
            <!-- <input type="button" name="cancel" id="update_details" value="No way!" class="btn btn-primary btn-sm"> -->
            </div>
        </div>

        <div class="text-center h4">OR</div>
        <p>Delete your account complete and you will no longer access your account definetily it.</p>
        
        <span id="response_delete_account"></span>
        <button type="button" name="delete_account" onclick="delete_account('<?php echo $_SESSION['key'];?>','yes');" id="close_account" class="btn btn-danger btn-sm float-left mt-2">
        <i class="fa fa-trash" aria-hidden="true"></i> Delete Account!</button>

    </div>
    <div class="card-footer text-muted">
        <span class="people-message more" data-user="1">
        <!-- <i style="font-size: 20px;" class="fa fa-envelope-o"></i> -->
        <i class="fab fa-facebook-messenger"></i> Contact Us if you have any issues in your account
        </span>
        <a href="javascript:void()">irangiro IRG</a>
    </div>
</div>