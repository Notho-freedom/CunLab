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
<pre>
    

</pre>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Retrouver Une tontine
    <form method="POST" autocomplete="on" accept-charset="UTF-8">
          <p><b>Chercher Par:
               id - Nom - Type - Nombre De Menbres
            </b>
          </p>
          <p><input type="text" name="elem" class="form-control w-75 mx-auto" required placeholder="entrer l'element à retrouver.."></p>
          </p>
     </div>
        <button type="submit" name="rech"  class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Retrouver</button>
      </form>
  <div class="card-body">
   <table class="table table-bordered table-sm">
  <thead>
  <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Type</th>
      <th scope="col">Nbre.Menbre</th>
      <th scope="col">Solde</th>
      <th scope="col">Slogan</th>
      <th scope="col">Règement</th>
      <th scope="col">Date De Creation</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
        if (isset($_POST['rech'])) 
        {
      $i=0;
      $elem = $_POST['elem'];
      $array = $con->query("select * from tontine where id='$elem' or  nom ='$elem' or  type= '$elem' or  nbre_mbr= '$elem'");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {$i++;
    ?>
      <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['nom'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['nbre_mbr'] ?></td>
        <td>Rs.<?php echo $row['montant'] ?></td>
        <td><?php echo $row['slogan'] ?></td>
        <td><?php echo $row['rule'] ?></td>
        <td><?php echo $row['date_creation'] ?></td>
        
        <td>
          <a href="showton.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">Voir</a>
          <a href="ment.php?men=<?php echo $row['id'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Send notice to this">Menbres</a>
<a href="ament.php?rej=<?php echo $row['id'] ?>
" class='btn btn-danger btn-sm' data-toggle='tooltip' 
title="Delete this account">
Rejoindre</a>
        </td>
      </tr>
<?php
      } 
    }}
    ?>

  </tbody>
</table>
  <div class="card-footer text-muted">
    <?php echo bankname; ?>
  </div>
</div>
</body>
</html>