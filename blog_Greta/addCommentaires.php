<?php
require_once 'repositoryFunction.php';

//A) Vérifier les données POST existent avant de les utiliser =
if (isset($_POST['id_billet'])) {
} else {
    header("Location: index.php");
    exit;
}

//htmlspecialchars = Sécurisation pour les variables author/contenu => Evitement de la faille XSS
$id = $_POST['id_billet'];
$author = htmlspecialchars($_POST['author_name']);
$contenu = htmlspecialchars($_POST['contenu_commentaire']);

//B) Vérification si les champs sont vides ou non
//La fonction empty() = retourne TRUE si vide, FALSE si rempli
if (empty($author) || empty($contenu)) {// Un des champs est vide, on redirige
    header("Location: commentaires.php?billet=$id");
    exit;
}
$stmt = $database->prepare("INSERT INTO commentaires (id_billet, auteur, commentaires) VALUES (:id_billet, :auteur, :commentaires)");
$stmt->execute([':id_billet' => $id, ':auteur' => $author, ':commentaires' => $contenu]);
    header("Location: commentaires.php?billet=$id"); //redirection vers la page
    exit;
?>
