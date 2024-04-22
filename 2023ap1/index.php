<?php
session_start();

if (isset($_POST['deco'])) {
  session_destroy();
}
?>

<head>
  <link href="style.css" media="all" rel="stylesheet" type="text/css" />
</head>

<html>

<body>

  <div class="designIndexbox">

    <form method="POST" action="accueil.php">
      <div class="textDesign">
        <div>
          <h1>Site Rapport de Stage</h1>
        </div>
        <div>
          <table class="table_loggin">
            <tr>
              <td>
                <p class="logindesign">login :
              </td>
              <td>
                <input type="text" name="login" class="logindesign_input" required></p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="mdpdesign">mot de passe :
              </td>
              <td>
                <input type="password" name="mdp" class="mdpdesign_input" required></p>
              </td>
            </tr>
          </table>
        </div>
        <div class="Oublie_Button_section">
          <a href="oubli.php" class="MDPoubliedesign">Mdp Oublie</a>
          <input type="submit" name="envoi" value="OK" class="buttonOK">
        </div>

      </div>
    </form>
  </div>


</body>

</html>