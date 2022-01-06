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

</head>
<body style="background:#96D678;background-size: 100%">

<style type="text/css">
li {
list-style:none !important;
color:#FFF;
padding:10px;
font-size:20px;
text-decoration:none;
}
nav ul {
background-color:#343a40;
padding:0;
margin:0;
}
nav ul li {
list-style: none;
line-height:44px;
float:left;
background-color:#343a40;
}
nav ul li a {
color:#FFF;
padding:10px;
font-size:20px;
text-decoration:none;
}
li a:hover {
border-bottom:3px #FFF solid;
}
nav ul li ul { display:none; } /* Rend le menu déroulant caché par défaut */
nav ul li:hover ul { /* Affiche la dropNav au survol de la souris avec la class .drop */
z-index:99999;
display:list-item !important;
position:absolute;
margin-top:5px;
margin-left:-10px;
}
nav ul li:hover ul li {
float:none;
}
</style>


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
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfers</a></li>
      <li class="nav-item ">  <a class="nav-link" href="feedback.php">Feedback</a></li>
      <li class="nav-link ">Evènements
      <ul class="nav-item ">
      <li><a class="nav-link active" href="pret.php">Prêts</a></li>
      <li><a class="nav-link active" href="treunion.php">Reunions</a></li>
      <li><a class="nav-link active" href="ament.php">Tontines</a></li>
      <li><a class="nav-link active" href="telection.php">Elections</a></li>
      <li><a class="nav-link active" href="tcontribution.php">Contributions</a></li>
      </ul></li>
      <li class="nav-item ">Discutions<ul>
        <li><a class="nav-link" href="dis.php">messages reçus</a></li>
        <li><a class="nav-link" href="tchat.php">Tchat</a></li>
      </ul></li>

      


    </ul>
    <?php include 'sideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<div class="container">
  <div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Vos Informations De Compte
  </div>
  <div class="card-body">
    <table class="table table-striped table-dark w-75 mx-auto">
  <thead>
    <tr>
      <td scope="col">Compte No.</td>
      <th scope="col"><?php echo $userData['accountNo']; ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Branche</th>
      <td><?php echo $userData['branchName']; ?></td>
    </tr>
    <tr>
      <th scope="row">Code Branche </th>
      <td><?php echo $userData['branchNo']; ?></td>
    </tr>
    <tr>
      <th scope="row"> Type Compte</th>
      <td><?php echo $userData['accountType']; ?></td>
    </tr>
    <tr>
      <th scope="row">Date De Creation</th>
      <td><?php echo $userData['date']; ?></td>
    </tr>
  </tbody>
</table>
      
  </div>
  <div class="card-footer text-muted">
   <?php echo bankname ?>
  </div>
</div>

</div>
</body>
</html>