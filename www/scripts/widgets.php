<?php
  include_once 'widgetsParser.php';

  $functions = array(
    "display_weather_widget",
    "display_youtube_load_video_widget",
    "display_youtube_video_info_widget",
    "display_cinema_widget",
    "display_nasa_widget",
    "display_joke_widget"
  );

  if (isset($_GET['f'])) {
    if (in_array($_GET['f'], $functions)) {
      echo $_GET['f'](isset($_GET['id']) ? $_GET['id'] : "",
                      isset($_GET['refresh_rate']) ? $_GET['refresh_rate'] : "",
                      isset($_GET['arg']) ? $_GET['arg'] : "");
    }
  }

  function display_weather_widget($id, $refresh_rate, $arg) {
    $input_arg = str_replace("widget_", "input_arg_", $id);
    $input_refresh = str_replace("widget_", "input_refresh_", $id);
    $close = str_replace("widget_", "close_", $id);
    $refresh = str_replace("widget_", "refresh_", $id);
    $edit = str_replace("widget_", "edit_", $id);
    $parser = new widgetsParser();
    $data = $parser->weatherWidget($arg);
    $html = "
      <div id=\"".$id."\" class=\"col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Weather
            <span class=\"float-right\">
              <a id=\"".$edit."\" class=\"px-1 fas fa-edit text-info\"></a>
              <a id=\"".$refresh."\" class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
            <div id=\"".$input_refresh."\" class=\"input-group\" style=\"display: none;\">
              <span>Refresh Rate (s)</span>
              <input class=\"form-field\" type=\"number\" placeholder=\"60\" min=\"15\">
            </div>
            <div id=\"".$input_arg."\" class=\"input-group\" style=\"display: none;\">
              <span>".get_widget_arg_name($id)."</span>
              <input class=\"form-field\" type=\"text\" placeholder=\"".get_widget_arg_placeholder($id)."\">
            </div>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-center no-gutters\">
              <div class=\"col mr-2\">
                <div class=\"text-uppercase font-weight-bold text-xs mb-1\">
                  <span class=\"text-warning\">".$data['name']." - ".$data['description']."</span>
                </div>
                <div class=\"text-dark font-weight-bold h5 mb-0\">
                  <span>".$data['temp']." °C</span>
                </div>
              </div>
              <div class=\"col-auto\">
                <span style=\"font-size: 3em\">
                  <i class=\"fas fa-sun text-warning\"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>";
    return $html;
  }

  function display_youtube_load_video_widget($id, $refresh_rate, $arg) {
    $input_arg = str_replace("widget_", "input_arg_", $id);
    $input_refresh = str_replace("widget_", "input_refresh_", $id);
    $close = str_replace("widget_", "close_", $id);
    $refresh = str_replace("widget_", "refresh_", $id);
    $edit = str_replace("widget_", "edit_", $id);
    $html = "
      <div id=\"".$id."\" class=\"col-xl-6 mb-4\" style=\"min-height: 400px;\">
        <div class=\"card shadow border-left-warning h-100\">
          <div class=\"text-dark card-header font-weight-bold mb-3\">
            Youtube video
            <span class=\"float-right\">
              <a id=\"".$edit."\" class=\"px-1 fas fa-edit text-info\"></a>
              <a id=\"".$refresh."\" class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
            <div id=\"".$input_refresh."\" class=\"input-group\" style=\"display: none;\">
              <span>Refresh Rate (s)</span>
              <input class=\"form-field\" type=\"number\" placeholder=\"60\" min=\"15\">
            </div>
            <div id=\"".$input_arg."\" class=\"input-group\" style=\"display: none;\">
              <span>".get_widget_arg_name($id)."</span>
              <input class=\"form-field\" type=\"text\" placeholder=\"".get_widget_arg_placeholder($id)."\">
            </div>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <iframe width=\"100%\" height=\"100%\" src=\"https://youtube.com/embed/".$arg."\" frameborder=\"0\"
              allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_youtube_video_info_widget($id, $refresh_rate, $arg) {
    $input_arg = str_replace("widget_", "input_arg_", $id);
    $input_refresh = str_replace("widget_", "input_refresh_", $id);
    $close = str_replace("widget_", "close_", $id);
    $refresh = str_replace("widget_", "refresh_", $id);
    $edit = str_replace("widget_", "edit_", $id);
    $parser = new widgetsParser();
    $data = $parser->youtubeInfoWidget($arg);
    $html = "
      <div id=\"".$id."\" class=\"col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Youtube information
            <span class=\"float-right\">
              <a id=\"".$edit."\" class=\"px-1 fas fa-edit text-info\"></a>
              <a id=\"".$refresh."\" class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
            <div id=\"".$input_refresh."\" class=\"input-group\" style=\"display: none;\">
              <span>Refresh Rate (s)</span>
              <input class=\"form-field\" type=\"number\" placeholder=\"60\" min=\"15\">
            </div>
            <div id=\"".$input_arg."\" class=\"input-group\" style=\"display: none;\">
              <span>".get_widget_arg_name($id)."</span>
              <input class=\"form-field\" type=\"text\" placeholder=\"".get_widget_arg_placeholder($id)."\">
            </div>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-center no-gutters\">
              <div class=\"col mr-2\">
                <div class=\"text-dark font-weight-bold h5 mb-0\">
                  <span>".$data['view_count']."</span>
                </div>
              </div>
              <div class=\"col-auto\">
                <span style=\"font-size: 3em\">
                  <i class=\"fas fa-eye text-primary\"></i>
                </span>
              </div>
            </div>
            <div class=\"row align-items-center no-gutters\">
              <div class=\"col mr-2\">
                <div class=\"text-dark font-weight-bold h5 mb-0\">
                  <span>".$data['like_count']."</span>
                </div>
              </div>
              <div class=\"col-auto\">
                <span style=\"font-size: 3em\">
                  <i class=\"fas fa-thumbs-up text-success\"></i>
                </span>
              </div>
            </div>
            <div class=\"row align-items-center no-gutters\">
              <div class=\"col mr-2\">
                <div class=\"text-dark font-weight-bold h5 mb-0\">
                  <span>".$data['dislike_count']."</span>
                </div>
              </div>
              <div class=\"col-auto\">
                <span style=\"font-size: 3em\">
                  <i class=\"fas fa-thumbs-down text-danger\"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_cinema_widget($id, $refresh_rate, $arg) {
    $input_arg = str_replace("widget_", "input_arg_", $id);
    $input_refresh = str_replace("widget_", "input_refresh_", $id);
    $close = str_replace("widget_", "close_", $id);
    $refresh = str_replace("widget_", "refresh_", $id);
    $edit = str_replace("widget_", "edit_", $id);
    $parser = new widgetsParser();
    $data = $parser->moviesWidget($arg);
    $html = "
      <div id=\"".$id."\" class=\"col-xl-6 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Cinema
            <span class=\"float-right\">
              <a id=\"".$edit."\" class=\"px-1 fas fa-edit text-info\"></a>
              <a id=\"".$refresh."\" class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
            <div id=\"".$input_refresh."\" class=\"input-group\" style=\"display: none;\">
              <span>Refresh Rate (s)</span>
              <input class=\"form-field\" type=\"number\" placeholder=\"60\" min=\"15\">
            </div>
            <div id=\"".$input_arg."\" class=\"input-group\" style=\"display: none;\">
              <span>".get_widget_arg_name($id)."</span>
              <input class=\"form-field\" type=\"text\" placeholder=\"".get_widget_arg_placeholder($id)."\">
            </div>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <p class=\"text-center font-weight-bold text-dark\">".$data['name']."</p>
            <p class=\"text-center font-weight-bold text-dark\">".$data['release_date']."</p>
            <div class=\"row justify-content-center no-gutters\">
              <img
                src=\"http://image.tmdb.org/t/p/w185/".$data['poster_path']."\"
                class=\"rounded img-thumbnail img-fluid mx-auto\">
              <div class=\"justify-content-center\" style=\"padding-top: 1rem; white-space:pre-line;\">
                <p class=\"text-center font-weight-bold text-dark break-word\">".$data['overview'].".</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_nasa_widget($id, $refresh_rate, $arg) {
    $input_arg = str_replace("widget_", "input_arg_", $id);
    $input_refresh = str_replace("widget_", "input_refresh_", $id);
    $close = str_replace("widget_", "close_", $id);
    $refresh = str_replace("widget_", "refresh_", $id);
    $edit = str_replace("widget_", "edit_", $id);
    $parser = new widgetsParser();
    $data = $parser->nasaWidget($arg);
    $html = "
      <div id=\"".$id."\" class=\"col-xl-5 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Nasa : APOD
            <span class=\"float-right\">
              <a id=\"".$edit."\" class=\"px-1 fas fa-edit text-info\"></a>
              <a id=\"".$refresh."\" class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
            <div id=\"".$input_refresh."\" class=\"input-group\" style=\"display: none;\">
              <span>Refresh Rate (s)</span>
              <input class=\"form-field\" type=\"number\" placeholder=\"60\" min=\"15\">
            </div>
            <div id=\"".$input_arg."\" class=\"input-group\" style=\"display: none;\">
              <span>".get_widget_arg_name($id)."</span>
              <input class=\"form-field\" type=\"text\" placeholder=\"".get_widget_arg_placeholder($id)."\">
            </div>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-right no-gutters\">
              <div class=\"col-auto\" style=\"padding-top: 1rem;\">
                <img src=\"".$data."\" width=\"100%\">
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_joke_widget($id, $refresh_rate, $arg) {
    $input_arg = str_replace("widget_", "input_arg_", $id);
    $input_refresh = str_replace("widget_", "input_refresh_", $id);
    $close = str_replace("widget_", "close_", $id);
    $refresh = str_replace("widget_", "refresh_", $id);
    $edit = str_replace("widget_", "edit_", $id);
    $parser = new widgetsParser();
    $data = $parser->chuckNorrisWidget($arg);
    $html = "
      <div id=\"".$id."\" class=\"col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Joke
            <span class=\"float-right\">
              <a id=\"".$edit."\" class=\"px-1 fas fa-edit text-info\"></a>
              <a id=\"".$refresh."\" class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
            <div id=\"".$input_refresh."\" class=\"input-group\" style=\"display: none;\">
              <span>Refresh Rate (s)</span>
              <input class=\"form-field\" type=\"number\" placeholder=\"60\" min=\"15\">
            </div>
            <div id=\"".$input_arg."\" class=\"input-group\" style=\"display: none;\">
              <span>".get_widget_arg_name($id)."</span>
              <input class=\"form-field\" type=\"text\" placeholder=\"".get_widget_arg_placeholder($id)."\">
            </div>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-right no-gutters\">
              <div class=\"col-auto\" style=\"padding-top: 1rem;\">
                <p class=\"text-center font-weight-bold text-dark\">
                  ".$data[0]."
                </p>
                <br>
                <p class=\"text-center font-weight-bold text-dark\">
                  ".$data[1]."
                </p>
                <br>
                <p class=\"text-center font-weight-bold text-dark\">
                  ".$data[2]."
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function get_widget_arg_name($id) {
    switch (str_replace("widget_", "", $id)[0]) {
      case 1:
        return "City";
      case 2:
        return "Video URL";
      case 3:
        return "Day (YYYY-MM-DD)";
      case 4:
        return "Film Name";
      case 5:
        return "A Name";
      default:
        return "";
    }
  }

  function get_widget_arg_placeholder($id) {
    switch (str_replace("widget_", "", $id)[0]) {
      case 1:
        return "Paris";
      case 2:
        return "https://www.youtube.com/watch?v=nwsewSMWIas";
      case 3:
        return "2020-11-29";
      case 4:
        return "Avatar";
      case 5:
        return "Adam";
      default:
        return "";
    }
  }
?>