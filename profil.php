<?php
require __DIR__ . '/connect.php';
require __DIR__ . '/header.php';
if(isset($_SESSION['id'])) :
	?>

	<nav class="profil_nav">
		<ul>
			<li><a href="<?php echo $host . '/update_profil.php' ?>">Mise à jour profil</a></li>
			<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'administrator') : ?>
				<li><a href="<?php echo $host . '/update_profil_admin.php' ?>">Mise à jour d'un utilisateur</a></li>
			<?php endif; ?>
			<li><a href="<?php echo $host . '/update_password.php' ?>">Mise à jour mot de passe</a></li>
			<li><a href="<?php echo $host . '/delete_profil.php' ?>">Supprimer mon compte</a></li>
		</ul>
	</nav>



	<?php 
else : 
	header("Location: $host/index.php");
endif;
require __DIR__ . '/footer.php';