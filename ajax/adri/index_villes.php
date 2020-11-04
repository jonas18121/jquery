<?php

$mysqli = new mysqli("localhost", "root", "", "villes");

if (!empty($_POST)) {
	$ville = "";
	$cp = "";
	$nom_colonne = "";
	$villes = array();
	
	//On récupère et assainit le mot envoyé par l'AJAX
	if (isset($_POST['recherche_ville'])) {
		$ville = trim(strip_tags($_POST['recherche_ville']));
		$nom_colonne = "nom";
	}
	if (isset($_POST['recherche_cp'])) {
		$cp = trim(strip_tags($_POST['recherche_cp']));
		$nom_colonne = "cp";
	}
	
	//On lance une requête LIKE vers la table de la base de donnée
	$requete = "SELECT nom, cp FROM ville WHERE $nom_colonne LIKE ? ORDER BY population DESC";

	$stmt = $mysqli->prepare($requete);
	$stmt->bind_param("s", $r_mot);
	
	if ($nom_colonne === "nom") {
		$r_mot = "%".$ville."%";
	}
	if ($nom_colonne === "cp") {
		$r_mot = "%".$cp."%";
	}
	$stmt->execute();
	
	$stmt->bind_result($r_nom, $r_cp);
	
	//On parcours les résultats et on les met dans un tableau
	while ($stmt->fetch()) {
		$villes[] = array("nom"=>$r_nom, "cp"=>$r_cp);
	}

	//On transforme le tableau en JSON avec json_encode
	echo json_encode($villes);
}