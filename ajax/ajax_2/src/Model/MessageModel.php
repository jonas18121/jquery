<?php

class MessageModel
{
    public $bdd;

    public function __construct()
    {
        $this->bdd = new Database();
        $this->bdd = $this->bdd->connect_bdd();
    }
    
    /**
     * selectionner tous les messages
     */
    public function get_all_message($r_id = null, $r_title = null, $r_content = null, $r_date_at = null, $r_adresse_ip = null, $r_pseudo = null)
    {
        $all_messages = [];

        $sql = "SELECT * FROM message";
        $all_message = $this->bdd->prepare($sql);
        $all_message->execute();
        $all_message->bind_result($r_id, $r_title, $r_content, $r_date_at, $r_adresse_ip, $r_pseudo);

        while ($all_message->fetch()) {
            $all_messages[] = Message::construct_params($r_id, $r_title, $r_content, $r_date_at, $r_adresse_ip, $r_pseudo);
        }

        return $all_messages;
    }


}





