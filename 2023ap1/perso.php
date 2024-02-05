<?php
session_start();
include '_conf.php';
require("header/header.php");

if (isset($_SESSION["login"])) {

  $username = $_SESSION["login"];

} else {

  echo "User login not found in session.";

}
?>
<html>

<body>

</html>
<?php

if ($_SESSION["type"] == 1) //si connexion en prof
{
  ?>

  <?php
  if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
    $id = $_SESSION["id"];
    $requete = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.DateN, utilisateur.tel, utilisateur.email, utilisateur.option, utilisateur.login FROM utilisateur WHERE num=$_SESSION[id]"; //recupere tous les donnes utilisateur
    $resultat = mysqli_query($connexion, $requete);
    while ($donnees = mysqli_fetch_assoc($resultat)) {
      $NOM = $donnees['nom'];
      $PRENOM = $donnees['prenom'];
      $LOGIN = $donnees['login'];
      $DATE = $donnees['DateN'];
      $TEL = $donnees['tel'];
      $EMAIL = $donnees['email'];
      $OPTION = $donnees['option'];

      if ($OPTION == 1) {

        $OPTION_TXT = "Slam";

      } else {

        $OPTION_TXT = "SISR";

      }
      ?>
      <div class=decopage>
        <div class=boxinfoPerso>

          <div class="infoperso">

            <table class="table_boxinfo">
              <tr>
                <th colspan="2">
                  <div>
                    <img class="avatarimgperso" src="user1.png">
                  </div>
                </th>
              </tr>

              <tr>
                <th colspan="2">
                  <?php echo "<b>" . $_SESSION["login"] . "</b>" ?>
                </th>
              </tr>

              <tr>
                <td rowspan="3" width=25%>
                  <b>Information Utilisateur</b>
                </td>
                <td>
                  <?php echo "<b>Prenom</b> : $PRENOM" ?>
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo "<b>Nom</b> : $NOM" ?>
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo "<b>DateN</b> : $DATE" ?>
                </td>
              </tr>

              <tr>
                <td rowspan="2" width=25%>
                  <b>Contacter</b>
                </td>
                <td>
                  <?php echo "<b>Tel</b> : $TEL" ?>
                </td>
              </tr>

              <tr>
                <td>
                  <?php echo "<b>Email</b> : $EMAIL" ?>
                </td>
              </tr>

              <tr>
                <td rowspan="1" width=25%>
                  <b>Etudes</b>
                </td>
                <td>
                  <?php echo "<b>option</b> :  $OPTION_TXT" ?>
                </td>
              </tr>

            </table>
            <?php
    }
  }
  ?>
      </div>
    </div>


    <div class=boxinfo_admin>
      <div class=boxinfo_Titre>
        <a class=boxinfo_Titre><b>Liste Profil Eleves</b></a>
      </div>
      <div class="infostage">
        <?php
        if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
          $id = $_SESSION["id"];
          $requete = "SELECT utilisateur.num, utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.tel FROM utilisateur WHERE utilisateur.type='0'"; //recupere tous les donnes utilisateur
          $resultat = mysqli_query($connexion, $requete);
          ?>

          <table style="width:100%">
            <tr>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Email</th>
              <th>Tel</th>
              <th>Profil</th>
            </tr>
            <?php

            while ($donnees = mysqli_fetch_assoc($resultat)) {

              $NUM = $donnees['num'];
              $NOM = $donnees['nom'];
              $PRENOM = $donnees['prenom'];
              $EMAIL = $donnees['email'];
              $TEL = $donnees['tel'];

              ?>
              <tr>

                <?php
                echo "<td>$NOM</td>
                      <td>$PRENOM</td>
                      <td>$EMAIL</td>
                      <td>$TEL</td>";

                ?>
                <td><a href="#" onclick="openProfil('<?php echo $NUM; ?>')"><i class="fa-regular fa-user"></i></a></td>
              </tr>
              <?php
            }
        }
        
        ?>

      </div>
      <input type="hidden" id="editedCommentId" value="">
      <div id="open_closeProfil" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeProfil()"><i class="fa-solid fa-xmark"></i></span>
          <div class="modal-content-layout">
            <h1>Profil <?php echo $PRENOM,' ', $NOM ?></h1>
            
            <div class="modal-content-layoutbtn">
            </div>
          </div>
        </div>
      </div>

      </html>
      <?php
} else { /* si connexion en eleve */
  ?>
      <html>
      <div class=decopage>
        <div class=boxinfoPerso>
          <div class="infoperso">
            <?php
            if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
              $id = $_SESSION["id"];
              $requete = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.DateN, utilisateur.tel, utilisateur.email, utilisateur.option FROM utilisateur WHERE num=$_SESSION[id]"; //recupere tous les donnes utilisateur
              $resultat = mysqli_query($connexion, $requete);
              while ($donnees = mysqli_fetch_assoc($resultat)) {
                $NOM = $donnees['nom'];
                $PRENOM = $donnees['prenom'];
                $DATE = $donnees['DateN'];
                $TEL = $donnees['tel'];
                $EMAIL = $donnees['email'];
                $OPTION = $donnees['option'];

                if ($OPTION == 1) {

                  $OPTION_TXT = "Slam";

                } else {

                  $OPTION_TXT = "SISR";

                }
                ?>

                <table class="table_boxinfo">

                  <tr>
                    <th colspan="2">
                      <div>
                        <img class="avatarimgperso" src="user1.png">
                      </div>
                    </th>
                  </tr>

                  <tr>
                    <th colspan="2">
                      <?php echo "<b>" . $_SESSION["login"] . "</b>" ?>
                    </th>
                  </tr>

                  <tr>
                    <td rowspan="3" width=25%>
                      <b>Information Utilisateur</b>
                    </td>
                    <td>
                      <?php echo "<b>Prenom</b> : $PRENOM" ?>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <?php echo "<b>Nom</b> : $NOM" ?>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <?php echo "<b>DateN</b> : $DATE" ?>
                    </td>
                  </tr>

                  <tr>
                    <td rowspan="2" width=25%>
                      <b>Contacter</b>
                    </td>
                    <td>
                      <?php echo "<b>Tel</b> : $TEL" ?>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <?php echo "<b>Email</b> : $EMAIL" ?>
                    </td>
                  </tr>

                  <tr>
                    <td rowspan="1" width=25%>
                      <b>Etudes</b>
                    </td>
                    <td>
                      <?php echo "<b>option</b> :  $OPTION_TXT" ?>
                    </td>
                  </tr>

                </table>

                <?php
              }
            }
            ?>
          </div>
        </div>

        <div class=boxinfo>
          <div class="boxinfo_stage">
            <div class="infostage">

              <?php
              if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
                $id = $_SESSION["id"];
                $requete = "SELECT stage.nom, stage.adresse, stage.CP, stage.ville, stage.tel, stage.email FROM stage,utilisateur WHERE utilisateur.num=$_SESSION[id] AND utilisateur.num_stage=stage.num"; //recupere tous les donnes utilisateur
                $resultat = mysqli_query($connexion, $requete);
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                  $NOM = $donnees['nom'];
                  $ADRESSE = $donnees['adresse'];
                  $CP = $donnees['CP'];
                  $VILLE = $donnees['ville'];
                  $TEL = $donnees['tel'];
                  $EMAIL = $donnees['email'];
                  ?>

                  <table class="table_boxinfo">

                    <tr>
                      <th colspan="2">
                        <?php echo "<b>Info Stage</b>" ?>
                      </th>
                    </tr>

                    <tr>
                      <td rowspan="4" width=25%>
                        <b>Information Stage</b>
                      </td>
                      <td>
                        <?php echo "<b>Nom</b> : $NOM" ?>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <?php echo "<b>adresse</b> : $ADRESSE" ?>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <?php echo "<b>CP</b> : $CP" ?>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <?php echo "<b>ville</b> : $VILLE" ?>
                      </td>

                    <tr>
                      <td rowspan="2" width=25%>
                        <b>Contacter</b>
                      </td>
                      <td>
                        <?php echo "<b>tel</b> : $TEL" ?>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <?php echo "<b>email</b> : $EMAIL" ?>
                      </td>
                    </tr>

                  </table>

                  <?php
                }
              }
              ?>
            </div>
          </div>


          <div class="boxinfo_tuteur">
            <div class="infostage">
              <?php
              if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
                $id = $_SESSION["id"];
                $requete = "SELECT tuteur.nom, tuteur.prenom, tuteur.tel, tuteur.email FROM tuteur, stage, utilisateur WHERE utilisateur.num=$_SESSION[id] AND utilisateur.num_stage=stage.num AND stage.num_tuteur=tuteur.num"; //recupere tous les donnes utilisateur
                $resultat = mysqli_query($connexion, $requete);
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                  $NOM = $donnees['nom'];
                  $PRENOM = $donnees['prenom'];
                  $TEL = $donnees['tel'];
                  $EMAIL = $donnees['email'];

                  ?>
                  <table class="table_boxinfo">

                    <tr>
                      <th colspan="2">
                        <?php echo "<b>Tuteur</b>" ?>
                      </th>
                    </tr>

                    <tr>
                      <td rowspan="2" width=25%>
                        <b>Tuteur</b>
                      </td>
                      <td>
                        <?php echo "<b>Nom</b> : $NOM" ?>
                      </td>
                    </tr>
                    </tr>
                    <td>
                      <?php echo "<b>prenom</b> : $PRENOM" ?>
                    </td>
                    </tr>

                    <tr>
                      <td rowspan="2" width=25%>
                        <b>Contacter</b>
                      </td>
                      <td>
                        <?php echo "<b>tel</b> : $TEL" ?>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <?php echo "<b>email</b> : $EMAIL" ?>
                      </td>
                    </tr>

                  </table>
                  <?php
                }
              }
              ?>

            </div>
          </div>
        </div>

      </div>

    </div>


  </div>



  </html>
  <?php
}

?>

<script>
  function openProfil() {
    document.getElementById('open_closeProfil').style.display = 'block';
  }

  function closeProfil() {
    document.getElementById('open_closeProfil').style.display = 'none';
  }
</script>