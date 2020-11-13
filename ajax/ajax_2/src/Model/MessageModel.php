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

    /**
     * ajouter like
     */
    public function like($id, $like)
    {
        //$like++;                 yes_like = yes_like + 1
        $sql = "UPDATE message SET yes_like = yes_like + {$like} WHERE message.id = ? ";
        $yes_like = $this->bdd->prepare($sql);
        $yes_like->bind_param('i', $id);
        $yes_like->execute();
    }

    /**
     * annuler like
     */
    public function cancel_like($id, $like)
    {
        $sql = "UPDATE message SET yes_like = yes_like - {$like} WHERE message.id = ?";
        $cancel_like = $this->bdd->prepare($sql);
        $cancel_like->bind_param('i', $id);
        $cancel_like->execute();
    }

    /**
     * ajouter dislike
     */
    public function no_like($id, $no_like)
    {
        $sql = "UPDATE message SET no_like = no_like + {$no_like} WHERE message.id = ? ";
        $yes_like = $this->bdd->prepare($sql);
        $yes_like->bind_param('i', $id);
        $yes_like->execute();
    }

    /**
     * annuler dislike
     */
    public function cancel_no_like($id, $no_like)
    {
        $sql = "UPDATE message SET no_like = no_like - {$no_like} WHERE message.id = ? ";
        $yes_like = $this->bdd->prepare($sql);
        $yes_like->bind_param('i', $id);
        $yes_like->execute();
    }

    /**
     * rechercher les likes par rapport à l'adreese ip et à l'idée du message
     */
    public function search_like(
        $r_adresse_ip, 
        $r_id_message, 
        $res_id = null, 
        $res_title = null, 
        $res_content = null, 
        $res_date_at = null, 
        $res_adresse_ip = null, 
        $res_pseudo = null, 
        $r_yes_like = 0, 
        $r_no_like = 0, 
        $r_user_id = null, 
        $r_user_adresse_ip = null, 
        $r_user_id_message = null
    )
    {
        // $sql = "SELECT yes_like, no_like FROM message WHERE adresse_ip = ? AND id= ?";
        //$sql = "SELECT * FROM message WHERE adresse_ip = ? AND id= ?";
        $sql = "SELECT * FROM message, user WHERE user.adresse_ip = ? AND message.id= ? AND user.id_message = message.id";
        $search = $this->bdd->prepare($sql);
        $search->bind_param('si', $r_adresse_ip, $r_id_message);
        $search->execute();
        $search->bind_result($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo, $r_yes_like, $r_no_like, $r_user_id, $r_user_adresse_ip, $r_user_id_message);
        $search->fetch();
        $search_like = Message::construct_params($res_id, $res_title, $res_content, $res_date_at, $res_adresse_ip, $res_pseudo, $r_yes_like, $r_no_like);
        
        $search->close();

        //pre_var_dump($search_like->get_id(), 'L 126, messageModel.php',true);
        if ($search_like->get_id() !== null) {
            return [true, $search_like];
        }
        else {
            return [false, $search_like];
        }

        //return $search_like;
    }

    



    /**
     * ajouter le lien entre le user
     */
    public function add_bind_user_like($id, $adresse_ip, $id_message)
    {
        $sql = "INSERT INTO user (id, adresse_ip, id_message) VALUES (?, ?, ?)";
        $add_user = $this->bdd->prepare($sql);
        $add_user->bind_param('isi', $id, $adresse_ip, $id_message);
        $add_user->execute();
    }

    /**
     * supprimer le lien entre le user et le like du message
     */
    public function delete_bind_user_like($id_like_user)
    {
        $sql = "DELETE FROM user WHERE id = ? ";
        $delete_user = $this->bdd->prepare($sql);
        $delete_user->bind_param('i', $id_like_user);
        $delete_user->execute();
    }

    /**
     * selectionner le lien entre le user et le like du message
     */
    public function get_one_bind_user_like($adresse_ip, $id_message, $res_id = null, $res_adresse_ip = null, $res_id_message = null)
    {
        // $sql = "SELECT user.id, user.adresse_ip, user.id_message FROM user WHERE user.id = ?";
        $sql = 
            "SELECT user.id, user.adresse_ip, user.id_message 
            FROM user, message 
            WHERE user.id_message = message.id AND user.adresse_ip = ? AND message.id = ?" 
        ;
        $message = $this->bdd->prepare($sql);
        $message->bind_param("i", $adresse_ip, $id_message);
        $message->execute();
        $message->bind_result($res_id, $res_adresse_ip, $res_id_message);
        $message->fetch();
        $one_message = User::construct_params($res_id, $res_adresse_ip, $res_id_message);  

        $message->close();

        return $one_message;
    }
}





