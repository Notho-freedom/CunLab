<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>CunLab</title>
  <meta charset="utf-8">
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from msg where uid = '$_GET[delete]'"))
    {
      header("location:dis.php");
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
      <li class="nav-item active">  <a class="nav-link" href="dis.php">Discutions</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfers</a></li>
    </ul>
    <?php include 'sideButton.php'; ?>
   
  </div>
</nav><br><br><br>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Discutions
  </div>
  <div class="card-body">
   <table class="table table-bordered table-sm bg-dark text-white">
  <thead>
    <tr>
      <th scope="col">De</th>
      <th scope="col">Compte No.</th>
      <th scope="col">Contact</th>
      <th scope="col">Message</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i=0;
      $array = $con->query("select distinct * from useraccounts,msg where useraccounts.id = msg.uid AND msg.gid ='$_SESSION[userId]' ");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {
    ?>
      <tr>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['accountNo'] ?></td>
        <td><?php echo $row['number'] ?></td>
        <td><?php echo $row['mesg'] ?></td>
        <td>
        <a href="sm.php?id=<?php echo $row['uid'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Send notice to this">Répondre</a>
        <a href="showuser.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">Voir</a>
        <a href="dis.php?delete=<?php echo $row['uid'] ?>" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Delete this Message">Delete</a>
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