<?php
require_once __DIR__ . '/../taches.php'; // Utilisation correcte de __DIR__ pour obtenir le chemin absolu du fichier taches.php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "gestion_taches");

try {
    $bdd = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME,DB_USER,DB_PASS);

    // Vous devez fournir les valeurs pour les arguments requis lors de la création d'une instance de la classe Tache
    $utilisateur_id = 1; // Exemple: Utilisateur avec l'ID 1
    $libelle = "Nouvelle tâche";
    $description = "Description de la tâche";
    $date_echeance = date('Y-m-d'); // Date actuelle au format YYYY-MM-DD
    $priorite = "Moyenne";
    $difficulte = 2; // Moyenne difficulté
    $etat = "À faire";


    // Créer une instance de la classe Tache en passant l'objet PDO et d'autres arguments requis
    $tache = new Tache($bdd, $utilisateur_id, $libelle, $description, $date_echeance, $priorite, $difficulte, $etat);
} catch(PDOException $e) {
    die("Impossible de se connecter à la base de données! : ".$e->getMessage());
}
?>
