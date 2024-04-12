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