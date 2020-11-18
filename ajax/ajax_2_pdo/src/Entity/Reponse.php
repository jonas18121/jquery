<?php

require_once 'Text.php';

class Reponse extends Text
{
    public $id_message;

    public function __construct(){}

    public static function construct_params($id, $pseudo, $content, $date_at, $adresse_ip, $id_message)
    {
        $reponse = new Reponse();
        
        $reponse->id            = $id;
        $reponse->pseudo        = $pseudo;
        $reponse->content       = $content;
        $reponse->date_at       = $date_at;
        $reponse->adresse_ip    = $adresse_ip;
        $reponse->id_message    = $id_message;

        return $reponse;
    }
    

    /**
     * Get the value of id_message
     */ 
    public function get_id_message()
    {
        return $this->id_message;
    }

    /**
     * Set the value of id_message
     *
     * @return  self
     */ 
    public function set_id_message($id_message)
    {
        $this->id_message = $id_message;

        return $this;
    }
}