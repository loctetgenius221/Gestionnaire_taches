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
        // Récupérer les données de la tâche depuis la base de données pour pré-remplir le formulaire
        $stmt = $bdd->prepare("SELECT * FROM taches WHERE id = :tache_id");
        $stmt->bindParam(':tache_id', $tache_id);
        $stmt->execute();
        $tache_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si la tâche existe
        if ($tache_data) {
            // Créer l'objet Tache avec les données récupérées
            $tache = new Tache($bdd, $tache_id, $tache_data['libelle'], $tache_data['description'], $tache_data['date_echeance'], $tache_data['priorite'], $tache_data['difficulte'], $tache_data['etat']);
        } else {
            echo "La tâche demandée n'existe pas.";
        }

        // Vérifier si le formulaire de modification est soumis
        if (isset($_POST['submit'])) {
            // Récupérer les nouvelles valeurs des champs
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
            $date_echeance = $_POST['date_echeance'];
            $priorite = $_POST['priorite'];
            $difficulte = $_POST['difficulte'];
            $etat = $_POST['etat'];

            // Mettre à jour la tâche dans la base de données
            try {
                $stmt = $bdd->prepare("UPDATE taches SET libelle = :libelle, description = :description, date_echeance = :date_echeance, priorite = :priorite, difficulte = :difficulte, etat = :etat WHERE id = :tache_id");
                $stmt->bindParam(':libelle', $libelle);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':date_echeance', $date_echeance);
                $stmt->bindParam(':priorite', $priorite);
                $stmt->bindParam(':difficulte', $difficulte);
                $stmt->bindParam(':etat', $etat);
                $stmt->bindParam(':tache_id', $tache_id);

                $stmt->execute();

                header('Location: detailsTache.php?id=' . $tache_id); // Rediriger vers la page de détails de la tâche mise à jour
                exit;
            } catch (PDOException $e) {
                die("Erreur lors de la mise à jour de la tâche : " . $e->getMessage());
            }
        }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de tâche</title>
    <style>
        /* Mise en page CSS */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 15px;
        }

        .field label {
            font-weight: bold;
        }

        .field input[type="text"],
        .field textarea,
        .field select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .field select {
            width: calc(100% - 20px);
        }

        .field input[type="submit"] {
            background-color: #2B1887;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .field input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <form action="" method="post">
            <h1>Modification de tâche</h1>
            
            <div class="field">
                <label for="libelle">Libellé :</label><br>
                <input type="text" id="libelle" name="libelle" value="<?php echo $tache->getLibelle(); ?>" required>
            </div>
            <div class="field">
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" required><?php echo $tache->getDescription(); ?></textarea>
            </div>
            <div class="field">
                <label for="date_echeance">Date d'échéance :</label><br>
                <input type="date" id="date_echeance" name="date_echeance" value="<?php echo $tache->getDate_echeance(); ?>" required>
            </div>
            <div class="field">
                <label for="priorite">Priorité :</label><br>
                <select name="priorite" id="priorite" required>
                    <option value="Faible" <?php if ($tache->getPriorite() == 'Faible') echo 'selected'; ?>>Faible</option>
                    <option value="Moyenne" <?php if ($tache->getPriorite() == 'Moyenne') echo 'selected'; ?>>Moyenne</option>
                    <option value="Élevée" <?php if ($tache->getPriorite() == 'Élevée') echo 'selected'; ?>>Élevée</option>
                </select>
            </div>
            <div class="field">
                <label for="difficulte">Difficulté :</label><br>
                <select name="difficulte" id="difficulte" required>
                    <option value="Facile" <?php if ($tache->getDifficulte() == 'Facile') echo 'selected'; ?>>Facile</option>
                    <option value="Moyen" <?php if ($tache->getDifficulte() == 'Moyen') echo 'selected'; ?>>Moyen</option>
                    <option value="Difficile" <?php if ($tache->getDifficulte() == 'Difficile') echo 'selected'; ?>>Difficile</option>
                </select>
            </div>
            <div class="field">
                <label for="etat">État :</label><br>
                <select name="etat" id="etat" required>
                    <option value="À faire" <?php if ($tache->getEtat() == 'À faire') echo 'selected'; ?>>À faire</option>
                    <option value="En cours" <?php if ($tache->getEtat() == 'En cours') echo 'selected'; ?>>En cours</option>
                    <option value="Terminée" <?php if ($tache->getEtat() == 'Terminée') echo 'selected'; ?>>Terminée</option>
                </select>
            </div>
            
            <div class="field">
                <input type="submit" name="submit" value="Modifier la tâche">
            </div>
        </form>
    </div>

</body>
</html>
<?php
    } else {
        echo "La tâche demandée n'existe pas.";
    }
} else {
    echo "Identifiant de la tâche non spécifié dans l'URL.";
}
?>
