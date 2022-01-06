<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>CunLab</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php
    $error = "";
    if (isset($_POST['userLogin']))
    {
      $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];
       
        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if($result->num_rows>0)
        { 
          session_start();
          $data = $result->fetch_assoc();
          $_SESSION['userId']=$data['id'];
          $_SESSION['user'] = $data;
          header('location:index.php');
         }
        else
        {
          $error = "<div class='alert alert-warning text-center rounded-0'>email ou Mot de passe incorrect, veillez lancer un nouvelle essaie!!</div>";
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
<div class="container">
  <div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Message D'aide
  </div>
  <div class="card-body">
      <form method="POST">
          <div class="alert alert-success w-50 mx-auto">
            <h5>Entrer votre message</h5>
            <textarea class="form-control" name="msg" required placeholder="message"></textarea>
            <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Envoyé</button>
          </div>
      </form>
      
    <br>
  
    <?php
    if (isset($_POST['send']))
    {
      if ($con->query("insert into feedback (message,userId) values ('$_POST[msg]','$_SESSION[userId]')")) {
        echo "<div class='alert alert-success'>Message Envoyé</div>";
      }else
      echo "<div class='alert alert-danger'>Message Non Envoyé Error is:".$con->error."</div>";
    }
    
    ?>  
  </div>
  <div class="card-footer text-muted">
   <?php echo bankname ?>
  </div>
</div>

</div>
</body>
</html>