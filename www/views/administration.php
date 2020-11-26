<?php

  // var_dump($_SESSION['userData']['user_type']);
  // if ($_SESSION['userData']['user_type'] === 'admin') {
  //   header('location: dashboard.php');
  // }

  include('../scripts/dbconfig.php');

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
            <span class="badge badge-info"><?= $data['user_type'] ?></span>
          <?php elseif ($data['user_type'] === 'admin'): ?>
            <span class="badge badge-danger"><?= $data['user_type'] ?></span>
          <?php endif; ?>
        </td>
        <td>
          <a href="<?php echo "../scripts/delete.php?id=".$data['id'];?>" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>