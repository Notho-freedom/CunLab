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
      <li class="nav-item ">  <a class="nav-link" href="statements.php">Historique Des Tranfers </a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfers</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->

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