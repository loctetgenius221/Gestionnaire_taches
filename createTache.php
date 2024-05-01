<?php 

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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        textarea,
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="%23424242" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position-x: calc(100% - 10px);
            background-position-y: center;
            padding-right: 30px;
        }

        input[type="submit"] {
            background-color: #2B1887;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
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
