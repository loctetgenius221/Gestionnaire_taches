<?php

$message_erreur = "";

if(isset($_POST['submit'])){
    require_once 'inclusion/config.php';

    $email = $_POST['mail'];
    $mot_de_passe = $_POST['pass'];

    $sql = "SELECT id, email, password FROM utilisateurs WHERE email = :email";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Récupérer le résultat de la requête
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if($utilisateur){

        if(password_verify($mot_de_passe, $utilisateur['password'])){
            // Démarrer la session
            session_start();

            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['user_id'] = $utilisateur['id'];

            header('Location: index.php');
            exit;
        } else {
            $message_erreur = "Mot de passe incorrect.";
        }
    } else {
        $message_erreur = "Aucun utilisateur trouvé avec cet e-mail.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - To-Do List</title>
    <link rel="stylesheet" href="CSS/authen.css">
</head>
<body>

    <div id="container">
        <form action="connexion.php" method="post">
            <h1>Connexion à To-Do List</h1>
            <!-- Afficher le message d'erreur -->
            <?php if(!empty($message_erreur)) { ?>
                <div class="erreur"><?php echo $message_erreur; ?></div>
            <?php } ?>

            <div class="champs">
                <label for="mail">Email : </label><br>
                <input type="email" id="mail" name="mail" placeholder="Entrez votre email.." required>
            </div>
            <div class="champs">
                <label for="pass">Mot de passe : </label><br>
                <input type="password" id="pass" name="pass" placeholder="Entrez votre mot de pass.." required>
            </div>
            <div class="champs">
                <input type="submit" name="submit" value="Se connecter">
            </div>
            <p>Vous n'avez pas encore de compte! <a href="inscription.php">S'inscrire ici</a></p>
        </form>
    </div>
    
</body>
</html>