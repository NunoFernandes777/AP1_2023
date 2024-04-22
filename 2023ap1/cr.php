<?php
session_start();
include '_conf.php';
require("header/header.php");
?>

<body>
  <div class="layout_cr">
    <?php
    if (isset($_POST['update'])) //recupere données de ccr.php
    {
      $date = $_POST['date'];
      $contenu = addslashes($_POST['contenu']);
      $id = $_SESSION["id"];
      $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
      $requete = "INSERT INTO cr (date,datetime,description,num_utilisateur) VALUES ('$date',NOW(),'$contenu','$id');"; //crée nouveau compte rendu avec infos recuperees
      if (!mysqli_query($connexion, $requete)) {
        echo "erreur";
      }

    }

    if ($_SESSION["type"] == 1) //si connexion en prof
    {

      if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
        $id = $_SESSION["id"];
        $requete = "SELECT utilisateur.nom, utilisateur.prenom, cr.date, cr.description FROM cr LEFT JOIN utilisateur ON utilisateur.num = cr.num_utilisateur;"; //recupere tous les donnes utilisateur
        $resultat = mysqli_query($connexion, $requete);
        ?>

        <table style="width:100%">
          <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>date</th>
            <th>description</th>
          </tr>

          <?php

          while ($donnees = mysqli_fetch_assoc($resultat)) {

            $NOM = $donnees['nom'];
            $PRENOM = $donnees['prenom'];
            $DATE = $donnees['date'];
            $DESCRIPTION = htmlspecialchars($donnees['description']);


            ?>
            <tr>

              <?php
              echo "<td>$NOM</td>
                <td>$PRENOM</td>
                <td>$DATE</td>
                <td>$DESCRIPTION</td>
                ";

              ?>

            </tr>
            <?php
          }
      }
    } else //si connexion en eleve
    {
      ?>
        <div class="grid_display">
          <?php

          if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
            $id = $_SESSION["id"];
            $requete = "SELECT cr.* FROM cr,utilisateur WHERE utilisateur.num = cr.num_utilisateur AND utilisateur.num=$_SESSION[id] ORDER BY date DESC"; //recupere tous les comptes rendus par date decroissante
            $resultat = mysqli_query($connexion, $requete);

            if ($resultat === false) {
              echo "Error: " . mysqli_error($connexion);
            } else {
              while ($donnees = mysqli_fetch_assoc($resultat)) {
                $id = $donnees['num'];
                $date = $DATE = date('d/m/Y', strtotime($donnees['date']));
                $datetime = $donnees['datetime'];
                $contenu = nl2br(htmlspecialchars_decode($donnees['description']));
                $requete = "DELETE cr FROM cr
                        INNER JOIN utilisateur ON utilisateur.num = cr.num_utilisateur
                        WHERE utilisateur.num = ?";
                ?>
                <div class="container">
                  <div class="timeline">
                    <div class="timeline-box" id="primary<?php echo $id; ?>">
                      <div class="icon">
                        <p>
                          <?php echo $date ?>
                        </p>
                      </div>
                      <div class="timeline-body">
                        <p>
                          <?php echo $contenu ?>
                        </p>
                        <div class="conf_commentaire">
                          <p class="conf_commentaire_text">
                          <div class="conf_commentaire_modif">
                            <a href="#" onclick="openEditModal('<?php echo $id; ?>', '<?php echo $contenu; ?>')">modif
                              commentaire</a>
                          </div>
                          <div class="conf_commentaire_supp">
                            <a href="#" onclick="deleteComment('<?php echo $id; ?>')">supp commentaire</a>
                          </div>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" id="editedCommentId" value="">
                <div id="editModal" class="modal">
                  <div class="modal-content">
                    <span class="close" onclick="closeEditModal()"><i class="fa-solid fa-xmark"></i></span>
                    <div class="modal-content-layout">
                      <h1>Editer Commentaire</h1>
                      <div class="modal-content-layouttextarea">
                        <textarea id="editedComment" rows=20 cols=70></textarea>
                      </div>
                      <div class="modal-content-layoutbtn">
                        <button onclick="saveChanges()" class="modal-content-btn">sauvegarder</button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              }

            }

          }
          ?>
        </div>
        <?php
    }
    ?>

  </div>

</body>

<style>
  .container {
    max-width: 650px;
    margin: 50px auto;
  }

  .icon p {
    line-height: 2.4;
    font-size: 18px;
    opacity: 0.8;
    font-style: italic;
    color: black;
  }

  p {
    font-weight: 300;
    line-height: 1.5;
    font-size: 14px;
    opacity: 0.9;
    font-family: sans-serif;
  }

  .timeline {
    position: relative;
    padding-left: 4rem;
    margin: 0 0 0 30px;
    color: #fff;
  }

  .timeline .timeline-box {
    position: relative;
    margin-bottom: 2.5rem;
  }

  .timeline .timeline-box .icon {
    position: absolute;
    left: -150px;
    top: 10px;
    width: 125px;
    height: 40px;
    background-color: transparent;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    border: 2px solid black;
    border-radius: 5px;
    font-size: 20px;
    text-align: center;

  }

  .timeline .timeline-box .icon i {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .timeline .timeline-box .timeline-body {
    background-color: #27293d;
    border-radius: 6px;
    padding: 20px 18px 15px 20px;
    box-shadow: 1px 3px 9px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.5s ease;
  }

  .timeline .timeline-box .timeline-body:hover {
    box-shadow: 1px 3px 20px rgba(0, 0, 0, 0.6);
  }

  .timeline .timeline-box .timeline-body::before {
    content: "";
    background-color: inherit;
    width: 20px;
    height: 20px;
    display: block;
    position: absolute;
    left: -10px;
    transform: rotate(45deg);
    border-radius: 0 0 0 3px;
  }

  .timeline .timeline-box .timeline-body .header {
    margin-bottom: 1.2rem;
  }

  .timeline .timeline-box .timeline-body .header .badge {
    background-color: #4f537b;
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 4px;
    font-weight: bold;
  }

  .timeline .timeline-box .timeline-body .conf_commentaire {
    justify-content: space-between;
    display: flex;
    font-weight: 300;
    font-style: italic;
    opacity: 0.4;
    margin-top: 16px;
    font-size: 11px;
  }

  .timeline .timeline-box .timeline-body .conf_commentaire a {
    text-decoration: none;
    color: white;
  }
</style>

<script>

  function openEditModal(commentId, commentContent) {
    document.getElementById('editedCommentId').value = commentId;
    document.getElementById('editedComment').value = decodeURIComponent(commentContent);
    document.getElementById('editModal').style.display = 'block';
  }

  function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
  }

  /* script saveChanges */
  function saveChanges() {
    var editedCommentId = document.getElementById('editedCommentId').value;
    var editedComment = document.getElementById('editedComment').value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          location.reload();
        } else {
          alert('Erreur.');
        }
      }
    };

    xhr.open('POST', 'save_changes.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    var data = 'num=' + encodeURIComponent(editedCommentId) + '&comment=' + encodeURIComponent(editedComment);
    xhr.send(data);
  }

  /* Script deleteComment */

  function deleteComment(commentId) {
    if (confirm("Tu veux supprimer ce commentaire?")) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {

            location.reload();
          } else {

            alert('erreur a supprimer le commentaire');
          }
        }
      };

      xhr.open('POST', 'delete_comment.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

      var data = 'id=' + encodeURIComponent(commentId);
      xhr.send(data);
    }
  }

</script>