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
     * connexion user via son email
     */
    public function connexion($email, $password, $password_verif)
    {
        $user = $this->get_user_for_connexion($email);
        //pre_var_dump($user, null, true);

        if ($password === $password_verif) 
        {
            if(!password_verify($password, $user->get_password())){
                throw new PDOException('Le mot de passe est incorrect');
            } 
            else
            {
                session_start();
                $_SESSION['email']  = $user->get_email();
                $_SESSION['pseudo'] = $user->get_pseudo();
        
                if ($_SESSION['email'] != null) {
                    header_location('../../index.phtml');
                }
            }
        }
    }

    /**
     * selectionner le user pour la function connexion
     */
    public function get_user_for_connexion($email, $res_id = null, $res_pseudo = null, $res_email = null, $res_password = null)
    {
        $sql = "SELECT * From user WHERE email= ? ";
        $user = $this->bdd->prepare($sql);
        $user->bind_param('s', $email);
        $user->execute();
        $user->bind_result($res_id, $res_pseudo, $res_email, $res_password);
        $user->fetch();
        $one_user = User::construct_params($res_id, $res_pseudo, $res_email, $res_password);  

        $user->close();

        return $one_user;
    }

    /**
     * deconnexion user
     */
    public function deconnexion($ession_email)
    {  
        unset($ession_email);
        session_destroy();
        header_location('connexion_user.phtml');
    }

    /**
     * inscription user
     */
    public function inscription($pseudo, $email, $password, $id = null)
    {
        if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            
            // pre_var_dump($email, null, true);
            $sql = "INSERT INTO user (id, pseudo, email, password) VALUES (?, ?, ?, ?)";

            $user = $this->bdd->prepare($sql);
            $user->bind_param('isss', $id, $pseudo, $email, $passwordHashed);
            $user->execute();

            header_location('connexion_user.phtml');
        }
    }
}