<?php
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
    <h1>Le Blog du Greta Provence de Arles</h1>
    <main>
            <?php
            require_once 'model.php'; //Exécution coté serveur donc avant l'envoi au navigateur = Toujours mettre "require_once" & "include_once" ici.
            require_once 'repositoryFunction.php';
            $database = connexion();
            $billets = getBillet($database);
            foreach($billets as $billet) { ?> <!--Fermeture du PHP avant la création du HTML-->
            <div class="news">
            <h2><?php echo (htmlspecialchars($billet['titre'])); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($billet['contenu'])); ?></p>
            <p><?php echo$billet['date_creation']; ?></p>
            <a href="commentaires.php?billet=<?php echo $billet['id_billet']; ?>">Commentaires</a>
            </div>
            <?php } //Ouverture & fermeture du PHP pour les accolades
            ?>
    </main>
  </body>
  </html>

  