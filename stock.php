<!DOCTYPE html>
<html>
<head>
  <title>Stock</title>
</head>
<body>

<h2>Stock</h2>
<a href="index.php">Retour à l'accueil</a>
<table border="2">
  <tr>
    <td>Sr.No.</td>
    <td>Nom du produit</td>
    <td>Quantité en stock</td>
    <td>mise en production supplementaire</td>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here
if(isset($_POST['plusBoiteNoire']))
{   
    $insert = mysqli_query($db,"UPDATE `produit` SET `mis_en_prod`= `mis_en_prod`+'5' WHERE `nom`='boite noire'");

    if(!$insert)
    {
        echo mysqli_error($db);
    }
    else
    {
        echo "Records added successfully.";
    }
}
if(isset($_POST['plusBoiteBlanche']))
{   
    $insert = mysqli_query($db,"UPDATE `produit` SET `mis_en_prod`= `mis_en_prod`+'5' WHERE `nom`='boite blanche'");

    if(!$insert)
    {
        echo mysqli_error($db);
    }
    else
    {
        echo "Records added successfully.";
    }
}
if(isset($_POST['confirmer']))
{   
    $insert = mysqli_query($db,"UPDATE `produit` SET `quantite_en_stock`= `mis_en_prod`+ `quantite_en_stock`");
    $insert2 = mysqli_query($db,"UPDATE `produit` SET `mis_en_prod`= '0'");
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
    <td><?php echo $data['mis_en_prod']; ?></td>
    

  </tr>	
<?php
}
?>
</table>

<form method="post">

<input type="submit" name="plusBoiteNoire" value="+5 boites noires">
</form>
<form method="post">

<input type="submit" name="plusBoiteBlanche" value="+5 boites blanches">
</form>
<form method="post">

<input type="submit" name="confirmer" value="confirmer">
</form>

<?php mysqli_close($db); // Close connection ?>
</body>
</html>