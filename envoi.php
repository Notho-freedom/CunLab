<?php
require 'assets/autoloader.php';
$nom = $_POST['name'];
$prenom = $_POST['prename'];
$pseudo = $_POST['pseudo'];                                            
$number = $_POST['number'];   
$password = $_POST['password'];
$email = $_POST['email'];

?>
<?php
echo "<HTML><HEAD>";
echo "<TITLE>Formulaire envoyer!</TITLE></HEAD><BODY>";
echo "<H1 align=center>Merci $nom </H1>";
echo "<P align=center>";
echo "Votre formulaire à bien été envoyé !</P>";
echo "<div class='container'>";
echo "<div class='card w-100 text-center shadowBlue'>";
echo "<div class='card-header'>";
echo "<ins>Informations enregistrées</ins>";
echo "</div>";
echo "<div class='card-body'>";
echo "<table class='table table-bordered'>";
echo "<tbody>";
echo "<tr>";
echo "<td>Nom</td>";
echo "<th> $nom</th>";
echo "<td>Prenom</td>";
echo "<th> $prenom</th>";
echo "</tr><tr>";
echo "<td>Pseudo</td>";
echo "<th> $pseudo</th>";
echo "<td>Email</td>";
echo "<th> $number</th>";
echo "</tr><tr>";
echo "<td>Contact</td>";
echo "<th> $email</th>";
echo "<td>Mot De Passe</td>";
echo "<th> $password</th>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";

echo "</BODY></HTML>";

?> 