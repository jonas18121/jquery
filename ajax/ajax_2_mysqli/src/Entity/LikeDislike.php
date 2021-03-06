<?php

class LikeDislike
{
    public $id;
    public $adresse_ip;
    public $id_message;

    public function __construct(){}

    public static function construct_params($id, $adresse_ip, $id_message)
    {
        $like_dislike = new LikeDislike();

        $like_dislike->id         = $id;
        $like_dislike->adresse_ip = $adresse_ip;
        $like_dislike->id_message = $id_message;

        return $like_dislike;
    }
    

    /**
     * Get the value of id
     */ 
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function set_id($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of adresse_ip
     */ 
    public function get_adresse_ip()
    {
        return $this->adresse_ip;
    }

    /**
     * Set the value of adresse_ip
     *
     * @return  self
     */ 
    public function set_adresse_ip($adresse_ip)
    {
        $this->adresse_ip = $adresse_ip;

        return $this;
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
