
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
    if ($con->query("delete from reunion where id = '$_GET[id]'"))
    {
      header("location:treunions.php");
    }
  } ?>
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
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> -->CunLab
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="mindex.php">Accueille <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="maccounts.php">Comptes</a></li>
      <li class="nav-item active">  <a class="nav-link" href="showton.php">reunions</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<pre>
  




  
</pre>
<?php
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into reunion (date_reunion,participants,motif,beneficiaire,lieu,liste_de_presence) values ('$_POST[date_reunion]',1,'$_POST[motif]','$_POST[beneficiaire]','$_POST[lieu]','$_POST[liste_de_presence]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>reunion Ajouter!!</div>";
    
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from reunion where id ='$_GET[del]'");
}
  
  
 ?>

<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   Nouvèlle reunion
  </div>
  <div class="card-body bg-dark text-white">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST" autocomplete="on" accept-charset="UTF-8">
          <th>Date de la reunion</th>
          <td><input type="date" name="date_reunion" class="form-control input-sm" required placeholder="entrer la date de la reunion..."></td>
          <th>Motif</th>
          <td><input type="text" name="motif" class="form-control input-sm" required placeholder="entrer le Motif..."></td>
        </tr>
        <tr>
          <th>Beneficiaire</th>
          <td><input type="text" name="beneficiaire" class="form-control input-sm" required placeholder="entrer le beneficiaire..."></td>
          <th>Lieu</th>
          <td><input type="text" name="lieu" class="form-control input-sm" required placeholder="entrer le lieu..."></td>
        </tr>
        <tr>
<th>Liste de presence</th>
          <td><input type="text" name="liste_de_presence" class="form-control input-sm" required placeholder="entrer la liste de presence..."></td>
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Creer Une reunion</button>
            <button type="Reset" class="btn btn-secondary btn-sm">Annuller</button></form>
          </td>
        </tr>
      </tbody>
    </table>
    

  </div>
  <div class="card-footer text-muted">
    CunLab
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Cashier Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST">
          Entrer les Details
         <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
         <input class="form-control w-75 mx-auto" type="password" name="password" required placeholder="Password">
         <input class="form-control w-75 mx-auto" type="text" name="accountType" required placeholder="accountType">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" name="saveAccount" class="btn btn-primary">Ajouter</button>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>