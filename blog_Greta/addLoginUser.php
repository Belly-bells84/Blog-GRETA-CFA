<?php


require_once 'repositoryFunction.php';

if (isset($_POST['mail_user'], $_POST['mdp_user'])) {
    $mailU = htmlspecialchars($_POST['mail_user']);
    $mdpU = htmlspecialchars($_POST['mdp_user']);
    
    $database = connexion();
    loginUser($database, $mailU, $mdpU);

}else {
    header("Location: login.php");
    exit;
}