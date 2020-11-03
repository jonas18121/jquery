<?php

require_once 'config/Database.php';
require_once 'Fruit.php';
$bdd = new Database();
$bdd = $bdd->connect_bdd();

function pairImpair($nombre)
{
    return ($nombre&1) ? "{$nombre} est impair " : "{$nombre} est pair ";
}

if ($_POST) {
    
    # nombre paire et impaire
    /* if (isset($_POST['nombre']) && ctype_digit($_POST['nombre'])) {
        $nombre  = $_POST['nombre'];
        $reponse = pairImpair($nombre);
    }else {
        $reponse = "information incorecte";
    }
    echo json_encode($reponse); */
    
    # recherche fruit
    if (isset($_POST['recherche_fruit'])){

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
}

