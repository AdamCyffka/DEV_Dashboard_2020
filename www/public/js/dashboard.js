var timers = []

function youtube_parser(url){
  var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
  var match = url.match(regExp);
  return (match&&match[7].length==11)? match[7] : false;
}

function refresh_this_widget(func, id) {
  var refresh_rate = $("#" + id + " #" + id.replace("widget_", "input_refresh_") + " input").val();
  var arg = $("#" + id + " #" + id.replace("widget_", "input_arg_") + " input").val();
  var new_arg = (func == "display_youtube_load_video_widget" || func == "display_youtube_video_info_widget") ? youtube_parser(arg) : arg;
  $.get("../../scripts/widgets.php?f=" + func + "&id=" + id + "&refresh=" + refresh_rate + "&arg=" + new_arg)
  .done(function(res) {
    $("#" + id).replaceWith(res);
    $("#" + id + " #" + id.replace("widget_", "input_refresh_") + " input").val(refresh_rate);
    $("#" + id + " #" + id.replace("widget_", "input_arg_") + " input").val(arg);

    $.post("../../scripts/dashboard.php",
      {
        widget_update: true,
        widgetlist_button_id: id,
        refresh_rate: refresh_rate,
        arg: arg
      },
    )
  });
  clearInterval(timers["inter_" + id]);
  $("#" + id).ready(function() {
    timers["inter_" + id] = setInterval(function() {
      refresh_this_widget(func, id)
    }, ((refresh_rate >= 15) ? refresh_rate : 15) * 1000);
  });
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
      var new_arg = (value.function == "display_youtube_load_video_widget" || value.function == "display_youtube_video_info_widget") ? youtube_parser(value.arg) : value.arg;
      $.get("../../scripts/widgets.php?f=" + value.function + "&id=" + key + "&refresh=" + value.refresh_rate + "&arg=" + new_arg)
      .done(function(res) {
        $("#sortablelist").append(res);
        $("#" + key + " #" + key.replace("widget_", "input_refresh_") + " input").val(value.refresh_rate);
        $("#" + key + " #" + key.replace("widget_", "input_arg_") + " input").val(value.arg);
        $("#" + key).ready(function() {
          timers["inter_" + key] = setInterval(function() {
            refresh_this_widget(value.function, key)
          }, ((value.refresh_rate >= 15) ? value.refresh_rate : 15) * 1000);
        });
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
        if (ids[0] == service_id);
          this.remove();
      });

      if ($("#sortablelist #widget_" +  + "_" +  + "_widget").length) {
        $("#sortablelist #"+event.target.id+"_widget").remove();
      } else {
        $.each($data.displayable_widgets, function(key, value) {
          if (!$("#sortablelist #"+key).length) {
            var new_arg = (value.function == "display_youtube_load_video_widget" || value.function == "display_youtube_video_info_widget") ? youtube_parser(value.arg) : value.arg;
            $.get("../../scripts/widgets.php?f=" + value.function + "&id=" + key + "&refresh=" + value.refresh_rate + "&arg=" + new_arg)
            .done(function(res) {
              $("#sortablelist").append(res);
              $("#" + key + " #" + key.replace("widget_", "input_refresh_") + " input").val(value.refresh_rate);
              $("#" + key + " #" + key.replace("widget_", "input_arg_") + " input").val(value.arg);
            });
            clearInterval(timers["inter_" + key]);
            $("#" + key).ready(function() {
              timers["inter_" + key] = setInterval(function() {
                refresh_this_widget(value.function, key)
              }, ((value.refresh_rate >= 15) ? value.refresh_rate : 15) * 1000);
            });
          }
        });
      }
    });
    jQuery.ready();
  });
  
  $(document).on("click", "#list_widgets a[id^='widget_']", function(event) {
    jQuery.ready();
    $.post("../../scripts/dashboard.php",
      {
        widgetlist_button_id: event.target.id,
        refresh_rate: ($("#" + event.target.id.replace("widget_", "input_refresh_") + " input").val()) ? $("#" + event.target.id.replace("widget_", "input_refresh_") + " input").val() : $("#" + event.target.id.replace("widget_", "input_refresh_") + " input").attr("placeholder"),
        arg: ($("#" + event.target.id.replace("widget_", "input_arg_") + " input").val()) ? $("#" + event.target.id.replace("widget_", "input_arg_") + " input").val() : $("#" + event.target.id.replace("widget_", "input_arg_") + " input").attr('placeholder')
      },
    ).done(function(res) {
      $data = JSON.parse(res);

      $.each($data.displayable_widgets, function(key, value) {
        if (!$("#sortablelist #"+key).length) {
          var new_arg = (value.function == "display_youtube_load_video_widget" || value.function == "display_youtube_video_info_widget") ? youtube_parser(value.arg) : value.arg;
          $.get("../../scripts/widgets.php?f=" + value.function + "&id=" + key + "&refresh=" + value.refresh_rate + "&arg=" + new_arg)
          .done(function(res) {
            $("#sortablelist").append(res);
            $("#" + key + " #" + key.replace("widget_", "input_refresh_") + " input").val(value.refresh_rate);
            $("#" + key + " #" + key.replace("widget_", "input_arg_") + " input").val(value.arg);
          });
          clearInterval(timers["inter_" + key]);
          $("#" + key).ready(function() {
            timers["inter_" + key] = setInterval(function() {
              refresh_this_widget(value.function, key)
            }, ((value.refresh_rate >= 15) ? value.refresh_rate : 15) * 1000);
          });
        }
      });
    });
    jQuery.ready();
  });

  $(document).on("click", "#list_widgets a[id^='preedit_']", function(event) {
    $("#" + event.target.id.replace("preedit_widget_", "input_arg_")).toggle();
    $("#" + event.target.id.replace("preedit_widget_", "input_refresh_")).toggle();
    jQuery.ready();
  });

  $(document).on("click", "#sortablelist a[id^='close_']", function(event) {
    $.post("../../scripts/dashboard.php",
      {
        widget_button_id: event.target.id
      },
    ).done(function(res) {
      $data = JSON.parse(res);
      $("#"+event.target.id.replace("close_", "widget_")).remove();
    })
    clearInterval(timers["inter_" + event.target.id.replace("close_", "widget_")]);
    jQuery.ready();
  });

  $(document).on("click", "#sortablelist a[id^='edit_']", function(event) {
    $("#" + event.target.id.replace("edit_", "input_arg_")).toggle();
    $("#" + event.target.id.replace("edit_", "input_refresh_")).toggle();
    jQuery.ready();
  });

  $(document).on("click", "#sortablelist a[id^='refresh_']", function(event) {
    refresh_this_widget($("#" + event.target.id).attr("title"), event.target.id.replace("refresh_", "widget_"));
    jQuery.ready();
  });
});