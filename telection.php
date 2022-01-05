<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
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
    if ($con->query("delete from tontine where id = '$_GET[delete]'"))
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
      <li class="nav-item active"><a class="nav-link" href="maccounts.php">Tontines</a></li>
      <li class="nav-link "><a class="nav-link active" href="tontines.php">Creer</a>
      </li>
    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<pre>
  

</pre>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Toutes les Tontines
  </div>
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
      $i=0;
      $array = $con->query("select * from tontine");
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
          <a href="mnotice.php?id=<?php echo $row['id'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Send notice to this">Menbres</a>
<a href="ttontines.php?delete=<?php echo $row['id'] ?>
" class='btn btn-danger btn-sm' data-toggle='tooltip' 
title="Delete this account">
Supprimer</a>
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