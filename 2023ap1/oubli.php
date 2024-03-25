<body>
    <?php
    include '_conf.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset ($_POST['email'])) {
            $lemail = $_POST['email'];
            echo "Le formulaire a été envoyé avec comme email la valeur: " . htmlspecialchars($lemail);

            $requete = "SELECT * FROM utilisateur WHERE email = ?";
            $stmt = mysqli_prepare($connexion, $requete);
            mysqli_stmt_bind_param($stmt, "s", $lemail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset ($_POST['email'])) {
                    $lemail = $_POST['email'];

                    $requete = "SELECT login, motdepasse FROM utilisateur WHERE email = ?";
                    $stmt = mysqli_prepare($connexion, $requete);
                    mysqli_stmt_bind_param($stmt, "s", $lemail);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $login, $motdepasse);

                    if (mysqli_stmt_fetch($stmt)) {
                        $to = $lemail;
                        $subject = "Password Recovery";
                        $message = "Your login: $login \n Your password: $motdepasse \n http://localhost/NunoFernandes/AP1_2023/2023ap1/pageRecoverPass.php";
                        $headers = "From: webmaster@example.com";

                        if (mail($to, $subject, $message, $headers)) {
                            echo "Email sent successfully";
                        } else {
                            echo "Email not sent";
                        }
                        echo "Password recovery email sent. Please check your email.";
                    } else {
                        echo "Email not found in the database.";
                    }

                    mysqli_stmt_close($stmt);

                }
            }
        }
    }
    ?>
    <div class="designIndexbox">
        <a class="RetrouverMDP_titre">Retrouver Mdp</a>
        <form method="post">
            <div class="textDesign">
                <p class="EntrerEmail_RecupMDP">Entrer votre email : <input type="email" class="textarea" name="email">
                </p>
                <input type="submit" value="Confirmer">
            </div>
        </form>
    </div>
    <?php

    ?>
</body>

<style>
    body {

        background-color: #FFFFF1;

    }

    .RetrouverMDP_titre {

        font-size: 25px;

    }

    .designIndexbox {

        position: relative;
        width: 400px;
        height: 200px;
        padding: 20px;
        border: 3px dashed black;
        border-radius: 15px;
        margin: auto;
        top: 275px;
        font-family: Netflix Sans, Helvetica Neue, Segoe UI, Roboto, Ubuntu, sans-serif;
        text-align: center;

    }

    .textDesign {

        text-align: center;
        margin-top: 50px;

    }

    .EntrerEmail_RecupMDP {

        margin-bottom: 30px;
        font-size: 18px;

    }
</style>