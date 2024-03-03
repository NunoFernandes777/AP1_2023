<?php
if (isset($_SESSION["login"])) {
    if ($_SESSION["type"] == 0) {
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $requete = "SELECT COUNT(cr.num) as 'nb' from cr, utilisateur where cr.num_utilisateur = utilisateur.num and utilisateur.num = " . $_SESSION['id'];
        $resultat = mysqli_query($connexion, $requete);
        ?>

        <header>

            <div class="accueilpage">

                <ul class="nav" id="menu">
                    <div class="nav_logo">
                        <li><img src="LogoRapport.png" class="layout_rapport"></img></li>
                    </div>
                    <div class="nav_menu">
                        <li><a href="accueil.php">Accueil</a></li>
                        <li><a href="perso.php">Profil</a></li>
                        <li><a href="cr.php">Compte rendus</a></li>
                        <li><a href="ccr.php">Nouveau compte-rendu</a></li>
                    </div>
                    <div class="nav_menu_nbcr">
                        <?php
                        while ($donnees = mysqli_fetch_assoc($resultat)) {
                            if ($donnees['nb'] == 0)
                                echo "<a style='color: red'><b><i class='fa-solid fa-circle-exclamation' style='color: #ff0000;'></i> Vous avez crée : $donnees[nb] comptes rendus </b></a>";
                            else
                                echo "<a><i class='fa-regular fa-face-smile'></i> Vous avez crée : $donnees[nb] comptes rendus </a>";
                        }
                        ?>
                    </div>
                    <div class="nav_btn">
                        <form method='post' action='index.php'>
                            <button type="submit" name="deco" class="buttonDeco"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                        </form>
                    </div>
                </ul>
            </div>
        </header>
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
                        <button type="submit" name="deco" class="buttonDeco"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
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
                        <button type="submit" name="deco" class="buttonDeco"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
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

    .nav {
        list-style-type: none;
        border-radius: 5px;
        background-color: transparent;
        display: flex;
        justify-content: space-between;
        margin: auto;
        width: 95%;
        max-height: 80px;
    }


    .layout_rapport {
        width: 100px;
        margin-top: 8px;
    }

    .nav_menu_nbcr a {
        line-height: 5;
    }

    .nav li {
        float: left;
        margin: 0;    
    }

    .nav li a {
        display: block;
        color: black;
        text-align: center;
        font-size: 17px;
        padding: 14px 17px;
        text-decoration: none;
        line-height: 3;
    }

    .nav li a:hover {
        text-decoration: underline;
    }

    .nav_btn {
    width: 100px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

    .buttonDeco {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        background-color: transparent;
        color: black;
        padding: 8px 15px;
        border: 2px solid black;
        border-radius: 10px;

        position: fixed;
        top: 4%;
        left: 93%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);

        margin-top: auto;
        margin-bottom: auto;
}
    

    .buttonDeco:hover {
        cursor: pointer;
    }










    @media only screen and (max-width: 1200px) {

        .accueilpage {
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            width: 97%;
            margin: auto;

        }

        .nav {
            list-style-type: none;
            border-radius: 5px;
            background-color: transparent;
            display: flex;
            justify-content: space-between;
            margin: auto;
            width: 95%;
            max-height: 80px;
        }


        .layout_rapport {
            width: 100px;
            margin-top: 8px;
        }

        .nav_menu_nbcr a {
            line-height: 5;
        }

        .nav li {
            float: left;
            margin: 0;
        }

        .nav li a {
            width: 15px;
            display: block;
            color: black;
            text-align: center;
            font-size: 17px;
            padding: 14px 17px;
            text-decoration: none;
            line-height: 3;
            visibility: hidden;
        }

        .nav li a:hover {
            text-decoration: underline;
        }

        .buttonDeco {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            background-color: transparent;
            color: black;
            padding: 8px 15px;
            border: 2px solid black;
            border-radius: 10px;

            position: absolute;
            top: 4%;
            left: 93%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .buttonDeco:hover {
            cursor: pointer;
        }
    }
</style>

<script src="https://kit.fontawesome.com/f01ff634ff.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var menu = document.getElementById('menu');
        var toggleButton = document.getElementById('toggleButton');

        toggleButton.addEventListener('click', function () {
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        });
    });
</script>