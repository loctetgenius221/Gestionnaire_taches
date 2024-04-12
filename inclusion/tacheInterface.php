<?php
interface crudTache
{
    public function createTache( $utilisateur_id, $libelle, $description, $date_echeance, $priorite, $difficulte, $etat);
    public function readTache();
    public function updateTache($id, $utilisateur_id, $libelle, $description, $date_echeance, $priorite, $difficulte, $etat);
    public function deleteTache($id);
}
?>