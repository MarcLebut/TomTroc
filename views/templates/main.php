<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lorem</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="/asset/css/style.css?v=1">
        <style>
            .test {
                color: red;
            }

            #backgroundSection {
                /* Chemin corrigé : on remonte d’un niveau */
                background-image: url('asset/images/bgSection.png');
                background-repeat: no-repeat;
                background-size: cover;
                /* remplit tout l’espace */
                background-position: center;
                /* centre l’image */
                height: 200px;
                width: 100%;
            }

            #bienvenue,
            #commentCaMarche,
            #nosValeurs {
                background-color: #F5F3EF;
            }

            #bienvenue,
            #commentCaMarche {
                padding-top: 50px;
                padding-bottom: 50px;
            }

            #bienvenue {
                min-height: 700px;
            }

            #nosValeurs {
                padding-top: 80px;
                padding-bottom: 100px;
                min-height: 600px;
            }

            #textBienvenue {
                font-size: 12px;
            }

            #derniersLivres, {
                background-color: #FAF9F7;
            }

            {
                background-color: #F5F3EF;
                padding-top: 50px;
                padding-bottom: 50px;
            }
            .adminArticle .articleLine:nth-child(odd) {
                background: #FFFFFF;
            } /* lignes impairs */
            .adminArticle .articleLine:nth-child(even) {
                background: #EDF2F6;
                color: black;
            } /* lignes paires */
            .adminArticle .articleLine:hover {
                background: #FFFFAA;
                color: black;
            }
            .adminArticle .articleLine span:hover {
                color: black;
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar" style="background-color:#F5F3EF">
                <div class="container-fluid d-flex justify-content-evenly">
                    <a class="navbar-brand" href="#">
                        <img src="asset/images/logo.png" alt="" width="155" height="51" class="d-inline-block align-text-top">

                    </a>
                    <a href="index.php">Accueil</a>
                    <a href="index.php?action=allbooks">Nos livres à l'échange</a>

                    <?php
                    // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion et du tableau de bord : 
                    if (isset($_SESSION['user'])) {
                        echo '<a href="index.php?action=">Messagerie</a>';
                        echo '<a href="index.php?action=myaccount">Voir mon compte</a>';
                        echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';

                    } else {
                        echo '<a href="index.php?action=connectionForm">Connexion</a>';
                    }

                    ?>
                </div>
            </nav>
            <nav></nav>

        </header>

        <main>
            <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
        </main>

        <footer>
            <p>Copyright © - Lorem -
            </p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            document.getElementById('togglePwd').addEventListener('click', function () {
const i = document.getElementById('password');
i.type = i.type === 'password' ? 'text' : 'password';
});
        </script>
    </body>

</html>

