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
    <td>Mise en production supplementaire</td>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here
if(isset($_POST['validation']))
{   
    $insert = mysqli_query($db,"UPDATE `produit` SET `quantite_en_stock`= `quantite_en_stock`+'100' WHERE `nom`='boite noire'");

    if(!$insert)
    {
        echo mysqli_error($db);
    }
    else
    {
        echo "Records added successfully.";
    }
}


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
<button name="plusBoiteBlanche">+5 boites blanches</button>
<div>+5 boites noires</div>
<form method="post">

<input type="submit" name="validation" value="Envoyer">
</form>

<?php mysqli_close($db); // Close connection ?>
</body>
</html>