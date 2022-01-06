<!DOCTYPE html>
<html>
<head>
  <title>CunLab</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from election where id = '$_GET[delete]'"))
    {
      header("location:telection.php");
    }
  }
  ?>
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
      <li class="nav-item active"><a class="nav-link" href="maccounts.php">election</a></li>
      <li class="nav-link "><a class="nav-link active" href="election.php">Creer</a>
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
    Toutes les election
  </div>
  <div class="card-body">
   <table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Date</th>
      <th scope="col">Type</th>
      <th scope="col">Candidats</th>
      <th scope="col">Mandat</th>
      <th scope="col">Participants</th>
      <th scope="col">Theme</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i=0;
      $array = $con->query("select * from election");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {$i++;
    ?>
      <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['date'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['candidats'] ?></td>
        <td><?php echo $row['tempt_ren'] ?></td>
        <td><?php echo $row['participants'] ?></td>
        <td><?php echo $row['terme'] ?></td>
        <td>
          <a href="showton.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">Voir</a>
          <button class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Modiffier</button>
<a href="telection.php?delete=<?php echo $row['id'] ?>
" class='btn btn-danger btn-sm' data-toggle='tooltip' 
title="Delete this account">
Supprimer</a>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modiffier l'élection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" autocomplete="on" accept-charset="UTF-8" action="election.php?id=<?php echo $row['id'] ?>">
          <p><b>Type</b></p>
          <p>
            <select class="form-control w-75 mx-auto" name="utype" required>
              <option>President</option>
              <option>Trésorié</option>
              <option>Sécrétaire</option>
              <option>Sécrétaire adjoint</option>
              <option>Commisaire au compte</option>
              <option>Commisaire au compte adjoint</option>
            </select>
          </p>
          <p><b>Fin Du Mandat</b></p>
          <p><input type="date" name="utempt_ren" min="1" value="1" class="form-control w-75 mx-auto" required placeholder="entrer le Nombre De Menbre..."></p>
          </p>
          <p><b>Thème</b></p>
          <p colspan="3"><input type="text" name="uterme" class="form-control w-75 mx-auto" required placeholder="entrer le Slogan..."></p>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuller</button>
        <button type="submit" class="btn btn-primary">Mettre à Jour</button>
      </form>
      </div>
    </div>
  </div>
</div>
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