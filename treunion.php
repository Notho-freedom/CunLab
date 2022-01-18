
<!DOCTYPE html>
<html>
<head>
  <title>CunLab</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from reunion where date_reunion = '$_GET[delete]'"))
    {
      header("location:treunion.php");
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
      <li class="nav-item active"><a class="nav-link" href="maccounts.php">reunions</a></li>
      <li class="nav-link "><a class="nav-link active" href="reunions.php">Creer</a>
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
    Toutes les reunions
  </div>
  <div class="card-body">
   <table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Participants</th>
      <th scope="col">Motif</th>
      <th scope="col">Beneficiaire</th>
      <th scope="col">Lieu</th>
      <th scope="col">Date de la reunion</th>
      <th scope="col">Liste de presence</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
      $i=0;
      $array = $con->query("select * from reunion");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {$i++;
    ?>
      <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row['participants'] ?></td>       
        <td><?php echo $row['motif'] ?></td>
        <td><?php echo $row['beneficiaire'] ?></td>
        <td><?php echo $row['lieu'] ?></td>
        <td><?php echo $row['date_reunion'] ?></td>
        <td><?php echo $row['liste_de_presence'] ?></td> 
              
        <td>
          <a href="showreu.php?id=<?php echo $row['date_reunion'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">Voir</a>
          <a href="pret.php?id=<?php echo $row['date_reunion'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">pret</a>
          <a href="mnotice.php?id=<?php echo $row['date_reunion'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Send notice to this">Menbres</a>
<a href="treunion.php?delete=<?php echo $row['date_reunion'] ?>
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
    CunLab
  </div>
</div>
</body>
</html>