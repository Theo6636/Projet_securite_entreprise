<!DOCTYPE html>
<html>
<head>
  <title>Creation de commande</title>
</head>
<body>

<?php
include "dbConn.php"; // Using database connection file here

if(isset($_POST['validation']))
{		
    $quantite = intval($_POST['quantite']);
    $produit = intval($_POST['produitlist']);
    $statut = 'Created';
    $facturation = '0';
    $id_commande = intval($_POST['id_commande']);
    $id_client = intval($_POST['clientlist']);
    $id_metier_en_charge = '1';

    $insert = mysqli_query($db,"INSERT INTO `commande`(`statut`,`facturation`,`id_commande`,`id_client`,`id_metier_en_charge`,`quantite`, `id_produit`) VALUES ('$statut','$facturation','$id_commande','$id_client','$id_metier_en_charge','$quantite','$produit')");
    header("Refresh: 0;");

}


?>

<h3>Creation de commande</h3>

<form method="POST">
  ID de la commande : <input type="number" name="id_commande"  Required>
  <br/>
  Produit : 


  <select name="produitlist">;
<?php
include "dbConn.php"; // Using database connection file here

$fetch_produit = mysqli_query($db,"SELECT id,nom FROM produit");


while($throw_produit = mysqli_fetch_array($fetch_produit)) {
echo '<option   value="'.$throw_produit[0].'">'.$throw_produit[1].'</option>';
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
  echo '<option   value="'.$throw_client[0].'">'.$throw_client[1],' ',$throw_client[2].'</option>';
  }
  echo "</select>";
mysqli_close($db); // Close connection
  ?>
  <br/>
  <input type="submit" name="validation" value="Envoyer">
</form>

</body>
</html>