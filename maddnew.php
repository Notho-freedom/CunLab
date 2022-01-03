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
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
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
        <a class="nav-link" href="mindex.php">Accueille <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item "><a class="nav-link" href="maccounts.php">Comptes</a></li>
      <li class="nav-item active">Creer
      <ul class="nav-item ">

      <li><a class="nav-link active" href="#">Pret</a></li>
      <li><a class="nav-link active" href="maddnew.php">Menbre</a></li>
      <li><a class="nav-link active" href="#">Reunion</a></li>
      <li><a class="nav-link active" href="tontines.php">Tontine</a></li>
      <li><a class="nav-link active" href="#">Election</a></li>
      <li><a class="nav-link active" href="#">Contribution</a></li>

      </ul>


      </li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>


    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
 <pre>
   



 </pre>
<?php
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into useraccounts (name,cnic,accountNo,accountType,city,address,email,password,balance,source,number,branch,prenom,genre,nb_par,date_naiss) values ('$_POST[name]','$_POST[cnic]','$_POST[accountNo]','$_POST[accountType]','$_POST[city]','$_POST[address]','$_POST[email]','$_POST[password]','$_POST[balance]','$_POST[source]','$_POST[number]','$_POST[branch]','$_POST[prename]','$_POST[gender]','$_POST[nbrepart]','$_POST[hbd]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>Account added Successfully</div>";

}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from login where id ='$_GET[del]'");
}
  
  
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   Nouveau Compte
  </div>
  <div class="card-body bg-dark text-white">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST" target="_blank" autocomplete="on" accept-charset="UTF-8">
          <th>Nom</th>
          <td><input type="text" name="name" class="form-control input-sm" required placeholder="entrer le nom..."></td>
          <th>NCIN</th>
          <td><input type="text" name="cnic" class="form-control input-sm" required placeholder="entrer le numero de CNI..."></td>
        </tr>
        <tr>
          <th>Prenom</th>
          <td><input type="text" name="prename" class="form-control input-sm" required placeholder="entrer le prenom..."></td>
          <th>Date De Naissance</th>
          <td><input type="date" name="hbd" class="form-control input-sm" required ></td>
        </tr>
        <tr>
          <th>Genre</th>
          <td><input type="text" name="gender" class="form-control input-sm" required placeholder="entrer le genre..."></td>
          <th>Nombre De Depart</th>
          <td><input type="number" name="nbrepart" min="1" class="form-control input-sm" required placeholder="entrer le nombre de part..."></td>
        </tr>
        <tr>
          <th>Ville</th>
          <td><input type="text" name="city" class="form-control input-sm" required placeholder="entrer la ville..."></td>
          <th>Address</th>
          <td><input type="text" name="address" class="form-control input-sm" required placeholder="entrer l'adresse..."></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><input type="email" name="email" class="form-control input-sm" required placeholder="entrer l'email..."></td>
          <th>Mot De Passe</th>
          <td><input type="password" name="password" class="form-control input-sm" required placeholder="entrer le mot de passe..."></td>
        </tr>
        <tr>
          <th>Contact</th>
          <td><input type="tel" name="number"  class="form-control input-sm" required placeholder="entrer le tel..."></td>
          <th>Fonction</th>
          <td>
            <select name="branch" required class="form-control input-sm">
              <option selected value="">Selectionner la Fontion</option>
              <?php 
                $arr = $con->query("select * from branch");
                if ($arr->num_rows > 0)
                {
                  while ($row = $arr->fetch_assoc())
                  {
                    echo "<option value='$row[branchId]'>$row[branchName]</option>";
                  }
                }
                else
                  echo "<option value='1'>Main Branch</option>";
               ?>
            </select>
          </td>
        </tr>
        <tr>
          <th>Profession</th>
          <td><input type="text" name="source" class="form-control input-sm" required placeholder="entrer la Profession..."></td>
          <th>Montant De Depart</th>
          <td><input type="number" name="balance" min="500" class="form-control input-sm" required required placeholder="entrer un Montant..."></td>
        </tr>
        <tr>
          <th>ID Compte</th>
          <td><input type="" name="accountNo" readonly value="<?php echo time() ?>" class="form-control input-sm" required></td>
          <th>Type de Compte</th>
          <td>
            <select class="form-control input-sm" name="accountType" required>
              <option value="Menbre" selected>Menbre</option>
              <option value="Autre" selected>Autres</option>
              <option value="Administrateur" selected>Administrateur</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Creer Un Compte</button>
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
         <select class="form-control w-75 mx-auto" name="accountType" required>
              <option value="Menbre" selected>Menbre</option>
              <option value="Autre" selected>Autres</option>
              <option value="Administrateur" selected>Administrateur</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" name="saveAccount" class="btn btn-primary">Enregistrer Le Compte</button>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>