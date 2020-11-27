<?php
  include('dbconfig.php');

  // INIT
  $user_widgets_by_services = array();
  $all_widgets_by_services = array();
  store_user_widgets_by_services();
  store_all_widgets_by_services();

  // REQUESTS
  $data = array();
  if (isset($_POST['widget_button_id'])) {
    $ids = explode("_", str_replace("close_", "", $_POST['widget_button_id']));
    update_widgets_list($ids[0], $ids[1]."_".$ids[2]);
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    echo json_encode(array("widgets_list" => display_widgets_list(), "displayable_widgets" => get_displayable_widgets()));
    unset($_POST['widget_button_id']);
  } if (isset($_POST['widgetlist_button_id'])) {
    $ids = explode("_", str_replace("widget_", "", $_POST['widgetlist_button_id']));
    update_widgets_list($ids[0], $ids[1]."_".get_next_second_widget_id($ids[0], $ids[1]));
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    echo json_encode(array("widgets_list" => display_widgets_list(), "displayable_widgets" => get_displayable_widgets()));
    unset($_POST['widgetlist_button_id']);
  } if (isset($_POST['service_button_id'])) {
    update_services_list(str_replace("service_", "", $_POST['service_button_id']));
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    echo json_encode(array("services_list" => display_services_list(), "widgets_list" => display_widgets_list(), "displayable_widgets" => get_displayable_widgets()));
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
        return "fa-steam ";
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
        return "display_steam_widget";
      case 4:
        return "display_cinema_widget";
      case 5:
        return "display_joke_widget";
      default:
        return "";
    }
  }

  function get_displayable_widgets() {
    global $user_widgets_by_services;
    $ret = array();

    foreach ($user_widgets_by_services as $service => $widgets) {
      foreach ($widgets as $key => $value) {
        if ($value)
        $ret["widget_".$service."_".$value."_widget"] = get_widget_function($service, $value);
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