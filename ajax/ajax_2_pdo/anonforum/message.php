<?php

require_once "inc/class-message.php";

//Traitement du POST

if (!empty($_POST)) {
	$reponse = new Message();
	$reponse->titre = $_POST['titre'];
	$reponse->message = $_POST['message'];
	$reponse->ipauteur = $_SERVER['REMOTE_ADDR'];
	$reponse->idrepond = $_POST['idrepond'];
	$reponse->save();
}

//Recupération des données
if (isset($_GET['id'])) {
	$message = Message::construct_load($_GET['id']);
}


//Rendu
?>
<html>
<head></head>
<body>
	<div>
		<h2><?= $message->titre ?></h2>
		<p><?= nl2br($message->message) ?></p>
	</div>
	<?php
	for ($j=0; $j<count($message->reponses); $j++) {
	?>
	<div>
		<h3><?= $message->reponses[$j]->titre ?></h3>
		<p><?= nl2br($message->reponses[$j]->message) ?></p>
	</div>
	<?php
	}
	?>
<form method="POST">
	<input type="text" name="titre" />
	<textarea name="message"></textarea>
	<input type="hidden" name="idrepond" value="<?= $message->id ?>" />
	<input type="submit" />
</form>
</body>
</html>