<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
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
  }?>
  <meta charset="utf-8">
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
      <li class="nav-item ">  <a class="nav-link" href="#">Discutions</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfers</a></li>
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
      <th scope="col">Candidats</th>
      <th scope="col">No. Comptes</th>
      <th scope="col">Contacts</th>
      <th scope="col">Campagne</th>
      <th scope="col">Votes</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i=0;
      $arrays = $con->query("select distinct * from vote where ide ='$_GET[men]'  ORDER BY `vote`.`nv` DESC");
      if ($arrays->num_rows > 0)
      {
        while ($rows = $arrays->fetch_assoc())
        {$array = $con->query("select distinct * from useraccounts,vote where useraccounts.id = '$rows[idu]'");
        $row = $array->fetch_assoc();          
        if ($array->num_rows > 0)
          {$i++;
        
    ?>
              <tr>
                <th scope="row"><?php echo $i?></th>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['accountNo'] ?></td>
                <td><?php echo $row['number'] ?></td>
                <td><?php echo $rows['cam'] ?></td>
                <td><?php echo $rows['nv'] ?></td>
                <td>
                <?php $id=$_GET['men']+$row['idu']?>
                <a href="telectionu.php?id=<?php echo $id ?>?idV=<?php echo $row['accountNo']?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="Voté">Voté</a>
                <a href="showuser.php?id=<?php echo $row['idu'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="Voir ses infos">Voir</a>
                <a href="sm.php?id=<?php echo $rows['idu'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="envoyé un Message">Message</a>
                </td>
                
              </tr>

          <?php
          }
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