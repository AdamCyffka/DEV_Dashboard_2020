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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../public/css/dashboard.css">

  <script src="https://kit.fontawesome.com/e98aadb0d3.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../public/js/dashboard.js"></script>
  <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
</head>

<body>
  <!-- Vertical navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
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
    <h2 class="display-4 text-white">Dashboard</h2>
    <p class="lead text-white mb-0">Find here your favorites and useful widgets.</p>
    <div class="separator"></div>
    <div id="sortablelist" class="row text-white">

      <!-- weather widget -->
      <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-warning">
          <div class="card-header text-dark font-weight-bold mb-3">
            Weather
            <span class="float-right">
              <a class="px-1 fas fa-edit text-info"></a>
              <a class="px-1 fas fa-refresh text-success"></a>
              <a class="px-1 fas fa-times-circle text-danger"></a>
            </span>
          </div>
          <div class="card-body" style="padding-top: 0rem;">
            <div class="row align-items-center no-gutters">
              <div class="col mr-2">
                <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                  <span class="text-warning">Lille - Clear sky</span>
                </div>
                <div class="text-dark font-weight-bold h5 mb-0">
                  <span>15:31</span>
                </div>
              </div>
              <div class="col-auto">
                <span style="font-size: 3em">
                  <i class="fas fa-sun text-warning"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- load yt video widget -->
      <div class="col-md-2 col-md-4 mb-4">
        <div class="card shadow border-left-warning">
          <div class="text-dark card-header font-weight-bold mb-3">
            Youtube video
            <span class="float-right">
              <a class="px-1 fas fa-edit text-info"></a>
              <a class="px-1 fas fa-refresh text-success"></a>
              <a class="px-1 fas fa-times-circle text-danger"></a>
            </span>
          </div>
          <div class="card-body" style="padding-top: 0rem;">
            <iframe width="410" height="315" src="https://www.youtube.com/embed/EAh4L3_HTJY" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <!-- info yt video widget -->
      <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-warning">
          <div class="card-header text-dark font-weight-bold mb-3">
            Youtube information
            <span class="float-right">
              <a class="px-1 fas fa-edit text-info"></a>
              <a class="px-1 fas fa-refresh text-success"></a>
              <a class="px-1 fas fa-times-circle text-danger"></a>
            </span>
          </div>
          <div class="card-body" style="padding-top: 0rem;">
            <div class="row align-items-center no-gutters">
              <div class="col mr-2">
                <div class="text-dark font-weight-bold h5 mb-0">
                  <span>1567898</span>
                </div>
              </div>
              <div class="col-auto">
                <span style="font-size: 3em">
                  <i class="fas fa-eye text-primary"></i>
                </span>
              </div>
            </div>
            <div class="row align-items-center no-gutters">
              <div class="col mr-2">
                <div class="text-dark font-weight-bold h5 mb-0">
                  <span>1564</span>
                </div>
              </div>
              <div class="col-auto">
                <span style="font-size: 3em">
                  <i class="fas fa-thumbs-up text-primary"></i>
                </span>
              </div>
            </div>
            <div class="row align-items-center no-gutters">
              <div class="col mr-2">
                <div class="text-dark font-weight-bold h5 mb-0">
                  <span>1598</span>
                </div>
              </div>
              <div class="col-auto">
                <span style="font-size: 3em">
                  <i class="fas fa-thumbs-down text-primary"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- cinema widget -->
      <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-warning">
          <div class="card-header text-dark font-weight-bold mb-3">
            Cinema
            <span class="float-right">
              <a class="px-1 fas fa-edit text-info"></a>
              <a class="px-1 fas fa-refresh text-success"></a>
              <a class="px-1 fas fa-times-circle text-danger"></a>
            </span>
          </div>
          <div class="card-body" style="padding-top: 0rem;">
            <p class="text-center font-weight-bold text-dark">Avatar</p>
            <p class="text-center font-weight-bold text-dark">22-05-2000</p>
            <div class="row align-items-right no-gutters">
              <img
                src="https://img-4.linternaute.com/cip2YBDZkVvjU4a2tqiFIaf6Yhw=/1240x/a9bfc660898e44a19d2d36f463c9c955/ccmcms-linternaute/124775.jpg"
                class="rounded img-thumbnail img-fluid">
              <div class="col-auto" style="padding-top: 1rem;">
                <p class="text-center font-weight-bold text-dark">Malgré sa paralysie, Jake Sully, un ancien marine
                  immobilisé dans un fauteuil roulant, est resté un combattant au plus profond de son être. Il est
                  recruté pour se rendre à des années-lumière de la Terre, sur Pandora, où de puissants groupes
                  industriels exploitent un minerai rarissime destiné à résoudre la crise énergétique sur Terre.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- joke widget -->
      <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-warning">
          <div class="card-header text-dark font-weight-bold mb-3">
            Joke
            <span class="float-right">
              <a class="px-1 fas fa-edit text-info"></a>
              <a class="px-1 fas fa-refresh text-success"></a>
              <a class="px-1 fas fa-times-circle text-danger"></a>
            </span>
          </div>
          <div class="card-body" style="padding-top: 0rem;">
            <div class="row align-items-right no-gutters">
              <div class="col-auto" style="padding-top: 1rem;">
                <p class="text-center font-weight-bold text-dark">Chuck Norris is what Willis was talking about.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- steam widget -->
      <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-warning">
          <div class="card-header text-dark font-weight-bold mb-3">
            Steam
            <span class="float-right">
              <a class="px-1 fas fa-edit text-info"></a>
              <a class="px-1 fas fa-refresh text-success"></a>
              <a class="px-1 fas fa-times-circle text-danger"></a>
            </span>
          </div>
          <div class="card-body" style="padding-top: 0rem;">
            <div class="row align-items-right no-gutters">
              <div class="col-auto" style="padding-top: 1rem;">
              </div>
            </div>
          </div>
        </div>
      </div>


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