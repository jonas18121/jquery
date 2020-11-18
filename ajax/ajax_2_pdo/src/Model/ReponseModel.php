<?php

require_once 'Model.php';

class ReponseModel extends Model
{

    /**
     * selectionner tous les response d'un message précis
     */
    public function get_all_reponse($id_message)
    {
        $all_reponses = [];

        $sql = "SELECT * FROM reponse WHERE id_message = :id_message";
        $all_reponse = $this->bdd->prepare($sql);
        $all_reponse->setFetchMode(PDO::FETCH_CLASS, Reponse::class);
        $all_reponse->execute([':id_message' => $id_message]);

        $all_reponses = $all_reponse->fetchAll();

        return $all_reponses;
    }

    /**
     * Ajouter une reponse
     */
    public function add_reponse($id, $pseudo, $content, $adresse_ip, $id_message )
    {
        $sql = "INSERT INTO reponse (id, pseudo, content, adresse_ip, id_message) VALUES (:id, :pseudo, :content, :adresse_ip, :id_message)";
        $add_reponse = $this->bdd->prepare($sql);
        $add_reponse->setFetchMode(PDO::FETCH_CLASS, Reponse::class);
        $add_reponse->execute(
            [
                ':id'           => $id,
                ':pseudo'       => $pseudo, 
                ':content'      => $content, 
                ':adresse_ip'   => $adresse_ip, 
                ':id_message'   => $id_message
            ]
        );
    }
}
