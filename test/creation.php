<?php

// submit_contact.php
if (!isset($_POST['pass']))
{
	echo('Il faut renseigner le mot de passe');
	return;
}
else{
	if ($_POST['pass']!="delta=bb-4ac")
	{
		echo("Mot de passe incorect");
		return;
	}
}	


$mdp = $_POST['pass'];


?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Charger le fichier CSS pour mettre en forme ma page -->
		<link rel="stylesheet" href="style.css">
		<!-- Titre de l'onglet -->
		<title>BDE Enigma - Creation evenement</title>
	</head>
	<body>
		<form method="post" action="monevenement.php" enctype="multipart/form-data">
    		<p>
        		<label for="titre">Titre de l'evenement :</label>
       			<input type="text" name="titre" id="titre" /><br>
       			<label for="Quand">Dates et horaires</label>
       			<input type="date" name="date" id="date"/><input type="time" name="time" id="time"/><br>
       			<label for="lieu">Lieu :</label>
       			<input type="text" name="localisation" id="localisation" id="localisation"/><br>
       			<label for="prix">Prix :</label>
       			<input type="number" min="0" step="0.1" name="prix" id="prix"/><br>
       			<input type="file" name="image" id="image"><br>
       			<label for="resumer">Resumer de l'evenement</label>
       			<textarea name="resumer" id="resumer" rows="4" cols="75" maxlength="300">écrivez un bref resumer (max 300 caractere)</textarea><br>
       			<label for="intro">Introduction de l'evenement</label>
       			<textarea name="intro" id="intro" rows="10" cols="75"></textarea><br>
       			<label for="corps">Corps de l'evenement</label>
       			<textarea name="corps" id="corps" rows="10" cols="75"></textarea><br>
       			<label for="fin">Fin de l'evenement</label>
       			<textarea name="fin" id="fin" rows="10" cols="75"></textarea><br>
       			<input type="submit" value="visionner mon l'evenement" />
    		</p>
		</form>
	</body>
</html>
