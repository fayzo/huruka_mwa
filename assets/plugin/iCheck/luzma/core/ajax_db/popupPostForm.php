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
                <span id="response-PostMessage"></span>
                <div class="card-header">
                   <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                    <span class="closeDelete"><button class="closeTweetPopup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
				    <h4 class="text-muted text-center">Compose new Post</h4>
                </div>
              <div class="card-body message-color">
                <form method="post" id="popupForm" enctype="multipart/form-data">
                    <input type="hidden" name="id_posts" id="id_posts"
                        value="<?php echo $_SESSION['key'];?>">
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
                            <div class="form-group" style="overflow: auto;width: 97%;">
                                <input type="text" class="form-control" name="title_name" id="title_name" placeholder=" Title of your post Or Ask question">
                            </div>
                            <textarea class="status" name="status" id="editor1"
                                placeholder="Type Something here!" rows="4" cols="50"></textarea>
                            <div class="hash-box">
                                <ul>
                                </ul>
                            </div>
                            <div class="form-group">
                                <select class="custom-select" name="donation_payment" id="donation_payment">
                                    <option value="">Select one</option>
                                    <option value="donation_coins.coins">coins payment</option>
                                    <option value="donation_card.card">Mtn & Visa paymant</option>
                                </select>
                            </div>
                        </span>
                    </div>

                        <div class="message-footer text-muted">
                            <div class="t-fo-left">
                                <ul>
                                    <input type="file" name="files[]" id="file" accept="image/*" multiple  onChange="displayImage(this)">
                                      <?php if(isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?>

                                    <li><label for="file"><i class="fa fa-camera"
                                                aria-hidden="true"></i></label>
                                        <span class="tweet-error">
                                            <span style="color: red;" id="empty-posts2"></span>
                                        </span>
                                    </li>
                                      <?php } ?>
                                </ul>
                            </div>
                            <div class="t-fo-right">
                                <span class="counts-ckeditor" id="count">1000</span>
                                <input type="submit" class="btn main-active"  id="addpost" name="addpost" value="Post">
                            </div>
                            <div id="add-photo0" class="row">
                            </div>
                             <span class="progress progress-xs progress-hided">
                                <span class="progress-bar bg-info" role="progressbar"
                                    style="width:0%;" id="prog" aria-valuenow="" aria-valuemin="0"
                                    aria-valuemax="100"></span>
                            </span>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div><!-- card -end -->

			
            </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
 <!-- POPUP TWEET-FORM END -->
<script type="text/javascript"> $('.progress-hided').hide();</script>

<script>
    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    // $('.textarea').wysihtml5()
    // for(instance in CKEDITOR.instances){
    //         CKEDITOR.instances[instance].updateElement();
    //     }

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
