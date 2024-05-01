<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'inclusion/config.php';
require_once 'taches.php';

// Vérifier si l'identifiant de la tâche est spécifié dans l'URL
if (isset($_GET['id'])) {
    $tache_id = $_GET['id'];

    // Instancier un objet Tache en passant l'identifiant de la tâche
    $tache = new Tache($bdd, $tache_id, $libelle, $description, $date_echeance, $priorite, $difficulte, $etat);

    // Vérifier si la tâche existe
    if (isset($tache)) {
        // Préparation de la requête SQL
        $stmt = $bdd->prepare("SELECT * FROM taches WHERE id = :tache_id");

        // Liaison du paramètre
        $stmt->bindParam(':tache_id', $tache_id);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Affichage des détails de la tâche
        if ($result) {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la tâche</title>
    <style>
        /* CSS pour la mise en page du détail de la tâche */

        body {
            margin: 0;
            padding: 0;
            font-family: "Montserrat", sans-serif;
            background: #ffffff;
        }

        .task-details {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .task-details h2 {
            font-size: 24px;
            color: #2B1887;
            margin-bottom: 20px;
        }

        .task-details p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .task-details strong {
            font-weight: bold;
        }

        .task-details a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: #ffffff;
            background-color: #2B1887;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .task-details a:hover {
            background-color: #200d80;
        }

    </style>
</head>
<body>

    
    <div class="task-details">
        <div class="bouton-retour">
            <a href="index.php">Retour</a>
        </div>
        <h2>Détails de la tâche</h2>
        <p><strong>Libellé:</strong> <?php echo $result['libelle']; ?></p>
        <p><strong>Description:</strong> <?php echo $result['description']; ?></p>
        <p><strong>Date d'échéance:</strong> <?php echo $result['date_echeance']; ?></p>
        <p><strong>Priorité:</strong> <?php echo $result['priorite']; ?></p>
        <p><strong>Difficulté:</strong> <?php echo $result['difficulte']; ?></p>
        <a href="update.php?id=<?php echo $tache_id; ?>" >Modifier la tâche</a>
        <a href="delete.php" >Supprimer la tâche</a>
    </div>

</body>
</html>

<?php
        } else {
            echo "La tâche demandée n'existe pas.";
        }
    } else {
        echo "La tâche demandée n'existe pas.";
    }
} else {
    echo "Identifiant de la tâche non spécifié dans l'URL.";
}
?>
