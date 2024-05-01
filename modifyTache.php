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
    }

    // Récupérer l'ID de la tâche à modifier depuis l'URL
    if(isset($_GET['id'])) {
        $tache_id = $_GET['id'];

        $stmt = $bdd->prepare("SELECT * FROM taches WHERE id = :id AND utilisateur_id = :utilisateur_id");
        $stmt->bindParam(':id', $tache_id);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
        $tache = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {

        header('Location: index.php');
        exit;
    }

} else {

    header('Location: connexion.php');
    exit;
}

$priorites = array('Faible', 'Moyenne', 'Élevée');
$difficultes = array('Facile', 'Moyen', 'Difficile');
$etats = array('À faire', 'En cours', 'Terminée');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une tâche</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

    <div class="container">
        <form action="modifyTache.php?id=<?php echo $tache_id; ?>" method="post">
            <h1>Modifier une tâche</h1>
            
            <div class="field">
                <label for="libelle">Libellé :</label><br>
                <input type="text" id="libelle" name="libelle" required value="<?php echo $tache['libelle']; ?>">
            </div>
            <div class="field">
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" required><?php echo $tache['description']; ?></textarea>
            </div>
            <div class="field">
                <label for="date_echeance">Date d'échéance :</label><br>
                <input type="date" id="date_echeance" name="date_echeance" required value="<?php echo $tache['date_echeance']; ?>">
            </div>
            <div class="field">
                <label for="priorite">Priorité :</label><br>
                <select name="priorite" id="priorite" required>
                    <?php foreach ($priorites as $priorite) : ?>
                        <option value="<?php echo $priorite; ?>" <?php if($tache['priorite'] == $priorite) echo 'selected'; ?>><?php echo $priorite; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">  
                <label for="difficulte">Difficulté :</label><br>
                <select name="difficulte" id="difficulte" required>
                    <?php foreach ($difficultes as $difficulte) : ?>
                        <option value="<?php echo $difficulte; ?>" <?php if($tache['difficulte'] == $difficulte) echo 'selected'; ?>><?php echo $difficulte; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="field">
                <input type="submit" value="Modifier" name="submit">
            </div>
        </form>
    </div>
</body>
</html>
