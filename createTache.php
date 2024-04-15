<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'inclusion/config.php';

session_start();

// Vérifier si l'utilisateur est connecté en vérifiant s'il existe une session d'utilisateur
if(isset($_SESSION['user_id'])){

    $utilisateur_id = $_SESSION['user_id'];

    if(isset($_POST['submit'])){

        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $date_echeance = $_POST['date_echeance'];
        $priorite = $_POST['priorite'];
        $difficulte = $_POST['difficulte'];

        if(!empty($libelle) && !empty($description) && !empty($date_echeance) && !empty($priorite) && !empty($difficulte)) {

            try{

                $stmt = $bdd->prepare("INSERT INTO taches (utilisateur_id, libelle, description, date_echeance, priorite, difficulte) VALUES (:utilisateur_id, :libelle, :description, :date_echeance, :priorite, :difficulte)");

                $stmt->bindParam(':utilisateur_id', $utilisateur_id);
                $stmt->bindParam(':libelle', $libelle);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':date_echeance', $date_echeance);
                $stmt->bindParam(':priorite', $priorite);
                $stmt->bindParam(':difficulte', $difficulte);

                $stmt->execute();

                header('location: index.php');
                exit;
            } catch(PDOException $e) {
                die("Erreur lors de l'ajout de la tâche : " . $e->getMessage());
            }

        } else {
            echo "Tous les champs sont requis.";
        }
    } else {
        echo "Le formulaire n'a pas été soumis.";
    }

} else {
    // L'utilisateur n'est pas connecté, vous pouvez rediriger vers la page de connexion ou afficher un message d'erreur
    header('Location: connexion.php');
    exit;
}

// Définir les valeurs ENUM pour priorité, difficulté et état directement dans le code
$priorites = array('Faible', 'Moyenne', 'Élevée');
$difficultes = array('Facile', 'Moyen', 'Difficile');
$etats = array('À faire', 'En cours', 'Terminée');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

    <div class="container">
        <form action="createTache.php" method="post">
            <h1>Ajouter une tâche</h1>
            
            <div class="field">
                <label for="libelle">Libellé :</label><br>
                <input type="text" id="libelle" name="libelle" required>
            </div>
            <div class="field">
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="field">
                <label for="date_echeance">Date d'échéance :</label><br>
                <input type="date" id="date_echeance" name="date_echeance" required>
            </div>
            <div class="field">
                <label for="priorite">Priorité :</label><br>
                <select name="priorite" id="priorite" required>
                    <option value="" selected disabled>Choisir une Priorité</option>
                    <?php foreach ($priorites as $priorite) : ?>
                        <option value="<?php echo $priorite; ?>"><?php echo $priorite; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">  
                <label for="difficulte">Difficulté :</label><br>
                <select name="difficulte" id="difficulte" required>
                    <option value="" selected disabled>Choisir une Difficulté</option>
                    <?php foreach ($difficultes as $difficulte) : ?>
                        <option value="<?php echo $difficulte; ?>"><?php echo $difficulte; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="field">
                <input type="submit" value="Ajouter" name="submit">
            </div>
        </form>
    </div>
</body>
</html>
