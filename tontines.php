<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
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
    if ($con->query("delete from tontine where id = '$_GET[id]'"))
    {
      header("location:ttontines.php");
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
      <li class="nav-item active">  <a class="nav-link" href="showton.php">Tontines</a></li>
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
  if (!$con->query("insert into tontine (id,nom,nbre_mbr,montant,type,slogan,rule) values ('$_POST[id]','$_POST[name]','$_POST[nbre_mbr]','$_POST[montant]','$_POST[tonType]','$_POST[slogan]','$_POST[rule]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>Tontine Ajouter!!</div>";
    
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from tontine where id ='$_GET[del]'");
}
  
  
 ?>

<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   Nouvèlle Tontine
  </div>
  <div class="card-body bg-dark text-white">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST" autocomplete="on" accept-charset="UTF-8">
          <th>Nom</th>
          <td><input type="text" name="name" class="form-control input-sm" required placeholder="entrer le nom de la tontine..."></td>
          <th>Type</th>
          <td>
            <select class="form-control input-sm" name="tonType" required>
              <option value="Annuelle" selected>Annuelle</option>
              <option value="Trimestrielle" selected>Trimestrielle</option>
              <option value="Mensuelle" selected>Mensuelle</option>
            </select>
          </td>
        </tr>
        <tr>
          <th>Nombre De Menbre</th>
          <td><input type="number" name="nbre_mbr" min="0" value="0" class="form-control input-sm" required placeholder="entrer le Nombre De Menbre..."></td>
          <th>Solde</th>
          <td><input type="number" name="montant" min="500" value="500" class="form-control input-sm" required required placeholder="entrer un Montant..."></td>
        </tr>
        <tr>
          <th>Slogan</th>
          <td><input type="text" name="slogan" class="form-control input-sm" required placeholder="entrer le Slogan..."></td>
          <th>ID</th>
          <td><input type="" name="id" readonly value="<?php echo time() ?>" class="form-control input-sm" required></td>
        </tr>
        <tr>
          <th>Règlement</th>
          <td colspan="3"><input type="text" name="rule" class="form-control input-sm" required placeholder="entrer le Reglement..."></td>
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Creer Une Tontine</button>
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