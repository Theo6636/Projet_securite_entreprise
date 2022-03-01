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
    ?>
    <form method="POST" action="#">
        <input type="text" name="name" placeholder="name"/>
        <input type="password" name="psw" placeholder="mot de passe"/>
        <input type="submit" value="Valider" name="submit"/>
    </form>


 <div id="content">
            
            
            
        </div>
</body>

</html>