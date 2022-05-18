<?php 
	$titre = $_POST['titre'];
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
			<?php echo($titre); ?>
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
