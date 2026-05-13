<?php
//Complexification du code original 

// 1.Constante de connexion PDO =
define('DB_HOST', '');
define('DB_PORT', '3306');
define('DB_DATABASE', 'blog_greta');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');



//Structure & code original

// //Connexion PDO =
// define('DB_HOST', '');
// define('DB_PORT', '3306');
// define('DB_DATABASE', 'blog_greta');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');

// try{
// $database = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
// } catch (PDOException $e){
//     die('Erreur: '.$e->getMessage(). '</br>');
// }
// $sql = $database->query('SELECT titre, id_billet, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%m min %s sec") AS date_creation FROM billets ORDER BY date_creation DESC LIMIT 5'); //ORDER BY = Ranger par...
// // /!\ Attention à l'ordre : ("SELECT...DATE_FORMAT()...FROM...ORDER BY...LIMIT");