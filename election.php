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
    if ($con->query("delete from election where id = '$_GET[id]'"))
    {
    }
  }else{
    if (isset($_GET['id'])) 
    {$t=$_POST['utype'];
    $tp=$_POST['utempt_ren'];
    $utm=$_POST['uterme'];
    $id= $_GET['id'];
      if ($con->query("update election set type='$t', tempt_ren='$tp', terme='$utm'  where id ='$id'"))
      {
        header("location:mtelection.php");
      }
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
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo bankname; ?>
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
      <li class="nav-item active">  <a class="nav-link" href="showton.php">elections</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<?php
if (isset($_POST['saveAccount']))
{
  $id= time();
  if (!$con->query("insert into election (id,terme,tempt_ren,type) values ('$id','$_POST[terme]','$_POST[tempt_ren]','$_POST[type]')")) {
    echo "<div class='alert alert-info text-center'>Alert: Deux instances d'une même éléction ne peuvent existées.</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>éléction Ajouter!!</div>";
    
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from election where id ='$_GET[del]'");
}
  
  
 ?>

<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   Nouvèlle Election
  </div>
  <div class="card-body bg-dark text-white">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST" autocomplete="on" accept-charset="UTF-8">
          <th>Type</th>
          <td>
            <select class="form-control input-sm" name="type" required>
              <option>President</option>
              <option>Trésorié</option>
              <option>Sécrétaire</option>
              <option>Sécrétaire adjoint</option>
              <option>Commisaire au compte</option>
              <option>Commisaire au compte adjoint</option>
            </select>
          </td>
          <th>Fin Du Mandat</th>
          <td><input type="date" name="tempt_ren" min="1" value="1" class="form-control input-sm" required placeholder="entrer le Nombre De Menbre..."></td>
          </td>
        </tr>
        <tr>
          <th>Thème</th>
          <td colspan="3"><input type="text" name="terme" class="form-control input-sm" required placeholder="entrer le Slogan..."></td>
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Creer Une election</button>
            <button type="Reset" class="btn btn-secondary btn-sm">Annuller</button></form>
          </td>
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