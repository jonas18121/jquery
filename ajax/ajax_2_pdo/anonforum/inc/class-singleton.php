<?php

//Singleton
class db_connect {
	public $host;
	public $login;
	public $pwd;
	public $db;
	public $connexion;
	private static $objet = NULL;
	
	function __construct($host, $login, $pwd, $db) {
		$this->host = $host;
		$this->login = $login;
		$this->pwd = $pwd;
		$this->db = $db;
		
		$this->connexion = new mysqli($host, $login, $pwd, $db);
	}
	
	public static function construit($host, $login, $pwd, $db) {
		if (isset(self::$objet)) {
			//La connexion existe déjà
			return self::$objet;
		} else {
			//Il n'y a pas de connexion à la BDD
			self::$objet = new db_connect($host, $login, $pwd, $db);
			return self::$objet;
		}
	}
}