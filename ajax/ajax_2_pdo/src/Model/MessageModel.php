<?php

require_once 'Model.php';

class MessageModel extends Model
{
    
    /**
     * selectionner tous les messages
     */
    public function get_all_message()
    {
        $all_messages = [];

        $sql = "SELECT * FROM message";
        $all_message = $this->bdd->prepare($sql);
        $all_message->execute();

        $table_all_message = $all_message->fetchALL();

        for ($i=0; $i < count($table_all_message); $i++) { 

            $all_messages[] = Message::construct_params(

                $table_all_message[$i]['id'], 
                $table_all_message[$i]['title'], 
                $table_all_message[$i]['content'], 
                $table_all_message[$i]['date_at'], 
                $table_all_message[$i]['adresse_ip'], 
                $table_all_message[$i]['pseudo'], 
                $table_all_message[$i]['yes_like'], 
                $table_all_message[$i]['no_like']

            );
        }

        return $all_messages;
    }

    /**
     * selectionner un message
     * 
     * on peut utiliser $message->execute([':id' => $id]); à la place de $message->bindParam(':id', $id, PDO::PARAM_INT);
     * 
     * avec $message->setFetchMode(PDO::FETCH_CLASS, Message::class ); il n'y a plus besoin d'utiliser Message::construct_params()
     */
    public function get_one_message($id)
    {
        $sql = "SELECT id, title, content, date_at, adresse_ip, pseudo, yes_like, no_like FROM message WHERE message.id = :id";
        $message = $this->bdd->prepare($sql);
        $message->bindParam(':id', $id, PDO::PARAM_INT);
        $message->execute();
        $message->setFetchMode(PDO::FETCH_CLASS, Message::class);
        $resultat = $message->fetch();  
        
        return $resultat;
    }

    /**
     * selectionner le dernier message poster
     */
    public function get_last_message()
    {
        $sql = "SELECT * FROM message WHERE message.date_at ORDER BY message.date_at DESC LIMIT 1";
        $message = $this->bdd->prepare($sql);
        $message->execute();
        $resultat = $message->fetch();
        $last_message = Message::construct_params($resultat['id'], $resultat['title'], $resultat['content'], $resultat['date_at'], $resultat['adresse_ip'], $resultat['pseudo'], $resultat['yes_like'], $resultat['no_like']);  

        return $last_message;
    }

    /**
     * Ajouter un message
     */
    public function add_message($id, $title, $content, $adresse_ip, $pseudo)
    {
        $sql = "INSERT INTO message (id, title, content, adresse_ip, pseudo) VALUES (:id, :title, :content, :adresse_ip, :pseudo)";
        $add_message = $this->bdd->prepare($sql);

        $add_message->bindParam(':id',          $id,            PDO::PARAM_INT);
        $add_message->bindParam(':title',       $title,         PDO::PARAM_STR);
        $add_message->bindParam(':content',     $content,       PDO::PARAM_STR);
        $add_message->bindParam(':adresse_ip',  $adresse_ip,    PDO::PARAM_STR);
        $add_message->bindParam(':pseudo',      $pseudo,        PDO::PARAM_STR);

        $add_message->execute();
    }

    /**
     * ajouter like
     */
    public function like($id, $like)
    {
        //$like++;                 yes_like = yes_like + 1
        $sql = "UPDATE message SET yes_like = yes_like + :yes_like WHERE message.id = :id ";
        $yes_like = $this->bdd->prepare($sql);
        $yes_like->setFetchMode(PDO::FETCH_CLASS, Message::class);
        $yes_like->execute([
            ':id'       => $id,
            ':yes_like' => $like
        ]);
    }

    /**
     * annuler like
     */
    public function cancel_like($id, $like)
    {
        $sql = "UPDATE message SET yes_like = yes_like - :yes_like WHERE message.id = :id ";
        $cancel_like = $this->bdd->prepare($sql);
        $cancel_like->setFetchMode(PDO::FETCH_CLASS, Message::class);
        $cancel_like->execute(
            [
                ':id'       => $id,
                ':yes_like' => $like
            ]
        );
    }

    /**
     * ajouter dislike
     */
    public function no_like($id, $like)
    {
        //$like++;                 yes_like = yes_like + 1
        $sql = "UPDATE message SET no_like = no_like + :no_like WHERE message.id = :id ";
        $no_like = $this->bdd->prepare($sql);
        $no_like->setFetchMode(PDO::FETCH_CLASS, Message::class);
        $no_like->execute([
            ':id'       => $id,
            ':no_like' => $like
        ]);
    }

    /**
     * annuler dislike
     */
    public function cancel_no_like($id, $like)
    {
        $sql = "UPDATE message SET no_like = no_like - :no_like WHERE message.id = :id ";
        $cancel_like = $this->bdd->prepare($sql);
        $cancel_like->setFetchMode(PDO::FETCH_CLASS, Message::class);
        $cancel_like->execute(
            [
                ':id'       => $id,
                ':no_like' => $like
            ]
        );
    }

    /**
     * rechercher les likes par rapport à l'adreese ip et à l'idée du message
     */
    public function search_like($adresse_ip, $id_message)
    {
        $sql = "SELECT * FROM message, like_dislike 
            WHERE like_dislike.adresse_ip = :adresse_ip AND message.id = :id AND like_dislike.id_message = message.id";

        $search = $this->bdd->prepare($sql);
        $search->setFetchMode(PDO::FETCH_CLASS, Message::class);

        $search->execute(
            [
                ':adresse_ip' => $adresse_ip,
                ':id' => $id_message
            ]
        );
        $result_search = $search->fetch();

        if ($result_search) 
        {
            return [true, $result_search];
        }
        else{
            return [false, $result_search];
        }
    }
}





