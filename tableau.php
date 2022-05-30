<!DOCTYPE html>
<html>
<head>
  <title>Commandes</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
function update(id_com,id_prod,qte,action,stock_n=0,stock_b=0) {
  console.log(id_com,id_prod,qte,action,(stock_n-qte<0),stock_b);
  if(action=='Produire'){
    if((id_prod == 'boite noire' && (stock_n-qte)>=0) || (id_prod == 'boite blanche' && (stock_b-qte)>=0)){
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
});
  location.reload();
}
  else{
    alert("Stock insuffisant !");
  }
}
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
    });
    location.reload();
  }

else if(action=='facturer'){
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
});
  location.reload();
}
};
</script>



</head>
<body>

<h2>Liste des commandes en cours</h2>

<table border="2">
  <tr>Commandes en attente d'action :</tr>
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
    <?php if($_SESSION["role"]=='logisticien' || $_SESSION["role"]=='comptable' || $_SESSION["role"]=='chef'){ 
    ?>
    <td>Facturation</td>
  <?php }?>
    <?php if($_SESSION["role"]=='respoProd' || $_SESSION["role"]=='logisticien' || $_SESSION["role"]=='comptable'){ 
    ?>
    <td>Action</td>
  <?php }?>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from (commande inner join client on client.id = commande.id_client) inner join produit on produit.id=commande.id_produit"); // fetch data from database

$check_qte_1 = mysqli_query($db,"select quantite_en_stock,nom from produit where nom='boite noire'");
$check_qte_2 = mysqli_query($db,"select quantite_en_stock,nom from produit where nom='boite blanche'");
$check_noire= mysqli_fetch_array($check_qte_1);
$check_blanche= mysqli_fetch_array($check_qte_2);

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
elseif ($_SESSION["role"]=='chef'){
    
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
    <td><?php if ($data['facturation']){
    echo "Facturée";}
    else{
      echo "Non facturée";
    } ?></td>

  </tr>	
<?php
}
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
    echo '<button type="button" onclick="update('.$data[0].','."'".$data['nom']."'".','.$data['quantite'].','.$produire.','.$check_noire[0].','.$check_blanche[0].')" > Producted </button>'; ?></td>
  </tr> 
<?php
}}

elseif ($_SESSION["role"]=='logisticien'){
  if ($data['statut']=='Producted' && $data['facturation']==1){
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
    <td><?php if ($data['facturation']){
    echo "Facturée";}
    else{
      echo "Non facturée";
    } ?></td>
    <td><?php $livrer="'Livrer'";
    echo '<button type="button" onclick="update('.$data[3].','."'".$data['nom']."'".','.$data['quantite'].','.$livrer.')" > Livrer </button>'; ?></td>
  </tr> 
<?php
}}

elseif ($_SESSION["role"]=='comptable'){
  if ($data['statut']!='Delivered'){
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
    <td><?php if ($data['facturation']){
    echo "Facturée";}
    else{
      echo "Non facturée";
    } ?></td>
    <td><?php ;
    if($data['facturation']==0){
      $facturer="'facturer'";
    echo '<button type="button" onclick="update('.$data[3].','."'".$data['nom']."'".','.$data['quantite'].','.$facturer.')" > Facturer </button>'; }?></td>
  </tr> 
<?php
}
}
}
?>
</table>

<?php mysqli_close($db); // Close connection ?>

</body>
</html>