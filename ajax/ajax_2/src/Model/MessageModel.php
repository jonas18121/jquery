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
    public function get_all_message($r_id = null, $r_title = null, $r_content = null, $r_date_at = null, $r_adresse_ip = null, $r_pseudo = null, $r_yes_like = null, $r_no_like = null)
    {
        $all_messages = [];

        $sql = "SELECT * FROM message";
        $all_message = $this->bdd->prepare($sql);
        $all_message->execute();
        $all_message->bind_result($r_id, $r_title, $r_content, $r_date_at, $r_adresse_ip, $r_pseudo, $r_yes_like, $r_no_like);

        while ($all_message->fetch()) {
            $all_messages[] = Message::construct_params($r_id, $r_title, $r_content, $r_date_at, $r_adresse_ip, $r_pseudo, $r_yes_like, $r_no_like);
        }

        return $all_messages;
    }

    /**
     * selectionner un message
     */
    public function get_one_message($id, $res_id = null, $res_title = null, $res_content = null, $res_date_at = null, $res_adresse_ip = null, $res_pseudo = null, $r_yes_like = null, $r_no_like = null)
    {
        $sql = "SELECT id, title, content, date_at, adresse_ip, pseudo, yes_like, no_like FROM message WHERE id = ?";
        $message = $this->bdd->prepare($sql);
        $message->bind_param("i", $id);
        $message->execute();
        $message->bind_result($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo, $r_yes_like, $r_no_like);
        $message->fetch();
        $one_message = Message::construct_params($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo, $r_yes_like, $r_no_like);  

        $message->close();

        return $one_message;
    }

    /**
     * selectionner le dernier message poster
     */
    public function get_last_message($res_id = null, $res_title = null, $res_content = null, $res_date_at = null, $res_adresse_ip = null, $res_pseudo = null, $r_yes_like = null, $r_no_like = null)
    {
        $sql = "SELECT * FROM message WHERE message.date_at ORDER BY message.date_at DESC LIMIT 1";
        $message = $this->bdd->prepare($sql);
        $message->execute();
        $message->bind_result($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo, $r_yes_like, $r_no_like);
        $message->fetch();
        $last_message = Message::construct_params($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo, $r_yes_like, $r_no_like);  

        $message->close();

        return $last_message;
    }

    /**
     * Ajouter un message
     */
    public function add_message($id, $title, $content, $adresse_ip, $pseudo)
    {
        $sql = "INSERT INTO message (id, title, content, adresse_ip, pseudo) VALUES (?, ?, ?, ?, ?)";
        $add_message = $this->bdd->prepare($sql);
        $add_message->bind_param('issss', $id, $title, $content, $adresse_ip, $pseudo);
        $add_message->execute();
    }

    public function like($id, $like)
    {
        //$like++;                 yes_like = yes_like + 1
        $sql = "UPDATE message SET yes_like = yes_like + {$like} WHERE message.id = ? ";
        $yes_like = $this->bdd->prepare($sql);
        $yes_like->bind_param('i', $id);
        $yes_like->execute();
    }

    public function no_like($id, $no_like)
    {
        $sql = "UPDATE message SET no_like = no_like + {$no_like} WHERE message.id = ? ";
        $yes_like = $this->bdd->prepare($sql);
        $yes_like->bind_param('i', $id);
        $yes_like->execute();
    }
}





