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

//Fonction de vérification = RegEX
function verifPassword(){

}
//fonction d'inscription =
function registerUser($database, $nameU, $firstnameU, $mailU, $mdpU) {
    $mdp_securise = password_hash($mdpU, PASSWORD_DEFAULT); //Utilisation de l'algorithme bcrypt => Evite les fuites de données sensibles en cas de vole de la BD
    $stmt = $database->prepare("INSERT INTO users (name_user, firstname_user, mail_user, mdp_user) VALUES (:name_user, :firstname_user, :mail_user, :mdp_user)");
    $stmt->execute([':name_user' => $nameU, ':firstname_user' => $firstnameU, ':mail_user' => $mailU, ':mdp_user' => $mdp_securise]);
}
//Fonction de connexion =
function loginUser($database, $mailU, $mdpU) {
    
    $stmt = $database->prepare("SELECT id_user, name_user, firstname_user, mail_user FROM users WHERE mail_user = :mailU");
    $stmt->execute([':mail_user' => $mailU]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($mdpU, $user['mdp_user'])){
        session_start();
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['name_user'] = $user['name_user'];
        $_SESSION['mail_user'] = $user['mail_user'];
        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php?erreur=1");
        exit;
    }
}

?>