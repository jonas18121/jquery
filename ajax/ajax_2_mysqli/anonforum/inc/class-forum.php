<?php

require_once "inc/class-singleton.php";
require_once "inc/class-message.php";

class Forum {
	public $messages;
	
	function __construct() {
		$this->messages = array();
	}
	
	public function getMessages() {
		$resultats = array();
		
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		//On charge le message
		$requete = "SELECT id FROM message WHERE idrepond IS NULL";
		$stmt = $db_connect->connexion->prepare($requete);
		$stmt->execute();
		$stmt->bind_result($res_id);
		while ($stmt->fetch()) {
			$resultats[] = $res_id;
		}
		$stmt->close();
		//Attention: comme on va refaire une requête dans la méthode load() de la classe Message, il faut fermer la requête en cours

		for ($i=0; $i<count($resultats); $i++) {
			$this->messages[] = Message::construct_load($resultats[$i]);
		}
	}
}