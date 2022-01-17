<?php 
require __DIR__ . '/header.php';
require __DIR__ . '/connect.php';
 ?>

<h1>Formulaire d'inscription</h1>

<form action="subscribe_post.php" method="POST">
	<div>
		<label for="lastname">Nom</label>
		<input type="text" name="lastname" id="lastname">
	</div>
	<div>
		<label for="firstname">Prénom</label>
		<input type="text" name="firstname" id="firstname">
	</div>
	<div>
		<label for="address">Adresse</label>
		<input type="text" name="address" id="address">
	</div>
	<div>
		<label for="zip_code">Code postal</label>
		<input type="text" name="zip_code" id="zip_code">
	</div>
	<div>
		<label for="born_date">Date de naissance</label>
		<input type="date" name="born_date" id="born_date">
	</div>
	<div>
		<label for="email">Email</label>
		<input type="text" name="email" id="email">
	</div>
	<div>
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password">
	</div>
	<div>
		<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'administrator') : ?>
			<label for="role">Rôle</label>
			<select type="text" name="role" id="role">
				<?php $req = $db->query("
					SELECT *
					FROM role
					ORDER BY id
					DESC
				");
				while($role = $req->fetch(PDO::FETCH_OBJ)) :
				// while($role = $req->fetch(PDO::FETCH_ASSOC)) :
				?>
					<option value="<?php echo $role->id; ?>"><?php echo $role->titre; ?></option>
				<?php
				endwhile; ?>
			</select>
		<?php endif; ?>
	</div>
	<button type="submit">Envoyer</button>
</form>

<?php
require __DIR__ . '/footer.php';