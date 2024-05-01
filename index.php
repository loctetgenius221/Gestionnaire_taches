<?php

session_start();

require_once 'inclusion/config.php';
require_once 'taches.php'; 

if(isset($_SESSION['user_id'])) {
    $utilisateur_id = $_SESSION['user_id'];
    $prenomUtilisateur = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
    $nomUtilisateur = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
    $telephoneUtilisateur = isset($_SESSION['telephone']) ? $_SESSION['telephone'] : '';
    $emailUtilisateur = isset($_SESSION['email']) ? $_SESSION['email'] : '';


    // Récupérer les tâches depuis la base de données
    $tachesAFaire = $tache->lireTachesParEtat('À faire', $utilisateur_id);
    $tachesEnCours = $tache->lireTachesParEtat('En cours', $utilisateur_id);
    $tachesTerminee = $tache->lireTachesParEtat('Terminée', $utilisateur_id);
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: connexion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
        .main-content {
            position: relative;
            height:  90vh;
        }
        .main-content .addbtn {
            /* position: absolute; */
            /* bottom: 0;
            right: 5%; */
        }
        .main-content .addbtn span {
            padding: 8px 18px;
            border-radius: 10px;
            background: #D5CCFF;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-content .addbtn a {
            text-decoration: none;
            color: #2B1887;
            font-size: .8rem;
            font-weight: bold;
        }
        .task-list {
            border-radius: 5px;
            margin-top: 10px;
        }
        .task-list .task {
            margin: 10px 0px;
            background: #fff;
            padding: 15px 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
               
        }
    </style>
</head>
<body>
    <nav class="sidebar">
    <div class="sidebar-header">
        <h3>Bienvenue, <span><?php echo $_SESSION['prenom']; ?></span></h3>
        <span><?php echo $_SESSION['nom']; ?></span>
    </div>
        <ul class="list-infos">
            <li><?php echo $_SESSION['nom']; ?></li>
            <li><?php echo $_SESSION['prenom']; ?></li>
            <li><?php echo $_SESSION['telephone']; ?></li>
            <li><?php echo $_SESSION['email']; ?></li>
        </ul>
        <div class="logout-btn">
            <a href="deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i>Déconnexion</a>
        </div>
    </nav>
    <div class="main-content">
        
        <div class="column">
            <h2>À faire</h2>
            <div class="task-list">
                <?php 
                // Afficher les tâches à faire
                foreach($tachesAFaire as $tache) {
                    echo "<div class='task'>";
                    echo "<span class='label'>" . $tache['libelle'] . "</span>";
                    echo "<span>Date d'échéance: " . $tache['date_echeance'] . "</span>";
                    echo "<span>Priorité: " . $tache['priorite'] . "</span>";
                    echo "<span>Difficulté: " . $tache['difficulte'] . "'</span>";
                    echo "<a href='detailsTache.php?id=" . $tache['id'] . "' class='view-btn'><i class='fa-regular fa-eye'></i></a>";
                    echo "</div>";
                }
                ?>
                <div class="addbtn">
                    <span>
                        <a href="createTache.php">Ajouter une tache</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="column">
            <h2>En cours</h2>
            <div class="task-list">
                <?php 
                // Afficher les tâches en cours
                foreach($tachesEnCours as $tache) {
                    echo "<div class='task'>";
                    echo "<span class='label'>" . $tache['libelle'] . "</span>";
                    echo "<span>Date d'échéance: " . $tache['date_echeance'] . "</span>";
                    echo "<span>Priorité: " . $tache['priorite'] . "</span>";
                    echo "<span>Difficulté: " . $tache['difficulte'] . "'</span>";
                    echo "<a href='detailsTache.php?id=" . $tache['id'] . "' class='view-btn'><i class='fa-regular fa-eye'></i></a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <div class="column">
            <h2>Terminée</h2>
            <div class="task-list">
                <?php 
                // Afficher les tâches terminées
                foreach($tachesTerminee as $tache) {
                    echo "<div class='task'>";
                    echo "<span class='label'>" . $tache['libelle'] . "</span>";
                    echo "<span>Date d'échéance: " . $tache['date_echeance'] . "</span>";
                    echo "<span>Priorité: " . $tache['priorite'] . "</span>";
                    echo "<span>Difficulté: " . $tache['difficulte'] . "'</span>";
                    echo "<a href='detailsTache.php?id=" . $tache['id'] . "' class='view-btn'><i class='fa-regular fa-eye'></i></a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
