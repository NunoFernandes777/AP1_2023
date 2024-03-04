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
                <td><a href="#"
                    onclick="openProfil('<?php echo $NUM; ?>', '<?php echo $NOM; ?>', '<?php echo $PRENOM; ?>')"><i
                      class="fa-regular fa-user"></i></a></td>
              </tr>
              <?php
            }

        }

        ?>
        </table>
      </div>
      <div id="open_closeProfil" class="prof-modal">
        <div class="prof-modal-content">
          <span class="close" onclick="closeProfil()"><i class="fa-solid fa-xmark"></i></span>
          <div class="prof-modal-content-layout">
            <h1 id="profilName"></h1>
            <div class="modal-content-layoutInfo">
              <table class="table_modal-content-layoutInfo">
                <?php
                if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
                  $id = $_SESSION["id"];
                  $requete = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.DateN, utilisateur.tel, utilisateur.email, utilisateur.option FROM utilisateur WHERE num=$NUM"; //recupere tous les donnes utilisateur
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

                    

                    <?php
                  }
                }
                ?>
              </table>
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

<style>
  @media only screen and (max-width: 1000px) {
    .decopage {
      margin: auto;
      display: block;
    }

    .avatarimgperso {

      width: 55%;

    }

    .infoperso {

      text-align: left;

    }

    .boxinfoPerso {
      background: transparent;
      width: 94%;
    }

    .infostage {

      text-align: left;

    }

    .boxinfo {
      background: transparent;
      margin-top: 10px;
      margin-bottom: 100px;
      width: 94%;

    }

    .boxinfo_Titre {

      font-size: 35px;

    }

    .table_boxinfo {
      width: 100%;
      text-align: left;
    }

    .boxinfo_stage {
      width: 100%;
      margin: auto;
    }

    .boxinfo_tuteur {
      width: 100%;
      margin: auto;

    }
  }

  /* frame profil */

.prof-modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
}

.prof-modal-content {
    background-image: linear-gradient(to right bottom, #ffbbe1, #efb6e5, #dbb1e9, #c5aeeb, #acabeb, #9bb3f1, #8bbaf3, #7dc1f3, #80d2f7, #8de2f9, #a1f1f9, #b9fffa);
    margin: 5% auto;
    padding: 20px;
    border: none;
    border-radius: 10px;
    width: 65%;
    height: max-content;
}

.prof-modal-content-layout {
    text-align: center;
}

.table_modal-content-layoutInfo{
  width: 44%;
}

.prof-close {
    color: #000;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.prof-close:hover,
.prof-close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>

<script>
  function openProfil(NUM, NOM, PRENOM) {
    document.getElementById("open_closeProfil").style.display = "block";
    document.getElementById("profilName").innerHTML = 'Profil ' + PRENOM + ' ' + NOM;
  }

  function closeProfil() {
    document.getElementById('open_closeProfil').style.display = 'none';
  }
</script>