<?php

require_once 'Text.php';

class Message extends Text
{
    public $title;
    public $yes_like;
    public $no_like;

    public function __construct(){}

    public static function construct_params($id, $title, $content, $date_at, $adresse_ip, $pseudo, $yes_like, $no_like)
    {
        $message = new Message();

        $message->id         = $id;
        $message->title      = $title;
        $message->content    = $content;
        $message->date_at    = new DateTime($date_at);
        $message->adresse_ip = $adresse_ip;
        $message->pseudo     = $pseudo;
        $message->yes_like   = $yes_like;
        $message->no_like    = $no_like;

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

    /**
     * Get the value of yes_like
     */ 
    public function get_yes_like()
    {
        return $this->yes_like;
    }

    /**
     * Set the value of yes_like
     *
     * @return  self
     */ 
    public function set_yes_like($yes_like)
    {
        $this->yes_like = $yes_like;

        return $this;
    }

    /**
     * Get the value of no_like
     */ 
    public function get_no_like()
    {
        return $this->no_like;
    }

    /**
     * Set the value of no_like
     *
     * @return  self
     */ 
    public function set_no_like($no_like)
    {
        $this->no_like = $no_like;

        return $this;
    }
}