<?php

  include('../scripts/dbconfig.php');

  // if (isset($_SESSION['userData'])) {
  //   if (isset($_SESSION['userData']['confirmation']) && ($_SESSION['userData']['confirmation']) == 1) {
  //     header('location: dashboard.php');
  //   }
  // }

  if (isset($_SESSION['userData']['user_type']) && ($_SESSION['userData']['user_type']) == 'user') {
    header('location: dashboard.php');
  }

  $query = "SELECT * FROM user";

  // Search by username
  if (!empty($_GET['q'])) {
    $query .= " WHERE username LIKE \"%" . $_GET['q'] . "%\"";
  }

  $query .= " LIMIT 100";

  $datas = mysqli_query($db, $query);
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

<body class="p-4">
  <a href="dashboard.php" type="button" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Go back</a></br></br>
  <h1>Administration</h1>
  <form action="" class="mb-4">
    <div class="form-group">
      <input type="text" class="form-control" name="q" placeholder="Rechercher un utilisateur" value="<?= htmlentities($_GET['q'] ?? null) ?>">
    </div>
    <button class="btn btn-primary">Rechercher</button>
  </form>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Creation date</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($datas as $data): ?>
      <tr>
        <td><?= $data['id'] ?></td>
        <td><?= $data['username'] ?></td>
        <td><?= $data['email'] ?></td>
        <td><?= $data['date'] ?></td>
        <td>
          <?php if ($data['user_type'] === 'user'): ?>
            <span class="badge badge-success"><?= $data['user_type'] ?></span>
          <?php elseif ($data['user_type'] === 'admin'): ?>
            <span class="badge badge-info"><?= $data['user_type'] ?></span>
          <?php elseif ($data['user_type'] === 'superadmin'): ?>
            <span class="badge badge-warning"><?= $data['user_type'] ?></span>
          <?php endif; ?>
        </td>
        <td>
          <?php if ($_SESSION['userData']['user_type'] === 'superadmin'): ?>
            <a href="<?php echo "../scripts/delete.php?id=".$data['id'];?>" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
            <a href="<?php echo "../scripts/setSuperadmin.php?id=".$data['id'];?>" type="button" class="btn btn-warning"><i class="fas fa-users-cog"></i></a>
            <a href="<?php echo "../scripts/setAdmin.php?id=".$data['id'];?>" type="button" class="btn btn-info"><i class="fas fa-user-cog"></i></a>
            <a href="<?php echo "../scripts/setUser.php?id=".$data['id'];?>" type="button" class="btn btn-success"><i class="fas fa-user-shield"></i></a>
          <?php elseif ($_SESSION['userData']['user_type'] === 'admin'): ?>
            <a href="<?php echo "../scripts/delete.php?id=".$data['id'];?>" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
            <a href="<?php echo "../scripts/setAdmin.php?id=".$data['id'];?>" type="button" class="btn btn-info"><i class="fas fa-user-cog"></i></a>
            <a href="<?php echo "../scripts/setUser.php?id=".$data['id'];?>" type="button" class="btn btn-success"><i class="fas fa-user-shield"></i></a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>