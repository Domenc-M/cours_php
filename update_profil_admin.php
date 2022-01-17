<?php 
require __DIR__ . '/header.php';
require __DIR__ . '/connect.php';

// on observe si l'url a une requete GET ou non
// si oui, on récupère sa valeur et on l'attribue à la variable $user_id
$user_id = isset($_GET['select_user_id']) && is_numeric($_GET['select_user_id']) ? intval($_GET['select_user_id']) : FALSE;
var_dump($user_id);
if(isset($_SESSION['role']) && $_SESSION['role'] == 'administrator') :
	if(!$user_id) :
		$req = $db->query("
			SELECT l.*, l.id AS lecteur_pk, u.*
			FROM lecteur l
			LEFT JOIN user u
			ON l.id = u.lecteur_id
			ORDER BY nom ASC
		");

		$results = $req->fetchAll(PDO::FETCH_OBJ); // renvoie les résultats dans un tableau formé d'objects
		// echo '<pre>';
		// var_dump($results);
		// echo '</pre>';
		?>
		<h1>Choisir un utilisateur</h1>
		<br>
		<form action="update_profil_admin.php" method="get"> <!-- formulaire pour choisir l'utilisateur -->
			<select name="select_user_id" id="select_user_id">
				<option value="none"></option>
				<?php foreach($results as $key => $value) : ?>
					<option value="<?php echo $value->lecteur_pk ?>"><?php echo $value->prenom . ' ' . $value->nom . ' | ' . $value->email ?></option>
				<?php endforeach; ?>
			</select>
			<button type="submit">Envoyer</button>
		</form>
	<?php
	else :
		$req = $db->prepare("
			SELECT l.*, l.id AS lecteur_pk, u.*
			FROM lecteur l
			LEFT JOIN user u
			ON l.id = u.lecteur_id
			WHERE l.id = :user_id
		");
		$req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		$req->execute();
		$details = $req->fetchObject(); // pas de boucle puisque un seul résultat est possible
		// le résultat sera sous forme d'object
		$current_email = $details->email === NULL ? 'none' : $details->email;
		?>
		<h1>Formulaire de mise à jour</h1>

		<form action="update_profil_admin_post.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<input type="hidden" name="current_email" value="<?php echo $current_email; ?>">

			<div>
				<label for="lastname">Nom</label>
				<input type="text" name="lastname" id="lastname" value="<?php echo $details->nom; ?>">
			</div>
			<div>
				<label for="firstname">Prénom</label>
				<input type="text" name="firstname" id="firstname" value="<?php echo $details->prenom; ?>">
			</div>
			<div>
				<label for="address">Adresse</label>
				<input type="text" name="address" id="address" value="<?php echo $details->adresse; ?>">
			</div>
			<div>
				<label for="zip_code">Code postal</label>
				<input type="text" name="zip_code" id="zip_code" value="<?php echo $details->code_postal ?>">
			</div>
			<div>
				<label for="born_date">Date de naissance</label>
				<input type="date" name="born_date" id="born_date" value="<?php echo $details->date_naissance ?>">
			</div>
			<div>
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="<?php echo $details->email; ?>">
			</div>
			<div>
				<label for="role">Rôle</label>
				<select type="text" name="role" id="role">
					<option value="">Pas de rôle</option>
					<?php $req = $db->query("
						SELECT *
						FROM role
						ORDER BY id
						ASC
					");
					while($role = $req->fetch(PDO::FETCH_OBJ)) :
					// while($role = $req->fetch(PDO::FETCH_ASSOC)) :
						var_dump('Role de la BDD : ' . $role->id);
						echo '<br>';
						var_dump('Role de l\'utilisateur : ' . $details->role_id);
						$selected = $details->role_id == $role->id ? 'selected' : '';
					?>
						<option value="<?php echo $role->id; ?>" <?php echo $selected; ?>><?php echo $role->titre; ?></option>
					<?php
					endwhile; ?>
				</select>
			</div>
			<button type="submit">Mettre à jour</button>
		</form>
		
	<?php	
	endif;
else : 
	header("Location: $host/index.php");
endif;
require __DIR__ . '/footer.php';