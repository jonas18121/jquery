<?php

class LikeDislikeModel
{
    public $bdd;

    public function __construct()
    {
        $this->bdd = new Database();
        $this->bdd = $this->bdd->connect_bdd();
    }

    /**
     * ajouter le lien entre le user et le like du message
     */
    public function add_bind_user_like($id, $adresse_ip, $id_message)
    {
        $sql = "INSERT INTO like_dislike (id, adresse_ip, id_message) VALUES (:id, :adresse_ip, :id_message)";
        $add_bind_user = $this->bdd->prepare($sql);
        $add_bind_user->setFetchMode(PDO::FETCH_CLASS, LikeDislike::class);
        $add_bind_user->execute([
            ':id' => $id, 
            ':adresse_ip' => $adresse_ip, 
            ':id_message' => $id_message
        ]);
    }

    /**
     * supprimer le lien entre le user et le like du message
     */
    public function delete_bind_user_like($id_like_user)
    {
        $sql = "DELETE FROM like_dislike WHERE id = :id ";
        $delete_bind_user = $this->bdd->prepare($sql);
        $delete_bind_user->setFetchMode(PDO::FETCH_CLASS, LikeDislike::class);
        $delete_bind_user->execute([':id' => $id_like_user]);
    }

    /**
     * selectionner le lien entre le user et le like du message
     */
    public function get_one_bind_user_like($adresse_ip, $id_message)
    {
        $sql = 
            "SELECT like_dislike.id, like_dislike.adresse_ip, like_dislike.id_message 
            FROM like_dislike, message 
            WHERE like_dislike.id_message = message.id AND like_dislike.adresse_ip = :adresse_ip AND message.id = :id " 
        ;

        $bind_user = $this->bdd->prepare($sql);
        $bind_user->setFetchMode(PDO::FETCH_CLASS, Message::class);
        $bind_user->execute(
            [
                ':id' => $id_message,
                ':adresse_ip' => $adresse_ip
            ]
        );
        $one_bind_user = $bind_user->fetch();


        return $one_bind_user;
    }
}