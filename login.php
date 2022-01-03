<!DOCTYPE html>
<html>
<head>
	<title>CunLab</title>
	<?php require 'assets/autoloader.php'; ?>
					<script type="text/javascript">
						$(function () {
					  $('[data-toggle="tooltip"]').tooltip()
					})
					</script>
	<?php require 'assets/function.php'; ?>
	<?php
		define('bankName', 'CunLab',true);
    $con = new mysqli('localhost','root','','CunLab');

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
					$ar = $con->query("select * from userAccounts,branch where id = '$_SESSION[userId]' AND userAccounts.branch = branch.branchId");
					$userData = $ar->fetch_assoc();

		      header('location:index.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>email ou Mot de passe incorrect, veillez lancer un nouvelle essaie!!</div>";
		    }
		}
		if (isset($_POST['cashierLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from useraccounts where email='$user' AND password='$pass'");
		    if($result->num_rows>0)
		    { 
		      session_start();
		      $data = $result->fetch_assoc();
		      $_SESSION['cashId']=$data['id'];
		      $_SESSION['user'] = $data;
		      header('location:cindex.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>email ou Mot de passe incorrect, veillez lancer un nouvelle essaie!!</div>";
		    }
		}
		if (isset($_POST['managerLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from useraccounts where email='$user' AND password='$pass' AND accountType='Administrateur'");
		    if($result->num_rows>0)
		    { 
		      session_start();
		      $data = $result->fetch_assoc();
		      $_SESSION['managerId']=$data['id'];
		      $_SESSION['user'] = $data;
		      header('location:mindex.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>email ou Mot de passe incorrect, veillez lancer un nouvelle essaie!!</div>";
		    }
		}

	 ?>
</head>
<meta charset="utf-8">
<body style="background: url(images/l2.jpg);background-size: 100%;">

<!-- =================================================================================================-->

   
<h1 class="alert alert-success rounded-0"><?php echo bankname; ?><small class="float-right text-muted" style="font-size: 12pt;"><kbd>Bienvenu Sur CunLab</kbd></small></h1>
<br>
<?php echo $error ?>
<br>

<!-- ================================================================================================= -->

<div id="accordion" role="tablist" class="w-25 float-right shadowBlack" style="margin-right: 222px">
    <br><h4 class="text-center text-white">C O N N E C T I O N S</h4>

<!-- ================================================================================================== -->

   
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a style="text-decoration: none;" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <button class="btn btn-outline-success btn-block">Menbres</button>
        </a>
      </h5>
    </div>
 <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">

     <!-- =========================================================================== -->
       <form method="POST">


        <input type="email" name="email" class="form-control" required placeholder="Email">

        <input type="password" name="password" class="form-control" required placeholder="Password">

        <button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="userLogin">Connecter </button>


       </form>
     <!-- =========================================================================== -->

      </div>
    </div>
  </div>

<!-- ================================================================================================== -->

   
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed btn btn-outline-success btn-block" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Adminitrateurs
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
    <!-- =========================================================================== -->
         <form method="POST">


        <input type="email" name="email" class="form-control" required placeholder="Email">

        <input type="password" name="password"  class="form-control" required placeholder="Password">

        <button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="managerLogin">Connecter </button>


       </form>
    <!-- =========================================================================== -->
      </div>
    </div>
  </div>

<!-- ================================================================================================== -->

  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed btn btn-outline-success btn-block" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         Demande D'addésion
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
     <!-- =========================================================================== -->
        <form method="POST" >


        <input type="email"  name="email" class="form-control" required placeholder="Email">

        <input type="password" name="password"  class="form-control" required placeholder="Password">

        <button type="submit"  class="btn btn-primary btn-block btn-sm my-1" name="cashierLogin">Envoyée </button>
   

       </form>
     <!-- =========================================================================== -->

      </div>
    </div>
  </div>
</div>

<!-- ================================================================================================== -->
</html>