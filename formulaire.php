<!DOCTYPE html>
<html>
<head>
  <title>CunLab</title>
  <meta charset="utf-8">
  <?php require 'assets/autoloader.php'; ?>
</head>
<body style="background:#96D678;background-size: 100%">
<pre>
  





</pre>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   Nouveau Compte
  </div>
  <div class="card-body bg-dark text-white">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST" target="_blank" autocomplete="on" accept-charset="UTF-8" action="envoi.php">
          <th>Nom</th>
          <td><input type="text" name="name" class="form-control input-sm" required placeholder="entrer le nom..."></td>
          <th>Prenom</th>
          <td><input type="text" name="prename" class="form-control input-sm" required placeholder="entrer le prenom..."></td>
        </tr>
        <tr>
          <th>Pseudo</th>
          <td><input type="text" name="pseudo" class="form-control input-sm" required placeholder="entrer le Pseudo..."></td>
          <th>Email</th>
          <td><input type="email" name="email" class="form-control input-sm" required placeholder="entrer l'email..."></td>
        </tr>
        <tr>
          <th>Contact</th>
          <td><input type="tel" name="number"  class="form-control input-sm" required placeholder="entrer le tel..."></td>
          <th>Mot De Passe</th>
          <td><input type="password" name="password" class="form-control input-sm" required placeholder="entrer le mot de passe..."></td>
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Creer Un Compte</button>
            <button type="Reset" class="btn btn-secondary btn-sm">Annuller</button></form>
          </td>
        </tr>
      </tbody>
    </table>
    

  </div>
</div>
</body>
</html>