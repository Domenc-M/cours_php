<?php session_start(); ?>

<?php $host = 'http://localhost/cours_php'; ?>
<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cours PHP</title>
	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<!-- openGraph -->
	<meta property="og:title" content="Titre du site Internet"/>
	<meta property="og:description" content="Description dde la page cours PHP"/>
	<meta property="og:image" content="img/star-wars-eclipse.jpg" />
	<meta property="og:image:secure_url" content="img/star-wars-eclipse.jpg" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="627" />
	<meta property="og:image:alt" content="Nouveau jeu Star Wars" />
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<meta property="og:url" content="http://localhost/cours_php" />
	<!-- liens fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- lien css -->
	<link rel="stylesheet" href="<?php echo $host; ?>/css/style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="<?php echo $host; ?>/">Intro PHP, les variables</a></li>
				<li><a href="<?php echo $host; ?>/condition.php">Les conditions</a></li>
				<li><a href="<?php echo $host; ?>/loop.php">Les boucles</a></li>
				<li><a href="<?php echo $host; ?>/date.php">Les dates</a></li>
				<li><a href="<?php echo $host; ?>/regex.php">Les REGEX</a></li>
				<?php if(isset($_SESSION['id'])) : ?>
					<li><a href="<?php echo $host; ?>/bibliotheque.php">Accueil Bibliotheque</a></li>
					<div id="to_disconnect"><a href="<?php echo $host; ?>/disconnect.php">Se déconnecter</a></div>
					<div class="to_profil"><a href="<?php echo $host; ?>/profil.php">Profil</a></div class="to_profil">
				<?php else : ?>
					<div id="to_connect">
						<p>Se connecter</p>
						<div id="connect"><?php require 'login.php'; ?></div>
						<?php if(isset($_GET['msg'])) echo "<div class='red'>{$_GET['msg']}</div>"; ?>
					</div>
					<div id="to_subscribe">
						<a href="<?php echo $host . '/subscribe.php'; ?>">S'inscrire</a>
					</div>
				<?php endif; ?>
				<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'administrator') : ?>
					<div id="to_subscribe">
						<a href="<?php echo $host . '/subscribe.php'; ?>">inscrire un utilisateur</a>
					</div>
				<?php endif; ?>
			</ul>
		</nav>
	</header>
	<?php if(isset($_GET['msg'])) echo "<div class='green'>{$_GET['msg']}</div>"; ?>
	<main>