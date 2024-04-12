<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Bienvenue, Utilisateur</h3>
            <span>Nom d'utilisateur</span>
        </div>
        <ul class="list-infos">
            <li>Nom</li>
            <li>Prénom</li>
            <li>Téléphone</li>
            <li>Mail</li>

        </ul>
        <div class="logout-btn">
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i>Déconnexion</a>
        </div>
    </nav>
    <div class="main-content">
        <div class="column">
            <h2>À faire</h2>
            <div class="task-list">
                <?php //afficherTaches($tachesAFaire); ?>
            </div>
        </div>
        <div class="column">
            <h2>En cours</h2>
            <div class="task-list">
                <?php //afficherTaches($tachesEnCours); ?>
            </div>
        </div>
        <div class="column">
            <h2>Terminée</h2>
            <div class="task-list">
                <?php //afficherTaches($tachesTerminee); ?>
            </div>
        </div>
    </div>

</body>
</html>
