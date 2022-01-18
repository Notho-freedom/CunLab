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
    if ($con->query("delete from election where id = '$_GET[delete]'"))
    {
      header("location:telection.php");
    }
  }else{
    if (isset($_GET['id'])) 
    { $id=$_GET['id']+$_SESSION['userId']+$_GET['idV'];
        if ($con->query("insert into partp (id,idE,idv)values('$id','$_GET[id]','$_SESSION[userId]')")) {
              setNbrv($_GET['id']);
              header("location:telectionu.php");
              echo "<div class='alert alert-success'>Merci D'avoir Voté!!!</div>";
          }else{
              echo "<div class='alert alert-warning text-center rounded-0'>Ce Vote n'est Pas Autoriser !!!</div>";
          }
          
      }
  }  ?>
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
    Toutes les election
  </div>
  <div class="card-body">
   <table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
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
        <td><?php echo $row['date'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['candidats'] ?></td>
        <td><?php echo $row['tempt_ren'] ?></td>
        <td><?php echo $row['participants'] ?></td>
        <td><?php echo $row['terme'] ?></td>
        <td>
          <a href="cand.php?men=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="Voir Les Candidatures">Candidatures</a>
          <a href="electeurs.php" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Voir qui a voté">Electeurs</a>
          <a href="vote.php?id=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Ajouter Ma Candidature">Participer</a>
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