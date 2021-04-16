<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

$user = $home->userData($_SESSION['key']);
?>

<!-- POPUP TWEET-FORM WRAP -->
<div class="popup-tweet-wrap">
    <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrapLogin"  id="popupEnd">
        	<div class="img-popup-body">
                  
            <div class="card borders-tops">
                <div class="card-header">
                   <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                    <span class="closeDelete"><button class="closeTweetPopup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
				    <h4 class="text-muted text-center">Compose new Post</h4>
                </div>
              <div class="card-body message-color">
                    <div id="response-posts"></div>

                    <form method="post" id="promoteForm" enctype="multipart/form-data">
                        <input type="hidden" name="id_posts" id="id_posts" value="<?php echo $_SESSION['key'];?>">
                        <div class="user-block">
                            <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                                <?php if (!empty($user['profile_img'])) {?>
                                <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                                <?php  }else{ ?>
                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                <?php } ?>
                            </div>
                            </div>
                            <span class="username" style="margin-left: 50px">
                            <textarea id="editor1" class="status" name="status" placeholder="Type Something here!" rows="4"
                                cols="50"></textarea>
                            <div class="hash-box">
                                <ul>
                                </ul>
                            </div>
                            <!-- SUPPORT GIVEN COINS -->
                                <!-- SUPPORT GIVEN COINS -->
                                <div id="add-more" ></div>
                                <!-- SUPPORT GIVEN COINS -->
                            </span>
                        </div>

                        <div class="message-footer text-muted mb-2">
                            <div class="t-fo-left">
                                <!-- accept="image/*" 
                                accept=".png,.jpg,.jpeg"
                                accept="audio/*| video/* |image/* | MIME_type"
                                accept="audio/*,video/*,image/*"
                                accept="image/png, image/jpg, image/jepg, image/gif" -->
                            <ul>
                                <input type="file" name="files[]" id="file" accept="image/*" onChange="displayImageNameSize(this)" multiple >
                                <?php if(isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?>
                                <li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
                                <span class="tweet-error">
                                    <span style="color: red;" id="empty-posts"></span>
                                </span>
                                </li>
                                <?php } ?>
                            </ul>

                            </div>
                            <div class="t-fo-right">
                            <span class="counts-ckeditor" id="count">10000</span>
                            <input <?php echo (isset($_SESSION['key']))?'type="submit"':'type="button" id="login-please" data-login="1"';?> class="btn main-active" name="tweet" value="Post">
                            <input type="button" class="btn btn-primary btn-sm float-right ml-2 mb-2" 
                                        id="add-youtube" onclick='Addyoutube()' value="more">
                            </div>
                            <!--  progress-xs -->
                            <div id="add-photo0" class="row">
                            </div>
                            <span class="progress progress-hide" style="display: none;">
                            <span class="progress-bar bg-danger" role="progressbar" style="width:0%;" id="pro"
                                aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><span> completed <span
                                    class="fa fa-check"></span></span></span>
                            </span>
                        </div>
                    </form>

                </div> <!-- card-body -->
                </div> <!-- card -->
			
            </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
<!-- POPUP TWEET-FORM END -->

<script type="text/javascript"> $('.progress-hided').hide();</script>

<script>
    $(function () {

    CKEDITOR.instances.editor1.on("key", function (event) { 
        var max = 1000;
        var charCount = $('.counts-ckeditor'); 
        var textarea_count = decodeHtmlEntities(CKEDITOR.instances.editor1.getData()).replace(/(<([^>]+)>)/ig, "").length;
        // var textarea_counts = CKEDITOR.instances.editor1.getData();
        // console.log(charCount,textarea_count,textarea_counts);

            charCount.html(textarea_count); 

            if (textarea_count > max ) {
                $('.counts-ckeditor').css('color', '#e22358'); // red
            }else {
                $('.counts-ckeditor').css('color', '#4574ca');
            }
        });

        function decodeHtmlEntities(str) {
            return String(str).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
        }
  });

</script>
