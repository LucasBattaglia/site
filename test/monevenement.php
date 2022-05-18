<?php

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image']['size'] <= 1000000)
        {
                // Testons si l'extension est autorisée
                $fileInfo = pathinfo($_FILES['image']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = 'png';
                if (in_array($extension, $allowedExtensions))
                {
                    // On peut valider le fichier et le stocker définitivement
                    move_uploaded_file($_FILES['image']['tmp_name'], 'image/' . basename($_FILES['image']['name']));
                    echo("fichier bien recu")
                    // submit_contact.php
					if (!isset($_POST['titre']) || !isset($_POST['date']) || !isset($_POST['time']) || !isset($_POST['localisation']) || !isset($_POST['prix']) ||  !isset($_POST['resumer']) || !isset($_POST['resumer']) || !isset($_POST['intro']) || !isset($_POST['corps']) || !isset($_POST['fin'])){
							echo("Vous devais remplis tout les champs"."\n");
							return;
					}
                }
        }
}

// Tout les champs sont t'il remplis

if (!$_POST['titre']){
	echo("Vous n'avez pas donner de titre a votre evenement<br/>"."\n");
	return;
}
if (!$_POST['date']){
	echo("Vous n'avez pas donner la date votre evenement<br/>"."\n");
	return;
}
if (!$_POST['time']){
	echo("Vous n'avez pas donner l'horaire de votre evenement<br/>"."\n");
	return;
}
if (!$_POST['localisation']){
	echo("Vous n'avez pas donner la localisation de votre evenement<br/>"."\n");
	return;
}
if (!$_POST['prix']){
	echo("Vous n'avez pas donner le prix de votre evenement<br/>"."\n");
	return;
}
if (!$_POST['image']){
	echo("Vous n'avez pas donner d'image a votre evenement<br/>"."\n");
	return;
}
if (!$_POST['resumer']=="écrivez un bref resumer (max 300 caractere)" || !$_POST['resumer']){
	echo("Vous n'avez pas donner de resumer a votre evenement<br/>"."\n");
	return;
}
if (!$_POST['intro']){
	echo("Vous n'avez pas donner d'introduction a votre evenement<br/>"."\n");
	return;
}
if (!$_POST['corps']){
	echo("Vous n'avez pas donner de corps a votre evenement<br/>"."\n");
	return;
}
if (!$_POST['fin']){
	echo("Vous n'avez pas donner de fin a votre evenement<br/>"."\n");
	return;
}


// recuperation des variable
$titre = $_POST['titre'];
$date = $_POST['date'];
$time = $_POST['time'];
$lieu = $_POST['localisation'];
$prix = $_POST['prix'];
$image = $_POST['image'];
$resumer = $_POST['resumer'];
$intro = $_POST['intro'];
$corps = $_POST['corps'];
$fin = $_POST['fin'];

?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Charger le fichier CSS pour mettre en forme ma page -->
		<link rel="stylesheet" href="style.css">
		<!-- Titre de l'onglet -->
		<title>BDE Enigma - Les evenements</title>
	</head>
	<body>

		<header>
			<p><a href="index.html">Revenir au menu d'accueil</a></p>
			<h1><img src="image/logopng.png" alt="Logo du BDE Enigma">
			<figcaption>Les evenement du BDE Enigma</figcaption></h1>
		</header>

		<section>
			<div class="evenement">
				<div class="event">
					<div>
						<a href="pageevenement.php">
							<img src="image/<?php $image; ?>" alt="<?php echo($image); ?>">
							<h3>
								<?php echo($titre); ?>
							</h3>
						</a>
						<p>
							<?php echo($intro); ?>
						</p>
					</div>
				</div>	
			</div>
		</section>
		
		<footer class="conteneur">
			<div class="element">
				<a href="https://www.uca.fr/" title="UCA" target="_blank"><img src="image/logo_UCA_Long.png" alt="Logo UCA"></a>
			</div>
			<div class="element">
				<img src="image/logopng_mini.png">
				<br>BDE Enigma<br>
				Maison des etudiants<br>
				7 Place Vasarely<br>
				63170 AUBIERE
			</div>
			<div class="element">
				<a href="https://www.facebook.com/bdeenigma" title="Facebook BDE Enigma" target="_blank"><img src="image/facebook.png" alt="Logo Facebook"></a>
				<a href="https://www.instagram.com/bdeenigma/" title="Instagram BDE Enigma" target="_blank"><img src="image/insta.png" alt="Logo instagram"></a>
				<a href="mailto:bde.enigma@gmail.com" title="adresse mail du BDE" target="_blank"><img src="image/mail.png" alt="Logo mail"></a>
				<a href="https://twitter.com/BDE_ENIGMA" title="Twitter BDE Enigma" target="_blank"><img src="image/Twitter.png" alt="Logo Twitter"></a>
			</div>

			<p class="element">© BDE Enigma de Clermont Ferrand. Tous droits réservés.</p>
		<footer>

	</body>
</html>
