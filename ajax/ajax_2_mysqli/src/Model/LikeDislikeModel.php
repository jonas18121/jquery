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
        $sql = "INSERT INTO like_dislike (id, adresse_ip, id_message) VALUES (?, ?, ?)";
        $add_bind_user = $this->bdd->prepare($sql);
        $add_bind_user->bind_param('isi', $id, $adresse_ip, $id_message);
        $add_bind_user->execute();
    }

    /**
     * supprimer le lien entre le user et le like du message
     */
    public function delete_bind_user_like($id_like_user)
    {
        //pre_var_dump($id_like_user, 'L 26, UserModel.php', true);
        $sql = "DELETE FROM like_dislike WHERE id = ? ";
        $delete_bind_user = $this->bdd->prepare($sql);
        $delete_bind_user->bind_param('i', $id_like_user);
        $delete_bind_user->execute();
    }

    /**
     * selectionner le lien entre le user et le like du message
     */
    public function get_one_bind_user_like($adresse_ip, $id_message, $res_id = null, $res_adresse_ip = null, $res_id_message = null)
    {
        // $sql = "SELECT user.id, user.adresse_ip, user.id_message FROM user WHERE user.id = ?";
        $sql = 
            "SELECT like_dislike.id, like_dislike.adresse_ip, like_dislike.id_message 
            FROM like_dislike, message 
            WHERE like_dislike.id_message = message.id AND like_dislike.adresse_ip = ? AND message.id = ?" 
        ;
        $bind_user = $this->bdd->prepare($sql);
        $bind_user->bind_param("si", $adresse_ip, $id_message);
        $bind_user->execute();
        $bind_user->bind_result($res_id, $res_adresse_ip, $res_id_message);
        $bind_user->fetch();
        $one_bind_user = LikeDislike::construct_params($res_id, $res_adresse_ip, $res_id_message);  

        $bind_user->close();

        return $one_bind_user;
    }
}