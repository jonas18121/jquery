<?php

if (isset($_POST['nombre']) && ctype_digit($_POST['nombre'])) {
    $nombre  = $_POST['nombre'];
    $reponse = pairImpair($nombre);
    echo json_encode($reponse);
}

function pairImpair($nombre)
{
    return ($nombre&1) ? "{$nombre} est impair " : "{$nombre} est pair ";
}