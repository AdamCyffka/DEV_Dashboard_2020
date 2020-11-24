<?php

  include('../scripts/register.php');

  if (!session_id()) {
    session_start();
  }

  // if user is not logged in, they cannot access this page
  if (empty($_SESSION['userData'])) {
    header('location: login.php');
  } else {
    $username = $_SESSION['userData']['name'];
    include('../scripts/dashboard.php');
  }

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../public/css/dashboard.css">

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="../public/js/dashboard.js"></script>
</head>

<body>
  <!-- Vertical navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center"><img
          src="https://www.pngkit.com/png/full/352-3522106_home-dashboard-alternate-home-loans-logo.png" alt="..." width="65"
          class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
          <?php
            $html = "<h4 class=\"m-0\">".$username."</h4>";
            echo $html;
          ?>
          <a href="dashboard.php?logout='1'" class="font-weight-light text-muted mb-0">Disconnect</a>
        </div>
      </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Services</p>

    <ul id="list_services" class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a id="service_1" class="<?php echo "fa ".get_service_class(1)."mr-3 ml-3 fa-fw";?>"></a>
          Weather
          <i class="fa fa-cloud float-right fa-fw"></i>
        </div>
      </li>
      <li class="nav-item bg-light">
        <div class="nav-link text-dark font-italic">
          <a id="service_2" class="<?php echo "fa ".get_service_class(2)."mr-3 ml-3 fa-fw";?>" mode="button"></a>
          Youtube
          <i class="fa fa-youtube float-right fa-fw"></i>
        </div>
      </li>
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a id="service_3" class="<?php echo "fa ".get_service_class(3)."mr-3 ml-3 fa-fw";?>"></a>
          Steam
          <i class="fa fa-steam float-right fa-fw"></i>
        </div>
      </li>
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a id="service_4" class="<?php echo "fa ".get_service_class(4)."mr-3 ml-3 fa-fw";?>"></a>
          Cinema
          <i class="fa fa-film float-right fa-fw"></i>
        </div>
      </li>
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a id="service_5" class="<?php echo "fa ".get_service_class(5)."mr-3 ml-3 fa-fw";?>"></a>
          Get a joke
          <i class="fa fa-book float-right fa-fw"></i>
        </div>
      </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Widgets</p>

    <ul id="list_widgets" class="nav flex-column bg-white mb-0">
    <?php
      foreach ($all_widgets_by_services as $service => $values) {
        foreach ($values['widgets'] as $widget => $value) {

          if (!isset($user_widgets_by_services[$service]))
            continue;

          $html = "
            <li class=\"nav-item\">
              <div class=\"nav-link text-dark font-italic bg-light\" title=\"".get_widget_desc($service, $widget)."\">
                <a id=\"service_".$service."_widget_".$widget."\" class=\"fa ".get_widget_class($service, $widget)."mr-3 ml-3 fa-fw\"></a>
                ".get_widget_name($service, $widget)."
                <i class=\"fa ".get_service_logo($service)."float-right fa-fw\"></i>
              </div>
            </li>
          ";
          echo $html;
        }
      }
    ?>
    </ul>

  </div>
  <!-- End vertical navbar -->


  <!-- Page content holder -->
  <div class="page-content p-5" id="content">
    <!-- Demo content -->
    <h2 class="display-4 text-white">Dashboard</h2>
    <p class="lead text-white mb-0">Find here your favorites and useful widgets.</p>
    <div class="separator"></div>
    <div class="row text-white">
    </div>

  </div>
  <!-- End demo content -->

</body>

</html>