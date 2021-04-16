function togglePopup ( ) {
    // let disabler = document.getElementById('disabler');
    // disabler.style.display = disabler.style.display ? '' : 'none';

    // let popup = document.getElementById('popupEnd');
    // popup.style.display = popup.style.display ? '' : 'none';

    var disabler = document.getElementById('disabler');
        if (disabler.style.display) {
        disabler.style.display = '';
        } else {
        disabler.style.display = 'none';
        }

    var popup = document.getElementById('popupEnd');
        if (popup.style.display) {
        popup.style.display = '';
        } else {
        popup.style.display = 'none';
        }
}

$(document).ready(function() {

    $(".table_adminLA").DataTable({
      "lengthChange": true,
      "pageLength":10,
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  
    $(".table_admin").DataTable({
      "lengthChange": true,
      "pageLength":10,
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  
    $(".table_admin1").DataTable({
      "lengthChange": true,
      "pageLength":10,
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
  
  });
  
