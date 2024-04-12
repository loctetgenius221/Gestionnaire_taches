# Application de Gestion de Tâches

Cette application de gestion de tâches est conçue pour aider les utilisateurs à organiser et à gérer efficacement leurs tâches quotidiennes. Elle offre des fonctionnalités telles que la création, la modification, la suppression et la visualisation des tâches, ainsi que la possibilité d'attribuer un niveau de priorité et de difficulté à chaque tâche.

# Fonctionnalités

- Espace Personnel pour Chaque Employé : Chaque utilisateur dispose d'un espace personnel où il peut voir la liste de ses propres tâches.

- Création de Tâches : Les utilisateurs peuvent créer de nouvelles tâches en spécifiant un libellé, une description, une date d'échéance, une priorité et une difficulté.

- Modification et Suppression de Tâches : Les utilisateurs peuvent modifier les détails des tâches existantes ou les supprimer si nécessaire.

- Marquer les Tâches comme Terminées : Les utilisateurs peuvent marquer une tâche comme terminée lorsqu'ils ont accompli la tâche.

- Authentification des Utilisateurs : Les utilisateurs doivent se connecter avec leurs identifiants pour accéder à leur espace personnel et aux fonctionnalités de gestion des tâches.

# Structure de la Base de Données

L'application utilise une base de données MySQL pour stocker les informations des utilisateurs et des tâches. Voici la structure de base de données :

- Table utilisateurs :

    id : Identifiant de l'utilisateur (clé primaire)
    username : Nom d'utilisateur unique
    password : Mot de passe haché

- Table taches :

    id : Identifiant de la tâche (clé primaire)
    utilisateur_id : Identifiant de l'utilisateur auquel la tâche est assignée (clé étrangère)
    libelle : Libellé de la tâche
    description : Description de la tâche
    date_echeance : Date d'échéance de la tâche
    priorite : Priorité de la tâche (Faible, Moyenne, Élevée)
    difficulte : Difficulté de la tâche (Facile, Moyen, Difficile)
    etat : État de la tâche (À faire, En cours, Terminée)

# Installation et Configuration

- Clonez le dépôt GitHub de l'application : git clone https://github.com/loctetgenius221/Gestionnaire_taches.git
- Importez le script SQL fourni dans votre gestionnaire de base de données pour créer les tables nécessaires.
- Configurez les paramètres de connexion à la base de données dans le fichier config.php.
Assurez-vous que votre serveur Web prend en charge PHP(8.2.4) et MySQL(10.4.28-MariaDB).

# Auteurs

Cette application a été développée par Moussa Sagna (l'octet-Génius).

# Licence

Aucune