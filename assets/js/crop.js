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