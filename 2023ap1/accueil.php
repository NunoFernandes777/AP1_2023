<?php
session_start();
include '_conf.php';

?>
<html>
<?php

if (isset($_POST['envoi'])) //reçois données rentrée lors de la connexion
{

    $login = $_POST['login'];
    $mdp = md5($_POST['mdp']);

    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
    $requete = "Select * from UTILISATEUR WHERE login = '$login' AND motdepasse= '$mdp'"; //recupere données utilisateur 
    //echo "<br> ma req SQL : $requete <br>";
    $resultat = mysqli_query($connexion, $requete);
    $trouve = 0;
    while ($donnees = mysqli_fetch_assoc($resultat)) {

        $trouve = 1;
        $type = $donnees['type'];
        $login = $donnees['login'];
        $id = $donnees['num'];

        $_SESSION["id"] = $id;
        $_SESSION["login"] = $login;
        $_SESSION["type"] = $type;

    }

    if ($trouve == 0) {
        echo "erreur de connexion";
    }
}
?>
<?php
require("header/header.php");
if (isset($_SESSION["login"])) {
    if ($_SESSION["type"] == 0) {
        ?>

        <body>
            <div class="accueil_layout">
                <div class="accueil_layout_logo">
                    <img src="LogoRapport.png" class="layout_rapport_homepage"></img>
                </div>
            </div>
        </body>
        <?php
    }

    if ($_SESSION["type"] == 1) {
        ?>

        <body>
            <div class="accueil_layout">
                <div class="accueil_layout_logo">
                    <img src="LogoRapport.png" class="layout_rapport_homepage"></img>
                </div>
            </div>
        </body>
        <?php
    }

    if ($_SESSION["type"] == 2) {
        ?>

        <body>
            <div class="accueil_layout">

                <?php
                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "SELECT count(*) AS nbEleves from utilisateur where type=0";
                $resultat = mysqli_query($connexion, $requete);

                $requete1 = "SELECT count(*) AS nbProf from utilisateur where type=1";
                $resultat1 = mysqli_query($connexion, $requete1);

                $requete2 = "SELECT count(*) AS nbCr from cr";
                $resultat2 = mysqli_query($connexion, $requete2);

                $requete3 = "SELECT count(*) AS nbUtilisateurs from utilisateur";
                $resultat3 = mysqli_query($connexion, $requete3);
                ?>
                <table style="width:100%">
                    <tr>
                        <th>indice</th>
                        <th>nb_total</th>
                    </tr>
                    <?php
                    while ($donnees = mysqli_fetch_assoc($resultat)) {
                        $nbeleve = $donnees['nbEleves'];
                    }
                    while ($donnees = mysqli_fetch_assoc($resultat1)) {
                        $nbprof = $donnees['nbProf'];
                    }
                    while ($donnees = mysqli_fetch_assoc($resultat2)) {
                        $nbcompterendu = $donnees['nbCr'];
                    }
                    while ($donnees = mysqli_fetch_assoc($resultat3)) {
                        $nbutilisateurs = $donnees['nbUtilisateurs'];
                    }
                    ?>
                    <tr>
                        <?php
                        echo "<td>prof</td><td>$nbprof</td>";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        echo "<td>eleve</td><td>$nbeleve</td>";
                        ?>
                    <tr>
                        <?php
                        echo "<td>compte rendu</td><td>$nbcompterendu</td>";
                        ?>
                    </tr>
                    <?php

    }
    
}
?>

    <div class="pie animate" style="--p:70;--c:lightgreen"> 70%</div>

    </div>
</body>

<style>
    .accueil_layout {
        margin-top: 25px !important;
        width: 97%;
        margin: auto;
        border: 5px solid transparent;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
        border-radius: 10px;
        height: 85%;
    }

    .accueil_layout_logo {
        margin: 7% 0% 0% 10%;
    }

    .layout_rapport_homepage {
        width: 50%;
    }

    .pie {
        --p: 20;
        --b: 22px;
        --c: darkred;
        --w: 150px;

        width: var(--w);
        aspect-ratio: 1;
        position: relative;
        display: inline-grid;
        margin: 5px;
        place-content: center;
        font-size: 25px;
        font-weight: bold;
        font-family: sans-serif;
    }

    .pie:before,
    .pie:after {
        content: "";
        position: absolute;
        border-radius: 50%;
    }

    .pie:before {
        inset: 0;
        background:
            radial-gradient(farthest-side, var(--c) 98%, #0000) top/var(--b) var(--b) no-repeat,
            conic-gradient(var(--c) calc(var(--p)*1%), #0000 0);
        -webkit-mask: radial-gradient(farthest-side, #0000 calc(99% - var(--b)), #000 calc(100% - var(--b)));
        mask: radial-gradient(farthest-side, #0000 calc(99% - var(--b)), #000 calc(100% - var(--b)));
    }

    .pie:after {
        inset: calc(50% - var(--b)/2);
        background: var(--c);
        transform: rotate(calc(var(--p)*3.6deg)) translateY(calc(50% - var(--w)/2));
    }

    .animate {
        animation: p 1s .5s both;
    }

    .no-round:before {
        background-size: 0 0, auto;
    }

    .no-round:after {
        content: none;
    }

    @keyframes p {
        from {
            --p: 0
        }
    }

</style>

<script>

function cacul_pourcentage($nombre,$total,$pourcentage)
    { 
      $resultat = ($nombre/$total) * $pourcentage;
      return round($resultat); // Arrondi la valeur
    } 
</script>