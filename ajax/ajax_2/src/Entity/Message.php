<?php

require_once 'Text.php';

class Message extends Text
{
    public $title;

    public function __construct(){}

    public static function construct_params($id, $title, $content, $date_at, $adresse_ip, $pseudo)
    {
        $message = new Message();

        $message->id            = $id;
        $message->title         = $title;
        $message->content       = $content;
        $message->date_at       = new DateTime($date_at);
        $message->adresse_ip    = $adresse_ip;
        $message->pseudo        = $pseudo;

        return $message;
    }

    /**
     * Get the value of title
     */ 
    public function get_title()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function set_title($title)
    {
        $this->title = $title;

        return $this;
    }
}