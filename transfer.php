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
          $error = "<div class='alert alert-warning text-center rounded-0'>email ou Mot de passe incorrect, veillez lancer un nouvelle essaie!</div>";
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
    Faire un Transfer
  </div>
  <div class="card-body">
      <form method="POST">
          <div class="alert alert-success w-50 mx-auto">
            <h5>Nouveau Transfer</h5>
            <input type="text" name="otherNo" class="form-control " placeholder="Entrer le numéro de compte du Destinataire" required>
            <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Info Destinataire</button>
          </div>
      </form>
      <?php if (isset($_POST['get'])) 
      {
        $array2 = $con->query("select * from otheraccounts where accountNo = '$_POST[otherNo]'");
        $array3 = $con->query("select * from userAccounts where accountNo = '$_POST[otherNo]'");
        {
          if ($array2->num_rows > 0) 
          { $row2 = $array2->fetch_assoc();
            echo "<div class='alert alert-success w-50 mx-auto'>
                  <form method='POST'>
                    Compte No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Nom.
                    <input type='text' class='form-control' value='$row2[holderName]' readonly required>
                    Source.
                    <input type='text' class='form-control' value='$row2[bankName]' readonly required>
                    Entrer Le Montant à Tranferer.
                    <input type='number' name='amount' class='form-control' min='500' max='$userData[balance]' required>
                    <button type='submit' name='transfer' class='btn btn-primary btn-bloc btn-sm my-1'>Tranferer</button>
                  </form>
                </div>";
          }elseif ($array3->num_rows > 0) {
           $row2 = $array3->fetch_assoc();
            echo "<div class='alert alert-success w-50 mx-auto'>
                  <form method='POST'>
                    Compte No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Nom.
                    <input type='text' class='form-control' value='$row2[name]' readonly required>
                    Source.
                    <input type='text' class='form-control' value='".bankname."' readonly required>
                    Entrer Le Montant à Tranferer.
                    <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                    <button type='submit' name='transferSelf' class='btn btn-primary btn-bloc btn-sm my-1'>Tranferer</button>
                  </form>
                </div>";
          }
          else
            echo "<div class='alert alert-success w-50 mx-auto'>Le Compte No. $_POST[otherNo] N'existe Pas!</div>";
        }
      } 
      ?>
    <br>
    <h5>Historique des Transfers</h5>
    <?php
    if (isset($_POST['transferSelf']))
    {
      $amount = $_POST['amount'];
      setBalance($amount,'debit',$userData['accountNo']);
      setBalance($amount,'credit',$_POST['otherNo']);
      makeTransaction('transfer',$amount,$_POST['otherNo']);
      echo "<script>alert('Transfer Effectué');window.location.href='transfer.php'</script>";
    }
    if (isset($_POST['transfer']))
    {
      $amount = $_POST['amount'];
      setBalance($amount,'debit',$userData['accountNo']);
      makeTransaction('transfer',$amount,$_POST['otherNo']);
      echo "<script>alert('Transfer Effectué');window.location.href='transfer.php'</script>";
    }
      $array = $con->query("select * from transaction where userId = '$userData[id]' AND action = 'transfer' order by date desc");
      if ($array ->num_rows > 0) 
      {
         while ($row = $array->fetch_assoc()) 
         {
            if ($row['action'] == 'transfer') 
            {
              echo "<div class='alert alert-warning'>Transfer De Rs.$row[debit] effectuer à partir de votre compte le $row[date] Pour le compte N0. $row[other]</div>";
            }

         }
      }
      else
        echo "<div class='alert alert-info'>Vous n'avez éffectuer aucun Tranfer.</div>";
    ?>  
  </div>
  <div class="card-footer text-muted">
   <?php echo bankname ?>
  </div>
</div>

</div>
</body>
</html>