<?php
  $username = (isset($_POST['username'])) ? $_POST['username'] : "No one";
  $services = array();

  if ($_GET['services']) {
    $services = explode(' ', $_GET['services']);
  }

  function updateServices($index) {
    $services[$index] = ($services[$index] == 0) ? 1 : 0;
    return "?services=".implode('+', $services);
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
          <a class="font-weight-light text-muted mb-0">Disconnect</a>
        </div>
      </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Services</p>

    <ul id="list_services" class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a class="fa fa-plus mr-3 text-success fa-fw"></a>
          Weather
          <i class="fa fa-cloud mr-3 fa-fw"></i>
        </div>
      </li>
      <li class="nav-item bg-light">
        <div class="nav-link text-dark font-italic">
          <a class="fa fa-plus mr-3 text-success fa-fw" mode="button"></a>
          Youtube
          <i class="fa fa-youtube mr-3 fa-fw"></i>
        </div>
      </li>
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a class="fa fa-plus mr-3 text-success fa-fw"></a>
          Steam
          <i class="fa fa-steam mr-3 fa-fw"></i>
        </div>
      </li>
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a class="fa fa-plus mr-3 text-success fa-fw"></a>
          Cinema
          <i class="fa fa-film mr-3 fa-fw"></i>
        </div>
      </li>
      <li class="nav-item">
        <div class="nav-link text-dark font-italic bg-light">
          <a id="sub_joke" class="fa fa-plus mr-3 text-success fa-fw"></a>
          Get a joke
          <i class="fa fa-book mr-3 fa-fw"></i>
        </div>
      </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Widgets</p>
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