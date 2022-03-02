<!DOCTYPE html>
<html>
<head>
  <title>Clients</title>
  <a href="index.php">Retour à l'accueil</a>
</head>
<body>

<h2>Liste des clients</h2>

<table border="2">
  <tr>
    <td>Nom</td>
    <td>Prenom</td>
    <td>Adresse</td>
    <td>Adresse mail</td>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from client"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['nom']; ?></td>
    <td><?php echo $data['prenom']; ?></td>
    <td><?php echo $data['adresse']; ?></td>
    <td><?php echo $data['mail']; ?></td>
  </tr>	
<?php
}
?>
</table>

<?php mysqli_close($db); // Close connection ?>

</body>
</html>