function youtube_parser(url){
  var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
  var match = url.match(regExp);
  return (match&&match[7].length==11)? match[7] : false;
}

$(document).ready(function() {

  $.post("../../scripts/dashboard.php",
    {
      widget_button_id: 0
    },
  ).done(function(res) {
    $data = JSON.parse(res);
    $("#list_widgets").empty().html($data.widgets_list);

    $.each($data.displayable_widgets, function(key, value) {
      $.get("../../scripts/widgets.php?f=" + value + "&arg=" + key)
      .done(function(res) {
        $("#sortablelist").append(res);
      });
    });
  });
  jQuery.ready();

  $(document).on("click", "#list_services a", function(event) {
    $.post("../../scripts/dashboard.php",
      {
        service_button_id: event.target.id
      },
    ).done(function(res) {
      $data = JSON.parse(res);
      $("#list_services").empty().html($data.services_list);
      $("#list_widgets").empty().html($data.widgets_list);

      $("#sortablelist div[id$='_widget']").each(function() {
        var service_id = event.target.id.replace("service_", "");
        var ids = Array.from(this.id.replace("widget_", "").replace("_widget", ""));
        console.log(event.target.id);
        if (ids[0] == service_id);
          this.remove();
      });

      if ($("#sortablelist #widget_" +  + "_" +  + "_widget").length) {
        $("#sortablelist #"+event.target.id+"_widget").remove();
      } else {
        $.each($data.displayable_widgets, function(key, value) {
          if (!$("#sortablelist #"+key).length) {
            $.get("../../scripts/widgets.php?f=" + value + "&arg=" + key)
            .done(function(res) {
              $("#sortablelist").append(res);
            });
          }
        });
      }
    });
    jQuery.ready();
  });

  $(document).on("click", "#list_widgets a", function(event) {
    $.post("../../scripts/dashboard.php",
      {
        widgetlist_button_id: event.target.id
      },
    ).done(function(res) {
      $data = JSON.parse(res);
      $("#list_widgets").empty().html($data.widgets_list);

      console.log($data.displayable_widgets);
      $.each($data.displayable_widgets, function(key, value) {
        if (!$("#sortablelist #"+key).length) {
          $.get("../../scripts/widgets.php?f=" + value + "&arg=" + key)
          .done(function(res) {
            $("#sortablelist").append(res);
          });
        }
      });
    });
    jQuery.ready();
  });

  $(document).on("click", "#sortablelist a[id^='close_']", function(event) {
    $.post("../../scripts/dashboard.php",
      {
        widget_button_id: event.target.id
      },
    ).done(function(res) {
      $data = JSON.parse(res);
      $("#list_widgets").empty().html($data.widgets_list);
      $("#"+event.target.id.replace("close_", "widget_")).remove();
    });
    jQuery.ready();
  });

  $(document).on("click", "#sortablelist a[id^='refresh_']", function(event) {
    $.post("../../scripts/dashboard.php",
      {
        refresh_widget_widget_button_id: event.target.id
      },
    ).done(function(res) {
      $data = JSON.parse(res);
      $("#list_widgets").empty().html($data.widgets_list);

      $.get("../../scripts/widgets.php?f=" + $data.display_function + "&arg=" + $data.arg)
      .done(function(res) {
        $("#"+event.target.id.replace("refresh_", "widget_")).html();
      });
    });
    jQuery.ready();
  });

  $(document).on("click", "#sortablelist a[id^='edit_']", function(event) {
    // $.post("../../scripts/dashboard.php",
    //   {
    //     edit_widget_button_id: event.target.id
    //   },
    // ).done(function(res) {
    //   $data = JSON.parse(res);
    //   $("#list_widgets").empty().html($data.widgets_list);
    //   $("#"+event.target.id.replace("close_", "widget_")).remove();
    // });
    jQuery.ready();
  });

});