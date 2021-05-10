
 <?php if (isset($_SESSION['key'])){ ?>
   <!-- DIRECT CHAT PRIMARY -->

   <!-- <div class="row">
       <div class="col-md-3">
           <div class="card direct-chats direct-chat direct-chat-primary">
               <div class="card-header main-active py-2">
                   <h5 class="card-title pb-0"><i> Message Chat</i></h5>

                   <div class="card-tools">
                       <span id="tooltipsmessages1" data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"><?php if( $notific['totalmessage'] > 0){echo '<span>'.$notific['totalmessage'].'</span>'; } ?></span>
                       <button type="button" class="btn btn-tool btn-sm collapse-minus" data-toggle="collapse"
                           data-target="#collapseExample4">
                           <i class="fa fa-minus"></i>
                       </button>
                       <button type="button" class="btn btn-tool btn-sm" data-toggle="tooltip" id="direct-chat-contacts-view" title="Contacts"
                           data-widget="chat-pane-toggle">
                           <i class="fa fa-comments"></i>
                       </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                       </button>
                   </div>
               </div>
               /.card-header
               <div class="collapse" id="collapseExample4">
               </div>
               collapse
           </div>
           /.direct-chat
       </div>
       /.col
   </div> -->
   <!-- /.row -->
   <!-- END DIRECT CHAT PRIMARY -->
   <!-- END DIRECT CHAT PRIMARY -->
   <?php include_once('core/ajax_db/direchat.php') ;?>
   <!-- END DIRECT CHAT PRIMARY -->
<?php } ?>


</div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.01
      </div>
      <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://irangiro.com">irangiro IRG</a>.</strong> All rights
      reserved.
    </footer>

    <!-- =============================================== -->

      <!-- navbar path -->
      <?php include 'siderbar_control.php'; ?>
      <!-- navbar path -->

    <!-- =============================================== -->

   
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
       <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#check">
    Launch
  </button> -->
  
  <!-- Modal -->
<div class="popupTweet"></div>

  <div class="modal fade" id="checkOUT" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header d-none">
                  <!-- <h5 class="modal-title">Modal title</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </div>
              <div class="modal-body text-center">
                  <i id="change-check" class="fa fa-check-circle-o" style="font-size:200px;color: green;" aria-hidden="true"></i>
                 <p id="html-check"></p>
            </div>
          </div>
      </div>
  </div>
  
  <!-- jQuery 3 -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.form.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>
  <!-- <script src="< ?php echo BASE_URL_LINK ;?>dist/js/bootstrap.bundle.min.js"></script> -->

  <!-- SlimScroll -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.slimscroll.min.js"></script>
  <script src="<?php echo BASE_URL_LINK;?>dist/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo BASE_URL_LINK;?>dist/js/bootstrap4.min.js"></script>
  <!-- <script src="< ?php echo BASE_URL_LINK;?>plugin/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="< ?php echo BASE_URL_LINK;?>plugin/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
  <!-- FastClick -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/fastclick.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.Jcrop.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>plugin/iCheck/icheck.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/pdf.js"></script> 
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/siderbarResponsive.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/lightslider.js"></script> 

  <script src="<?php echo BASE_URL_LINK ;?>plugin/ckeditor/ckeditor.js"></script>

  <!-- AdminLTE App -->
  <script src="<?php echo BASE_URL_LINK ;?>js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo BASE_URL_LINK ;?>js/demo.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>js/main.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>js/login_please.js"></script>
  
  <script src="<?php echo BASE_URL_LINK ;?>js/profileEdit.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/settings.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/search.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/message_posts.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/message_promote_post.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/message_newsfeed_post.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/hashtag.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/likes.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/share.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/popupPost.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/comment.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/deleteComment.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/popupPostForm.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/fetch_home.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/fetchPost_network_follow.js"></script>
   
   <script src="<?php echo BASE_URL_LINK ;?>js/follow.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/message.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/post_second_like.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/posts_comments_home.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/postUsermessage.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/notification.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/messageStickyBottom.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/messageStickyRight.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/messageResponsiveHome.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/BoxWidget.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/album_image.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/jobs_price_post.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/manage_admins_ajax.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/crowfund_addcategories.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/crowfundraising_like.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/crowfundraising_deleteComment.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/crowfund_addomments.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/fund_addcomment.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/fundraising_like.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/fundraising_deleteComment.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/fundraising_readmore.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/donation.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/sale_delete.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/sale_readmore.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/house_addcategories.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/house_delete.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/car_addcategories.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/car_delete.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/icyamunara.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/icyamunara_delete.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/school_add.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/school_delete.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/businesspages.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/businessPost.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/businessPostView.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/businessApplyJobs.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/businessApplyRead_inbox.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/email_notifiacation.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/events_addcategories.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/events_like.js"></script>

   <script src="<?php echo BASE_URL_LINK ;?>js/unemplyoment_message.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/transaction_coins.js"></script>

   <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
   <script src="<?php echo BASE_URL_LINK ;?>plugin/slick/slick.min.js" type="text/javascript" charset="utf-8"></script>
   <script src="<?php echo BASE_URL_LINK ;?>dist/js/easing.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/slick.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL_LINK ;?>plugin/newsbox/jquery.bootstrap.newsbox.min.js" type="text/javascript" charset="utf-8"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/crop.js" type="text/javascript" charset="utf-8"></script>
    <!-- UItoTop plugin -->
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->
    <script type="text/javascript">
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });

        });

    $(function () {
      CKEDITOR.plugins.addExternal('wordcount', '/irangiro_social_site/assets/plugin/ckeditor/plugins/WordCount/', 'plugin.js');
      // CKEDITOR.plugins.addExternal('wordcount', '/assets/plugin/ckeditor/plugins/WordCount/', 'plugin.js');
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    // CKEDITOR.replace('editor1')
    // CKEDITOR.replace('editor2')
    // CKEDITOR.replace('editor3')
    //bootstrap WYSIHTML5 - text editor
    // $('.textarea').wysihtml5()
    });

    $(function () {

        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

      $(".demo1").bootstrapNews({
        newsPerPage: 4,
        autoplay: true,
        pauseOnHover: true,
        direction: 'up', // up,or down
        newsTickerInterval: 4000,
        animationSpeed: 'normal',
        onToDo: function () {
          //console.log(this);
        }
      });
    });

    // $(function() {

    //     $('form.setting-general-form').ajaxForm({
    //         url: 'http://localhost/irangiro_social_site/withdraw.php' + '?f=request_payment',
    //         // url: window.location.pathname + '?f=request_payment',
    //         // url: window.location.href + '?&f=request_payment',
    //         beforeSend: function() {
    //         $('.settings_page').find('.add_wow_loader').addClass('btn-loading');
    //         },
    //         success: function(data) {
    //             scrollToTop();
    //             if (data.status == 200) {
    //                 $('.setting-general-alert').html('<div class="alert alert-success">' + data.message + '</div>');
    //                 $('.alert-success').fadeIn('fast');
    //             } else if (data.errors) {
    //                 var errors = data.errors.join("<br>");
    //                 $('.setting-general-alert').html('<div class="alert alert-danger">' + errors + '</div>');
    //                 $('.alert-danger').fadeIn(300);
    //             }
    //             $('.settings_page').find('.add_wow_loader').removeClass('btn-loading');
    //         }
    //     });


    //     // scroll to top function
    //     function scrollToTop() {
    //         verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0;
    //         element = $('html');
    //         offset = element.offset();
    //         offsetTop = offset.top;
    //         $('html, body').animate({
    //             scrollTop: offsetTop
    //         }, 300, 'linear');
    //     }

    // });

    // $(document).ready(function() {
    //     $("#content-slider").lightSlider({
    //         loop:true,
    //         keyPress:true
    //     });
    //     $('#image-gallery10').lightSlider({
    //         gallery:true,
    //         item:1,
    //         thumbItem:9,
    //         slideMargin: 0,
    //         speed:500,
    //         auto:true,
    //         loop:true,
    //         onSliderLoad: function() {
    //             $('#image-gallery10').removeClass('cS-hidden');
    //         }  
    //     });
    // });
        

  // "home" === window.location.pathname.replace(/^\/([^\/]*).*$/, "$1")) {
  //   var e = document.location.href.split("/");
  //   if (e[4] && "category" != e[4] && !e[4].includes("search?keyword=")) {
        function myFunction() {
            var e = (document.body.scrollTop || document.documentElement.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight) * 100;
            document.getElementById("myBar").style.width = e + "%"
            document.getElementById("progress-container").style.backgroundColor = "#f8f9fa";
            document.getElementById("progress-container").style.display = 'block';
        }
        window.onscroll = function() {
            myFunction()
        }
    // }
   </script>

</body>

</html>