<?php
require_once 'repositoryFunction.php';

session_start();
if (isset($_SESSION['id_user'])) {
    // déjà connecté, on redirige
    header("Location: index.php?erreur=1");
    exit;
}

?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Le Blog du Greta</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
        <main>
            <form method="POST" action="addUser.php">
                    <input type="text" name="name_user" id="user_name" placeholder="Nom de famille">
                    <input type="text" name="firstname_user" id="user_firstname" placeholder="Prénom">
                    <input type="text" name="mail_user" id="user_mail" placeholder="Votre adresse mail">
                    <input type="password" name="mdp_user" id="user_mdp" placeholder="Votre mot de passe">
                    <input type="password" name="conf_mdp_user" id="user_mdp_conf" placeholder="Confirmer votre mot de passe">
                    <button type="submit" id="benjamin">Inscription</button>
                </form>
        </main>
    </body>
</html>