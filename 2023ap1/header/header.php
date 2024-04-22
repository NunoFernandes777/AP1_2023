<script src="https://kit.fontawesome.com/f01ff634ff.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
if (isset($_SESSION["login"])) {
    if ($_SESSION["type"] == 0) {
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $requete = "SELECT COUNT(cr.num) as 'nb' from cr, utilisateur where cr.num_utilisateur = utilisateur.num and utilisateur.num = " . $_SESSION['id'];
        $resultat = mysqli_query($connexion, $requete);
        ?>

       

        <nav>
            <div class="left">
                <div class="logo">
                    <img src="LogoRapport.png">
                </div>
                <div class="links">
                    <a href="accueil.php">Accueil</a>
                    <a href="perso.php">Profil</a>
                    <a href="cr.php">Compte rendus</a>
                    <a href="ccr.php">Nouveau compte-rendu</a>
                </div>
            </div>  
            <div class="middle">  
                <div class="info">
                    <?php
                    while ($donnees = mysqli_fetch_assoc($resultat)) {
                        if ($donnees['nb'] == 0)
                            echo "<a style='color: red' class='nb_cr'><b><i class='fa-solid fa-circle-exclamation' style='color: #ff0000;'></i> Vous avez crée : $donnees[nb] comptes rendus </b></a>";
                        else
                            echo "<a class='nb_cr'><i class='fa-regular fa-face-smile'></i> Vous avez crée : $donnees[nb] comptes rendus </a>";
                    }
                    ?>
                </div>
            </div>    
            <div class="buttons">
                <form method='post' action='index.php'>
                    <button type="submit" name="deco" class="buttonDeco"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </form> 
            </div>

        </nav>
        <?php
    }

    if ($_SESSION["type"] == 1) {

        ?>
        <div class="accueilpage">
            <ul class="nav" id="menu">
                <div class="nav_logo">
                    <li><img src="LogoRapport.png" class="layout_rapport"></img></li>
                </div>
                <div class="nav_menu">
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="perso.php">Profil</a></li>
                    <li><a href="cr.php">Compte rendus</a></li>
                </div>
                <div class="nav_btn">
                    <form method='post' action='index.php'>
                        <button type="submit" name="deco" class="buttonDeco"><i
                                class="fa-solid fa-arrow-right-from-bracket"></i></button>
                    </form>
                </div>
            </ul>
        </div>
        <?php
    }

    if ($_SESSION["type"] == 2) {

        ?>
        <div class="accueilpage">
            <ul class="nav">
                <div class="nav_logo">
                    <li><img src="LogoRapport.png" class="layout_rapport"></img></li>
                </div>
                <div class="nav_btn">
                    <form method='post' action='index.php'>
                        <button type="submit" name="deco" class="buttonDeco"><i
                                class="fa-solid fa-arrow-right-from-bracket"></i></button>
                    </form>
                </div>
            </ul>
        </div>
        <?php
    }
}
?>

<head>
    <link href="style.css" media="all" rel="stylesheet" type="text/css" />
</head>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    .accueilpage {
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
        width: 97%;
        margin: auto;

    }

    a{
        text-decoration: none;
        color: #000;
        transition: all 0.3s ease;
    }

    a:hover{
        text-decoration: underline;
    }

    nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 80px;
        height: 80px;
        margin: auto;
        background-color: transparent;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
    }

    nav .left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    nav .left .logo img {
        width: 100px;  
        object-fit: cover;
    }

    nav .left .links {
        display: flex;
        gap: 20px;
        font-size: 15px;
        font-weight: bold;
    }

    nav .buttons {
        display: flex;
        gap: 14px;
    }

    nav .buttons a {
        background-color: #eaf4f4;
        padding: 10px;
        color: #2d6a4f;
        border-radius: 50%;
        font-size: 18px;
    }

    .buttonDeco {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        background-color: transparent;
        color: black;
        padding: 8px 15px;
        border: 2px solid black;
        border-radius: 10px;

        margin-top: auto;
        margin-bottom: auto;
    }

    .buttonDeco:hover {
        cursor: pointer;
    }


@media screen and (max-width:1200px) {
    
    nav{
        padding: 0 40px;
    }

}

@media screen and (max-width: 1015px) {
    
    nav .left .logo{
        display: none;
    }

    nav .left .links{
        font-size: 13px;
        gap: 13px;
    }

    nav .middle .info .nb_cr{
        font-size: 13px;
    }

    .buttonDeco {     
        font-size: 12px;
        padding: 6px 13px;
    }

}

@media screen and (max-width:768px) {
    
    nav{
        padding: 0 30px;
    }

    nav .left .links{
        font-size: 11px;
        gap: 14px;
    }

    nav .middle .info .nb_cr {
        display: none;
    }
    
}

@media screen and (max-width:576px) {
    
    .buttonDeco {     
        font-size: 10px;
        padding: 6px 10px;
    }

}
</style>