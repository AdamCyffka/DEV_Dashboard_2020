<?php

  include('../scripts/register.php');

  if (!session_id()) {
    session_start();
  }

  // if user is not logged in, they cannot access this page
  if (empty($_SESSION['userData'])) {
    header('location: login.php');
  } else if (isset($_SESSION['userData']['confirmation']) && ($_SESSION['userData']['confirmation']) == 0) {
    header('location: login.php');
  } else {
    $username = $_SESSION['userData']['name'];
    include('../scripts/dashboard.php');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/css/dashboard.css">

  <script src="https://kit.fontawesome.com/e98aadb0d3.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../public/js/dashboard.js"></script>
  <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
  <title>Dashboard</title>
</head>

<body>
  <!-- Vertical navbar -->
  <div class="vertical-nav bg-white overflow-auto" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center"><img
          src="https://www.pngkit.com/png/full/352-3522106_home-dashboard-alternate-home-loans-logo.png" alt="..."
          width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
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
      <?php
      echo display_services_list();
    ?>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Widgets</p>

    <ul id="list_widgets" class="nav flex-column bg-white mb-0">
      <?php
      echo display_widgets_list();
    ?>
    </ul>

  </div>
  <!-- End vertical navbar -->


  <!-- Page content holder -->
  <div class="page-content p-5" id="content">
    <!-- Demo content -->
    <div class="">
      <div class="text-left">
        <h2 class="display-4 text-white">Dashboard</h2>
        <p class="lead text-white mb-0">Find here your favorites and useful widgets.</p>
      </div>
      <div class="text-right">
        <a href="#" class="text-right font-weight-bold mb-0">Refresh all</a></br>
        <?php if ($_SESSION['userData']['user_type'] === 'superadmin'): ?>
          <a href="administration.php" class="text-right font-weight-bold mb-0">Administration</a>
        <?php elseif ($_SESSION['userData']['user_type'] === 'admin'): ?>
          <a href="administration.php" class="text-right font-weight-bold mb-0">Administration</a>
        <?php endif; ?>
      </div>
    </div>
    <div class="separator"></div>
    <div id="sortablelist" class="row text-white">
    </div>

  </div>
  <!-- End demo content -->

  <script>
  new Sortable(sortablelist, {
    animation: 150,
    ghostClass: 'blue-background-class'
  });
  </script>

</body>

</html>