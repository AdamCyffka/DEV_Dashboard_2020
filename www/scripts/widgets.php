<?php
  $functions = array(
    "display_weather_widget",
    "display_youtube_load_video_widget",
    "display_youtube_video_info_widget",
    "display_cinema_widget",
    "display_steam_widget",
    "display_joke_widget"
  );

  if (isset($_GET['f'])) {
    if (in_array($_GET['f'], $functions)) {
      echo $_GET['f'](isset($_GET['arg']) ? $_GET['arg'] : "");
    }
  }

  function display_weather_widget($id) {
    $close = str_replace("widget_", "close_", $id);
    $html = "
      <div id=\"".$id."\" class=\"col-md-6 col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Weather
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-center no-gutters\">
              <div class=\"col mr-2\">
                <div class=\"text-uppercase text-success font-weight-bold text-xs mb-1\">
                  <span class=\"text-warning\">Lille - Clear sky</span>
                </div>
                <div class=\"text-dark font-weight-bold h5 mb-0\">
                  <span>15:31</span>
                </div>
              </div>
              <div class=\"col-auto\">
                <span style=\"font-size: 3em\">
                  <i class=\"fas fa-sun text-warning\></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>";
    return $html;
  }

  function display_youtube_load_video_widget($id) {
    $close = str_replace("widget_", "close_", $id);
    $html = "
      <div id=\"".$id."\" class=\"col-md-2 col-md-4 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"text-dark card-header font-weight-bold mb-3\">
            Youtube video
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <iframe width=\"410\" height=\"315\" src=\"https://www.youtube.com/embed/EAh4L3_HTJY\" frameborder=\"0\"
              allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_youtube_video_info_widget($id) {
    $close = str_replace("widget_", "close_", $id);
    $html = "
      <div id=\"".$id."\" class=\"col-md-6 col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Youtube information
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-center no-gutters\">
              <div class=\"col mr-2\">
                <div class=\"text-dark font-weight-bold h5 mb-0\">
                  <span>1567898</span>
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
                  <span>1564</span>
                </div>
              </div>
              <div class=\"col-auto\">
                <span style=\"font-size: 3em\">
                  <i class=\"fas fa-thumbs-up text-primary\"></i>
                </span>
              </div>
            </div>
            <div class=\"row align-items-center no-gutters\">
              <div class=\"col mr-2\">
                <div class=\"text-dark font-weight-bold h5 mb-0\">
                  <span>1598</span>
                </div>
              </div>
              <div class=\"col-auto\">
                <span style=\"font-size: 3em\">
                  <i class=\"fas fa-thumbs-down text-primary\"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_cinema_widget($id) {
    $close = str_replace("widget_", "close_", $id);
    $html = "
      <div id=\"".$id."\" class=\"col-md-6 col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Cinema
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <p class=\"text-center font-weight-bold text-dark\">Avatar</p>
            <p class=\"text-center font-weight-bold text-dark\">22-05-2000</p>
            <div class=\"row align-items-right no-gutters\">
              <img
                src=\"https://img-4.linternaute.com/cip2YBDZkVvjU4a2tqiFIaf6Yhw=/1240x/a9bfc660898e44a19d2d36f463c9c955/ccmcms-linternaute/124775.jpg\"
                class=\"rounded img-thumbnail img-fluid\">
              <div class=\"col-auto\" style=\"padding-top: 1rem;\">
                <p class=\"text-center font-weight-bold text-dark\">Malgré sa paralysie, Jake Sully, un ancien marine
                  immobilisé dans un fauteuil roulant, est resté un combattant au plus profond de son être. Il est
                  recruté pour se rendre à des années-lumière de la Terre, sur Pandora, où de puissants groupes
                  industriels exploitent un minerai rarissime destiné à résoudre la crise énergétique sur Terre.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_steam_widget($id) {
    $close = str_replace("widget_", "close_", $id);
    $html = "
      <div id=\"".$id."\" class=\"col-md-6 col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Steam
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-right no-gutters\">
              <div class=\"col-auto\" style=\"padding-top: 1rem;\">
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

  function display_joke_widget($id) {
    $close = str_replace("widget_", "close_", $id);
    $html = "
      <div id=\"".$id."\" class=\"col-md-6 col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Joke
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-sync text-success\"></a>
              <a id=\"".$close."\" class=\"px-1 fas fa-times-circle text-danger\"></a>
            </span>
          </div>
          <div class=\"card-body\" style=\"padding-top: 0rem;\">
            <div class=\"row align-items-right no-gutters\">
              <div class=\"col-auto\" style=\"padding-top: 1rem;\">
                <p class=\"text-center font-weight-bold text-dark\">
                  Chuck Norris is what Willis was talking about.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;
  }

?>