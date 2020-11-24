<?php

  include('dbconfig.php');



  // INIT
  $user_widgets_by_services = array();
  $all_widgets_by_services = array();
  store_user_widgets_by_services();
  store_all_widgets_by_services();

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


  // REQUESTS

  $data = array();
  if (isset($_POST['widget_button_id'])) {
    update_widgets_list($_POST['widget_button_id']);
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    echo json_encore(array("widgets_list" => display_widgets_list()));
    unset($_POST['widget_button_id']);
  } if (isset($_POST['service_button_id'])) {
    update_services_list(str_replace("service_", "", $_POST['service_button_id']));
    store_user_widgets_by_services();
    store_all_widgets_by_services();
    echo json_encode(array("services_list" => display_services_list(), "widgets_list" => display_widgets_list()));
    unset($_POST['service_button_id']);
  }


  // FUNCTIONS

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

  function get_widget_class($service_index, $widget_index) {
    global $user_widgets_by_services;

    if (isset($user_widgets_by_services[$service_index]) and in_array($widget_index, $user_widgets_by_services[$service_index])) {
      return "fa-minus text-danger ";
    } else {
      return "fa-plus text-success ";
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
              <a id=\"service_".$service."_widget_".$widget."\" class=\"fa ".get_widget_class($service, $widget)."mr-3 ml-3 fa-fw\"></a>
              ".get_widget_name($service, $widget)."
              <i class=\"fa ".get_service_logo($service)."float-right fa-fw\"></i>
            </div>
          </li>
        ";
        $html .= $row;
      } 
    }
    return $html;
  }

  function update_services_list($button_id) {
    global $db;
    global $user_widgets_by_services;
    $services_str = "";

    if (isset($user_widgets_by_services[$button_id])) {
      unset($user_widgets_by_services[$button_id]);
      $services_str = implode(",", array_keys($user_widgets_by_services));
    } else {
      $user_widgets_by_services[$button_id] = array();
      if (sizeof($user_widgets_by_services) > 1)
        $services_str = implode(",", array_keys($user_widgets_by_services));
      else
        $services_str = $button_id;
    }

    $sql = "UPDATE user_data SET services='".$services_str."' WHERE user='".$_SESSION['userData']['id']."'";
    $result = mysqli_query($db, $sql);
    if ($result !== false && $result !== true) {
      // foreach ($result->fetch_all() as $key => $value) {
      //   $data['services'] = $value[1];
      //   $data['widgets'] = $value[2];
      // }
    } else {
      echo mysqli_error($db);
    }
  }

  function update_widgets_list($button_id) {

  }

?>