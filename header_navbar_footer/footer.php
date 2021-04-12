
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
  <div class="popupTweet"></div>

  <!-- jQuery 3 -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.slimscroll.min.js"></script>
  <script src="<?php echo BASE_URL_LINK;?>dist/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo BASE_URL_LINK;?>dist/js/bootstrap4.min.js"></script>
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

   <script src="<?php echo BASE_URL_LINK ;?>js/unemplyoment_message.js"></script>
   <script src="<?php echo BASE_URL_LINK ;?>js/transaction_coins.js"></script>

   <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
   <script src="<?php echo BASE_URL_LINK ;?>plugin/slick/slick.min.js" type="text/javascript" charset="utf-8"></script>

   <script>
    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    // CKEDITOR.replace('editor1')
    // CKEDITOR.replace('editor2')
    // CKEDITOR.replace('editor3')
    //bootstrap WYSIHTML5 - text editor
    // $('.textarea').wysihtml5()
  });

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
        
   $(document).ready(function(){
        var size;
        $('#cropbox').Jcrop({
          bgColor:'black',
          bgOpacity: .4,
          onChange: showPreview,
          aspectRatio: 1,
          onSelect: function(c){
           size = {x:c.x,y:c.y,w:c.w,h:c.h};
           $("#crop").css("visibility", "visible");   
          }
        });
     
        $("#crop").click(function(){
            var img = $("#cropbox").attr('src');
            $("#showcropSubmit").show();
            $("#cropped_img").show();
            $("#cropped_img").attr('src','image-crop.php?x='+size.x+'&y='+size.y+'&w='+size.w+'&h='+size.h+'&img='+img);
        });
    });

    function showPreview(coords)
    {
	    var rx = 100 / coords.w;
	    var ry = 100 / coords.h;
    
	    $('#preview').css({
	    	width: Math.round(rx * 500) + 'px',
	    	height:  Math.round(ry * 500) + 'px',
	    	marginLeft: '-' + Math.round(rx * coords.x) + 'px',
	    	marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        $('#x').val(coords.x);
        $('#y').val(coords.y);
        $('#w').val(coords.w);
        $('#h').val(coords.h);
    }

    function checkCoords()
    {
       if (parseInt($('#w').val())) 
       return true;
       alert('Please select a crop region then press submit.');
       return false;
    };

	 $(document).on('click', '#form-crop', function (e) {
        event.preventDefault();

			$.ajax({
				url: "core/ajax_db/profileEdit.php",
				method: "POST",
				data:new FormData(this),
				processData: false,
				contentType: false,
				success: function (response) {
					alert(response);
				}, error: function (xhr, status, error) {
					console.log(status, error);
				}
			});
	});
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

  $('.regulars').slick({
     dots: true,
    //  prevArrow: $('.slick-prev'),
    //  nextArrow: $('.next'),
     infinite: false,
     speed: 300,
     slidesToShow: 1,
     slidesToScroll: 1,
     responsive: [
       {
         breakpoint: 1024,
         settings: {
          slidesToShow: 1,
           slidesToScroll: 1,
           infinite: true,
           dots: true
         }
       },
       {
         breakpoint: 700,
         settings: {
           slidesToShow: 1,
           slidesToScroll: 1
         }
       },
       {
         breakpoint: 480,
         settings: {
           slidesToShow: 1,
           slidesToScroll: 1
         }
       }
       // You can unslick at a given breakpoint now by adding:
       // settings: "unslick"
       // instead of a settings object
       ]
   });
   });


   </script>

</body>

</html>