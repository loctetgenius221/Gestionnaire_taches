<?php
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "gestion_taches");

    try {

        $bdd = new PDO("mysql:host".DB_SERVER.";dbname=".DB_NAME,DB_USER,DB_PASS);

    } catch(PDOException $e) {
        die("Impossible de se connecter à la base de données! : ".$e->getMessage());
    }