
$(document).ready(function() {

  $(document).on("click", "#list_services a", function(event) {
    $.post("../../scripts/dashboard.php",
      {
        service_button_id: event.target.id
      },
    ).done(function(res) {
      $data = JSON.parse(res);
      $("#list_services").empty().html($data.services_list);
      $("#list_widgets").empty().html($data.widgets_list);
    });
    jQuery.ready();
  });

  $(document).on("click", "#list_widgets a", function(event) {
    $.post("../../scripts/dashboard.php",
      {
        widget_button_id: event.target.id
      },
    ).done(function(res) {
      $data = JSON.parse(res);
      $("#list_widgets").empty().html($data.widgets_list);
    });
    jQuery.ready();
  });

});