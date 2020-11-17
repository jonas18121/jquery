<?php

require_once "inc/class-forum.php";

//Traitement du POST

if (!empty($_POST)) {
	$message = new Message();
	$message->titre = $_POST['titre'];
	$message->message = $_POST['message'];
	$message->ipauteur = $_SERVER['REMOTE_ADDR'];
	$message->save();
}

//Recupération des données
$forum = new Forum();
$forum->getMessages();

//Rendu
?>
<html>
<head>
	<script src="lib/jquery-3.4.1.min.js"></script>
	<script>
$(function(){
	//Ne s'exécute que lorsque la page est complètement chargée
	//Equivalent à document.ready
	$(".likedislike").click(function(){
		let id = $(this).data("id");
		let value = $(this).data("value");
		
		$.ajax({
			url: "likedislike.php",
			data: {
				id: id,
				value: value
			},
			method: "POST",
			dataType: "JSON"
		}).done(function(reponse){
			//On parcours la réponse en JSON
			console.log(reponse);
			$("#like-"+reponse.idmessage).html(reponse.likes);
			$("#dislike-"+reponse.idmessage).html(reponse.dislikes);
		});
	});
});
	</script>
</head>
<body>
<form method="POST">
	<input type="text" name="titre" />
	<textarea name="message"></textarea>
	<input type="submit" />
</form>
<?php
for ($i=0; $i<count($forum->messages); $i++) {
	$likes_dislikes = $forum->messages[$i]->countLikesDislikes();
?>
	<div>
		<h2><a href="message.php?id=<?= $forum->messages[$i]->id ?>"><?= $forum->messages[$i]->titre ?></a></h2>
		<p><?= nl2br($forum->messages[$i]->message) ?></p>
		<span class="likedislike" data-value="1" data-id="<?= $forum->messages[$i]->id ?>">Likes : <span id="like-<?= $forum->messages[$i]->id ?>"><?= $likes_dislikes["likes"] ?></span></span>
		<span class="likedislike" data-value="-1" data-id="<?= $forum->messages[$i]->id ?>">Dislikes : <span id="dislike-<?= $forum->messages[$i]->id ?>"><?= $likes_dislikes["dislikes"] ?></span></span>
	</div>
	<?php
	for ($j=0; $j<count($forum->messages[$i]->reponses); $j++) {
	?>
	<div>
		<h3><?= $forum->messages[$i]->reponses[$j]->titre ?></h3>
		<p><?= nl2br($forum->messages[$i]->reponses[$j]->message) ?></p>
	</div>
	<?php
	}
	?>
<?php
}
?>
</body>
</html>