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
        <!-- Formulaire de modification de la tâche -->
        <form action="" method="post">
            <label for="libelle">Libellé :</label><br>
            <input type="text" id="libelle" name="libelle" value="<?php echo $tache->getLibelle(); ?>" required><br>

            <label for="description">Description :</label><br>
            <textarea id="description" name="description" required><?php echo $tache->getDescription(); ?></textarea><br>

            <label for="date_echeance">Date d'échéance :</label><br>
            <input type="date" id="date_echeance" name="date_echeance" value="<?php echo $tache->getDate_echeance(); ?>" required><br>

            <label for="priorite">Priorité :</label><br>
            <select name="priorite" id="priorite" required>
                <option value="Faible" <?php if ($tache->getPriorite() == 'Faible') echo 'selected'; ?>>Faible</option>
                <option value="Moyenne" <?php if ($tache->getPriorite() == 'Moyenne') echo 'selected'; ?>>Moyenne</option>
                <option value="Élevée" <?php if ($tache->getPriorite() == 'Élevée') echo 'selected'; ?>>Élevée</option>
            </select><br>

            <label for="difficulte">Difficulté :</label><br>
            <select name="difficulte" id="difficulte" required>
                <option value="Facile" <?php if ($tache->getDifficulte() == 'Facile') echo 'selected'; ?>>Facile</option>
                <option value="Moyen" <?php if ($tache->getDifficulte() == 'Moyen') echo 'selected'; ?>>Moyen</option>
                <option value="Difficile" <?php if ($tache->getDifficulte() == 'Difficile') echo 'selected'; ?>>Difficile</option>
            </select><br>

            <label for="etat">Etat :</label><br>
            <select name="etat" id="etat" required>
                <option value="À faire" <?php if ($tache->getEtat() == 'À faire') echo 'selected'; ?>>À faire</option>
                <option value="En cours" <?php if ($tache->getEtat() == 'En cours') echo 'selected'; ?>>En cours</option>
                <option value="Terminée" <?php if ($tache->getEtat() == 'Terminée') echo 'selected'; ?>>Terminée</option>
            </select><br>

            <input type="submit" name="submit" value="Modifier la tâche">
        </form>
<?php
    } else {
        echo "La tâche demandée n'existe pas.";
    }
} else {
    echo "Identifiant de la tâche non spécifié dans l'URL.";
}
?>
