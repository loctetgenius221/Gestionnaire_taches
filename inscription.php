<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])){
    // Inclure le fichier de configuration de la base de données
    require_once 'inclusion/config.php';

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $email = $_POST['mail'];
    $mot_de_passe = $_POST['pass'];

    // Hasher le mot de passe avant de le stocker dans la base de données
    $password_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Préparer la requête d'insertion
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, password, telephone) VALUES (:nom, :prenom, :email, :password, :telephone)";

    // Préparer la requête
    $stmt = $bdd->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password_hash);
    $stmt->bindParam(':telephone', $tel);

    // Exécuter la requête
    if($stmt->execute()){
        // Rediriger vers la page de connexion si l'inscription est réussie
        header('Location: connexion.php');
        exit;
    } else {
        // Afficher un message d'erreur si l'inscription échoue
        echo "Erreur lors de l'inscription.";
    }
}
?>


<!-- Votre formulaire d'inscription HTML ici -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - To-Do List</title>
    <link rel="stylesheet" href="CSS/authen.css">
</head>
<body>

    <div id="container">
        <form action="inscription.php" method="post">
            <h1>Inscription To-Do List</h1>
            <div class="champs">
                <label for="nom">Nom : </label><br>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom.." required>
            </div>
            <div class="champs">
                <label for="prenom">Prénom : </label><br>
                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom.." required>
            </div>
            <div class="champs">
                <label for="tel">Téléphone : </label><br>
                <input type="tel" id="tel" name="tel" placeholder="Entrez votre télépone.." required>
            </div>
            <div class="champs">
                <label for="mail">Email : </label><br>
                <input type="email" id="mail" name="mail" placeholder="Entrez votre email.." required>
            </div>
            <div class="champs">
                <label for="pass">Mot de passe : </label><br>
                <input type="password" id="pass" name="pass" placeholder="Entrez votre mot de pass.." required>
            </div>
            <div class="champs">
                <input type="submit" name="submit" value="S'inscrire">
            </div>
            <p>Vous avez déja un compte! <a href="connexion.php">Se connecter</a></p>
        </form>
    </div>
    
</body>
</html>