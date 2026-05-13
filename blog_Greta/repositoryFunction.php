<?php require_once 'model.php';

function connexion() : PDO {
    try {
        $database = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    } catch (PDOException $e){
        die('Erreur: '.$e->getMessage(). '</br>');
    }
    return $database;
}
$database = connexion();

function getBillet($database) {
    $stmt = $database->prepare('SELECT titre, id_billet, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%m min %s sec") AS date_creation FROM billets ORDER BY date_creation DESC LIMIT 5');
    $stmt->execute();
    $billets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $billets;
}

?>