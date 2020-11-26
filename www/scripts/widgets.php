<?php

  function display_weather_widget() {
    $html = "
      <div class=\"col-md-6 col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Weather
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-refresh text-success\"></a>
              <a class=\"px-1 fas fa-times-circle text-danger\"></a>
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

  function display_youtube_load_video_widget() {
    $html = "
      <div class=\"col-md-2 col-md-4 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"text-dark card-header font-weight-bold mb-3\">
            Youtube video
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-refresh text-success\"></a>
              <a class=\"px-1 fas fa-times-circle text-danger\"></a>
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

  function display_youtube_video_info_widget() {
    $html = "
      <div class=\"col-md-6 col-xl-3 mb-4\">
        <div class=\"card shadow border-left-warning\">
          <div class=\"card-header text-dark font-weight-bold mb-3\">
            Youtube information
            <span class=\"float-right\">
              <a class=\"px-1 fas fa-edit text-info\"></a>
              <a class=\"px-1 fas fa-refresh text-success\"></a>
              <a class=\"px-1 fas fa-times-circle text-danger\"></a>
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

?>