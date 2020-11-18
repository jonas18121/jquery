<?php

abstract class Text 
{
    public $id;
    public $content;
    public $date_at;
    public $adresse_ip;
    public $pseudo;

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
     * Get the value of content
     */ 
    public function get_content()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function set_content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of date_at
     */ 
    public function get_date_at()
    {
        return new \DateTime($this->date_at);
        // return $this->date_at;
    }

    /**
     * Set the value of date_at
     *
     * @return  self
     */ 
    public function set_date_at($date_at)
    {
        $this->date_at = $date_at;

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
     * Get the value of pseudo
     */ 
    public function get_pseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function set_pseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }
}