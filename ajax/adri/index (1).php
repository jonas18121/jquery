<?php

/*if (!empty($_POST)) {
	$nombre = intval($_POST['nombre']);
	if ($nombre%2) {
		//cas TRUE = cas 1 = il y a un reste
		echo json_encode("impair");
	} else {
		//case FALSE = cas 0 = il n'y a pas de reste
		echo json_encode("pair");
	}
}*/

$mysqli = new mysqli("localhost", "root", "", "fruits");

if (!empty($_POST)) {
	//On récupère et assainit le mot envoyé par l'AJAX
	$mot = trim(strip_tags($_POST['recherche']));
	$fruits = array();
	
	//On lance une requête LIKE vers la table de la base de donnée
	$requete = "SELECT id, nom FROM fruit WHERE nom LIKE ?";
	$stmt = $mysqli->prepare($requete);
	$stmt->bind_param("s", $r_mot);
	$r_mot = "%".$mot."%";
	$stmt->execute();
	$stmt->bind_result($r_id, $r_nom);
	
	//On parcours les résultats et on les met dans un tableau
	while ($stmt->fetch()) {
		$fruits[] = array("id"=>$r_id, "nom"=>$r_nom);
	}

	//On transforme le tableau en JSON avec json_encode
	echo json_encode($fruits);
}

//Cas défaut
//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
//echo json_encode($arr);