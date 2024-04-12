<?php
require_once 'inclusion/tacheInterface.php';

    class Tache implements crudTache {

        private $bdd;
        private $utilisateur_id;
        private $libelle;
        private $description;
        private $date_echeance;
        private $priorite;
        private $difficulte;
        private $etat;


        public function __construct($bdd, $utilisateur_id, $libelle, $description, $date_echeance, $priorite, $difficulte, $etat) {

            $this->bdd = $bdd;
            $this->utilisateur_id = $utilisateur_id;
            $this->libelle = $libelle;
            $this->description = $description;
            $this->date_echeance = $date_echeance;
            $this->priorite = $priorite;
            $this->difficulte = $difficulte;
            $this->etat = $etat;


        }

        public function getUtilisateur_id() {
            return $this->utilisateur_id;
        }

        public function setUtilisateur_id($nouveauUtilisateur_id) {
            $this->utilisateur_id = $nouveauUtilisateur_id;
        }

        public function getLibelle() {
            return $this->libelle;
        }

        public function setLibelle($nouveauLibelle) {
            $this->libelle = $nouveauLibelle;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($nouveauDescription) {
            $this->description = $nouveauDescription;
        }

        public function getDate_echeance() {
            return $this->date_echeance;
        }

        public function setDate_echeance($nouveauDate_echeance) {
            $this->date_echeance = $nouveauDate_echeance;
        }

        public function getPriorite() {
            return $this->priorite;
        }

        public function setPriorite($nouveaupriorite) {
            $this->priorite = $nouveauPriorite;
        }

        public function getDifficulte() {
            return $this->difficulte;
        }

        public function setDifficulte($nouveauDifficulte) {
            $this->difficulte = $nouveauDifficulte;
        }

        public function getEtat() {
            return $this->etat;
        }

        public function setEtat($nouveauEtat) {
            $this->etat = $nouveauEtat;
        }

        // Méthode d'ajout de client
        public function createTache($utilisateur_id, $libelle, $description, $date_echeance, $priorite, $difficulte, $etat) {

            try {

                $stmt = $this->bdd->prepare("INSERT INTO client (utilisateur_id, libelle, description, date_echeance, priorite, difficulte, :etat) VALUES (:utilisateur_id, :libelle, :description, :date_echeance, :priorite, :difficulte, :etat)");

                $stmt->bindParam(':utilisateur_id', $utilisateur_id);
                $stmt->bindParam(':libelle', $libelle);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':date_echeance', $date_echeance);
                $stmt->bindParam(':priorite', $priorite);
                $stmt->bindParam(':difficulte', $difficulte);
                $stmt->bindParam(':etat', $etat);


                $stmt->execute();

                header('location: view_client.php');
                exit;

            } catch(PDOException $e) {
                die("Impossible d'insérer les données dans la base : ".$e->getMessage());
            }
        }  

        public function readTache() {

            try{

                $sth->execute("SELECT * FROM taches");
                $sth->execute();

                //Récupération des résultats
                $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $resultat;
            
            } catch(PDOException $e) {
                die("Impossible d'afficher les données de la base : ".$e->getMessage());
            }
        }

        public function lireTachesParEtat($etat) {
            try {
                $stmt = $this->bdd->prepare("SELECT * FROM taches WHERE etat = :etat");
                $stmt->bindParam(':etat', $etat);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                die("Impossible de récupérer les tâches : ".$e->getMessage());
            }
        }
        

        public function updateTache($id, $utilisateur_id, $libelle, $description, $date_echeance, $priorite, $difficulte, $etat) {
            try {
                $stmt = $this->bdd->prepare("UPDATE taches SET utilisateur_id = :utilisateur_id, libelle = :libelle, description = :description, date_echeance = :date_echeance, priorite = :priorite, difficulte = :difficulte, etat = :etat WHERE id = :id");
        
                $stmt->bindParam(':utilisateur_id', $utilisateur_id);
                $stmt->bindParam(':libelle', $libelle);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':date_echeance', $date_echeance);
                $stmt->bindParam(':priorite', $priorite);
                $stmt->bindParam(':difficulte', $difficulte);
                $stmt->bindParam(':etat', $etat);
                $stmt->bindParam(':id', $id);
        
                $stmt->execute();
        
                header('location: view_client.php');
                exit;
            } catch(PDOException $e) {
                die("Impossible de modifier les données du client : ".$e->getMessage());
            }
        }
        

        public function deleteTache($id) {

            try {
    
                $sth = $this->bdd->prepare("DELETE FROM taches WHERE id = :id");
    
                $sth->bindParam(':id', $id, PDO::PARAM_INT);
                $sth->execute();
    
                header('location: view_client.php');
                exit;
    
            } catch(PDOException $e) {
                die("Impossible de supprimer le client : ".$e->getMessage());
            }
        }
    
    
    
    
    
    
    }