<!DOCTYPE html>
<html>
<head>
  <title>Clients</title>
  <a class="retour" href="index.php">Retour à l'accueil</a>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="body-client">
<div id="bg"></div>




  <h2 class="titre">Liste des clients</h2>
  <div class="box-client">
    <table border="2">
      <tr>
        <td>Nom</td>
        <td>Prenom</td>
        <td>Adresse</td>
        <td>Adresse mail</td>
      </tr>
  </div>

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