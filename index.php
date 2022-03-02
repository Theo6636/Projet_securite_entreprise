</head>

<body>
 <?php
    include("dbConn.php");
    session_start();
    if(isset($_POST["submit"]) && isset($_POST["name"]) && isset($_POST["psw"])){
        $psw = htmlspecialchars($_POST["psw"]);
        $name = htmlspecialchars($_POST["name"]);

        $req = $db->prepare("SELECT count(*) as count, role FROM metiers where username=? && mot_de_passe=?");
		
		
        $req->bind_param('ss', $name, $psw);
        $req->execute();
        $res = $req->get_result();
        $account = $res->fetch_assoc();

        if($account['count'] == 1){
            
            $_SESSION["role"] = $account["role"];
            // header("Refresh:0");
        }
    }

    if(isset($_SESSION["role"])){
    	// Connecté
        echo "Vous êtes connecté en tant que " . $_SESSION["role"];
		?>
	</br>
		<a href='index.php?deconnexion=true'><span>Déconnexion</span></a>
            
            <?php
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_destroy();
					  $_SESSION = [];
                      header("location:index.php");
                   }
                }

        if ($_SESSION["role"]=='chef'){
        	?>
        	<a href='stock.php'><span>Stock</span></a>
        	<a href='create_commande.php'><span>Créer une commande</span></a>
        	<a href='clients.php'><span>Liste des clients</span></a>
        	<a href='gestionboite.php'><span>Gestion des stocks</span></a>
        	<a href='facture.php'><span>Les factures</span></a>
        	<?php
        	include("tableau.php");
        }  
        elseif ($_SESSION["role"]=='commercial') {
        	?>
        	
        	<a href='clients.php'><span>Liste des clients</span></a>
        	<?php
        	include("tableau.php");
        	include("create_commande.php");

        }
        elseif ($_SESSION["role"]=='logisticien') {
        	include("tableau.php");
        }
        elseif ($_SESSION["role"]=='respoProd') {
        	?>
        	<a href='stock.php'><span>Stock</span></a>
        	<a href='tableau.php'><span>Tableau</span></a>
        	<?php
        	
        	include("tableau.php");
        	include("stock.php");
        }
        elseif ($_SESSION["role"]=='comptable') {
        	include("facture.php");
        }
            
    }else{
        //Pas connecté
    ?>
    <form method="POST" >
        <input type="text" name="name" placeholder="name"/>
        <input type="password" name="psw" placeholder="mot de passe"/>
        <input type="submit" value="Valider" name="submit"/>
    </form>
    <?php
    }
 ?>
 <div id="content">
            
            
            
        </div>
</body>

</html>