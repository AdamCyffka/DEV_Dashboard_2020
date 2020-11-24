<?php

  require_once('dbconfig.php');

  $data = array();

  // get user services and widgets
  $sql = "SELECT * FROM user_data WHERE user='1'";
  $result = mysqli_query($db, $sql);
  if ($result !== false) {
    foreach ($result->fetch_assoc() as $key => $value) {
      $data[$key] = $value;
    }
  } else {
    echo mysqli_error($db);
  }
  $_SESSION['userData']['services'] = $data['services'];
  $_SESSION['userData']['widgets'] = $data['widgets'];

  // get all services and widgets
  $data = array();
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
  unset($data);

  //fill variables with requests' datas
  $user_services = explode(",", $_SESSION['userData']['services']);
  $user_widgets = explode(";", $_SESSION['userData']['widgets']);
  $user_widgets_by_services = array();
  foreach ($user_services as $key => $value) {
    $to_add = explode(",", $user_widgets[$key]);
    if ($to_add[0] != null) {
      $user_widgets_by_services[$value] = $to_add;
    }
  }

  function get_service_class($index) {
    global $user_widgets_by_services;

    if (isset($user_widgets_by_services[$index])) {
      echo "fa-minus text-danger ";
    } else {
      echo "fa-plus text-success ";
    }
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

?>