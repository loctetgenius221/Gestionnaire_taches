<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'inclusion/config.php';
require_once 'taches.php';

// Vérifier si l'identifiant de la tâche est spécifié dans l'URL
if (isset($_GET['id'])) {
    $tache_id = $_GET['id'];

    try {
        // Préparation de la requête SQL pour supprimer la tâche avec l'identifiant spécifié
        $stmt = $bdd->prepare("DELETE FROM taches WHERE id = :tache_id");
        $stmt->bindParam(':tache_id', $tache_id);
        $stmt->execute();

        // Redirection vers la page d'accueil après la suppression
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de la suppression de la tâche : " . $e->getMessage());
    }
} else {
    // Si l'identifiant de la tâche n'est pas spécifié dans l'URL, afficher un message d'erreur
    echo "Identifiant de la tâche non spécifié dans l'URL.";
}
?>
