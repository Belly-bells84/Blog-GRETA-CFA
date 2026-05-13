<?php
require_once 'repositoryFunction.php';

//A) Vérifier les données POST existent avant de les utiliser + Récupérer les variables POST
if (isset($_POST['name_user'], $_POST['mail_user'], $_POST['mdp_user'])) {
    $nameU = htmlspecialchars($_POST['name_user']);
    $mailU = htmlspecialchars($_POST['mail_user']);
    $mdpU = htmlspecialchars($_POST['mdp_user']);
    $firstnameU = htmlspecialchars($_POST['firstname_user']);
    $mdpConfirm = htmlspecialchars($_POST['conf_mdp_user']);
    
    
    $database = connexion();

    verifPassword($mdpU, $mdpConfirm);
    registerUser($database, $nameU, $firstnameU, $mailU, $mdpU);
    
} else {
    header("Location: register.php");
    exit;
}