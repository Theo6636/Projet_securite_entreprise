<!DOCTYPE html>
<html>
<head>
  <title>Stock</title>
</head>
<body>

<h2>Stock</h2>
<a href="index.php?page=main">Retour à l'accueil</a>
<table border="2">
  <tr>
    <td>Sr.No.</td>
    <td>Nom du produit</td>
    <td>Quantité en stock</td>
    <td>mise en production supplementaire</td>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from produit"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['nom']; ?></td>
    <td><?php echo $data['quantite_en_stock']; ?></td>
    

  </tr>	
<?php
}
?>
</table>
<button onClick="plusBoiteBlanche()">+5 boites blanches</button>
<div>+5 boites noires</div>

<?php mysqli_close($db); // Close connection ?>

</body>
</html>