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
            <h1>Inscription To-Do List</h1>

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