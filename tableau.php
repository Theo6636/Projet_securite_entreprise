<!DOCTYPE html>
<html>
<head>
  <title>Commandes</title>
</head>
<body>

<h2>Liste des commandes</h2>

<table border="2">
  <tr><td>commande en attente d'action</td></tr>
  <tr>
    <td>id</td>    
    <td>Nom</td>
    <td>Prenom</td>
    <td>Adresse</td>
    <td>Adresse mail</td>
    <td>Statut</td>
    <td>Action</td>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from commande"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['id']; ?></td>
    <td>Nom</td>
    <td>Prenom</td>
    <td>adresse</td>
    <td>mail</td>
    <td><?php echo $data['statut']; ?></td>
    <td>test</td>
  </tr>	
<?php
}
?>
</table>

<?php mysqli_close($db); // Close connection ?>

</body>
</html>