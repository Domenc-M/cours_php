<?php
require __DIR__ . '/connect.php';
require __DIR__ . '/header.php';

$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : FALSE;
if($user_id) :
	$req = $db->prepare("
		SELECT l.*, u.email
		FROM lecteur AS l
		INNER JOIN user AS u
		ON l.id = u.lecteur_id
		WHERE l.id = :user_id
	");
	$req->bindValue(':user_id', intval($user_id), PDO::PARAM_INT);
	$req->execute();
	$details = $req->fetchObject();

	// fetch ==> récupère 1 résultat sous forme de tableau
	// fetchObject ==> récupère 1 résultat sous forme d'objet
	// fetchAll ==> récupère tous les résultats | PDO::FETCH_ASSOC ==> sous forme de tableau | PDO::FETCH_OBJ ==> sous forme d'objet
?>

	<h1>Formulaire de mise à jour profil</h1>

	<form action="update_profil_post.php" method="POST">
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
			<input type="text" name="zip_code" id="zip_code" value="<?php echo $details->code_postal; ?>">
		</div>
		<div>
			<label for="born_date">Date de naissance</label>
			<input type="date" name="born_date" id="born_date" value="<?php echo $details->date_naissance; ?>">
		</div>
		<div>
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="<?php echo $details->email; ?>">
		</div>
		
		<button type="submit">Mettre à jour le profil</button>
	</form>
<?php
else : 
	header("Location: $host/index.php");
endif;

require __DIR__ . '/footer.php';