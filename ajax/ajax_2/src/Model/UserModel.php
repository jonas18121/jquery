<?php

class UserModel
{
    public $bdd;

    public function __construct()
    {
        $this->bdd = new Database();
        $this->bdd = $this->bdd->connect_bdd();
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
        //pre_var_dump($id_like_user, 'L 26, UserModel.php', true);
        $sql = "DELETE FROM user WHERE id = ? ";
        $delete_user = $this->bdd->prepare($sql);
        $delete_user->bind_param('i', $id_like_user);
        $delete_user->execute();

        //"DELETE FROM user, message WHERE user.id_message = message.id AND user.adresse_ip = ? AND message.id = ? "
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
        $user = $this->bdd->prepare($sql);
        $user->bind_param("si", $adresse_ip, $id_message);
        $user->execute();
        $user->bind_result($res_id, $res_adresse_ip, $res_id_message);
        $user->fetch();
        $one_user = User::construct_params($res_id, $res_adresse_ip, $res_id_message);  

        $user->close();

        return $one_user;
    }
}