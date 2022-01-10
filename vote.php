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
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  }else{
    if (isset($_POST['savecan'])) 
    {
        $id=$_GET['id']+$_SESSION['userId'];
      if ($con->query("insert into vote (id,ide,idu,nv,cam)values('$id','$_GET[id]','$_SESSION[userId]',0,'$_POST[cam]')"))
      {
        if ($con->query("insert into partp (id,idE,idv)values('$id','$_GET[id]','$_SESSION[userId]')")) {
            setNbrc($_GET['id']);
            echo "<div class='alert alert-success'>Votre Candidature a bien été Enregistrée!!!</div>";
        }
      }else{
        echo "<div class='alert alert-warning text-center rounded-0'>Alert: Vous ne pouvez pas avoir une Double Candidature Pour Une Même éléction!!!</div>";
      }
    }
  } ?>
  <meta charset="utf-8">
</head>
<body style="background:#96D678;background-size: 100%">
<pre>




</pre>
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
<?php 
  $array = $con->query("select * from useraccounts,branch where useraccounts.id = '$_SESSION[userId]' AND useraccounts.branch = branch.branchId");
  $row = $array->fetch_assoc();
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    <ins>Profile De</ins>  <?php echo "<kbd> "; echo $row['name'];echo "  ";echo $row['prenom'];echo "  #"; echo $row['accountNo']; echo "</kbd>";?>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td>Nom</td>
          <th><?php echo $row['name'] ?></th>
          <td>Prenom</td>
          <th><?php echo $row['prenom'] ?></th>
        </tr><tr>
          <td>Email</td>
          <th><?php echo $row['email'] ?></th>
          <td>Account No</td>
          <th><?php echo $row['accountNo'] ?></th>
        </tr><tr>
          <td>Genre</td>
          <th><?php echo $row['genre'] ?></th>
          <td>Parts</td>
          <th><?php echo $row['nb_par'] ?></th>
        </tr><tr>
          <td>Profession</td>
          <th><?php echo $row['source'] ?></th>
          <td>Date De Nais.</td>
          <th><?php echo $row['date_naiss'] ?></th>
        </tr><tr>
          <td>Branche</td>
          <th><?php echo $row['branchName'] ?></th>
          <td>Code Branche </td>
          <th><?php echo $row['branchNo'] ?></th>
        </tr><tr>
          <td>Solde</td>
          <th><?php echo $row['balance'] ?></th>
          <td>Type De Compte</td>
          <th><?php echo $row['accountType'] ?></th>
        </tr><tr>
          <td>NCIN</td>
          <th><?php echo $row['cnic'] ?></th>
          <td>Ville</td>
          <th><?php echo $row['city'] ?></th>
        </tr><tr>
          <td>Contact</td>
          <th><?php echo $row['number'] ?></th>
          <td>Adresse</td>
          <th><?php echo $row['address'] ?></th>
        </tr><tr>
          <td>Date De Creat.</td>
          <th colspan="3"><?php echo $row['date'] ?></th>
        </tr>
        <tr>
            <td colspan="4">
            <form method="POST" autocomplete="on" accept-charset="UTF-8">
                <p>Campagne: <textarea class="form-control" name="cam" required placeholder="entrez votre Campagne ici..."></textarea></p>
                <p><button type="submit" name="savecan" class="btn btn-primary btn-sm">Déposer</button></p>
            </form>
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