<?php

if(isset($_POST['action'])){

	include("dbConn.php");
$action=$_POST['action'];
echo $action;
	if($action=='Produire'){

$commande = $_POST['id_commande'];
$produit = $_POST['nom_produit'];
$quantite = $_POST['quantite'];
$del_stock="UPDATE produit SET quantite_en_stock= quantite_en_stock-'".$quantite."' WHERE nom='".$produit."'";
$producted="UPDATE commande SET statut='Producted' WHERE id='".$commande."'";


$result2 = mysqli_query($db,$producted);
//$result = mysqli_query($db,$del_stock);
$test = mysqli_query($db,$del_stock);

if(!$result2)
    {
        echo mysqli_error($db);
    }
    else
    {
        echo "Records added successfully.";
    }
//	echo "C'est fait ".$producted;
}
elseif($action=='Livrer'){

$commande = $_POST['id_commande'];

$delivered="UPDATE commande SET statut='Delivered' WHERE id_commande='".$commande."'";


$result = mysqli_query($db,$delivered);

if(!$result)
    {
        echo mysqli_error($db);
    }
    else
    {
        echo "Records added successfully.";
    }
//	echo "C'est fait ".$producted;
}
elseif($action=='facturer'){

$commande = $_POST['id_commande'];

$factured="UPDATE commande SET facturation='1' WHERE id_commande='".$commande."'";


$result = mysqli_query($db,$factured);

if(!$result)
    {
        echo mysqli_error($db);
    }
    else
    {
        echo "Records added successfully.";
    }
//	echo "C'est fait ".$producted;
}
mysqli_close($db);
}

?>
