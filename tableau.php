<!DOCTYPE html>
<html>
<head>
  <title>Commandes</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
function update(id_com,id_prod,qte,action) {
  console.log(id_com,id_prod,qte,action);
  if(action=='Produire'){
  $.ajax({
    url: "ajax.php",
    method: "POST",
    dataType: 'json',
    data:{
        "id_commande": id_com,
        "nom_produit" : id_prod,
        "quantite"  : qte,
        "action" : action
    },
    success: function(response) {
      alerte(response);
    }
});}
  else if(action=='Livrer'){
  $.ajax({
    url: "ajax.php",
    method: "POST",
    dataType: 'json',
    data:{
        "id_commande": id_com,
        "nom_produit" : id_prod,
        "quantite"  : qte,
        "action" : action
    },
    success: function(response) {
      alerte(response);
    }
});}
};
</script>



</head>
<body>

<h2>Liste des commandes</h2>

<table border="2">
  <tr><td>Commandes en attente d'action</td></tr>
  <tr>
    <td>ID</td> 
    <td>ID de la commande</td>   
    <td>Nom</td>
    <td>Prenom</td>
    <td>Adresse</td>
    <td>Adresse mail</td>
    <td>Statut</td>
    <td>Produit</td>
    <td>Quantité</td>
    <?php if($_SESSION["role"]=='respoProd' || $_SESSION["role"]=='logisticien'){ 
    ?>
    <td>Action</td>
  <?php }?>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from (commande inner join client on client.id = commande.id_client) inner join produit on produit.id=commande.id_produit"); // fetch data from database

while($data = mysqli_fetch_array($records))
{if ($_SESSION["role"]=='commercial'){
  if ($data['statut']=='Created'){
?>
  <tr>
    <td><?php echo $data[0]; ?></td>
    <td><?php echo $data[3]; ?></td>
    <td><?php echo $data[9]; ?></td>
    <td><?php echo $data['prenom']; ?></td>
    <td><?php echo $data['adresse']; ?></td>
    <td><?php echo $data['mail']; ?></td>
    <td><?php echo $data['statut']; ?></td>
    <td><?php echo $data['nom']; ?></td>
    <td><?php echo $data['quantite']; ?></td>
  </tr>	
<?php
}}
elseif ($_SESSION["role"]=='respoProd'){
  if ($data['statut']=='Created'){
?>
  <tr>
    <td><?php echo $data[0]; ?></td>
    <td><?php echo $data[3]; ?></td>
    <td><?php echo $data[9]; ?></td>
    <td><?php echo $data['prenom']; ?></td>
    <td><?php echo $data['adresse']; ?></td>
    <td><?php echo $data['mail']; ?></td>
    <td><?php echo $data['statut']; ?></td>
    <td><?php echo $data['nom']; ?></td>
    <td><?php echo $data['quantite']; ?></td>
    <td><?php $produire="'Produire'";
    echo '<button type="button" onclick="update('.$data[0].','."'".$data['nom']."'".','.$data['quantite'].','.$produire.')" > Producted </button>'; ?></td>
  </tr> 
<?php
}}

elseif ($_SESSION["role"]=='logisticien'){
  if ($data['statut']=='Producted'){
?>
  <tr>
    <td><?php echo $data[0]; ?></td>
    <td><?php echo $data[3]; ?></td>
    <td><?php echo $data[9]; ?></td>
    <td><?php echo $data['prenom']; ?></td>
    <td><?php echo $data['adresse']; ?></td>
    <td><?php echo $data['mail']; ?></td>
    <td><?php echo $data['statut']; ?></td>
    <td><?php echo $data['nom']; ?></td>
    <td><?php echo $data['quantite']; ?></td>
    <td><?php $livrer="'Livrer'";
    echo '<button type="button" onclick="update('.$data[3].','."'".$data['nom']."'".','.$data['quantite'].','.$livrer.')" > Livrer </button>'; ?></td>
  </tr> 
<?php
}}

}
?>
</table>

<?php mysqli_close($db); // Close connection ?>

</body>
</html>