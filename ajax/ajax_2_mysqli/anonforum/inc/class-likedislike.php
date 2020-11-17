<?php

require_once "inc/class-singleton.php";

class LikeDislike {
	public $id;
	public $ipauteur;
	public $idmessage;
	public $value; //1 pour like, -1 pour dislike
	
	function __construct() {
		$this->id = 0;
		$this->ipauteur = "";
		$this->idmessage = NULL;
		$this->value = 0;
	}
	
	public static function construct_load($id) {
		$likedislike = new LikeDislike();
		$likedislike->load($id);
		return $likedislike;
	}
	
	public function save() {
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		if ($this->id) {
			//modification
			$requete = "UPDATE likedislike SET value=? WHERE id=?";
			$stmt = $db_connect->connexion->prepare($requete);
			$stmt->bind_param("ii", $r_value, $r_id);
			$r_value = $this->value;
			$r_id = $this->id;
		} else {
			//creation
			$requete = "INSERT INTO likedislike (value, ipauteur, idmessage) VALUES (?, ?, ?)";
			$stmt = $db_connect->connexion->prepare($requete);
			$stmt->bind_param("isi", $r_value, $r_ipauteur, $r_idmessage);
			$r_value = $this->value;
			$r_ipauteur = $this->ipauteur;
			$r_idmessage = $this->idmessage;
		}
		return $stmt->execute();
	}
	
	public function load($id) {
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		//On charge le message
		$requete = "SELECT value, ipauteur, idmessage FROM likedislike WHERE id=?";
		$stmt = $db_connect->connexion->prepare($requete);
		//Le prepare ne peut pas fonctionner si on est encore dans une boucle de parcours d'une requête ouverte
		$stmt->bind_param("i", $r_id);
		$r_id = $id;
		$stmt->execute();
		$stmt->bind_result($res_value, $res_ipauteur, $res_idmessage);
		$stmt->fetch();
		$this->id = $id;
		$this->value = $res_value;
		$this->ipauteur = $res_ipauteur;
		$this->idmessage = $res_idmessage;
		$stmt->close();
	}
	
	public function search($ipauteur, $idmessage) {
		$db_connect = db_connect::construit("localhost", "root", "", "anonforum");
		
		$requete = "SELECT id, value FROM likedislike WHERE ipauteur=? AND idmessage=?";
		$stmt = $db_connect->connexion->prepare($requete);
		$stmt->bind_param("si", $r_ipauteur, $r_idmessage);
		$r_ipauteur = $ipauteur;
		$r_idmessage = $idmessage;
		$stmt->execute();
		$stmt->bind_result($res_id, $res_value);
		$stmt->fetch();
		$this->id = $res_id;
		$this->value = $res_value;
		$this->ipauteur = $ipauteur;
		$this->idmessage = $idmessage;
		$stmt->close();
	}
}

















