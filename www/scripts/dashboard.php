<?php
  include('dbconfig.php');

  // INIT
  $user_widgets_by_services = array();
  $all_widgets_by_services = array();
  $user_widgets_args = array();
  store_user_widgets_by_services();
  store_all_widgets_by_services();
  store_user_widgets_args();
  update_widgets_args();

  // REQUESTS
  $data = array();
  if (isset($_POST['widget_button_id'])) {
    $ids = explode("_", str_replace("close_", "", $_POST['widget_button_id']));
    update_widgets_list($ids[0], $ids[1]."_".$ids[2]);
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    store_user_widgets_args();
    update_widgets_args();
    echo json_encode(array("widgets_list" => display_widgets_list(), "displayable_widgets" => get_displayable_widgets()));
    unset($_POST['widget_button_id']);
  }
  
  if (isset($_POST['widgetlist_button_id'])) {
    $refresh_rate = $_POST['refresh_rate'];
    $arg = $_POST['arg'];

    $ids = explode("_", str_replace("widget_", "", $_POST['widgetlist_button_id']));
    $new_button_id = get_next_second_widget_id($ids[0], $ids[1]);
    update_widgets_list($ids[0], $ids[1]."_".$new_button_id);
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    store_user_widgets_args();
    echo json_encode(array("widgets_list" => display_widgets_list(), "displayable_widgets" => get_displayable_widgets($ids[0], $ids[1]."_".$new_button_id, $refresh_rate, $arg)));
    update_widgets_args();
    unset($_POST['widgetlist_button_id'], $_POST['refresh_rate'], $_POST['arg']);
  }
  
  if (isset($_POST['service_button_id'])) {
    update_services_list(str_replace("service_", "", $_POST['service_button_id']));
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    store_user_widgets_args();
    echo json_encode(array("services_list" => display_services_list(), "widgets_list" => display_widgets_list(), "displayable_widgets" => get_displayable_widgets()));
    update_widgets_args();
    unset($_POST['service_button_id']);
  }
  
  
  // FUNCTIONS
  
  // get user's services and widgets
  function store_user_widgets_by_services() {
    global $db;
    global $user_widgets_by_services;
    $data = array();

    $user_widgets_by_services = array();
    $sql = "SELECT * FROM user_data WHERE user='".$_SESSION['userData']['id']."'";
    $result = mysqli_query($db, $sql);
    if ($result !== false && $result !== true) {
      foreach ($result->fetch_all() as $key => $value) {
        $data['services'] = $value[1];
        $data['widgets'] = $value[2];
      }
    } else {
      echo mysqli_error($db);
    }

    $user_services = explode(",", $data['services']);
    $user_widgets = explode(";", $data['widgets']);
    $user_widgets_by_services = array();
    foreach ($user_services as $key => $value) {
      if ($value == null || $value == 0)
        break;
      $to_add = explode(",", $user_widgets[$value - 1]);
      $user_widgets_by_services[$value] = $to_add;
    }
  }

  // get all user widgets args
  function store_user_widgets_args() {
    global $db;
    global $user_widgets_args;

    $user_widgets_args = array();
    $sql = "SELECT * FROM user_instance_data WHERE user='".$_SESSION['userData']['id']."'";
    $result = mysqli_query($db, $sql);
    if ($result !== false && $result !== true) {
      foreach ($result->fetch_all() as $key => $value) {
        $user_widgets_args[$value[2]] = array_merge(
          isset($user_widgets_args[$value[2]]) ? $user_widgets_args[$value[2]] : array(),
          array($value[2] => array($value[3] => array("refresh_rate" => $value[4], "arg" => $value[5])))
        );
      }
    } else {
      echo mysqli_error($db);
    }
  }

  // get all services and widgets
  function store_all_widgets_by_services() {
    global $db;
    global $all_widgets_by_services;
    $data = array();

    $all_widgets_by_services = array();
    $sql = "SELECT * FROM service";
    $result = mysqli_query($db, $sql);
    if ($result !== false) {
      foreach ($result->fetch_all() as $index => $service) {
        $data[$service[0]] = array('name' => $service[1], 'widgets' => array());
      }
    } else {
      echo mysqli_error($db);
    }
  
    $sql = "SELECT * FROM widget";
    $result = mysqli_query($db, $sql);
    if ($result !== false) {
      foreach ($result->fetch_all() as $index => $widget) {
        if (isset($data[$widget[1]])) {
          $to_add = array(
            'name' => $widget[2],
            'description' => $widget[3],
            'args_count' => $widgets[4],
            "args" => explode(',', $widget[5]));
            $data[$widget[1]]['widgets'][$widget[0]] = $to_add;
        }
      }
    } else {
      echo mysqli_error($db);
    }
    $all_widgets_by_services = $data;
  }

  function get_service_class($index) {
    global $user_widgets_by_services;
    
    if (isset($user_widgets_by_services[$index])) {
      return "fa-minus text-danger ";
    } else {
      return "fa-plus text-success ";
    }
  }
  
  function get_service_name($service_index) {
    global $all_widgets_by_services;
    return $all_widgets_by_services[$service_index]['name'];
  }
  
  function get_widget_arg_name($service_id, $widget_id) {
    switch ($service_id) {
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

  function get_widget_arg_placeholder($service_id, $widget_id) {
    switch ($service_id) {
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

  function get_widget_name($service_index, $widget_index) {
    global $all_widgets_by_services;
    return $all_widgets_by_services[$service_index]['widgets'][$widget_index]['name'];
  }

  function get_widget_desc($service_index, $widget_index) {
    global $all_widgets_by_services;
    return $all_widgets_by_services[$service_index]['widgets'][$widget_index]['description'];
  }

  function get_service_logo($service_index) {
    switch ($service_index) {
      case 1:
        return "fa-cloud ";
      case 2:
        return "fa-youtube ";
      case 3:
        return "fa-rocket ";
      case 4:
        return "fa-film ";
      case 5:
        return "fa-book ";
      default:
        break;
    }
  }

  function display_services_list() {
    global $all_widgets_by_services;
    global $user_widgets_by_services;
    $html = "";

    foreach ($all_widgets_by_services as $service => $values) {
        $row = "
          <li class=\"nav-item\">
            <div class=\"nav-link text-dark font-italic bg-light\">
              <a id=\"service_".$service."\" class=\"fa ".get_service_class($service)."mr-3 ml-3 fa-fw\"></a>
              ".get_service_name($service)."
              <i class=\"fa ".get_service_logo($service)." float-right fa-fw\"></i>
            </div>
          </li>
        ";
        $html .= $row;
    }
    return $html;
  }

  function display_widgets_list() {
    global $all_widgets_by_services;
    global $user_widgets_by_services;
    $html = "";

    foreach ($all_widgets_by_services as $service => $values) {
      foreach ($values['widgets'] as $widget => $value) {

        if (!isset($user_widgets_by_services[$service]))
          continue;

        $row = "
          <li class=\"nav-item\">
            <div class=\"nav-link text-dark font-italic bg-light\" title=\"".get_widget_desc($service, $widget)."\">
              <a id=\"widget_".$service."_".$widget."\" class=\"fa fa-plus text-success mr-3 ml-3 fa-fw\"></a>
              ".get_widget_name($service, $widget)."
              <a id=\"preedit_widget_".$service."_".$widget."\" class=\"fa fa-edit float-right text-info fa-fw\"></a>
              <div id=\"input_refresh_".$service."_".$widget."\" class=\"input-group\" style=\"display: none;\">
                <span>Refresh Rate (s)</span>
                <input class=\"form-field\" type=\"number\" placeholder=\"60\" min=\"15\">
              </div>
              <div id=\"input_arg_".$service."_".$widget."\" class=\"input-group\" style=\"display: none;\">
                <span>".get_widget_arg_name($service, $widget)."</span>
                <input class=\"form-field\" type=\"text\" placeholder=\"".get_widget_arg_placeholder($service, $widget)."\">
              </div>
            </div>
          </li>
        ";
        $html .= $row;
      } 
    }
    return $html;
  }

  function update_services_list($service_id) {
    global $db;
    global $user_widgets_by_services;
    $services_str = "";

    if (isset($user_widgets_by_services[$service_id])) {
      unset($user_widgets_by_services[$service_id]);
      $services_str = implode(",", array_keys($user_widgets_by_services));
    } else {
      $user_widgets_by_services[$service_id] = array();
      if (sizeof($user_widgets_by_services) > 1)
        $services_str = implode(",", array_keys($user_widgets_by_services));
      else
        $services_str = $service_id;
    }

    $sql = "UPDATE user_data SET services='".$services_str."' WHERE user='".$_SESSION['userData']['id']."'";
    $result = mysqli_query($db, $sql);
    if ($result === false || $result === true)
      echo mysqli_error($db);
  }

  function update_widgets_list($service_id, $widget_id) {
    global $db;
    global $all_widgets_by_services;
    global $user_widgets_by_services;
    $widgets_str = "";
    
    foreach ($all_widgets_by_services as $key => $value) {
      if (isset($user_widgets_by_services[$key])) {
        if ($key == $service_id && in_array($widget_id, $user_widgets_by_services[$key])) {
          unset($user_widgets_by_services[$key][array_search($widget_id, $user_widgets_by_services[$key])]);
        } else if ($key == $service_id) {
          array_push($user_widgets_by_services[$key], $widget_id);
        }
        $widgets_str .= implode(",", $user_widgets_by_services[$key]);
      }
      $widgets_str .= ";";
    }
    $widgets_str = substr_replace($widgets_str, "", -1);
    $sql = "UPDATE user_data SET widgets='".$widgets_str."' WHERE user='".$_SESSION['userData']['id']."'";
    $result = mysqli_query($db, $sql);
    if ($result === false || $result === true)
      echo mysqli_error($db);
  }

  function update_widgets_args() {
    global $db;
    global $user_widgets_args;
    $args = "";
    
    foreach ($user_widgets_args as $service_id => $service_data) {
      foreach ($service_data as $index => $widget) {
        foreach($widget as $widget_id => $widget_data) {
          $sql = "SELECT COUNT(*) FROM user_instance_data WHERE user = '".$_SESSION['userData']['id']."' and service = '$service_id' and widget = '$widget_id'";
          $result = mysqli_query($db, $sql);
          if ($result !== false && mysqli_num_rows($result) == 1) {
            $data = $result->fetch_all();
            if ($data[0][0] == 1) {
              $sql = "UPDATE user_instance_data SET refresh_rate = ".$widget_data['refresh_rate'].", arg = '".$widget_data['arg']."' WHERE user = '".$_SESSION['userData']['id']."' and service = '$service_id' and widget = '$widget_id'";
            } else {
              $sql = "INSERT INTO user_instance_data (user, service, widget, refresh_rate, arg) VALUES ('".$_SESSION['userData']['id']."', '$service_id', '$widget_id', ".$widget_data['refresh_rate'].", '".$widget_data['arg']."')";
            }
            $result = mysqli_query($db, $sql);
            if ($result === false)
              echo mysqli_error($db);
          } else {
            echo mysqli_error($db);
          } 
        }
      }
    }
  }

  function get_widget_function($service_id, $widget_id) {
    switch ($service_id) {
      case 1:
        return "display_weather_widget";
      case 2:
        if ($widget_id[0] == 1)
          return "display_youtube_load_video_widget";
        else if ($widget_id[0] == 2)
          return "display_youtube_video_info_widget";
      case 3:
        return "display_nasa_widget";
      case 4:
        return "display_cinema_widget";
      case 5:
        return "display_joke_widget";
      default:
        return "";
    }
  }

  function get_displayable_widgets($service_id = -1, $widget_id = -1, $refresh_rate = -1, $arg = -1) {
    global $user_widgets_by_services;
    global $user_widgets_args;
    $ret = array();
    foreach ($user_widgets_by_services as $service => $widgets) {
      foreach ($widgets as $key => $value) {
        if ($value) {
          if ($service == $service_id && $value == $widget_id) {
            $user_widgets_args[$service][explode("_", $value)[1]][$value]['refresh_rate'] = $refresh_rate;
            $user_widgets_args[$service][explode("_", $value)[1]][$value]['arg'] = $arg;
          }
          if (isset($user_widgets_args[$service][explode("_", $value)[1]][$value])) {
            $ret["widget_".$service."_".$value."_widget"] = array(
              "function" => get_widget_function($service, $value),
              "refresh_rate" => $user_widgets_args[$service][explode("_", $value)[1]][$value]['refresh_rate'],
              "arg" => $user_widgets_args[$service][explode("_", $value)[1]][$value]['arg']
            );
          }
          // $ret["debug_".$service."_".$value."_widget"] = array(
          //   "service" => $service,
          //   "value" => $value,
          //   "service_id" => $service_id,
          //   "widget_id" => $widget_id,
          //   "user_widgets_args" => $user_widgets_args[$service][explode("_", $value)[1]][$value]
          // ); 
        }
      }
    }
    return $ret;
  }

  function get_next_second_widget_id($service_id, $widget_id) {
    global $user_widgets_by_services;
    $ret = 0;

    if (isset($user_widgets_by_services[$service_id])) {
    foreach ($user_widgets_by_services[$service_id] as $key => $value) {
        if ($value && $widget_id == strtok($value, "_"))
          $new_value = intval(substr($value, strpos($value, "_") + 1)) + 1;
          if ($new_value > $ret)
            $ret = $new_value;
      }
    }
    return strval($ret);
  }

?>