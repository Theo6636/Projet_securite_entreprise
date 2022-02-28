<!DOCTYPE html>
<html>
<head>
  <title>Creation de commande</title>
</head>
<body>

<?php
include "dbConn.php"; // Using database connection file here

if(isset($_POST['submit']))
{		
    $quantite = intval($_POST['quantite']);
    $produit = intval($_POST['produitlist']);
    $statut = 'Created';
    $facturation = '0';
    $id_commande = '2';
    $id_client = intval($_POST['clientlist']);
    $id_metier_en_charge = '1';
    $id = '1';

    $insert = mysqli_query($db,"INSERT INTO `commande`(`statut`,`facturation`,`id_commande`,`id_client`,`id_metier_en_charge`,`quantite`, `id_produit`) VALUES ('$statut','$facturation','$id_commande','$id_client','$id_metier_en_charge','$quantite','$produit')");

    if(!$insert)
    {
        echo mysqli_error($db);
    }
    else
    {
        echo "Records added successfully.";
    }
}


?>

<h3>Creation de commande</h3>

<form method="POST">
  Produit : 

  <select name="produitlist">;
<?php
include "dbConn.php"; // Using database connection file here

$fetch_produit = mysqli_query($db,"SELECT id,nom FROM produit");


while($throw_produit = mysqli_fetch_array($fetch_produit)) {
echo '<option   value=\"'.$throw_produit[0].'">'.$throw_produit[1].'</option>';
}
echo "</select>";

mysqli_close($db); // Close connection
?>
  <br/>
  Quantite : <input type="number" name="quantite"  Required>
  <br/>
  Client : 
  <select name="clientlist">;
  <?php
include "dbConn.php"; // Using database connection file here

$fetch_client = mysqli_query($db,"SELECT id,nom,prenom FROM client");
while($throw_client = mysqli_fetch_array($fetch_client)) {
  echo '<option   value=\"'.$throw_client[0].'">'.$throw_client[1],' ',$throw_client[2].'</option>';
  }
  echo "</select>";
mysqli_close($db); // Close connection
  ?>
  <br/>
  <input type="submit" name="submit" value="Envoyer">
</form>

</body>
</html>