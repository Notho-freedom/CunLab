
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
    if ($con->query("delete from proreunion where id = '$_GET[id]'"))
    {
      header("location:tproreunions.php");
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
      <li class="nav-item active">  <a class="nav-link" href="showton.php">proreunions</a></li>
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
  if (!$con->query("insert into proreunion (id,presentation,cotisation,boisson,repas,debat) values ('$_POST[id]','$_POST[presentation]','$_POST[cotisation]','$_POST[boisson]','$_POST[repas]','$_POST[debat]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>proreunion Ajouter!!</div>";
    
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from proreunion where id ='$_GET[del]'");
}
  
  
 ?>

<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   Nouveau Programme de la reunion
  </div>
  <div class="card-body bg-dark text-white">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST" autocomplete="on" accept-charset="UTF-8">
          <th>Presentation</th>
          <td><input type="times" name="presentation" class="form-control input-sm" required placeholder="entrer l'heure de presentation..."></td>
          <th>Cotisation</th>
          <td><input type="times" name="cotisation" class="form-control input-sm" required placeholder="entrer l'heure de cotisation..."></td>  
        </tr>
        <tr>
          <th>Boisson</th>
          <td><input type="times" name="boisson" class="form-control input-sm" required placeholder="entrer l'heure de boisson..."></td>
          <th>Repas</th>
          <td><input type="times" name="repas" class="form-control input-sm" required placeholder="entrer l'heure de repas..."></td>
        </tr>
        <tr>
          <th>debat</th>
          <td><input type="times" name="debat" class="form-control input-sm" required placeholder="entrer l'heure de debat..."></td>
          <th>ID</th>
          <td><input type="" name="id" readonly value="<?php echo time() ?>" class="form-control input-sm" required></td>
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Creer Une proreunion</button>
            <button type="Reset" class="btn btn-secondary btn-sm">Annuler</button></form>
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