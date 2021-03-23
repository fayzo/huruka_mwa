/* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  $('#siderbarResponsive').attr('onclick','closeNav()');
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  $('#siderbarResponsive').attr('onclick', 'openNav()');
}

function fundAddmoreVideo() {
  $('#add-videohelp').show();
  $("#add-videohelp").html(
  '<div class="form-row mt-2">' +
     '<div class="col">' +
          '<div class="form-group">' +
            '<div class="btn btn-defaults btn-file">' +
     '<i class="fa fa-paperclip">' +'</i>Attachment' + 
                '<input type="file" name="video[]" id="video" multiple>' +
            '</div>' +
     '<span>' +' video</span>' +
     '<small class="help-block">' + ' (e.g mp4 )</small>' +'<br>' +
             '<span class="progress progress-hidez mt-1">' +
                     '<span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width:0%;" id="proz" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">' +'</span>' +
             '</span>' +
     '<small class="help-block">' +'Max. 10MB</small>' +
        '</div>' + 
     '</div>' +
     '<div class="col">' +
         '<div class="form-group">' +
     '<label for="">' +'youtube link</label>' +
           '<input type="text" class="form-control" name="youtube" id="youtube" placeholder="if any link of youtube video to show us of help you need ">' +
         '</div>' +
     '</div>' +
    '</div>');
  $('#add-more').attr('onclick','fundCloseVideo()');
  $('.progress-hidez').hide();
}

function AddVideo() {
  $('#add-video').show();
  $("#add-video").html(
  '<div class="form-row mt-2">' +
     '<div class="col">' +
          '<div class="form-group">' +
            '<div class="btn btn-defaults btn-file">' +
     '<i class="fa fa-paperclip">' +'</i>Attachment' + 
                '<input type="file" name="video[]" id="video" multiple>' +
            '</div>' +
     '<span>' +' video</span>' +
     '<small class="help-block">' + ' (e.g mp4 )</small>' +'<br>' +
             '<span class="progress progress-hidez mt-1">' +
                     '<span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width:0%;" id="proz" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">' +'</span>' +
             '</span>' +
     '<small class="help-block">' +'Max. 10MB</small>' +
        '</div>' + 
     '</div>' +
    '</div>');
  $('#add-more').attr('onclick','CloseVideo()');
  $('.progress-hidez').hide();
}

function Addyoutube() {
  $('#add-youtube').show();
  $("#add-youtube").html(
  '<div class="form-row mt-2">' +
     '<div class="col">' +
         '<div class="form-group">' +
     '<label for="">' +'youtube link</label>' +
           '<input type="text" class="form-control" name="youtube" id="youtube" placeholder="if any link of youtube video to show us of help you need ">' +
         '</div>' +
     '</div>' +
    '</div>');
  $('#add-more1').attr('onclick','CloseYoutube()');
}

/* Set the width of the side navigation to 0 */
function fundCloseVideo() {
  $("#add-videohelp").html(" ");
  $('#add-more').attr('onclick', 'fundAddmoreVideo()');
}

function CloseVideo() {
  $("#add-video").html(" ");
  $('#add-more').attr('onclick', 'AddVideo()');
}

function CloseYoutube() {
  $("#add-youtube").html(" ");
  $('#add-more1').attr('onclick', 'Addyoutube()');
}

function displayImage0(e) { 

  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo0");
    var selectList = document.createElement("div");
    var photo = "add-photoo";
    selectList.id = photo + [i];
    selectList.className = "col-md-4 mt-2";
    myDiv.appendChild(selectList);
  }

  function setupReader0(files, y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
        if (y < 1) {
          $('#add-photoo'+ y +'').html(
            '<div class="form-group mt-3">' +
            '<img src="#" class="profilephotoo' + y + '" alt="User Image"  width= "200px">' +
            '<input type="text" name="photo-Titleo' + y + '" class="form-control mt-1" id="photo-Titleo' + y + '" placeholder="title of photo">' +
            '</div>'
          );
        } else {
          $('#add-photoo'+ y +'').html(
            '<img src="#" class="profilephotoo' + y + '" alt="User Image"  width= "200px">'
          );
        }

        $('.profilephotoo' + y + '').attr('src', e.target.result);
      };
      reader.readAsDataURL(files, "UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader0(e.files[y], y);
  }

}

function displayImage(e) {

  var file = e.files[0];
  console.log(e.files);
  console.log(file.type );

if(file.type == "application/pdf"){

    var myDiv = document.getElementById("add-photo0");
    var selectList = document.createElement("canvas");
    var photo = "pdfViewer";
    selectList.id = photo;
    selectList.className = "col-md-4 mt-2";
    myDiv.appendChild(selectList);

  // Loaded via <script> tag, create shortcut to access PDF.js exports.
  // var pdfjsLib = window['pdfjs-dist/build/pdf'];
  // The workerSrc property shall be specified.
  // pdfjsLib.GlobalWorkerOptions.workerSrc = 'http://localhost/irangiro_social_site/assets/dist/js/pdf.worker.js';

		var fileReader = new FileReader();  
		fileReader.onload = function() {
			var pdfData = new Uint8Array(this.result);
			// Using DocumentInitParameters object to load binary data.
			var loadingTask = pdfjsLib.getDocument({data: pdfData});
			loadingTask.promise.then(function(pdf) {
			  console.log('PDF loaded');
			  
			  // Fetch the first page
			  var pageNumber = 1;
			  pdf.getPage(pageNumber).then(function(page) {
				console.log('Page loaded');
				
				var scale = 1.5;
				var viewport = page.getViewport({scale: scale});

				// Prepare canvas using PDF page dimensions
				var canvas = $("#pdfViewer")[0];
				var context = canvas.getContext('2d');
				canvas.height = viewport.height;
				canvas.width = viewport.width;

				// Render PDF page into canvas context
				var renderContext = {
				  canvasContext: context,
				  viewport: viewport
				};
				var renderTask = page.render(renderContext);
				renderTask.promise.then(function () {
				  console.log('Page rendered');
				});
			  });
			}, function (reason) {
			  // PDF loading error
			  console.error(reason);
			});
		};
		fileReader.readAsArrayBuffer(file);

  }else if(file.type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
           file.type == "application/vnd.openxmlformats-officedocument.wordprocessingml.template" ||
           file.type == "application/vnd.ms-word.document.macroEnabled.12" ||
           file.type == "application/vnd.ms-word.template.macroEnabled.12" ||
           file.type == "application/vnd.ms-excel" ||
           file.type == "application/msword" ||
           file.type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || 
           file.type == "application/vnd.openxmlformats-officedocument.spreadsheetml.template" ||
           file.type == "application/vnd.ms-excel.sheet.macroEnabled.12" ||
           file.type == "application/vnd.ms-excel.template.macroEnabled.12" ||
           file.type == "application/vnd.ms-excel.addin.macroEnabled.12"){

            for (var i = 0; i < e.files.length; i++) {
              var myDiv = document.getElementById("add-photo0");
              var selectList = document.createElement("div");
              var photo = "add-photo";
              selectList.id = photo + [i + 1];
              selectList.className = "col-md-6 mt-2";
              myDiv.appendChild(selectList);
            }
          
            function setupReader(files,y) {
              if (files) {
                var reader = new FileReader();
                reader.onload = function (e) {
                  if (y <= 5) {
                    $('#add-photo' + [y + 1] + '').html(
                      '<span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>'+
                        '<div class="mailbox-attachment-info main-active">'+
                            '<a href="" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>'+
                              '<span class="profilephoto' + y + '" ></span>' +
                            '</a>'+
                            '<span class="mailbox-attachment-size">'+
                                '<span class="filesize' + y + '" ></span>' +
                                '<a href="#" class="btn btn-default btn-sm float-right">' +
                                  '<i class="fa fa-cloud-download"></i></a>' +
                          ' </span>'+
                        '</div>'
                    );
                  } else {
                    $('#add-photo' + [y + 1] + '').html(
                      '<span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>'+
                        '<div class="mailbox-attachment-info main-active">'+
                            '<a href="" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>'+
                              '<span class="profilephoto' + y + '" ></span>' +
                            '</a>'+
                            '<span class="mailbox-attachment-size">'+
                                '<span class="filesize' + y + '" ></span>' +
                                '<a href="#" class="btn btn-default btn-sm float-right">' +
                                  '<i class="fa fa-cloud-download"></i></a>' +
                          ' </span>'+
                        '</div>'
                    );
                  }
          
                  $('.profilephoto' + y +'').html(files['name'] + ' KB');
                  $('.filesize' + y +'').html(files['size'] + ' KB');
                };
                reader.readAsDataURL(files,"UTF-8");
                // reader.readAsText(file, "UTF-8");
              }
            }
          
            for (var y = 0; y < e.files.length; y++) {
              setupReader(e.files[y],y);
            }
          
            console.log(e.files);
            console.log(e.files.length);
            
  }else if(file.type == "image/jpeg" ||file.type == "image/png" || 
  file.type == "image/gif" 

  ) {

  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo0");
    var selectList = document.createElement("div");
    var photo = "add-photo";
    selectList.id = photo + [i + 1];
    selectList.className = "col-md-4 mt-2";
    // var option = document.createElement("span");
    // var add = 'add-photomore';
    // option.id = add + [i + 1];
    // option.innerHTML = '+ add Title Photo';
    // option.className = 'btn btn-primary btn-md ';
    // var onclic = 'phototitle';
    // option.setAttribute('onclick', onclic + [i + 1] + '();');
    // selectList.appendChild(option);
    myDiv.appendChild(selectList);
  }

  function setupReader(files,y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
        if (y <= 5) {
          $('#add-photo' + [y + 1] + '').html(
            '<div class="form-group mt-3">' +
            '<img src="#" class="profilephoto' + y + '" alt="User Image"  width= "200px">' +
            '<input type="text" name="photo-Title' + y + '" class="form-control mt-1" id="photo-Title' + y + '" placeholder="title of photo">' +
            '</div>'
          );
        } else {
          $('#add-photo' + [y + 1] + '').html(
            '<img src="#" class="profilephoto' + y + '" alt="User Image"  width= "200px">'
          );
        }

        $('.profilephoto' + y +'').attr('src', e.target.result);
      };
      reader.readAsDataURL(files,"UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader(e.files[y],y);
  }

  console.log(e.files);
  console.log(e.files.length);
  
  }else if( file.type == "video/mp4" || file.type == "video/webm" ) {

  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo0");
    var selectList = document.createElement("div");
    var photo = "add-photo";
    selectList.id = photo + [i + 1];
    selectList.className = "col-md-12 mt-2";
    myDiv.appendChild(selectList);
  }

  function setupReader(files,y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
        if (y <= 5) {
          $('#add-photo' + [y + 1] + '').html(
            '<div class="form-group mt-3">' +
            '<video controls preload="auto" width="100%" height="360"> '+
            '<source src="" class="profilephoto' + y + '" type="video/mp4"> '+
'            </video>' +
            '</div>'
          );
        } else {
          $('#add-photo' + [y + 1] + '').html(
            '<div class="form-group mt-3">' +
            '<video controls preload="auto" width="100%" height="360"> '+
            '<source src="" class="profilephoto' + y + '" type="video/mp4" > '+
'            </video>' +
            '</div>'
          );
        }

        $('.profilephoto' + y +'').attr('src', e.target.result);
      };
      reader.readAsDataURL(files,"UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader(e.files[y],y);
  }

  console.log(e.files);
  console.log(e.files.length);
  
} 
// else if 
  
}
// displayImage

// UPLOAD CV AND JOB TO ONE WHO WANT TO APPLY 

function displayImageNameSizecv(e) {
  var file = e.files[0];
  console.log(e.files);
  console.log(file.type );

  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo00");
    var selectList = document.createElement("div");
    var photo = "add-photoo";
    selectList.id = photo + [i];
    selectList.className = "col-sm-12 mt-2";
    myDiv.appendChild(selectList);
  }

  function setupReader0(files, y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#add-photoo'+ y +'').html(
            '<div class="form-group mt-3"><i class="fa fa-paperclip"></i> File:' + files.name + 
            '</div>'+
            '<div class="form-group mt-3"> Size:' + formatSizeUnits(files.size)+
            '</div>'
          );
      };
      reader.readAsDataURL(files, "UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader0(e.files[y], y);
  }

}


function displayImageNameSize(e) {
  var file = e.files[0];
  console.log(e.files);
  console.log(file.type );

  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo0");
    var selectList = document.createElement("div");
    var photo = "add-photoo";
    selectList.id = photo + [i];
    selectList.className = "col-sm-12 mt-2";
    myDiv.appendChild(selectList);
  }

  function setupReader0(files, y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#add-photoo'+ y +'').html(
            '<div class="form-group mt-3"><i class="fa fa-paperclip"></i> File:' + files.name + 
            '</div>'+
            '<div class="form-group mt-3"> Size:' + formatSizeUnits(files.size)+
            '</div>'
          );
      };
      reader.readAsDataURL(files, "UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader0(e.files[y], y);
  }

}


function displayImageNameSize0(e) {
  var file = e.files[0];
  console.log(e.files);
  console.log(file.type );

  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo1");
    var selectList = document.createElement("div");
    var photo = "add-photo1";
    selectList.id = photo + [i];
    selectList.className = "col-sm-12 mt-2";
    myDiv.appendChild(selectList);
  }

  function setupReader0(files, y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#add-photo1'+ y +'').html(
            '<div class="form-group mt-3"><i class="fa fa-paperclip"></i> File:' + files.name + 
            '</div>'+
            '<div class="form-group mt-3"> Size:' + formatSizeUnits(files.size)+
            '</div>'
          );
      };
      reader.readAsDataURL(files, "UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader0(e.files[y], y);
  }


}


function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = Number($bytes / 1073741824).toFixed().toLocaleString() + ' GB';
        }
        else if ($bytes >= 1048576)
        {
            $bytes = Number($bytes / 1048576).toFixed().toLocaleString() + ' MB';
        }
        else if ($bytes >= 1024)
        {
            $bytes = Number($bytes / 1024).toFixed().toLocaleString() + ' KB';
        }
        else if ($bytes > 1)
        {
            $bytes = $bytes + ' bytes';
        }
        else if ($bytes == 1)
        {
            $bytes = $bytes + ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }