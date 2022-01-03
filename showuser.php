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
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
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
      <li class="nav-item active">  <a class="nav-link" href="ament.php">Tontines</a></li>
      <li class="nav-item "><a class="nav-link" href="#">Cotisations</a></li>
      <li class="nav-item ">  <a class="nav-link" href="#">Prêts</a></li>
      <li class="nav-item ">  <a class="nav-link" href="#">Discutions</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfers</a></li>
    <?php include 'sideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<?php 
  $array = $con->query("select * from useraccounts,branch where useraccounts.id = '$_GET[id]' AND useraccounts.branch = branch.branchId");
  $row = $array->fetch_assoc();
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    <ins>Profile De</ins>  <?php echo "<kbd> "; echo $row['name'];echo "  ";echo $row['prenom'];echo "  #"; echo $row['accountNo']; echo "</kbd>";?>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td>Nom</td>
          <th><?php echo $row['name'] ?></th>
          <td>Prenom</td>
          <th><?php echo $row['prenom'] ?></th>
        </tr><tr>
          <td>Email</td>
          <th><?php echo $row['email'] ?></th>
          <td>Account No</td>
          <th><?php echo $row['accountNo'] ?></th>
        </tr><tr>
          <td>Genre</td>
          <th><?php echo $row['genre'] ?></th>
          <td>Parts</td>
          <th><?php echo $row['nb_par'] ?></th>
        </tr><tr>
          <td>Profession</td>
          <th><?php echo $row['source'] ?></th>
          <td>Date De Nais.</td>
          <th><?php echo $row['date_naiss'] ?></th>
        </tr><tr>
          <td>Branche</td>
          <th><?php echo $row['branchName'] ?></th>
          <td>Code Branche </td>
          <th><?php echo $row['branchNo'] ?></th>
        </tr><tr>
          <td>Solde</td>
          <th><?php echo $row['balance'] ?></th>
          <td>Type De Compte</td>
          <th><?php echo $row['accountType'] ?></th>
        </tr><tr>
          <td>NCIN</td>
          <th><?php echo $row['cnic'] ?></th>
          <td>Ville</td>
          <th><?php echo $row['city'] ?></th>
        </tr><tr>
          <td>Contact</td>
          <th><?php echo $row['number'] ?></th>
          <td>Adresse</td>
          <th><?php echo $row['address'] ?></th>
        </tr><tr>
          <td>Date De Creat.</td>
          <th colspan="3"><?php echo $row['date'] ?></th>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-footer text-muted">
    <?php echo bankname; ?>
  </div>
</div>

</body>
</html>