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
    <!-- <div id="chartContainer" style="height: 100px; width: 25%; background-color: black;"> -->
    

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
        margin: 7% 0% 0% 5%;
    }

    .layout_rapport_homepage {
        width: 50%;
        min-width: 25em;
        max-width: 45em;
    }

    #chartContainer{
        background: transparent;
    }
</style>

<!--
<script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        
        text: "Utilisateurs",
        fontFamily: 'Poppins',
        fontWeight: "normal"
      },

      data: [
      {
        //startAngle: 45,
       indexLabelFontSize: 20,
       indexLabelFontFamily: "Poppins",
       indexLabelFontColor: "black",
       indexLabelLineColor: "black",
       indexLabelPlacement: "outside",
       type: "doughnut",
       showInLegend: true,
       dataPoints: [
       {  y: 53.37, legendText:"élèves SLAM %", indexLabel: "élèves SLAM" },
       {  y: 35.0, legendText:"élèves SISR %", indexLabel: "élèves SISR" }
       ]
     }
     ]
   });

   chart.render();
  }
</script>
-->
