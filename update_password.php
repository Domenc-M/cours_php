<?php
require __DIR__ . '/connect.php';
require __DIR__ . '/header.php';
// var_dump(password_hash('abracadabra', PASSWORD_DEFAULT));
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : FALSE;
if($user_id) : ?>
	<h1>Formulaire de mise à jour mot de passe</h1>

		<form action="update_password_post.php" method="POST">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<div>
				<label for="password">Mot de passe</label>
				<input type="password" name="password" id="password">
			</div>
			<div>
				<label for="password2">Répéter le mot de passe</label>
				<input type="password" name="password2" id="password2">
			</div>
			
			<button type="submit">Mettre à jour le mot de passe</button>
		</form>
	<?php 
else : 
	header("Location: $host/index.php");
endif;
require __DIR__ . '/footer.php';