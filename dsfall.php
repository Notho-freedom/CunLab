
<!DOCTYPE html>
<html>
<head>
  <title>CunLab</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[delete]'"))
    {
      header("location:mindex.php");
    }
  } ?>
</head>
<body style="background:#96D678;background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <a class="navbar-brand" href="#">
    <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo bankname; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="index.php">Accueille <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="accounts.php">Comptes</a></li>
      <li class="nav-item "><a class="nav-link" href="#">Réunios</a></li>
      <li class="nav-item ">  <a class="nav-link" href="ament.php">Tontines</a></li>
      <li class="nav-item "><a class="nav-link" href="#">Cotisations</a></li>
      <li class="nav-item ">  <a class="nav-link" href="#">Prêts</a></li>
      <li class="nav-item ">  <a class="nav-link" href="dis.php">Discutions</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfers</a></li>
    </ul>
    <?php include 'sideButton.php'; ?>
  
  </div>
</nav><br><br><br>  
<pre>
    

</pre>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Tous les Comptes
  </div>
  <div class="card-body">
   <table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Utilisateurs</th>
      <th scope="col">No. Comptes</th>
      <th scope="col">Branches</th>
      <th scope="col">Balances</th>
      <th scope="col">Types Comptes</th>
      <th scope="col">Contacts</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i=0;
      $array = $con->query("select * from useraccounts,branch where useraccounts.branch = branch.branchId");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {$i++;
    ?>
      <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['accountNo'] ?></td>
        <td><?php echo $row['branchName'] ?></td>
        <td>Rs.<?php echo $row['balance'] ?></td>
        <td><?php echo $row['accountType'] ?></td>
        <td><?php echo $row['number'] ?></td>
        <td>
          <a href="show.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">Voir</a>
          <a href="msgto.php?id=<?php echo $row['id'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Send notice to this">Message</a>
        </td>
        
      </tr>
    <?php
        }
      }
     ?>
  </tbody>
</table>
  <div class="card-footer text-muted">
    <?php echo bankname; ?>
  </div>
</div>
</body>
</html>