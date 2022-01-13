<!DOCTYPE html>
<html>
<head>
  <title>Stock</title>
</head>
<body>

<h2>Stock</h2>

<table border="2">
  <tr>
    <td>Sr.No.</td>
    <td>Nom du produit</td>
    <td>Quantité en stock</td>
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

<?php mysqli_close($db); // Close connection ?>

</body>
</html>