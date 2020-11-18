<?php

abstract class Model
{
    protected $bdd;

    public function __construct()
    {
        $this->bdd = new Database();
        $this->bdd = $this->bdd->connect_bdd();
    }
}