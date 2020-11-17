<?php

require_once "inc/class-singleton.php";
require_once "inc/class-likedislike.php";

class Message {
	public $id;
	public $titre;
	public $message;
	public $dateheure;
	public $ipauteur;
	public $reponses;
	public $likedislike;
	public $idrepond;
	
	function __construct() {
		$this->id = 0;
		$this->titre = "";
		$this->message = "";
		$this->dateheure = new DateTime();
		$this->ipauteur = "";
		$this->reponses = array();
		$this->likedislike = array();
		$this->idrepond = NULL;
	}
	
	public static function construct_load($id) {
		$message = new Message();
		$message->load($id);
		return $message;
	}
	
	public function save() {
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		if ($this->id) {
			//modification
			$requete = "UPDATE message SET titre=?, message=?, dateheure=? WHERE id=?";
			$stmt = $db_connect->connexion->prepare($requete);
			$stmt->bind_param("sssi", $r_titre, $r_message, $r_dateheure, $r_id);
			$r_titre = $this->titre;
			$r_message = $this->message;
			$r_dateheure = $this->dateheure->format("Y-m-d H:i:s");
			$r_id = $this->id;
		} else {
			//creation
			$requete = "INSERT INTO message (titre, message, ipauteur, idrepond) VALUES (?, ?, ?, ?)";
			$stmt = $db_connect->connexion->prepare($requete);
			$stmt->bind_param("sssi", $r_titre, $r_message, $r_ipauteur, $r_idrepond);
			$r_titre = $this->titre;
			$r_message = $this->message;
			$r_ipauteur = $this->ipauteur;
			$r_idrepond = $this->idrepond;
		}
		return $stmt->execute();
	}
	
	public function load($id) {
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		//On charge le message
		$requete = "SELECT titre, message, dateheure, ipauteur, idrepond FROM message WHERE id=?";
		$stmt = $db_connect->connexion->prepare($requete);
		//Le prepare ne peut pas fonctionner si on est encore dans une boucle de parcours d'une requête ouverte
		$stmt->bind_param("i", $r_id);
		$r_id = $id;
		$stmt->execute();
		$stmt->bind_result($res_titre, $res_message, $res_dateheure, $res_ipauteur, $res_idrepond);
		$stmt->fetch();
		$this->id = $id;
		$this->titre = $res_titre;
		$this->message = $res_message;
		$this->dateheure = new DateTime($res_dateheure);
		$this->ipauteur = $res_ipauteur;
		$this->idrepond = $res_idrepond;
		$stmt->close();
		
		//On charge les réponses du message
		$this->getReponses();
		$this->getLikesDislikes();
	}
	
	public function getReponses() {
		$resultats = array();
		
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		$requete = "SELECT id FROM message WHERE idrepond=?";
		$stmt = $db_connect->connexion->prepare($requete);
		$stmt->bind_param("i", $r_idrepond);
		$r_idrepond = $this->id;
		$stmt->execute();
		$stmt->bind_result($res_id);
		while ($stmt->fetch()) {
			$resultats[] = $res_id;
		}
		$stmt->close();
		//Attention: comme on va refaire une requête dans la méthode load() de la classe Message, il faut fermer la requête en cours
		
		for ($i=0; $i<count($resultats); $i++) {
			$this->reponses[] = self::construct_load($resultats[$i]);
		}
	}
	
	public function getLikesDislikes() {
		$resultats = array();
		
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		$requete = "SELECT id FROM likedislike WHERE idmessage=?";
		$stmt = $db_connect->connexion->prepare($requete);
		$stmt->bind_param("i", $r_idmessage);
		$r_idmessage = $this->id;
		$stmt->execute();
		$stmt->bind_result($res_id);
		while ($stmt->fetch()) {
			$resultats[] = $res_id;
		}
		$stmt->close();
		//Attention: comme on va refaire une requête dans la méthode load() de la classe Message, il faut fermer la requête en cours
		
		for ($i=0; $i<count($resultats); $i++) {
			$this->likedislike[] = LikeDislike::construct_load($resultats[$i]);
		}
	}
	
	public function countLikesDislikes() {
		$likes = 0;
		$dislikes = 0;
		
		for ($i=0; $i<count($this->likedislike); $i++) {
			if ($this->likedislike[$i]->value == 1) {
				$likes++;
			} else {
				$dislikes++;
			}
		}
		
		return array("likes"=>$likes, "dislikes"=>$dislikes);
	}
}















