<?php

class ReponseModel
{
    public $bdd;

    public function __construct()
    {
        $this->bdd = new Database();
        $this->bdd = $this->bdd->connect_bdd();
    }

    /**
     * selectionner tous les response d'un message précis
     */
    public function get_all_reponse($id_message, $r_id = null, $r_pseudo = null, $r_content = null, $r_date_at = null, $r_adresse_ip = null, $r_id_message = null)
    {
        $all_reponses = [];

        $sql = "SELECT * FROM reponse WHERE id_message = ?";
        $all_reponse = $this->bdd->prepare($sql);
        $all_reponse->bind_param("i", $id_message);

        $all_reponse->execute();
        $all_reponse->bind_result($r_id, $r_pseudo, $r_content, $r_date_at, $r_adresse_ip,  $r_id_message);
        while ($all_reponse->fetch()) {
            $all_reponses[] = Reponse::construct_params($r_id, $r_pseudo, $r_content, $r_date_at, $r_adresse_ip, $r_id_message);
        }
        //pre_var_dump('ligne 29, ReponseModel.php ',$all_reponses, true);
        return $all_reponses;
    }

    /**
     * Ajouter une reponse
     */
    public function add_reponse($id, $pseudo, $content, $adresse_ip, $id_message )
    {
        $sql = "INSERT INTO reponse (id, pseudo, content, adresse_ip, id_message) VALUES (?, ?, ?, ?, ?)";
        $add_message = $this->bdd->prepare($sql);
        $add_message->bind_param('isssi', $id, $pseudo, $content, $adresse_ip, $id_message);
        $add_message->execute();
    }
}
