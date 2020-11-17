<?php

require_once "inc/class-message.php";
require_once "inc/class-likedislike.php";

if (!empty($_POST)) {
	$idmessage = intval($_POST['id']);
	$value = intval($_POST['value']);
	
	$likedislike = new LikeDislike();
	$likedislike->search($_SERVER['REMOTE_ADDR'], $idmessage);
	$likedislike->value = $value;
	$likedislike->save();
	
	$message = Message::construct_load($idmessage);
	
	$resultat = $message->countLikesDislikes();
	$resultat["idmessage"] = $idmessage;
	echo json_encode($resultat);
}