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
      <li class="nav-item active"><a class="nav-link" href="maccounts.php">Réunions</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>

    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<?php
$con = new mysqli('localhost','root','','CunLab');
if (isset($_POST['saveAccount']))
{
  $a=$con->query("insert into login (email,password,type) values ('$_POST[email]','$_POST[password]','$_POST[accountType]')");
  if (!$a) {
    echo "<div claass='alert alert-success'>Failed. Error is:'.$con->error.'</div>";
  }
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from login where id ='$_GET[del]'");
}
  $array = $con->query("select * from useraccounts");
  
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Comptes <button class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Nouveau Compte</button>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Email</th>
          <th>Mot De Passe</th>
          <th>Type De Compte</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if ($array->num_rows > 0)
          {
            while ($row = $array->fetch_assoc())
            {
              echo "<tr>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".$row['password']."</td>";
              echo "<td>".$row['accountType']."</td>";
              echo "<td><a href='maccounts.php?del=$row[id]' class='btn btn-danger btn-sm'>Delete</a></td>";
              echo "</tr>";
            }
          }
         ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Nouveau compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST">
          Enter Details
         <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
         <input class="form-control w-75 mx-auto" type="password" name="password" required placeholder="Mot De Passe">
         <input class="form-control w-75 mx-auto" type="text" name="accountType" required placeholder="Type de compte">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" name="saveAccount" class="btn btn-primary">Enregister</button>
      </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>