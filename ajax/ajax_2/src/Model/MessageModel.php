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

    /**
     * selectionner un message
     */
    public function get_one_message($id, $res_id = null, $res_title = null, $res_content = null, $res_date_at = null, $res_adresse_ip = null, $res_pseudo = null)
    {
        $sql = "SELECT id, title, content, date_at, adresse_ip, pseudo FROM message WHERE id = ?";
        $message = $this->bdd->prepare($sql);
        $message->bind_param("i", $id);
        $message->execute();
        $message->bind_result($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo);
        $message->fetch();
        $one_message = Message::construct_params($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo);  

        $message->close();

        return $one_message;
    }
}





