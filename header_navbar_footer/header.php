

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
  <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/ui.totop.css" >

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>icon/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>icon/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>icon/flag-icon-css-master/css/flag-icon.css">
  <!-- Add the slick-theme.css if you want default styling -->
  <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL_LINK;?>plugin/slick/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL_LINK;?>plugin/slick/slick.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/skins/_all-skins.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/main.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/profile.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/profileEdit.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/follow.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/dashboard.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/imagePopup.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/login.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/whoTofollow.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/message.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/cardboxChat.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/jquery.Jcrop.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/mailbox.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/shopping_cart.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/upload_profile_imagee.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/background.css">
  <!-- <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/follow.css"> -->
  <link rel="stylesheet"  href="<?php echo BASE_URL_LINK ;?>dist/css/lightslider.css" />
  <link rel="stylesheet"  href="<?php echo BASE_URL_LINK ;?>dist/css/newsbox.css" />
  <link rel="stylesheet"  href="<?php echo BASE_URL_LINK ;?>dist/css/balance_withdraw.css" />


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

<!-- image-gallery10 -->
<?php include('header_image_slide.php') ;?>
<style>
    	#image-gallery10{
			list-style: none outside none;
		    padding-left: 0;
            margin: 0;
		}
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

<script>

    function colors(requests) {
        var xhr = new XMLHttpRequest();
        var url = "core/ajax_db/color_db.php?key=color" + '&color=' + requests;
        xhr.open("POST", url, true);
        xhr.send();

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var json = JSON.parse(xhr.responseText);
                var sc = document.body;
                sc.setAttribute("class", json.color);
                // sc.classList.add(json.color);
                console.log(json.user_id + ", " + json.color);
                // console.log(xhr.responseText);
                // location.reload();
                // if (xhr.responseText.indexOf('color') >= 0) {
                //     window.location = 'admin.php';
                // }
            };
        }
    }

     function background(requests, id) {
        var xhr = new XMLHttpRequest();
        var url = "core/ajax_db/background_db.php?key=background" + '&id=' + id + '&background=' + requests;
        xhr.open("POST", url, true);
        xhr.send();

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var json = JSON.parse(xhr.responseText);
                var sc = document.body;
                sc.setAttribute("class", json.background);
                
                // console.log(json.admin_id + ", " + json.background);
                // console.log(xhr.responseText);
                // location.reload();
                // if (xhr.responseText.indexOf('color') >= 0) {
                //     window.location = 'admin.php';
                // }
            };
        }
    }
  
  function follow_FecthRequest(id,user_id,follow_id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/follow_FecthPaginat.php?pages=' + id +'&user_id=' + user_id +'&follow_id=' + follow_id , true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (id) {
                    case id:
                         var pagination = document.getElementById('Follow-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                   
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    
    function fundraising_FecthRequest(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/fundraisingFecthPaginat.php?pages=' + id + '&categories=' + categories, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case 'business':
                         var pagination = document.getElementById('businessPagination');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'animals':
                         var pagination = document.getElementById('animalsPagination');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'community':
                         var pagination = document.getElementById('communityPagination');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'competition':
                         var pagination = document.getElementById('competitionPagination');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'creative':
                         var pagination = document.getElementById('creativePagination');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'education':
                         var pagination = document.getElementById('educationPagination');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    
    function crowfundraising_FecthRequest(categories,id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'core/ajax_db/crowfundraisingView_FecthPaginat.php?pages=' + id + '&categories=' + categories, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case 'Agriculture':
                         var pagination = document.getElementById('Agriculture-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'ubworonzi':
                         var pagination = document.getElementById('ubworonzi-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'electronics':
                         var pagination = document.getElementById('electronics-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'web_apps':
                         var pagination = document.getElementById('web_apps-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'phone_app':
                         var pagination = document.getElementById('phone_app-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Arts':
                         var pagination = document.getElementById('Arts-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Film':
                         var pagination = document.getElementById('Film-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Music':
                         var pagination = document.getElementById('Music-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Fashion':
                         var pagination = document.getElementById('Fashion-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }
    

    function cartItemsCategories(categories,id,user_id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'core/ajax_db/saleView_FecthPaginat.php?pages=' + id + '&categories=' + categories+ '&user_id=' + user_id, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('sale-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }


    function cart_add(requests,formx, id,user_id) {
        var xhr = new XMLHttpRequest();
        var form = document.getElementById(formx);
        var formData = new FormData(form);
        // Add any event handlers here...
        xhr.open('POST', 'sale.php?action=' + requests + '&code=' + id + '&user_id=' + user_id, true);
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                $("#responseSubmititerm").html('<div class="alert alert-success alert-dismissible fade show text-center">'+
                     '<button class="close" data-dismiss="alert" type="button">'+
                         '<span>&times;</span>'+
                     '</button> <strong>SUCCESS</strong>'+' </div>');
                var forms = document.getElementById('responseSubmitcartiterm');
                 setInterval(function () {
                    $("#responseSubmititerm").fadeOut();
                            }, 2000);
                forms.innerHTML = xhr.responseText;
            }
        };
    }

     
    function cart_sale_add(requests, id,user_id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'shopping.php?action0=' + requests + '&code=' + id + '&user_id=' + user_id, true);
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                $("#responseSubmititerm").html('<div class="alert alert-success alert-dismissible fade show text-center">'+
                     '<button class="close" data-dismiss="alert" type="button">'+
                         '<span>&times;</span>'+
                     '</button> <strong>SUCCESS</strong>'+' </div>');
                var forms = document.getElementById('responseSubmitcartiterm');
                 setInterval(function () {
                    $("#responseSubmititerm").fadeOut();
                            }, 2000);
                forms.innerHTML = xhr.responseText;
            }
        };
    }


    function houseCategories(categories,id,user_id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'core/ajax_db/houseView_FecthPaginat.php?pages=' + id + '&categories=' + categories + '&user_id=' + user_id, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('house-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

     // THIS IS FOR FOOTER SEARCH SECTOR HOUSE

     function houseCategoriesFooter_SeachSector(categories,province,district,sector,user_id,pages){
        // $('#loader').show();
        var params = '&pages='+pages+'&categories='+categories+'&province='+province+'&district='+district+'&sector='+sector+'&user_id='+user_id;
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getcell.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() {
            //Call a function when the sector changes.
		// document.getElementById("codecell").innerHTML=http.responseText;
		// if(document.getElementById('codecell').value!=="No Cell Available")
        // $('html,body').animate({scrollTop:0},0);
        // $('html,body').animate({scrollTop:0},'slow');
                // setTimeout(() => {
                //     $('#loader').fadeOut();
                // }, 1000);
                // $(window).scrollTop(0);
                $('html,body').animate({scrollTop:100},'slow');
                var pagination = document.getElementById('house-hides');
                pagination.innerHTML = http.responseText;
		        // document.form.name.disabled=false;
		
		}		
	}
  

    function carCategories(categories,id,user_id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'core/ajax_db/carView_FecthPaginat.php?pages=' + id + '&categories=' + categories+ '&user_id=' + user_id, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('car-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    
    function foodCategories(categories,id,user_id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'core/ajax_db/foodView_FecthPaginat.php?pages=' + id + '&categories=' + categories+ '&user_id=' + user_id, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('food-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);

    }

    function xxda(requests,formx, id) {
        var xhr = new XMLHttpRequest();
        var form = document.getElementById(formx);
        var formData = new FormData(form);
        // Add any event handlers here...
        xhr.open('POST', 'food.php?actions=' + requests + '&code=' + id, true);
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                $("#responseSubmitfooditerm").html('<div class="alert alert-success alert-dismissible fade show text-center">'+
                     '<button class="close" data-dismiss="alert" type="button">'+
                         '<span>&times;</span>'+
                     '</button> <strong>SUCCESS</strong>'+' </div>');
                var forms = document.getElementById('responseSubmitfooditermview');
                 setInterval(function () {
                    $("#responseSubmitfooditerm").fadeOut();
                            }, 2000);
                forms.innerHTML = xhr.responseText;
            }
        };
    }

    
    function blog_FecthRequest(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/blog_FecthPaginat.php?pages=' + id + '&username=jojo'+'&categories=' + categories, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById(categories+'Pagination');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    
    function events_FecthRequest(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/events_FecthPaginat.php?pages=' + id + '&categories=' + categories, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case 'Party':
                         var pagination = document.getElementById('Party');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Education':
                         var pagination = document.getElementById('Education');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Government':
                         var pagination = document.getElementById('Government');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Cartoons-Movies':
                         var pagination = document.getElementById('view-more');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Africans-Movies':
                         var pagination = document.getElementById('view-more');
                         pagination.innerHTML = xhr.responseText;
                        break;
                    case  'Action':
                         var pagination = document.getElementById('Action');
                         pagination.innerHTML = xhr.responseText;
                        break;
                   
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

 
	  //Get districts list
      function showResult(){
		var provincecode=document.getElementById('provincecode').value;
		var params = "&provincecode="+provincecode+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getdistrict.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{//Call a function when the province changes.
			
		document.getElementById("districtcode").innerHTML= http.responseText;
				
		if(document.getElementById('districtcode').value!=="No District Available")
		document.form.name.disabled=false;
		
		}		
	}
	    
		
	    //Get sectors list
		function showResult2(){
		var districtcode=document.getElementById('districtcode').value;
		var params = "&districtcode="+districtcode+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getsector.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{//Call a function when the district changes.
			
		document.getElementById("sectorcode").innerHTML=http.responseText;
				
		if(document.getElementById('sectorcode').value!=="No Sector Available")
		document.form.name.disabled=false;
		
		}		
	}
	
	//Get cell list
		function showResult3(){
		var sectorcode=document.getElementById('sectorcode').value;
		var params = "&sectorcode="+sectorcode+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getcell.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{//Call a function when the sector changes.
			
		document.getElementById("codecell").innerHTML=http.responseText;
				
		if(document.getElementById('codecell').value!=="No Cell Available")
		document.form.name.disabled=false;
		
		}		
    }
	
	// Get Villages list
    function showResult4(){
		var codecell=document.getElementById('codecell').value;
		var params = "&codecell="+codecell+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getvillage.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{
            // Call a function when the cell changes.
			
		document.getElementById("CodeVillage").innerHTML=http.responseText;
				
		if(document.getElementById('CodeVillage').value!=="No village Available")
		document.form.name.disabled=false;
		
		}		
    }
    
       
    // Get Villages list
    function showResultCSector(){
        var province = document.getElementById('provincecode').value;
        var district = document.getElementById('districtcode').value;
        var sector = document.getElementById('sectorcode').value;
        // var cell = document.getElementById('codecell').value;
        var type_of_school = document.getElementById('type_of_school').value;
        var params = '&type_of_school='+type_of_school+'&province='+province+'&district='+district+'&sectorResult='+sector,
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getcell.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{
            // Call a function when the cell changes.
			
		document.getElementById("cell-hide").innerHTML=http.responseText;
				
		}		
    }

    function showResultCell(){
        var province = document.getElementById('provincecode').value;
        var district = document.getElementById('districtcode').value;
        var sector = document.getElementById('sectorcode').value;
        var cell = document.getElementById('codecell').value;
        var type_of_school = document.getElementById('type_of_school').value;
        var params = '&type_of_school='+type_of_school+'&province='+province+'&district='+district+'&sector='+sector+'&cell='+cell,
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getcell.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{
            // Call a function when the cell changes.
			
		document.getElementById("cell-hide").innerHTML=http.responseText;
				
		}		
    }

    function showResultSector_province(){
        var province = document.getElementById('provincecode').value;
        var district = document.getElementById('districtcode').value;
        var sector = document.getElementById('sectorcode').value;
        // var cell = document.getElementById('codecell').value;
        var location_province = document.getElementById('location_province').value;
        var params = '&location_province='+location_province+'&province='+province+'&district='+district+'&sector_province='+sector,
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getcell_district.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{
            // Call a function when the cell changes.
			
		document.getElementById("cell-hide").innerHTML=http.responseText;
				
		}		
    }

    function showResultCell_province(){
        var province = document.getElementById('provincecode').value;
        var district = document.getElementById('districtcode').value;
        var sector = document.getElementById('sectorcode').value;
        var cell = document.getElementById('codecell').value;
        var location_province = document.getElementById('location_province').value;
        var params = '&location_province='+location_province+'&province='+province+'&district='+district+'&sector='+sector+'&cell='+cell,
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getcell_district.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{
            // Call a function when the cell changes.
			
		document.getElementById("cell-hide").innerHTML=http.responseText;
				
		}		
    }

    function schoolCategories0(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/school_FecthPaginat.php?pages=' + id + '&categories=' + categories + '&school=school', true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('jobs-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    function schoolCategories(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/school_FecthPaginat.php?pages=' + id + '&categories=' + categories + '&school_location=school_location', true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('jobs-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    
    function unemploymentCategories(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/unemploymentView_FecthPaginat.php?pages=' + id + '&categories=' + categories, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('jobs-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }
    

    
    function employmentCategories(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/employmentView_FecthPaginat.php?pages=' + id + '&categories=' + categories, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('jobs-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }
    
    function jobsCategories(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/businessView_FecthPaginat.php?pages=' + id + '&categories=' + categories, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('jobs-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    function jobsCategories0(categories,id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/businessView_FecthPaginat.php?pages=' + id + '&categoriess=' + categories+ '&jobs0=jobs0', true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('jobs-hides');
                         pagination.innerHTML = xhr.responseText;

                        // Add any event handlers here...
                        // var get= $(xhr.responseText).find('div.px-0.py-2.jobHover.jobHovers0.more'); 
                        // var job_id = $(get).data('job');
                        // var business_id = $(get).data('business');
                        // xhr.open('POST', 'core/ajax_db/businessPostView0?job_id=' + job_id + '&business_id=' + business_id , true);
                        // xhr.send();
                        // xhr.onreadystatechange = function () {
                        //     if (xhr.readyState == 4 && xhr.status == 200) {

                        //         switch (categories) {
                        //             case categories:
                        //                 var pagination = document.getElementsByClassName('.jobslarge');
                        //                 pagination.innerHTML = xhr.responseText;
                        //                 break;
                        //                 console.log(get,business_id);

                                    
                        //         }
                        //     }
                        // };
                        break;
                    
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

    

</script>
</head>

<?php 
$self= basename($_SERVER['PHP_SELF']); 
$paths=basename($_SERVER['REQUEST_URI']);
$path=$_SERVER['REQUEST_URI'];
$result = substr(strrchr($path,'/'),1);

if (isset($_SESSION['key']) && $result === '' ){ ?>
  
  <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
  <body class="hold-transition fixed sidebar-mini-expand-feature sidebar-mini sidebar-collapse <?php echo (!empty($user['color']))? $user['color'] :'skin-blue'; ?>">
  <!-- <body class="hold-transition skin-blue fixed sidebar-collapse sidebar-mini "> -->
  <!-- Site wrapper skin-blue -->
<?php }else if (isset($_SESSION['key']) && $self === 'profile.php' || isset($_SESSION['key']) && $self === 'hashtag.php' || 
 isset($_SESSION['key']) && $self === 'balance.php' || isset($_SESSION['key']) && $self ==='profileEdit.php' || 
 isset($_SESSION['key']) && $self === 'profile_close_account.php' || isset($_SESSION['key']) && $self === 'markenting_ads.php' ||
 isset($_SESSION['key']) && $self === 'newsfeeds.php'){ ?>
  
  <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
  <body class="hold-transition fixed sidebar-mini-expand-feature sidebar-mini <?php echo (!empty($user['color']))? $user['color'] :'skin-blue'; ?>">
  <!-- <body class="hold-transition skin-blue fixed sidebar-collapse sidebar-mini "> -->
  <!-- Site wrapper skin-blue -->
<?php }else if($self === 'profile.php' || $self === 'profile_close_account.php'){ ?>

  <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
  <body class="hold-transition fixed sidebar-mini-expand-feature sidebar-mini <?php echo (!empty($user['color']))? $user['color'] :'skin-blue'; ?>">
  <!-- Site wrapper skin-blue -->

<?php }else{ ?>

  <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
  <body class="hold-transition fixed sidebar-collapse <?php echo (!empty($user['color']))? $user['color'] :'skin-blue'; ?>">
  <!-- Site wrapper skin-blue -->

<?php } ?>
<div class="wrapper">
    <!-- =============================================== -->
    <!-- navbar path -->
    <?php include 'navbar.php'; ?>
    <!-- navbar path -->
    <?php include 'siderbar.php'; ?>
   <!-- navbar path -->
    <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<?php if($device_type == 'phone') { ?>
<div class="content-wrapper">
<?php } 
if($device_type == 'computer') { ?>
<div class="content-wrapper <?php echo (!empty($user['background']))? $user['background'] :'chair'; ?> ">
<?php } ?>
