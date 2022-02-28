</head>

<body>
 <?php
    include("dbConn.php");
    if(isset($_POST["submit"]) && isset($_POST["name"]) && isset($_POST["psw"])){
        $psw = htmlspecialchars($_POST["psw"]);
        $name = htmlspecialchars($_POST["name"]);

        $req = $db->prepare("SELECT count(*) as count, role FROM metiers where username=? && mot_de_passe=?");
		
		
        $req->bind_param('ss', $name, $psw);
        $req->execute();
        $res = $req->get_result();
        $account = $res->fetch_assoc();

        if($account['count'] == 1){
            session_start();
            $_SESSION["role"] = $account["role"];
            // header("Refresh:0");
        }
    }

    if(session_status() == 2){
    	// Connecté
        echo "Vous êtes connecté en tant que " . $_SESSION["role"];
		?>
	</br>
		<a href='index.php'><span>Déconnexion</span></a>
            
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
        	include("stock.php");
        	include("tableau.php");
        	include("create_commande.php");
        	include("clients.php");
        	include("gestionboite.php");
        	include("facture.php");
        }  
        elseif ($_SESSION["role"]=='marketing') {
        	include("create_commande.php");
        	include("clients.php");
        }
        elseif ($_SESSION["role"]=='logisticien') {
        	include("stock.php");
        }
        elseif ($_SESSION["role"]=='respoProd') {
        	include("tableau.php");
        	include("stock.php");
        }
        elseif ($_SESSION["role"]=='comptable') {
        	include("facture.php");
        }
            
    }else{
        //Pas connecté
    ?>
    <form method="POST" action="#">
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