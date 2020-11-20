
$(document).ready(function() {

  //getLoadedServices
  //getLoadedWidgets

  $("#list_services a").on("click", function() {
    if ($(this).hasClass("text-success")) {
      $(this).removeClass("fa-plus text-success").addClass("fa-minus text-danger");
    } else {
      $(this).removeClass("fa-minus text-danger").addClass("fa-plus text-success");
    }
  });
});