<?php

require_once 'Model.php';

class UserModel extends Model
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
    public function get_user_for_connexion($email)
    {
        $sql = "SELECT * From user WHERE email= :email ";
        $user = $this->bdd->prepare($sql);
        $user->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user->execute([':email' => $email]);
        $one_user = $user->fetch();

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
            
            $sql = "INSERT INTO user (id, pseudo, email, password) VALUES (:id, :pseudo, :email, :password)";

            $user = $this->bdd->prepare($sql);
            $user->setFetchMode(PDO::FETCH_CLASS, User::class);
            $user->execute(
                [
                    ':id'       => $id, 
                    ':pseudo'   => $pseudo, 
                    ':email'    => $email, 
                    ':password' => $passwordHashed
                ]
            );

            header_location('connexion_user.phtml');
        }
    }
}