<?php

require_once 'config/Database.php';
require_once 'Fruit.php';
$bdd = new Database();
$bdd = $bdd->connect_bdd();

//Cas défaut
//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
//echo json_encode($arr);

function pairImpair($nombre)
{
    return ($nombre&1) ? "{$nombre} est impair " : "{$nombre} est pair ";
}
//var_dump('ok');die;

if ($_POST) {
    
    # nombre paire et impaire
    /* if (isset($_POST['nombre']) && ctype_digit($_POST['nombre'])) {
        $nombre  = $_POST['nombre'];
        $reponse = pairImpair($nombre);
        echo json_encode($reponse);
    }else {
        $reponse = "information incorecte";
        echo json_encode($reponse);
    } */
    
    
    # recherche fruit
    if (isset($_POST['recherche_fruit']) && !empty($_POST['recherche_fruit'])){

        $nom = $_POST['recherche_fruit'];
        $fruits = [];
        
        $sql = "SELECT nom FROM fruit WHERE nom LIKE ? ";

        $fruit = $bdd->prepare($sql);
        $fruit->bind_param("s", $r_nom);// prend en compte les ? dans la requete
        $r_nom = "%" . $nom . "%";
        $fruit->execute();
        $fruit->bind_result($r_nom);// prend en compte les éléments ecrit entre SELECT et FROM

        while ($fruit->fetch()) {
        
            $fruits[] = $r_nom ;
        }

        echo json_encode($fruits);
    }

    # recherche ville
    if (isset($_POST['recherche_ville']) && !empty($_POST['recherche_ville'])) {
        // var_dump($_POST);die;

        $nom_ville = $_POST['recherche_ville'];
        $villes = [];

        $sql = "SELECT nom, postal FROM ville WHERE nom LIKE ? ORDER BY population DESC ";

        $ville = $bdd->prepare($sql);
        $ville->bind_param("s", $r_nom);// prend en compte les ? dans la requete
        $r_nom = "%" . $nom_ville . "%";
        $ville->execute();
        $ville->bind_result($r_nom, $r_postal);// prend en compte les éléments ecrit entre SELECT et FROM

        while ($ville->fetch()) {
        
            $villes[] = ["nom" => $r_nom, "postal" => $r_postal]  ;
        }

        echo json_encode($villes);
    }
    elseif (isset($_POST['recherche_code_postal'])  && !empty($_POST['recherche_code_postal'])) {
        // var_dump($_GET);die;

        $code_postal = $_POST['recherche_code_postal'];
        $villes = [];

        $sql = "SELECT nom, postal FROM ville WHERE postal LIKE ? ORDER BY population DESC ";

        $ville = $bdd->prepare($sql);
        $ville->bind_param("s", $r_postal);// prend en compte les ? dans la requete
        $r_postal = "%" . $code_postal . "%";
        $ville->execute();
        $ville->bind_result($r_nom, $r_postal);// prend en compte les éléments ecrit entre SELECT et FROM

        while ($ville->fetch()) {
        
            $villes[] = ["nom" => $r_nom, "postal" => $r_postal]  ;
        }

        echo json_encode($villes);
    } 
}

