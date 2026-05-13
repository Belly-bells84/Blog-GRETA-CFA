<?php
session_start(); //Premier ligne obligatoire
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
require_once 'repositoryFunction.php';
// on récupère l'id = ISSET => Que le paramètre existe dans l'URL / is_numeric => Que c'est bien un nombre entier
if (isset($_GET['billet']) && is_numeric($_GET['billet'])) {  //Retour = TRUE OU FALSE
   $id = $_GET['billet']; // on récupère l'id
} else {
    header('Location: index.php'); // on redirige vers index.php
    exit; //Sans exit = PHP continue d'exécuter le code ce qui cause des failles de sécurités et des comportements inattendus
}
$database = connexion();
// 1. Préparer => QUERY = DANGER
    $stmt = $database->prepare("SELECT titre, contenu, date_creation FROM billets WHERE id_billet = :id"); //Paramétres nommées
// 2. Exécuter avec la valeur
    $stmt->execute([':id' => $id] ); //Paramétres nommés : clé => valeur; 
// 3. Récupérer
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

$request2 = $database ->prepare("SELECT auteur, date_commentaires, commentaires FROM commentaires WHERE id_billet = :id ORDER BY date_commentaires ASC");
$request2->execute([':id' => $id]);
$comments = $request2->fetchAll(PDO::FETCH_ASSOC);
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
        <div class="comment"></div>
            <a href="index.php">Retour</a>
            <h1><?php echo (htmlspecialchars($post['titre'])); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($post['contenu'])); ?></p>
            <p><?php echo$post['date_creation']; ?></p>
             <h2>Commentaires</h2>            
            <?php foreach($comments as $comment) { ?>
                <strong><?php echo $comment['auteur']; ?></strong>
                <p><?php echo$comment['date_commentaires']; ?></p>
                <p><?php echo nl2br(htmlspecialchars($comment['commentaires'])); ?></p>
            <?php } ?>
            </div>

<!--Formulaire d'ajout d'un commentaire-->
                <form method="POST" action="addCommentaires.php">
                     <input type="hidden" name="id_billet" value="<?php echo $id ?>"> <!--Récupération de l'id PHP pour le mettre en HTML-->
                     <label for="auteur">Votre nom :</label>
                    <input type="text" name="author_name" id="auteur">
                    <label for="contenu_commentaire">Votre commentaire :</label>
                    <textarea name="contenu_commentaire" id="contenu_commentaire"></textarea>
                    <button type="submit" id="benjamin">Envoi du formulaire</button>
                </form>
    </main>
  </body>
  </html>