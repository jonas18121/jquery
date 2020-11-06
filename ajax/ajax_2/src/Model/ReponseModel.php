<?php

class ReponseModel
{
    public $bdd;

    public function __construct()
    {
        $this->bdd = new Database();
        $this->bdd = $this->bdd->connect_bdd();
    }

    public function get_all_reponse($id_message, $r_id = null, $r_pseudo = null, $r_content = null, $r_date_at = null, $r_adresse_ip = null, $r_id_message = null)
    {
        $all_reponses = [];

        $sql = "SELECT * FROM reponse WHERE id_message = ?";
        $all_reponse = $this->bdd->prepare($sql);
        $all_reponse->bind_param("i", $id_message);

        $all_reponse->execute();
        $all_reponse->bind_result($id_message, $r_id, $r_pseudo, $r_content, $r_date_at, $r_adresse_ip,  $r_id_message);
        while ($all_reponse->fetch()) {
            $all_reponses[] = Reponse::construct_params($r_id, $r_pseudo, $r_content, $r_date_at, $r_adresse_ip, $r_id_message);
        }
        return $all_reponses;
    }
}

        // pre_var_dump($all_reponses, null, true);