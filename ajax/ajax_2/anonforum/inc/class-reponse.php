<?php

require_once "inc/class-message.php"

class Reponse extends Message {
	public $idmessage;
	
	function __construct() {
		$this->id = 0;
		$this->titre = "";
		$this->message = "";
		$this->dateheure = new DateTime();
		$this->ipauteur = "";
		$this->idmessage = 0;
	}
	
	public static function construct_load($id) {
		$reponse = new Reponse();
		$reponse->load($id);
		return $reponse;
	}
}